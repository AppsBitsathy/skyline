<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EntryPumpTestISIFlowmetric;
use App\Models\EntryPumpTestISIVolumetricReport;
use App\Models\IsiGraphScale;
use App\Models\MasterPumpType;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryPumpTestingRDFlowController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allPumps = MasterPumpType::pluck('fldPtype', 'fldsno');

        $allEntryValues = EntryPumpTestISIFlowmetric::orderBy('fldPno')->pluck('fldSno', 'fldPno');

        $entries = array();

        if (count($request->query()) > 0) {
            if ($request->query('oPumpNo') && $request->query('oPumpType')) {
                $entries = DB::table('entry_pump_test_isi_flowmetrics', 'f',)
                    ->join('master_pump_types', 'master_pump_types.fldsno', '=', 'f.fldSno')
                    ->select('f.*', 'master_pump_types.fldPtype')
                    ->where('fldPno', '=', $request->query('oPumpNo'), 'and', 'fldSno', '=', $request->query('oPumpType'))
                    ->get();
                // return json_encode($entries);
                // $entries = EntryPumpTestISIFlowmetric::where('fldPno', '=', $request->query('oPumpNo'), 'and', 'fldSno', '=', $request->query('oPumpType'))->get();
            }
        }
        return view('entry.pumpTestingRD.flowmetric', compact(['allPumps', 'allEntryValues', 'entries']));
    }


    public function view_report_page(Request $request, $pumpNo = null, $pumpName = null)
    {
        try {
            if ($pumpNo != null) {
                $pumpDetails = MasterPumpType::where('fldsno', '=', $pumpNo)->first();
                $entryDetails = EntryPumpTestISIFlowmetric::where('fldSno', '=', $pumpNo)->where('fldPno', '=', $pumpName)->get();

                $report = new EntryPumpTestISIVolumetricReport();
                $report->truncate();

                foreach ($entryDetails as $entry) {
                    $report = new EntryPumpTestISIVolumetricReport();
                    $report->fldpno = $entry->fldPno;
                    $report->fldRSpeed = $entry->fldRSpeed;
                    $report->fldht = $entry->fldht;
                    $report->fldIpNo = $entry->fldIpNo;
                    $report->fldGDist = $entry->fldGDist;
                    $report->fldRead = $entry->fldRead;
                    $report->fldSpeed = $entry->fldSpeed;
                    $report->fldVGauge = $entry->fldVGauge;
                    $report->fldPGauge = $entry->fldPGauge;
                    $report->fldDHead = $entry->fldDHead;
                    $report->fldSHead = $entry->fldSHead;
                    $report->fldVCHead = $entry->fldVCHead;
                    $report->fldTHead = $entry->fldTHead;
                    $report->fldDis = $entry->fldDis;
                    $report->fldIp = $entry->fldIp;
                    $report->fldRTHead = $entry->fldRTHead;
                    $report->fldRDis = $entry->fldRDis;
                    $report->fldRIp = $entry->fldRIP;
                    $report->fldPop = $entry->fldPop;
                    $report->fldOeff = $entry->fldOeff;
                    $report->fldSno = $entry->fldSno;
                    $report->fldTime = $entry->fldTime;
                    $report->fldVolt = $entry->fldVolt;
                    $report->fldCurr = $entry->fldCurr;
                    $report->fldw1 = $entry->fldw1;
                    $report->fldw2 = $entry->fldw2;
                    $report->fldFreq = $entry->fldFreq;
                    $report->fldPType = $pumpDetails->fldPtype;
                    $report->fldhp = $pumpDetails->fldhp;
                    $report->fldSsize = $pumpDetails->fldSsize;
                    $report->fldDsize = $pumpDetails->fldDsize;
                    $report->fldPhase = $pumpDetails->fldPhase;
                    $report->fldRtemp = $pumpDetails->fldRtemp;
                    $report->fldVol = $entry->fldVol;
                    $report->fldMCurr = $pumpDetails->fldMcurr;
                    $report->fldDTHead = $pumpDetails->fldThead;
                    $report->fldDDis = $pumpDetails->flddis;
                    $report->fldDOeff = $pumpDetails->fldoeff;
                    $report->fldHeadr1 = $pumpDetails->fldHeadr1;
                    $report->fldHeadr2 = $pumpDetails->fldHeadr2;
                    $report->fld1_5 = $entry->fld1_5;
                    $report->fld2 = $entry->fld2;
                    $report->fld2m = $entry->fld2m;
                    $report->fldwmc = $entry->fldwmc;
                    $report->fldamc = $entry->fldamc;
                    $report->fldDFreq = $pumpDetails->fldFreq;
                    $report->fldCalc = $entry->fldCalc;
                    $report->save();
                }

                $pumpData = EntryPumpTestISIVolumetricReport::orderBy('id', 'desc')->first();
                $tableData = EntryPumpTestISIVolumetricReport::all();

                return view('entry.pumpTestingRD.report_flow', compact('pumpData', 'tableData'));
            } else
                return $this->index($request);
        } catch (Exception $ex) {
            return view('entry.pumpTestingRD.report_flow');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_pdf()
    {
        $pumpData = EntryPumpTestISIVolumetricReport::orderBy('id', 'desc')->first();
        $tableData = EntryPumpTestISIVolumetricReport::all();
        $pdf = PDF::loadView('entry.pumpTestingRD.report_vol', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
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

    public function newEntry($request)
    {
        if ($request->isMethod('POST')) {
            $extract = $request->all();

            for ($i = 0; $i < count($extract['speed']); $i++) {

                $flowEntries = new EntryPumpTestISIFlowmetric();

                $pumpMasterRow = MasterPumpType::where('fldPtype', '=', $extract['pumpType'])->get();

                $sh = $extract['vaccumGaugeReading'][$i] * 0.0136;
                $dh = $extract['pressureGaugeReading'][$i] * 10;

                if ($extract['discharge'][$i] == '0' || $extract['discharge'][$i] == '-') {
                    $ad = 0.00;
                    $time = 0.00;
                } else {
                    $ad = $extract['discharge'][$i];
                    $ad = number_format((float)$ad, 2, '.', '');
                    $flowfldvolResult = EntryPumpTestISIFlowmetric::where('fldSno', '=', $pumpMasterRow[0]['fldsno'], 'and', 'fldPno', '=', $extract['pumpNo'])->select('fldVol')->get();

                    // if ($i == 1) {
                    //     dd($flowfldvolResult);
                    // }

                    // if (count($flowfldvolResult) > 0) {
                    //     $time = $flowfldvolResult[0]['fldVol'];
                    // } else {
                    $time = 1 / $ad;
                    // }
                    $time = number_format((float)$time, 2, '.', '');
                }

                $dd = $pumpMasterRow[0]['fldDsize'] / 1000;
                $ds = $pumpMasterRow[0]['fldSsize'] / 1000;
                $vconst = (16 / (2 * 9.81 * (pow(3.141592652, 2)) * (pow(1000, 2)))) * ((1 / pow($dd, 4)) - (1 / pow($ds, 4)));

                $vch = pow($ad, 2) * $vconst;

                $th = $sh + $dh + $vch + $extract['gaugeDistance'];

                $th = number_format((float)$th, 2, '.', '');

                $ip = (($extract['watts1'][$i] + $extract['watts2'][$i]) * $extract['wmc']) / 1000;

                if ($extract['calc'] == 'Speed') {
                    $rth = (pow($extract['ratedSpeed'] / $extract['speed'][$i], 2)) * $th;
                    $rad = $extract['ratedSpeed'] / $extract['speed'][$i] * $ad;
                    $rip = (pow($extract['ratedSpeed'] / $extract['speed'][$i], 3)) * $ip;
                    $t1s = ($rth * 1.5) / 10;
                    $t2dm = $t1s * 10;
                } else {
                    $rth = (pow($pumpMasterRow[0]['fldFreq'] / $extract['frequency'][$i], 2)) * $th;
                    $rad = $pumpMasterRow[0]['fldFreq'] / $extract['frequency'][$i] * $ad;
                    $rip = (pow($pumpMasterRow[0]['fldFreq'] / $extract['frequency'][$i], 3)) * $ip;
                    $t1s = ($rth * 1.5) / 10;
                    $t2dm = $t1s * 10;
                }
                $t1s = number_format((float)$t1s, 2, '.', '');
                $t2dm = number_format((float)$t2dm, 2, '.', '');
                $rth = number_format((float)$rth, 2, '.', '');

                $rpop = $rth * $rad / 102;
                $oe = $rpop / $rip * 100;

                $t2d = ($pumpMasterRow[0]['fldThead'] * 2) / 10;
                $t2d = number_format((float)$t2d, 2, '.', '');

                $rct = $i + 1;

                // $fldvolResult = EntryPumpTestISIFlowmetric::where('fldPno', '=', $extract['pumpNo'], 'and', 'fldRead', '=', $rct, 'and', 'fldSno', '=', $pumpMasterRow[0]['fldsno'])->get();

                // if (count($fldvolResult) > 0) {
                $fldVol = 0;
                // } else {
                //     $fldVol = 1;
                // }

                $flowEntries->fldPno = $extract['pumpNo'];
                $flowEntries->fldRead = $i + 1;
                $flowEntries->fldSno = $pumpMasterRow[0]['fldsno'];
                $flowEntries->fldSpeed = $extract['speed'][$i];
                $flowEntries->fldVGauge = $extract['vaccumGaugeReading'][$i];
                $flowEntries->fldSHead = $sh;
                $flowEntries->fldDHead = $dh;
                $flowEntries->fldTHead = $th;
                $flowEntries->fldTime = $time;
                $flowEntries->fldDis = $ad;
                $flowEntries->fldVolt = $extract['voltage'][$i];
                $flowEntries->fldCurr = $extract['current'][$i] * $extract['amc'];
                $flowEntries->fldw1 = $extract['watts1'][$i];
                $flowEntries->fldw2 = $extract['watts2'][$i];
                $flowEntries->fldRTHead = $rth;
                $flowEntries->fldRDis = $rad;
                $flowEntries->fldIp = $ip;
                $flowEntries->fldFreq = $extract['frequency'][$i];
                $flowEntries->fldRSpeed = $extract['ratedSpeed'];
                $flowEntries->fldht = $extract['date'];
                $flowEntries->fldIpNo = $extract['inpassNo'];
                $flowEntries->fldPGauge = $extract['pressureGaugeReading'][$i];
                $flowEntries->fldVCHead = $vch;
                $flowEntries->fldGDist = $extract['gaugeDistance'];
                $flowEntries->fldRIP = $rip;
                $flowEntries->fldPop = $rpop;
                $flowEntries->fldOeff = $oe;
                $flowEntries->fldRandD = 0;
                $flowEntries->fld1_5 = $t1s;
                $flowEntries->fld2 = $t2d;
                $flowEntries->fld2m = $t2dm;
                $flowEntries->fldCalc = $extract['calc'];
                $flowEntries->fldamc = $extract['amc'];
                $flowEntries->fldwmc = $extract['wmc'];
                $flowEntries->fldVol = $fldVol;

                $flowEntries->save();
            }
        }
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
            $this->newEntry($request);
            return redirect()->back()->with('status', 'Record Saved');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            EntryPumpTestISIFlowmetric::where('fldPno', '=', $request->input('pumpNo'), 'and', 'fldSno', '=', $request->input('pumpType'))->delete();
            $this->newEntry($request);
            return redirect()->back()->with('status', 'Record Saved');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {
            EntryPumpTestISIFlowmetric::where('fldPno', '=', $request->input('deletePumpNo'), 'and', 'fldSno', '=', $request->input('deletePumpType'))->delete();
            return redirect()->route('entryPumpTestRDFlow')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = IsiGraphScale::where('fldpno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            return $isiScale[0];
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}