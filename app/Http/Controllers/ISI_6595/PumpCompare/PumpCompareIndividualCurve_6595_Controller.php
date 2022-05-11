<?php

namespace App\Http\Controllers\ISI_6595\PumpCompare;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Entry\PumpTest\isi_6595_EntryPumpTest;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PumpCompareIndividualCurve_6595_Controller extends Controller
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
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.typewise.th.totalhead', compact(['allPumps', 'volumetricValues']));
    }

    public function typeEfficiency(Request $request)
    {
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.typewise.oae.efficiency', compact(['allPumps', 'volumetricValues']));
    }

    public function typeCurrent(Request $request)
    {
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.typewise.ip.input_power', compact(['allPumps', 'volumetricValues']));
    }

    public function allTypeTotalHead(Request $request)
    {
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.alltype.th.totalhead', compact(['allPumps', 'volumetricValues']));
    }

    public function allTypeEfficiency(Request $request)
    {
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.alltype.oae.efficiency', compact(['allPumps', 'volumetricValues']));
    }

    public function allTypeCurrent(Request $request)
    {
        $allPumps = isi_6595_MasterPumpType::select('fldptype', 'fldsno', 'flddis', 'fldthead')->get();

        $volumetricValues = DB::table('isi_6595__entry_pump_tests', 'f',)->groupBy('fldpno')->orderBy('fldpno')->select('fldsno', 'fldpno')->get();

        return view('6595.pump_compare.individual.alltype.ip.input_power', compact(['allPumps', 'volumetricValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.oae.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.typewise.ip.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.th.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.oae.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g1', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g2', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g3', compact(['isiGraphScaleValues', 'metricsValues', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g4', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g5', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
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

                $isiGraphScale = DB::select('SELECT MAX(xaxis) AS xaxis,MAX(yaxis1) AS yaxis1,MAX(yaxis2) AS yaxis2,MAX(yaxis3) AS yaxis3 FROM isi_6595__scales WHERE fldpno IN (' . $pns . ')');

                $isiGraphScaleValues = $isiGraphScale[0];

                foreach ($exp as $pn) {
                    $values = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    $valuesASC = isi_6595_EntryPumpTest::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // if (count($values) == 0) {
                    //     $values = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'DESC')->get();
                    //     $valuesASC = EntryPumpTestISIFlowmetric::where('fldpno', '=', $pn, 'and', 'fldsno', '=', $request['coPumpType'])->orderBy('id', 'ASC')->get();
                    // }
                    $metricsValues[$pn] = $values;
                    $metricsValuesASC[] = $valuesASC;
                }
            }

            $pump = isi_6595_MasterPumpType::where('fldsno', '=', $request['coPumpType'])->limit(1)->get();

            $pumpValues = $pump[0];

            return view('6595.pump_compare.individual.alltype.ip.graphs.g6', compact(['isiGraphScaleValues', 'metricsValues', 'metricsValuesASC', 'pumpValues']));
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
