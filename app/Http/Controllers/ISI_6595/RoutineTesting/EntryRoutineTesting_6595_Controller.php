<?php

namespace App\Http\Controllers\ISI_6595\RoutineTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Entry\PumpTest\isi_6595_EntryPumpTest;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;
use App\Models\ISI_6595\RoutineTesting\isi_6595_EntryRoutineTest;
use App\Models\ISI_6595\RoutineTesting\isi_6595_EntryRoutineTestReport;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class EntryRoutineTesting_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $pumpDD = isi_6595_MasterPumpType::select('id', 'fldptype')->orderBy('id', 'asc')->get();
            $pumpNoDD = isi_6595_EntryRoutineTest::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_6595_EntryRoutineTest::join('isi_6595__master_pump_types', 'isi_6595__entry_routine_tests.fldptype', '=', 'isi_6595__master_pump_types.fldptype')
                            ->where('isi_6595__entry_routine_tests.id', '=', $typeValue)->get(['isi_6595__entry_routine_tests.*', 'isi_6595__master_pump_types.fldptype']);
                        $type = 'pnowise';
                        return view('6595.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_6595_EntryRoutineTest::select('*')->where('isi_6595__entry_routine_tests.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_6595_EntryRoutineTest::join('isi_6595__master_pump_types', 'isi_6595__entry_routine_tests.fldptype', '=', 'isi_6595__master_pump_types.fldptype')
                                ->where('isi_6595__master_pump_types.fldptype', '=', $typeValue)->get(['isi_6595__entry_routine_tests.*', 'isi_6595__master_pump_types.fldptype']);
                            $type = 'ptypewise';
                            return view('6595.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_6595_EntryRoutineTest::join('isi_6595__master_pump_types', 'isi_6595__entry_routine_tests.fldptype', '=', 'isi_6595__master_pump_types.fldptype')
                ->get(['isi_6595__entry_routine_tests.*', 'isi_6595__master_pump_types.fldptype']);

            return view('6595.entry.routineTesting.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pump = isi_6595_MasterPumpType::where('fldptype', $request->pumpType)->first();

                // return redirect()->back()->with('status', json_encode($pump));
                if ($pump == null) return redirect()->back()->with('status', 'Pump not exist');

                $rs1 = isi_6595_EntryPumpTest::where('fldsno', $pump->fldsno)->get();

                if (sizeof($rs1) > 0) {

                    $ipow1 = ($request->forWatts * $rs1[0]->fldwmc) / 1000;
                    $ipow2 = ($request->sorWatts * $rs1[0]->fldwmc) / 1000;
                    $icur1 = $request->forCurr * $rs1[0]->fldamc;
                    $icur2 = $request->sorCurr * $rs1[0]->fldamc;
                    $shead = $request->vguageRead * 0.0136;
                    $dhead = $request->prguageRead * 10;
                    $thead = $shead + $dhead + $request->guageDist;

                    if ($request->input('id')) {
                        $routineTest = isi_6595_EntryRoutineTest::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $routineTest = new isi_6595_EntryRoutineTest();
                        $msg = 'Record saved successfully!';

                        $routineTest->fldpno = $request->pumpNo;
                        $routineTest->fldsno = $request->ipNo;
                        $routineTest->fldptype = $request->pumpType;
                        $routineTest->fldtest = $request->testType;
                        $routineTest->flddate = $request->date;
                    }

                    // $routineTest->fldgdis = $request->guageDist;
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
                        $routineTest->fldmcur = $request->ipow;
                        $routineTest->fldrthead = $request->th;
                        $routineTest->flddis = $request->dis;
                        $routineTest->fldeff = $request->oeff;
                    }
                    $routineTest->save();

                    return redirect()->back()->with('status', $msg);

                    //
                } else return redirect()->route('6595_entryRoutineTesting')->with('status', 'No record for this pump!');
            } else return redirect()->route('6595_entryRoutineTesting')->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_6595_EntryRoutineTest::where('id', '=', $req->reportPnoId)->get();

                $pump = isi_6595_MasterPumpType::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);

                $tableData = isi_6595_EntryRoutineTestReport::all();
                return view('6595.entry.routineTesting.report', compact('tableData'));
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $req = $request;

                $reportData = isi_6595_EntryRoutineTest::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();

                if (sizeof($reportData) == 0) return redirect()->back()->with('status', 'No data in this period.');

                $pump = isi_6595_MasterPumpType::where('fldptype', '=', $reportData[0]->fldptype)->first();

                $this->store_report($req, $pump, $reportData);
                $tableData = isi_6595_EntryRoutineTestReport::all();
                return view('6595.entry.routineTesting.report', compact('tableData'));
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            $tableData = isi_6595_EntryRoutineTestReport::all();
            $pdf = PDF::loadView('6595.entry.routineTesting.report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store_report($req, $pump, $tableData)
    {
        try {
            //
            $report = new isi_6595_EntryRoutineTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_6595_EntryRoutineTestReport();
                $report->fldpno = $data->fldpno;
                $report->fldsno = $data->fldsno;
                $report->fldptype = $pump->fldptype;
                $report->fldcur = $data->fldcur;
                $report->fldwatt1 = $data->fldwatt1;
                $report->fldpow = $data->fldpow;
                $report->fldspeed = $data->fldspeed;
                $report->fldfreq = $data->fldfreq;
                $report->fldwatt2 = $data->fldwatt2;
                $report->fldcur1 = $data->fldcur1;
                $report->fldspeed1 = $data->fldspeed1;
                $report->fldfreq1 = $data->fldfreq1;
                $report->fldpow1 = $data->fldpow1;
                $report->fldvguage = $data->fldvguage;
                $report->fldpguage = $data->fldpguage;
                $report->fldshead = $data->fldshead;
                $report->flddhead = $data->flddhead;
                $report->fldthead = $data->fldthead;
                $report->flddis = $data->flddis;
                $report->fldrthead = $data->fldrthead;
                $report->fldmcur = $data->fldmcur;
                $report->flddate = $data->flddate;
                $report->fldeff = $data->fldeff;
                $report->fldhp = $pump->fldhp;
                $report->flddsize = $pump->flddsize;
                $report->fldvolts = $pump->fldvolt;
                $report->fldphase = $pump->fldphase;
                $report->fldheadr1 = $pump->fldheadr1;
                $report->fldheadr2 = $pump->fldheadr2;
                $report->fldmcurrs = $pump->fldmcurr;
                $report->fldtheads = $pump->fldthead;
                $report->flddiss = $pump->flddis;
                $report->fldoeffs = $pump->fldoeff;
                $report->fldfdate = $req->startDate;
                $report->fldtdate = $req->toDate;
                $report->save();
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                isi_6595_EntryRoutineTest::where('id', '=', $request->input('deletePumpIpNoId'))->delete();
                return redirect()->route('6595_entryRoutineTesting')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}