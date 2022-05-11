<?php

namespace App\Http\Controllers;

use App\Models\EntryFullDetails;
use App\Models\MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class EntryFullDetailsController extends Controller
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
        $pumpDD = MasterPumpType::select('id', 'fldPtype')->orderBy('id', 'asc')->get();

        $pumpNoDD = EntryFullDetails::select('id', 'fldpno')->get();

        $type = 'all';

        if ($radioType != null) {
            if ($typeValue != null) {
                if ($radioType == 'pumpnowise') {
                    $tableData = EntryFullDetails::join('master_pump_types', 'entry_full_details.fldptype', '=', 'master_pump_types.id')
                        ->where('entry_full_details.id', '=', $typeValue)
                        ->get(['entry_full_details.*', 'master_pump_types.fldPtype']);
                    $type = 'pnowise';
                    return view('entry.fullDetails.full_details', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                } else if ($radioType == 'pumptypewise') {
                    $check = EntryFullDetails::select('*')->where('entry_full_details.fldptype', '=', $typeValue)->get();
                    if (count($check) != 0) {
                        $tableData = EntryFullDetails::join('master_pump_types', 'entry_full_details.fldptype', '=', 'master_pump_types.id')
                            ->where('master_pump_types.id', '=', $typeValue)
                            ->get(['entry_full_details.*', 'master_pump_types.fldPtype']);
                        $type = 'ptypewise';
                        return view('entry.fullDetails.full_details', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
                    } else {
                        return redirect()->back()->with('status', 'No record for this pump');
                    }
                } else {
                }
            }
        }

        $tableData = EntryFullDetails::join('master_pump_types', 'entry_full_details.fldptype', '=', 'master_pump_types.id')
            ->get(['entry_full_details.*', 'master_pump_types.fldPtype']);

        // return view('entry.fullDetails.full_details', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));

        return view('entry.fullDetails.full_details', compact('pumpDD', 'pumpNoDD', 'tableData', 'type'));
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

                    // $pump = MasterPumpType::where('id', '=', $request->input('pumpType'))->first();
                    // $fldsno = $pump['fldsno'];

                    if ($request->input('id')) {
                        $fullDetails = EntryFullDetails::findOrFail($request->input('id'));
                        $msg = 'Record updated successfully!';
                    } else {
                        $fullDetails = new EntryFullDetails();
                        $msg = 'Record saved successfully!';
                    }

                    $fullDetails->fldsno = $request->input('slno');
                    $fullDetails->fldpno = $request->input('pno');
                    $fullDetails->fldptype = $request->input('pumpType');
                    $fullDetails->fldrdis = $request->input('dis');
                    $fullDetails->fldrthead = $request->input('th');
                    $fullDetails->fldoeff = $request->input('eff');
                    $fullDetails->fldcurr = $request->input('curr');
                    $fullDetails->flddate = $request->input('date');
                    $fullDetails->fldrotor = $request->input('rotor');
                    $fullDetails->fldimp = $request->input('implore');
                    $fullDetails->fldearth = $request->input('earth');
                    $fullDetails->fldrotation = $request->input('rotation');
                    $fullDetails->fldctest = $request->input('casingTest');
                    $fullDetails->save();

                    return redirect()->back()->with('status', $msg);
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
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

    public function view_report_page(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    $req = $request;

                    $tableData = EntryFullDetails::where('fldptype', '=', $req->pumpId)
                        ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                    $pump = MasterPumpType::where('id', '=', $req->pumpId)->first();

                    $d = array();
                    $d['pumpId'] = $req->pumpId;
                    $d['startDate'] = $req->startDate;
                    $d['toDate'] = $req->toDate;

                    return view('entry.fullDetails.report', compact('tableData', 'pump', 'd'));
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    $req = $request;

                    $tableData = EntryFullDetails::where('fldptype', '=', $req->pumpId)
                        ->whereBetween('flddate', [$req->startDate, $req->toDate])->get();
                    $pump = MasterPumpType::where('id', '=', $req->pumpId)->first();

                    $d = array();
                    $d['pumpId'] = $req->pumpId;
                    $d['startDate'] = $req->startDate;
                    $d['toDate'] = $req->toDate;

                    $pdf = PDF::loadView('entry.fullDetails.report', compact('tableData', 'pump', 'd'))->setPaper('a3', 'landscape');
                    return $pdf->download();
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error. Try Again!' . $ex->__toString());
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

    public function delete(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    EntryFullDetails::where('id', '=', $request->input('deletePumpId'))->delete();
                    return redirect()->route('entryFullDetails')->with('status', 'Record Deleted!');
                } else {
                    return redirect()->back()->with('status', 'Invalid Token');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid Request');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
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