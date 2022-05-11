<?php

namespace App\Http\Controllers\ISI_8472\Entry\RoutineTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_8472\Entry\PumpTest\isi_8472_EntryPumpTest;
use App\Models\ISI_8472\Entry\RoutineTesting\isi_8472_EntryRoutineTest;
use App\Models\ISI_8472\Entry\RoutineTesting\isi_8472_EntryRoutineTestReport;
use App\Models\ISI_8472\Master\isi_8472_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryRoutineTesting_8472_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $pumpDD = isi_8472_MasterPumpType::select('id', 'fldptype')->orderBy('id', 'asc')->get();
            $pumpNoDD = isi_8472_EntryRoutineTest::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_8472_EntryRoutineTest::join('isi_8472__master_pump_types', 'isi_8472__entry_routine_tests.fldptype', '=', 'isi_8472__master_pump_types.fldptype')
                            ->where('isi_8472__entry_routine_tests.id', '=', $typeValue)->get(['isi_8472__entry_routine_tests.*', 'isi_8472__master_pump_types.fldptype']);
                        $type = 'pnowise';
                        return view('8472.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_8472_EntryRoutineTest::select('*')->where('isi_8472__entry_routine_tests.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_8472_EntryRoutineTest::join('isi_8472__master_pump_types', 'isi_8472__entry_routine_tests.fldptype', '=', 'isi_8472__master_pump_types.fldptype')
                                ->where('isi_8472__master_pump_types.fldptype', '=', $typeValue)->get(['isi_8472__entry_routine_tests.*', 'isi_8472__master_pump_types.fldptype']);
                            $type = 'ptypewise';
                            return view('8472.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_8472_EntryRoutineTest::join('isi_8472__master_pump_types', 'isi_8472__entry_routine_tests.fldptype', '=', 'isi_8472__master_pump_types.fldptype')
                ->get(['isi_8472__entry_routine_tests.*', 'isi_8472__master_pump_types.fldptype']);

            return view('8472.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pump = isi_8472_MasterPumpType::where('fldptype', '=', $request->pumpType)->first();

                if ($pump == null) return redirect()->back()->with('status', 'Pump not exist');

                $rs1 = isi_8472_EntryPumpTest::where('fldsno', '=', $pump->fldsno)->get();

                if (sizeof($rs1) > 0) {

                    $ipow1 = ($request->forWatts * $rs1[0]->fldwmc) / 1000;
                    $ipow2 = ($request->sorWatts * $rs1[0]->fldwmc) / 1000;
                    $icur1 = $request->forCurr * $rs1[0]->fldamc;
                    $icur2 = $request->sorCurr * $rs1[0]->fldamc;
                    $shead = $request->vguageRead * 0.0136;
                    $dhead = $request->prguageRead * 10;
                    $thead = $shead + $dhead + $request->guageDist;

                    if ($request->input('id')) {
                        $routineTest = isi_8472_EntryRoutineTest::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $routineTest = new isi_8472_EntryRoutineTest();
                        $msg = 'Record saved successfully!';

                        $routineTest->fldpno = $request->pumpNo;
                        $routineTest->fldsno = $request->ipNo;
                        $routineTest->fldptype = $request->pumpType;
                        $routineTest->flddate = $request->date;
                        $routineTest->fldtest = $request->testType;
                    }


                    $routineTest->fldgdis = $request->guageDist;
                    $routineTest->fldcur = $icur1;
                    $routineTest->fldpow = $ipow1;
                    $routineTest->fldspeed = $request->forSpeed;
                    $routineTest->fldfreq = $request->forFrequency;;
                    $routineTest->fldcur1 = $icur2;
                    $routineTest->fldpow1 = $ipow2;
                    $routineTest->fldspeed1 = $request->sorSpeed;
                    $routineTest->fldfreq1 = $request->sorFrequency;
                    $routineTest->fldvguage = $request->vguageRead;
                    $routineTest->fldshead = $shead;
                    $routineTest->fldpguage = $request->prguageRead;
                    $routineTest->flddhead = $dhead;
                    $routineTest->fldthead = $thead;
                    $routineTest->fldwatt1 = $request->forWatts;
                    $routineTest->fldwatt2 = $request->sorWatts;
                    if ($request->input('testType') == "Type") {
                        $routineTest->fldmcur = $request->maxcurr;
                        $routineTest->fldrthead = $request->th;
                        $routineTest->flddis = $request->dis;
                        $routineTest->fldeff = $request->ipow;
                    }
                    $routineTest->save();

                    return redirect()->back()->with('status', $msg);

                    //
                } else return redirect()->route('8034_entryRoutineTesting')->with('status', 'No record for this pump!');
            } else return redirect()->route('8034_entryRoutineTesting')->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_8472_EntryRoutineTest::where('id', '=', $req->reportPnoId)->get();

                $pump = isi_8472_MasterPumpType::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);

                $tableData = isi_8472_EntryRoutineTestReport::all();
                return view('8472.entry.routineTesting.report', compact('tableData'));
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_8472_EntryRoutineTest::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();

                if (sizeof($reportData) == 0) return redirect()->back()->with('status', 'No data in this period.');

                $pump = isi_8472_MasterPumpType::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);
                $tableData = isi_8472_EntryRoutineTestReport::all();
                return view('8472.entry.routineTesting.report', compact('tableData'));
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
            $tableData = isi_8472_EntryRoutineTestReport::all();
            $pdf = PDF::loadView('8472.entry.routineTesting.report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store_report($req, $pump, $tableData)
    {
        try {
            //
            $report = new isi_8472_EntryRoutineTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_8472_EntryRoutineTestReport();
                $report->fldpno = $data->fldpno;
                $report->fldsno = $data->fldsno;
                $report->fldptype = $pump->fldptype;
                $report->fldgdis = $data->fldgdis;
                $report->fldspeed1 = $data->fldspeed1;
                $report->fldfreq1 = $data->fldfreq1;
                $report->flddate = $data->flddate;
                $report->fldwatt2 = $data->fldwatt2;
                $report->fldcur1 = $data->fldcur1;
                $report->fldeff = $data->fldeff;
                $report->fldthead = $data->fldthead;
                $report->fldrthead = $data->fldrthead;
                $report->fldcur = $data->fldcur;
                $report->fldwatt1 = $data->fldwatt1;
                $report->fldspeed = $data->fldspeed;
                $report->fldfreq = $data->fldfreq;
                $report->fldvguage = $data->fldvguage;
                $report->fldpguage = $data->fldpguage;
                $report->fldshead = $data->fldshead;
                $report->flddhead = $data->flddhead;
                $report->flddis = $data->flddis;
                $report->fldpow = $data->fldpow;
                $report->fldpow1 = $data->fldpow1;
                $report->fldhp = $pump->fldhp;
                $report->fldphase = $pump->fldphase;
                $report->fldheadr1 = $pump->fldheadr1;
                $report->fldheadr2 = $pump->fldheadr2;
                $report->fldip = $pump->fldip;
                $report->fldddis = $pump->flddis;
                $report->flddthead = $pump->fldthead;
                $report->fldmcurr = $pump->fldmcurr;
                $report->fldvolt = $pump->fldvolt;
                $report->flddfreq = $pump->fldfreq;
                $report->fldfdate = $req->startDate;
                $report->fldtdate = $req->toDate;
                $report->save();
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                isi_8472_EntryRoutineTest::where('id', '=', $request->input('deletePumpIpNoId'))->delete();
                return redirect()->route('8472_entryRoutineTesting')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}