<?php

namespace App\Http\Controllers\ISI_6595\Entry\PumpTestingISI;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Entry\PumpTest\isi_6595_EntryPumpTest;
use App\Models\ISI_6595\Entry\PumpTest\isi_6595_EntryPumpTestReport;
use App\Models\ISI_6595\isi_6595_Connection;
use App\Models\ISI_6595\isi_6595_Scale;
use App\Models\ISI_6595\Master\isi_6595_MasterPowerGraph;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class EntryPumpTestingISI_Vol_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $entries = array();
            $allPumps = isi_6595_MasterPumpType::pluck('fldptype', 'fldsno');
            $allEntryValues = isi_6595_EntryPumpTest::where('fldver', 0)->pluck('fldsno', 'fldpno');
            // dd($allEntryValues);
            $pType = '';

            if (count($request->query()) > 0) {
                $pType = $request->query('oPumpType');
                $entries = isi_6595_EntryPumpTest::where('fldpno', '=', $request->query('oPumpNo'), 'and', 'fldsno', '=', $pType)->get();
                if (sizeof($entries) == 0) return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Data not exist!');
                return view('6595.entry.pumpTestingISI.volumetric', compact('allPumps', 'entries', 'allEntryValues', 'pType'));
            }
            // return view('6595.entry.pumpTestingISI.volumetric', compact('allPumps'));
            return view('6595.entry.pumpTestingISI.volumetric', compact('allPumps', 'allEntryValues'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {
                //
                $pumpCheck = isi_6595_MasterPumpType::where('fldsno', '=', $request->pumpType)->first();
                if ($pumpCheck == null) return redirect()->back()->with('status', 'Pump not exist!');

                $wmc = $request->wmc;
                $amc = $request->amc;
                $t2d = round(($pumpCheck->fldthead * 2) / 10, 2);

                $dataLength = $request->speed == null ? 0 : sizeof($request->speed);

                $pumpEntryLength = isi_6595_EntryPumpTest::select('id', 'fldread')->where('fldpno', '=', $request->pumpNo)
                    ->where('fldsno', '=', $pumpCheck->fldsno)->get();

                $pumpEntryLength = sizeof($pumpEntryLength);

                if ($dataLength < $pumpEntryLength) {
                    for ($i = 1; $i <= ($pumpEntryLength - $dataLength); $i++) {
                        isi_6595_EntryPumpTest::where('fldpno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                            ->where('fldread', '=', ($dataLength + $i))->delete();
                    }
                }

                $tblpio = isi_6595_MasterPowerGraph::where('fldptype', '=', $request->motorNo)->get();
                $tblpioLength = sizeof($tblpio);

                $x = array();
                $y = array();
                if ($tblpioLength > 0) {
                    $i = 0;
                    foreach ($tblpio as $pio) {
                        $x[$i] = $pio->fldx;
                        $y[$i] = $pio->fldy;
                        $i++;
                    }
                }

                for ($i = 0; $i < $dataLength; $i++) {
                    $SH = $request->vaccumGaugeReading[$i] * 0.0136;

                    if (round($request->time[$i], 1) == "0" || $request->time[$i] == "-") $Ad = 0;
                    else $Ad = ($request->collTankVol) / $request->time[$i];

                    $dd = 1 / ($pumpCheck->flddsize / 1000);
                    $ds = 1 / ($pumpCheck->fldssize / 1000);
                    $Vconst = (16 / (2 * 9.81 * pow(3.141592652, 2) * pow(1000, 2))) * (pow($dd, 4) - pow($ds, 4));
                    $Vch = pow($Ad, 2) * $Vconst; //v Correction Head
                    $DH = $request->pressureGaugeReading[$i] * 10;
                    $Th = $SH + $DH + $Vch + $request->gaugeDist;
                    $IP = (($request->watts1[$i] + $request->watts2[$i]) * $wmc) / 1000;
                    $fx = $IP;

                    // $this->pick($fx, $x, $y, $tblpioLength);
                    // call pick()

                    $startval = 0;
                    for ($j = 0; $j < $tblpioLength; $j++) {
                        if ($fx < $x[$j]) {
                            $startval = $j;
                            break;
                        }
                    }

                    $denominator = ($x[$i] - $x[$startval]) == 0 ? 1 : ($x[$i] - $x[$startval]);
                    $y1 = $y[$startval] + ($fx - $x[$startval]) * ((($y[$i] - $y[$startval])) / $denominator);
                    $y1 = round($y1, 2);

                    // end call pick()

                    if ($request->con == "Belt Drive - V")  $y1 = $y1 - ($y1 * 3 / 100);
                    else if ($request->con == "Belt Drive - F") $y1 = $y1 - ($y1 * 6 / 100);
                    // return redirect()->route('6595_entryPumpTestISIVol')->with('status', json_encode($y1));

                    // Calculation at rated speed
                    $Rth = pow(($request->ratedSpeed / $request->speed[$i]), 2) * $Th;
                    $t1s = round(($Rth * 1.5) / 10, 2);
                    $t2dm = round(($t1s * 10), 2);
                    $Rad = $request->ratedSpeed / $request->speed[$i] * $Ad;
                    // To Calculate Input Power
                    $rip = pow(($request->ratedSpeed / $request->speed[$i]), 3) * $y1;
                    $Rpop = $Rth * $Rad / 102;
                    $OE = $Rpop / $rip * 100;

                    $pumpEntryCheck = isi_6595_EntryPumpTest::where('fldpno', '=', $request->pumpNo)
                        ->where('fldsno', '=', $pumpCheck->fldsno)->where('fldread', '=', $i + 1)->first();

                    if ($pumpEntryCheck == null) $insert = new isi_6595_EntryPumpTest();
                    else $insert = isi_6595_EntryPumpTest::findOrFail($pumpEntryCheck->id);

                    $insert->fldpno = $request->pumpNo;
                    $insert->fldread = $i + 1;
                    $insert->fldsno = $pumpCheck->fldsno;
                    $insert->fldspeed = $request->speed[$i];
                    $insert->fldvguage = $request->vaccumGaugeReading[$i];
                    $insert->fldshead = $SH;
                    $insert->flddhead = $DH;
                    $insert->fldthead = $Th;
                    $insert->fldtime = $request->time[$i];
                    $insert->flddis = $Ad;
                    $insert->fldvolt = $request->voltage[$i];
                    $insert->fldcurr = $request->current[$i] * $amc;
                    $insert->fldw1 = $request->watts1[$i];
                    $insert->fldw2 = $request->watts2[$i];
                    $insert->fldrthead = $Rth;
                    $insert->fldrdis = $Rad;
                    $insert->fldop = $IP;
                    $insert->fldip = $y1;
                    $insert->fldfreq = $request->frequency[$i];
                    $insert->fldrspeed = $request->ratedSpeed;
                    $insert->fldht = $request->date;
                    $insert->fldipno = $request->inpassNo;
                    $insert->fldpguage = $request->pressureGaugeReading[$i];
                    $insert->fldvchead = $Vch;
                    $insert->fldgdist = $request->gaugeDist;
                    $insert->fldrip = $rip;
                    $insert->fldpop = $Rpop;
                    $insert->fldoeff = $OE;
                    $insert->fldwmc = $wmc;
                    $insert->fldamc = $amc;
                    $insert->fldvol = $request->collTankVol;
                    $insert->flddia = $request->impDia;
                    $insert->fldmno = $request->motorNo;
                    $insert->fld1_5 = $t1s;
                    $insert->fld2 = $t2d;
                    $insert->fld2m = $t2dm;
                    $insert->fldcon = $request->con;
                    $insert->fldver = false;

                    $insert->save();
                }

                $dataForScale = isi_6595_EntryPumpTest::where('fldpno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)
                    ->get([
                        DB::raw('max(fldrdis) as max_fldrdis'), DB::raw('max(fldoeff) as max_fldoeff'), DB::raw('max(fldrthead) as max_fldrthead'),
                        DB::raw('max(fldcurr) as max_fldcurr')
                    ]);


                $xaxis = round(($dataForScale[0]['max_fldrdis'] / 19), 2);
                $yaxis1 = round(($dataForScale[0]['max_fldoeff'] / 17), 2);
                $yaxis2 = round(($dataForScale[0]['max_fldrthead'] / 17), 2);
                $yaxis3 = round(($dataForScale[0]['max_fldcurr'] / 17), 2);

                $scale = isi_6595_Scale::where('fldpno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                if ($scale == null) $insert_scale = new isi_6595_Scale();

                else $insert_scale = isi_6595_Scale::where('fldpno', '=', $request->pumpNo)->where('fldsno', '=', $pumpCheck->fldsno)->first();

                $insert_scale->fldpno = $request->pumpNo;
                $insert_scale->fldsno = $pumpCheck->fldsno;
                $insert_scale->xaxis = round($xaxis, 2);
                $insert_scale->yaxis1 = round($yaxis1, 2);
                $insert_scale->yaxis2 = round($yaxis2, 2);
                $insert_scale->yaxis3 = round($yaxis3, 2);
                $insert_scale->save();

                $connection = isi_6595_Connection::where('fldpno', '=', $request->pumpNo)->where('fldptype', '=', $pumpCheck->fldptype)->first();

                if (
                    $connection == null
                ) $insert_connection = new isi_6595_Connection();

                else $insert_connection = isi_6595_Connection::where('fldpno', '=', $request->pumpNo)->where('fldptype', '=', $pumpCheck->fldptype)->first();

                $insert_connection->fldpno = $request->pumpNo;
                $insert_connection->fldptype = $pumpCheck->fldptype;
                $insert_connection->fldtype = $request->con;
                $insert_connection->save();

                return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Record saved successfully!');

                //
            } else return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Invalid Request!');
        } catch (Exception $ex) {
            // dd($ex);
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request, $pumpNo, $pumpName)
    {
        try {

            $pumpDetails = isi_6595_MasterPumpType::where('fldsno', '=', $pumpNo)->first();
            if ($pumpDetails == null) return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Pump not exist!');
            $entryDetails = isi_6595_EntryPumpTest::where('fldsno', '=', $pumpNo)->where('fldpno', '=', $pumpName)->get();
            if (sizeof($entryDetails) == 0) return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Pump data not exist!');

            $report = new isi_6595_EntryPumpTestReport();
            $report->truncate();

            foreach ($entryDetails as $entry) {
                $report = new isi_6595_EntryPumpTestReport();
                $report->fldpno = $entry->fldpno;
                $report->fldrspeed = $entry->fldrspeed;
                $report->fldht = $entry->fldht;
                $report->fldipno = $entry->fldipno;
                $report->fldgdist = $entry->fldgdist;
                $report->fldread = $entry->fldread;
                $report->fldspeed = $entry->fldspeed;
                $report->fldvguage = $entry->fldvguage;
                $report->fldpguage = $entry->fldpguage;
                $report->flddhead = $entry->flddhead;
                $report->fldshead = $entry->fldshead;
                $report->fldvchead = $entry->fldvchead;
                $report->fldthead = $entry->fldthead;
                $report->flddis = $entry->flddis;
                $report->fldop = $entry->fldop;
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
                $report->fldwmc = $entry->fldwmc;
                $report->fldamc = $entry->fldamc;
                $report->fldvol = $entry->fldvol;
                $report->fldmno = $entry->fldmno;
                $report->fld1_5 = $entry->fld1_5;
                $report->fldcon = $entry->fldcon;
                $report->flddia = $entry->flddia;
                $report->fld2 = $entry->fld2;
                $report->fld2m = $entry->fld2m;
                $report->fldhp = $pumpDetails->fldhp;
                $report->fldssize = $pumpDetails->fldssize;
                $report->flddsize = $pumpDetails->flddsize;
                $report->fldphase = $pumpDetails->fldphase;
                $report->fldrtemp = $pumpDetails->fldrtemp;
                $report->fldmcurr = $pumpDetails->fldmcurr;
                $report->flddthead = $pumpDetails->fldthead;
                $report->fldddis = $pumpDetails->flddis;
                $report->flddoeff = $pumpDetails->fldoeff;
                $report->fldheadr1 = $pumpDetails->fldheadr1;
                $report->fldheadr2 = $pumpDetails->fldheadr2;
                $report->flddfreq = $pumpDetails->fldfreq;
                $report->save();
            }

            $pumpData = isi_6595_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
            $tableData = isi_6595_EntryPumpTestReport::all();

            return view('6595.entry.pumpTestingISI.report_vol', compact('pumpData', 'tableData'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function create_pdf()
    {
        $pumpData = isi_6595_EntryPumpTestReport::orderBy('fldread', 'desc')->first();
        $tableData = isi_6595_EntryPumpTestReport::all();
        // view()->share('user', $pumpData);
        $pdf = PDF::loadView('6595.entry.pumpTestingISI.report_vol', compact('pumpData', 'tableData'))->setPaper('a3', 'landscape');

        return $pdf->download();
    }

    public function delete(Request $request)
    {
        try {
            isi_6595_EntryPumpTest::where('fldpno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            isi_6595_Scale::where('fldpno', '=', $request->deletePumpNo, 'and', 'fldsno', '=', $request->deletePumpType)->delete();
            return redirect()->route('6595_entryPumpTestISIVol')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function show($pumpNo = null, $pumpType = null)
    {
        try {
            // dd($pumpNo);
            $isiScale = isi_6595_Scale::where('fldpno', '=', $pumpNo, 'and', 'fldsno', '=', $pumpType)->orderBy('id', 'DESC')->limit(1)->get();
            if (count($isiScale) > 0) {
                return $isiScale[0];
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}