<?php

namespace App\Http\Controllers\ISI_12225\Entry\PumpTestISI;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\isi_12225_EntryPumpTest;
use App\Models\ISI_12225\Entry\isi_12225_EntryPumpTestingReport;
use App\Models\ISI_12225\isi_12225_Scale;
use App\Models\isi_12225_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;

class EntryPumpTestingISI_Flow_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allPumps = isi_12225_MasterPumpType::pluck('fldptype', 'fldsno');
            $allEntryValues = isi_12225_EntryPumpTest::pluck('fldsno', 'fldpmno');
            $pType = '';

            if (count($request->query()) > 0) {
                $pType = $request->query('oPumpType');
                $entries = isi_12225_EntryPumpTest::where('fldpmno', '=', $request->query('oPumpNo'), 'and', 'fldsno', '=', $pType)->get();
                if (sizeof($entries) == 0) return redirect()->route('12225_entryPumpTestISIFlow')->with('status', 'Data not exist!');
                return view('12225.entry.pumpTestingISI.flowmetric', compact('allPumps', 'entries', 'allEntryValues', 'pType'));
            }
            return view('12225.entry.pumpTestingISI.flowmetric', compact('allPumps', 'allEntryValues'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $pumpCheck = isi_12225_MasterPumpType::where('fldsno', '=', $request->pumpType)->first();
                if ($pumpCheck == null) return redirect()->back()->with('status', 'Pump not exist!');

                // Calculation at given speed

                // $temp = $pumpCheck->fldsno;
                $wmc = $request->wmc;
                $t2d = round(($pumpCheck->fldthead * 2) / 10, 2);
                $amc = $request->amc;

                $dataLength = sizeof($request->speed);
                $pumpEntryLength = isi_12225_EntryPumpTest::select('id', 'fldread')->where('fldpmno', '=', $request->pumpNo)
                    ->where('fldsno', '=', $pumpCheck->fldsno)->get();

                $pumpEntryLength = sizeof($pumpEntryLength);

                if ($dataLength < $pumpEntryLength) {
                    for ($i = 1; $i <= ($pumpEntryLength - $dataLength); $i++) {
                        isi_12225_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                            ->where('fldread', '=', ($dataLength + $i))->delete();
                    }
                }

                for ($i = 0; $i < $dataLength; $i++) {

                    $dl = $request->ejectGaugeReading[$i] + $request->correctGaugeReading[$i] + 6;
                    $Th = 10 * $request->pressureGaugeReading[$i] + $request->correctGaugeReading[$i];

                    if (round(trim($request->discharge[$i]), 1) == "0" || round(trim($request->discharge[$i]), 1) == 0 || round(trim($request->discharge[$i]), 1) == "-") {
                        $Ad = 0;
                        $time = 0;
                    } else {
                        $Ad = $request->discharge[$i];

                        $volcal = isi_12225_EntryPumpTest::select('fldvol')->where('fldsno', '=', $pumpCheck->fldsno)->where('fldpmno', '=', $request->pumpNo)->get();

                        if ($volcal != null) $time = ($volcal[0]->fldvol / $Ad) * 3600;
                        else $time = 1 / $Ad;
                    }

                    if ($request->calc == "Speed") {
                        // Calculation at rated speed
                        $Rdl = (($request->ratedSpeed / $request->speed[$i]) * ($request->ratedSpeed / $request->speed[$i])) * $dl;
                        $Rth = pow(($request->ratedSpeed / $request->speed[$i]), 2)  * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad =  $request->ratedSpeed / $request->speed[$i] * $Ad;

                        // To Calculate Input Power
                        $IP = pow(($request->ratedSpeed / $request->speed[$i]), 3)  * ($request->watts[$i] * $wmc) / 1000;
                    } elseif ($request->calc == "Frequency") {
                        $rscalc = $pumpCheck->fldfreq;

                        // Calculation at rated Frequency
                        $Rdl = ($rscalc / $request->frequency[$i]) * ($rscalc / $request->frequency[$i]) * $dl;
                        $Rth = pow(($rscalc / $request->frequency[$i]), 2) * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad = $rscalc / $request->frequency[$i] * $Ad;

                        // To Calculate Input Power
                        $IP = (pow(($rscalc / $request->frequency[$i]), 3) * ($request->watts[$i] * $wmc)) / 1000;
                    } else return redirect()->back()->with('status', 'Invalid Calc value!');

                    $pumpEntryCheck = isi_12225_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)
                        ->where('fldsno', '=', $pumpCheck->fldsno)->where('fldread', '=', $i + 1)->first();

                    if ($pumpEntryCheck == null) $insert = new isi_12225_EntryPumpTest();
                    else $insert = isi_12225_EntryPumpTest::findOrFail($pumpEntryCheck->id);

                    $insert->fldpmno = $request->pumpNo;
                    $insert->fldread = $i + 1;
                    $insert->fldsno = $pumpCheck->fldsno;
                    $insert->fldspd = $request->speed[$i];
                    $insert->fldehead = $request->ejectGaugeReading[$i];
                    $insert->fldchead = $request->correctGaugeReading[$i];
                    $insert->flddlwl = $dl;
                    $insert->flddhead = (10 * $request->pressureGaugeReading[$i]);
                    $insert->fldthead = $Th;
                    $insert->fldtime = round($time, 2);
                    $insert->fldadis = $Ad;
                    $insert->fldvolt = $request->voltage[$i];
                    $insert->fldcurr = $request->current[$i] * $amc;
                    $insert->fldwatts = $request->watts[$i];
                    $insert->fldrdlwl = $Rdl;
                    $insert->fldrthead = $Rth;
                    $insert->fldrdis = $Rad;
                    $insert->fldipow = $IP;
                    $insert->fldfreq = $request->frequency[$i];
                    $insert->fldrspeed = $request->ratedSpeed;
                    $insert->flddate = $request->date;
                    $insert->fldipno = $request->inpassNo;
                    $insert->fldprgread = $request->pressureGaugeReading[$i];
                    $insert->fldrandd = false; // RandD = false
                    $insert->fld1_5 = $t1s;
                    $insert->fld2 = $t2d;
                    $insert->fld2m = $t2dm;
                    $insert->fldcurr1 = $request->current[$i] * $amc;
                    $insert->fldwmc = $wmc;
                    $insert->fldamc = $amc;
                    $insert->fldcalc = $request->calc;
                    $insert->save();
                } // end for loop

                $dataForScale = isi_12225_EntryPumpTest::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                    ->get([
                        DB::raw('max(fldrdis) as max_fldrdis'), DB::raw('max(fldipow) as max_fldipow'), DB::raw('max(fldrthead) as max_fldrthead'),
                        DB::raw('max(fldcurr) as max_fldcurr')
                    ]);

                $xaxis = round(($dataForScale[0]['max_fldrdis'] / 19), 2);
                $yaxis1 = round(($dataForScale[0]['max_fldipow'] / 17), 2);
                $yaxis2 = round(($dataForScale[0]['max_fldrthead'] / 17), 2);
                $yaxis3 = round(($dataForScale[0]['max_fldcurr'] / 17), 2);

                $scale = isi_12225_Scale::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                // return redirect()->back()->with('status', $xaxis . ' ' . $yaxis1 . ' ' . $yaxis2 . ' ' . $yaxis3);

                if ($scale == null) $insert_scale = new isi_12225_Scale();

                else $insert_scale = isi_12225_Scale::where('fldpmno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                $insert_scale->fldpmno = $request->pumpNo;
                $insert_scale->fldsno = $pumpCheck->fldsno;
                $insert_scale->xaxis = round($xaxis, 2);
                $insert_scale->yaxis1 = round($yaxis1, 2);
                $insert_scale->yaxis2 = round($yaxis2, 2);
                $insert_scale->yaxis3 = round($yaxis3, 2);
                $insert_scale->save();

                return redirect()->back()->with('status', 'Record saved successfully!');
            } else return redirect()->back()->with('status', 'Invalid request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request, $pumpNo = null, $pumpName = null)
    {
        try {
            if ($pumpNo != null) {
                $pumpDetails = isi_12225_MasterPumpType::where('fldsno', '=', $pumpNo)->first();
                if ($pumpDetails == null) return redirect()->route('12225_entryPumpTestISIFlow')->with('status', 'Pump not exist!');
                $entryDetails = isi_12225_EntryPumpTest::where('fldsno', '=', $pumpNo)->where('fldpmno', '=', $pumpName)->get();
                if (sizeof($entryDetails) == 0) return redirect()->route('12225_entryPumpTestISIFlow')->with('status', 'Pump data not exist!');

                $report = new isi_12225_EntryPumpTestingReport();
                $report->truncate();


                foreach ($entryDetails as $entry) {
                    $report = new isi_12225_EntryPumpTestingReport();
                    $report->fldpmno = $entry->fldpmno;
                    $report->fldsno = $entry->fldsno;
                    $report->fldread = $entry->fldread;
                    $report->fldspd = $entry->fldspd;
                    $report->fldehead = $entry->fldehead;
                    $report->fldchead = $entry->fldchead;
                    $report->flddlwl = $entry->flddlwl;
                    $report->flddhead = $entry->flddhead;
                    $report->fldthead = $entry->fldthead;
                    $report->fldtime = $entry->fldtime;
                    $report->fldadis = $entry->fldadis;
                    $report->fldvolt = $entry->fldvolt;
                    $report->fldcurr = $entry->fldcurr;
                    $report->fldwatts = $entry->fldwatts;
                    $report->fldrdlwl = $entry->fldrdlwl;
                    $report->fldrthead = $entry->fldrthead;
                    $report->fldrdis = $entry->fldrdis;
                    $report->fldipow = $entry->fldipow;
                    $report->fldfreq = $entry->fldfreq;
                    $report->fldrspeed = $entry->fldrspeed;
                    $report->flddate = $entry->flddate;
                    $report->fldipno = $entry->fldipno;

                    $report->fldprgread = $entry->fldprgread;

                    $report->fldptype = $pumpDetails->fldptype;
                    $report->fldhpkw = $pumpDetails->fldhp;
                    $report->flddsize = $pumpDetails->flddsize;
                    $report->flddisize = $pumpDetails->flddisize;
                    $report->fldpsize = $pumpDetails->fldpsize;

                    $report->fldddlwl = $pumpDetails->flddlwl;
                    $report->flddthead = $pumpDetails->fldthead;
                    $report->flddfreq = $pumpDetails->fldvol;
                    // $report->flddfreq = $pumpDetails->fldfreq;
                    $report->flddvolt = $pumpDetails->fldvolt;

                    $report->flddis = $pumpDetails->flddis;
                    $report->fldpi = $pumpDetails->fldpi;
                    $report->fldmcurr = $pumpDetails->fldmcurr;
                    $report->flddlwl1 = $pumpDetails->flddlwl1;
                    $report->flddlwl2 = $pumpDetails->flddlwl2;
                    $report->fldmop = $pumpDetails->fldmop;
                    $report->fldsub = $pumpDetails->fldsub;

                    $report->fld1_5 = $entry->fld1_5;
                    $report->fld2 = $entry->fld2;
                    $report->fld2m = $entry->fld2m;
                    $report->flddate = $entry->flddate;
                    $report->fldwmc = $entry->fldwmc;
                    $report->fldamc = $entry->fldamc;
                    $report->fldvol = $entry->fldvol;
                    $report->fldcalc = $entry->fldcalc;
                    $report->save();
                }

                $pumpData = isi_12225_EntryPumpTestingReport::orderBy('fldread', 'desc')->first();
                $tableData = isi_12225_EntryPumpTestingReport::all();

                return view('12225.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'));
                //
            } else return redirect()->route('12225_entryPumpTestISIVol')->with('status', 'Pump not exist!');
        } catch (Exception $ex) {
        }
    }

    public function create_pdf()
    {
        $pumpData = isi_12225_EntryPumpTestingReport::orderBy('fldread', 'desc')->first();
        $tableData = isi_12225_EntryPumpTestingReport::all();

        $pdf = PDF::loadView('12225.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
    }

    public function delete(Request $request)
    {
        try {
            isi_12225_EntryPumpTest::where('fldpmno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            isi_12225_Scale::where('fldpmno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            return redirect()->route('12225_entryPumpTestISIFlow')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = isi_12225_Scale::where('fldpmno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            if (count($isiScale) > 0) {
                return $isiScale[0];
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}