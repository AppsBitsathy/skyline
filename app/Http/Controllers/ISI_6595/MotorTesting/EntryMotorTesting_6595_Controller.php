<?php

namespace App\Http\Controllers\ISI_6595\MotorTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Master\isi_6595_MasterMotorType;
use App\Models\ISI_6595\MotorTesting\isi_6595_EntryMotorTest;
use App\Models\ISI_6595\MotorTesting\isi_6595_EntryMotorTestReport;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryMotorTesting_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {
            $allMotorTestEntry = isi_6595_EntryMotorTest::join('isi_6595__master_motor_types', 'isi_6595__entry_motor_tests.fldmtype', '=', 'isi_6595__master_motor_types.id')
                ->get(['isi_6595__entry_motor_tests.*', 'isi_6595__master_motor_types.fldmtype AS fldMotorType']);

            $allMotorsInpassDD = $allMotorTestEntry;
            $allMotorsDD = isi_6595_MasterMotorType::all();

            $type = 'all';

            if ($radioType) {
                if ($radioType == 'motortypewise') {
                    if ($typeValue != null) {
                        $check = isi_6595_EntryMotorTest::select('*')->where('isi_6595__entry_motor_tests.fldmtype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $allMotorTestEntry = isi_6595_EntryMotorTest::join('isi_6595__master_motor_types', 'isi_6595__entry_motor_tests.fldmtype', 'isi_6595__master_motor_types.id')
                                ->where('isi_6595__master_motor_types.id', $typeValue)
                                ->get(['isi_6595__entry_motor_tests.*', 'isi_6595__master_motor_types.fldmtype as fldMotorType']);
                            $type = 'mtype';
                            return view('6595.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                        } else return redirect()->back()->with('status', 'No record for this motor');
                    }
                } else if ($radioType == 'motorinpasswise') {
                    if ($typeValue != null) {
                        $allMotorTestEntry = isi_6595_EntryMotorTest::join('isi_6595__master_motor_types', 'isi_6595__entry_motor_tests.fldmtype', 'isi_6595__master_motor_types.id')
                            ->where('isi_6595__entry_motor_tests.id', $typeValue)
                            ->get(['isi_6595__entry_motor_tests.*', 'isi_6595__master_motor_types.fldmtype as fldMotorType']);
                        $type = 'inpass';
                        return view('6595.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                    }
                } else return view('6595.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD'));
            }

            return view('6595.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
            // return view('6595.entry.motorTesting.motorTesting');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                $motor = isi_6595_MasterMotorType::where('id', '=', $request->motorType)->first();

                // Rated Torque RT
                $rt = ((955.4 * $motor->fldpower) / $motor->fldspeed);

                $tb = '';

                $lrrVolts = $request->lrrVolts;
                $lrrt1t2 = $request->lrrt1t2;

                if ($lrrVolts == '-') $tb = '-';
                else if ($lrrVolts == "--") $tb  = "--";
                else if ($lrrVolts == "---") $tb  = "---";
                else if ($lrrVolts == "----") $tb  = "----";
                else if ($lrrVolts == "-----") $tb  = "-----";
                else if ($lrrVolts == "------") $tb  = "------";
                else if ($lrrVolts == "-------") $tb  = "-------";
                else if ($lrrVolts == "--------") $tb  = "--------";
                else {
                    $tb = (pow(($motor->fldvoltage / $lrrVolts), 2) * $lrrt1t2) * $motor->fldarmlength;
                    // Locked Rotor Reading in percentage
                    $tbper = round(($tb / $rt) * 100, 2);
                }

                $r1 = $request->rmr1;
                $t1 = $request->rmt1;
                $r2 = $request->trtr2;
                $t2 = $request->trtt2;
                $tr240 = '';

                if ($r2 == '-') $tr240 = '-';
                else if ($r2 == "--") $tr240  = "--";
                else if ($r2 == "---") $tr240  = "---";
                else if ($r2 == "----") $tr240  = "----";
                else if ($r2 == "-----") $tr240  = "-----";
                else if ($r2 == "------") $tr240  = "------";
                else if ($r2 == "-------") $tr240  = "-------";
                else if ($r2 == "--------") $tr240  = "--------";
                else {
                    $tr240 = (($r2 / $r1) * (235 + $t1)) - (235 + $t2);
                    $tr240 = round($tr240, 2);
                }

                $r3 = $request->trtr3;
                $t3 = $request->trtt3;
                $tr204 = '-';

                if ($r3 == '-') $tr204 = '-';
                else if ($r3 == "--") $tr204  = "--";
                else if ($r3 == "---") $tr204  = "---";
                else if ($r3 == "----") $tr204  = "----";
                else if ($r3 == "-----") $tr204  = "-----";
                else if ($r3 == "------") $tr204  = "------";
                else if ($r3 == "-------") $tr204  = "-------";
                else if ($r3 == "--------") $tr204  = "--------";
                else {
                    $tr204 = (($r3 / $r1) * (235 + $t1)) - (235 + $t3);
                    $tr204 = round($tr204, 2);
                }

                if ($request->id) {
                    $motorTest = isi_6595_EntryMotorTest::findOrFail($request->id);
                    $msg = 'Record updated successfully!';
                } else {
                    $motorTest = new isi_6595_EntryMotorTest();
                    $msg = 'Record saved successfully!';
                }

                $motorTest->fldinpass = $request->ipNo;
                $motorTest->fldsno = $request->serialNo;
                $motorTest->fldmtype = $request->motorType;
                $motorTest->fldbeforehv = $request->irBeforeHV;
                $motorTest->fldafterhv = $request->irAfterHV;
                $motorTest->fldhvtest = $request->irhvTest;
                $motorTest->fldr1 = $request->rmr1;
                $motorTest->fldt1 = $request->rmt1;
                $motorTest->fldnlrvolts = $request->nlrVolts;
                $motorTest->fldcurrent = $request->nlrCurr;
                $motorTest->fldwatts = $request->nlrWatts;
                $motorTest->fldspeed = $request->nlrSpeed;
                $motorTest->fldfrequency = $request->nlrFreq;
                $motorTest->fldlrrvolts = $request->lrrVolts;
                $motorTest->fldlrrt1t2 = $request->lrrt1t2;
                // $motorTest->fldputvolts = $request->ptrVolts;
                // $motorTest->fldputt1t2 = $request->ptrt1t2;
                $motorTest->fldr2 = $request->trtr2;
                $motorTest->fldt2 = $request->trtt2;
                $motorTest->fldbt240 = $request->trtbt2;
                $motorTest->fldr3 = $request->trtr3;
                $motorTest->fldt3 = $request->trtt3;
                $motorTest->fldbt204 = $request->trtbt3;
                $motorTest->fldlockedrotor = $tbper;
                // $motorTest->fldpullup = $ptper;
                $motorTest->fldtrise240 = $tr240;
                $motorTest->fldtrise204 = $tr204;
                $motorTest->fldcptb = $request->trtCasePrtb;
                $motorTest->flddate = $request->date;
                $motorTest->save();

                return redirect()->route('6595_entryMotorTesting')->with('status', $msg);
            } else return redirect()->route('6595_entryMotorTesting')->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token') != null) {
                $motorId = $request->motorId;
                $fromDate = $request->startDate;
                $toDate = $request->toDate;

                $motorType = isi_6595_MasterMotorType::where('id', $motorId)->first();
                $motorType = $motorType->fldmtype;
                $tableData = isi_6595_EntryMotorTest::where('fldmtype', $motorId)
                    ->whereBetween('flddate', [$fromDate, $toDate])->get();

                $this->storeReport($tableData, $motorType, $fromDate, $toDate);

                $tableData = isi_6595_EntryMotorTestReport::all();

                return view('6595.entry.motorTesting.custom_report', compact('tableData', 'motorType'));
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_custom_report()
    {
        try {
            $tableData = isi_6595_EntryMotorTestReport::all();
            $motorType = $tableData[0]->fldmtype;

            $pdf = PDF::loadView('6595.entry.motorTesting.custom_report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token') != null) {
                $inpassId = $request->reportInpassId;

                $tableData = isi_6595_EntryMotorTest::where('id', $inpassId)->get();
                $motorType = isi_6595_MasterMotorType::where('id', $tableData[0]['fldmtype'])->first();
                $motorType = $motorType->fldmtype;

                $this->storeReport($tableData, $motorType);

                $tableData = isi_6595_EntryMotorTestReport::all();

                return view('6595.entry.motorTesting.report', compact('tableData', 'motorType'));
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report()
    {
        try {
            $tableData = isi_6595_EntryMotorTestReport::all();
            $motorType = $tableData[0]->fldmtype;

            $pdf = PDF::loadView('6595.entry.motorTesting.report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function storeReport($tableData, $motorType, $fromDate = null, $toDate = null)
    {
        try {
            $report = new isi_6595_EntryMotorTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_6595_EntryMotorTestReport();
                $report->fldinpass = $data->fldinpass;
                $report->fldmtype = $motorType;
                $report->fldsno = $data->fldsno;
                $report->fldbeforehv = $data->fldbeforehv;
                $report->fldafterhv = $data->fldafterhv;
                $report->fldhvtest = $data->fldhvtest;
                $report->fldr1 = $data->fldr1;
                $report->fldt1 = $data->fldt1;
                $report->fldnlrvolts = $data->fldnlrvolts;
                $report->fldcurrent = $data->fldcurrent;
                $report->fldwatts = $data->fldwatts;
                $report->fldspeed = $data->fldspeed;
                $report->fldfrequency = $data->fldfrequency;
                $report->fldlrrvolts = $data->fldlrrvolts;
                $report->fldlrrt1t2 = $data->fldlrrt1t2;
                // $report->fldputvolts = $data->fldputvolts;
                // $report->fldputt1t2 = $data->fldputt1t2;
                $report->fldr2 = $data->fldr2;
                $report->fldt2 = $data->fldt2;
                $report->fldbt240 = $data->fldbt240;
                $report->fldr3 = $data->fldr3;
                $report->fldt3 = $data->fldt3;
                $report->fldbt204 = $data->fldbt204;
                $report->fldlockedrotor = $data->fldlockedrotor;
                // $report->fldpullup = $data->fldpullup;
                $report->fldtrise240 = $data->fldtrise240;
                $report->fldtrise204 = $data->fldtrise204;
                $report->fldcptb = $data->fldcptb;
                $report->flddate = $data->flddate;
                if ($fromDate != null) $report->fldfdate = $fromDate;
                if ($toDate != null) $report->fldtdate = $toDate;
                $report->save();
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function delete(Request $request)
    {
        try {
            isi_6595_EntryMotorTest::where('id', '=', $request->input('deleteMotorIpNoId'))->delete();
            return redirect()->route('6595_entryMotorTesting')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}