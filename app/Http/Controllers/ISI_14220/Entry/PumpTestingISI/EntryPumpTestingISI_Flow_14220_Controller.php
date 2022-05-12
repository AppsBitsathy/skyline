<?php

namespace App\Http\Controllers\ISI_14220\Entry\PumpTestingISI;

use App\Http\Controllers\Controller;
use App\Models\ISI_14220\Entry\PumpTest\isi_14220_EntryPumpTest;
use App\Models\ISI_14220\Entry\PumpTest\isi_14220_EntryPumpTestReport;
use App\Models\ISI_14220\isi_14220_Scale;
use App\Models\ISI_14220\Master\isi_14220_MasterPumpTypes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class EntryPumpTestingISI_Flow_14220_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allPumps = isi_14220_MasterPumpTypes::pluck('fldptype', 'fldsno');
            $allEntryValues = isi_14220_EntryPumpTest::pluck('fldsno', 'fldpno');
            $pType = '';

            if (count($request->query()) > 0) {
                $pType = $request->query('oPumpType');
                $entries = isi_14220_EntryPumpTest::where('fldpno', '=', $request->query('oPumpNo'), 'and', 'fldsno', '=', $pType)->get();
                if (sizeof($entries) == 0) return redirect()->route('14220_entryPumpTestISIFlow')->with('status', 'Data not exist!');
                return view('14220.entry.pumpTestingISI.flowmetric', compact('allPumps', 'entries', 'allEntryValues', 'pType'));
            }
            return view('14220.entry.pumpTestingISI.flowmetric', compact('allPumps', 'allEntryValues'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $pumpCheck = isi_14220_MasterPumpTypes::where('fldsno', $request->pumpType)->first();
                if ($pumpCheck == null) return redirect()->back()->with('status', 'Pump not exist!');

                // Calculation at given speed

                // $temp = $pumpCheck->fldsno;
                $wmc = $request->wmc;
                $amc = $request->amc;
                $t2d = round(($pumpCheck->fldthead * 2) / 10, 2);

                $dataLength = sizeof($request->speed);
                $pumpEntryLength = isi_14220_EntryPumpTest::select('id', 'fldread')->where('fldpno', $request->pumpNo)
                    ->where('fldsno', $pumpCheck->fldsno)->get();

                $pumpEntryLength = sizeof($pumpEntryLength);

                if ($dataLength < $pumpEntryLength) {
                    for ($i = 1; $i <= ($pumpEntryLength - $dataLength); $i++) {
                        isi_14220_EntryPumpTest::where('fldpno', $request->pumpNo)->where('fldsno', $pumpCheck->fldsno)
                            ->where('fldread', ($dataLength + $i))->delete();
                    }
                }

                for ($i = 0; $i < $dataLength; $i++) {
                    if ($request->dis[$i] == "0" || $request->dis[$i] == "-" || $request->dis[$i] == 0) {
                        $Ad = 0;
                        $time = 0;
                    } else {
                        $Ad = $request->dis[$i];
                        $pumpd = isi_14220_EntryPumpTest::select('fldvol')->where('fldsno', $pumpCheck->fldsno)->where('fldpno', $request->pumpNo)->first();
                        if ($pumpd->fldvol > 0) $time = $pumpd->fldvol / $Ad;
                        else $time = 1 / $Ad;
                    }

                    $dd = $pumpCheck->flddsize / 1000;
                    $Vconst = (16 / (2 * 9.81 * pow(3.141592654, 2) * pow($dd, 4) * pow(1000, 2)));
                    $Vch = pow($Ad, 2) * $Vconst;

                    $DH = $request->pressureGaugeReading[$i] * 10;
                    $Th = $DH + $Vch + $request->chead;
                    $IP = (($request->watts1[$i] + $request->watts2[$i]) * $wmc) / 1000;

                    if ($request->calc == "Speed") {
                        // 'Calculation at rated speed
                        $Rth = pow(($request->ratedSpeed / $request->speed[$i]), 2) * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad = $request->ratedSpeed / $request->speed[$i] * $Ad;

                        // 'To Calculate Input Power
                        $RIP = pow(($request->ratedSpeed / $request->speed[$i]), 3) * $IP;
                    } else {

                        // 'Calculation at rated Frequency
                        $Rth = pow(($pumpCheck->fldfreq / $request->frequency[$i]), 2) * $Th;
                        $t1s = round(($Rth * 1.5) / 10, 2);
                        $t2dm = round(($t1s * 10), 2);
                        $Rad = $pumpCheck->fldfreq / $request->frequency[$i] * $Ad;

                        // 'To Calculate Input Power
                        $RIP = pow(($pumpCheck->fldfreq / $request->frequency[$i]), 3) * $IP;
                    }

                    $Rpop = $Rth * $Rad / 102;
                    $OE = $Rpop / $RIP * 100;


                    $pumpEntryCheck = isi_14220_EntryPumpTest::where('fldpno', $request->pumpNo)
                        ->where('fldsno', $pumpCheck->fldsno)->where('fldread', $i + 1)->first();

                    if ($pumpEntryCheck == null) $insert = new isi_14220_EntryPumpTest();
                    else $insert = isi_14220_EntryPumpTest::findOrFail($pumpEntryCheck->id);

                    $insert->fldpno = $request->pumpNo;
                    $insert->fldsno = $pumpCheck->fldsno;
                    $insert->fldread = $i + 1;
                    $insert->fldspeed = $request->speed[$i];
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
                    $insert->fldpguage = $request->pressureGaugeReading[$i];
                    $insert->fldvchead = $Vch;
                    $insert->fldchead = $request->chead;
                    $insert->fldrip = $RIP;
                    $insert->fldpop = $Rpop;
                    $insert->fldoeff = $OE;
                    $insert->fldrandd = false;
                    $insert->fld1_5 = $t1s;
                    $insert->fld2 = $t2d;
                    $insert->fld2m = $t2dm;
                    $insert->fldcurr1 = $request->current[$i] * $amc;
                    $insert->fldwmc = $wmc;
                    $insert->fldamc = $amc;
                    $insert->fldvol = 1;

                    $insert->save();
                } // end for loop

                $dataForScale = isi_14220_EntryPumpTest::where('fldpno', $request->pumpNo)->where('fldsno', $pumpCheck->fldsno)
                    ->get([
                        DB::raw('max(fldrdis) as max_fldrdis'), DB::raw('max(fldoeff) as max_fldoeff'), DB::raw('max(fldrthead) as max_fldrthead'),
                        DB::raw('max(fldcurr) as max_fldcurr')
                    ]);

                $xaxis = round(($dataForScale[0]['max_fldrdis'] / 19), 2);
                $yaxis1 = round(($dataForScale[0]['max_fldoeff'] / 17), 2);
                $yaxis2 = round(($dataForScale[0]['max_fldrthead'] / 17), 2);
                $yaxis3 = round(($dataForScale[0]['max_fldcurr'] / 17), 2);

                $scale = isi_14220_Scale::where('fldpno', $request->pumpNo)->where('fldsno', $pumpCheck->fldsno)->first();

                if ($scale == null) $insert_scale = new isi_14220_Scale();

                else $insert_scale = isi_14220_Scale::where('fldpno', $request->pumpNo)->where('fldsno', $pumpCheck->fldsno)->first();

                $insert_scale->fldpno = $request->pumpNo;
                $insert_scale->fldsno = $pumpCheck->fldsno;
                $insert_scale->xaxis = round($xaxis, 2);
                $insert_scale->yaxis1 = round($yaxis1, 2);
                $insert_scale->yaxis2 = round($yaxis2, 2);
                $insert_scale->yaxis3 = round($yaxis3, 2);
                $insert_scale->save();

                return redirect()->back()->with('status', 'Record saved successfully!');
            } else return redirect()->back()->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request, $pumpNo = null, $pumpName = null)
    {
        try {
            if ($pumpNo != null) {
                $pumpDetails = isi_14220_MasterPumpTypes::where('fldsno', '=', $pumpNo)->first();
                if ($pumpDetails == null) return redirect()->route('14220_entryPumpTestISIFlow')->with('status', 'Pump not exist!');
                $entryDetails = isi_14220_EntryPumpTest::where('fldsno', '=', $pumpNo)->where('fldpno', '=', $pumpName)->get();
                if (sizeof($entryDetails) == 0) return redirect()->route('14220_entryPumpTestISIFlow')->with('status', 'Pump data not exist!');

                $report = new isi_14220_EntryPumpTestReport();
                $report->truncate();

                foreach ($entryDetails as $entry) {
                    $report = new isi_14220_EntryPumpTestReport();
                    $report->fldpno = $entry->fldpno;
                    $report->fldrspeed = $entry->fldrspeed;
                    $report->fldht = $entry->flddate;
                    $report->fldipno = $entry->fldipno;
                    $report->fldchead = $entry->fldchead;
                    $report->fldread = $entry->fldread;
                    $report->fldspeed = $entry->fldspeed;
                    $report->fldpguage = $entry->fldpguage;
                    $report->flddhead = $entry->flddhead;
                    $report->fldvchead = $entry->fldvchead;
                    $report->fldthead = $entry->fldthead;
                    $report->flddis = $entry->flddis;
                    $report->fldip = $entry->fldip;
                    $report->fldrthead = $entry->fldrthead;
                    $report->fldrdis = $entry->fldrdis;
                    $report->fldrip = $entry->fldrip;
                    $report->fldpop = $entry->fldpop;
                    $report->fldoeff = $entry->fldoeff;
                    $report->fldsno = $entry->fldsno;
                    $report->fldtime = $entry->fldtime;
                    $report->fldvolt = $entry->fldvolt;
                    $report->fldcurr = $entry->fldcurr;
                    $report->fldw1 = $entry->fldw1;
                    $report->fldw2 = $entry->fldw2;
                    $report->fldfreq = $entry->fldfreq;
                    $report->fldptype = $pumpDetails->fldptype;
                    $report->fldhp = $pumpDetails->fldhp;
                    $report->fldkw = $pumpDetails->fldkw;
                    $report->flddsize = $pumpDetails->flddsize;
                    $report->fldphase = $pumpDetails->fldphase;
                    $report->fldmcurr = $pumpDetails->fldmcurr;
                    $report->flddthead = $pumpDetails->fldthead;
                    $report->fldddis = $pumpDetails->flddis;
                    $report->flddoeff = $pumpDetails->fldoeff;
                    $report->fldheadr1 = $pumpDetails->fldheadr1;
                    $report->fldheadr2 = $pumpDetails->fldheadr2;
                    $report->flddfreq = $pumpDetails->fldfreq;
                    $report->fldstage = $pumpDetails->fldstage;
                    $report->fldvolts = $pumpDetails->fldvolt;
                    $report->fldfreqs = $pumpDetails->fldfreq;
                    $report->fld1_5 = $entry->fld1_5;
                    $report->fld2 = $entry->fld2;
                    $report->fld2m = $entry->fld2m;
                    $report->fldcalc = $entry->fldcalc;
                    $report->fldwmc = $entry->fldwmc;
                    $report->fldamc = $entry->fldamc;
                    $report->fldvol = $entry->fldvol;
                    $report->fldsub = $pumpDetails->fldsub;
                    $report->fldmtype = $pumpDetails->fldmtype;
                    $report->flddia = $pumpDetails->flddia;
                    $report->fldcat = $pumpDetails->fldcat;
                    $report->save();
                }

                $pumpData = isi_14220_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
                $tableData = isi_14220_EntryPumpTestReport::all();

                return view('14220.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'));
            } else return redirect()->route('14220_entryPumpTestISIFlow')->with('status', 'Pump not exist!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function create_pdf()
    {
        $pumpData = isi_14220_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
        $tableData = isi_14220_EntryPumpTestReport::all();
        // view()->share('user', $pumpData);
        $pdf = PDF::loadView('14220.entry.pumpTestingISI.report_flow', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
    }

    public function delete(Request $request)
    {
        try {
            isi_14220_EntryPumpTest::where('fldpno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            isi_14220_Scale::where('fldpno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            return redirect()->route('14220_entryPumpTestISIFlow')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = isi_14220_Scale::where('fldpno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            return $isiScale[0];
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}