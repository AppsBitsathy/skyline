<?php

namespace App\Http\Controllers\ISI_9283\Entry\MotorEntry;

use App\Http\Controllers\Controller;
use App\Models\ISI_9283\Entry\isi_9283_EntryMotorEntryMcal;
use App\Models\ISI_9283\Entry\isi_9283_EntryMotorEntryMinp;
use App\Models\ISI_9283\Entry\isi_9283_EntryMotorEntryReport;
use App\Models\ISI_9283\Master\isi_9283_MasterDelaredValues;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class EntryMotorEntry_9283_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allMotors = isi_9283_MasterDelaredValues::pluck('fldmtype', 'fldsno');
            $allEntryValues = isi_9283_EntryMotorEntryMinp::pluck('fldmno');
            // dd($allEntryValues);

            if (count($request->query()) > 0) {
                // return redirect()->route('9283_entryMotorEntry')->with('status', 'Data not exist!');
                // $pType = $request->query('oPumpType');
                $entryMinp = isi_9283_EntryMotorEntryMinp::where('fldmno', $request->query('oMotorNo'))->where('fldmtype', $request->query('oMotorType'))->first();
                $entryMcal = isi_9283_EntryMotorEntryMcal::where('fldmno', $request->query('oMotorNo'))->where('fldmtype', $request->query('oMotorType'))->first();
                if ($entryMinp == null || $entryMcal == null) return redirect()->route('9283_entryMotorEntry')->with('status', 'Data not exist!');

                $motor = isi_9283_MasterDelaredValues::select('fldphase')->where('fldsno', $entryMinp->fldmtype)->first();
                $motorPhase = $motor->fldphase;
                // $basicConnection = $this->get_motor($entryMinp->fldmtype);
                // dd($entryMcal);
                return view('9283.entry.motorEntry.motorEntry', compact('allMotors', 'entryMinp', 'entryMcal', 'motorPhase', 'allEntryValues'));
            }

            return view('9283.entry.motorEntry.motorEntry', compact('allMotors', 'allEntryValues'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function get_motor($motorSno = null)
    {
        try {
            if ($motorSno != null) {
                $motor = isi_9283_MasterDelaredValues::select('fldphase')->where('fldsno', $motorSno)->first();

                if ($motor->fldphase == 'SINGLE') $res = '<option value="CSCR" selected>CSCR</option>';
                else if ($motor->fldphase == 'THREE')
                    $res = '<option value="" selected disabled>Choose</option><option value="Star">Star</option><option value="Delta">Delta</option>';
                else $res = '';

                return $res;
            } else return null;
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {
                // rs1
                $motorDecl = isi_9283_MasterDelaredValues::where('fldsno', $request->basicListMotorTypes)->first();

                if ($motorDecl == null) return redirect()->back()->with('status', 'Invalid motor');

                // return redirect()->back()->with('status', json_encode($motorDecl->fldphase));
                // calculation

                if ($motorDecl->fldphase == "SINGLE") {
                    if ($request->loadnltVolt == "-") $nltp = "-";
                    else $nltp = $request->loadnltw1 * $request->loadnltConst;

                    if ($request->loadfltVolt == "-") {
                        $fltp = "-";
                        $eff = "-";
                        $slip = "-";
                    } else {
                        $fltp = $request->loadfltw3 * $request->loadfltConst;
                        $slip = ((3000 - (50 / $request->loadfltFreq) * $request->loadfltSpeed) / 3000) * 100;
                        $eff = (($motorDecl->fldkw * 1000) / $fltp) * 100;
                    }
                    if ($request->otherVoltv == "-") {
                        $bwt = "-";
                        $flkg = "-";
                        $flt = "-";
                        $rt = "-";
                    } else {
                        $rt = (4500 * $motorDecl->fldhp) / (2 * 3.14 * $motorDecl->fldfspeed);
                        $rt = round($rt, 2);
                        $bwt = pow(($request->otherVolta / $request->otherVoltv), 2) * $request->basicArmLength * $request->otherWeight;
                        $bwt = round($bwt, 2);
                        $flkg = $rt / $request->basicBreakBelt;
                        $flt = ($bwt / $rt) * 100;
                    }
                    $res50 = "-";
                    $constl = "-";
                    $nll = "-";
                    $fll = "-";
                    $fls = "-";
                    $totall = "-";
                    $sop = "-";
                    $rotorl = "-";
                    $strayl = "-";
                    $op = "-";
                } else if ($motorDecl->fldphase == 'THREE') {
                    $flkg = "-";
                    $res50 = (285 / (235 + $request->basicInitTemp)) * $request->basicResistPhase;
                    if ($request->loadnltVolt == "-") {
                        $nltp = "-";
                        $nll = "-";
                        $constl = "-";
                    } else {

                        if ($request->loadnltw2 == "-") $nltp = $request->loadnltw1 * $request->loadnltConst;
                        else $nltp = ($request->loadnltw1 - $request->loadnltw2) * $request->loadnltConst;

                        if ($motorDecl->fldphase == "SINGLE") $nll = pow($request->loadnltAmp, 2) * $res50;
                        else if ($motorDecl->fldphase == "THREE") {
                            if (strtolower($request->basicConnection) == "star") $nll = pow($request->loadnltAmp, 2) * $res50 * 3;
                            else if (strtolower($request->basicConnection) == "delta") $nll = pow($request->loadnltAmp, 2) * $res50;
                            else return redirect()->back()->with('status', 'Invalid connection value inside');
                        } else return redirect()->back()->with('status', 'Invalid phase value inside');
                        $constl = $nltp - $nll;
                    }
                    if ($request->loadfltVolt == "-") {
                        $fltp = "-";
                        $fll = "-";
                        $fls = "-";
                    } else {
                        if ($request->loadfltw4 == "-") $fltp = $request->loadfltw3 * $request->loadfltConst;
                        else $fltp = ($request->loadfltw3 + $request->loadfltw4) * $request->loadfltConst;

                        if (strtolower($request->basicConnection) == "star") $fll = pow($request->loadfltAmp, 2) * $res50 * 3;
                        else $fll = pow($request->loadfltAmp, 2) * $res50;

                        $fls = ($request->loadfltSpeed / $request->loadfltFreq) * 50;
                    }

                    if ($constl == "-" && $fll == "-") {
                        $totall = "-";
                        $sop = "-";
                        $slip = "-";
                        $rotorl = "-";
                        $op = "-";
                        $strayl = "-";
                        $eff = "-";
                    } else {
                        if ($fll == "-") {
                            $fll = 0;
                            $totall = "-";
                            $sop = "-";
                            $slip = "-";
                            $rotorl = "-";
                            $op = "-";
                            $strayl = "-";
                            $eff = "-";
                        } else {
                            $totall = $fll + $constl;
                            $sop = $fltp - $totall;
                            $rotorl = ($sop * $fls) / 3000;
                            $strayl = $rotorl * 0.005;
                            $slip = ((3000 - $fls) / 3000) * 100;
                            $op = $rotorl - $strayl;
                            $eff = ($op / $fltp) * 100;
                        }
                    }
                    $rt = (973.3 * $motorDecl->fldkw) / $motorDecl->fldfspeed;
                    $rt = round($rt, 2);
                    if ($request->otherVoltv == "-") {
                        $bwt = "-";
                        $flt = "-";
                    } else {
                        if ($request->otherWeight == "-") {
                            $bwt = "-";
                            $flt = "-";
                        } else {
                            $bwt = ($request->otherVolta / $request->otherVoltv) ^ 2 * $request->basicArmLength * $request->otherWeight;
                            $bwt = round($bwt, 2);
                            $flt = ($bwt / $rt) * 100;
                            $flt = round($flt, 2);
                        }
                    }
                } else return redirect()->back()->with('status', 'Invalid phase value outside');

                if ($request->otherInitResistHun == "-") $tx = "-";
                else {
                    $tx = (($request->otherFinalResistHun / $request->otherInitResistHun) * (235 + $request->otherInitTempHun)) - 235;
                    $tx = $tx - $request->otherFinalTempHun;
                }

                if ($request->otherInitResistEig == "-") $ty = "-";
                else {
                    $ty = (($request->otherFinalResistEig / $request->otherInitResistEig) * (235 + $request->otherInitTempEig)) - 235;
                    $ty = $ty - $request->otherFinalTempEig;
                }

                // Call Updater2
                if ($eff != "-" && $flt != "-" && $request->basicMaxLeakCurr != "-") {

                    $report = isi_9283_EntryMotorEntryReport::where([['fldmno', $request->basicMotorNo], ['fldmtype', $request->basicListMotorTypes]])->first();

                    if ($report == null) $report = new isi_9283_EntryMotorEntryReport();

                    $report->fldmno = $request->basicMotorNo;
                    $report->fldmtype = $request->basicListMotorTypes;
                    $report->flddate = $request->basicTestedDate;
                    $report->fldflt = round($flt, 2);
                    $report->fldeff = round($eff, 2);
                    $report->fldlcur = $request->basicMaxLeakCurr;
                    $report->save();
                }
                // End Call Updater2

                $entryMinp = isi_9283_EntryMotorEntryMinp::where([['fldmno', $request->basicMotorNo], ['fldmtype', $request->basicListMotorTypes]])->first();
                if ($entryMinp == null) {
                    $entryMinp = new isi_9283_EntryMotorEntryMinp();
                    $entryMinp->fldmno = $request->basicMotorNo;
                    $entryMinp->fldmtype = $request->basicListMotorTypes;
                    $msg = 'Record saved successfully';
                } else {
                    $msg = 'Record updated successfully';
                }

                $entryMcal = isi_9283_EntryMotorEntryMcal::where([['fldmno', $request->basicMotorNo], ['fldmtype', $request->basicListMotorTypes]])->first();
                if ($entryMcal == null) {
                    $entryMcal = new isi_9283_EntryMotorEntryMcal();
                    $entryMcal->fldmno = $request->basicMotorNo;
                    $entryMcal->fldmtype = $request->basicListMotorTypes;
                    $msg = 'Record saved successfully';
                } else {
                    $msg = 'Record updated successfully';
                }

                // Call Updater (minp)
                $entryMinp->fldtype = $request->basicType;
                $entryMinp->fldconn = $request->basicConnection;
                $entryMinp->fldbtr_bt = $request->basicBreakBelt;
                $entryMinp->fldarm = $request->basicArmLength;
                $entryMinp->fldsres = $request->basicResistPhase;
                $entryMinp->flditemp = $request->basicInitTemp;
                $entryMinp->fldspeedclk = $request->basicSpeedClock;
                $entryMinp->fldspeedaclk = $request->basicAntiClock;
                $entryMinp->fldbhv = $request->basicBeforeVolt;
                $entryMinp->fldahv = $request->basicAfterVolt;
                $entryMinp->fldhv = $request->basicHighVolt;
                $entryMinp->fldnlv = $request->loadnltVolt;
                $entryMinp->fldnla = $request->loadnltAmp;
                $entryMinp->fldnlw1 = $request->loadnltw1;
                $entryMinp->fldnlw2 = $request->loadnltw2;
                $entryMinp->fldnlc1 = $request->loadnltConst;
                $entryMinp->fldnlspeed = $request->loadnltSpeed;
                $entryMinp->fldnlfreq = $request->loadnltFreq;
                $entryMinp->fldflv = $request->loadfltVolt;
                $entryMinp->fldfla = $request->loadfltAmp;
                $entryMinp->fldflw3 = $request->loadfltw3;
                $entryMinp->fldflw4 = $request->loadfltw4;
                $entryMinp->fldflc2 = $request->loadfltConst;
                $entryMinp->fldflspeed = $request->loadfltSpeed;
                $entryMinp->fldflfreq = $request->loadfltFreq;
                $entryMinp->fldlrv = $request->otherVoltv;
                $entryMinp->fldlrav = $request->otherVolta;
                $entryMinp->fldlra = $request->otherAmp;
                $entryMinp->fldlrpower = $request->otherPower;
                $entryMinp->fldlrweight = $request->otherWeight;
                $entryMinp->fldtrires = $request->otherInitResistHun;
                $entryMinp->fldtritemp = $request->otherInitTempHun;
                $entryMinp->fldtrfres = $request->otherFinalResistHun;
                $entryMinp->fldtrftemp = $request->otherFinalTempHun;
                $entryMinp->fldtrires1 = $request->otherInitResistEig;
                $entryMinp->fldtritemp1 = $request->otherInitTempEig;
                $entryMinp->fldtrfres1 = $request->otherFinalResistEig;
                $entryMinp->fldtrftemp1 = $request->otherFinalTempEig;
                $entryMinp->fldodshaft = $request->dimDiaShaft;
                $entryMinp->fldoext = $request->dimShaftExt;
                $entryMinp->fldosdia = $request->dimSpigotDia;
                $entryMinp->fldocon = $request->dimConcentricity;
                $entryMinp->fldoodia = $request->dimOutDia;
                $entryMinp->fldoper = $request->dimPerpend;
                $entryMinp->flddate = $request->basicTestedDate;
                $entryMinp->save();
                // End Call Updater (minp)

                // Call Updater1 (mcal)
                $entryMcal->fldres50 = $res50;
                $entryMcal->fldnltp = $nltp;
                $entryMcal->fldfltp = $fltp;
                $entryMcal->fldnll = $nll;
                $entryMcal->fldconstl = $constl;
                $entryMcal->fldfll = $fll;
                $entryMcal->fldtotall = $totall;
                $entryMcal->fldsop = $sop;
                $entryMcal->fldslip = $slip;
                $entryMcal->fldrotorl = $rotorl;
                $entryMcal->fldstrayl = $strayl;
                $entryMcal->fldop = $op;
                $entryMcal->fldeff = $eff;
                $entryMcal->fldbwt = $bwt;
                $entryMcal->fldflkg = $flkg;
                $entryMcal->fldflt = $flt;
                $entryMcal->fldtx = $tx;
                $entryMcal->fldty = $ty;
                $entryMcal->fldfls = $fls;
                $entryMcal->fldrt = $rt;
                $entryMcal->flddate = $request->basicTestedDate;
                $entryMcal->fldlcur = $request->basicMaxLeakCurr;
                $entryMcal->save();
                // End Call Updater1 (mcal)

                $resultModal = array();
                // $result = array();

                if ($flt != "-" && $eff != "-" && $request->basicMaxLeakCurr != "-") {
                    // Call Check
                    $dflt = $motorDecl->fldstorque;
                    $deff = $motorDecl->fldmeff;
                    $dlcur = $motorDecl->fldlcur;
                    $oflt = round($flt, 2);
                    $oeff = round($eff, 2);
                    $olcur = round($request->basicMaxLeakCurr, 2);
                    if ($oflt >= $dflt) $rflt = "Pass";
                    else $rflt = "Fail";

                    if ($oeff >= $deff) $reff = "Pass";
                    else $reff = "Fail";

                    if ($olcur <= $dlcur) $rlcur = "Pass";
                    else $rlcur = "Fail";

                    if ($rflt == "Pass" && $reff == "Pass" && $rlcur == "Pass") $ores = "Pass";
                    else $ores = "Fail";

                    $resultModal = array(
                        'dflt' => $dflt,
                        'deff' => $deff,
                        'dlcur' => $dlcur,
                        'oflt' => $oflt,
                        'oeff' => $oeff,
                        'olcur' => $olcur,
                        'rflt' => $rflt,
                        'reff' => $reff,
                        'rlcur' => $rlcur,
                        'ores' => $ores,
                        'msg' => $msg
                    );

                    // End Call Check
                    // return redirect()->route('9283_entryMotorEntry')->with('resultModal', [
                    //     'dflt' => $dflt,
                    //     'deff' => $deff,
                    //     'dlcur' => $dlcur,
                    //     'oflt' => $oflt,
                    //     'oeff' => $oeff,
                    //     'olcur' => $olcur,
                    //     'rflt' => $rflt,
                    //     'reff' => $reff,
                    //     'rlcur' => $rlcur,
                    //     'ores' => $ores,
                    //     'msg' => $msg
                    // ]);

                    // Session::put('resultModal', $resultModal);
                    // $request->session()->push('resultModal', $resultModal);

                    $entries = array();
                    $allMotors = isi_9283_MasterDelaredValues::pluck('fldmtype', 'fldsno');
                    $allEntryValues = isi_9283_EntryMotorEntryMinp::pluck('fldmno');
                    return view('9283.entry.motorEntry.motorEntry', compact('resultModal', 'allMotors', 'allEntryValues', 'msg'));
                    //
                } else return redirect()->route('9283_entryMotorEntry')->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request, $motorNo = null, $motorType = null)
    {
        try {
            $report_motor = isi_9283_MasterDelaredValues::where('fldsno', $motorType)->first();
            $report_minp = isi_9283_EntryMotorEntryMinp::where([['fldmno', $motorNo], ['fldmtype', $motorType]])->first();
            $report_mcal = isi_9283_EntryMotorEntryMcal::where([['fldmno', $motorNo], ['fldmtype', $motorType]])->first();

            if ($report_motor->fldphase == 'SINGLE')
                return view('9283.entry.motorEntry.report.report_single', compact('report_motor', 'report_minp', 'report_mcal'));
            else if ($report_motor->fldphase == 'THREE')
                return view('9283.entry.motorEntry.report.report_three', compact('report_motor', 'report_minp', 'report_mcal'));
            else return redirect()->back()->with('status', 'Invalid phase value in view report');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report(Request $request, $motorNo = null, $motorType = null)
    {
        $report_motor = isi_9283_MasterDelaredValues::where('fldsno', $motorType)->first();
        $report_minp = isi_9283_EntryMotorEntryMinp::where([['fldmno', $motorNo], ['fldmtype', $motorType]])->first();
        $report_mcal = isi_9283_EntryMotorEntryMcal::where([['fldmno', $motorNo], ['fldmtype', $motorType]])->first();
        // view()->share('user', $pumpData);
        if ($report_motor->fldphase == 'SINGLE')
            $pdf = PDF::loadView('9283.entry.motorEntry.report.report_single', compact('report_motor', 'report_minp', 'report_mcal'))->setPaper('a3', 'landscape');
        else if ($report_motor->fldphase == 'THREE')
            $pdf = PDF::loadView('9283.entry.motorEntry.report.report_three', compact('report_motor', 'report_minp', 'report_mcal'))->setPaper('a3', 'landscape');
        else return redirect()->back()->with('status', 'Invalid phase value in view report download');

        return $pdf->download();
    }

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {
                $inputs = $request->input();
                $fdate = $inputs['startDate'];
                $tdate = $inputs['toDate'];
                $report_motor = isi_9283_MasterDelaredValues::where('fldsno', $inputs['motortype'])->first();
                $report_minp = isi_9283_EntryMotorEntryMinp::where('fldmtype', $inputs['motortype'])->whereBetween('flddate', [$fdate, $tdate])->get();
                $report_mcal = isi_9283_EntryMotorEntryMcal::where('fldmtype', $inputs['motortype'])->whereBetween('flddate', [$fdate, $tdate])->get();

                return view('9283.entry.motorEntry.custom_report', compact('report_motor', 'report_minp', 'report_mcal', 'fdate', 'tdate'));
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_custom_report(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $inputs = $request->input();
                $fdate = $inputs['startDate'];
                $tdate = $inputs['toDate'];
                $report_motor = isi_9283_MasterDelaredValues::where('fldsno', $inputs['motortype'])->first();
                $report_minp = isi_9283_EntryMotorEntryMinp::where('fldmtype', $inputs['motortype'])->whereBetween('flddate', [$fdate, $tdate])->get();
                $report_mcal = isi_9283_EntryMotorEntryMcal::where('fldmtype', $inputs['motortype'])->whereBetween('flddate', [$fdate, $tdate])->get();

                $pdf = PDF::loadView('9283.entry.motorEntry.custom_report', compact('report_motor', 'report_minp', 'report_mcal', 'fdate', 'tdate'))->setPaper('a3', 'landscape');

                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {
                isi_9283_EntryMotorEntryMinp::where([['fldmno', $request->deletePumpNo], ['fldmtype', $request->deletePumpType]])->delete();
                isi_9283_EntryMotorEntryMcal::where([['fldmno', $request->deletePumpNo], ['fldmtype', $request->deletePumpType]])->delete();
                isi_9283_EntryMotorEntryReport::where([['fldmno', $request->deletePumpNo], ['fldmtype', $request->deletePumpType]])->delete();

                return redirect()->route('9283_entryMotorEntry')->with('status', 'Record deleted successfully!');
            } else redirect()->back()->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}