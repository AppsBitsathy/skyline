@extends('includes.master')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('public/assets/css/coloris/coloris.min.css') }}">
    <style>
        input {
            width: 150px;
            height: 30px !important;
            padding: 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            box-sizing: border-box;
        }

        .example {
            flex-shrink: 0;
            width: 300px;
            margin-bottom: 30px;
        }

        .full .clr-field button {
            width: 100%;
            height: 100%;
            border-radius: 5px;
        }

    </style>
@endsection
@section('content')

    <div class="row">
        <div class="col s12 m9 l9 mt-3" id="chartDiv">
            <h4 id="hoverinfo" class="white mb-0 center" style="display: none">
                <br>
            </h4>
            <div id='myDiv'></div>
        </div>
        <div class="col s12 m9 l9 mt-3 hide" id="chartDiv">
            <div id='dummyDiv'></div>
        </div>
        <div class="col s12 m1 l1 mt-3">
            <a id="hide_show" class="btn waves-effect right"><i class="material-icons">swap_horiz</i></a>
        </div>
        <div class="col s12 m2 l2 card">
            <div class="row center">
                <h5 class="m-2">G10</h5>

                <div class="col m6 pb-1"><a onclick="callG1()" class="btn waves-effect col m12">G1</a>
                </div>
                <div class="col m6 pb-1"><a onclick="callG2()" class="btn waves-effect col m12">G2</a></div>
                <div class="col m6 pb-1"><a onclick="callG3()" class="btn waves-effect col m12">G3</a></div>
                <div class="col m6 pb-1"><a onclick="callG4()" class="btn waves-effect col m12">G4</a></div>
                <div class="col m6 pb-1"><a onclick="callG5()" class="btn waves-effect col m12">G5</a></div>
                <div class="col m6 pb-1"><a onclick="callG6()" class="btn waves-effect col m12">G6</a></div>
                <div class="col m6 pb-1"><a onclick="callG7()" class="btn waves-effect col m12">G7</a></div>
                <div class="col m6 pb-1"><a onclick="callG8()" class="btn waves-effect col m12">G8</a></div>
                <div class="col m6 pb-1"><a onclick="callG9()" class="btn waves-effect col m12">G9</a></div>
                <div class="col m6 pb-1"><a onclick="callG10()" class="btn waves-effect col m12">G10</a></div>
                <div class="col m12 pb-1"><a onclick="obsValues()" class="btn waves-effect col m12">Obs.
                        Values</a>
                </div>
                <div class="col m12 pb-1"><a href="#perChartModal" class="btn waves-effect modal-trigger col m12">Per.
                        Chart</a>
                </div>
                <div class="col m12 pb-1"><a onclick="downloadToExcel()" class="btn waves-effect col m12">Excel</a></div>
                <div class="col m12 pb-1"><a onclick="dutyPointModalOpen()" class="btn waves-effect col m12">Duty
                        Point</a></div>
                <div class="col m12 pb-1"><a onclick="thvsq()" class="btn waves-effect col m12">TH vs Q</a></div>
                <div class="col m12 pb-1"><a onclick="qvsth()" class="btn waves-effect col m12">Q vs TH</a></div>
                {{-- <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Report</a></div> --}}
                <div class="col m12 pb-1">
                    <form method="post" action="{{ route('entryPumpTestRDFlowGraphReport') }}" target="blank">
                        @csrf
                        <input type="hidden" id="coPumpNo" name="coPumpNo" value="{{ $coPump['coPumpNo'] }}">
                        <input type="hidden" id="coPumpType" name="coPumpType" value="{{ $coPump['coPumpType'] }}">
                        <input type="hidden" id="reportH1" name="reportH1" value="{{ $pumpValues['fldHeadr1'] }}">
                        <input type="hidden" id="reportH2" name="reportH2" value="{{ $pumpValues['fldHeadr2'] }}">
                        <input type="hidden" id="reportDecDis" name="reportDecDis" value="{{ $pumpValues['flddis'] }}">
                        <input type="hidden" id="reportDecTH" name="reportDecTH" value="{{ $pumpValues['fldThead'] }}">
                        <input type="hidden" id="reportDecOeff" name="reportDecOeff" value="{{ $pumpValues['fldoeff'] }}">
                        <input type="hidden" id="reportDecCurr" name="reportDecCurr"
                            value="{{ $pumpValues['fldMcurr'] }}">
                        <input type="hidden" id="reportObsDis" name="reportObsDis" value="">
                        <input type="hidden" id="reportObsTH" name="reportObsTH" value="">
                        <input type="hidden" id="reportObsOeff" name="reportObsOeff" value="">
                        <input type="hidden" id="reportObsCurr" name="reportObsCurr" value="">
                        <input class="btn btn-primary col m12" type="submit" value="Report" disabled id="btnReport">
                    </form>
                </div>
                <div class="col m12 pb-1"><a onclick="pickPoint()" class="btn waves-effect col m12">Pick
                        Point</a></div>
                <div class="col m12 pb-1"><a href="#colorPickModal"
                        class="btn waves-effect modal-trigger col m12">Color</a></div>
                <div class="col m12 pb-1"><a onclick="saveAsImage()" class="btn waves-effect col m12">Save</a></div>
                <div class="col m12 pb-1">
                    <form action="{{ route('entryPumpTestRDFlowGraphAddPrint') }}" method="post">
                        @csrf
                        <input type="hidden" name="coPumpNo" value="{{ $coPump['coPumpNo'] }}" required>
                        <input type="hidden" name="coPumpType" value="{{ $coPump['coPumpType'] }}" required>
                        <input type="hidden" id="addDis" name="addDis" value="" required>
                        <input type="hidden" id="addTH" name="addTH" value="" required>
                        <input type="hidden" id="addOeff" name="addOeff" value="" required>
                        <input type="hidden" id="addCurr" name="addCurr" value="" required>
                        <input class="btn btn-primary col m12" type="submit" disabled id="btnAddPrint" value="Add / Print">
                    </form>
                </div>
                <div class="col m12">
                    <p class="m-0">
                        <label>
                            <input type="checkbox" id="openGrid" />
                            <span>Grid</span>
                        </label>
                    </p>
                </div>
                <div class="col m12">
                    <p class="m-0">
                        <label>
                            <input type="checkbox" id="showPoints" />
                            <span>Show Points</span>
                        </label>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="unitForDischargeModal" class="modal" style="width: 20%">
        <div class="modal-content">
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="lps" checked />
                        <span>Lps</span>
                    </label>
                </p>
            </div>
            <br>
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="us/gpm" />
                        <span>Us/gpm</span>
                    </label>
                </p>
            </div>
            <br>
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="m3/hr" />
                        <span>m<sup>3</sup>/hr</span>
                    </label>
                </p>
            </div>
            {{-- <br>
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="all" />
                        <span>All</span>
                    </label>
                </p>
            </div> --}}
        </div>
        <div class="modal-footer">
            <a id="setUnitsForDischarge"  class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>

    <div id="obsValuesModal" class="modal">
        <div class="modal-content">
            <table>
                <thead>
                    <tr>
                        <th>Values</th>
                        <th>Declared</th>
                        <th>Observed</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Q - Discharge in <span id="dischargeUnitForTable"></span></td>
                        <td id="declaredDis">{{ $pumpValues['flddis'] }}</td>
                        <td id="observedQ"></td>
                        <td id="dischargeResult"></td>
                    </tr>
                    <tr>
                        <td>TH - Total Head in m</td>
                        <td id="declaredTHead">{{ $pumpValues['fldThead'] }}</td>
                        <td id="observedTH"></td>
                        <td id="thResult"></td>
                    </tr>
                    <tr>
                        <td>OAE - Overall Efficiency in %</td>
                        <td id="declaredEff">{{ $pumpValues['fldoeff'] }}</td>
                        <td id="observedOAE"></td>
                        <td id="oaeResult"></td>
                    </tr>
                    <tr>
                        <td>I - Current in Amps</td>
                        <td id="declaredCurr">{{ $pumpValues['fldMcurr'] }}</td>
                        <td id="observedI"></td>
                        <td id="iResult"></td>
                    </tr>
                </tbody>
            </table>
            <div class="row m-0 mt-3">
                <div class="col s12 m6 l6">
                    <h5 id="overallResult"></h5>
                </div>
                <div class="col s12 m6 l6">
                    <h5 id="chkval"></h5>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a  class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>

    <div id="perChartModal" class="modal modal-fixed-footer" style="width: 80%;max-height: 80%;top: 5%;">
        <div class="modal-content">
            <div class="row">
                <div class="input-field col m4 l4 offset-m4 offset-l4">
                    <select id="chartType">
                        <option value="" selected disabled>Choose Type</option>
                        <option value="Bar">Bar</option>
                        <option value="Pie">Pie</option>
                    </select>
                    <label>Chart Type</label>
                </div>
                <div class="col s12 hide" id="barCharts">
                    <div class="col m6 l6">
                        <div id="dischargeBarChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="thBarChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="effBarChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="currBarChart"></div>
                    </div>
                </div>
                <div class="col s12 hide" id="pieCharts">
                    <div class="col m6 l6">
                        <div id="dischargePieChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="thPieChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="effPieChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="currPieChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a  class="modal-close waves-effect waves-green btn-flat">CLOSE</a>
        </div>
    </div>

    <div id="dutyPointChangeModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="Enter Discharge" id="dutyDischarge" type="text" class="validate">
                        <label for="dutyDischarge">Discharge</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Total Head" id="dutyTHead" type="text" class="validate">
                        <label for="dutyTHead">Total Head</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Head Range 1" id="dutyHRange1" type="text" class="validate">
                        <label for="dutyHRange1">Head Range 1</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Head Range 2" id="dutyHRange2" type="text" class="validate">
                        <label for="dutyHRange2">Head Range 2</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a id="changeDutyPointBtn" class="modal-close waves-effect waves-green btn-flat">OK</a>
            <a class="modal-close waves-effect waves-red btn-flat">CLOSE</a>
        </div>
    </div>

    <div id="pickPointModal" class="modal" style="width: 20%">
        <div class="modal-content">
            <p>
                <label>
                    <input class="with-gap" name="pickablePoint" value="TH" type="radio" />
                    <span>Total Head</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="pickablePoint" value="OAE" type="radio" />
                    <span>Efficiency</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="pickablePoint" value="I" type="radio" />
                    <span>Current</span>
                </label>
            </p>
        </div>
        <div class="modal-footer">
            <a id="pickablePointSelection" class="modal-close waves-effect waves-green btn-flat">OK</a>
            <a class="modal-close waves-effect waves-red btn-flat">CLOSE</a>
        </div>
    </div>

    <div id="colorPickModal" class="modal">
        <div class="modal-content">
            <div class="row">
                {{-- Graph Color --}}
                <div class="col s12 m6 l6">
                    <div class="col s12">
                        <h5>Graph Color</h5>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Total Head</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="thLineColor" class="coloris" value="#1F77B4">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(0,'thLineColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Efficiency</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="oaeLineColor" class="coloris" value="#FF7F0E">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(2,'oaeLineColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Current</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="currLineColor" class="coloris" value="#2CA02C">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(4,'currLineColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                </div>
                {{-- Text Color --}}
                <div class="col s12 m6 l6">
                    <div class="col s12">
                        <h5>Text Color</h5>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Total Head</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="thTextColor" class="coloris" value="#1F77B4">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('y','thTextColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Efficiency</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="oaeTextColor" class="coloris" value="#FF7F0E">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('y2','oaeTextColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Current</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="currTextColor" class="coloris" value="#2CA02C">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('y3','currTextColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Discharge</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="disTextColor" class="coloris" value="#444444">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('x','disTextColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-red btn-flat">CLOSE</a>
        </div>
    </div>
@endsection

@section('custom-script')
    <script src="{{ asset('public/assets/js/coloris/coloris.min.js') }}"></script>
    <script>
        Coloris({
            el: '.coloris',
            swatches: [
                '#264653',
                '#2a9d8f',
                '#e9c46a',
                '#f4a261',
                '#e76f51',
                '#d62828',
                '#023e8a',
                '#0077b6',
                '#0096c7',
                '#00b4d8',
                '#48cae4'
            ]
        });

        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif
        });

        var globalDischarge = 0;
        var globalTotalHead = 0;
        var globalHeadRange1 = 0;
        var globalHeadRange2 = 0;

        $('#dischargeUnitForTable').html($('#unitForDischarge').val());

        function heatmapCalc(v1, v2) {
            var x = [];
            var y = [];
            for (i = 0; i < v1; i = i + 0.09) {
                x.push(i);
            }
            for (j = 0; j < v2; j = j + 0.09) {
                y.push(j);
            }
            var z = [];
            for (j = 0; j < y.length; j++) {
                var temp = [];
                for (k = 0; k < x.length; k++) {
                    temp.push(0);
                }
                z.push(temp);
            }
            return [x, y, z];
        }

        var unitForDischarge = 1;

        var visibleX1;
        var visibleX2;
        var visibleX3;

        var selectedXAxis = '';

        var trace1;
        var trace2;
        var trace3;
        var trace1sub;
        var trace2sub;
        var trace3sub;
        var trace4;
        var data;
        var layout;
        var tracetest;

        var sample1x = [];
        var sample1y = [];
        var sample2x = [];
        var sample2y = [];
        var sample3x = [];
        var sample3y = [];

        var thLineColor = '#1F77B4';
        var oaeLineColor = '#FF7F0E';
        var currLineColor = '#2CA02C';

        var thTextColor = '#1F77B4';
        var oaeTextColor = '#FF7F0E';
        var currTextColor = '#2CA02C';
        var disTextColor = '#7F7F7F';


        $(document).ready(function() {
            let parameters = window.location.href.split('?')[1].split('&');

                let ufd = parameters[8].split('=')[1];
                unitForDischarge = parameters[9].split('=')[1];

                if (ufd == 'lps') {
                    // unitForDischarge = 1;
                    var visibleX1 = true;
                    var visibleX2 = false;
                    var visibleX3 = false;
                } else if (ufd == 'us/gpm') {
                    // unitForDischarge = 15.850323141489;
                    var visibleX1 = false;
                    var visibleX2 = true;
                    var visibleX3 = false;
                    selectedXAxis = 'x2';
                } else if (ufd == 'm3/hr') {
                    // unitForDischarge = 3.6;
                    var visibleX1 = false;
                    var visibleX2 = false;
                    var visibleX3 = true;
                    selectedXAxis = 'x3';
                }
                defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis);
            setTimeout(() => {
                $('#clr-picker').css('z-index', '1005');
            }, 1000);
        });

        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];

        @foreach ($flowmetricsValues as $flow)
            trace1x.push({{ $flow['fldRDis'] }});
            trace1y.push({{ $flow['fldRTHead'] }});
            trace2x.push({{ $flow['fldRDis'] }});
            trace2y.push({{ $flow['fldOeff'] }});
            trace3x.push({{ $flow['fldRDis'] }});
            trace3y.push({{ $flow['fldCurr'] }});
        @endforeach

        function defaultGraph(visibleX1 = true, visibleX2 = false, visibleX3 = false, selectedXAxis = 'x1') {

            // TotalHead Curve Formula

            sample1x = [];
            sample1y = [];
            let xy = [];
            let k;
            let jj;
            let h = [];
            let d = [];
            let u = [];
            let a = [];
            let b = [];
            let m = [];
            let xx = [];
            let yy = [];

            // xy[0] = [];
            // xy[0][0] = trace1x[0];
            // xy[0][1] = trace1y[0];
            // k = 1;

            // for (let i = 0; i <= 10; i++) {
            //     trace1x[i] = 0;
            //     trace1y[i] = 0;
            // }

            let rec = trace1x.length;
            let n = rec - 2;
            tempj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                trace1x[tempj] = trace1x[i];
                trace1y[tempj] = trace1y[i];
                tempj = tempj + 1;
            }

            rec = tempj;

            // tempj = 0;

            // for (let i = 0; i <= rec; i++) {
            //     let tempUse1 = xx[i];
            //     let tempUse2 = yy[i];
            //     if (tempUse1 == undefined) {
            //         tempUse1 = 0;
            //     }
            //     if (tempUse2 == undefined) {
            //         tempUse2 = 0;
            //     }
            //     trace1x[tempj] = tempUse1;
            //     trace1y[tempj] = tempUse2;
            //     tempj = tempj + 1;
            // }

            // let ii = 1;
            // for (let i = ii; i <= tempj - 3; i = ii + 2) {
            //     trace1x[i] = (trace1x[i - 1] + trace1x[i + 1]) / 2;
            //     trace1y[i] = (trace1y[i - 1] + trace1y[i + 1]) / 2;
            //     ii = i;
            // }

            xy[0] = [];
            xy[0][0] = trace1x[0];
            xy[0][1] = trace1y[0];
            // rec = ii;

            let sv = {{ $flowmetricsValuesASC[0]['fldRDis'] / 6.9 }};

            k = 1;
            jj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                for (let j = jj; j <= trace1x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace1y[i] + (j - trace1x[i]) * (((trace1y[i + 1]) - trace1y[(i)]) / (trace1x[i + 1] -
                            trace1x[i]));
                        xy[k] = [];
                        xy[k][0] = parseFloat(parseFloat(j).toFixed(2));
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }

            // debugger
            if (xy[k - 1][0] != trace1x[rec - 1]) {
                xy[k] = [];
                xy[k][0] = trace1x[rec - 1];
                xy[k][1] = trace1y[rec - 1];
            }
            rec = k + 1;
            for (let i = 0; i <= (rec - 2); i++) {
                var altXPlus1 = xy[i + 1][0];
                var altYPlus1 = xy[i + 1][1];
                if (altXPlus1 == undefined) {
                    altXPlus1 = 0;
                }
                if (altYPlus1 == undefined) {
                    altYPlus1 = 0;
                }
                h[i] = altXPlus1 - xy[i][0];
                d[i] = (altYPlus1 - xy[i][1]) / h[i];
                if (i > 0) {
                    u[i] = parseFloat(6 * (d[i] - d[i - 1])).toFixed(4);
                }
                if (i == 1) {
                    a[1] = [];
                    a[1][1] = 2 * (h[0] + h[1]);
                    a[1][2] = h[1];
                    b[1] = u[1];
                }
                if (i > 1 && i <= (rec - 3)) {
                    a[i] = [];
                    a[i][(i - 1)] = h[i - 1];
                    a[i][i] = 2 * (h[i - 1] + h[i]);
                    a[i][(i + 1)] = h[i];
                    b[i] = u[i];
                }
                if (i == (rec - 2)) {
                    a[i] = [];
                    a[rec - 2][rec - 3] = h[rec - 3];
                    a[rec - 2][rec - 2] = 2 * (h[rec - 3] + h[rec - 2]);
                    b[rec - 2] = u[rec - 2];
                }
            }
            n = rec - 2;
            for (let k = 1; k <= (n - 1); k++) {
                // Start Pivot
                var large, temp11, p;
                p = k;
                large = Math.abs(a[k][k]);
                for (let vi = (k + 1); vi <= n; vi++) {
                    if (Math.abs(a[vi][k]) > large) {
                        large = Math.abs(a[vi][k]);
                        p = 1;
                    }
                }
                if (p != k) {
                    for (let vj = k; vj <= n; vj++) {
                        temp11 = a[p][vj];
                        a[p][vj] = a[k][vj];
                        a[k][vj] = temp11;
                    }
                    temp11 = b[p];
                    b[p] = b[k];
                    b[k] = temp11;
                }
                // End Pivot
                // pivot(a, b, k, n);
                let factor;
                for (let i = (k + 1); i <= n; i++) {
                    let tempUse1 = a[i][k];
                    let tempUse2 = a[k][k];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    if (tempUse2 == undefined) {
                        tempUse2 = 0;
                    }
                    factor = tempUse1 / tempUse2;
                    for (let j = (k + 1); j <= n; j++) {
                        let tempUse1 = a[k][j];
                        let tempUse2 = a[i][j];
                        if (tempUse1 == undefined) {
                            tempUse1 = 0;
                        }
                        if (tempUse2 == undefined) {
                            tempUse2 = 0;
                        }
                        a[i][j] = tempUse2 - (factor * tempUse1);
                    }
                    b[i] = b[i] - factor * b[k];
                }
            }
            if (a[n][n] != 0) {
                m[n] = b[n] / a[n][n];
            }
            for (let k = (n - 1); k >= 1; k--) {
                let sum = 0;
                for (let j = (k + 1); j <= n; j++) {
                    let tempUse1 = a[k][j];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    sum = sum + tempUse1 * m[j];
                }
                m[k] = (b[k] - sum) / a[k][k];
            }

            for (let k = 0; k <= rec - 2; k++) {
                let tempUse1 = m[k];
                let tempUse2 = m[k + 1];
                if (tempUse1 == undefined) {
                    tempUse1 = 0;
                }
                if (tempUse2 == undefined) {
                    tempUse2 = 0;
                }

                let sk0, sk1, sk2, sk3;
                sk0 = xy[k][1];
                sk1 = d[k] - ((h[k] * ((2 * tempUse1) + tempUse2)) / 6);
                sk2 = tempUse1 / 2;
                sk3 = (tempUse2 - (m[k] == undefined ? 0 : m[k])) / (6 * h[k]);

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.001) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample1x.push(j);
                    sample1y.push(yp);
                }
            }
            // trace1x.splice(1, 1);
            // trace1y.splice(1, 1);
            // trace1x.splice(2, 1);
            // trace1y.splice(2, 1);
            // trace1x.splice(3, 1);
            // trace1y.splice(3, 1);
            // trace1x.splice(4, 1);
            // trace1y.splice(4, 1);
            // trace1x.splice(5, 1);
            // trace1y.splice(5, 1);
            // trace1x.splice(6, 1);
            // trace1y.splice(6, 1);
            // trace1x.splice(6, 1);
            // trace1y.splice(6, 1);

            // End of TotalHead Curve Formula

            // Efficiency Formula
            sample2x = [];
            sample2y = [];
            xy = [];
            k;
            jj;
            h = [];
            d = [];
            u = [];
            a = [];
            b = [];
            m = [];

            rec = trace2x.length;
            n = rec - 2;
            tempj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                trace2x[tempj] = trace2x[i];
                trace2y[tempj] = trace2y[i];
                tempj = tempj + 1;
            }

            // tempj = 0;

            // // debugger
            // for (let i = 0; i <= rec; i++) {
            //     let tempUse1 = xx[i];
            //     let tempUse2 = yy[i];
            //     if (tempUse1 == undefined) {
            //         tempUse1 = 0;
            //     }
            //     if (tempUse2 == undefined) {
            //         tempUse2 = 0;
            //     }
            //     trace2x[tempj] = tempUse1;
            //     trace2y[tempj] = tempUse2;
            //     tempj = tempj + 2;
            // }

            // ii = 1;
            // for (let i = ii; i <= tempj - 3; i = ii + 2) {
            //     trace2x[i] = (trace2x[i - 1] + trace2x[i + 1]) / 2;
            //     trace2y[i] = (trace2y[i - 1] + trace2y[i + 1]) / 2;
            //     ii = i;
            // }

            xy[0] = [];
            xy[0][0] = trace2x[0];
            xy[0][1] = trace2y[0];
            // rec = ii;

            sv = {{ $flowmetricsValuesASC[0]['fldRDis'] / 6.9 }};

            k = 1;
            jj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                for (let j = jj; j <= trace2x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace2y[i] + (j - trace2x[i]) * (((trace2y[i + 1]) - trace2y[(i)]) / (trace2x[i + 1] -
                            trace2x[i]));
                        xy[k] = [];
                        xy[k][0] = parseFloat(parseFloat(j).toFixed(2));
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }

            if (xy[k - 1][0] != trace2x[rec - 1]) {
                xy[k] = [];
                xy[k][0] = trace2x[rec - 1];
                xy[k][1] = trace2y[rec - 1];
            }
            rec = k + 1;

            for (let i = 0; i <= (rec - 2); i++) {
                var altXPlus1 = xy[i + 1][0];
                var altYPlus1 = xy[i + 1][1];
                if (altXPlus1 == undefined) {
                    altXPlus1 = 0;
                }
                if (altYPlus1 == undefined) {
                    altYPlus1 = 0;
                }
                h[i] = altXPlus1 - xy[i][0];
                d[i] = (altYPlus1 - xy[i][1]) / h[i];
                if (i > 0) {
                    u[i] = parseFloat(6 * (d[i] - d[i - 1]));
                }
                // debugger
                if (i == 1) {
                    a[1] = [];
                    a[1][1] = 2 * (h[0] + h[1]);
                    a[1][2] = h[1];
                    b[1] = u[1];
                }
                if (i > 1 && i <= (rec - 3)) {
                    a[i] = [];
                    a[i][(i - 1)] = h[i - 1];
                    a[i][i] = 2 * (h[i - 1] + h[i]);
                    a[i][(i + 1)] = h[i];
                    b[i] = u[i];
                }
                if (i == (rec - 2)) {
                    a[i] = [];
                    a[rec - 2][rec - 3] = h[rec - 3];
                    a[rec - 2][rec - 2] = 2 * (h[rec - 3] + h[rec - 2]);
                    b[rec - 2] = u[rec - 2];
                }
            }
            n = rec - 2;
            for (let k = 1; k <= (n - 1); k++) {
                // Start Pivot
                var large, temp11, p;
                p = k;
                large = Math.abs(a[k][k]);
                for (let vi = (k + 1); vi <= n; vi++) {
                    if (Math.abs(a[vi][k]) > large) {
                        large = Math.abs(a[vi][k]);
                        p = 1;
                    }
                }
                if (p != k) {
                    for (let vj = k; vj <= n; vj++) {
                        temp11 = a[p][vj];
                        a[p][vj] = a[k][vj];
                        a[k][vj] = temp11;
                    }
                    temp11 = b[p];
                    b[p] = b[k];
                    b[k] = temp11;
                }
                // End Pivot
                // pivot(a, b, k, n);
                let factor;
                for (let i = (k + 1); i <= n; i++) {
                    let tempUse1 = a[i][k];
                    let tempUse2 = a[k][k];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    if (tempUse2 == undefined) {
                        tempUse2 = 0;
                    }
                    factor = tempUse1 / tempUse2;
                    for (let j = (k + 1); j <= n; j++) {
                        let tempUse1 = a[k][j];
                        let tempUse2 = a[i][j];
                        if (tempUse1 == undefined) {
                            tempUse1 = 0;
                        }
                        if (tempUse2 == undefined) {
                            tempUse2 = 0;
                        }
                        a[i][j] = tempUse2 - (factor * tempUse1);
                    }
                    b[i] = b[i] - factor * b[k];
                }
            }
            if (a[n][n] != 0) {
                m[n] = b[n] / a[n][n];
            }
            for (let k = (n - 1); k >= 1; k--) {
                let sum = 0;
                for (let j = (k + 1); j <= n; j++) {
                    let tempUse1 = a[k][j];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    sum = sum + tempUse1 * m[j];
                }
                m[k] = (b[k] - sum) / a[k][k];
            }

            for (let k = 0; k <= rec - 2; k++) {
                let tempUse1 = m[k];
                let tempUse2 = m[k + 1];
                if (tempUse1 == undefined) {
                    tempUse1 = 0;
                }
                if (tempUse2 == undefined) {
                    tempUse2 = 0;
                }

                let sk0, sk1, sk2, sk3;
                sk0 = xy[k][1];
                sk1 = d[k] - ((h[k] * ((2 * tempUse1) + tempUse2)) / 6);
                sk2 = tempUse1 / 2;
                sk3 = (tempUse2 - (m[k] == undefined ? 0 : m[k])) / (6 * h[k]);

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.001) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample2x.push(j);
                    sample2y.push(yp);
                }
            }
            // End of Efficiency Formula

            // Current Formula
            sample3x = [];
            sample3y = [];
            xy = [];
            k;
            jj;
            h = [];
            d = [];
            u = [];
            a = [];
            b = [];
            m = [];

            rec = trace3x.length;
            n = rec - 2;
            tempj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                trace3x[tempj] = trace3x[i];
                trace3y[tempj] = trace3y[i];
                tempj = tempj + 1;
            }

            // tempj = 0;

            // // debugger
            // for (let i = 0; i <= rec; i++) {
            //     let tempUse1 = xx[i];
            //     let tempUse2 = yy[i];
            //     if (tempUse1 == undefined) {
            //         tempUse1 = 0;
            //     }
            //     if (tempUse2 == undefined) {
            //         tempUse2 = 0;
            //     }
            //     trace3x[tempj] = tempUse1;
            //     trace3y[tempj] = tempUse2;
            //     tempj = tempj + 2;
            // }

            // ii = 1;
            // for (let i = ii; i <= tempj - 3; i = ii + 2) {
            //     trace3x[i] = (trace3x[i - 1] + trace3x[i + 1]) / 2;
            //     trace3y[i] = (trace3y[i - 1] + trace3y[i + 1]) / 2;
            //     ii = i;
            // }

            xy[0] = [];
            xy[0][0] = trace3x[0];
            xy[0][1] = trace3y[0];
            // rec = ii;

            sv = {{ $flowmetricsValuesASC[0]['fldRDis'] / 6.9 }};

            k = 1;
            jj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                for (let j = jj; j <= trace3x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace3y[i] + (j - trace3x[i]) * (((trace3y[i + 1]) - trace3y[(i)]) / (trace3x[i + 1] -
                            trace3x[i]));
                        xy[k] = [];
                        xy[k][0] = parseFloat(parseFloat(j).toFixed(2));
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }
            // debugger
            if (xy[k - 1][0] != trace3x[rec - 1]) {
                xy[k] = [];
                xy[k][0] = trace3x[rec - 1];
                xy[k][1] = trace3y[rec - 1];
            }
            rec = k + 1;

            for (let i = 0; i <= (rec - 2); i++) {
                var altXPlus1 = xy[i + 1][0];
                var altYPlus1 = xy[i + 1][1];
                if (altXPlus1 == undefined) {
                    altXPlus1 = 0;
                }
                if (altYPlus1 == undefined) {
                    altYPlus1 = 0;
                }
                h[i] = altXPlus1 - xy[i][0];
                d[i] = (altYPlus1 - xy[i][1]) / h[i];
                if (i > 0) {
                    u[i] = parseFloat(6 * (d[i] - d[i - 1])).toFixed(4);
                }
                if (i == 1) {
                    a[1] = [];
                    a[1][1] = 2 * (h[0] + h[1]);
                    a[1][2] = h[1];
                    b[1] = u[1];
                }
                if (i > 1 && i <= (rec - 3)) {
                    a[i] = [];
                    a[i][(i - 1)] = h[i - 1];
                    a[i][i] = 2 * (h[i - 1] + h[i]);
                    a[i][(i + 1)] = h[i];
                    b[i] = u[i];
                }
                if (i == (rec - 2)) {
                    a[i] = [];
                    a[rec - 2][rec - 3] = h[rec - 3];
                    a[rec - 2][rec - 2] = 2 * (h[rec - 3] + h[rec - 2]);
                    b[rec - 2] = u[rec - 2];
                }
            }
            n = rec - 2;

            for (let k = 1; k <= (n - 1); k++) {
                // Start Pivot
                var large, temp11, p;
                p = k;
                large = Math.abs(a[k][k]);
                for (let vi = (k + 1); vi <= n; vi++) {
                    if (Math.abs(a[vi][k]) > large) {
                        large = Math.abs(a[vi][k]);
                        p = 1;
                    }
                }
                if (p != k) {
                    for (let vj = k; vj <= n; vj++) {
                        temp11 = a[p][vj];
                        a[p][vj] = a[k][vj];
                        a[k][vj] = temp11;
                    }
                    temp11 = b[p];
                    b[p] = b[k];
                    b[k] = temp11;
                }
                // End Pivot
                // pivot(a, b, k, n);
                let factor;
                for (let i = (k + 1); i <= n; i++) {
                    let tempUse1 = a[i][k];
                    let tempUse2 = a[k][k];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    if (tempUse2 == undefined) {
                        tempUse2 = 0;
                    }
                    factor = tempUse1 / tempUse2;
                    for (let j = (k + 1); j <= n; j++) {
                        let tempUse1 = a[k][j];
                        let tempUse2 = a[i][j];
                        if (tempUse1 == undefined) {
                            tempUse1 = 0;
                        }
                        if (tempUse2 == undefined) {
                            tempUse2 = 0;
                        }
                        a[i][j] = tempUse2 - (factor * tempUse1);
                    }
                    b[i] = b[i] - factor * b[k];
                }
            }
            if (a[n][n] != 0) {
                m[n] = b[n] / a[n][n];
            }
            for (let k = (n - 1); k >= 1; k--) {
                let sum = 0;
                for (let j = (k + 1); j <= n; j++) {
                    let tempUse1 = a[k][j];
                    if (tempUse1 == undefined) {
                        tempUse1 = 0;
                    }
                    sum = sum + tempUse1 * m[j];
                }
                m[k] = (b[k] - sum) / a[k][k];
            }

            for (let k = 0; k <= rec - 2; k++) {
                let tempUse1 = m[k];
                let tempUse2 = m[k + 1];
                if (tempUse1 == undefined) {
                    tempUse1 = 0;
                }
                if (tempUse2 == undefined) {
                    tempUse2 = 0;
                }

                let sk0, sk1, sk2, sk3;
                sk0 = xy[k][1];
                sk1 = d[k] - ((h[k] * ((2 * tempUse1) + tempUse2)) / 6);
                sk2 = tempUse1 / 2;
                sk3 = (tempUse2 - (m[k] == undefined ? 0 : m[k])) / (6 * h[k]);

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.001) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample3x.push(j);
                    sample3y.push(yp);
                }
            }
            // trace3x.splice(1, 1);
            // trace3y.splice(1, 1);
            // trace3x.splice(2, 1);
            // trace3y.splice(2, 1);
            // trace3x.splice(3, 1);
            // trace3y.splice(3, 1);
            // trace3x.splice(4, 1);
            // trace3y.splice(4, 1);
            // trace3x.splice(5, 1);
            // trace3y.splice(5, 1);
            // trace3x.splice(6, 1);
            // trace3y.splice(6, 1);
            // trace3x.splice(6, 1);
            // trace3y.splice(6, 1);
            // End of Current Formula



            // Total Head

            trace1 = {
                x: sample1x,
                y: sample1y,
                name: 'TH',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: thLineColor
                },
            };

            trace1sub = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: thLineColor
                },
                showlegend: false
            };

            // End of Total Head

            // Efficiency

            trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'OAE',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                }
            };

            trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'OAE',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of Efficiency

            // Current

            trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'I',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
            };

            trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'I',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
                showlegend: false
            };

            // End of Current

            tracetest = {
                x: [],
                y: [],
                xaxis: selectedXAxis,
                type: 'scatter',
                line: {
                    color: '#2CA02C'
                }
            }

            // Duty Point Extend Calculation

            var A = [0, 0],
                B = [{{ $pumpValues['flddis'] }}, {{ $pumpValues['fldThead'] }}],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            var trace4 = {
                x: [0, {{ $pumpValues['flddis'] }}, p1[0], {{ $pumpValues['flddis'] }},
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0
                ],
                y: [0, {{ $pumpValues['fldThead'] }}, p1[1], {{ $pumpValues['fldThead'] }}, 0,
                    {{ $pumpValues['fldThead'] }}, {{ $pumpValues['fldThead'] }}
                ],
                name: 'Duty Point',
                type: 'scatter',
                line: {
                    color: '#D62728'
                },
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " +
                    "{{ $pumpValues['fldThead'] }}) Duty Point", ''
                ]
            };
            // End of Duty Point

            data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4, tracetest];

            layout = {
                title: {
                    text: 'G10',
                    font: {
                        size: 24
                    },
                },
                height: 850,
                // autosize: true,
                margin: {
                    l: 10,
                    r: 20,
                    b: 100,
                    t: 100,
                    pad: 4
                },
                xaxis: {
                    title: {
                        text: 'Q in Lps',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f'
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    dtick: {{ $isiGraphScaleValues['xaxis'] * 20 }} / 10,
                    ticklen: 10,
                    visible: visibleX1,
                },
                xaxis2: {
                    title: {
                        text: 'Q in us/gpm',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f',
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }} * unitForDischarge],
                    dtick: ({{ $isiGraphScaleValues['xaxis'] * 20 }} * unitForDischarge) / 10,
                    // ticks: '',
                    overlaying: 'x',
                    visible: visibleX2,
                },
                xaxis3: {
                    title: {
                        text: 'Q in m3/hr',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f',
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }} * unitForDischarge],
                    dtick: ({{ $isiGraphScaleValues['xaxis'] * 20 }} * unitForDischarge) / 10,
                    // ticks: '',
                    overlaying: 'x',
                    visible: visibleX3,
                },
                xaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f',
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 100 }}],
                    dtick: ({{ $isiGraphScaleValues['xaxis'] * 20 }}) / 10,
                    // ticks: '',
                    overlaying: 'x',
                    showticklabels: false
                },
                yaxis: {
                    title: {
                        text: 'TH',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#1f77b4'
                    },
                    tickfont: {
                        color: '#1f77b4'
                    },
                    position: 0.20,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis1'] * 18 }} / 18,
                    ticklen: 10,
                },
                yaxis2: {
                    title: {
                        text: 'OAE',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#ff7f0e'
                    },
                    tickfont: {
                        color: '#ff7f0e'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.12,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis2'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis3: {
                    title: {
                        text: 'I',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 100 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                    showticklabels: false
                },
            };

            var config = {
                displaylogo: false,
            }

            // Q vs TH Points Intercept Calculation
            var qvsthPoints = findLineIntercepts(trace1, trace4);

            if (qvsthPoints == undefined) {
                qvsthPoints.x = 0;
                qvsthPoints.y = 0;
            }
            // End Q vs TH Points Intercept Calculation

            if (qvsthPoints != undefined) {
                let newDutyPointLineX = [];
                let newDutyPointLineY = [];
                if (qvsthPoints.x <= {{ $pumpValues['flddis'] }} && qvsthPoints.y <= {{ $pumpValues['fldThead'] }}) {
                    newDutyPointLineX = [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }},
                        {{ $pumpValues['flddis'] }}, 0
                    ];
                    newDutyPointLineY = [0, {{ $pumpValues['fldThead'] }}, 0, {{ $pumpValues['fldThead'] }},
                        {{ $pumpValues['fldThead'] }}
                    ];
                    symbols = ['line-ew', "line-ew", "line-ew", "", "line-ew"];
                    texts = ['', '', '', "(" + {{ $pumpValues['flddis'] }} + ", " + {{ $pumpValues['fldThead'] }} +
                        ") Duty Point", ''
                    ];
                } else {
                    newDutyPointLineX = [0, {{ $pumpValues['flddis'] }}, qvsthPoints.x, {{ $pumpValues['flddis'] }},
                        {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }},
                        0
                    ];
                    newDutyPointLineY = [0, {{ $pumpValues['fldThead'] }}, qvsthPoints.y,
                        {{ $pumpValues['fldThead'] }},
                        0, {{ $pumpValues['fldThead'] }},
                        {{ $pumpValues['fldThead'] }}
                    ];
                    symbols = ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew"];
                    texts = ['', '', '', '', '', "(" + {{ $pumpValues['flddis'] }} + ", " +
                        {{ $pumpValues['fldThead'] }} + ") Duty Point"
                    ];
                }

                // Duty Point
                var trace4Replaced = {
                    x: newDutyPointLineX,
                    y: newDutyPointLineY,
                    name: 'Duty Point',
                    type: 'scatter',
                    marker: {
                        size: 15,
                        symbol: symbols
                    },
                    line: {
                        color: '#D62728'
                    },
                    hoverinfo: 'text',
                    text: texts
                };
                data[6] = trace4Replaced;
                // End of Duty Point Replace
            }


            Plotly.newPlot('myDiv', data, layout, config);
        }

        function obsValues(discharge = {{ $pumpValues['flddis'] }}, tHead = {{ $pumpValues['fldThead'] }}, headR1 =
            {{ $pumpValues['fldHeadr1'] }}, headR2 = {{ $pumpValues['fldHeadr2'] }}) {
            // Total Head

            var trace1 = {
                x: sample1x,
                y: sample1y,
                name: 'TH',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: thLineColor
                },
            };

            var trace1sub = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: thLineColor
                },
                showlegend: false
            };

            // End of Total Head

            // Efficiency

            var trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'OAE',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                }
            };

            var trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'OAE',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of Efficiency

            // Current

            var trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'I',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
            };

            var trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'I',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
                showlegend: false
            };

            // End of Current

            // Duty Point Extend Calculation

            var A = [0, 0],
                B = [discharge, tHead],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            var trace4 = {
                x: [0, discharge, p1[0], discharge, discharge, discharge],
                y: [0, tHead, p1[1], tHead, 0, tHead],
                name: 'Duty Point',
                type: 'scatter',
                line: {
                    color: '#D62728'
                },
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', "(" + discharge + ", " + tHead + ") Duty Point", '']
            };
            // End of Duty Point

            var data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4];

            var layout = {
                title: {
                    text: 'G10',
                    font: {
                        size: 24
                    },
                },
                height: 850,
                autosize: true,
                margin: {
                    l: 10,
                    r: 20,
                    b: 100,
                    t: 100,
                    pad: 4
                },
                xaxis: {
                    title: {
                        text: 'Q',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    dtick: {{ $isiGraphScaleValues['xaxis'] * 20 }} / 10,
                    ticklen: 10,
                },
                xaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f',
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 100 }}],
                    dtick: ({{ $isiGraphScaleValues['xaxis'] * 20 }}) / 10,
                    // ticks: '',
                    overlaying: 'x',
                    showticklabels: false
                },
                yaxis: {
                    title: {
                        text: 'TH',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#1f77b4'
                    },
                    tickfont: {
                        color: '#1f77b4'
                    },
                    position: 0.20,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis1'] * 18 }} / 18,
                    ticklen: 10,
                },
                yaxis2: {
                    title: {
                        text: 'OAE',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#ff7f0e'
                    },
                    tickfont: {
                        color: '#ff7f0e'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.12,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis2'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis3: {
                    title: {
                        text: 'I',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 100 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                    showticklabels: false
                },
            };

            var config = {
                displaylogo: false,
            }

            Plotly.newPlot('myDiv', data, layout, config);

            // Q vs TH Points Intercept Calculation
            var qvsthPoints = findLineIntercepts(trace1, trace4);

            if (qvsthPoints == undefined) {
                qvsthPoints.x = 0;
                qvsthPoints.y = 0;
            }
            // End Q vs TH Points Intercept Calculation

            // Q vs TH Line
            var trace5 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsthPoints.y).toFixed(2), parseFloat(qvsthPoints.y).toFixed(2)],
                name: 'Q vs TH',
                type: 'scatter',
                // line: {
                //     color: '#8C564B'
                // }
            };

            if (qvsthPoints != undefined) {
                // Duty Point Replace
                let newDutyPointLineX = [];
                let newDutyPointLineY = [];
                let symbols = [];
                let texts = [];
                if (qvsthPoints.x <= discharge && qvsthPoints.y <= tHead) {
                    newDutyPointLineX = [0, discharge, discharge, discharge];
                    newDutyPointLineY = [0, tHead, 0, tHead];
                    symbols = ['line-ew', "line-ew", "line-ew", ""];
                    texts = ['', '', '', "(" + discharge + ", " + tHead + ") Duty Point"];
                } else {
                    newDutyPointLineX = [0, discharge, qvsthPoints.x, discharge, discharge, discharge];
                    newDutyPointLineY = [0, tHead, qvsthPoints.y, tHead, 0, tHead];
                    symbols = ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew"];
                    texts = ['', '', '', '', '', "(" + discharge + ", " + tHead + ") Duty Point"];
                }
                var trace4Replaced = {
                    x: newDutyPointLineX,
                    y: newDutyPointLineY,
                    name: 'Duty Point',
                    type: 'scatter',
                    marker: {
                        size: 15,
                        symbol: symbols
                    },
                    line: {
                        color: '#7F7F7F',
                    },
                    hoverinfo: 'text',
                    text: texts
                };
                data[6] = trace4Replaced;
                // End of Duty Point Replace
            }


            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            $('#reportObsDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#reportObsTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            if (parseFloat(qvsthPoints.x).toFixed(2) >= discharge && parseFloat(qvsthPoints.y).toFixed(
                    2) >= tHead) {
                $('#dischargeResult').html('Pass');
                $('#thResult').html('Pass');
            } else {
                let chkval = (Math.pow(((tHead * 0.04) / (tHead -
                    parseFloat(qvsthPoints.y).toFixed(2))), 2) + Math.pow(((discharge * 0.07) /
                    (discharge - parseFloat(qvsthPoints.x).toFixed(2))), 2));

                $('#chkval').html('Check Value ' + chkval);
                if (chkval >= 1) {
                    $('#dischargeResult').html('Pass');
                    $('#thResult').html('Pass');
                } else {
                    $('#dischargeResult').html('Fail');
                    $('#thResult').html('Fail');
                }
            }

            // End of Q vs TH Line

            // Q vs OAE Line
            var trace6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2)],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                name: 'Q vs OAE',
                yaxis: 'y2',
                type: 'scatter'
            };
            // End of Q vs OAE Line

            // Head Range (e.g: 13)
            var trace7 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [headR1, headR1],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4
                }
            };
            // End of Head Range (e.g: 13)

            // Head Range (e.g: 15)
            var trace8 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [headR2, headR2],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4
                }
            };
            // End of Head Range (e.g: 13)

            data.push(trace5);
            data.push(trace6);
            data.push(trace7);
            data.push(trace8);

            Plotly.newPlot('myDiv', data, layout, config);



            // Q vs OAE Points Intercept Calculation
            var qvsoaePoints = findLineIntercepts(trace2, trace6);

            //////////// Plotly.extendTraces(myDiv, 
            //////////// {
            ////////////     x:[[parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2)]],
            ////////////     y:[[25.92, parseFloat(qvsoaePoints.y).toFixed(2)]]
            //////////// }, [5]);

            var traceReplaced6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsoaePoints.y).toFixed(2), parseFloat(qvsoaePoints.y).toFixed(2)],
                name: 'Q vs OAE',
                yaxis: 'y2',
                type: 'scatter',
            };

            data[8] = traceReplaced6;

            $('#observedOAE').html(parseFloat(qvsoaePoints.y).toFixed(2));
            $('#addOeff').val(parseFloat(qvsoaePoints.y).toFixed(2));
            $('#reportObsOeff').val(parseFloat(qvsoaePoints.y).toFixed(2));

            if ('{{ $pumpValues['fldtol'] }}' == 'With Tolerance') {
                if (parseFloat(qvsoaePoints.y).toFixed(2) >= {{ $pumpValues['fldoeff'] }}) {
                    $('#oaeResult').html('Pass');
                } else {
                    if (parseFloat(qvsoaePoints.y).toFixed(2) >= ({{ $pumpValues['fldoeff'] }} * 0.955)) {
                        $('#oaeResult').html('Pass');
                    } else {
                        $('#oaeResult').html('Fail');
                    }
                }
            } else {
                if (parseFloat(qvsoaePoints.y).toFixed(2) >= {{ $pumpValues['fldoeff'] }}) {
                    $('#oaeResult').html('Pass');
                } else {
                    $('#oaeResult').html('Fail');
                }
            }

            // End Q vs OAE Points Intercept Calculation


            // Trace 7 Points Intercept Calculation
            var headRangeTHIntercept = findLineIntercepts(trace1, trace7);

            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2),
                    parseFloat(headRangeTHIntercept.x).toFixed(2)
                ],
                y: [headR1, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}, 0
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4
                }
            }

            data[9] = traceReplaced7;
            // End Trace 7 Points Intercept Calculation

            // Trace 8 Points Intercept Calculation
            var headRangeTHIntercept2 = findLineIntercepts(trace1, trace8);

            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2),
                    parseFloat(headRangeTHIntercept2.x).toFixed(2)
                ],
                y: [headR2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}, 0
                ],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4
                }
            }

            data[10] = traceReplaced8;
            // End Trace 8 Points Intercept Calculation
            Plotly.newPlot('myDiv', data, layout, config);

            var headRangeIIntercept = findLineIntercepts(trace3, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2)],
                y: [headR1, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    headRangeIIntercept.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            }

            data[9] = traceReplaced7;
            // End of Trace 7 Reassign

            var headRangeIIntercept2 = findLineIntercepts(trace3, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2)],
                y: [headR2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    headRangeIIntercept2.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            }

            data[10] = traceReplaced8;
            // End of Trace 7 Reassign

            var trace3SubTrace = {
                x: [headRangeIIntercept.x, 0],
                y: [headRangeIIntercept.y, headRangeIIntercept.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            };

            data.push(trace3SubTrace);

            var trace3SubTrace2 = {
                x: [headRangeIIntercept2.x, 0],
                y: [headRangeIIntercept2.y, headRangeIIntercept2.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            };

            data.push(trace3SubTrace2);

            if (headRangeIIntercept.y > headRangeIIntercept2.y) {
                $('#observedI').html(parseFloat(headRangeIIntercept.y).toFixed(2));
                $('#addCurr').val(parseFloat(headRangeIIntercept.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(headRangeIIntercept.y).toFixed(2));

                if (parseFloat(headRangeIIntercept.y).toFixed(2) <= ({{ $pumpValues['fldMcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            } else {
                $('#observedI').html(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#addCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));

                if (parseFloat(headRangeIIntercept2.y).toFixed(2) <= ({{ $pumpValues['fldMcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            }

            // Plotly.deleteTraces('myDiv', [6, 7]);

            var dpjoinTrace = {
                x: [discharge, 0],
                y: [tHead, tHead],
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: '#7F7F7F'
                },
                showlegend: false
            }

            data.push(dpjoinTrace);

            Plotly.newPlot('myDiv', data, layout, config);

            let g1GraphData = data;
            let g1GraphLayout = layout;

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#oaeResult').html() ==
                'Pass' &&
                $('#iResult').html() == 'Pass') {
                $('#overallResult').html('<i class="material-icons left pt-1 green-text">circle</i>Pump Pass');
            } else {
                $('#overallResult').html('<i class="material-icons left pt-1 red-text">circle</i>Pump Fail');
            }

            // Discharge Chart
            var trace1 = {
                x: ['Discharge'],
                y: [discharge],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Discharge'],
                y: [parseFloat(qvsthPoints.x).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            var layout = {
                autosize: false,
                width: 400,
                height: 300,
                barmode: 'group',
            };

            config = {
                displaylogo: false
            }

            Plotly.newPlot('dischargeBarChart', data, layout, config);
            // End Discharge BarChart

            // Total Head BarChart
            var trace1 = {
                x: ['Total Head'],
                y: [tHead],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Total Head'],
                y: [parseFloat(qvsthPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('thBarChart', data, layout, config);
            // End Total Head BarChart

            // Efficiency BarChart
            var trace1 = {
                x: ['Efficiency'],
                y: [{{ $pumpValues['fldoeff'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Efficiency'],
                y: [parseFloat(qvsoaePoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('effBarChart', data, layout, config);
            // End Efficiency BarChart

            // Current BarChart
            var trace1 = {
                x: ['Current'],
                y: [{{ $pumpValues['fldMcurr'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Current'],
                y: [$('#observedI').html()],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('currBarChart', data, layout, config);
            // End Current BarChart

            // Discharge PieChart
            var data = [{
                values: [discharge, parseFloat(qvsthPoints.x).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [discharge, parseFloat(qvsthPoints.x).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            var layout = {
                width: 400,
                height: 300,
            };

            Plotly.newPlot('dischargePieChart', data, layout, config);
            // End of Discharge PieChart

            // Total Head PieChart
            var data = [{
                values: [tHead, parseFloat(qvsthPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [tHead, parseFloat(qvsthPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('thPieChart', data, layout, config);
            // End of Total Head PieChart

            // Efficiency PieChart
            var data = [{
                values: [{{ $pumpValues['fldoeff'] }}, parseFloat(qvsoaePoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldoeff'] }}, parseFloat(qvsoaePoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('effPieChart', data, layout, config);
            // End of Efficiency PieChart

            // Current PieChart
            var data = [{
                values: [{{ $pumpValues['fldMcurr'] }}, $('#observedI').html()],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldMcurr'] }}, $('#observedI').html()],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('currPieChart', data, layout, config);
            // End of Current PieChart

            $('#obsValuesModal').modal('open');

            $('#openGrid').removeAttr('checked');
            $('#showPoints').removeAttr('checked');

            if ($('#observedQ').html() == 'NaN') {
                $('#observedQ').html('');
            }
            if ($('#observedTH').html() == 'NaN') {
                $('#observedTH').html('');
            }
            if ($('#observedOAE').html() == 'NaN') {
                $('#observedOAE').html('');
            }
            if ($('#observedI').html() == 'NaN') {
                $('#observedI').html('');
            }
            $('#btnReport').attr('disabled', false);
            $('#btnAddPrint').attr('disabled', false);
        }

        function dutyPointModalOpen() {
            console.log(globalDischarge);
            console.log(globalTotalHead);
            console.log(globalHeadRange1);
            console.log(globalHeadRange2);
            if (globalDischarge == 0 && globalTotalHead == 0 && globalHeadRange1 == 0 && globalHeadRange2 == 0) {
                $('#dutyDischarge').val('{{ $pumpValues['flddis'] }}');
                $('#dutyTHead').val('{{ $pumpValues['fldThead'] }}');
                $('#dutyHRange1').val('{{ $pumpValues['fldHeadr1'] }}');
                $('#dutyHRange2').val('{{ $pumpValues['fldHeadr2'] }}');
            } else {
                $('#dutyDischarge').val(globalDischarge);
                $('#dutyTHead').val(globalTotalHead);
                $('#dutyHRange1').val(globalHeadRange1);
                $('#dutyHRange2').val(globalHeadRange2);
            }
            $('#dutyPointChangeModal').modal('open');
        }

        $('#changeDutyPointBtn').click(function(e) {
            globalDischarge = $('#dutyDischarge').val();
            globalTotalHead = $('#dutyTHead').val();
            globalHeadRange1 = $('#dutyHRange1').val();
            globalHeadRange2 = $('#dutyHRange2').val();
            $('#reportH1').val(globalHeadRange1);
            $('#reportH2').val(globalHeadRange2);
            $('#btnReport').attr('disabled', false);
            $('#btnAddPrint').attr('disabled', false);
            // obsValues(globalDischarge, globalTotalHead, globalHeadRange1, globalHeadRange2);
            $('#declaredDis').html(globalDischarge);
            $('#declaredTHead').html(globalTotalHead);
            newDutyPoint(globalDischarge, globalTotalHead, globalHeadRange1, globalHeadRange2);
        });

        function newDutyPoint(globalDischarge, globalTotalHead, globalHeadRange1, globalHeadRange2) {

            // Total Head

            var trace1 = {
                x: sample1x,
                y: sample1y,
                name: 'TH',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: thLineColor
                },
            };

            var trace1sub = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: thLineColor
                },
                showlegend: false
            };

            // End of Total Head

            // Efficiency

            var trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'OAE',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                }
            };

            var trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'OAE',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of Efficiency

            // Current

            var trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'I',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
            };

            var trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'I',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: currLineColor
                },
                showlegend: false
            };

            // End of Current

            // Duty Point Extend Calculation

            var A = [0, 0],
                B = [globalDischarge, globalTotalHead],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            var trace4 = {
                x: [0, globalDischarge, p1[0], globalDischarge, globalDischarge, globalDischarge],
                y: [0, globalTotalHead, p1[1], globalTotalHead, 0, globalTotalHead],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', "(" + globalDischarge + ", " + globalTotalHead + ") Duty Point", '']
            };
            // End of Duty Point

            var data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4];

            var layout = {
                title: {
                    text: 'G10',
                    font: {
                        size: 24
                    },
                },
                height: 850,
                autosize: true,
                margin: {
                    l: 10,
                    r: 20,
                    b: 100,
                    t: 100,
                    pad: 4
                },
                xaxis: {
                    title: {
                        text: 'Q',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    dtick: {{ $isiGraphScaleValues['xaxis'] * 20 }} / 10,
                    ticklen: 10,
                },
                xaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f',
                    },
                    domain: [0.2, 1.0],
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['xaxis'] * 100 }}],
                    dtick: ({{ $isiGraphScaleValues['xaxis'] * 20 }}) / 10,
                    // ticks: '',
                    overlaying: 'x',
                    showticklabels: false
                },
                yaxis: {
                    title: {
                        text: 'TH',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#1f77b4'
                    },
                    tickfont: {
                        color: '#1f77b4'
                    },
                    position: 0.20,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis1'] * 18 }} / 18,
                    ticklen: 10,
                },
                yaxis2: {
                    title: {
                        text: 'OAE',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#ff7f0e'
                    },
                    tickfont: {
                        color: '#ff7f0e'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.12,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis2'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis3: {
                    title: {
                        text: 'I',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 18 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                },
                yaxis4: {
                    gridcolor: "grey",
                    title: {
                        text: '',
                        font: {
                            size: 12,
                            color: '#7f7f7f'
                        },
                    },
                    titlefont: {
                        color: '#d62728'
                    },
                    tickfont: {
                        color: '#2CA02C'
                    },
                    anchor: 'free',
                    overlaying: 'y',
                    side: 'left',
                    position: 0.05,
                    autorange: false,
                    range: [0, {{ $isiGraphScaleValues['yaxis3'] * 100 }}],
                    dtick: {{ $isiGraphScaleValues['yaxis3'] * 18 }} / 18,
                    ticklen: 0,
                    showticklabels: false
                },
            };

            var config = {
                displaylogo: false,
            }

            // Q vs TH Points Intercept Calculation
            var qvsthPoints = findLineIntercepts(trace1, trace4);

            if (qvsthPoints == undefined) {
                qvsthPoints.x = 0;
                qvsthPoints.y = 0;
            }
            // End Q vs TH Points Intercept Calculation

            // Q vs TH Line
            var trace5 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsthPoints.y).toFixed(2), parseFloat(qvsthPoints.y).toFixed(2)],
                name: 'Q vs TH',
                type: 'scatter',
                // line: {
                //     color: '#8C564B'
                // }
            };

            let randomColor = getRandomColor();

            if (qvsthPoints != undefined) {
                // Duty Point Replace
                let newDutyPointLineX = [];
                let newDutyPointLineY = [];
                if (qvsthPoints.x <= globalDischarge && qvsthPoints.y <= globalTotalHead) {
                    newDutyPointLineX = [0, globalDischarge, globalDischarge, globalDischarge, 0];
                    newDutyPointLineY = [0, globalTotalHead, 0, globalTotalHead, globalTotalHead];
                } else {
                    newDutyPointLineX = [0, globalDischarge, qvsthPoints.x, globalDischarge, globalDischarge,
                        globalDischarge,
                        0
                    ];
                    newDutyPointLineY = [0, globalTotalHead, qvsthPoints.y, globalTotalHead, 0, globalTotalHead,
                        globalTotalHead
                    ];
                }
                var trace4Replaced = {
                    x: newDutyPointLineX,
                    y: newDutyPointLineY,
                    name: 'Duty Point',
                    type: 'scatter',
                    marker: {
                        size: 15,
                        symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                    },
                    line: {
                        color: randomColor,
                    },
                    hoverinfo: 'text',
                    text: ['', '', '', "(" + globalDischarge + ", " + globalTotalHead + ") Duty Point", '', '', '']
                };
                console.log(data[6]);
                data[6] = trace4Replaced;
            }

            // End of Duty Point Replace

            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            $('#reportObsDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#reportObsTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            if (parseFloat(qvsthPoints.x).toFixed(2) >= globalDischarge && parseFloat(qvsthPoints.y).toFixed(
                    2) >= globalTotalHead) {
                $('#dischargeResult').html('Pass');
                $('#thResult').html('Pass');
            } else {
                let chkval = (Math.pow(((globalTotalHead * 0.04) / (globalTotalHead -
                    parseFloat(qvsthPoints.y).toFixed(2))), 2) + Math.pow(((globalDischarge * 0.07) /
                    (globalDischarge - parseFloat(qvsthPoints.x).toFixed(2))), 2));

                $('#chkval').html('Check Value ' + chkval);
                if (chkval >= 1) {
                    $('#dischargeResult').html('Pass');
                    $('#thResult').html('Pass');
                } else {
                    $('#dischargeResult').html('Fail');
                    $('#thResult').html('Fail');
                }
            }

            // End of Q vs TH Line

            // Q vs OAE Line
            var trace6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2)],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                name: 'Q vs OAE',
                yaxis: 'y2',
                type: 'scatter'
            };
            // End of Q vs OAE Line

            // Head Range (e.g: 13)
            var trace7 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [globalHeadRange1, globalHeadRange1],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#E377C2'
                }
            };
            // End of Head Range (e.g: 13)

            // Head Range (e.g: 15)
            var trace8 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [globalHeadRange2, globalHeadRange2],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#7F7F7F'
                }
            };
            // End of Head Range (e.g: 13)

            data.push(trace5);
            data.push(trace6);
            data.push(trace7);
            data.push(trace8);

            Plotly.newPlot('dummyDiv', data, layout, config);



            // Q vs OAE Points Intercept Calculation
            var qvsoaePoints = findLineIntercepts(trace2, trace6);

            var traceReplaced6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsoaePoints.y).toFixed(2), parseFloat(qvsoaePoints.y).toFixed(2)],
                name: 'Q vs OAE',
                yaxis: 'y2',
                type: 'scatter',
            };

            data[5] = traceReplaced6;

            $('#observedOAE').html(parseFloat(qvsoaePoints.y).toFixed(2));
            $('#addOeff').val(parseFloat(qvsoaePoints.y).toFixed(2));
            $('#reportObsOeff').val(parseFloat(qvsoaePoints.y).toFixed(2));

            if ('{{ $pumpValues['fldtol'] }}' == 'With Tolerance') {
                if (parseFloat(qvsoaePoints.y).toFixed(2) >= {{ $pumpValues['fldoeff'] }}) {
                    $('#oaeResult').html('Pass');
                } else {
                    if (parseFloat(qvsoaePoints.y).toFixed(2) >= ({{ $pumpValues['fldoeff'] }} * 0.955)) {
                        $('#oaeResult').html('Pass');
                    } else {
                        $('#oaeResult').html('Fail');
                    }
                }
            } else {
                if (parseFloat(qvsoaePoints.y).toFixed(2) >= {{ $pumpValues['fldoeff'] }}) {
                    $('#oaeResult').html('Pass');
                } else {
                    $('#oaeResult').html('Fail');
                }
            }
            // End Q vs OAE Points Intercept Calculation


            // Trace 7 Points Intercept Calculation
            var headRangeTHIntercept = findLineIntercepts(trace1, trace7);

            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2),
                    parseFloat(headRangeTHIntercept.x).toFixed(2)
                ],
                y: [globalHeadRange1, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}, 0
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#E377C2'
                }
            }

            data[6] = traceReplaced7;
            // End Trace 7 Points Intercept Calculation

            // Trace 8 Points Intercept Calculation
            var headRangeTHIntercept2 = findLineIntercepts(trace1, trace8);

            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2),
                    parseFloat(headRangeTHIntercept2.x).toFixed(2)
                ],
                y: [globalHeadRange2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}, 0
                ],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#7F7F7F'
                }
            }

            data[7] = traceReplaced8;
            // End Trace 8 Points Intercept Calculation
            Plotly.newPlot('dummyDiv', data, layout, config);

            var headRangeIIntercept = findLineIntercepts(trace3, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2)],
                y: [globalHeadRange1, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    headRangeIIntercept.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            }

            data[6] = traceReplaced7;
            // End of Trace 7 Reassign

            var headRangeIIntercept2 = findLineIntercepts(trace3, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2)],
                y: [globalHeadRange2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    headRangeIIntercept2.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            }

            data[7] = traceReplaced8;
            // End of Trace 7 Reassign

            var trace3SubTrace = {
                x: [headRangeIIntercept.x, 0],
                y: [headRangeIIntercept.y, headRangeIIntercept.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            };

            data.push(trace3SubTrace);

            var trace3SubTrace2 = {
                x: [headRangeIIntercept2.x, 0],
                y: [headRangeIIntercept2.y, headRangeIIntercept2.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            };

            data.push(trace3SubTrace2);

            if (headRangeIIntercept.y > headRangeIIntercept2.y) {
                $('#observedI').html(parseFloat(headRangeIIntercept.y).toFixed(2));
                $('#addCurr').val(parseFloat(headRangeIIntercept.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(headRangeIIntercept.y).toFixed(2));

                if (parseFloat(headRangeIIntercept.y).toFixed(2) <= ({{ $pumpValues['fldMcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            } else {
                $('#observedI').html(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#addCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));

                if (parseFloat(headRangeIIntercept2.y).toFixed(2) <= ({{ $pumpValues['fldMcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            }

            Plotly.newPlot('dummyDiv', data, layout, config);

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#oaeResult').html() ==
                'Pass' &&
                $('#iResult').html() == 'Pass') {
                $('#overallResult').html('<i class="material-icons left pt-1 green-text">circle</i>Pump Pass');
            } else {
                $('#overallResult').html('<i class="material-icons left pt-1 red-text">circle</i>Pump Fail');
            }

            // Discharge BarChart
            var trace1 = {
                x: ['Discharge'],
                y: [globalDischarge],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Discharge'],
                y: [parseFloat(qvsthPoints.x).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            var layout = {
                autosize: false,
                width: 400,
                height: 300,
                barmode: 'group',
            };

            config = {
                displaylogo: false
            }

            Plotly.newPlot('dischargeBarChart', data, layout, config);
            // End Discharge BarChart

            // Total Head BarChart
            var trace1 = {
                x: ['Total Head'],
                y: [globalTotalHead],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Total Head'],
                y: [parseFloat(qvsthPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('thBarChart', data, layout, config);
            // End Total Head BarChart

            // Efficiency BarChart
            var trace1 = {
                x: ['Efficiency'],
                y: [{{ $pumpValues['fldoeff'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Efficiency'],
                y: [parseFloat(qvsoaePoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('effBarChart', data, layout, config);
            // End Efficiency BarChart

            // Current BarChart
            var trace1 = {
                x: ['Current'],
                y: [{{ $pumpValues['fldMcurr'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Current'],
                y: [$('#observedI').html()],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('currBarChart', data, layout, config);
            // End Current BarChart

            // Discharge PieChart
            var data = [{
                values: [globalDischarge, parseFloat(qvsthPoints.x).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [globalDischarge, parseFloat(qvsthPoints.x).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            var layout = {
                width: 400,
                height: 300,
            };

            Plotly.newPlot('dischargePieChart', data, layout, config);
            // End of Discharge PieChart

            // Total Head PieChart
            var data = [{
                values: [globalTotalHead, parseFloat(qvsthPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [globalTotalHead, parseFloat(qvsthPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('thPieChart', data, layout, config);
            // End of Total Head PieChart

            // Efficiency PieChart
            var data = [{
                values: [{{ $pumpValues['fldoeff'] }}, parseFloat(qvsoaePoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldoeff'] }}, parseFloat(qvsoaePoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('effPieChart', data, layout, config);
            // End of Efficiency PieChart

            // Current PieChart
            var data = [{
                values: [{{ $pumpValues['fldMcurr'] }}, $('#observedI').html()],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldMcurr'] }}, $('#observedI').html()],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('currPieChart', data, layout, config);
            // End of Current PieChart

            Plotly.addTraces('myDiv', [trace4Replaced, trace5, traceReplaced6, traceReplaced7, traceReplaced8,
                trace3SubTrace,
                trace3SubTrace2
            ]);

            $('#obsValuesModal').modal('open');

            $('#openGrid').removeAttr('checked');
            $('#showPoints').removeAttr('checked');

            if ($('#observedQ').html() == 'NaN') {
                $('#observedQ').html('');
            }
            if ($('#observedTH').html() == 'NaN') {
                $('#observedTH').html('');
            }
            if ($('#observedOAE').html() == 'NaN') {
                $('#observedOAE').html('');
            }
            if ($('#observedI').html() == 'NaN') {
                $('#observedI').html('');
            }
        }

        function thvsq() {
            let totalHead;
            if (totalHead = prompt('Enter Total Head')) {

                // let trace1x = [];
                // let trace1y = [];

                @foreach ($flowmetricsValues as $flow)
                    // trace1x.push({{ $flow['fldRDis'] }});
                    // trace1y.push({{ $flow['fldRTHead'] }});
                    // @endforeach

                var trace1 = {
                    x: sample1x,
                    y: sample1y,
                };

                var totalHeadLineTrace = {
                    x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    y: [totalHead, totalHead],
                }

                var data = [trace1, totalHeadLineTrace];

                var layout = {
                    xaxis: {
                        range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    },
                    yaxis: {
                        range: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                        dtick: {{ $isiGraphScaleValues['yaxis1'] * 18 }} / 18,
                    },
                };

                var thIntercept = findLineIntercepts(trace1, totalHeadLineTrace);

                var totalHeadLineTraceReplace = {
                    x: [0, thIntercept.x, thIntercept.x],
                    y: [totalHead, totalHead, 0],
                    name: 'Total Head at ' + totalHead,
                    type: 'scatter',
                    line: {
                        dash: 'dot',
                        width: 2
                    }
                }

                data[1] = totalHeadLineTraceReplace;

                Plotly.addTraces('myDiv', totalHeadLineTraceReplace);
            }
        }

        function qvsth() {
            let discharge;
            if (discharge = prompt('Enter Discharge')) {

                // let trace1x = [];
                // let trace1y = [];

                @foreach ($flowmetricsValues as $flow)
                    // trace1x.push({{ $flow['fldRDis'] }});
                    // trace1y.push({{ $flow['fldRTHead'] }});
                    // @endforeach

                var trace1 = {
                    x: sample1x,
                    y: sample1y,
                };

                var dischargeLineTrace = {
                    x: [discharge, discharge],
                    y: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                }

                var data = [trace1, dischargeLineTrace];

                var layout = {
                    xaxis: {
                        range: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                    },
                    yaxis: {
                        range: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                        dtick: {{ $isiGraphScaleValues['yaxis1'] * 18 }} / 18,
                    },
                };

                var thIntercept = findLineIntercepts(trace1, dischargeLineTrace);

                var dischargeLineTraceReplace = {
                    x: [discharge, discharge, 0],
                    y: [0, thIntercept.y, thIntercept.y],
                    name: 'Discharge at ' + discharge,
                    type: 'scatter',
                    line: {
                        dash: 'dot',
                        width: 2
                    }
                }

                data[1] = dischargeLineTraceReplace;

                // Plotly.newPlot('myDiv', data, layout, config);

                Plotly.addTraces('myDiv', dischargeLineTraceReplace);
            }
        }

        let pointPicked = false;
        let pickedPointType = '';

        function pickPoint() {
            $('#pickPointModal').modal('open');

            $('#pickablePointSelection').click(function() {
                let selectedPick = $('input[name="pickablePoint"]:checked').val();
                if (selectedPick) {
                    let heatx = 0;
                    let heaty = 0;
                    let heatz = 0;
                    if (selectedPick == 'TH') {
                        clickPoint(trace1sub);
                        pickedPointType = 'TH';
                    } else if (selectedPick == 'OAE') {
                        clickPoint(trace2sub);
                        pickedPointType = 'OAE';
                    } else {
                        clickPoint(trace3sub);
                        pickedPointType = 'I';
                    }
                    pointPicked = true;
                }
            });
        }

        function clickPoint(trace) {
            let tracePosition = -1;

            let changedTrace;

            var myPlot = document.getElementById('myDiv');
            myPlot.on('plotly_click', function(dataa) {
                let tracex = [];
                let tracey = [];
                var pts = [];
                for (var i = 0; i < dataa.points.length; i++) {
                    pts.x = dataa.points[i].x;
                    pts.y = dataa.points[i].y;
                }
                for (let i = 0; i < trace.x.length; i++) {
                    const x = trace.x[i];
                    const y = trace.y[i];

                    let yAxis = 'y1';

                    if (x == pts.x && y == pts.y) {
                        console.log(x + '<br>' + y);
                        if (pickedPointType == 'TH') {
                            tracePosition = 1;
                            heatx = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            yAxis = 'y1';
                        } else if (pickedPointType == 'OAE') {
                            tracePosition = 3;
                            heatx = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            yAxis = 'y2';
                        } else {
                            tracePosition = 5;
                            heatx = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            yAxis = 'y3';
                        }
                        // defaultGraph();
                        // Heatmap
                        var heatmapTrace = {
                            x: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heatx)[0],
                            y: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heaty)[1],
                            z: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heatz)[2],
                            type: 'heatmap',
                            colorscale: [
                                ['0.0', 'rgb(255, 255, 255, 0.5)'],
                                ['1.0', 'rgb(255, 255, 255, 0.5)']
                            ],
                            name: pickedPointType + ' Points',
                            xgap: 1,
                            ygap: 1,
                            showscale: false,
                            yaxis: yAxis
                        }
                        // End of Heatmap

                        Plotly.addTraces('myDiv', heatmapTrace);

                        var myPlot = document.getElementById('myDiv');
                        myPlot.on('plotly_click', function(datas) {
                            var dataTrace = datas.points.filter(obj => {
                                return obj.curveNumber >= 4;
                            });
                            console.log(dataTrace);
                            for (let i = 0; i < trace.x.length; i++) {
                                const x = trace.x[i];
                                const y = trace.y[i];

                                if (x == pts.x && y == pts.y) {
                                    tracex.push(x);
                                    tracey.push(dataTrace[0].y);
                                } else {
                                    tracex.push(x);
                                    tracey.push(y);
                                }

                            }
                            changedTrace = {
                                x: tracex,
                                y: tracey,
                                name: pickedPointType,
                                type: 'scatter',
                                yaxis: yAxis
                            }

                            console.log(changedTrace);

                            console.log(data);

                            console.log(tracePosition);

                            data[tracePosition] = changedTrace;

                            if (pickedPointType == 'TH') {
                                trace1sub = changedTrace;
                                trace1y = changedTrace.y;
                            } else if (pickedPointType == 'OAE') {
                                trace2sub = changedTrace;
                                trace2y = changedTrace.y;
                            } else {
                                trace3sub = changedTrace;
                                trace3y = changedTrace.y;
                            }

                            data.splice(data.length - 1);

                            defaultGraph();

                            // Plotly.newPlot('myDiv', data, layout, {
                            //     displaylogo: false
                            // });
                            if (pointPicked) {
                                clickPoint(changedTrace);
                            }
                            // }
                        });
                    }
                }
            });
        }

        function changeLineColor(trace, colorInput) {
            $('#myDiv')[0].data[trace].line.color = $('#' + colorInput).val();
            $('#myDiv')[0].data[trace + 1].line.color = $('#' + colorInput).val();
            console.log($('#myDiv')[0].data[trace].line.color);

            Plotly.redraw('myDiv', {});
        }

        function changeTextColor(axis, colorInput) {
            switch (axis) {
                case 'x':
                    $('#myDiv')[0].layout.xaxis.tickfont.color = $('#' + colorInput).val();
                    $('#myDiv')[0].layout.xaxis.title.font.color = $('#' + colorInput).val();
                    break;
                case 'y':
                    $('#myDiv')[0].layout.yaxis.tickfont.color = $('#' + colorInput).val();
                    $('#myDiv')[0].layout.yaxis.title.font.color = $('#' + colorInput).val();
                    break;
                case 'y2':
                    $('#myDiv')[0].layout.yaxis2.tickfont.color = $('#' + colorInput).val();
                    $('#myDiv')[0].layout.yaxis2.title.font.color = $('#' + colorInput).val();
                    break;
                case 'y3':
                    $('#myDiv')[0].layout.yaxis3.tickfont.color = $('#' + colorInput).val();
                    $('#myDiv')[0].layout.yaxis3.title.font.color = $('#' + colorInput).val();
                    break;

                default:
                    break;
            }
            Plotly.redraw('myDiv', {});

            // Plotly.redraw('myDiv', {});
        }

        function downloadToExcel() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g3/excel') }}" + "?" +
                parameters[1];
        }

        function callG1() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g6') }}" + "?" + parameters[1];
        }

        function callG7() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g7') }}" + "?" + parameters[1];
        }

        function callG8() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g8') }}" + "?" + parameters[1];
        }

        function callG9() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g9') }}" + "?" + parameters[1];
        }

        function callG10() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('9079/entry/pump_testing_rd/graphs/flow/g10') }}" + "?" + parameters[1];
        }

        $('#openGrid').change((e) => {
            var gridTrace = {
                x: [],
                y: [],
                xaxis: 'x4',
                yaxis: 'y4',
                type: 'scatter',
                name: 'grid',
                line: {
                    color: '#2CA02C'
                }
            }

            var graphDiv = document.getElementById('myDiv');

            if (e.target.checked) {
                Plotly.addTraces('myDiv', [gridTrace]);
            } else {
                for (let i = 0; i < graphDiv.data.length; i++) {
                    const g = graphDiv.data[i];
                    if (g.name == 'grid') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                }
            }
        });

        $('#showPoints').change((e) => {
            heatx = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
            heaty = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
            heatz = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
            var heatmapTrace = {
                x: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heatx)[0],
                y: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heaty)[1],
                z: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 20 }}, heatz)[2],
                type: 'heatmap',
                colorscale: [
                    ['0.0', 'rgb(255, 255, 255, 0.5)'],
                    ['1.0', 'rgb(255, 255, 255, 0.5)']
                ],
                name: 'I Heat',
                hoverinfo: 'none',
                xgap: 1,
                ygap: 1,
                showscale: false,
                yaxis: 'y3'
            }
            // End of Heatmap

            var graphDiv = document.getElementById('myDiv');

            var hoverInfo = document.getElementById('hoverinfo');

            if (e.target.checked) {
                Plotly.addTraces('myDiv', heatmapTrace);

                var myPlot = document.getElementById('myDiv');

                myPlot.on('plotly_hover', function(data) {
                        var infotext = data.points.map(function(d) {
                            // return (d.data.name + ': Q= ' + d.x + ', y= ' + d.y.toPrecision(3) + '<br>' + (d.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} / {{ $isiGraphScaleValues['yaxis3'] * 18 }})));
                            return ('Q : ' + d.x.toFixed(2) + ', TH : ' + (d.y * (
                                    {{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                                    {{ $isiGraphScaleValues['yaxis3'] * 18 }})).toFixed(2) +
                                ', OAE : ' + (d.y * ({{ $isiGraphScaleValues['yaxis2'] * 18 }} /
                                    {{ $isiGraphScaleValues['yaxis3'] * 18 }})).toFixed(2) +
                                ', I : ' + d.y.toPrecision(3)
                            );
                        });

                        hoverInfo.innerHTML = infotext.join('<br/>');
                    })
                    .on('plotly_unhover', function(data) {
                        hoverInfo.innerHTML = '<br>';
                    });
                hoverInfo.style.display = '';
            } else {
                for (let i = 0; i < graphDiv.data.length; i++) {
                    const g = graphDiv.data[i];
                    if (g.name == 'I Heat') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                }
                hoverInfo.style.display = 'none';
            }

        });

        function getRandomColor() {
            var letters = '012345'.split('');
            var color = '#';
            color += letters[Math.round(Math.random() * 5)];
            letters = '0123456789ABCDEF'.split('');
            for (var i = 0; i < 5; i++) {
                color += letters[Math.round(Math.random() * 15)];
            }
            return color;
        }
    </script>
@endsection
