<?php

namespace App\Http\Controllers;

use App\Models\EntryPumpTestRDGraphAddPrint;
use App\Models\MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportPumpObservedController extends Controller
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

    public function index()
    {
        $pumpDD = MasterPumpType::select('fldsno', 'fldPtype')->orderBy('id', 'asc')->get();

        return view('report.pumpObserved', compact('pumpDD'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function get_report(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $pumpType = $request->input('pumpType');

                    $pump = MasterPumpType::where('fldsno', '=', $pumpType)->first();

                    $dataList = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    return view('report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate'));
                } else {
                    return redirect()->back()->with('status', "Invalid token");
                }
            } else {
                return redirect()->back()->with('status', "Invalid request");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! " . $ex->__toString());
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $pumpType = $request->input('pumpType');

                    $pump = MasterPumpType::where('fldsno', '=', $pumpType)->first();

                    $dataList = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $pdf = PDF::loadView('report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
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
        //
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