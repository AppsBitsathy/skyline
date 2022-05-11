<?php

namespace App\Http\Controllers\ISI_12225;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\isi_12225_EntryPumpTestGraphAddPrint;
use App\Models\isi_12225_MasterPumpType;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class Report_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // report min max values

    public function index_minmax()
    {
        try {
            return view('12225.report.pumpMaxMin');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! $ex");
        }
    }

    public function get_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');

                    $dataList = isi_12225_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    // return view('12225.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));

                    return view('12225.report.pumpMaxMin', compact('observed_list', 'startDate', 'toDate'));
                } else {
                    return redirect()->back()->with('status', "Invalid token");
                }
            } else {
                return redirect()->back()->with('status', "Invalid request");
            }
        } catch (Exception $ex) {
            echo json_encode($ex);
            // return redirect()->back()->with('status', "Internal Error! " . $ex->__toString());
        }
    }

    public function view_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');

                    $dataList = isi_12225_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);


                    return view('12225.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));
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

    public function create_pdf_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');

                    $dataList = isi_12225_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    $pdf = PDF::loadView('12225.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
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
        $pumpName = isi_12225_MasterPumpType::select('fldptype')->where('fldsno', '=', $sno)->first();
        return $pumpName->fldptype;
    }

    public function fetch_report($dataList, $startDate, $toDate)
    {
        $observed_list = array();

        foreach ($dataList as $dataObj) {
            $data = (object) array();

            // discharge
            $disMax = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('flddis');

            $disMaxPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMax)->first();

            $disMin = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('flddis');

            $disMinPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMin)->first();

            // total head
            $thMax = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldthead');

            $thMaxPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMax)->first();

            $thMin = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldthead');

            $thMinPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMin)->first();

            // ip
            $ipMax = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldip');

            $ipMaxPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldip', '=', $ipMax)->first();

            $ipMin = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldip');

            $ipMinPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldip', '=', $ipMin)->first();

            // curr
            $currMax = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldcurr');

            $currMaxPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldcurr', '=', $currMax)->first();

            $currMin = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldcurr');

            $currMinPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldcurr', '=', $currMin)->first();

            // curr
            $dlwlMax = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('flddlwl');

            $dlwlMaxPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddlwl', '=', $dlwlMax)->first();

            $dlwlMin = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('flddlwl');

            $dlwlMinPno = isi_12225_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddlwl', '=', $dlwlMin)->first();

            $data->pumptype = $this->get_pump_type_name($dataObj->fldptype);

            $data->dismax = $disMax;
            $data->dismaxpno = $disMaxPno->fldpno;
            $data->dismin = $disMin;
            $data->disminpno = $disMinPno->fldpno;

            $data->thmax = $thMax;
            $data->thmaxpno = $thMaxPno->fldpno;
            $data->thmin = $thMin;
            $data->thminpno = $thMinPno->fldpno;

            $data->ipmax = $ipMax;
            $data->ipmaxpno = $ipMaxPno->fldpno;
            $data->ipmin = $ipMin;
            $data->ipminpno = $ipMinPno->fldpno;

            $data->currmax = $currMax;
            $data->currmaxpno = $currMaxPno->fldpno;
            $data->currmin = $currMin;
            $data->currminpno = $currMinPno->fldpno;

            $data->dlwlmax = $dlwlMax;
            $data->dlwlmaxpno = $dlwlMaxPno->fldpno;
            $data->dlwlmin = $dlwlMin;
            $data->dlwlminpno = $dlwlMinPno->fldpno;

            $observed_list[] = $data;
        }
        return $observed_list;
    }

    // report observed values

    public function index_obs()
    {
        try {
            $pumpDD = isi_12225_MasterPumpType::select('fldsno', 'fldptype')->orderBy('id', 'asc')->get();

            return view('12225.report.pumpObserved', compact('pumpDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', "Internal Error! $ex");
        }
    }

    public function get_report_obs(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $pumpType = $request->input('pumpType');

                    $pump = isi_12225_MasterPumpType::where('fldsno', '=', $pumpType)->first();

                    $dataList = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    return view('12225.report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate'));
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

    public function create_pdf_report_obs(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $pumpType = $request->input('pumpType');

                    $pump = isi_12225_MasterPumpType::where('fldsno', '=', $pumpType)->first();

                    $dataList = isi_12225_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)->get();

                    if (count($dataList) == 0) {
                        return redirect()->back()->with('status', 'No record availbale in this period of date.');
                    }

                    $pdf = PDF::loadView('12225.report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
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
}