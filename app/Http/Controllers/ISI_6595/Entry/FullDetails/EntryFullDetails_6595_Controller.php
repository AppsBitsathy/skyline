<?php

namespace App\Http\Controllers\ISI_6595\Entry\FullDetails;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Entry\FullDetails\isi_6595_EntryFullDetails;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;

class EntryFullDetails_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $radioType = null, $typeValue = null)
    {
        try {
            $pumpDD = isi_6595_MasterPumpType::select('id', 'fldptype')->orderBy('id', 'asc')->get();

            $pumpNoDD = isi_6595_EntryFullDetails::select('id', 'fldpno')->get();

            $type = 'all';

            if ($radioType != null) {
                if ($typeValue != null) {
                    if ($radioType == 'pumpnowise') {
                        $tableData = isi_6595_EntryFullDetails::join('isi_6595__master_pump_types', 'isi_6595__entry_full_details.fldptype', '=', 'isi_6595__master_pump_types.id')
                            ->where('isi_6595__entry_full_details.id', '=', $typeValue)
                            ->get(['isi_6595__entry_full_details.*', 'isi_6595__master_pump_types.fldPtype']);
                        $type = 'pnowise';
                        return view('6595.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else if ($radioType == 'pumptypewise') {
                        $check = isi_6595_EntryFullDetails::select('*')->where('isi_6595__entry_full_details.fldptype', '=', $typeValue)->get();
                        if (count($check) != 0) {
                            $tableData = isi_6595_EntryFullDetails::join('isi_6595__master_pump_types', 'isi_6595__entry_full_details.fldptype', '=', 'isi_6595__master_pump_types.id')
                                ->where('isi_6595__master_pump_types.id', '=', $typeValue)
                                ->get(['isi_6595__entry_full_details.*', 'isi_6595__master_pump_types.fldPtype']);
                            $type = 'ptypewise';
                            return view('6595.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                        } else {
                            return redirect()->back()->with('status', 'No record for this pump');
                        }
                    } else {
                    }
                }
            }

            $tableData = isi_6595_EntryFullDetails::join('isi_6595__master_pump_types', 'isi_6595__entry_full_details.fldptype', '=', 'isi_6595__master_pump_types.id')
                ->get(['isi_6595__entry_full_details.*', 'isi_6595__master_pump_types.fldPtype']);

            return view('6595.entry.fullDetails.fullDetails', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                if ($request->id) {
                    $fullDetails = isi_6595_EntryFullDetails::findOrFail($request->id);
                    $msg = 'Record updated successfully!';
                } else {
                    $fullDetails = new isi_6595_EntryFullDetails();
                    $msg = 'Record saved successfully!';
                    $fullDetails->fldpno = $request->pno;
                    $fullDetails->fldptype = $request->pumpType;
                    $fullDetails->fldsno = $request->slno;
                }

                $fullDetails->fldrdis = $request->dis;
                $fullDetails->fldrthead = $request->th;
                $fullDetails->fldoeff = $request->ipow;
                $fullDetails->fldcur = $request->curr;
                $fullDetails->fldrotor = $request->rotor;
                $fullDetails->fldimp = $request->implore;
                $fullDetails->fldearth = $request->earth;
                $fullDetails->fldrotation = $request->rotation;
                $fullDetails->fldctest = $request->casingTest;
                $fullDetails->flddate = $request->date;
                $fullDetails->save();

                return redirect()->back()->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $req = $request;

                $tableData = isi_6595_EntryFullDetails::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                $pump = isi_6595_MasterPumpType::where('id', '=', $req->pumpId)->first();

                $d = array();
                $d['pumpId'] = $req->pumpId;
                $d['startDate'] = $req->startDate;
                $d['toDate'] = $req->toDate;

                return view('6595.entry.fullDetails.report', compact('tableData', 'pump', 'd'));
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                $req = $request;

                $tableData = isi_6595_EntryFullDetails::where('fldptype', '=', $req->pumpId)
                    ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                $pump = isi_6595_MasterPumpType::where('id', '=', $req->pumpId)->first();

                $d = array();
                $d['pumpId'] = $req->pumpId;
                $d['startDate'] = $req->startDate;
                $d['toDate'] = $req->toDate;

                $pdf = PDF::loadView('6595.entry.fullDetails.report', compact('tableData', 'pump', 'd'))->setPaper('a3', 'landscape');
                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {
                isi_6595_EntryFullDetails::where('id', '=', $request->input('deletePumpId'))->delete();
                return redirect()->route('6595_entryFullDetails')->with('status', 'Record Deleted!');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}