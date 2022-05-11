<?php

namespace App\Http\Controllers\ISI_14220\Entry\RoutineTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_14220\Entry\PumpTest\isi_14220_EntryPumpTest;
use App\Models\ISI_14220\Entry\RoutineTest\isi_14220_EntryRoutineTest;
use App\Models\ISI_14220\Entry\RoutineTest\isi_14220_EntryRoutineTestReport;
use App\Models\ISI_14220\Master\isi_14220_MasterPumpTypes;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryRoutineTesting_14220_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $pumpDD = isi_14220_MasterPumpTypes::select('id', 'fldptype')->orderBy('id', 'asc')->get();
            $pumpNoDD = isi_14220_EntryRoutineTest::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_14220_EntryRoutineTest::join('isi_14220__master_pump_types', 'isi_14220__entry_routine_tests.fldptype', '=', 'isi_14220__master_pump_types.fldptype')
                            ->where('isi_14220__entry_routine_tests.id', '=', $typeValue)->get(['isi_14220__entry_routine_tests.*', 'isi_14220__master_pump_types.fldptype']);
                        $type = 'pnowise';
                        return view('14220.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_14220_EntryRoutineTest::select('*')->where('isi_14220__entry_routine_tests.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_14220_EntryRoutineTest::join('isi_14220__master_pump_types', 'isi_14220__entry_routine_tests.fldptype', '=', 'isi_14220__master_pump_types.fldptype')
                                ->where('isi_14220__master_pump_types.fldptype', '=', $typeValue)->get(['isi_14220__entry_routine_tests.*', 'isi_14220__master_pump_types.fldptype']);
                            $type = 'ptypewise';
                            return view('14220.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_14220_EntryRoutineTest::join('isi_14220__master_pump_types', 'isi_14220__entry_routine_tests.fldptype', '=', 'isi_14220__master_pump_types.fldptype')
                ->get(['isi_14220__entry_routine_tests.*', 'isi_14220__master_pump_types.fldptype']);

            return view('14220.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pump = isi_14220_MasterPumpTypes::where('fldptype', '=', $request->pumpType)->first();

                if ($pump == null) return redirect()->route('14220_entryRoutineTesting')->with('status', 'Pump not exist');

                $rs1 = isi_14220_EntryPumpTest::where('fldsno', '=', $pump->fldsno)->get();

                if (sizeof($rs1) > 0) {

                    $ipow1 = ($request->forWatts * $rs1[0]->fldwmc) / 1000;
                    $ipow2 = ($request->sorWatts * $rs1[0]->fldwmc) / 1000;
                    $icur1 = $request->forCurr * $rs1[0]->fldamc;
                    $icur2 = $request->sorCurr * $rs1[0]->fldamc;
                    $shead = $request->vguageRead * 0.0136;
                    $dhead = $request->prguageRead * 10;
                    $thead = $shead + $dhead;

                    if ($request->input('id')) {
                        $routineTest = isi_14220_EntryRoutineTest::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $routineTest = new isi_14220_EntryRoutineTest();
                        $msg = 'Record saved successfully!';

                        $routineTest->fldpno = $request->pumpNo;
                        $routineTest->fldsno = $request->ipNo;
                        $routineTest->fldptype = $request->pumpType;
                    }

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
                    $routineTest->flddate = $request->date;
                    $routineTest->fldwatt1 = $request->forWatts;
                    $routineTest->fldwatt2 = $request->sorWatts;
                    $routineTest->fldtest = $request->testType;
                    if ($request->input('testType') == "Type") {
                        $routineTest->fldmcur = $request->maxcurr;
                        $routineTest->fldrthead = $request->th;
                        $routineTest->flddis = $request->dis;
                        $routineTest->fldeff = $request->oeff;
                        // $routineTest->flddate1 = $request->date;
                    }
                    $routineTest->save();

                    return redirect()->back()->with('status', $msg);

                    //
                } else return redirect()->route('14220_entryRoutineTesting')->with('status', 'No record for this pump!');
            } else return redirect()->route('14220_entryRoutineTesting')->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_14220_EntryRoutineTest::where('id', '=', $req->reportPnoId)->get();

                $pump = isi_14220_MasterPumpTypes::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);

                $tableData = isi_14220_EntryRoutineTestReport::all();

                return view('14220.entry.routineTesting.report', compact('tableData'));
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

                $reportData = isi_14220_EntryRoutineTest::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();

                if (sizeof($reportData) == 0) return redirect()->back()->with('status', 'No data in this period.');

                $pump = isi_14220_MasterPumpTypes::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);
                $tableData = isi_14220_EntryRoutineTestReport::all();
                return view('14220.entry.routineTesting.report', compact('tableData'));
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
            $tableData = isi_14220_EntryRoutineTestReport::all();
            $pdf = PDF::loadView('14220.entry.routineTesting.report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store_report($req, $pump, $tableData)
    {
        try {
            //
            $report = new isi_14220_EntryRoutineTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_14220_EntryRoutineTestReport();
                $report->fldpno = $data->fldpno;
                $report->fldsno = $data->fldsno;
                $report->fldptype = $pump->fldptype;
                $report->flddate = $data->flddate;
                $report->fldcur = $data->fldcur;
                $report->fldwatt1 = $data->fldwatt1;
                $report->fldpow = $data->fldpow;
                $report->fldspeed = $data->fldspeed;
                $report->fldfreq = $data->fldfreq;
                $report->fldcur1 = $data->fldcur1;
                $report->fldwatt2 = $data->fldwatt2;
                $report->fldpow1 = $data->fldpow1;
                $report->fldspeed1 = $data->fldspeed1;
                $report->fldfreq1 = $data->fldfreq1;
                $report->fldvguage = $data->fldvguage;
                $report->fldshead = $data->fldshead;
                $report->fldpguage = $data->fldpguage;
                $report->flddhead = $data->flddhead;
                $report->fldthead = $data->fldthead;
                $report->fldmcur = $data->fldmcur;
                $report->fldrthead = $data->fldrthead;
                $report->flddis = $data->flddis;
                $report->fldeff = $data->fldeff;
                // $report->flddate1 = $data->flddate1;

                $report->fldhp = $pump->fldhp . '/' . $pump->fldkw;
                $report->flddsize = $pump->flddsize;
                $report->fldheadr1 = $pump->fldheadr1;
                $report->fldheadr2 = $pump->fldheadr2;
                $report->fldphase = $pump->fldphase;
                $report->fldvolts = $pump->fldvolt;

                $vol = isi_14220_EntryPumpTest::where('fldsno', '=', $pump->fldsno)->first();
                $report->fldvols = $vol->fldvol;

                $report->fldmcurrs = $pump->fldmcurr;
                $report->fldtheads = $pump->fldthead;
                $report->flddiss = $pump->flddis;
                $report->fldoeffs = $pump->fldoeff;
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
                isi_14220_EntryRoutineTest::where('id', '=', $request->input('deletePumpIpNoId'))->delete();
                return redirect()->route('14220_entryRoutineTesting')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}