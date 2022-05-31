<?php

namespace App\Http\Controllers;

use App\Models\EntryPumpTestIsiVolumetric;
use App\Models\EntryPumpTestISIVolumetricReport;
use App\Models\IsiGraphScale;
use App\Models\MasterPumpType;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;

class EntryPumpTestingRDVolController extends Controller
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

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allPumps = MasterPumpType::pluck('fldPtype', 'fldsno');
            $allEntryValues = EntryPumpTestIsiVolumetric::pluck('fldSno', 'fldPno');
            $pType = '';

            if (count($request->query()) > 0) {
                $entries = EntryPumpTestIsiVolumetric::where('fldPno', '=', $request->query('oPumpNo'), 'and', 'fldSno', '=', $pType)->get();
                $pType = $request->query('oPumpType');
                // return $pType;
                return view('entry.pumpTestingRD.volumetric', compact('allPumps', 'entries', 'allEntryValues', 'pType'));
            }
            return view('entry.pumpTestingRD.volumetric', compact('allPumps', 'allEntryValues', 'entries', 'pType'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }


    public function view_report_page(Request $request, $pumpNo = null, $pumpName = null)
    {
        try {
            if ($pumpNo != null) {
                $pumpDetails = MasterPumpType::where('fldsno', '=', $pumpNo)->first();
                $entryDetails = EntryPumpTestIsiVolumetric::where('fldSno', '=', $pumpNo)->where('fldPno', '=', $pumpName)->get();

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

                return view('entry.pumpTestingRD.report_vol', compact('pumpData', 'tableData'));
            } else
                return $this->index($request);
        } catch (Exception $ex) {
            return view('entry.pumpTestingRD.report_vol');
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
        // view()->share('user', $pumpData);
        $pdf = PDF::loadView('entry.pumpTestingRD.report_vol', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
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
            if ($request->isMethod('post'))
                if ($request->_token) {
                    $pump = MasterPumpType::where('fldsno', '=', $request->pumpType)->first();
                    $entries = EntryPumpTestIsiVolumetric::all()->where('fldSno', '=', $pump->fldsno)->where('fldPno', '=', $request->pumpNo);

                    foreach ($entries as $entry) {
                        $gEntry = EntryPumpTestIsiVolumetric::findOrFail($entry->id);
                        $gEntry->delete();
                    }

                    $length = sizeof($request->speed);

                    for ($i = 0; $i < $length; $i++) {

                        $pumpNo = $request->pumpNo;
                        $speed = $request->speed[$i];
                        $vgauge = $request->vaccumGaugeReading[$i];
                        $pgauge = $request->pressureGaugeReading[$i];
                        $gaugeDistance = $request->gaugeDistance;
                        $time = $request->time[$i];
                        $voltage = $request->voltage[$i];
                        $curr = $request->current[$i] * $request->amc;
                        $curr1 = $request->current[$i] * $request->amc;
                        $watts1 = $request->watts1[$i];
                        $watts2 = $request->watts2[$i];
                        $frequency = $request->frequency[$i];
                        $ratedSpeed = $request->ratedSpeed;
                        $date = $request->date;
                        $inpassNo = $request->inpassNo;
                        $calc = $request->calc;
                        $wmc = $request->wmc;
                        $amc = $request->amc;
                        $collTankVol = $request->collTankVol;

                        $t2d = round(($pump['fldThead'] * 2) / 10, 2);

                        $SH = $vgauge * 0.0136;

                        if (trim($time) == '' || trim($time) == 0)
                            $Ad = 0;
                        else
                            $Ad = $collTankVol / $time;

                        $dd = $pump['fldDsize'] / 1000;
                        $ds = $pump['fldSsize'] / 1000;

                        $Vconst = (16 / (2 * 9.81 * pow(3.141592652, 2) * pow(1000, 2))) * ((1 / pow($dd, 4)) - (1 / pow($ds, 4)));

                        $Vch = pow($Ad, 2) * $Vconst;

                        $DH = $pgauge * 10;

                        $Th = $SH + $DH + $Vch + $gaugeDistance;

                        $IP = (($watts1 + $watts2) * $wmc) / 1000;

                        if ($calc == 'Speed') {
                            $temp = $ratedSpeed / $speed;
                            $Rth = pow($temp, 2) * $Th;
                            $t1s = $Rth * 1.5 / 10;
                            $t2dm = $t1s * 10;
                            $Rad = ($ratedSpeed / $speed) * $Ad;
                            $RIP = pow($temp, 3) * $IP;
                        } else {
                            $temp = $pump->fldFreq / $frequency;
                            $Rth = pow($temp, 2) * $Th;
                            $t1s = $Rth * 1.5 / 10;
                            $t2dm = $t1s * 10;
                            $Rad = ($pump->fldFreq / $frequency) * $Ad;
                            $RIP = pow($temp, 3) * $IP;
                        }

                        $RPop = $Rth * $Rad / 102;
                        $OE = $RPop / $RIP * 100;

                        $tableModel = new EntryPumpTestIsiVolumetric();

                        $tableModel->fldPno = $pumpNo;
                        $tableModel->fldRead = $i + 1;
                        $tableModel->fldSpeed = $speed;
                        $tableModel->fldVGauge = $vgauge;
                        $tableModel->fldSHead = $SH;
                        $tableModel->fldPGauge = $pgauge;
                        $tableModel->fldDHead = $DH;
                        $tableModel->fldVCHead = $Vch;
                        $tableModel->fldGDist = $gaugeDistance;
                        $tableModel->fldTHead = round($Th, 3);
                        $tableModel->fldTime = $time;
                        $tableModel->fldDis = round($Ad, 2);
                        $tableModel->fldVolt = $voltage;
                        $tableModel->fldCurr = $curr;
                        $tableModel->fldw1 = $watts1;
                        $tableModel->fldw2 = $watts2;
                        $tableModel->fldIp = $IP;
                        $tableModel->fldRTHead = round($Rth, 6);
                        $tableModel->fldRDis = round($Rad, 6);
                        $tableModel->fldRIP = round($RIP, 6);
                        $tableModel->fldPop = round($RPop, 6);
                        $tableModel->fldOeff = round($OE, 6);
                        $tableModel->fldSno = $pump->fldsno;
                        $tableModel->fldFreq = $frequency;
                        $tableModel->fldRSpeed = $ratedSpeed;
                        $tableModel->fldht = $date;
                        $tableModel->fldIpNo = $inpassNo;
                        $tableModel->fldCurr1 = $curr1;
                        $tableModel->fld1_5 = round($t1s, 2);
                        $tableModel->fld2 = round($t2d, 2);
                        $tableModel->fld2m = round($t2dm, 2);
                        $tableModel->fldCalc = $calc;
                        $tableModel->fldwmc = $wmc;
                        $tableModel->fldamc = $amc;
                        $tableModel->fldVol = $collTankVol;
                        $tableModel->save();
                    }
                    return redirect('/9079/entry/pump_testing_rd/graphsvolumetric')->with('status', 'Record saved successfully!');
                } else {
                }
            else {
                return redirect()->back()->with('status', 'Invalid request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = IsiGraphScale::where('fldpno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            if (count($isiScale) > 0) {
                return $isiScale[0];
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function delete(Request $request)
    {
        try {
            EntryPumpTestIsiVolumetric::where('fldPno', '=', $request->input('deletePumpNo'), 'and', 'fldSno', '=', $request->input('deletePumpType'))->delete();
            return redirect()->route('entryPumpTestISIVol')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
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