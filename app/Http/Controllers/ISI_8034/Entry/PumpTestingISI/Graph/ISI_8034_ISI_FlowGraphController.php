<?php

namespace App\Http\Controllers\ISI_8034\Entry\PumpTestingISI\Graph;

use App\Http\Controllers\Controller;
use App\Models\ISI_8034\Entry\isi_8034_EntryPumpTestGraphAddPrint;
use App\Models\ISI_8034\Entry\PumpTest\isi_8034_EntryPumpTest;
use App\Models\ISI_8034\isi_8034_Scale;
use App\Models\ISI_8034\Master\isi_8034_MasterPumpTypes;
use Exception;
use Illuminate\Http\Request;

class ISI_8034_ISI_FlowGraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            return view('8034.entry.pumpTestingISI.graphs.flow.g1', compact('isiGraphScale'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g1(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g1', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g2(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g2', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g3(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g3', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g4(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $flowmetricsValuesASC = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g4', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'flowmetricsValuesASC', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g5(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $flowmetricsValuesASC = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g5', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'flowmetricsValuesASC', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g6(Request $request)
    {
        try {
            $isiGraphScale = new isi_8034_Scale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = isi_8034_Scale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Flowmetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $flowmetricsValues = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $flowmetricsValuesASC = isi_8034_EntryPumpTest::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('8034.entry.pumpTestingISI.graphs.flow.g6', compact(['isiGraphScaleValues', 'flowmetricsValues', 'pumpValues', 'flowmetricsValuesASC', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function add_print(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    if (
                        empty($request->input('coPumpNo')) || empty($request->input('coPumpType')) || empty($request->input('addDis')) ||
                        empty($request->input('addTH')) || empty($request->input('addOeff')) || empty($request->input('addCurr'))
                    ) {
                        return redirect()->back()->with('status', 'Invalid Data. Check Observed Values');
                    }

                    $checkPump = isi_8034_MasterPumpTypes::where('fldsno', '=', $request->input('coPumpType'))->first();
                    if ($checkPump) {
                        isi_8034_EntryPumpTestGraphAddPrint::where('fldpno', '=', $request->input('coPumpNo'))
                            ->where('fldptype', '=', $request->input('coPumpType'))->delete();

                        $flow = isi_8034_EntryPumpTest::where('fldpno', '=', $request->input('coPumpNo'))
                            ->where('fldsno', '=', $request->input('coPumpType'))
                            ->first();

                        $addPrint = new isi_8034_EntryPumpTestGraphAddPrint();

                        $addPrint->fldpno = $request->input('coPumpNo');
                        $addPrint->fldptype = $request->input('coPumpType');
                        $addPrint->flddate = $flow->fldht;
                        $addPrint->flddis = $request->input('addDis');
                        $addPrint->fldthead = $request->input('addTH');
                        $addPrint->fldoeff = $request->input('addOeff');
                        $addPrint->fldcurr = $request->input('addCurr');
                        $addPrint->save();

                        return redirect()->back()->with('status', 'Record added into Report.');
                    } else {
                        return redirect()->back()->with('status', ' Pump not exist');
                    }
                } else {
                    return redirect()->back()->with('status', 'Invalid token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Try again!, Catch Error: ' . $ex->__toString());
        }
    }
}
