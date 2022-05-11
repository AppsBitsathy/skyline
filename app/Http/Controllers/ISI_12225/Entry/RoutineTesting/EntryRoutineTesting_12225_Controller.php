<?php

namespace App\Http\Controllers\ISI_12225\Entry\RoutineTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\RoutineTesting\isi_12225_EntryRoutineTest;
use App\Models\ISI_12225\Entry\RoutineTesting\isi_12225_EntryRoutineTestReport;
use App\Models\isi_12225_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryRoutineTesting_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $pumpDD = isi_12225_MasterPumpType::select('id', 'fldptype')->orderBy('id', 'asc')->get();
            $pumpNoDD = isi_12225_EntryRoutineTest::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_12225_EntryRoutineTest::join('isi_12225__master_pump_types', 'isi_12225__entry_routine_tests.fldptype', '=', 'isi_12225__master_pump_types.id')
                            ->where('isi_12225__entry_routine_tests.id', '=', $typeValue)->get(['isi_12225__entry_routine_tests.*', 'isi_12225__master_pump_types.fldptype']);
                        $type = 'pnowise';
                        return view('12225.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_12225_EntryRoutineTest::select('*')->where('isi_12225__entry_routine_tests.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_12225_EntryRoutineTest::join('isi_12225__master_pump_types', 'isi_12225__entry_routine_tests.fldptype', '=', 'isi_12225__master_pump_types.id')
                                ->where('isi_12225__master_pump_types.id', '=', $typeValue)->get(['isi_12225__entry_routine_tests.*', 'isi_12225__master_pump_types.fldptype']);
                            $type = 'ptypewise';
                            return view('12225.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_12225_EntryRoutineTest::join('isi_12225__master_pump_types', 'isi_12225__entry_routine_tests.fldptype', '=', 'isi_12225__master_pump_types.id')
                ->get(['isi_12225__entry_routine_tests.*', 'isi_12225__master_pump_types.fldPtype']);

            // return view('12225.entry.routineTesting.routineTesting');
            return view('12225.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pump = isi_12225_MasterPumpType::where('id', '=', $request->input('pumpType'))->first();

                if ($pump == null) return redirect()->back()->with('status', 'Pump not exist');

                $ipow1 = ($request->input('sorWatts') * $pump->fldwmc) / 1000;
                $icurr1 =  $request->input('sorCurr');

                // $fldsno = $pump['fldsno'];

                if ($request->input('id')) {
                    $routineTest = isi_12225_EntryRoutineTest::findOrFail($request->input('id'));
                    $msg = 'Record updated successfully!';
                } else {
                    $routineTest = new isi_12225_EntryRoutineTest();
                    $msg = 'Record saved successfully!';

                    $routineTest->fldpno = $request->input('pumpNo');
                    $routineTest->fldsno = $request->input('ipNo');
                    $routineTest->fldptype = $request->input('pumpType');
                }

                $routineTest->fldcurr = $request->input('sorCurr'); // $icurr1
                $routineTest->fldpow = $ipow1;
                $routineTest->fldspeed = $request->input('sorSpeed');
                $routineTest->fldfreq = $request->input('sorFrequency');
                $routineTest->fldthead = $request->input('totalHead');
                $routineTest->flddlwl = $request->input('dlwl');
                $routineTest->fldtest = $request->input('testType');
                $routineTest->fldwatt1 = $request->input('sorWatts');
                $routineTest->flddate = $request->input('date');
                if ($request->input('testType') == "Type") {
                    $routineTest->fldmcurr = $request->input('maxcurr');
                    $routineTest->fldrthead = $request->input('th');
                    $routineTest->fldrdlwl = $request->input('edlwl');
                    $routineTest->flddis = $request->input('dis');
                    $routineTest->fldeff = $request->input('ipow');
                }

                $routineTest->save();

                return redirect()->back()->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_12225_EntryRoutineTest::where('id', '=', $req->reportPnoId)->get();

                $pump = isi_12225_MasterPumpType::where('id', '=', $reportData[0]->fldptype)->first();

                $fldsno = $pump->fldsno;

                $this->store_report($req, $pump, $reportData);
                $tableData = isi_12225_EntryRoutineTestReport::all();
                return view('12225.entry.routineTesting.report', compact('tableData'));
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }
    public function create_pdf_report(Request $request)
    {
        try {
            $tableData = isi_12225_EntryRoutineTestReport::all();
            $pdf = PDF::loadView('12225.entry.routineTesting.report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }
    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_12225_EntryRoutineTest::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();

                $pump = isi_12225_MasterPumpType::where('id', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);
                $tableData = isi_12225_EntryRoutineTestReport::all();
                return view('12225.entry.routineTesting.custom_report', compact('tableData'));
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }
    public function create_pdf_custom_report(Request $request)
    {
        try {
            $tableData = isi_12225_EntryRoutineTestReport::all();
            $pdf = PDF::loadView('12225.entry.routineTesting.custom_report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store_report($req, $pump, $tableData)
    {
        try {
            $report = new isi_12225_EntryRoutineTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_12225_EntryRoutineTestReport();
                $report->fldpmno = $data->fldpno;
                $report->fldptype = $pump->fldptype;
                $report->fldsno = $data->fldsno;
                $report->fldcurr = $data->fldcurr;
                $report->fldwatt1 = $data->fldwatt1;
                $report->fldpow = $data->fldpow;
                $report->fldspeed = $data->fldspeed;
                $report->fldfreq = $data->fldfreq;
                $report->fldthead = $data->fldthead;
                $report->flddlwl = $data->flddlwl;
                $report->fldmcurr = $data->fldmcurr;
                $report->fldrthead = $data->fldrthead;
                $report->fldrdlwl = $data->fldrdlwl;
                $report->flddis = $data->flddis;
                $report->fldeff = $data->fldeff;
                $report->flddate = $data->flddate;
                $report->fldtest = $data->fldtest; // 0 to 17

                $report->fldhpkw = $pump->fldhp;
                $report->flddsize = $pump->flddsize;
                $report->flddisize = $pump->flddisize;
                $report->fldpsize = $pump->fldpsize;
                $report->fldddlwl = $pump->flddlwl; // 0 to 4

                $report->flddthead = $pump->fldthead;
                $report->fldddis = $pump->flddis;
                $report->fldpi = $pump->fldpi;

                $report->fldmcurr1 = $pump->fldmcurr;
                $report->flddlwl1 = $pump->flddlwl1;
                $report->flddlwl2 = $pump->flddlwl2;
                $report->fldmop = $pump->fldmop;
                $report->fldsub = $pump->fldsub;
                $report->fldvol = $pump->fldvol;
                $report->flddfreq = $pump->fldfreq;
                $report->flddvolt = $pump->fldvolt; // 8 to 15

                $report->fldwmc = $pump->fldwmc;
                // $report->fldamc = $data->fldamc;
                $report->fldphase = $pump->fldphase;
                $report->fldfdate = $req->startDate;
                $report->fldtdate = $req->toDate;

                $report->save();
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                isi_12225_EntryRoutineTest::where('id', '=', $request->input('deletePumpIpNoId'))->delete();
                return redirect()->route('12225_entryRoutineTesting')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}