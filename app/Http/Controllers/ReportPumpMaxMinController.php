<?php

namespace App\Http\Controllers;

use App\Models\EntryPumpTestRDGraphAddPrint;
use App\Models\MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReportPumpMaxMinController extends Controller
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
        try {
            return view('report.pumpMaxMin');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! $ex");
        }
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

                    $dataList = EntryPumpTestRDGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    // return view('report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));

                    return view('report.pumpMaxMin', compact('observed_list', 'startDate', 'toDate'));
                } else {
                    return redirect()->back()->with('status', "Invalid token");
                }
            } else {
                return redirect()->back()->with('status', "Invalid request");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! ");
        }
    }

    public function view_report(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');

                    $dataList = EntryPumpTestRDGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);


                    return view('report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));
                } else {
                    return redirect()->back()->with('status', "Invalid token");
                }
            } else {
                return redirect()->back()->with('status', "Invalid request");
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! ");
        }
    }

    public function create_pdf_report(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');

                    $dataList = EntryPumpTestRDGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    $pdf = PDF::loadView('report.minMaxReport', compact('observed_list', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
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

    public function get_pump_type_name($sno)
    {
        $pumpName = MasterPumpType::select('fldPtype')->where('fldsno', '=', $sno)->first();
        return $pumpName->fldPtype;
    }

    public function fetch_report($dataList, $startDate, $toDate)
    {
        $observed_list = array();

        foreach ($dataList as $dataObj) {
            $data = (object) array();

            // discharge
            $disMax = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('flddis');

            $disMaxPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMax)->first();

            $disMin = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('flddis');

            $disMinPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMin)->first();

            // total head
            $thMax = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldthead');

            $thMaxPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMax)->first();

            $thMin = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldthead');

            $thMinPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMin)->first();

            // oeff
            $oeffMax = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldoeff');

            $oeffMaxPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldoeff', '=', $oeffMax)->first();

            $oeffMin = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldoeff');

            $oeffMinPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldoeff', '=', $oeffMin)->first();

            // curr
            $currMax = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldcurr');

            $currMaxPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldcurr', '=', $currMax)->first();

            $currMin = EntryPumpTestRDGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldcurr');

            $currMinPno = EntryPumpTestRDGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldcurr', '=', $currMin)->first();

            $data->pumptype = $this->get_pump_type_name($dataObj->fldptype);

            $data->dismax = $disMax;
            $data->dismaxpno = $disMaxPno->fldpno;
            $data->dismin = $disMin;
            $data->disminpno = $disMinPno->fldpno;

            $data->thmax = $thMax;
            $data->thmaxpno = $thMaxPno->fldpno;
            $data->thmin = $thMin;
            $data->thminpno = $thMinPno->fldpno;

            $data->oeffmax = $oeffMax;
            $data->oeffmaxpno = $oeffMaxPno->fldpno;
            $data->oeffmin = $oeffMin;
            $data->oeffminpno = $oeffMinPno->fldpno;

            $data->currmax = $currMax;
            $data->currmaxpno = $currMaxPno->fldpno;
            $data->currmin = $currMin;
            $data->currminpno = $currMinPno->fldpno;

            $observed_list[] = $data;
        }
        return $observed_list;
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