<?php

namespace App\Http\Controllers\Entry\RoutineTest;

use App\Http\Controllers\Controller;
use App\Models\EntryPumpTestISIFlowmetric;
use App\Models\EntryPumpTestIsiVolumetric;
use App\Models\EntryRoutineTesting;
use App\Models\EntryRoutineTestingReport;
use App\Models\MasterPumpType;
use Dotenv\Parser\Entry;
use Exception;
use Illuminate\Http\Request;
use PhpOption\None;
use Barryvdh\DomPDF\Facade as PDF;

class EntryRoutineTestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $pumpDD = MasterPumpType::select('id', 'fldPtype')->orderBy('id', 'asc')->get();
            // join('master_pump_types', 'entry_routine_testings.fldptype', '=', 'master_pump_types.id')
            // ['entry_routine_testings.id', 'master_pump_types.fldPtype']
            // $plist = EntryRoutineTesting::groupBy('fldptype');
            $pumpNoDD = EntryRoutineTesting::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = EntryRoutineTesting::join('master_pump_types', 'entry_routine_testings.fldptype', '=', 'master_pump_types.id')
                            ->where('entry_routine_testings.id', '=', $typeValue)
                            ->get(['entry_routine_testings.*', 'master_pump_types.fldPtype']);
                        $type = 'pnowise';
                        return view('entry.routineTest.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = EntryRoutineTesting::select('*')->where('entry_routine_testings.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = EntryRoutineTesting::join('master_pump_types', 'entry_routine_testings.fldptype', '=', 'master_pump_types.id')
                                ->where('master_pump_types.id', '=', $typeValue)
                                ->get(['entry_routine_testings.*', 'master_pump_types.fldPtype']);
                            $type = 'ptypewise';
                            return view('entry.routineTest.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = EntryRoutineTesting::join('master_pump_types', 'entry_routine_testings.fldptype', '=', 'master_pump_types.id')
                ->get(['entry_routine_testings.*', 'master_pump_types.fldPtype']);

            return view('entry.routineTest.routineTesting', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again! ' . $ex->__toString());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pump = MasterPumpType::where('id', '=', $request->input('pumpType'))->first();
                $fldsno = $pump['fldsno'];

                $pumpData = EntryPumpTestIsiVolumetric::select('*')->where('fldsno', '=', $fldsno)->first();

                if ($pumpData == null) {
                    $pumpData = EntryPumpTestISIFlowmetric::select('*')->where('fldsno', '=', $fldsno)->first();
                    if ($pumpData == null) {
                        return redirect()->back()->with('status', $fldsno . ' Pump not exist');
                    }
                }

                $ipow = ($request->input('forWatts') * $pumpData['fldwmc']) / 1000;
                $ipow1 = ($request->input('sorWatts') * $pumpData['fldwmc']) / 1000;
                $icur = $request->input('forCurr') * $pumpData['fldamc'];
                $icur1 = $request->input('sorCurr') * $pumpData['fldamc'];

                $shead = $request->input('vgreading') * 0.0136;
                $dhead = $request->input('pgreading') * 10;
                $thead = $shead + $dhead;

                if ($request->input('id')) {
                    $routineTest = EntryRoutineTesting::findOrFail($request->input('id'));
                    $msg = 'Record updated successfully!';
                } else {
                    $routineTest = new EntryRoutineTesting();
                    $msg = 'Record saved successfully!';
                }

                $routineTest->fldpno = $request->input('pumpNo');
                $routineTest->fldptype = $request->input('pumpType');
                $routineTest->fldsno = $request->input('ipNo');
                $routineTest->fldcurr = $icur;
                $routineTest->fldpow = $ipow;
                $routineTest->fldwatt = $request->input('forWatts');
                $routineTest->fldspeed = $request->input('forSpeed');
                $routineTest->fldfreq = $request->input('forFrequency');
                $routineTest->fldcurr1 = $icur1;
                $routineTest->fldpow1 = $ipow1;
                $routineTest->fldwatt1 = $request->input('sorWatts');
                $routineTest->fldspeed1 = $request->input('sorSpeed');
                $routineTest->fldfreq1 = $request->input('sorFrequency');
                $routineTest->fldvgauge = $request->input('vgreading');
                $routineTest->fldshead = $shead;
                $routineTest->fldpgauge = $request->input('pgreading');
                $routineTest->flddhead = $dhead;
                $routineTest->fldthead = $thead;
                $routineTest->fldtest = $request->input('testType');
                if ($request->input('testType') == 'Type') {
                    $routineTest->fldmcurr = $request->input('maxcurr');
                    $routineTest->fldrthead = $request->input('th');
                    $routineTest->flddis = $request->input('dis');
                    $routineTest->fldeff = $request->input('oae');
                    $routineTest->flddate = $request->input('date');
                }

                $routineTest->save();

                return redirect()->back()->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    $req = $request;

                    $reportData = EntryRoutineTesting::where('id', '=', $req->reportPnoId)->get();
                    $pump = MasterPumpType::where('id', '=', $reportData[0]->fldptype)->first();

                    $fldsno = $pump->fldsno;

                    $v = 0;

                    $vol = EntryPumpTestIsiVolumetric::select('*')->where('fldsno', '=', $fldsno)->first();

                    if ($vol == null) {
                        $vol = EntryPumpTestISIFlowmetric::select('*')->where('fldsno', '=', $fldsno)->first();
                        if ($vol == null) {
                            return redirect()->back()->with('status', $fldsno . ' Pump not exist');
                        }
                    }

                    $v = $vol->fldVol;
                    $this->store_report($req, $pump, $reportData, $v);
                    $tableData = EntryRoutineTestingReport::all();
                    return view('entry.routineTest.report', compact('tableData'));
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
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
            $tableData = EntryRoutineTestingReport::all();
            $pdf = PDF::loadView('entry.routineTest.report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }
    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    $req = $request;

                    $reportData = EntryRoutineTesting::where('fldptype', '=', $req->pumpId)
                        ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();

                    $pump = MasterPumpType::where('id', '=', $reportData[0]->fldptype)->first();

                    $fldsno = $pump->fldsno;

                    $v = 0;
                    $vol = EntryPumpTestIsiVolumetric::select('*')->where('fldsno', '=', $fldsno)->first();

                    if ($vol == null) {
                        $vol = EntryPumpTestISIFlowmetric::select('*')->where('fldsno', '=', $fldsno)->first();
                        if ($vol == null) {
                            return redirect()->back()->with('status', $fldsno . ' Pump not exist');
                        }
                    }

                    $v = $vol->fldVol;
                    $this->store_report($req, $pump, $reportData, $v);
                    $tableData = EntryRoutineTestingReport::all();
                    return view('entry.routineTest.custom_report', compact('tableData'));
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
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
            $tableData = EntryRoutineTestingReport::all();
            $pdf = PDF::loadView('entry.routineTest.custom_report', compact('tableData'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store_report($req, $pump, $reportData, $vols)
    {
        try {
            $report = new EntryRoutineTestingReport();
            $report->truncate();

            foreach ($reportData as $data) {
                $report = new EntryRoutineTestingReport();
                $report->fldpno = $data->fldpno;
                $report->fldptype = $pump->fldPtype;
                $report->fldsno = $data->fldsno;
                $report->fldcurr = $data->fldcurr;
                $report->fldwatt = $data->fldwatt;
                $report->fldpow = $data->fldpow;
                $report->fldspeed = $data->fldspeed;
                $report->fldfreq = $data->fldfreq;
                $report->fldcurr1 = $data->fldcurr1;
                $report->fldwatt1 = $data->fldwatt1;
                $report->fldpow1 = $data->fldpow1;
                $report->fldspeed1 = $data->fldspeed1;
                $report->fldfreq1 = $data->fldfreq1;
                $report->fldvgauge = $data->fldvgauge;
                $report->fldshead = $data->fldshead;
                $report->fldpgauge = $data->fldpgauge;
                $report->flddhead = $data->flddhead;
                $report->fldthead = $data->fldthead;
                $report->fldmcurr = $data->fldmcurr;
                $report->fldrthead = $data->fldrthead;
                $report->flddis = $data->flddis;
                $report->fldeff = $data->fldeff;
                $report->flddate = explode(' ', $data->flddate)[0];
                $report->fldhp = $pump->fldhp;
                $report->flddsize = $pump->fldDsize;
                $report->fldheadr1 = $pump->fldHeadr1;
                $report->fldheadr2 = $pump->fldHeadr2;
                $report->fldgdis = $pump->fldGdis;
                $report->fldphase = $pump->fldPhase;
                $report->fldvolts = $pump->fldVolt;
                $report->fldvols = $vols;
                $report->fldmcurrs = $pump->fldMcurr;
                $report->fldtheads = $pump->fldThead;
                $report->flddiss = $pump->flddis;
                $report->fldoeffs = $pump->fldoeff;
                $report->fldfdate = $req->startDate ?? null;
                $report->fldtdate = $req->toDate ?? null;
                $report->save();
            }
            return true;
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    EntryRoutineTesting::where('id', '=', $request->input('deletePumpIpNoId'))->delete();
                    return redirect()->route('entryRoutineTesting')->with('status', 'Record Deleted!');
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}