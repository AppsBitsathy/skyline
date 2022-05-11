<?php

namespace App\Http\Controllers\ISI_12225\PumpCompare;

use App\Http\Controllers\Controller;
use App\Models\ISI_12225\Entry\isi_12225_EntryPumpTest;
use App\Models\isi_12225_MasterPumpType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PumpCompareIndividualCurve_12225_Controller extends Controller
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
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.typewise.th.totalhead', compact(['allPumps', 'metricValues']));
    }

    public function typeDLWL(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.typewise.dlwl.dlwl', compact(['allPumps', 'metricValues']));
    }
    
    public function typeIP(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.typewise.ip.input_power', compact(['allPumps', 'metricValues']));
    }

    public function typeCurrent(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.typewise.curr.current', compact(['allPumps', 'metricValues']));
    }

    public function allTypeTotalHead(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.alltype.th.totalhead', compact(['allPumps', 'metricValues']));
    }

    public function allTypeDLWL(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.alltype.dlwl.dlwl', compact(['allPumps', 'metricValues']));
    }

    public function allTypeIP(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.alltype.ip.input_power', compact(['allPumps', 'metricValues']));
    }

    public function allTypeCurrent(Request $request)
    {
        $allPumps = isi_12225_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $metricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('isi_12225__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('12225.pump_compare.individual.alltype.curr.current', compact(['allPumps', 'metricValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// DLWL
    public function typeDLWLg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeDLWLg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeDLWLg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeDLWLg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeDLWLg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeDLWLg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.dlwl.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// IP
    public function typeIPg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeIPg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeIPg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeIPg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeIPg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeIPg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.ip.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.typewise.curr.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// DLWL
    public function allTypeDLWLg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeDLWLg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeDLWLg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeDLWLg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeDLWLg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeDLWLg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.dlwl.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    ////// IP
    public function allTypeIPg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeIPg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeIPg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeIPg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeIPg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allTypeIPg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.ip.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_12225__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_12225_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
//                        $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
//                        $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
//                    }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_12225_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('12225.pump_compare.individual.alltype.curr.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
