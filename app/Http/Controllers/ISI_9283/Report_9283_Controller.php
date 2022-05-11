<?php

namespace App\Http\Controllers\ISI_9283;

use App\Http\Controllers\Controller;
use App\Models\ISI_9283\Entry\isi_9283_EntryMotorEntryReport;
use App\Models\ISI_9283\Master\isi_9283_MasterDelaredValues;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class Report_9283_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // report min max values

    public function index_minmax()
    {
        try {
            return view('9283.report.motorMaxMin');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function get_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                // return redirect()->back()->with('status', json_encode($request->input()));

                $startDate = $request->input('startDate');
                $toDate = $request->input('toDate');

                $dataList = isi_9283_EntryMotorEntryReport::select('fldmtype')
                    ->whereBetween('flddate', [$startDate, $toDate])
                    ->groupBy('fldmtype')->get();

                if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                // return view('9283.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));

                return view('9283.report.motorMaxMin', compact('observed_list', 'startDate', 'toDate'));
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $startDate = $request->input('startDate');
                $toDate = $request->input('toDate');

                $dataList = isi_9283_EntryMotorEntryReport::select('fldmtype')
                    ->whereBetween('flddate', [$startDate, $toDate])
                    ->groupBy('fldmtype')->get();

                if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                return view('9283.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $startDate = $request->input('startDate');
                $toDate = $request->input('toDate');

                $dataList = isi_9283_EntryMotorEntryReport::select('fldmtype')
                    ->whereBetween('flddate', [$startDate, $toDate])
                    ->groupBy('fldmtype')->get();

                if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                $pdf = PDF::loadView('9283.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function get_motor_type_name($sno)
    {
        $motorName = isi_9283_MasterDelaredValues::select('fldmtype')->where('fldsno', $sno)->first();
        return $motorName->fldmtype;
    }

    public function fetch_report($dataList, $startDate, $toDate)
    {
        try {
            $observed_list = array();

            foreach ($dataList as $dataObj) {
                $data = (object) array();

                // discharge
                $fltMax = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->max('fldflt');

                $fltMin = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->min('fldflt');

                // eff
                $effMax = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->max('fldeff');

                $effMin = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->min('fldeff');

                // curr
                $currMax = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->max('fldlcur');

                $currMin = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])
                    ->where('fldmtype', $dataObj->fldmtype)->min('fldlcur');

                $data->motortype = $this->get_motor_type_name($dataObj->fldmtype);

                $data->fltmax = $fltMax;
                $data->fltmin = $fltMin;

                $data->effmax = $effMax;
                $data->effmin = $effMin;

                $data->currmax = $currMax;
                $data->currmin = $currMin;

                $observed_list[] = $data;
            }
            return $observed_list;
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    // report observed values

    public function index_obs()
    {
        try {
            $motorDD = isi_9283_MasterDelaredValues::select('fldsno', 'fldmtype')->orderBy('id', 'asc')->get();

            return view('9283.report.motorObserved', compact('motorDD'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function get_report_obs(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $startDate = $request->input('startDate');
                $toDate = $request->input('toDate');
                $motorType = $request->input('motorType');

                $motor = isi_9283_MasterDelaredValues::where('fldsno', $motorType)->first();

                $dataList = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])->where('fldmtype', $motorType)->get();

                if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                return view('9283.report.observedReport', compact('dataList', 'motor', 'startDate', 'toDate'));
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report_obs(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                $startDate = $request->input('startDate');
                $toDate = $request->input('toDate');
                $motorType = $request->input('motorType');

                $motor = isi_9283_MasterDelaredValues::where('fldsno', $motorType)->first();

                $dataList = isi_9283_EntryMotorEntryReport::whereBetween('flddate', [$startDate, $toDate])->where('fldmtype', $motorType)->get();

                if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                $pdf = PDF::loadView('9283.report.observedReport', compact('dataList', 'motor', 'startDate', 'toDate'))->setPaper('a3', 'landscape');
                return $pdf->download();
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}