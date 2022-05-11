<?php

namespace App\Http\Controllers\ISI_12225\Entry\FullDetails;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\FullDetails\isi_12225_EntryFullDetails;
use App\Models\isi_12225_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryFullDetails_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {
            $pumpDD = isi_12225_MasterPumpType::select('id', 'fldptype')->orderBy('id', 'asc')->get();

            $pumpNoDD = isi_12225_EntryFullDetails::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_12225_EntryFullDetails::join('isi_12225__master_pump_types', 'isi_12225__entry_full_details.fldptype', '=', 'isi_12225__master_pump_types.id')
                            ->where('isi_12225__entry_full_details.id', '=', $typeValue)
                            ->get(['isi_12225__entry_full_details.*', 'isi_12225__master_pump_types.fldPtype']);
                        $type = 'pnowise';
                        return view('12225.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_12225_EntryFullDetails::select('*')->where('isi_12225__entry_full_details.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_12225_EntryFullDetails::join('isi_12225__master_pump_types', 'isi_12225__entry_full_details.fldptype', '=', 'isi_12225__master_pump_types.id')
                                ->where('isi_12225__master_pump_types.id', '=', $typeValue)
                                ->get(['isi_12225__entry_full_details.*', 'isi_12225__master_pump_types.fldPtype']);
                            $type = 'ptypewise';
                            return view('12225.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_12225_EntryFullDetails::join('isi_12225__master_pump_types', 'isi_12225__entry_full_details.fldptype', '=', 'isi_12225__master_pump_types.id')
                ->get(['isi_12225__entry_full_details.*', 'isi_12225__master_pump_types.fldPtype']);

            return view('12225.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                if ($request->input('id')) {
                    $fullDetails = isi_12225_EntryFullDetails::findOrFail($request->input('id'));
                    $msg = 'Record updated successfully!';
                } else {
                    $fullDetails = new isi_12225_EntryFullDetails();
                    $msg = 'Record saved successfully!';
                    $fullDetails->fldpno = $request->input('pno');
                    $fullDetails->fldptype = $request->input('pumpType');
                    $fullDetails->fldsno = $request->input('slno');
                }

                $fullDetails->fldrdis = $request->input('dis');
                $fullDetails->fldrthead = $request->input('th');
                $fullDetails->fldrdlwl = $request->input('dlwl');
                $fullDetails->fldrip = $request->input('ipow');
                $fullDetails->fldcurr = $request->input('curr');
                $fullDetails->fldrotor = $request->input('rotor');
                $fullDetails->fldimp = $request->input('implore');
                $fullDetails->fldearth = $request->input('earth');
                $fullDetails->fldrotation = $request->input('rotation');
                $fullDetails->fldctest = $request->input('casingTest');
                $fullDetails->flddate = $request->input('date');
                $fullDetails->save();

                return redirect()->back()->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $req = $request;

                $tableData = isi_12225_EntryFullDetails::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                $pump = isi_12225_MasterPumpType::where('id', '=', $req->pumpId)->first();

                $d = array();
                $d['pumpId'] = $req->pumpId;
                $d['startDate'] = $req->startDate;
                $d['toDate'] = $req->toDate;

                return view('12225.entry.fullDetails.report', compact('tableData', 'pump', 'd'));
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $req = $request;

                $tableData = isi_12225_EntryFullDetails::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                $pump = isi_12225_MasterPumpType::where('id', '=', $req->pumpId)->first();

                $d = array();
                $d['pumpId'] = $req->pumpId;
                $d['startDate'] = $req->startDate;
                $d['toDate'] = $req->toDate;

                $pdf = PDF::loadView('12225.entry.fullDetails.report', compact('tableData', 'pump', 'd'))->setPaper('a3', 'landscape');
                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                isi_12225_EntryFullDetails::where('id', '=', $request->input('deletePumpId'))->delete();
                return redirect()->route('12225_entryFullDetails')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}