<?php

namespace App\Http\Controllers\ISI_8472\Entry\PumpTestingISI;

use App\Http\Controllers\Controller;
use App\Models\ISI_8472\Entry\PumpTest\isi_8472_EntryPumpTest;
use App\Models\ISI_8472\Entry\PumpTest\isi_8472_EntryPumpTestReport;
use App\Models\ISI_8472\isi_8472_Scale;
use App\Models\ISI_8472\Master\isi_8472_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class EntryPumpTestingISI_Flow_8472_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allPumps = isi_8472_MasterPumpType::pluck('fldptype', 'fldsno');
            $allEntryValues = isi_8472_EntryPumpTest::pluck('fldsno', 'fldpmno');
            $pType = '';

            if (count($request->query()) > 0) {
                $pType = $request->query('oPumpType');
                $entries = isi_8472_EntryPumpTest::where('fldpmno', '=', $request->query('oPumpNo'), 'and', 'fldsno', '=', $pType)->get();
                if (sizeof($entries) == 0) return redirect()->route('8472_entryPumpTestISIFlow')->with('status', 'Data not exist!');
                return view('8472.entry.pumpTestingISI.flowmetric', compact('allPumps', 'entries', 'allEntryValues', 'pType'));
            }
            return view('8472.entry.pumpTestingISI.flowmetric', compact('allPumps', 'allEntryValues'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $pumpCheck = isi_8472_MasterPumpType::where('fldsno', '=', $request->pumpType)->first();
                if ($pumpCheck == null) return redirect()->back()->with('status', 'Pump not exist!');

                // Calculation at given speed

                $wmc = $request->wmc;
                $amc = $request->amc;
                $t2d = round(($pumpCheck->fldthead * 2) / 10, 2);

                $dataLength = sizeof($request->speed);

                $pumpEntryLength = isi_8472_EntryPumpTest::select('id', 'fldread')->where('fldpmno', '=', $request->pumpNo)
                    ->where('fldsno', '=', $pumpCheck->fldsno)->get();

                $pumpEntryLength = sizeof($pumpEntryLength);

                if ($dataLength < $pumpEntryLength) {
                    for ($i = 1; $i <= ($pumpEntryLength - $dataLength); $i++) {
                        isi_8472_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                            ->where('fldread', '=', ($dataLength + $i))->delete();
                    }
                }

                for ($i = 0; $i < $dataLength; $i++) {
                    //

                    // Dl = Val(flx1.TextMatrix(rct, 2)) + Val(flx1.TextMatrix(rct, 3)) + 6
                    $SH = $request->vaccumGaugeReading[$i] * 0.0136;
                    if (round($request->dis[$i], 1) == "0" || $request->dis[$i] == "-") {
                        $Ad = 0;
                        $time = 0;
                    } else {
                        $Ad = $request->dis[$i];
                        $pumpd = isi_8472_EntryPumpTest::select('fldvol')->where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                        if ($pumpd->fldvol != null)
                            $time = ($pumpd->fldvol / $Ad) * 3600;
                        else
                            $time = (1 / $Ad) * 3600;
                    }

                    $dd = ($pumpCheck->flddsize) / 1000;
                    $ds = ($pumpCheck->fldssize) / 1000;
                    if ($dd == $ds) {
                        $Vconst = 0;
                    } else {
                        $Vconst = (16 / (2 * 9.81 * pow(3.141592652, 2) * pow(1000, 2))) * (pow(1 / $dd, 4) - pow(1 / $ds, 4));
                    }
                    $Vch = pow(($Ad / 3600), 2) * $Vconst; //v Correction Head
                    $DH = $request->pressureGaugeReading[$i] * 10;
                    $Th = $SH + $DH + $Vch + $request->gaugeDist;
                    $IP = (($request->watts1[$i] + $request->watts2[$i]) * $wmc) / 1000;

                    if ($request->calc == "Speed") {
                        // Calculation at rated speed
                        $Rth = pow(($request->ratedSpeed / $request->speed[$i]), 2) * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad = $request->ratedSpeed / $request->speed[$i] * $Ad;

                        // To Calculate Input Power
                        $RIP = pow(($request->ratedSpeed / $request->speed[$i]), 3) * $IP;
                    } else if ($request->calc == "Frequency") {
                        // Calculation at rated Frequency
                        $Rth = pow(($pumpCheck->fldfreq / $request->frequency[$i]), 2) * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad = $pumpCheck->fldfreq / $request->frequency[$i] * $Ad;

                        // To Calculate Input Power
                        $RIP = pow(($pumpCheck->fldfreq / $request->frequency[$i]), 3) * $IP;
                    } else return redirect()->back()->with('status', 'Invalid Calc value!');
                    $Rpop = ($Rth * $Rad / 102) / 3600;
                    $OE = $Rpop / $RIP * 100;


                    $pumpEntryCheck = isi_8472_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)
                        ->where('fldsno', '=', $pumpCheck->fldsno)->where('fldread', '=', $i + 1)->first();

                    if ($pumpEntryCheck == null) $insert = new isi_8472_EntryPumpTest();
                    else $insert = isi_8472_EntryPumpTest::findOrFail($pumpEntryCheck->id);

                    $insert->fldpmno = $request->pumpNo;
                    $insert->fldread = $i + 1;
                    $insert->fldsno = $pumpCheck->fldsno;
                    $insert->fldspeed = $request->speed[$i];
                    $insert->fldvgauge = $request->vaccumGaugeReading[$i];
                    $insert->fldshead = $SH;
                    $insert->flddhead = $DH;
                    $insert->fldthead = $Th;
                    $insert->fldtime = $time;
                    $insert->flddis = $Ad;
                    $insert->fldvolt = $request->voltage[$i];
                    $insert->fldcurr = $request->current[$i] * $amc;
                    $insert->fldw1 = $request->watts1[$i];
                    $insert->fldw2 = $request->watts2[$i];
                    $insert->fldrthead = $Rth;
                    $insert->fldrdis = $Rad;
                    $insert->fldip = $IP;
                    $insert->fldfreq = $request->frequency[$i];
                    $insert->fldrspeed = $request->ratedSpeed;
                    $insert->flddate = $request->date;
                    $insert->fldipno = $request->inpassNo;
                    $insert->fldpgauge = $request->pressureGaugeReading[$i];
                    $insert->fldvchead = $Vch;
                    $insert->fldgdist = $request->gaugeDist;
                    $insert->fldrip = $RIP;
                    $insert->fldpop = $Rpop;
                    $insert->fldrandd = false;
                    // $insert->fldOeff = OE
                    $insert->fld1_5 = $t1s;
                    $insert->fld2 = $t2d;
                    $insert->fld2m = $t2dm;
                    $insert->fldcurr1 = $request->current[$i] * $amc;
                    $insert->fldwmc = $wmc;
                    $insert->fldamc = $amc;
                    // $insert->fldvol = $request->collTankVol;
                    $insert->fldcalc = $request->calc;

                    $insert->save();

                    //
                } // end for loop

                $dataForScale = isi_8472_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                    ->get([
                        DB::raw('max(fldrdis) as max_fldrdis'), DB::raw('max(fldrip) as max_fldrip'), DB::raw('max(fldrthead) as max_fldrthead'),
                        DB::raw('max(fldcurr) as max_fldcurr')
                    ]);

                $xaxis = round(($dataForScale[0]['max_fldrdis'] / 19), 2);
                $yaxis1 = round(($dataForScale[0]['max_fldrip'] / 17), 2);
                $yaxis2 = round(($dataForScale[0]['max_fldrthead'] / 17), 2);
                $yaxis3 = round(($dataForScale[0]['max_fldcurr'] / 17), 2);

                $scale = isi_8472_Scale::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                // return redirect()->back()->with('status', $xaxis . ' ' . $yaxis1 . ' ' . $yaxis2 . ' ' . $yaxis3);

                if ($scale == null) $insert_scale = new isi_8472_Scale();

                else $insert_scale = isi_8472_Scale::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                $insert_scale->fldpmno = $request->pumpNo;
                $insert_scale->fldsno = $pumpCheck->fldsno;
                $insert_scale->xaxis = round($xaxis, 2);
                $insert_scale->yaxis1 = round($yaxis1, 2);
                $insert_scale->yaxis2 = round($yaxis2, 2);
                $insert_scale->yaxis3 = round($yaxis3, 2);
                $insert_scale->save();

                return redirect()->back()->with('status', 'Record saved successfully!');
            } else return redirect()->back()->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $pumpDetails = isi_8472_MasterPumpType::where('fldsno', '=', $request->obssptimepumpNo)->first();
                if ($pumpDetails == null) return redirect()->route('8472_entryPumpTestISIFlow')->with('status', 'Pump not exist!');
                $entryDetails = isi_8472_EntryPumpTest::where('fldsno', '=', $request->obssptimepumpNo)->where('fldpmno', '=', $request->obssptimepumpName)->get();
                if (sizeof($entryDetails) == 0) return redirect()->route('8472_entryPumpTestISIFlow')->with('status', 'Pump data not exist!');

                $report = new isi_8472_EntryPumpTestReport();
                $report->truncate();

                foreach ($entryDetails as $entry) {
                    $report = new isi_8472_EntryPumpTestReport();
                    $report->fldpmno = $entry->fldpmno;
                    $report->fldrspeed = $entry->fldrspeed;
                    $report->fldsno = $entry->fldsno;
                    $report->flddate = $entry->flddate;
                    $report->fldipno = $entry->fldipno;
                    $report->fldgdist = $entry->fldgdist;
                    $report->fldread = $entry->fldread;
                    $report->fldspeed = $entry->fldspeed;
                    $report->fldvgauge = $entry->fldvgauge;
                    $report->fldpgauge = $entry->fldpgauge;
                    $report->flddhead = $entry->flddhead;
                    $report->fldshead = $entry->fldshead;
                    $report->fldvchead = $entry->fldvchead;
                    $report->fldthead = $entry->fldthead;
                    $report->flddis = $entry->flddis;
                    // $report->fldip = $entry->fldip;
                    $report->fldrthead = $entry->fldrthead;
                    $report->fldrdis = $entry->fldrdis;
                    $report->fldrip = $entry->fldrip;
                    $report->fldpop = $entry->fldpop;
                    $report->fldip = $entry->fldip;
                    $report->fldtime = $entry->fldtime;
                    $report->fldvolt = $entry->fldvolt;
                    $report->fldcurr = $entry->fldcurr;
                    $report->fldw1 = $entry->fldw1;
                    $report->fldw2 = $entry->fldw2;
                    $report->fldfreq = $entry->fldfreq;
                    $report->fldsptime =  $request->obssptime;
                    $report->fldptype = $pumpDetails->fldptype;
                    $report->fldhp = $pumpDetails->fldhp;
                    $report->fldssize = $pumpDetails->fldssize;
                    $report->flddsize = $pumpDetails->flddsize;
                    $report->fldphase = $pumpDetails->fldphase;
                    $report->fldmcurr = $pumpDetails->fldmcurr;
                    $report->flddthead = $pumpDetails->fldthead;
                    $report->fldddis = $pumpDetails->flddis;
                    $report->flddip = $pumpDetails->fldip;
                    $report->fldheadr1 = $pumpDetails->fldheadr1;
                    $report->fldheadr2 = $pumpDetails->fldheadr2;
                    $report->flddfreq = $pumpDetails->fldfreq;
                    $report->flddsptime = $pumpDetails->fldsptime;
                    $report->fld1_5 = $entry->fld1_5;
                    $report->fld2 = $entry->fld2;
                    $report->fld2m = $entry->fld2m;
                    $report->fldwmc = $entry->fldwmc;
                    $report->fldamc = $entry->fldamc;
                    $report->fldvol = $entry->fldvol;
                    $report->fldcalc = $entry->fldcalc;
                    $report->save();
                }

                $pumpData = isi_8472_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
                $tableData = isi_8472_EntryPumpTestReport::all();

                return view('8472.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'));
            } else return redirect()->back()->with('status', 'Invalid request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function create_pdf(Request $request)
    {
        $pumpData = isi_8472_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
        $tableData = isi_8472_EntryPumpTestReport::all();
        // view()->share('user', $pumpData);
        $pdf = PDF::loadView('8472.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
    }

    public function delete(Request $request)
    {
        try {
            isi_8472_EntryPumpTest::where('fldpmno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            isi_8472_Scale::where('fldpmno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            return redirect()->route('8472_entryPumpTestISIFlow')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = isi_8472_Scale::where('fldpmno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            return $isiScale[0];
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}