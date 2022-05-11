<?php

namespace App\Http\Controllers\ISI_6595\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Master\isi_6595_MasterPowerGraph;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class MasterPowerGraph_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            if ($request->input()) {
                $pump = $request->input('oPumpType');
                $pumps = isi_6595_MasterPowerGraph::groupBy('fldptype')->get();
                $entries = isi_6595_MasterPowerGraph::where('fldptype', '=', $pump)->get();
                return view('6595.master.powerGraph', compact('pumps', 'entries'));
            }

            $pumps = isi_6595_MasterPowerGraph::groupBy('fldptype')->get();
            return view('6595.master.powerGraph', compact('pumps'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $dataLength = sizeof($request->poweri);

                $pumpEntryLength = isi_6595_MasterPowerGraph::select('id', 'fldread')->where('fldptype', '=', $request->motorRefNo)->get();

                $pumpEntryLength = sizeof($pumpEntryLength);

                if ($dataLength < $pumpEntryLength) {
                    for ($i = 1; $i <= ($pumpEntryLength - $dataLength); $i++) {
                        isi_6595_MasterPowerGraph::where('fldptype', '=', $request->motorRefNo)->where('fldread', '=', ($dataLength + $i))->delete();
                    }
                }

                for ($i = 0; $i < $dataLength; $i++) {
                    $pumpEntryCheck = isi_6595_MasterPowerGraph::where('fldptype', '=', $request->motorRefNo)->where('fldread', '=', $i + 1)->first();

                    if ($pumpEntryCheck == null) {
                        $insert = new isi_6595_MasterPowerGraph();
                        $msg = 'Record saved successfully!';
                    } else {
                        $insert = isi_6595_MasterPowerGraph::findOrFail($pumpEntryCheck->id);
                        $msg = 'Record updated successfully!';
                    }

                    $insert->fldptype = $request->motorRefNo;
                    $insert->fldspeed = $request->speed;
                    $insert->fldread = $i + 1;
                    $insert->fldhp = $request->hpkw;
                    $insert->fldx = $request->poweri[$i];
                    $insert->fldy = $request->powero[$i];
                    $insert->save();
                } // end for loop

                return redirect()->route('6595_masterPowerGraph')->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid Response!');
        } catch (Exception $ex) {
        } {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {

        try {
            if ($request->isMethod('post') && $request->_token) {

                $tableData = isi_6595_MasterPowerGraph::where('fldptype', '=', $request->reportPumpType)->get();

                return view('6595.master.powerGraphReport', compact('tableData'));
            } else return redirect()->back()->with('status', 'Invalid request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {
                $tableData = isi_6595_MasterPowerGraph::where('fldptype', '=', $request->reportPumpType)->get();
                // view()->share('user', $pumpData);
                $pdf = PDF::loadView('6595.master.powerGraphReport', compact('tableData'))->setPaper('a3', 'landscape');

                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error!' . $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {

            if ($request->isMethod('post') && $request->_token) {
                isi_6595_MasterPowerGraph::where('fldptype', '=', $request->deletePumpType)->delete();
                return redirect()->route('6595_masterPowerGraph')->with('status', 'Record deleted!');
            } else return redirect()->back()->with('status', 'Invalid Response!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function graph(Request $request){
        try {
            if ($request->query()) {
                $pump = $request->query('oPumpType');
                $pumps = isi_6595_MasterPowerGraph::groupBy('fldptype')->get();
                $entries = isi_6595_MasterPowerGraph::where('fldptype', '=', $pump)->get();
                return view('6595.master.showPowerGraph', compact('pumps', 'entries'));
            }

            $pumps = isi_6595_MasterPowerGraph::groupBy('fldptype')->get();
            return view('6595.master.showPowerGraph', compact('pumps'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }
}