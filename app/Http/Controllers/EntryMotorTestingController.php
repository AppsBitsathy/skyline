<?php

namespace App\Http\Controllers;

use App\Models\EntryMotorReport;
use App\Models\EntryMotorTempMinp;
use App\Models\MasterMotorType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryMotorTestingController extends Controller
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

            $allMotorTestEntry = EntryMotorTempMinp::join('master_motor_types', 'entry_motor_temp_minps.fldmtype', '=', 'master_motor_types.id')
                ->get(['entry_motor_temp_minps.*', 'master_motor_types.fldmtype AS fldMotorType']);

            $allMotorsInpassDD = $allMotorTestEntry;
            $allMotorsDD = MasterMotorType::all();

            $type = 'all';

            if ($radioType) {
                if ($radioType == 'motortypewise') {
                    if ($typeValue != null) {
                        $check = EntryMotorTempMinp::select('*')->where('entry_motor_temp_minps.fldmtype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $allMotorTestEntry = EntryMotorTempMinp::join('master_motor_types', 'entry_motor_temp_minps.fldmtype', '=', 'master_motor_types.id')
                                ->where('master_motor_types.id', '=', $typeValue)
                                ->get(['entry_motor_temp_minps.*', 'master_motor_types.fldmtype as fldMotorType']);
                            $type = 'mtype';
                            return view('entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this motor');
                        }
                    }
                } else if ($radioType == 'motorinpasswise') {
                    if ($typeValue != null) {
                        $allMotorTestEntry = EntryMotorTempMinp::join('master_motor_types', 'entry_motor_temp_minps.fldmtype', '=', 'master_motor_types.id')
                            ->where('entry_motor_temp_minps.id', '=', $typeValue)
                            ->get(['entry_motor_temp_minps.*', 'master_motor_types.fldmtype as fldMotorType']);
                        $type = 'inpass';
                        return view('entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
                    }
                } else {
                    return view('entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD'));
                }
            }

            return view('entry.motorTesting.motorTesting', compact('allMotorTestEntry', 'allMotorsDD', 'allMotorsInpassDD', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!' . $ex->__toString());
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
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $motor = MasterMotorType::where('id', '=', $request->input('motorType'))->first();

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
                        $tbper = ($tb / $rt) * 100;
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
                        $motorMinp = EntryMotorTempMinp::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $motorMinp = new EntryMotorTempMinp();
                        $msg = 'Record saved successfully!';
                    }

                    $motorMinp->fldinpass = $request->input('ipNo');
                    $motorMinp->fldsno = $request->input('motorNo');
                    $motorMinp->fldmtype = $request->input('motorType');
                    $motorMinp->fldbeforehv = $request->input('irBeforeHV');
                    $motorMinp->fldafterhv = $request->input('irAfterHV');
                    $motorMinp->fldhvtest = $request->input('irhvTest');
                    $motorMinp->fldr1 = $request->input('rmr1');
                    $motorMinp->fldt1 = $request->input('rmt1');
                    $motorMinp->fldnlrvolts = $request->input('nlrVolts');
                    $motorMinp->fldcurrent = $request->input('nlrCurr');
                    $motorMinp->fldwatts = $request->input('nlrWatts');
                    $motorMinp->fldspeed = $request->input('nlrSpeed');
                    $motorMinp->fldfrequency = $request->input('nlrFreq');
                    $motorMinp->fldlrrvolts = $request->input('lrrVolts');
                    $motorMinp->fldlrrt1t2 = $request->input('lrrt1t2');
                    // $motorMinp->fldputvolts = $request->input('');
                    // $motorMinp->fldputt1t2 = $request->input('');
                    $motorMinp->fldr2 = $request->input('trtr2');
                    $motorMinp->fldt2 = $request->input('trtt2');
                    $motorMinp->fldbt240 = $request->input('trtbt2');
                    $motorMinp->fldr3 = $request->input('trtr3');
                    $motorMinp->fldt3 = $request->input('trtt3');
                    $motorMinp->fldbt204 = $request->input('trtbt3');
                    $motorMinp->fldlockedrotor = $tbper;
                    // $motorMinp->fldpullup = '';
                    $motorMinp->fldtrise240 = $tr240;
                    $motorMinp->fldtrise204 = $tr204;
                    $motorMinp->flddate = $request->input('date');
                    $motorMinp->fldcptb = $request->input('trtCasePrtb');
                    $motorMinp->save();

                    return redirect()->back()->with('status', $msg);
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal error. Try again!');
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

    public function view_custom_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token') != null) {
                $motorId = $request->input('motorId');
                $fromDate = $request->input('startDate');
                $toDate = $request->input('toDate');

                $motorType = MasterMotorType::where('id', '=', $motorId)->first();
                $motorType = $motorType['fldmtype'];
                $tableData = EntryMotorTempMinp::where('fldmtype', '=', $motorId)
                    ->whereBetween('flddate', [$fromDate, $toDate])->get();

                $this->storeReport($tableData, $motorType);

                return view('entry.motorTesting.custom_report', compact('tableData', 'motorType'));
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

                $tableData = EntryMotorTempMinp::where('id', '=', $inpassId)->get();
                $motorType = MasterMotorType::where('id', '=', $tableData[0]['fldmtype'])->first();
                $motorType = $motorType['fldmtype'];

                $this->storeReport($tableData, $motorType);

                return view('entry.motorTesting.report', compact('tableData', 'motorType'));
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function create_pdf_custom_report()
    {
        try {
            $tableData = EntryMotorReport::all();
            $motorType = $tableData[0]['fldmotorType'];

            $pdf = PDF::loadView('entry.motorTesting.custom_report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function create_pdf_report()
    {
        try {
            $tableData = EntryMotorReport::all();
            $motorType = $tableData[0]['fldmotorType'];

            $pdf = PDF::loadView('entry.motorTesting.report', compact('tableData', 'motorType'))->setPaper('a3', 'landscape');
            return $pdf->download();
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function storeReport($tableData, $motorType)
    {
        try {
            $report = new EntryMotorReport();
            $report->truncate();

            foreach ($tableData as $data) {
                $report = new EntryMotorReport();
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
            EntryMotorTempMinp::where('id', '=', $request->input('deleteMotorIpNoId'))->delete();
            return redirect()->route('entryMotorTesting')->with('status', 'Record Deleted!');
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