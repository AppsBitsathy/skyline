<?php

namespace App\Http\Controllers\ISI_12225\Entry\MotorTesting;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\MotorTesting\isi_12225_EntryMotorTest;
use App\Models\ISI_12225\Entry\MotorTesting\isi_12225_EntryMotorTestReport;
use App\Models\isi_12225_MasterMotorType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryMotorTesting_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {

            $allMotorTestEntry = isi_12225_EntryMotorTest::join('isi_12225__master_motor_types', 'isi_12225__entry_motor_tests.fldmtype', '=', 'isi_12225__master_motor_types.id')
                ->get(['isi_12225__entry_motor_tests.*', 'isi_12225__master_motor_types.fldmtype AS fldMotorType']);

            $allMotorsInpassDD = $allMotorTestEntry;
            $allMotorsDD = isi_12225_MasterMotorType::all();

            $type = 'all';

            if ($radioType) {
                if ($radioType == 'motortypewise') {
                    if ($typeValue != null) {
                        $check = isi_12225_EntryMotorTest::select('*')->where('isi_12225__entry_motor_tests.fldmtype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $allMotorTestEntry = isi_12225_EntryMotorTest::join('isi_12225__master_motor_types', 'isi_12225__entry_motor_tests.fldmtype', '=', 'isi_12225__master_motor_types.id')
                                ->where('isi_12225__master_motor_types.id', '=', $typeValue)
                                ->get(['isi_12225__entry_motor_tests.*', 'isi_12225__master_motor_types.fldmtype as fldMotorType']);
                            $type = 'mtype';
                            return view('12225.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                        } else return redirect()->back()->with('status', 'No record for this motor');
                    }
                } else if ($radioType == 'motorinpasswise') {
                    if ($typeValue != null) {
                        $allMotorTestEntry = isi_12225_EntryMotorTest::join('isi_12225__master_motor_types', 'isi_12225__entry_motor_tests.fldmtype', '=', 'isi_12225__master_motor_types.id')
                            ->where('isi_12225__entry_motor_tests.id', '=', $typeValue)
                            ->get(['isi_12225__entry_motor_tests.*', 'isi_12225__master_motor_types.fldmtype as fldMotorType']);
                        $type = 'inpass';
                        return view('12225.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                    }
                } else return view('12225.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD'));
            }

            return view('12225.entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $motor = isi_12225_MasterMotorType::where('id', '=', $request->input('motorType'))->first();

                    // Rated Torque RT
                    $rt = ((955.4 * $motor->fldpower) / $motor->fldspeed);

                    $tb = '';

                    $lrrVolts = $request->input('lrrVolts');
                    $lrrt1t2 = $request->input('lrrt1t2');

                    if ($lrrVolts == '-') {
                        $tb = '-';
                    } else if ($lrrVolts == "--") {
                        $tb  = "--";
                    } else if ($lrrVolts == "---") {
                        $tb  = "---";
                    } else if ($lrrVolts == "----") {
                        $tb  = "----";
                    } else if ($lrrVolts == "-----") {
                        $tb  = "-----";
                    } else if ($lrrVolts == "------") {
                        $tb  = "------";
                    } else if ($lrrVolts == "-------") {
                        $tb  = "-------";
                    } else if ($lrrVolts == "--------") {
                        $tb  = "--------";
                    } else {
                        $tb = (pow(($motor->fldvoltage / $lrrVolts), 2) * $lrrt1t2) * $motor->fldarmlength;
                        // Locked Rotor Reading in percentage
                        $hpconst = ($motor->fldhp * 4500) / (2 * 3.14 * $motor->fldspeed);
                        $tbper = ($tb / $hpconst) * 100;
                        $tbper = round($tbper, 2);
                    }

                    $r1 = $request->input('rmr1');
                    $t1 = $request->input('rmt1');
                    $r2 = $request->input('trtr2');
                    $t2 = $request->input('trtt2');
                    $tr240 = '';

                    if ($r2 == '-') {
                        $tr240 = '-';
                    } else if ($r2 == "--") {
                        $tr240  = "--";
                    } else if ($r2 == "---") {
                        $tr240  = "---";
                    } else if ($r2 == "----") {
                        $tr240  = "----";
                    } else if ($r2 == "-----") {
                        $tr240  = "-----";
                    } else if ($r2 == "------") {
                        $tr240  = "------";
                    } else if ($r2 == "-------") {
                        $tr240  = "-------";
                    } else if ($r2 == "--------") {
                        $tr240  = "--------";
                    } else {
                        $tr240 = (($r2 / $r1) * (235 + $t1)) - (235 + $t2);
                        $tr240 = round($tr240, 2);
                    }

                    $r3 = $request->input('trtr3');
                    $t3 = $request->input('trtt3');
                    $tr204 = '-';

                    if ($r3 == '-') {
                        $tr204 = '-';
                    } else if ($r3 == "--") {
                        $tr204  = "--";
                    } else if ($r3 == "---") {
                        $tr204  = "---";
                    } else if ($r3 == "----") {
                        $tr204  = "----";
                    } else if ($r3 == "-----") {
                        $tr204  = "-----";
                    } else if ($r3 == "------") {
                        $tr204  = "------";
                    } else if ($r3 == "-------") {
                        $tr204  = "-------";
                    } else if ($r3 == "--------") {
                        $tr204  = "--------";
                    } else {
                        $tr204 = (($r3 / $r1) * (235 + $t1)) - (235 + $t3);
                        $tr204 = round($tr204, 2);
                    }

                    if ($request->input('id')) {
                        $motorTest = isi_12225_EntryMotorTest::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $motorTest = new isi_12225_EntryMotorTest();
                        $msg = 'Record saved successfully!';
                    }

                    $motorTest->fldinpass = $request->input('ipNo');
                    $motorTest->fldsno = $request->input('serialNo');
                    $motorTest->fldmtype = $request->input('motorType');
                    $motorTest->fldbeforehv = $request->input('irBeforeHV');
                    $motorTest->fldafterhv = $request->input('irAfterHV');
                    $motorTest->fldhvtest = $request->input('irhvTest');
                    $motorTest->fldr1 = $request->input('rmr1');
                    $motorTest->fldt1 = $request->input('rmt1');
                    $motorTest->fldnlrvolts = $request->input('nlrVolts');
                    $motorTest->fldcurrent = $request->input('nlrCurr');
                    $motorTest->fldwatts = $request->input('nlrWatts');
                    $motorTest->fldspeed = $request->input('nlrSpeed');
                    $motorTest->fldfrequency = $request->input('nlrFreq');
                    $motorTest->fldlrrvolts = $request->input('lrrVolts');
                    $motorTest->fldlrrt1t2 = $request->input('lrrt1t2');
                    // $motorTest->fldputvolts = $request->input('');
                    // $motorTest->fldputt1t2 = $request->input('');
                    $motorTest->fldr2 = $request->input('trtr2');
                    $motorTest->fldt2 = $request->input('trtt2');
                    $motorTest->fldbt240 = $request->input('trtbt2');
                    $motorTest->fldr3 = $request->input('trtr3');
                    $motorTest->fldt3 = $request->input('trtt3');
                    $motorTest->fldbt204 = $request->input('trtbt3');
                    $motorTest->fldlockedrotor = $tbper;
                    // $motorTest->fldpullup = '';
                    $motorTest->fldtrise240 = $tr240;
                    $motorTest->fldtrise204 = $tr204;
                    $motorTest->flddate = $request->input('date');
                    $motorTest->fldcptb = $request->input('trtCasePrtb');
                    $motorTest->save();

                    return redirect()->back()->with('status', $msg);
                } else return redirect()->back()->with('status', 'Invalid Token');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!');
        }
    }

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token') != null) {
                $motorId = $request->input('motorId');
                $fromDate = $request->input('startDate');
                $toDate = $request->input('toDate');

                $motorType = isi_12225_MasterMotorType::where('id', '=', $motorId)->first();
                $motorType = $motorType['fldmtype'];
                $tableData = isi_12225_EntryMotorTest::where('fldmtype', '=', $motorId)
                    ->whereBetween('flddate', [$fromDate, $toDate])->get();

                $this->storeReport($tableData, $motorType);

                return view('12225.entry.motorTesting.custom_report', compact('tableData', 'motorType'));
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token') != null) {
                $inpassId = $request->input('reportInpassId');

                $tableData = isi_12225_EntryMotorTest::where('id', '=', $inpassId)->get();
                $motorType = isi_12225_MasterMotorType::where('id', '=', $tableData[0]['fldmtype'])->first();
                $motorType = $motorType['fldmtype'];

                $this->storeReport($tableData, $motorType);

                return view('12225.entry.motorTesting.report', compact('tableData', 'motorType'));
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function create_pdf_custom_report()
    {
        try {
            $tableData = isi_12225_EntryMotorTestReport::all();
            $motorType = $tableData[0]['fldmotorType'];

            $pdf = PDF::loadView('12225.entry.motorTesting.custom_report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function create_pdf_report()
    {
        try {
            $tableData = isi_12225_EntryMotorTestReport::all();
            $motorType = $tableData[0]['fldmotorType'];

            $pdf = PDF::loadView('12225.entry.motorTesting.report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function storeReport($tableData, $motorType)
    {
        try {
            $report = new isi_12225_EntryMotorTestReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new isi_12225_EntryMotorTestReport();
                $report->fldmotorType = $motorType;
                $report->fldinpass = $data->fldinpass;
                $report->fldsno = $data->fldsno;
                $report->fldmtype = $data->fldmtype;
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
                $report->fldputvolts = $data->fldputvolts;
                $report->fldputt1t2 = $data->fldputt1t2;
                $report->fldr2 = $data->fldr2;
                $report->fldt2 = $data->fldt2;
                $report->fldbt240 = $data->fldbt240;
                $report->fldr3 = $data->fldr3;
                $report->fldt3 = $data->fldt3;
                $report->fldbt204 = $data->fldbt204;
                $report->fldlockedrotor = $data->fldlockedrotor;
                $report->fldpullup = $data->fldpullup;
                $report->fldtrise240 = $data->fldtrise240;
                $report->fldtrise204 = $data->fldtrise204;
                $report->flddate = $data->flddate;
                $report->fldcptb = $data->fldcptb;
                $report->save();
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {
            isi_12225_EntryMotorTest::where('id', '=', $request->input('deleteMotorIpNoId'))->delete();
            return redirect()->route('12225_entryMotorTesting')->with('status', 'Record Deleted!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}