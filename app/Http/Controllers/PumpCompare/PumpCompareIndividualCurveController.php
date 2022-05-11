<?php

namespace App\Http\Controllers\PumpCompare;

use App\Http\Controllers\Controller;
use App\Models\EntryPumpTestISIFlowmetric;
use App\Models\EntryPumpTestIsiVolumetric;
use App\Models\MasterPumpType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PumpCompareIndividualCurveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function typeTotalHead(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.typewise.th.totalhead', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function typeEfficiency(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.typewise.oae.efficiency', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function typeCurrent(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.typewise.curr.current', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function allTypeTotalHead(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.alltype.th.totalhead', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function allTypeEfficiency(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.alltype.oae.efficiency', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function allTypeCurrent(Request $request)
    {
        $allPumps = MasterPumpType::select('fldPtype', 'fldsno', 'flddis', 'fldThead')->get();

        $volumetricValues = DB::table('entry_pump_test_isi_volumetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldPno')->orderBy('fldPno')->select('fldSno', 'fldPno', 'type')->get();

        return view('pump_compare.individual.alltype.curr.current', compact(['allPumps', 'volumetricValues', 'flowmetricValues']));
    }

    public function typeTotalHeadg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeTotalHeadg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeTotalHeadg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeTotalHeadg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeTotalHeadg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeTotalHeadg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// Efficiency
    public function typeEfficiencyg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeEfficiencyg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeEfficiencyg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeEfficiencyg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeEfficiencyg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeEfficiencyg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.oae.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// Current
    public function typeCurrentg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeCurrentg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeCurrentg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeCurrentg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeCurrentg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeCurrentg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.typewise.curr.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeTotalHeadg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// Efficiency
    public function allTypeEfficiencyg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeEfficiencyg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeEfficiencyg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeEfficiencyg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeEfficiencyg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeEfficiencyg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.oae.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// Current
    public function allTypeCurrentg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestIsiVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeCurrentg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeCurrentg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeCurrentg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeCurrentg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeCurrentg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_graph_scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = EntryPumpTestISIVolumetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    if (count($values) == 0) {
                        $values = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldPno', '=', $pn, 'and', 'fldSno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('pump_compare.individual.alltype.curr.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}