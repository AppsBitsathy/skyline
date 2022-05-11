<?php

// 9079
use App\Http\Controllers\Entry\PumpTestISIFlow\Graph\FlowGraphController;
use App\Http\Controllers\Entry\PumpTestISIVol\Graph\VolGraphController;
use App\Http\Controllers\Entry\PumpTestRDFlow\Graph\RDFlowGraphController;
use App\Http\Controllers\Entry\PumpTestRDVol\Graph\RDVolGraphController;
use App\Http\Controllers\Entry\RoutineTest\EntryRoutineTestingController;
use App\Http\Controllers\EntryFullDetailsController;
use App\Http\Controllers\EntryMotorTestingController;
use App\Http\Controllers\EntryPumpTestingISIVolController;
use App\Http\Controllers\EntryPumpTestingISIFlowController;
use App\Http\Controllers\EntryPumpTestingRDFlowController;
use App\Http\Controllers\EntryPumpTestingRDVolController;
use App\Http\Controllers\MasterMotorDeclaredValuesController;
use App\Http\Controllers\MasterPumpDeclaredValuesController;
use App\Http\Controllers\PumpCompare\PumpCompareAllCurveController;
use App\Http\Controllers\PumpCompare\PumpCompareIndividualCurveController;
use App\Http\Controllers\ReportPumpMaxMinController;
use App\Http\Controllers\ReportPumpObservedController;

// 12225
use App\Http\Controllers\ISI_12225\Entry\FullDetails\EntryFullDetails_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\MotorTesting\EntryMotorTesting_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\PumpTestISI\EntryPumpTestingISI_Flow_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\PumpTestISI\EntryPumpTestingISI_Vol_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\PumpTestISI\Graph\ISI_12225_ISI_FlowGraphController;
use App\Http\Controllers\ISI_12225\Entry\PumpTestISI\Graph\ISI_12225_ISI_VolGraphController;
use App\Http\Controllers\ISI_12225\Entry\PumpTestRD\EntryPumpTestingRD_Flow_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\PumpTestRD\EntryPumpTestingRD_Vol_12225_Controller;
use App\Http\Controllers\ISI_12225\Entry\PumpTestRD\Graphs\ISI_12225_RD_FlowGraphController;
use App\Http\Controllers\ISI_12225\Entry\PumpTestRD\Graphs\ISI_12225_RD_VolGraphController;
use App\Http\Controllers\ISI_12225\Entry\RoutineTesting\EntryRoutineTesting_12225_Controller;
use App\Http\Controllers\ISI_12225\MasterMotorDeclaredValues_12225_Controller;
use App\Http\Controllers\ISI_12225\MasterPumpDeclaredValues_12225_Controller;
use App\Http\Controllers\ISI_12225\Report_12225_Controller;
use App\Http\Controllers\ISI_12225\PumpCompare\PumpCompareAllCurve_12225_Controller;
use App\Http\Controllers\ISI_12225\PumpCompare\PumpCompareIndividualCurve_12225_Controller;

// 8472
use App\Http\Controllers\ISI_8472\Entry\FullDetails\EntryFullDetails_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\MotorTesting\EntryMotorTesting_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingISI\EntryPumpTestingISI_Flow_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingISI\EntryPumpTestingISI_Vol_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingRD\EntryPumpTestingRD_Flow_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingRD\EntryPumpTestingRD_Vol_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\RoutineTesting\EntryRoutineTesting_8472_Controller;
use App\Http\Controllers\ISI_8472\Master\MasterMotorDeclaredValues_8472_Controller;
use App\Http\Controllers\ISI_8472\Master\MasterPumpDeclaredValues_8472_Controller;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingISI\Graph\ISI_8472_ISI_FlowGraphController;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingISI\Graph\ISI_8472_ISI_VolGraphController;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingRD\Graph\ISI_8472_RD_FlowGraphController;
use App\Http\Controllers\ISI_8472\Entry\PumpTestingRD\Graph\ISI_8472_RD_VolGraphController;
use App\Http\Controllers\ISI_8472\PumpCompare\PumpCompareAllCurve_8472_Controller;
use App\Http\Controllers\ISI_8472\PumpCompare\PumpCompareIndividualCurve_8472_Controller;
use App\Http\Controllers\ISI_8472\Report_8472_Controller;

// 8034
use App\Http\Controllers\ISI_8034\Entry\PumpTestingISI\Graph\ISI_8034_ISI_FlowGraphController;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingISI\Graph\ISI_8034_ISI_VolGraphController;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingRD\Graph\ISI_8034_RD_FlowGraphController;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingRD\Graph\ISI_8034_RD_VolGraphController;
use App\Http\Controllers\ISI_8034\PumpCompare\PumpCompareAllCurve_8034_Controller;
use App\Http\Controllers\ISI_8034\PumpCompare\PumpCompareIndividualCurve_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\FullDetails\EntryFullDetails_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingISI\EntryPumpTestingISI_Flow_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingISI\EntryPumpTestingISI_Vol_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingRD\EntryPumpTestingRD_Flow_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\PumpTestingRD\EntryPumpTestingRD_Vol_8034_Controller;
use App\Http\Controllers\ISI_8034\Entry\RoutineTest\EntryRoutineTesting_8034_Controller;
use App\Http\Controllers\ISI_8034\Master\MasterPumpDeclaredValues_8034_Controller;
use App\Http\Controllers\ISI_8034\Report_8034_Controller;

// 6595
use App\Http\Controllers\ISI_6595\Master\MasterPumpDeclaredValues_6595_Controller;
use App\Http\Controllers\ISI_6595\Master\MasterMotorDeclaredValues_6595_Controller;
use App\Http\Controllers\ISI_6595\Master\MasterPowerGraph_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingISI\EntryPumpTestingISI_Flow_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingISI\EntryPumpTestingISI_Vol_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingRD\EntryPumpTestingRD_Flow_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingRD\EntryPumpTestingRD_Vol_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingISI\Graph\ISI_6595_ISI_FlowGraphController;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingISI\Graph\ISI_6595_ISI_VolGraphController;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingRD\Graph\ISI_6595_RD_FlowGraphController;
use App\Http\Controllers\ISI_6595\Entry\PumpTestingRD\Graph\ISI_6595_RD_VolGraphController;
use App\Http\Controllers\ISI_6595\MotorTesting\EntryMotorTesting_6595_Controller;
use App\Http\Controllers\ISI_6595\PumpCompare\PumpCompareAllCurve_6595_Controller;
use App\Http\Controllers\ISI_6595\PumpCompare\PumpCompareIndividualCurve_6595_Controller;
use App\Http\Controllers\ISI_6595\RoutineTesting\EntryRoutineTesting_6595_Controller;
use App\Http\Controllers\ISI_6595\Entry\FullDetails\EntryFullDetails_6595_Controller;
use App\Http\Controllers\ISI_6595\Report_6595_Controller;

// 9283
use App\Http\Controllers\ISI_9283\Master\MasterDeclaredValues_9283_Controller;
use App\Http\Controllers\ISI_9283\Entry\MotorEntry\EntryMotorEntry_9283_Controller;
use App\Http\Controllers\ISI_9283\Report_9283_Controller;

// 14220
use App\Http\Controllers\ISI_14220\Master\MasterPumpDeclaredValues_14220_Controller;

use App\Http\Controllers\ISI_14220\Entry\FullDetails\EntryFullDetails_14220_Controller;
use App\Http\Controllers\ISI_14220\Entry\RoutineTesting\EntryRoutineTesting_14220_Controller;

// General
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingISI\EntryPumpTestingISI_Flow_14220_Controller;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingISI\EntryPumpTestingISI_Vol_14220_Controller;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingISI\Graph\ISI_14220_ISI_FlowGraphController;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingISI\Graph\ISI_14220_ISI_VolGraphController;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingRD\Graph\ISI_14220_RD_FlowGraphController;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingRD\Graph\ISI_14220_RD_VolGraphController;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingRD\EntryPumpTestingRD_Flow_14220_Controller;
use App\Http\Controllers\ISI_14220\Entry\PumpTestingRD\EntryPumpTestingRD_Vol_14220_Controller;
use App\Http\Controllers\ISI_14220\PumpCompare\PumpCompareAllCurve_14220_Controller;
use App\Http\Controllers\ISI_14220\PumpCompare\PumpCompareIndividualCurve_14220_Controller;
use App\Http\Controllers\ISI_14220\Report_14220_Controller;
// Others
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
    // return view('welcome');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/changeisi', [HomeController::class, 'changeISI'])->name('changeisi');

// 9079
Route::group(['prefix' => '9079'], function () {
    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValuesController::class, 'index'])->name('masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValuesController::class, 'entry'])->name('masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValuesController::class, 'update'])->name('masterPumpDeclaredValuesUpdate');

        Route::get('motor_declared_values/{motorType?}', [MasterMotorDeclaredValuesController::class, 'index'])->name('masterMotorDeclaredValues');
        Route::post('motor_declared_values', [MasterMotorDeclaredValuesController::class, 'store'])->name('masterMotorDeclaredValuesStore');
        Route::post('motor_declared_values_update', [MasterMotorDeclaredValuesController::class, 'update'])->name('masterMotorDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISIVolController::class, 'index'])->name('entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISIVolController::class, 'store'])->name('entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISIVolController::class, 'view_report_page'])->name('entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISIVolController::class, 'create_pdf'])->name('entryPumpTestISIVolReportDownload');
            });
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISIFlowController::class, 'view_report_page'])->name('entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISIFlowController::class, 'create_pdf'])->name('entryPumpTestISIFlowReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISIVolController::class, 'delete'])->name('entryPumpTestISIVolDelete');
            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISIVolController::class, 'show'])->name('entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [VolGraphController::class, 'g1'])->name('entryPumpTestISIVolGraphG1');
            });


            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISIFlowController::class, 'index'])->name('entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISIFlowController::class, 'store'])->name('entryPumpTestISIFlowSubmit');
            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISIFlowController::class, 'show'])->name('entryPumpTestISIFlowCoords');
            Route::post('flowmetric_update', [EntryPumpTestingISIFlowController::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISIFlowController::class, 'delete'])->name('entryPumpTestISIFlowDelete');
            Route::group(['prefix' => 'graphs/flow'], function () {
                // Route::get('graph', [FlowGraphController::class, 'index'])->name('entryPumpTestISIFlowGraph');
                Route::get('g1', [FlowGraphController::class, 'g1'])->name('entryPumpTestISIFlowGraphG1');
                Route::get('g2', [FlowGraphController::class, 'g2'])->name('entryPumpTestISIFlowGraphG2');
                Route::get('g3', [FlowGraphController::class, 'g3'])->name('entryPumpTestISIFlowGraphG3');
                Route::get('g4', [FlowGraphController::class, 'g4'])->name('entryPumpTestISIFlowGraphG4');
                Route::get('g5', [FlowGraphController::class, 'g5'])->name('entryPumpTestISIFlowGraphG5');
                Route::get('g6', [FlowGraphController::class, 'g6'])->name('entryPumpTestISIFlowGraphG6');
                Route::post('add', [FlowGraphController::class, 'add_print'])->name('entryPumpTestISIFlowGraphAddPrint');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISIVolController::class, 'delete'])->name('entryPumpTestISIVolDelete');
            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISIVolController::class, 'show'])->name('entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [VolGraphController::class, 'g1'])->name('entryPumpTestISIVolGraphG1');
                Route::get('g2', [VolGraphController::class, 'g2'])->name('entryPumpTestISIVolGraphG2');
                Route::get('g3', [VolGraphController::class, 'g3'])->name('entryPumpTestISIVolGraphG3');
                Route::get('g4', [VolGraphController::class, 'g4'])->name('entryPumpTestISIVolGraphG4');
                Route::get('g5', [VolGraphController::class, 'g5'])->name('entryPumpTestISIVolGraphG5');
                Route::get('g6', [VolGraphController::class, 'g6'])->name('entryPumpTestISIVolGraphG6');
                Route::post('add', [VolGraphController::class, 'add_print'])->name('entryPumpTestISIVolGraphAddPrint');
            });
        });


        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRDVolController::class, 'index'])->name('entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRDVolController::class, 'store'])->name('entryPumpTestRDVolAdd');
            Route::post('volumetric_delete', [EntryPumpTestingRDVolController::class, 'delete'])->name('entryPumpTestRDVolDelete');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRDVolController::class, 'view_report_page'])->name('entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRDVolController::class, 'create_pdf'])->name('entryPumpTestRDVolReportDownload');
            });
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRDFlowController::class, 'view_report_page'])->name('entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRDFlowController::class, 'create_pdf'])->name('entryPumpTestRDFlowReportDownload');
            });

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRDFlowController::class, 'index'])->name('entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRDFlowController::class, 'store'])->name('entryPumpTestRDFlowSubmit');
            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRDFlowController::class, 'show'])->name('entryPumpTestRDFlowCoords');
            Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRDFlowController::class, 'delete'])->name('entryPumpTestRDFlowDelete');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [RDFlowGraphController::class, 'g1'])->name('entryPumpTestRDFlowGraphG1');
                Route::post('graph/report', [RDFlowGraphController::class, 'view_report_page'])->name('entryPumpTestRDFlowGraphReport');
                Route::get('graph/report/download', [RDFlowGraphController::class, 'create_pdf'])->name('entryPumpTestRDFlowGraphReportDownload');
                Route::get('g1/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [RDFlowGraphController::class, 'g2'])->name('entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [RDFlowGraphController::class, 'g3'])->name('entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [RDFlowGraphController::class, 'g4'])->name('entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [RDFlowGraphController::class, 'g5'])->name('entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [RDFlowGraphController::class, 'g6'])->name('entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [RDFlowGraphController::class, 'g7'])->name('entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [RDFlowGraphController::class, 'g8'])->name('entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [RDFlowGraphController::class, 'g9'])->name('entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [RDFlowGraphController::class, 'g10'])->name('entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [RDFlowGraphController::class, 'excel'])->name('entryPumpTestRDFlowGraphExcelDownload');
                Route::post('add', [RDFlowGraphController::class, 'add_print'])->name('entryPumpTestRDFlowGraphAddPrint');
            });


            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRDVolController::class, 'show'])->name('entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [RDVolGraphController::class, 'g1'])->name('entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [RDVolGraphController::class, 'g2'])->name('entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [RDVolGraphController::class, 'g3'])->name('entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [RDVolGraphController::class, 'g4'])->name('entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [RDVolGraphController::class, 'g5'])->name('entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [RDVolGraphController::class, 'g6'])->name('entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [RDVolGraphController::class, 'g7'])->name('entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [RDVolGraphController::class, 'g8'])->name('entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [RDVolGraphController::class, 'g9'])->name('entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [RDVolGraphController::class, 'g10'])->name('entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [RDVolGraphController::class, 'excel'])->name('entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [RDVolGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [RDVolGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [RDVolGraphController::class, 'create_pdf'])->name('entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [RDVolGraphController::class, 'add_print'])->name('entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Motor Testing
        Route::get('motor_testing/{radioType?}/{typeValue?}', [EntryMotorTestingController::class, 'index'])->name('entryMotorTesting');
        Route::post('motor_testing', [EntryMotorTestingController::class, 'store'])->name('entryMotorTestingEntry');
        Route::post('motor_testing_delete', [EntryMotorTestingController::class, 'delete'])->name('entryMotorTestingDelete');
        // Report
        Route::group(['prefix' => 'motor_testing/report'], function () {
            Route::post('custom_report', [EntryMotorTestingController::class, 'view_custom_report_page'])->name('entryMotorTestingViewCustomReport');
            Route::get('custom_report/download', [EntryMotorTestingController::class, 'create_pdf_custom_report'])->name('entryMotorTestingCustomReportDownload');
            Route::post('view_report', [EntryMotorTestingController::class, 'view_report_page'])->name('entryMotorTestingViewReport');
            Route::get('view_report/download', [EntryMotorTestingController::class, 'create_pdf_report'])->name('entryMotorTestingReportDownload');
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTestingController::class, 'index'])->name('entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTestingController::class, 'store'])->name('entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTestingController::class, 'delete'])->name('entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTestingController::class, 'view_custom_report_page'])->name('entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTestingController::class, 'create_pdf_custom_report'])->name('entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTestingController::class, 'view_report_page'])->name('entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTestingController::class, 'create_pdf_report'])->name('entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetailsController::class, 'index'])->name('entryFullDetails');
        Route::post('full_details/store', [EntryFullDetailsController::class, 'store'])->name('entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetailsController::class, 'delete'])->name('entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetailsController::class, 'view_report_page'])->name('entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetailsController::class, 'create_pdf_report'])->name('entryFullDetailsReportDownload');
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [ReportPumpMaxMinController::class, 'index'])->name('reportPumpMaxMin');
        Route::post('pump_max_min_values', [ReportPumpMaxMinController::class, 'get_report'])->name('reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [ReportPumpMaxMinController::class, 'view_report'])->name('reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [ReportPumpMaxMinController::class, 'create_pdf_report'])->name('reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [ReportPumpObservedController::class, 'index'])->name('reportPumpObserved');
        Route::post('pump_observed_values/report', [ReportPumpObservedController::class, 'get_report'])->name('reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [ReportPumpObservedController::class, 'create_pdf_report'])->name('reportPumpObservedFetchDownload');
    });


    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurveController::class, 'typeindex'])->name('pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurveController::class, 'typeg1'])->name('pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurveController::class, 'typeg2'])->name('pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurveController::class, 'typeg3'])->name('pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurveController::class, 'typeg4'])->name('pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurveController::class, 'typeg5'])->name('pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurveController::class, 'typeg6'])->name('pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurveController::class, 'allindex'])->name('pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurveController::class, 'allg1'])->name('pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurveController::class, 'allg2'])->name('pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurveController::class, 'allg3'])->name('pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurveController::class, 'allg4'])->name('pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurveController::class, 'allg5'])->name('pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurveController::class, 'allg6'])->name('pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurveController::class, 'typeTotalHead'])->name('pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg1'])->name('pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg2'])->name('pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg3'])->name('pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg4'])->name('pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg5'])->name('pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'typeTotalHeadg6'])->name('pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurveController::class, 'typeEfficiency'])->name('pumpCompareIndividualCurveTypewiseOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg1'])->name('pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg2'])->name('pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg3'])->name('pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg4'])->name('pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg5'])->name('pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'typeEfficiencyg6'])->name('pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurveController::class, 'typeCurrent'])->name('pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'typeCurrentg1'])->name('pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'typeCurrentg2'])->name('pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'typeCurrentg3'])->name('pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'typeCurrentg4'])->name('pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'typeCurrentg5'])->name('pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'typeCurrentg6'])->name('pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurveController::class, 'allTypeTotalHead'])->name('pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg1'])->name('pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg2'])->name('pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg3'])->name('pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg4'])->name('pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg5'])->name('pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'allTypeTotalHeadg6'])->name('pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurveController::class, 'allTypeEfficiency'])->name('pumpCompareIndividualCurveAllTypeOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg1'])->name('pumpCompareIndividualCurveAllTypeOAEG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg2'])->name('pumpCompareIndividualCurveAllTypeOAEG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg3'])->name('pumpCompareIndividualCurveAllTypeOAEG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg4'])->name('pumpCompareIndividualCurveAllTypeOAEG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg5'])->name('pumpCompareIndividualCurveAllTypeOAEG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'allTypeEfficiencyg6'])->name('pumpCompareIndividualCurveAllTypeOAEG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurveController::class, 'allTypeCurrent'])->name('pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg1'])->name('pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg2'])->name('pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg3'])->name('pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg4'])->name('pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg5'])->name('pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurveController::class, 'allTypeCurrentg6'])->name('pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });
    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_9079'])->name('helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_9079'])->name('helpErrHelpTopics');
        Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_9079'])->name('helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_9079'])->name('aboutSoftware');
    });
});

// 12225
Route::group(['prefix' => '12225'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValues_12225_Controller::class, 'index'])->name('12225_masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValues_12225_Controller::class, 'entry'])->name('12225_masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValues_12225_Controller::class, 'update'])->name('12225_masterPumpDeclaredValuesUpdate');

        Route::get('motor_declared_values/{motorType?}', [MasterMotorDeclaredValues_12225_Controller::class, 'index'])->name('12225_masterMotorDeclaredValues');
        Route::post('motor_declared_values', [MasterMotorDeclaredValues_12225_Controller::class, 'store'])->name('12225_masterMotorDeclaredValuesStore');
        Route::post('motor_declared_values_update', [MasterMotorDeclaredValues_12225_Controller::class, 'update'])->name('12225_masterMotorDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISI_Vol_12225_Controller::class, 'index'])->name('12225_entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISI_Vol_12225_Controller::class, 'store'])->name('12225_entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Vol_12225_Controller::class, 'view_report_page'])->name('12225_entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISI_Vol_12225_Controller::class, 'create_pdf'])->name('12225_entryPumpTestISIVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISI_Vol_12225_Controller::class, 'delete'])->name('12225_entryPumpTestISIVolDelete');

            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISI_Flow_12225_Controller::class, 'index'])->name('12225_entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISI_Flow_12225_Controller::class, 'store'])->name('12225_entryPumpTestISIFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Flow_12225_Controller::class, 'view_report_page'])->name('12225_entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISI_Flow_12225_Controller::class, 'create_pdf'])->name('12225_entryPumpTestISIFlowReportDownload');
            });
            // Route::post('flowmetric_update', [EntryPumpTestingISIFlowController::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISI_Flow_12225_Controller::class, 'delete'])->name('12225_entryPumpTestISIFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Flow_12225_Controller::class, 'show'])->name('12225_entryPumpTestISIFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_12225_ISI_FlowGraphController::class, 'g1'])->name('12225_entryPumpTestISIFlowGraphG1');
                Route::get('g2', [ISI_12225_ISI_FlowGraphController::class, 'g2'])->name('12225_entryPumpTestISIFlowGraphG2');
                Route::get('g3', [ISI_12225_ISI_FlowGraphController::class, 'g3'])->name('12225_entryPumpTestISIFlowGraphG3');
                Route::get('g4', [ISI_12225_ISI_FlowGraphController::class, 'g4'])->name('12225_entryPumpTestISIFlowGraphG4');
                Route::get('g5', [ISI_12225_ISI_FlowGraphController::class, 'g5'])->name('12225_entryPumpTestISIFlowGraphG5');
                Route::get('g6', [ISI_12225_ISI_FlowGraphController::class, 'g6'])->name('12225_entryPumpTestISIFlowGraphG6');
                Route::post('add', [ISI_12225_ISI_FlowGraphController::class, 'add_print'])->name('12225_entryPumpTestISIFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Vol_12225_Controller::class, 'show'])->name('12225_entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_12225_ISI_VolGraphController::class, 'g1'])->name('12225_entryPumpTestISIVolGraphG1');
                Route::get('g2', [ISI_12225_ISI_VolGraphController::class, 'g2'])->name('12225_entryPumpTestISIVolGraphG2');
                Route::get('g3', [ISI_12225_ISI_VolGraphController::class, 'g3'])->name('12225_entryPumpTestISIVolGraphG3');
                Route::get('g4', [ISI_12225_ISI_VolGraphController::class, 'g4'])->name('12225_entryPumpTestISIVolGraphG4');
                Route::get('g5', [ISI_12225_ISI_VolGraphController::class, 'g5'])->name('12225_entryPumpTestISIVolGraphG5');
                Route::get('g6', [ISI_12225_ISI_VolGraphController::class, 'g6'])->name('12225_entryPumpTestISIVolGraphG6');
                Route::post('add', [ISI_12225_ISI_VolGraphController::class, 'add_print'])->name('12225_entryPumpTestISIVolGraphAddPrint');
            });
        });


        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRD_Vol_12225_Controller::class, 'index'])->name('12225_entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRD_Vol_12225_Controller::class, 'store'])->name('12225_entryPumpTestRDVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Vol_12225_Controller::class, 'view_report_page'])->name('12225_entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRD_Vol_12225_Controller::class, 'create_pdf'])->name('12225_entryPumpTestRDVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingRD_Vol_12225_Controller::class, 'delete'])->name('12225_entryPumpTestRDVolDelete');

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRD_Flow_12225_Controller::class, 'index'])->name('12225_entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRD_Flow_12225_Controller::class, 'store'])->name('12225_entryPumpTestRDFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Flow_12225_Controller::class, 'view_report_page'])->name('12225_entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRD_Flow_12225_Controller::class, 'create_pdf'])->name('12225_entryPumpTestRDFlowReportDownload');
            });
            //     Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRD_Flow_12225_Controller::class, 'delete'])->name('12225_entryPumpTestRDFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Flow_12225_Controller::class, 'show'])->name('12225_entryPumpTestRDFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_12225_RD_FlowGraphController::class, 'g1'])->name('12225_entryPumpTestRDFlowGraphG1');
                Route::get('g1/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [ISI_12225_RD_FlowGraphController::class, 'g2'])->name('12225_entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [ISI_12225_RD_FlowGraphController::class, 'g3'])->name('12225_entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [ISI_12225_RD_FlowGraphController::class, 'g4'])->name('12225_entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [ISI_12225_RD_FlowGraphController::class, 'g5'])->name('12225_entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [ISI_12225_RD_FlowGraphController::class, 'g6'])->name('12225_entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [ISI_12225_RD_FlowGraphController::class, 'g7'])->name('12225_entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [ISI_12225_RD_FlowGraphController::class, 'g8'])->name('12225_entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [ISI_12225_RD_FlowGraphController::class, 'g9'])->name('12225_entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [ISI_12225_RD_FlowGraphController::class, 'g10'])->name('12225_entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [ISI_12225_RD_FlowGraphController::class, 'excel'])->name('12225_entryPumpTestRDFlowGraphExcelDownload');
                Route::post('graph/report', [ISI_12225_RD_FlowGraphController::class, 'view_report_page'])->name('12225_entryPumpTestRDFlowGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_12225_RD_FlowGraphController::class, 'view_report_page'])->name('12225_entryPumpTestRDFlowGraphReport');
                Route::get('graph/report/download', [ISI_12225_RD_FlowGraphController::class, 'create_pdf'])->name('12225_entryPumpTestRDFlowGraphReportDownload');
                Route::post('add', [ISI_12225_RD_FlowGraphController::class, 'add_print'])->name('12225_entryPumpTestRDFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Vol_12225_Controller::class, 'show'])->name('12225_entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_12225_RD_VolGraphController::class, 'g1'])->name('12225_entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [ISI_12225_RD_VolGraphController::class, 'g2'])->name('12225_entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [ISI_12225_RD_VolGraphController::class, 'g3'])->name('12225_entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [ISI_12225_RD_VolGraphController::class, 'g4'])->name('12225_entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [ISI_12225_RD_VolGraphController::class, 'g5'])->name('12225_entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [ISI_12225_RD_VolGraphController::class, 'g6'])->name('12225_entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [ISI_12225_RD_VolGraphController::class, 'g7'])->name('12225_entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [ISI_12225_RD_VolGraphController::class, 'g8'])->name('12225_entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [ISI_12225_RD_VolGraphController::class, 'g9'])->name('12225_entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [ISI_12225_RD_VolGraphController::class, 'g10'])->name('12225_entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [ISI_12225_RD_VolGraphController::class, 'excel'])->name('12225_entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [ISI_12225_RD_VolGraphController::class, 'view_report_page'])->name('12225_entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_12225_RD_VolGraphController::class, 'view_report_page'])->name('12225_entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_12225_RD_VolGraphController::class, 'create_pdf'])->name('12225_entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [ISI_12225_RD_VolGraphController::class, 'add_print'])->name('12225_entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Motor Testing
        Route::get('motor_testing/{radioType?}/{typeValue?}', [EntryMotorTesting_12225_Controller::class, 'index'])->name('12225_entryMotorTesting');
        Route::post('motor_testing', [EntryMotorTesting_12225_Controller::class, 'store'])->name('12225_entryMotorTestingEntry');
        Route::post('motor_testing_delete', [EntryMotorTesting_12225_Controller::class, 'delete'])->name('12225_entryMotorTestingDelete');
        // // Report
        Route::group(['prefix' => 'motor_testing/report'], function () {
            Route::post('custom_report', [EntryMotorTesting_12225_Controller::class, 'view_custom_report_page'])->name('12225_entryMotorTestingViewCustomReport');
            Route::get('custom_report/download', [EntryMotorTesting_12225_Controller::class, 'create_pdf_custom_report'])->name('12225_entryMotorTestingCustomReportDownload');
            Route::post('view_report', [EntryMotorTesting_12225_Controller::class, 'view_report_page'])->name('12225_entryMotorTestingViewReport');
            Route::get('view_report/download', [EntryMotorTesting_12225_Controller::class, 'create_pdf_report'])->name('12225_entryMotorTestingReportDownload');
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTesting_12225_Controller::class, 'index'])->name('12225_entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTesting_12225_Controller::class, 'store'])->name('12225_entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTesting_12225_Controller::class, 'delete'])->name('12225_entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTesting_12225_Controller::class, 'view_custom_report_page'])->name('12225_entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTesting_12225_Controller::class, 'create_pdf_custom_report'])->name('12225_entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTesting_12225_Controller::class, 'view_report_page'])->name('12225_entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTesting_12225_Controller::class, 'create_pdf_report'])->name('12225_entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetails_12225_Controller::class, 'index'])->name('12225_entryFullDetails');
        Route::post('full_details/store', [EntryFullDetails_12225_Controller::class, 'store'])->name('12225_entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetails_12225_Controller::class, 'delete'])->name('12225_entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetails_12225_Controller::class, 'view_report_page'])->name('12225_entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetails_12225_Controller::class, 'create_pdf_report'])->name('12225_entryFullDetailsReportDownload');
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_12225_Controller::class, 'index_minmax'])->name('12225_reportPumpMaxMin');
        Route::post('pump_max_min_values', [Report_12225_Controller::class, 'get_report_minmax'])->name('12225_reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_12225_Controller::class, 'view_report_minmax'])->name('12225_reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_12225_Controller::class, 'create_pdf_report_minmax'])->name('12225_reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_12225_Controller::class, 'index_obs'])->name('12225_reportPumpObserved');
        Route::post('pump_observed_values/report', [Report_12225_Controller::class, 'get_report_obs'])->name('12225_reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_12225_Controller::class, 'create_pdf_report_obs'])->name('12225_reportPumpObservedFetchDownload');
    });

    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurve_12225_Controller::class, 'typeindex'])->name('12225_pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_12225_Controller::class, 'typeg1'])->name('12225_pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurve_12225_Controller::class, 'typeg2'])->name('12225_pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurve_12225_Controller::class, 'typeg3'])->name('12225_pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurve_12225_Controller::class, 'typeg4'])->name('12225_pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurve_12225_Controller::class, 'typeg5'])->name('12225_pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurve_12225_Controller::class, 'typeg6'])->name('12225_pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurve_12225_Controller::class, 'allindex'])->name('12225_pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_12225_Controller::class, 'allg1'])->name('12225_pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurve_12225_Controller::class, 'allg2'])->name('12225_pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurve_12225_Controller::class, 'allg3'])->name('12225_pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurve_12225_Controller::class, 'allg4'])->name('12225_pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurve_12225_Controller::class, 'allg5'])->name('12225_pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurve_12225_Controller::class, 'allg6'])->name('12225_pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHead'])->name('12225_pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg1'])->name('12225_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg2'])->name('12225_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg3'])->name('12225_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg4'])->name('12225_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg5'])->name('12225_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'typeTotalHeadg6'])->name('12225_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'dlwl'], function () {
                    Route::get('dlwl', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWL'])->name('12225_pumpCompareIndividualCurveTypewiseDLWL');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg1'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg2'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg3'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg4'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg5'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'typeDLWLg6'])->name('12225_pumpCompareIndividualCurveTypewiseDLWLG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIP'])->name('12225_pumpCompareIndividualCurveTypewiseIP');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg1'])->name('12225_pumpCompareIndividualCurveTypewiseIPG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg2'])->name('12225_pumpCompareIndividualCurveTypewiseIPG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg3'])->name('12225_pumpCompareIndividualCurveTypewiseIPG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg4'])->name('12225_pumpCompareIndividualCurveTypewiseIPG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg5'])->name('12225_pumpCompareIndividualCurveTypewiseIPG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'typeIPg6'])->name('12225_pumpCompareIndividualCurveTypewiseIPG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrent'])->name('12225_pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg1'])->name('12225_pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg2'])->name('12225_pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg3'])->name('12225_pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg4'])->name('12225_pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg5'])->name('12225_pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'typeCurrentg6'])->name('12225_pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHead'])->name('12225_pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg1'])->name('12225_pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg2'])->name('12225_pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg3'])->name('12225_pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg4'])->name('12225_pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg5'])->name('12225_pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeTotalHeadg6'])->name('12225_pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'dlwl'], function () {
                    Route::get('dlwl', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWL'])->name('12225_pumpCompareIndividualCurveAllTypeDLWL');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg1'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg2'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg3'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg4'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg5'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeDLWLg6'])->name('12225_pumpCompareIndividualCurveAllTypeDLWLG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIP'])->name('12225_pumpCompareIndividualCurveAllTypeIP');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg1'])->name('12225_pumpCompareIndividualCurveAllTypeIPG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg2'])->name('12225_pumpCompareIndividualCurveAllTypeIPG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg3'])->name('12225_pumpCompareIndividualCurveAllTypeIPG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg4'])->name('12225_pumpCompareIndividualCurveAllTypeIPG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg5'])->name('12225_pumpCompareIndividualCurveAllTypeIPG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeIPg6'])->name('12225_pumpCompareIndividualCurveAllTypeIPG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrent'])->name('12225_pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg1'])->name('12225_pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg2'])->name('12225_pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg3'])->name('12225_pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg4'])->name('12225_pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg5'])->name('12225_pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_12225_Controller::class, 'allTypeCurrentg6'])->name('12225_pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });

    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_12225'])->name('12225_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_12225'])->name('12225_helpErrHelpTopics');
        Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_12225'])->name('12225_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_12225'])->name('12225_aboutSoftware');
    });
});

// 8472
Route::group(['prefix' => '8472'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValues_8472_Controller::class, 'index'])->name('8472_masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValues_8472_Controller::class, 'entry'])->name('8472_masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValues_8472_Controller::class, 'update'])->name('8472_masterPumpDeclaredValuesUpdate');

        Route::get('motor_declared_values/{motorType?}', [MasterMotorDeclaredValues_8472_Controller::class, 'index'])->name('8472_masterMotorDeclaredValues');
        Route::post('motor_declared_values', [MasterMotorDeclaredValues_8472_Controller::class, 'store'])->name('8472_masterMotorDeclaredValuesStore');
        Route::post('motor_declared_values_update', [MasterMotorDeclaredValues_8472_Controller::class, 'update'])->name('8472_masterMotorDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {

        //pump test isi
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISI_Vol_8472_Controller::class, 'index'])->name('8472_entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISI_Vol_8472_Controller::class, 'store'])->name('8472_entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::post('report', [EntryPumpTestingISI_Vol_8472_Controller::class, 'view_report_page'])->name('8472_entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISI_Vol_8472_Controller::class, 'create_pdf'])->name('8472_entryPumpTestISIVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISI_Vol_8472_Controller::class, 'delete'])->name('8472_entryPumpTestISIVolDelete');

            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISI_Flow_8472_Controller::class, 'index'])->name('8472_entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISI_Flow_8472_Controller::class, 'store'])->name('8472_entryPumpTestISIFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::post('report', [EntryPumpTestingISI_Flow_8472_Controller::class, 'view_report_page'])->name('8472_entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISI_Flow_8472_Controller::class, 'create_pdf'])->name('8472_entryPumpTestISIFlowReportDownload');
            });
            // Route::post('flowmetric_update', [EntryPumpTestingISI_Flow_8472_Controller::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISI_Flow_8472_Controller::class, 'delete'])->name('8472_entryPumpTestISIFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Flow_8472_Controller::class, 'show'])->name('entryPumpTestISIFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_8472_ISI_FlowGraphController::class, 'g1'])->name('8472_entryPumpTestISIFlowGraphG1');
                Route::get('g2', [ISI_8472_ISI_FlowGraphController::class, 'g2'])->name('8472_entryPumpTestISIFlowGraphG2');
                Route::get('g3', [ISI_8472_ISI_FlowGraphController::class, 'g3'])->name('8472_entryPumpTestISIFlowGraphG3');
                Route::get('g4', [ISI_8472_ISI_FlowGraphController::class, 'g4'])->name('8472_entryPumpTestISIFlowGraphG4');
                Route::get('g5', [ISI_8472_ISI_FlowGraphController::class, 'g5'])->name('8472_entryPumpTestISIFlowGraphG5');
                Route::get('g6', [ISI_8472_ISI_FlowGraphController::class, 'g6'])->name('8472_entryPumpTestISIFlowGraphG6');
                Route::post('add', [ISI_8472_ISI_FlowGraphController::class, 'add_print'])->name('8472_entryPumpTestISIFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Vol_8472_Controller::class, 'show'])->name('entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_8472_ISI_VolGraphController::class, 'g1'])->name('8472_entryPumpTestISIVolGraphG1');
                Route::get('g2', [ISI_8472_ISI_VolGraphController::class, 'g2'])->name('8472_entryPumpTestISIVolGraphG2');
                Route::get('g3', [ISI_8472_ISI_VolGraphController::class, 'g3'])->name('8472_entryPumpTestISIVolGraphG3');
                Route::get('g4', [ISI_8472_ISI_VolGraphController::class, 'g4'])->name('8472_entryPumpTestISIVolGraphG4');
                Route::get('g5', [ISI_8472_ISI_VolGraphController::class, 'g5'])->name('8472_entryPumpTestISIVolGraphG5');
                Route::get('g6', [ISI_8472_ISI_VolGraphController::class, 'g6'])->name('8472_entryPumpTestISIVolGraphG6');
                Route::post('add', [ISI_8472_ISI_VolGraphController::class, 'add_print'])->name('8472_entryPumpTestISIVolGraphAddPrint');
            });
        });


        // pump test rd
        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRD_Vol_8472_Controller::class, 'index'])->name('8472_entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRD_Vol_8472_Controller::class, 'store'])->name('8472_entryPumpTestRDVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::post('report', [EntryPumpTestingRD_Vol_8472_Controller::class, 'view_report_page'])->name('8472_entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRD_Vol_8472_Controller::class, 'create_pdf'])->name('8472_entryPumpTestRDVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingRD_Vol_8472_Controller::class, 'delete'])->name('8472_entryPumpTestRDVolDelete');

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRD_Flow_8472_Controller::class, 'index'])->name('8472_entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRD_Flow_8472_Controller::class, 'store'])->name('8472_entryPumpTestRDFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::post('report', [EntryPumpTestingRD_Flow_8472_Controller::class, 'view_report_page'])->name('8472_entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRD_Flow_8472_Controller::class, 'create_pdf'])->name('8472_entryPumpTestRDFlowReportDownload');
            });
            //     Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRD_Flow_8472_Controller::class, 'delete'])->name('8472_entryPumpTestRDFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Flow_8472_Controller::class, 'show'])->name('8472_entryPumpTestRDFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_8472_RD_FlowGraphController::class, 'g1'])->name('8472_entryPumpTestRDFlowGraphG1');
                Route::get('g1/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [ISI_8472_RD_FlowGraphController::class, 'g2'])->name('8472_entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [ISI_8472_RD_FlowGraphController::class, 'g3'])->name('8472_entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [ISI_8472_RD_FlowGraphController::class, 'g4'])->name('8472_entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [ISI_8472_RD_FlowGraphController::class, 'g5'])->name('8472_entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [ISI_8472_RD_FlowGraphController::class, 'g6'])->name('8472_entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [ISI_8472_RD_FlowGraphController::class, 'g7'])->name('8472_entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [ISI_8472_RD_FlowGraphController::class, 'g8'])->name('8472_entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [ISI_8472_RD_FlowGraphController::class, 'g9'])->name('8472_entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [ISI_8472_RD_FlowGraphController::class, 'g10'])->name('8472_entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [ISI_8472_RD_FlowGraphController::class, 'excel'])->name('8472_entryPumpTestRDFlowGraphExcelDownload');
                Route::post('graph/report', [ISI_8472_RD_FlowGraphController::class, 'view_report_page'])->name('8472_entryPumpTestRDFlowGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_8472_RD_FlowGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_8472_RD_FlowGraphController::class, 'create_pdf'])->name('8472_entryPumpTestRDFlowGraphReportDownload');
                Route::post('add', [ISI_8472_RD_FlowGraphController::class, 'add_print'])->name('8472_entryPumpTestRDFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Vol_8472_Controller::class, 'show'])->name('8472_entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_8472_RD_VolGraphController::class, 'g1'])->name('8472_entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [ISI_8472_RD_VolGraphController::class, 'g2'])->name('8472_entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [ISI_8472_RD_VolGraphController::class, 'g3'])->name('8472_entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [ISI_8472_RD_VolGraphController::class, 'g4'])->name('8472_entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [ISI_8472_RD_VolGraphController::class, 'g5'])->name('8472_entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [ISI_8472_RD_VolGraphController::class, 'g6'])->name('8472_entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [ISI_8472_RD_VolGraphController::class, 'g7'])->name('8472_entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [ISI_8472_RD_VolGraphController::class, 'g8'])->name('8472_entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [ISI_8472_RD_VolGraphController::class, 'g9'])->name('8472_entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [ISI_8472_RD_VolGraphController::class, 'g10'])->name('8472_entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [ISI_8472_RD_VolGraphController::class, 'excel'])->name('8472_entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [ISI_8472_RD_VolGraphController::class, 'view_report_page'])->name('8472_entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_8472_RD_VolGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_8472_RD_VolGraphController::class, 'create_pdf'])->name('8472_entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [ISI_8472_RD_VolGraphController::class, 'add_print'])->name('8472_entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Motor Testing
        Route::get('motor_testing/{radioType?}/{typeValue?}', [EntryMotorTesting_8472_Controller::class, 'index'])->name('8472_entryMotorTesting');
        Route::post('motor_testing', [EntryMotorTesting_8472_Controller::class, 'store'])->name('8472_entryMotorTestingEntry');
        Route::post('motor_testing_delete', [EntryMotorTesting_8472_Controller::class, 'delete'])->name('8472_entryMotorTestingDelete');
        // // Report
        Route::group(['prefix' => 'motor_testing/report'], function () {
            Route::post('custom_report', [EntryMotorTesting_8472_Controller::class, 'view_custom_report_page'])->name('8472_entryMotorTestingViewCustomReport');
            Route::get('custom_report/download', [EntryMotorTesting_8472_Controller::class, 'create_pdf_custom_report'])->name('8472_entryMotorTestingCustomReportDownload');
            Route::post('view_report', [EntryMotorTesting_8472_Controller::class, 'view_report_page'])->name('8472_entryMotorTestingViewReport');
            Route::get('view_report/download', [EntryMotorTesting_8472_Controller::class, 'create_pdf_report'])->name('8472_entryMotorTestingReportDownload');
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTesting_8472_Controller::class, 'index'])->name('8472_entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTesting_8472_Controller::class, 'store'])->name('8472_entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTesting_8472_Controller::class, 'delete'])->name('8472_entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTesting_8472_Controller::class, 'view_custom_report_page'])->name('8472_entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTesting_8472_Controller::class, 'create_pdf_report'])->name('8472_entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTesting_8472_Controller::class, 'view_report_page'])->name('8472_entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTesting_8472_Controller::class, 'create_pdf_report'])->name('8472_entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetails_8472_Controller::class, 'index'])->name('8472_entryFullDetails');
        Route::post('full_details/store', [EntryFullDetails_8472_Controller::class, 'store'])->name('8472_entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetails_8472_Controller::class, 'delete'])->name('8472_entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetails_8472_Controller::class, 'view_report_page'])->name('8472_entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetails_8472_Controller::class, 'create_pdf_report'])->name('8472_entryFullDetailsReportDownload');
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_8472_Controller::class, 'index_minmax'])->name('8472_reportPumpMaxMin');
        Route::post('pump_max_min_values', [Report_8472_Controller::class, 'get_report_minmax'])->name('8472_reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_8472_Controller::class, 'view_report_minmax'])->name('8472_reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_8472_Controller::class, 'create_pdf_report_minmax'])->name('8472_reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_8472_Controller::class, 'index_obs'])->name('8472_reportPumpObserved');
        Route::post('pump_observed_values/report', [Report_8472_Controller::class, 'get_report_obs'])->name('8472_reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_8472_Controller::class, 'create_pdf_report_obs'])->name('8472_reportPumpObservedFetchDownload');
    });

    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurve_8472_Controller::class, 'typeindex'])->name('8472_pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_8472_Controller::class, 'typeg1'])->name('8472_pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurve_8472_Controller::class, 'typeg2'])->name('8472_pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurve_8472_Controller::class, 'typeg3'])->name('8472_pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurve_8472_Controller::class, 'typeg4'])->name('8472_pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurve_8472_Controller::class, 'typeg5'])->name('8472_pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurve_8472_Controller::class, 'typeg6'])->name('8472_pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurve_8472_Controller::class, 'allindex'])->name('8472_pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_8472_Controller::class, 'allg1'])->name('8472_pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurve_8472_Controller::class, 'allg2'])->name('8472_pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurve_8472_Controller::class, 'allg3'])->name('8472_pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurve_8472_Controller::class, 'allg4'])->name('8472_pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurve_8472_Controller::class, 'allg5'])->name('8472_pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurve_8472_Controller::class, 'allg6'])->name('8472_pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHead'])->name('8472_pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg1'])->name('8472_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg2'])->name('8472_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg3'])->name('8472_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg4'])->name('8472_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg5'])->name('8472_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'typeTotalHeadg6'])->name('8472_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPower'])->name('8472_pumpCompareIndividualCurveTypewiseIP');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg1'])->name('8472_pumpCompareIndividualCurveTypewiseIPG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg2'])->name('8472_pumpCompareIndividualCurveTypewiseIPG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg3'])->name('8472_pumpCompareIndividualCurveTypewiseIPG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg4'])->name('8472_pumpCompareIndividualCurveTypewiseIPG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg5'])->name('8472_pumpCompareIndividualCurveTypewiseIPG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'typeInputPowerg6'])->name('8472_pumpCompareIndividualCurveTypewiseIPG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrent'])->name('8472_pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg1'])->name('8472_pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg2'])->name('8472_pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg3'])->name('8472_pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg4'])->name('8472_pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg5'])->name('8472_pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'typeCurrentg6'])->name('8472_pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHead'])->name('8472_pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg1'])->name('8472_pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg2'])->name('8472_pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg3'])->name('8472_pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg4'])->name('8472_pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg5'])->name('8472_pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeTotalHeadg6'])->name('8472_pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPower'])->name('8472_pumpCompareIndividualCurveAllTypeIP');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg1'])->name('8472_pumpCompareIndividualCurveAllTypeIPG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg2'])->name('8472_pumpCompareIndividualCurveAllTypeIPG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg3'])->name('8472_pumpCompareIndividualCurveAllTypeIPG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg4'])->name('8472_pumpCompareIndividualCurveAllTypeIPG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg5'])->name('8472_pumpCompareIndividualCurveAllTypeIPG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeInputPowerg6'])->name('8472_pumpCompareIndividualCurveAllTypeIPG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrent'])->name('8472_pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg1'])->name('8472_pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg2'])->name('8472_pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg3'])->name('8472_pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg4'])->name('8472_pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg5'])->name('8472_pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8472_Controller::class, 'allTypeCurrentg6'])->name('8472_pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });

    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_8472'])->name('8472_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_8472'])->name('8472_helpErrHelpTopics');
        Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_8472'])->name('8472_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_8472'])->name('8472_aboutSoftware');
    });
});

// 8034
Route::group(['prefix' => '8034'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValues_8034_Controller::class, 'index'])->name('8034_masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValues_8034_Controller::class, 'entry'])->name('8034_masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValues_8034_Controller::class, 'entry'])->name('8034_masterPumpDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {

        //pump test isi
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISI_Vol_8034_Controller::class, 'index'])->name('8034_entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISI_Vol_8034_Controller::class, 'store'])->name('8034_entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Vol_8034_Controller::class, 'view_report_page'])->name('8034_entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISI_Vol_8034_Controller::class, 'create_pdf'])->name('8034_entryPumpTestISIVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISI_Vol_8034_Controller::class, 'delete'])->name('8034_entryPumpTestISIVolDelete');

            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISI_Flow_8034_Controller::class, 'index'])->name('8034_entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISI_Flow_8034_Controller::class, 'store'])->name('8034_entryPumpTestISIFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Flow_8034_Controller::class, 'view_report_page'])->name('8034_entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISI_Flow_8034_Controller::class, 'create_pdf'])->name('8034_entryPumpTestISIFlowReportDownload');
            });
            // Route::post('flowmetric_update', [EntryPumpTestingISI_Flow_8034_Controller::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISI_Flow_8034_Controller::class, 'delete'])->name('8034_entryPumpTestISIFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Flow_8034_Controller::class, 'show'])->name('8034_entryPumpTestISIFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_8034_ISI_FlowGraphController::class, 'g1'])->name('8034_entryPumpTestISIFlowGraphG1');
                Route::get('g2', [ISI_8034_ISI_FlowGraphController::class, 'g2'])->name('8034_entryPumpTestISIFlowGraphG2');
                Route::get('g3', [ISI_8034_ISI_FlowGraphController::class, 'g3'])->name('8034_entryPumpTestISIFlowGraphG3');
                Route::get('g4', [ISI_8034_ISI_FlowGraphController::class, 'g4'])->name('8034_entryPumpTestISIFlowGraphG4');
                Route::get('g5', [ISI_8034_ISI_FlowGraphController::class, 'g5'])->name('8034_entryPumpTestISIFlowGraphG5');
                Route::get('g6', [ISI_8034_ISI_FlowGraphController::class, 'g6'])->name('8034_entryPumpTestISIFlowGraphG6');
                Route::post('add', [ISI_8034_ISI_FlowGraphController::class, 'add_print'])->name('8034_entryPumpTestISIFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Vol_8034_Controller::class, 'show'])->name('8034_entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_8034_ISI_VolGraphController::class, 'g1'])->name('8034_entryPumpTestISIVolGraphG1');
                Route::get('g2', [ISI_8034_ISI_VolGraphController::class, 'g2'])->name('8034_entryPumpTestISIVolGraphG2');
                Route::get('g3', [ISI_8034_ISI_VolGraphController::class, 'g3'])->name('8034_entryPumpTestISIVolGraphG3');
                Route::get('g4', [ISI_8034_ISI_VolGraphController::class, 'g4'])->name('8034_entryPumpTestISIVolGraphG4');
                Route::get('g5', [ISI_8034_ISI_VolGraphController::class, 'g5'])->name('8034_entryPumpTestISIVolGraphG5');
                Route::get('g6', [ISI_8034_ISI_VolGraphController::class, 'g6'])->name('8034_entryPumpTestISIVolGraphG6');
                Route::post('add', [ISI_8034_ISI_VolGraphController::class, 'add_print'])->name('8034_entryPumpTestISIVolGraphAddPrint');
            });
        });


        // pump test rd
        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRD_Vol_8034_Controller::class, 'index'])->name('8034_entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRD_Vol_8034_Controller::class, 'store'])->name('8034_entryPumpTestRDVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Vol_8034_Controller::class, 'view_report_page'])->name('8034_entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRD_Vol_8034_Controller::class, 'create_pdf'])->name('8034_entryPumpTestRDVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingRD_Vol_8034_Controller::class, 'delete'])->name('8034_entryPumpTestRDVolDelete');

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRD_Flow_8034_Controller::class, 'index'])->name('8034_entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRD_Flow_8034_Controller::class, 'store'])->name('8034_entryPumpTestRDFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Flow_8034_Controller::class, 'view_report_page'])->name('8034_entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRD_Flow_8034_Controller::class, 'create_pdf'])->name('8034_entryPumpTestRDFlowReportDownload');
            });
            //     Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRD_Flow_8034_Controller::class, 'delete'])->name('8034_entryPumpTestRDFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Flow_8034_Controller::class, 'show'])->name('8034_entryPumpTestRDFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_8034_RD_FlowGraphController::class, 'g1'])->name('8034_entryPumpTestRDFlowGraphG1');
                Route::post('graph/report', [ISI_8034_RD_FlowGraphController::class, 'view_report_page'])->name('8034_entryPumpTestRDFlowGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_8034_RD_FlowGraphController::class, 'view_report_page'])->name('8034_entryPumpTestRDFlowGraphReport');
                Route::get('graph/report/download', [ISI_8034_RD_FlowGraphController::class, 'create_pdf'])->name('8034_entryPumpTestRDFlowGraphReportDownload');
                Route::get('g1/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [ISI_8034_RD_FlowGraphController::class, 'g2'])->name('8034_entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [ISI_8034_RD_FlowGraphController::class, 'g3'])->name('8034_entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [ISI_8034_RD_FlowGraphController::class, 'g4'])->name('8034_entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [ISI_8034_RD_FlowGraphController::class, 'g5'])->name('8034_entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [ISI_8034_RD_FlowGraphController::class, 'g6'])->name('8034_entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [ISI_8034_RD_FlowGraphController::class, 'g7'])->name('8034_entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [ISI_8034_RD_FlowGraphController::class, 'g8'])->name('8034_entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [ISI_8034_RD_FlowGraphController::class, 'g9'])->name('8034_entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [ISI_8034_RD_FlowGraphController::class, 'g10'])->name('8034_entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [ISI_8034_RD_FlowGraphController::class, 'excel'])->name('8034_entryPumpTestRDFlowGraphExcelDownload');
                Route::post('add', [ISI_8034_RD_FlowGraphController::class, 'add_print'])->name('8034_entryPumpTestRDFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Vol_8034_Controller::class, 'show'])->name('8034_entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_8034_RD_VolGraphController::class, 'g1'])->name('8034_entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [ISI_8034_RD_VolGraphController::class, 'g2'])->name('8034_entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [ISI_8034_RD_VolGraphController::class, 'g3'])->name('8034_entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [ISI_8034_RD_VolGraphController::class, 'g4'])->name('8034_entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [ISI_8034_RD_VolGraphController::class, 'g5'])->name('8034_entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [ISI_8034_RD_VolGraphController::class, 'g6'])->name('8034_entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [ISI_8034_RD_VolGraphController::class, 'g7'])->name('8034_entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [ISI_8034_RD_VolGraphController::class, 'g8'])->name('8034_entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [ISI_8034_RD_VolGraphController::class, 'g9'])->name('8034_entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [ISI_8034_RD_VolGraphController::class, 'g10'])->name('8034_entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [ISI_8034_RD_VolGraphController::class, 'excel'])->name('8034_entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [ISI_8034_RD_VolGraphController::class, 'view_report_page'])->name('8034_entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_8034_RD_VolGraphController::class, 'view_report_page'])->name('8034_entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_8034_RD_VolGraphController::class, 'create_pdf'])->name('8034_entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [ISI_8034_RD_VolGraphController::class, 'add_print'])->name('8034_entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTesting_8034_Controller::class, 'index'])->name('8034_entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTesting_8034_Controller::class, 'store'])->name('8034_entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTesting_8034_Controller::class, 'delete'])->name('8034_entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTesting_8034_Controller::class, 'view_custom_report_page'])->name('8034_entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTesting_8034_Controller::class, 'create_pdf_report'])->name('8034_entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTesting_8034_Controller::class, 'view_report_page'])->name('8034_entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTesting_8034_Controller::class, 'create_pdf_report'])->name('8034_entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetails_8034_Controller::class, 'index'])->name('8034_entryFullDetails');
        Route::post('full_details/store', [EntryFullDetails_8034_Controller::class, 'store'])->name('8034_entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetails_8034_Controller::class, 'delete'])->name('8034_entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetails_8034_Controller::class, 'view_report_page'])->name('8034_entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetails_8034_Controller::class, 'create_pdf_report'])->name('8034_entryFullDetailsReportDownload');
        });
    });

    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurve_8034_Controller::class, 'typeindex'])->name('8034_pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_8034_Controller::class, 'typeg1'])->name('8034_pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurve_8034_Controller::class, 'typeg2'])->name('8034_pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurve_8034_Controller::class, 'typeg3'])->name('8034_pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurve_8034_Controller::class, 'typeg4'])->name('8034_pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurve_8034_Controller::class, 'typeg5'])->name('8034_pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurve_8034_Controller::class, 'typeg6'])->name('8034_pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurve_8034_Controller::class, 'allindex'])->name('8034_pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_8034_Controller::class, 'allg1'])->name('8034_pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurve_8034_Controller::class, 'allg2'])->name('8034_pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurve_8034_Controller::class, 'allg3'])->name('8034_pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurve_8034_Controller::class, 'allg4'])->name('8034_pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurve_8034_Controller::class, 'allg5'])->name('8034_pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurve_8034_Controller::class, 'allg6'])->name('8034_pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHead'])->name('8034_pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg1'])->name('8034_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg2'])->name('8034_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg3'])->name('8034_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg4'])->name('8034_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg5'])->name('8034_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'typeTotalHeadg6'])->name('8034_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiency'])->name('8034_pumpCompareIndividualCurveTypewiseOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg1'])->name('8034_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg2'])->name('8034_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg3'])->name('8034_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg4'])->name('8034_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg5'])->name('8034_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'typeEfficiencyg6'])->name('8034_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrent'])->name('8034_pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg1'])->name('8034_pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg2'])->name('8034_pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg3'])->name('8034_pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg4'])->name('8034_pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg5'])->name('8034_pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'typeCurrentg6'])->name('8034_pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHead'])->name('8034_pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg1'])->name('8034_pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg2'])->name('8034_pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg3'])->name('8034_pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg4'])->name('8034_pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg5'])->name('8034_pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeTotalHeadg6'])->name('8034_pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiency'])->name('8034_pumpCompareIndividualCurveAllTypeOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg1'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg2'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg3'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg4'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg5'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeEfficiencyg6'])->name('8034_pumpCompareIndividualCurveAllTypeOAEG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrent'])->name('8034_pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg1'])->name('8034_pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg2'])->name('8034_pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg3'])->name('8034_pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg4'])->name('8034_pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg5'])->name('8034_pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_8034_Controller::class, 'allTypeCurrentg6'])->name('8034_pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_8034_Controller::class, 'index_minmax'])->name('8034_reportPumpMaxMin');
        Route::post('pump_max_min_values', [Report_8034_Controller::class, 'get_report_minmax'])->name('8034_reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_8034_Controller::class, 'view_report_minmax'])->name('8034_reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_8034_Controller::class, 'create_pdf_report_minmax'])->name('8034_reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_8034_Controller::class, 'index_obs'])->name('8034_reportPumpObserved');
        Route::post('pump_observed_values/report', [Report_8034_Controller::class, 'get_report_obs'])->name('8034_reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_8034_Controller::class, 'create_pdf_report_obs'])->name('8034_reportPumpObservedFetchDownload');
    });

    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_8034'])->name('8034_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_8034'])->name('8034_helpErrHelpTopics');
        // Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_8034'])->name('8034_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_8034'])->name('8034_aboutSoftware');
    });
});

// 6595

Route::group(['prefix' => '6595'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValues_6595_Controller::class, 'index'])->name('6595_masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValues_6595_Controller::class, 'entry'])->name('6595_masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValues_6595_Controller::class, 'entry'])->name('6595_masterPumpDeclaredValuesUpdate');

        Route::get('power_io_graph', [MasterPowerGraph_6595_Controller::class, 'index'])->name('6595_masterPowerGraph');
        Route::post('power_io_graph', [MasterPowerGraph_6595_Controller::class, 'store'])->name('6595_masterPowerGraphStore');
        Route::post('power_io_graph/delete', [MasterPowerGraph_6595_Controller::class, 'delete'])->name('6595_masterPowerGraphDelete');
        Route::post('power_io_graph/report', [MasterPowerGraph_6595_Controller::class, 'view_report_page'])->name('6595_masterPowerGraphReport');
        Route::post('power_io_graph/report/download', [MasterPowerGraph_6595_Controller::class, 'create_pdf_report'])->name('6595_masterPowerGraphReportDownload');
        Route::get('power_io_graph/show_graph', [MasterPowerGraph_6595_Controller::class, 'graph'])->name('6595_masterPowerShowGraph');

        Route::get('motor_declared_values/{motorType?}', [MasterMotorDeclaredValues_6595_Controller::class, 'index'])->name('6595_masterMotorDeclaredValues');
        Route::post('motor_declared_values', [MasterMotorDeclaredValues_6595_Controller::class, 'store'])->name('6595_masterMotorDeclaredValuesStore');
        Route::post('motor_declared_values_update', [MasterMotorDeclaredValues_6595_Controller::class, 'update'])->name('6595_masterMotorDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {

        //pump test isi
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISI_Vol_6595_Controller::class, 'index'])->name('6595_entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISI_Vol_6595_Controller::class, 'store'])->name('6595_entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Vol_6595_Controller::class, 'view_report_page'])->name('6595_entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISI_Vol_6595_Controller::class, 'create_pdf'])->name('6595_entryPumpTestISIVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISI_Vol_6595_Controller::class, 'delete'])->name('6595_entryPumpTestISIVolDelete');

            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISI_Flow_6595_Controller::class, 'index'])->name('6595_entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISI_Flow_6595_Controller::class, 'store'])->name('6595_entryPumpTestISIFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Flow_6595_Controller::class, 'view_report_page'])->name('6595_entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISI_Flow_6595_Controller::class, 'create_pdf'])->name('6595_entryPumpTestISIFlowReportDownload');
            });
            // Route::post('flowmetric_update', [EntryPumpTestingISI_Flow_6595_Controller::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISI_Flow_6595_Controller::class, 'delete'])->name('6595_entryPumpTestISIFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Flow_6595_Controller::class, 'show'])->name('6595_entryPumpTestISIFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_6595_ISI_FlowGraphController::class, 'g1'])->name('6595_entryPumpTestISIFlowGraphG1');
                Route::get('g2', [ISI_6595_ISI_FlowGraphController::class, 'g2'])->name('6595_entryPumpTestISIFlowGraphG2');
                Route::get('g3', [ISI_6595_ISI_FlowGraphController::class, 'g3'])->name('6595_entryPumpTestISIFlowGraphG3');
                Route::get('g4', [ISI_6595_ISI_FlowGraphController::class, 'g4'])->name('6595_entryPumpTestISIFlowGraphG4');
                Route::get('g5', [ISI_6595_ISI_FlowGraphController::class, 'g5'])->name('6595_entryPumpTestISIFlowGraphG5');
                Route::get('g6', [ISI_6595_ISI_FlowGraphController::class, 'g6'])->name('6595_entryPumpTestISIFlowGraphG6');
                Route::post('add', [ISI_6595_ISI_FlowGraphController::class, 'add_print'])->name('6595_entryPumpTestISIFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Vol_6595_Controller::class, 'show'])->name('6595_entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_6595_ISI_VolGraphController::class, 'g1'])->name('6595_entryPumpTestISIVolGraphG1');
                Route::get('g2', [ISI_6595_ISI_VolGraphController::class, 'g2'])->name('6595_entryPumpTestISIVolGraphG2');
                Route::get('g3', [ISI_6595_ISI_VolGraphController::class, 'g3'])->name('6595_entryPumpTestISIVolGraphG3');
                Route::get('g4', [ISI_6595_ISI_VolGraphController::class, 'g4'])->name('6595_entryPumpTestISIVolGraphG4');
                Route::get('g5', [ISI_6595_ISI_VolGraphController::class, 'g5'])->name('6595_entryPumpTestISIVolGraphG5');
                Route::get('g6', [ISI_6595_ISI_VolGraphController::class, 'g6'])->name('6595_entryPumpTestISIVolGraphG6');
                Route::post('add', [ISI_6595_ISI_VolGraphController::class, 'add_print'])->name('6595_entryPumpTestISIVolGraphAddPrint');
            });
        });


        // pump test rd
        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRD_Vol_6595_Controller::class, 'index'])->name('6595_entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRD_Vol_6595_Controller::class, 'store'])->name('6595_entryPumpTestRDVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Vol_6595_Controller::class, 'view_report_page'])->name('6595_entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRD_Vol_6595_Controller::class, 'create_pdf'])->name('6595_entryPumpTestRDVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingRD_Vol_6595_Controller::class, 'delete'])->name('6595_entryPumpTestRDVolDelete');

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRD_Flow_6595_Controller::class, 'index'])->name('6595_entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRD_Flow_6595_Controller::class, 'store'])->name('6595_entryPumpTestRDFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Flow_6595_Controller::class, 'view_report_page'])->name('6595_entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRD_Flow_6595_Controller::class, 'create_pdf'])->name('6595_entryPumpTestRDFlowReportDownload');
            });
            //     Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRD_Flow_6595_Controller::class, 'delete'])->name('6595_entryPumpTestRDFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Flow_6595_Controller::class, 'show'])->name('6595_entryPumpTestRDFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_6595_RD_FlowGraphController::class, 'g1'])->name('6595_entryPumpTestRDFlowGraphG1');
                Route::get('g1/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [ISI_6595_RD_FlowGraphController::class, 'g2'])->name('6595_entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [ISI_6595_RD_FlowGraphController::class, 'g3'])->name('6595_entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [ISI_6595_RD_FlowGraphController::class, 'g4'])->name('6595_entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [ISI_6595_RD_FlowGraphController::class, 'g5'])->name('6595_entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [ISI_6595_RD_FlowGraphController::class, 'g6'])->name('6595_entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [ISI_6595_RD_FlowGraphController::class, 'g7'])->name('6595_entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [ISI_6595_RD_FlowGraphController::class, 'g8'])->name('6595_entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [ISI_6595_RD_FlowGraphController::class, 'g9'])->name('6595_entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [ISI_6595_RD_FlowGraphController::class, 'g10'])->name('6595_entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [ISI_6595_RD_FlowGraphController::class, 'excel'])->name('6595_entryPumpTestRDFlowGraphExcelDownload');
                Route::post('graph/report', [ISI_6595_RD_FlowGraphController::class, 'view_report_page'])->name('6595_entryPumpTestRDFlowGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_6595_RD_FlowGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_6595_RD_FlowGraphController::class, 'create_pdf'])->name('6595_entryPumpTestRDFlowGraphReportDownload');
                Route::post('add', [ISI_6595_RD_FlowGraphController::class, 'add_print'])->name('6595_entryPumpTestRDFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Vol_6595_Controller::class, 'show'])->name('6595_entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_6595_RD_VolGraphController::class, 'g1'])->name('6595_entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [ISI_6595_RD_VolGraphController::class, 'g2'])->name('6595_entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [ISI_6595_RD_VolGraphController::class, 'g3'])->name('6595_entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [ISI_6595_RD_VolGraphController::class, 'g4'])->name('6595_entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [ISI_6595_RD_VolGraphController::class, 'g5'])->name('6595_entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [ISI_6595_RD_VolGraphController::class, 'g6'])->name('6595_entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [ISI_6595_RD_VolGraphController::class, 'g7'])->name('6595_entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [ISI_6595_RD_VolGraphController::class, 'g8'])->name('6595_entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [ISI_6595_RD_VolGraphController::class, 'g9'])->name('6595_entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [ISI_6595_RD_VolGraphController::class, 'g10'])->name('6595_entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [ISI_6595_RD_VolGraphController::class, 'excel'])->name('6595_entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [ISI_6595_RD_VolGraphController::class, 'view_report_page'])->name('6595_entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_6595_RD_VolGraphController::class, 'view_report_page'])->name('entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_6595_RD_VolGraphController::class, 'create_pdf'])->name('6595_entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [ISI_6595_RD_VolGraphController::class, 'add_print'])->name('6595_entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Motor Testing
        Route::get('motor_testing/{radioType?}/{typeValue?}', [EntryMotorTesting_6595_Controller::class, 'index'])->name('6595_entryMotorTesting');
        Route::post('motor_testing', [EntryMotorTesting_6595_Controller::class, 'store'])->name('6595_entryMotorTestingEntry');
        Route::post('motor_testing_delete', [EntryMotorTesting_6595_Controller::class, 'delete'])->name('6595_entryMotorTestingDelete');
        // // Report
        Route::group(['prefix' => 'motor_testing/report'], function () {
            Route::post('custom_report', [EntryMotorTesting_6595_Controller::class, 'view_custom_report_page'])->name('6595_entryMotorTestingViewCustomReport');
            Route::get('custom_report/download', [EntryMotorTesting_6595_Controller::class, 'create_pdf_custom_report'])->name('6595_entryMotorTestingCustomReportDownload');
            Route::post('view_report', [EntryMotorTesting_6595_Controller::class, 'view_report_page'])->name('6595_entryMotorTestingViewReport');
            Route::get('view_report/download', [EntryMotorTesting_6595_Controller::class, 'create_pdf_report'])->name('6595_entryMotorTestingReportDownload');
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTesting_6595_Controller::class, 'index'])->name('6595_entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTesting_6595_Controller::class, 'store'])->name('6595_entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTesting_6595_Controller::class, 'delete'])->name('6595_entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTesting_6595_Controller::class, 'view_custom_report_page'])->name('6595_entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTesting_6595_Controller::class, 'create_pdf_report'])->name('6595_entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTesting_6595_Controller::class, 'view_report_page'])->name('6595_entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTesting_6595_Controller::class, 'create_pdf_report'])->name('6595_entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetails_6595_Controller::class, 'index'])->name('6595_entryFullDetails');
        Route::post('full_details/store', [EntryFullDetails_6595_Controller::class, 'store'])->name('6595_entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetails_6595_Controller::class, 'delete'])->name('6595_entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetails_6595_Controller::class, 'view_report_page'])->name('6595_entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetails_6595_Controller::class, 'create_pdf_report'])->name('6595_entryFullDetailsReportDownload');
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_6595_Controller::class, 'index_minmax'])->name('6595_reportPumpMaxMin');
        Route::post('pump_max_min_values', [Report_6595_Controller::class, 'get_report_minmax'])->name('6595_reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_6595_Controller::class, 'view_report_minmax'])->name('6595_reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_6595_Controller::class, 'create_pdf_report_minmax'])->name('6595_reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_6595_Controller::class, 'index_obs'])->name('6595_reportPumpObserved');
        Route::post('pump_observed_values/report', [Report_6595_Controller::class, 'get_report_obs'])->name('6595_reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_6595_Controller::class, 'create_pdf_report_obs'])->name('6595_reportPumpObservedFetchDownload');
    });

    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurve_6595_Controller::class, 'typeindex'])->name('6595_pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_6595_Controller::class, 'typeg1'])->name('6595_pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurve_6595_Controller::class, 'typeg2'])->name('6595_pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurve_6595_Controller::class, 'typeg3'])->name('6595_pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurve_6595_Controller::class, 'typeg4'])->name('6595_pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurve_6595_Controller::class, 'typeg5'])->name('6595_pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurve_6595_Controller::class, 'typeg6'])->name('6595_pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurve_6595_Controller::class, 'allindex'])->name('6595_pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_6595_Controller::class, 'allg1'])->name('6595_pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurve_6595_Controller::class, 'allg2'])->name('6595_pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurve_6595_Controller::class, 'allg3'])->name('6595_pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurve_6595_Controller::class, 'allg4'])->name('6595_pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurve_6595_Controller::class, 'allg5'])->name('6595_pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurve_6595_Controller::class, 'allg6'])->name('6595_pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHead'])->name('6595_pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg1'])->name('6595_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg2'])->name('6595_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg3'])->name('6595_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg4'])->name('6595_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg5'])->name('6595_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'typeTotalHeadg6'])->name('6595_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiency'])->name('6595_pumpCompareIndividualCurveTypewiseOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg1'])->name('6595_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg2'])->name('6595_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg3'])->name('6595_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg4'])->name('6595_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg5'])->name('6595_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'typeEfficiencyg6'])->name('6595_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrent'])->name('6595_pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg1'])->name('6595_pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg2'])->name('6595_pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg3'])->name('6595_pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg4'])->name('6595_pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg5'])->name('6595_pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'typeCurrentg6'])->name('6595_pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHead'])->name('6595_pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg1'])->name('6595_pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg2'])->name('6595_pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg3'])->name('6595_pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg4'])->name('6595_pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg5'])->name('6595_pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeTotalHeadg6'])->name('6595_pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiency'])->name('6595_pumpCompareIndividualCurveAllTypeOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg1'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg2'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg3'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg4'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg5'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeEfficiencyg6'])->name('6595_pumpCompareIndividualCurveAllTypeOAEG6');
                    });
                });
                Route::group(['prefix' => 'ip'], function () {
                    Route::get('input_power', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrent'])->name('6595_pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg1'])->name('6595_pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg2'])->name('6595_pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg3'])->name('6595_pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg4'])->name('6595_pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg5'])->name('6595_pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_6595_Controller::class, 'allTypeCurrentg6'])->name('6595_pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });

    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_6595'])->name('6595_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_6595'])->name('6595_helpErrHelpTopics');
        // Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_6595'])->name('6595_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_6595'])->name('6595_aboutSoftware');
    });
});

// 9283

Route::group(['prefix' => '9283'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('declared_values/{motorType?}', [MasterDeclaredValues_9283_Controller::class, 'index'])->name('9283_masterDeclaredValues');
        Route::post('declared_values', [MasterDeclaredValues_9283_Controller::class, 'entry'])->name('9283_masterDeclaredValuesEntrySubmit');
        Route::post('declared_values_update', [MasterDeclaredValues_9283_Controller::class, 'entry'])->name('9283_masterDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {

        // Motor Testing
        Route::get('motor_entry', [EntryMotorEntry_9283_Controller::class, 'index'])->name('9283_entryMotorEntry');
        Route::post('motor_entry', [EntryMotorEntry_9283_Controller::class, 'store'])->name('9283_entryMotorEntrySubmit');
        Route::get('get_motor/{motorSno}', [EntryMotorEntry_9283_Controller::class, 'get_motor'])->name('9283_entryMotorEntryGetMotorAjax');
        Route::post('motor_entry_delete', [EntryMotorEntry_9283_Controller::class, 'delete'])->name('9283_entryMotorEntryDelete');
        // Report
        Route::group(['prefix' => 'motor_entry/report'], function () {
            Route::post('custom_report', [EntryMotorEntry_9283_Controller::class, 'view_custom_report_page'])->name('9283_entryMotorTestingViewCustomReport');
            Route::post('custom_report/download', [EntryMotorEntry_9283_Controller::class, 'create_pdf_custom_report'])->name('9283_entryMotorTestingCustomReportDownload');
            Route::get('view_report/{motorNo?}/{motorType?}', [EntryMotorEntry_9283_Controller::class, 'view_report_page'])->name('9283_entryMotorTestingViewReport');
            Route::get('view_report/download/{motorNo?}/{motorType?}', [EntryMotorEntry_9283_Controller::class, 'create_pdf_report'])->name('9283_entryMotorTestingReportDownload');
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_9283_Controller::class, 'index_minmax'])->name('9283_reportMotorMaxMin');
        Route::post('pump_max_min_values', [Report_9283_Controller::class, 'get_report_minmax'])->name('9283_reportMotorMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_9283_Controller::class, 'view_report_minmax'])->name('9283_reportMotorMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_9283_Controller::class, 'create_pdf_report_minmax'])->name('9283_reportMotorMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_9283_Controller::class, 'index_obs'])->name('9283_reportMotorObserved');
        Route::post('pump_observed_values/report', [Report_9283_Controller::class, 'get_report_obs'])->name('9283_reportMotorObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_9283_Controller::class, 'create_pdf_report_obs'])->name('9283_reportMotorObservedFetchDownload');
    });


    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_9283'])->name('9283_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_9283'])->name('9283_helpErrHelpTopics');
        Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_9283'])->name('9283_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_9283'])->name('9283_aboutSoftware');
    });
});

// 14220
Route::group(['prefix' => '14220'], function () {

    // master
    Route::group(['prefix' => 'master'], function () {
        Route::get('pump_declared_values/{pumpType?}', [MasterPumpDeclaredValues_14220_Controller::class, 'index'])->name('14220_masterPumpDeclaredValues');
        Route::post('pump_declared_values', [MasterPumpDeclaredValues_14220_Controller::class, 'entry'])->name('14220_masterPumpDeclaredValuesEntrySubmit');
        Route::post('pump_declared_values_update', [MasterPumpDeclaredValues_14220_Controller::class, 'entry'])->name('14220_masterPumpDeclaredValuesUpdate');
    });

    // entry
    Route::group(['prefix' => 'entry'], function () {

        //pump test isi
        Route::group(['prefix' => 'pump_testing_isi'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingISI_Vol_14220_Controller::class, 'index'])->name('14220_entryPumpTestISIVol');
            Route::post('volumetric', [EntryPumpTestingISI_Vol_14220_Controller::class, 'store'])->name('14220_entryPumpTestISIVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Vol_14220_Controller::class, 'view_report_page'])->name('14220_entryPumpTestISIVolViewReport');
                Route::get('download', [EntryPumpTestingISI_Vol_14220_Controller::class, 'create_pdf'])->name('14220_entryPumpTestISIVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingISI_Vol_14220_Controller::class, 'delete'])->name('14220_entryPumpTestISIVolDelete');

            // flowmetric
            Route::get('flowmetric', [EntryPumpTestingISI_Flow_14220_Controller::class, 'index'])->name('14220_entryPumpTestISIFlow');
            Route::post('flowmetric', [EntryPumpTestingISI_Flow_14220_Controller::class, 'store'])->name('14220_entryPumpTestISIFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingISI_Flow_14220_Controller::class, 'view_report_page'])->name('14220_entryPumpTestISIFlowViewReport');
                Route::get('download', [EntryPumpTestingISI_Flow_14220_Controller::class, 'create_pdf'])->name('14220_entryPumpTestISIFlowReportDownload');
            });
            // Route::post('flowmetric_update', [EntryPumpTestingISI_Flow_14220_Controller::class, 'update'])->name('entryPumpTestISIFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingISI_Flow_14220_Controller::class, 'delete'])->name('14220_entryPumpTestISIFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Flow_14220_Controller::class, 'show'])->name('14220_entryPumpTestISIFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_14220_ISI_FlowGraphController::class, 'g1'])->name('14220_entryPumpTestISIFlowGraphG1');
                Route::get('g2', [ISI_14220_ISI_FlowGraphController::class, 'g2'])->name('14220_entryPumpTestISIFlowGraphG2');
                Route::get('g3', [ISI_14220_ISI_FlowGraphController::class, 'g3'])->name('14220_entryPumpTestISIFlowGraphG3');
                Route::get('g4', [ISI_14220_ISI_FlowGraphController::class, 'g4'])->name('14220_entryPumpTestISIFlowGraphG4');
                Route::get('g5', [ISI_14220_ISI_FlowGraphController::class, 'g5'])->name('14220_entryPumpTestISIFlowGraphG5');
                Route::get('g6', [ISI_14220_ISI_FlowGraphController::class, 'g6'])->name('14220_entryPumpTestISIFlowGraphG6');
                Route::post('add', [ISI_14220_ISI_FlowGraphController::class, 'add_print'])->name('14220_entryPumpTestISIFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingISI_Vol_14220_Controller::class, 'show'])->name('14220_entryPumpTestISIVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_14220_ISI_VolGraphController::class, 'g1'])->name('14220_entryPumpTestISIVolGraphG1');
                Route::get('g2', [ISI_14220_ISI_VolGraphController::class, 'g2'])->name('14220_entryPumpTestISIVolGraphG2');
                Route::get('g3', [ISI_14220_ISI_VolGraphController::class, 'g3'])->name('14220_entryPumpTestISIVolGraphG3');
                Route::get('g4', [ISI_14220_ISI_VolGraphController::class, 'g4'])->name('14220_entryPumpTestISIVolGraphG4');
                Route::get('g5', [ISI_14220_ISI_VolGraphController::class, 'g5'])->name('14220_entryPumpTestISIVolGraphG5');
                Route::get('g6', [ISI_14220_ISI_VolGraphController::class, 'g6'])->name('14220_entryPumpTestISIVolGraphG6');
                Route::post('add', [ISI_14220_ISI_VolGraphController::class, 'add_print'])->name('14220_entryPumpTestISIVolGraphAddPrint');
            });
        });


        // pump test rd
        Route::group(['prefix' => 'pump_testing_rd'], function () {
            // volumetric
            Route::get('volumetric', [EntryPumpTestingRD_Vol_14220_Controller::class, 'index'])->name('14220_entryPumpTestRDVol');
            Route::post('volumetric', [EntryPumpTestingRD_Vol_14220_Controller::class, 'store'])->name('14220_entryPumpTestRDVolAdd');

            Route::group(['prefix' => 'volumetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Vol_14220_Controller::class, 'view_report_page'])->name('14220_entryPumpTestRDVolViewReport');
                Route::get('download', [EntryPumpTestingRD_Vol_14220_Controller::class, 'create_pdf'])->name('14220_entryPumpTestRDVolReportDownload');
            });
            Route::post('volumetric_delete', [EntryPumpTestingRD_Vol_14220_Controller::class, 'delete'])->name('14220_entryPumpTestRDVolDelete');

            // Flowmetric
            Route::get('flowmetric', [EntryPumpTestingRD_Flow_14220_Controller::class, 'index'])->name('14220_entryPumpTestRDFlow');
            Route::post('flowmetric', [EntryPumpTestingRD_Flow_14220_Controller::class, 'store'])->name('14220_entryPumpTestRDFlowSubmit');
            Route::group(['prefix' => 'flowmetric'], function () {
                Route::get('report/{pumpNo}/{pumpName}', [EntryPumpTestingRD_Flow_14220_Controller::class, 'view_report_page'])->name('14220_entryPumpTestRDFlowViewReport');
                Route::get('download', [EntryPumpTestingRD_Flow_14220_Controller::class, 'create_pdf'])->name('14220_entryPumpTestRDFlowReportDownload');
            });
            //     Route::post('flowmetric_update', [EntryPumpTestingRDFlowController::class, 'update'])->name('entryPumpTestRDFlowUpdate');
            Route::post('flowmetric_delete', [EntryPumpTestingRD_Flow_14220_Controller::class, 'delete'])->name('14220_entryPumpTestRDFlowDelete');

            Route::get('flowmetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Flow_14220_Controller::class, 'show'])->name('14220_entryPumpTestRDFlowCoords');
            Route::group(['prefix' => 'graphs/flow'], function () {
                Route::get('g1', [ISI_14220_RD_FlowGraphController::class, 'g1'])->name('14220_entryPumpTestRDFlowGraphG1');
                Route::post('graph/report', [ISI_14220_RD_FlowGraphController::class, 'view_report_page'])->name('14220_entryPumpTestRDFlowGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_14220_RD_FlowGraphController::class, 'view_report_page'])->name('14220_entryPumpTestRDFlowGraphReport');
                Route::get('graph/report/download', [ISI_14220_RD_FlowGraphController::class, 'create_pdf'])->name('14220_entryPumpTestRDFlowGraphReportDownload');
                Route::get('g1/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g2', [ISI_14220_RD_FlowGraphController::class, 'g2'])->name('14220_entryPumpTestRDFlowGraphG2');
                Route::get('g2/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g3', [ISI_14220_RD_FlowGraphController::class, 'g3'])->name('14220_entryPumpTestRDFlowGraphG3');
                Route::get('g3/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g4', [ISI_14220_RD_FlowGraphController::class, 'g4'])->name('14220_entryPumpTestRDFlowGraphG4');
                Route::get('g4/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g5', [ISI_14220_RD_FlowGraphController::class, 'g5'])->name('14220_entryPumpTestRDFlowGraphG5');
                Route::get('g5/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g6', [ISI_14220_RD_FlowGraphController::class, 'g6'])->name('14220_entryPumpTestRDFlowGraphG6');
                Route::get('g6/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g7', [ISI_14220_RD_FlowGraphController::class, 'g7'])->name('14220_entryPumpTestRDFlowGraphG7');
                Route::get('g7/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g8', [ISI_14220_RD_FlowGraphController::class, 'g8'])->name('14220_entryPumpTestRDFlowGraphG8');
                Route::get('g8/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g9', [ISI_14220_RD_FlowGraphController::class, 'g9'])->name('14220_entryPumpTestRDFlowGraphG9');
                Route::get('g9/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::get('g10', [ISI_14220_RD_FlowGraphController::class, 'g10'])->name('14220_entryPumpTestRDFlowGraphG10');
                Route::get('g10/excel', [ISI_14220_RD_FlowGraphController::class, 'excel'])->name('14220_entryPumpTestRDFlowGraphExcelDownload');
                Route::post('add', [ISI_14220_RD_FlowGraphController::class, 'add_print'])->name('14220_entryPumpTestRDFlowGraphAddPrint');
            });

            Route::get('volumetric_getcoords/{pumpNo}/{pumpType}', [EntryPumpTestingRD_Vol_14220_Controller::class, 'show'])->name('14220_entryPumpTestRDVolCoords');
            Route::group(['prefix' => 'graphs/vol'], function () {
                Route::get('g1', [ISI_14220_RD_VolGraphController::class, 'g1'])->name('14220_entryPumpTestRDVolGraphG1');
                Route::get('g1/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g2', [ISI_14220_RD_VolGraphController::class, 'g2'])->name('14220_entryPumpTestRDVolGraphG2');
                Route::get('g2/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g3', [ISI_14220_RD_VolGraphController::class, 'g3'])->name('14220_entryPumpTestRDVolGraphG3');
                Route::get('g3/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g4', [ISI_14220_RD_VolGraphController::class, 'g4'])->name('14220_entryPumpTestRDVolGraphG4');
                Route::get('g4/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g5', [ISI_14220_RD_VolGraphController::class, 'g5'])->name('14220_entryPumpTestRDVolGraphG5');
                Route::get('g5/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g6', [ISI_14220_RD_VolGraphController::class, 'g6'])->name('14220_entryPumpTestRDVolGraphG6');
                Route::get('g6/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g7', [ISI_14220_RD_VolGraphController::class, 'g7'])->name('14220_entryPumpTestRDVolGraphG7');
                Route::get('g7/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g8', [ISI_14220_RD_VolGraphController::class, 'g8'])->name('14220_entryPumpTestRDVolGraphG8');
                Route::get('g8/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g9', [ISI_14220_RD_VolGraphController::class, 'g9'])->name('14220_entryPumpTestRDVolGraphG9');
                Route::get('g9/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::get('g10', [ISI_14220_RD_VolGraphController::class, 'g10'])->name('14220_entryPumpTestRDVolGraphG10');
                Route::get('g10/excel', [ISI_14220_RD_VolGraphController::class, 'excel'])->name('14220_entryPumpTestRDVolGraphExcelDownload');
                Route::post('graph/report', [ISI_14220_RD_VolGraphController::class, 'view_report_page'])->name('14220_entryPumpTestRDVolGraphReport');
                // Route::get('g1/report/{pumpNo}/{pumpName}', [ISI_14220_RD_VolGraphController::class, 'view_report_page'])->name('14220_entryPumpTestRDVolGraphReport');
                Route::get('graph/report/download', [ISI_14220_RD_VolGraphController::class, 'create_pdf'])->name('14220_entryPumpTestRDVolGraphReportDownload');
                Route::post('add', [ISI_14220_RD_VolGraphController::class, 'add_print'])->name('14220_entryPumpTestRDVolGraphAddPrint');
            });
        });

        // Routine Teting
        Route::get('routine_testing/{radioType?}/{typeValue?}', [EntryRoutineTesting_14220_Controller::class, 'index'])->name('14220_entryRoutineTesting');
        Route::post('routine_testing/store', [EntryRoutineTesting_14220_Controller::class, 'store'])->name('14220_entryRoutineTestingEntry');
        Route::post('routine_testing/delete', [EntryRoutineTesting_14220_Controller::class, 'delete'])->name('14220_entryRoutineTestingDelete');
        // Report
        Route::group(['prefix' => 'routine_testing/report'], function () {
            Route::post('custom_report', [EntryRoutineTesting_14220_Controller::class, 'view_custom_report_page'])->name('14220_entryRoutineTestingCustomReport');
            Route::get('custom_report/download', [EntryRoutineTesting_14220_Controller::class, 'create_pdf_report'])->name('14220_entryRoutineTestingCustomReportDownload');
            Route::post('view_report', [EntryRoutineTesting_14220_Controller::class, 'view_report_page'])->name('14220_entryRoutineTestingReport');
            Route::get('view_report/download', [EntryRoutineTesting_14220_Controller::class, 'create_pdf_report'])->name('14220_entryRoutineTestingReportDownload');
        });

        // Full Details
        Route::get('full_details/{radioType?}/{typeValue?}', [EntryFullDetails_14220_Controller::class, 'index'])->name('14220_entryFullDetails');
        Route::post('full_details/store', [EntryFullDetails_14220_Controller::class, 'store'])->name('14220_entryFullDetailsEntry');
        Route::post('full_details/delete', [EntryFullDetails_14220_Controller::class, 'delete'])->name('14220_entryFullDetailsDelete');
        // Report
        Route::group(['prefix' => 'full_details/report'], function () {
            Route::post('view_report', [EntryFullDetails_14220_Controller::class, 'view_report_page'])->name('14220_entryFullDetailsReport');
            Route::post('view_report/download', [EntryFullDetails_14220_Controller::class, 'create_pdf_report'])->name('14220_entryFullDetailsReportDownload');
        });
    });

    // Pump Comparision
    Route::group(['prefix' => 'pump_comparison'], function () {
        // All Curve Comparison
        Route::group(['prefix' => 'all_curve'], function () {
            Route::get('typewise', [PumpCompareAllCurve_14220_Controller::class, 'typeindex'])->name('14220_pumpCompareAllCurveTypewise');
            Route::group(['prefix' => 'typewise/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_14220_Controller::class, 'typeg1'])->name('14220_pumpCompareAllCurveTypewiseG1');
                Route::get('g2', [PumpCompareAllCurve_14220_Controller::class, 'typeg2'])->name('14220_pumpCompareAllCurveTypewiseG2');
                Route::get('g3', [PumpCompareAllCurve_14220_Controller::class, 'typeg3'])->name('14220_pumpCompareAllCurveTypewiseG3');
                Route::get('g4', [PumpCompareAllCurve_14220_Controller::class, 'typeg4'])->name('14220_pumpCompareAllCurveTypewiseG4');
                Route::get('g5', [PumpCompareAllCurve_14220_Controller::class, 'typeg5'])->name('14220_pumpCompareAllCurveTypewiseG5');
                Route::get('g6', [PumpCompareAllCurve_14220_Controller::class, 'typeg6'])->name('14220_pumpCompareAllCurveTypewiseG6');
            });

            Route::get('alltype', [PumpCompareAllCurve_14220_Controller::class, 'allindex'])->name('14220_pumpCompareAllCurveAllType');
            Route::group(['prefix' => 'alltype/graphs'], function () {
                Route::get('g1', [PumpCompareAllCurve_14220_Controller::class, 'allg1'])->name('14220_pumpCompareAllCurveAllTypeG1');
                Route::get('g2', [PumpCompareAllCurve_14220_Controller::class, 'allg2'])->name('14220_pumpCompareAllCurveAllTypeG2');
                Route::get('g3', [PumpCompareAllCurve_14220_Controller::class, 'allg3'])->name('14220_pumpCompareAllCurveAllTypeG3');
                Route::get('g4', [PumpCompareAllCurve_14220_Controller::class, 'allg4'])->name('14220_pumpCompareAllCurveAllTypeG4');
                Route::get('g5', [PumpCompareAllCurve_14220_Controller::class, 'allg5'])->name('14220_pumpCompareAllCurveAllTypeG5');
                Route::get('g6', [PumpCompareAllCurve_14220_Controller::class, 'allg6'])->name('14220_pumpCompareAllCurveAllTypeG6');
            });
        });

        // Individual Curve Comparison
        Route::group(['prefix' => 'individual_curve'], function () {
            Route::group(['prefix' => 'typewise'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHead'])->name('14220_pumpCompareIndividualCurveTypewiseTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg1'])->name('14220_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg2'])->name('14220_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg3'])->name('14220_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg4'])->name('14220_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg5'])->name('14220_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'typeTotalHeadg6'])->name('14220_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiency'])->name('14220_pumpCompareIndividualCurveTypewiseOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg1'])->name('14220_pumpCompareIndividualCurveTypewiseTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg2'])->name('14220_pumpCompareIndividualCurveTypewiseTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg3'])->name('14220_pumpCompareIndividualCurveTypewiseTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg4'])->name('14220_pumpCompareIndividualCurveTypewiseTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg5'])->name('14220_pumpCompareIndividualCurveTypewiseTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'typeEfficiencyg6'])->name('14220_pumpCompareIndividualCurveTypewiseTHG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrent'])->name('14220_pumpCompareIndividualCurveTypewiseI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg1'])->name('14220_pumpCompareIndividualCurveTypewiseIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg2'])->name('14220_pumpCompareIndividualCurveTypewiseIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg3'])->name('14220_pumpCompareIndividualCurveTypewiseIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg4'])->name('14220_pumpCompareIndividualCurveTypewiseIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg5'])->name('14220_pumpCompareIndividualCurveTypewiseIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'typeCurrentg6'])->name('14220_pumpCompareIndividualCurveTypewiseIG6');
                    });
                });
            });

            Route::group(['prefix' => 'alltype'], function () {
                Route::group(['prefix' => 'th'], function () {
                    Route::get('total_head', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHead'])->name('14220_pumpCompareIndividualCurveAllTypeTH');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg1'])->name('14220_pumpCompareIndividualCurveAllTypeTHG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg2'])->name('14220_pumpCompareIndividualCurveAllTypeTHG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg3'])->name('14220_pumpCompareIndividualCurveAllTypeTHG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg4'])->name('14220_pumpCompareIndividualCurveAllTypeTHG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg5'])->name('14220_pumpCompareIndividualCurveAllTypeTHG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeTotalHeadg6'])->name('14220_pumpCompareIndividualCurveAllTypeTHG6');
                    });
                });
                Route::group(['prefix' => 'oae'], function () {
                    Route::get('efficiency', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiency'])->name('14220_pumpCompareIndividualCurveAllTypeOAE');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg1'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg2'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg3'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg4'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg5'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeEfficiencyg6'])->name('14220_pumpCompareIndividualCurveAllTypeOAEG6');
                    });
                });
                Route::group(['prefix' => 'curr'], function () {
                    Route::get('current', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrent'])->name('14220_pumpCompareIndividualCurveAllTypeI');
                    Route::group(['prefix' => 'graphs'], function () {
                        Route::get('g1', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg1'])->name('14220_pumpCompareIndividualCurveAllTypeIG1');
                        Route::get('g2', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg2'])->name('14220_pumpCompareIndividualCurveAllTypeIG2');
                        Route::get('g3', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg3'])->name('14220_pumpCompareIndividualCurveAllTypeIG3');
                        Route::get('g4', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg4'])->name('14220_pumpCompareIndividualCurveAllTypeIG4');
                        Route::get('g5', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg5'])->name('14220_pumpCompareIndividualCurveAllTypeIG5');
                        Route::get('g6', [PumpCompareIndividualCurve_14220_Controller::class, 'allTypeCurrentg6'])->name('14220_pumpCompareIndividualCurveAllTypeIG6');
                    });
                });
            });
        });
    });

    // Report (main)
    Route::group(['prefix' => 'report'], function () {
        // Pump max min values
        Route::get('pump_max_min_values', [Report_14220_Controller::class, 'index_minmax'])->name('14220_reportPumpMaxMin');
        Route::post('pump_max_min_values', [Report_14220_Controller::class, 'get_report_minmax'])->name('14220_reportPumpMaxMinGetObservedValues');
        Route::post('pump_max_min_values/report', [Report_14220_Controller::class, 'view_report_minmax'])->name('14220_reportPumpMaxMinGetObservedValuesReport');
        Route::post('pump_max_min_values/report/download', [Report_14220_Controller::class, 'create_pdf_report_minmax'])->name('14220_reportPumpMaxMinGetObservedValuesReportDownload');

        // Pump observed values
        Route::get('pump_observed_values', [Report_14220_Controller::class, 'index_obs'])->name('14220_reportPumpObserved');
        Route::post('pump_observed_values/report', [Report_14220_Controller::class, 'get_report_obs'])->name('14220_reportPumpObservedFetch');
        Route::post('pump_observed_values/report/download', [Report_14220_Controller::class, 'create_pdf_report_obs'])->name('14220_reportPumpObservedFetchDownload');
    });

    // Help
    Route::group(['prefix' => 'help'], function () {
        Route::get('help_topics', [HelpController::class, 'navigate_to_help_topics_14220'])->name('14220_helpHelpTopics');
        Route::get('error_help_topics', [HelpController::class, 'navigate_to_error_help_topics_14220'])->name('14220_helpErrHelpTopics');
        Route::get('software_working_procedure', [HelpController::class, 'navigate_to_software_working_procedure_14220'])->name('14220_helpswp');
        Route::get('about_software', [HelpController::class, 'navigate_to_about_software_14220'])->name('14220_aboutSoftware');
    });
});