<?php

namespace App\Http\Controllers\ISI_6595;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Entry\isi_6595_EntryPumpTestGraphAddPrint;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;
use Exception;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class Report_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // report min max values

    public function index_minmax()
    {
        try {
            return view('6595.report.pumpMaxMin');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    // it is the shame for a man to grow old without seeing the beauty and strength of how his body is capable

    public function get_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $isitype = $request->input('isitype');

                    if ($isitype == 'ISI') $randd = true;
                    else if ($isitype == 'Non ISI') $randd = false;
                    else return redirect()->back()->with('status', 'Invalid Type');

                    $dataList = isi_6595_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->where('fldver', $randd)
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    // return view('6595.report.minMaxReport', compact('observed_list', 'startDate', 'toDate'));

                    return view('6595.report.pumpMaxMin', compact('observed_list', 'startDate', 'toDate', 'isitype'));
                } else return redirect()->back()->with('status', "Invalid token");
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            // echo json_encode($ex);
            dd($ex);
        }
    }

    public function view_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $isitype = $request->input('isitype');

                    if ($isitype == 'ISI') $randd = true;
                    else if ($isitype == 'Non ISI') $randd = false;
                    else return redirect()->back()->with('status', 'Invalid Type');

                    $dataList = isi_6595_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->where('fldver', $randd)
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    return view('6595.report.minMaxReport', compact('observed_list', 'startDate', 'toDate', 'isitype'));
                } else return redirect()->back()->with('status', "Invalid token");
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function create_pdf_report_minmax(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    $startDate = $request->input('startDate');
                    $toDate = $request->input('toDate');
                    $isitype = $request->input('isitype');

                    if ($isitype == 'ISI') $randd = true;
                    else if ($isitype == 'Non ISI') $randd = false;
                    else return redirect()->back()->with('status', 'Invalid Type');

                    // return redirect()->back()->with('status', date($startDate));

                    $dataList = isi_6595_EntryPumpTestGraphAddPrint::select('fldptype')
                        ->whereBetween('flddate', [$startDate, $toDate])
                        ->where('fldver', $randd)
                        ->groupBy('fldptype')->get();

                    if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                    $observed_list = $this->fetch_report($dataList, $startDate, $toDate);

                    $pdf = PDF::loadView('6595.report.minMaxReport', compact('observed_list', 'startDate', 'toDate', 'isitype'))->setPaper('a3', 'landscape');
                    return $pdf->download();
                } else return redirect()->back()->with('status', 'Invalid Token');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function get_pump_type_name($sno)
    {
        $pumpName = isi_6595_MasterPumpType::select('fldptype')->where('fldsno', '=', $sno)->first();
        return $pumpName->fldptype;
    }

    public function fetch_report($dataList, $startDate, $toDate)
    {
        $observed_list = array();

        foreach ($dataList as $dataObj) {
            $data = (object) array();

            // discharge
            $disMax = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('flddis');

            $disMaxPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMax)->first();

            $disMin = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('flddis');

            $disMinPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('flddis', '=', $disMin)->first();

            // total head
            $thMax = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldthead');

            $thMaxPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMax)->first();

            $thMin = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldthead');

            $thMinPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldthead', '=', $thMin)->first();

            // oeff
            $oeffMax = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldoeff');

            $oeffMaxPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldoeff', '=', $oeffMax)->first();

            $oeffMin = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldoeff');

            $oeffMinPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldoeff', '=', $oeffMin)->first();

            // curr
            $currMax = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->max('fldcurr');

            $currMaxPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
                ->whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->where('fldcurr', '=', $currMax)->first();

            $currMin = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])
                ->where('fldptype', '=', $dataObj->fldptype)->min('fldcurr');

            $currMinPno = isi_6595_EntryPumpTestGraphAddPrint::select('fldpno')
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

    // report observed values

    public function index_obs()
    {
        try {
            $pumpDD = isi_6595_MasterPumpType::select('fldsno', 'fldptype')->orderBy('id', 'asc')->get();

            return view('6595.report.pumpObserved', compact('pumpDD'));
        } catch (Exception $ex) {
            dd($ex);
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
                    $isitype = $request->input('isitype');

                    if ($isitype == 'ISI') $randd = true;
                    else if ($isitype == 'Non ISI') $randd = false;
                    else return redirect()->back()->with('status', 'Invalid Type');

                    $pump = isi_6595_MasterPumpType::where('fldsno', '=', $pumpType)->first();

                    $dataList = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)
                        ->where('fldver', $randd)->get();

                    if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                    return view('6595.report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate', 'isitype'));
                } else return redirect()->back()->with('status', "Invalid token");
            } else return redirect()->back()->with('status', "Invalid request");
        } catch (Exception $ex) {
            dd($ex);
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
                    $isitype = $request->input('isitype');

                    if ($isitype == 'ISI') $randd = true;
                    else if ($isitype == 'Non ISI') $randd = false;
                    else return redirect()->back()->with('status', 'Invalid Type');

                    $pump = isi_6595_MasterPumpType::where('fldsno', '=', $pumpType)->where('fldver', $randd)->first();

                    $dataList = isi_6595_EntryPumpTestGraphAddPrint::whereBetween('flddate', [$startDate, $toDate])->where('fldptype', '=', $pumpType)->get();

                    if (count($dataList) == 0) return redirect()->back()->with('status', 'No record availbale in this period of date.');

                    $pdf = PDF::loadView('6595.report.observedReport', compact('dataList', 'pump', 'startDate', 'toDate', 'isitype'))->setPaper('a3', 'landscape');
                    return $pdf->download();
                } else return redirect()->back()->with('status', 'Invalid Token');
            } else return redirect()->back()->with('status', 'Invalid Request');
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}