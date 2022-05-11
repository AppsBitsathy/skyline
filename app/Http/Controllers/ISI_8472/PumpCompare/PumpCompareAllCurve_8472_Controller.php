<?php

namespace App\Http\Controllers\ISI_8472\PumpCompare;

use App\Http\Controllers\Controller;
use App\Models\ISI_8472\Entry\PumpTest\isi_8472_EntryPumpTest;
use App\Models\ISI_8472\Master\isi_8472_MasterPumpType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PumpCompareAllCurve_8472_Controller extends Controller
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
    public function typeindex(Request $request)
    {
        $allPumps = isi_8472_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_8472__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('8472.pump_compare.all_curve.typewise.typewise', compact(['allPumps', 'volumetricValues']));
    }

    public function allindex(Request $request)
    {
        $allPumps = isi_8472_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_8472__entry_pump_tests', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        // $flowmetricValues = DB::table('entry_pump_test_isi_flowmetrics', 'f',)->groupBy('fldpmno')->orderBy('fldpmno')->select('fldsno', 'fldpmno')->get();

        return view('8472.pump_compare.all_curve.alltype.alltype', compact(['allPumps', 'volumetricValues']));
    }

    public function typeg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function typeg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.typewise.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg1(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg2(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();


            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg3(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg4(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg5(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function allg6(Request $request)
    {
        try {
            if ($request->query('coPumpNo') && $request->query('coPumpType')) {
                $exp = explode(',', $request['coPumpNo']);

                $ex = array();

                foreach ($exp as $e) {
                    $ex[] = "'" . $e . "'";
                }

                $pns = join(',', $ex);

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_8472__scales WHERE fldpmno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_8472_EntryPumpTest::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpmno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_8472_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('8472.pump_compare.all_curve.alltype.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
