<?php

namespace App\Http\Controllers\Entry\PumpTestRDVol\Graph;

require 'vendor/autoload.php';

use App\Http\Controllers\Controller;
use App\Models\EntryPumpTestIsiVolumetric;
use App\Models\EntryPumpTestISIVolumetricReport;
use App\Models\EntryPumpTestRDGraphAddPrint;
use App\Models\EntryPumpTestRDGraphReport;
use App\Models\IsiGraphScale;
use App\Models\MasterPumpType;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Chart\Chart;
use PhpOffice\PhpSpreadsheet\Chart\DataSeries;
use PhpOffice\PhpSpreadsheet\Chart\DataSeriesValues;
use PhpOffice\PhpSpreadsheet\Chart\Legend;
use PhpOffice\PhpSpreadsheet\Chart\PlotArea;
use PhpOffice\PhpSpreadsheet\Chart\Title;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class RDVolGraphController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            return view('entry.pumpTestingRD.graphs.vol.g1', compact('isiGraphScale'));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g1(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestIsiVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g1', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g2(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g2', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g3(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g3', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g4(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g4', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g5(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g5', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g6(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g6', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g7(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g7', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g8(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g8', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g9(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g9', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function g10(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
            $volumetricsValuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            return view('entry.pumpTestingRD.graphs.vol.g10', compact(['isiGraphScaleValues', 'volumetricsValues', 'pumpValues', 'coPump', 'volumetricsValuesASC']));
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function view_report_page(Request $request)
    {
        try {
            $inputs = $request->input();
            foreach ($inputs as $inp) {
                if ($inp == null || strlen($inp) < 1) return redirect()->back()->with('status', 'Observed values are not calculated!');
            }
            // return json_encode($inputs);

            $pumpDetails = MasterPumpType::where('fldsno', '=', $inputs['coPumpType'])->first();
            $entryDetails = EntryPumpTestISIVolumetric::where('fldSno', '=', $inputs['coPumpType'])->where('fldPno', '=', $inputs['coPumpNo'])->get();

            $report = new EntryPumpTestRDGraphReport();
            $report->truncate();

            if (count($entryDetails) > 0) {
                $i = 1;
                foreach ($entryDetails as $entry) {
                    $report = new EntryPumpTestRDGraphReport();
                    $report->fldPno = $inputs['coPumpNo'];
                    $report->fldIpNo = $inputs['coPumpNo'];
                    $report->fldRead = $i++;
                    $report->fldPtype = $pumpDetails->fldPtype;
                    $report->fldSsize = $pumpDetails->fldSsize . ' X ' . $pumpDetails->fldDsize;
                    $report->fldPhase = $pumpDetails->fldPhase;
                    $report->fldHp = $pumpDetails->fldhp;
                    $report->fldVolt = $pumpDetails->fldVolt;
                    $report->fldFreq = $pumpDetails->fldFreq;
                    $report->fldHeadr = $inputs['reportH1'] . ' - ' . $inputs['reportH2'];
                    $report->fldRq = $entry->fldRDis;
                    $report->fldRth = $entry->fldRTHead;
                    $report->fldRoae = $entry->fldOeff;
                    $report->fldRi = $entry->fldCurr;
                    $report->fldDq = $inputs['reportDecDis'];
                    $report->fldDth = $inputs['reportDecTH'];
                    $report->fldDoae = $inputs['reportDecOeff'];
                    $report->fldDi = $inputs['reportDecCurr'];
                    $report->fldOq = $inputs['reportObsDis'];
                    $report->fldOth = $inputs['reportObsTH'];
                    $report->fldOoae = $inputs['reportObsOeff'];
                    $report->fldOi = $inputs['reportObsCurr'];
                    $report->save();
                }
            }

            $pumpData = EntryPumpTestRDGraphReport::orderBy('id', 'desc')->first();
            $tableData = EntryPumpTestRDGraphReport::all();
            return view('entry.pumpTestingRD.graphs.report', compact('pumpData', 'tableData'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Try again!, Catch Error: ' . $ex->__toString());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_pdf()
    {
        $pumpData = EntryPumpTestRDGraphReport::orderBy('id', 'desc')->first();
        $tableData = EntryPumpTestRDGraphReport::all();
        // view()->share('user', $pumpData);
        $pdf = PDF::loadView('entry.pumpTestingRD.graphs.report', compact('pumpData', 'tableData'))->setPaper('a4', 'landscape');

        return $pdf->download();
    }

    public function excel(Request $request)
    {
        try {
            $isiGraphScale = new IsiGraphScale();

            $isiGraphScale->fldpno = $request->input('coPumpNo');
            $isiGraphScale->fldsno = $request->input('coPumpType');
            $isiGraphScale->xaxis = $request->input('xaxis');
            $isiGraphScale->yaxis1 = $request->input('yaxis1');
            $isiGraphScale->yaxis2 = $request->input('yaxis2');
            $isiGraphScale->yaxis3 = $request->input('yaxis3');
            $isiGraphScale->gtype = $request->input('gType');

            $isiGraphScale->save();

            $isiGraphScale = IsiGraphScale::where('fldpno', '=', $request['coPumpNo'], 'and', 'fldsno', '=', $request['coPumpType'], 'and', 'gtype', '=', 'Volumetric')->orderBy('id', 'DESC')->limit(1)->get();

            $isiGraphScaleValues = $isiGraphScale[0];

            $volumetricsValues = EntryPumpTestIsiVolumetric::where('fldPno', '=', $request['coPumpNo'], 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            $coPump = array(
                'coPumpNo' => $request->input('coPumpNo'),
                'coPumpType' => $request->input('coPumpType')
            );

            $spreadsheet = new Spreadsheet();
            $worksheet = $spreadsheet->getActiveSheet();

            $chart = array();
            $chart[] =  ['Discharge', 'THead', 'Efficiency', 'Current'];
            $tot = count($volumetricsValues) + 1;

            foreach ($volumetricsValues as $val) {
                $a = array();
                // $a[] = $key;
                if (isset($val['fldRDis'])) {
                    $a[] = number_format((float)$val['fldRDis'], 5, '.', '');
                } else {
                    $a[] = '-';
                }
                if (isset($val['fldRTHead'])) {
                    $a[] = number_format((float)$val['fldRTHead'], 5, '.', '');
                } else {
                    $a[] = '-';
                }
                if (isset($val['fldOeff'])) {
                    $a[] = number_format((float)$val['fldOeff'], 5, '.', '');
                } else {
                    $a[] = '-';
                }
                if (isset($val['fldCurr'])) {
                    $a[] = number_format((float)$val['fldCurr'], 5, '.', '');
                } else {
                    $a[] = '-';
                }
                $chart[] = $a;
            }

            $worksheet->fromArray($chart);

            $dataSeriesLabels = [
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$B$1', null, 1),
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$C$1', null, 1),
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$D$1', null, 1),
            ];

            $xAxisTickValues = [
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_STRING, 'Worksheet!$A$2:$A$' . $tot, null, 4), // Q1 to Q4
            ];

            $dataSeriesValues = [
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$B$2:$B$' . $tot, null, 4),
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$C$2:$C$' . $tot, null, 4),
                new DataSeriesValues(DataSeriesValues::DATASERIES_TYPE_NUMBER, 'Worksheet!$D$2:$D$' . $tot, null, 4),
            ];

            $series = new DataSeries(
                DataSeries::TYPE_LINECHART, // plotType
                DataSeries::GROUPING_STANDARD, // plotGrouping
                range(
                    0,
                    count($dataSeriesValues) - 1
                ), // plotOrder
                $dataSeriesLabels, // plotLabel
                $xAxisTickValues, // plotCategory
                $dataSeriesValues        // plotValues
            );
            // Set additional dataseries parameters
            //     Make it a vertical column rather than a horizontal bar graph
            $series->setPlotDirection(DataSeries::DIRECTION_COL);

            // Set the series in the plot area
            $plotArea = new PlotArea(null, [$series]);
            // Set the chart legend
            $legend = new Legend(Legend::POSITION_RIGHT, null, false);

            $title = new Title('Pump Performance Testing As Per IS 9079');

            $chart = new Chart(
                'chart1', // name
                $title, // title
                $legend, // legend
                $plotArea, // plotArea
                true, // plotVisibleOnly
                DataSeries::EMPTY_AS_GAP, // displayBlanksAs
                // new Title('Date'), // xAxisLabel
                // $yAxisLabel  // yAxisLabel
            );

            // Set the position where the chart should appear in the worksheet
            $chart->setTopLeftPosition('F5');
            $chart->setBottomRightPosition('N30');

            // Add the chart to the worksheet
            $worksheet->addChart($chart);
            // $filename = "abcd.xlsx";
            // $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            // $writer->setIncludeCharts(true);
            // $writer->save($filename);

            $writer = new Xlsx($spreadsheet);
            $writer->setIncludeCharts(true);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . urlencode('test.xlsx') . '"');
            $writer->save('php://output');
        } catch (Exception $ex) {
            dd($ex);
        }
    }

    public function add_print(Request $request)
    {
        try {
            // $a = "select * from tblechart where (tabchart.pno=pno & tblchart.sno=sno) order_by fldread";
            // $sno = "SELECT [tblstand].fldHeadr1, [tblstand].fldHeadr2, [tblstand].fldThead, 
            // [tblstand].flddis,[tblstand].fldOeff,[tblstand].fldmcurr,[tblstand].fldPtype 
            // FROM tblstand Where ((([tblstand].fldsno) ='" . $slno = 1 . "')) GROUP BY [tblstand].fldHeadr1, [tblstand].fldHeadr2, [tblstand].fldThead, 
            // [tblstand].flddis,[tblstand].fldOeff,[tblstand].fldmcurr,[tblstand].fldPtype WITH OWNERACCESS OPTION";

            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    if (
                        empty($request->input('coPumpNo')) || empty($request->input('coPumpType')) || empty($request->input('addDis')) ||
                        empty($request->input('addTH')) || empty($request->input('addOeff')) || empty($request->input('addCurr'))
                    ) {
                        return redirect()->back()->with('status', 'Invalid Data. Check Observed Values');
                    }

                    $checkPump = MasterPumpType::where('fldsno', '=', $request->input('coPumpType'))->first();
                    if ($checkPump) {
                        EntryPumpTestRDGraphAddPrint::where('fldpno', '=', $request->input('coPumpNo'))
                        ->where('fldptype', '=', $request->input('coPumpType'))->delete();

                        $vol = EntryPumpTestIsiVolumetric::where('fldPno', '=', $request->input('coPumpNo'))
                        ->where('fldSno', '=', $request->input('coPumpType'))
                        ->first();

                        $addPrint = new EntryPumpTestRDGraphAddPrint();

                        $addPrint->fldpno = $request->input('coPumpNo');
                        $addPrint->fldptype = $request->input('coPumpType');
                        $addPrint->flddate = $vol->fldht;
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
