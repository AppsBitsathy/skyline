@extends('includes.master')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/css/coloris/coloris.min.css') }}">
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
            <div id='myDiv'>
            </div>
        </div>
        <div class="col s12 m9 l9 mt-3 hide" id="chartDiv">
            <div id='dummyDiv'>
            </div>
        </div>
        <div class="col s12 m1 l1 mt-3">
            <a id="hide_show" class="btn waves-effect right"><i class="material-icons">swap_horiz</i></a>
        </div>
        <div class="col s12 m2 l2 card">
            <div class="row center">
                <h5 class="m-2">G7</h5>
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
                    <form method="post" action="{{ route('12225_entryPumpTestRDVolGraphReport') }}" target="blank">
                        @csrf
                        <input type="hidden" id="coPumpNo" name="coPumpNo" value="{{ $coPump['coPumpNo'] }}">
                        <input type="hidden" id="coPumpType" name="coPumpType" value="{{ $coPump['coPumpType'] }}">
                        <input type="hidden" id="reportH1" name="reportH1" value="{{ $pumpValues['fldheadr1'] }}">
                        <input type="hidden" id="reportH2" name="reportH2" value="{{ $pumpValues['fldheadr2'] }}">
                        <input type="hidden" id="reportDecDis" name="reportDecDis" value="{{ $pumpValues['flddis'] }}">
                        <input type="hidden" id="reportDecTH" name="reportDecTH" value="{{ $pumpValues['fldthead'] }}">
                        <input type="hidden" id="reportDecIP" name="reportDecIP" value="{{ $pumpValues['fldpi'] }}">
                        <input type="hidden" id="reportDecCurr" name="reportDecCurr"
                            value="{{ $pumpValues['fldmcurr'] }}">
                        <input type="hidden" id="reportDecDLWL" name="reportDecDLWL"
                            value="{{ $pumpValues['flddlwl'] }}">
                        <input type="hidden" id="reportObsDis" name="reportObsDis" value="">
                        <input type="hidden" id="reportObsTH" name="reportObsTH" value="">
                        <input type="hidden" id="reportObsIP" name="reportObsIP" value="">
                        <input type="hidden" id="reportObsCurr" name="reportObsCurr" value="">
                        <input type="hidden" id="reportObsDLWL" name="reportObsDLWL" value="">
                        <input class="btn btn-primary col m12" type="submit" value="Report" disabled id="btnReport">
                    </form>
                </div>
                <div class="col m12 pb-1"><a onclick="pickPoint()" class="btn waves-effect col m12">Pick
                        Point</a></div>
                <div class="col m12 pb-1"><a href="#colorPickModal"
                        class="btn waves-effect modal-trigger col m12">Color</a></div>
                <div class="col m12 pb-1"><a onclick="saveAsImage()" class="btn waves-effect col m12">Save</a></div>
                <div class="col m12 pb-1">
                    <form action="{{ route('12225_entryPumpTestRDVolGraphAddPrint') }}" method="post">
                        @csrf
                        <input type="hidden" name="coPumpNo" value="{{ $coPump['coPumpNo'] }}" required>
                        <input type="hidden" name="coPumpType" value="{{ $coPump['coPumpType'] }}" required>
                        <input type="hidden" id="addDis" name="addDis" value="" required>
                        <input type="hidden" id="addTH" name="addTH" value="" required>
                        <input type="hidden" id="addDLWL" name="addDLWL" value="" required>
                        <input type="hidden" id="addIP" name="addIP" value="" required>
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
            <a id="setUnitsForDischarge" href="#!" class="modal-close waves-effect waves-green btn-flat">OK</a>
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
                        <td id="declaredTHead">{{ $pumpValues['fldthead'] }}</td>
                        <td id="observedTH"></td>
                        <td id="thResult"></td>
                    </tr>
                    <tr>
                        <td>TH - Input Power (kW)</td>
                        <td id="declaredIP">{{ $pumpValues['fldpi'] }}</td>
                        <td id="observedIP"></td>
                        <td id="ipResult"></td>
                    </tr>
                    <tr>
                        <td>DLWL - Depth to Low Water Level (m)</td>
                        <td id="declaredDLWL">{{ $pumpValues['flddlwl'] }}</td>
                        <td id="observedDLWL"></td>
                        <td id="dlwlResult"></td>
                    </tr>
                    <tr>
                        <td>I - Current in Amps</td>
                        <td id="declaredCurr">{{ $pumpValues['fldmcurr'] }}</td>
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
            <a class="modal-close waves-effect waves-green btn-flat">OK</a>
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
                        <div id="dlwlBarChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="ipBarChart"></div>
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
                        <div id="dlwlPieChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="ipPieChart"></div>
                    </div>
                    <div class="col m6 l6">
                        <div id="currPieChart"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">CLOSE</a>
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
                        <input placeholder="Enter DLWL" id="dutyDLWL" type="text" class="validate">
                        <label for="dutyDLWL">DLWL</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter DLWL Range 1" id="dutyDLWLRange1" type="text" class="validate">
                        <label for="dutyDLWLRange1">DLWL Range 1</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter DLWL Range 2" id="dutyDLWLRange2" type="text" class="validate">
                        <label for="dutyDLWLRange2">DLWL Range 2</label>
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
                    <input class="with-gap" name="pickablePoint" value="DLWL" type="radio" />
                    <span>DLWL</span>
                </label>
            </p>
            <p>
                <label>
                    <input class="with-gap" name="pickablePoint" value="IP" type="radio" />
                    <span>Input Power</span>
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
                        <h6 class="ml-2">DLWL</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="dlwlLineColor" class="coloris" value="#2CA02C">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(2,'dlwlLineColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Input Power</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="ipLineColor" class="coloris" value="#FF7F0E">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(4,'ipLineColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Current</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="currLineColor" class="coloris" value="#D93536">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeLineColor(6,'currLineColor')" class="btn waves-effect"><i
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
                        <h6 class="ml-2">DLWL</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="dlwlTextColor" class="coloris" value="#1F77B4">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('y','dlwlTextColor')" class="btn waves-effect"><i
                                    class="material-icons">done</i></a>
                        </div>
                    </div>
                    <div class="col s12 m12 l12">
                        <h6 class="ml-2">Input Power</h6>
                        <div class="col s12 m6 l6">
                            <div class="full">
                                <input type="text" id="ipTextColor" class="coloris" value="#FF7F0E">
                            </div>
                        </div>
                        <div class="col s12 m6 l6">
                            <a onclick="changeTextColor('y2','ipTextColor')" class="btn waves-effect"><i
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
    <script src="{{ asset('assets/js/coloris/coloris.min.js') }}"></script>
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
                M.toast({html:'{{ session('status') }}', classes: 'rounded'});
                console.log('{{ session('status') }}');
            @endif
        });

        let globalDischarge = 0;
        let globalTotalHead = 0;
        let globalDLWL = 0;
        let globalDLWLRange1 = 0;
        let globalDLWLRange2 = 0;

        $('#dischargeUnitForTable').html($('#unitForDischarge').val());

        function pointAtX(a, b, x) {
            var slope = (b[1] - a[1]) / (b[0] - a[0]);
            var y = a[1] + (x - a[0]) * slope;
            return [x, y];
        }

        function pointAtY(a, b, y) {
            var slope = (b[1] - a[1]) / (b[0] - a[0]);
            var x = a[1] + (y - a[0]) * slope;
            return [x, y];
        }



        function heatmapCalc(v1, v2) {
            try {
                var x = [];
                var y = [];
                if (pointPicked) {
                    for (i = v1 - 20; i < v1 + 20; i = i + 0.01) {
                        x.push(i);
                    }
                } else {
                    for (i = 0; i < v1; i = i + 0.09) {
                        x.push(i);
                    }
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
            } catch (error) {
                console.log(error);
            }
        }


        var unitForDischarge = 1;

        var visibleX1;
        var visibleX2;
        var visibleX3;

        var selectedXAxis = '';

        var trace1;
        var trace2;
        var trace3;
        var trace4;
        var trace1sub;
        var trace2sub;
        var trace3sub;
        var trace4sub;
        var trace5;
        var data;
        var layout;
        var tracetest;

        var thLineColor = '#1F77B4';
        var dlwlLineColor = '#00FFFF';
        var ipLineColor = '#FF7F0E';
        var currLineColor = '#2CA02C';

        var thTextColor = '#1F77B4';
        var dlwlTextColor = '#00FFFF';
        var ipTextColor = '#FF7F0E';
        var currTextColor = '#2CA02C';
        var disTextColor = '#7F7F7F';


        $(document).ready(function() {
            setTimeout(() => {
                let parameters = window.location.href.split('?')[1].split('&');

                let ufd = parameters[8].split('=')[1];
                unitForDischarge = parameters[9].split('=')[1];

                if (ufd == 'lps') {
                    unitForDischarge = 1;
                    var visibleX1 = true;
                    var visibleX2 = false;
                    var visibleX3 = false;
                } else if (ufd == 'us/gpm') {
                    unitForDischarge = 15.850323141489;
                    var visibleX1 = false;
                    var visibleX2 = true;
                    var visibleX3 = false;
                    selectedXAxis = 'x2';
                } else if (ufd == 'm3/hr') {
                    unitForDischarge = 3.6;
                    var visibleX1 = false;
                    var visibleX2 = false;
                    var visibleX3 = true;
                    selectedXAxis = 'x3';
                }
                if (ufd != undefined) {
                    defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis);
                }
            }, 100);
            setTimeout(() => {
                $('#clr-picker').css('z-index', '1005');
            }, 1000);
        });

        var sample1x = [];
        var sample1y = [];
        var sample2x = [];
        var sample2y = [];
        var sample3x = [];
        var sample3y = [];
        var sample4x = [];
        var sample4y = [];

        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];
        let trace4x = [];
        let trace4y = [];

        @foreach ($volumetricsValues as $vol)
            // trace1x.push({{ $vol['fldrdis'] }});
            // trace1y.push({{ $vol['fldrthead'] }});
            // trace2x.push({{ $vol['fldrdis'] }});
            // trace2y.push({{ $vol['fldrdlwl'] }});
            // trace3x.push({{ $vol['fldrdis'] }});
            // trace3y.push({{ $vol['fldipow'] }});
            // trace4x.push({{ $vol['fldrdis'] }});
            // trace4y.push({{ $vol['fldcurr'] }});
        @endforeach

        tempj = 0;
        @php
        $tempj = 0;
        @endphp

        trace1x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace1y[tempj] = {{ $volumetricsValues[$tempj]['fldrthead'] }};
        trace2x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace2y[tempj] = {{ $volumetricsValues[$tempj]['fldrdlwl'] }};
        trace3x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace3y[tempj] = {{ $volumetricsValues[$tempj]['fldipow'] }};
        trace4x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace4y[tempj] = {{ $volumetricsValues[$tempj]['fldcurr'] }};

        tempj = tempj + 1;
        @php
        $tempj = $tempj + 2;
        @endphp

        trace1x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace1y[tempj] = {{ $volumetricsValues[$tempj]['fldrthead'] }};
        trace2x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace2y[tempj] = {{ $volumetricsValues[$tempj]['fldrdlwl'] }};
        trace3x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace3y[tempj] = {{ $volumetricsValues[$tempj]['fldipow'] }};
        trace4x[tempj] = {{ $volumetricsValues[$tempj]['fldrdis'] }};
        trace4y[tempj] = {{ $volumetricsValues[$tempj]['fldcurr'] }};

        tempj = tempj + 2;

        trace1x[tempj] = {{ $volumetricsValuesASC[0]['fldrdis'] }};
        trace1y[tempj] = {{ $volumetricsValuesASC[0]['fldrthead'] }};
        trace2x[tempj] = {{ $volumetricsValuesASC[0]['fldrdis'] }};
        trace2y[tempj] = {{ $volumetricsValuesASC[0]['fldrdlwl'] }};
        trace3x[tempj] = {{ $volumetricsValuesASC[0]['fldrdis'] }};
        trace3y[tempj] = {{ $volumetricsValuesASC[0]['fldipow'] }};
        trace4x[tempj] = {{ $volumetricsValuesASC[0]['fldrdis'] }};
        trace4y[tempj] = {{ $volumetricsValuesASC[0]['fldcurr'] }};

        tempj = tempj - 1;

        trace1x[tempj] = {{ $volumetricsValuesASC[2]['fldrdis'] }};
        trace1y[tempj] = {{ $volumetricsValuesASC[2]['fldrthead'] }};
        trace2x[tempj] = {{ $volumetricsValuesASC[2]['fldrdis'] }};
        trace2y[tempj] = {{ $volumetricsValuesASC[2]['fldrdlwl'] }};
        trace3x[tempj] = {{ $volumetricsValuesASC[2]['fldrdis'] }};
        trace3y[tempj] = {{ $volumetricsValuesASC[2]['fldipow'] }};
        trace4x[tempj] = {{ $volumetricsValuesASC[2]['fldrdis'] }};
        trace4y[tempj] = {{ $volumetricsValuesASC[2]['fldcurr'] }};

        function defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis) {

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

            xy[0] = [];
            xy[0][0] = trace1x[0];
            xy[0][1] = trace1y[0];
            rec = 4;

            console.log(rec);

            let sv = {{ $volumetricsValuesASC[0]['fldrdis'] / 15.5 }};

            k = 1;
            jj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                for (let j = jj; j <= trace1x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace1y[i] + (j - trace1x[i]) * (((trace1y[i + 1]) - trace1y[(i)]) / (trace1x[i + 1] -
                            trace1x[
                                i]));
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

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample1x.push(j);
                    sample1y.push(yp);
                }
            }

            // End of TotalHead Curve Formula

            // DLWL Formula
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

            xy[0] = [];
            xy[0][0] = trace2x[0];
            xy[0][1] = trace2y[0];
            rec = 4;

            // console.log(trace2x);
            // console.log(trace2y);

            sv = {{ $volumetricsValuesASC[0]['fldrdis'] / 15.5 }};

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


                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample2x.push(j);
                    sample2y.push(yp);
                }
            }

            // End of DLWL Formula

            // IP Formula
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

            xy[0] = [];
            xy[0][0] = trace3x[0];
            xy[0][1] = trace3y[0];
            rec = 4;

            // console.log(trace3x);
            // console.log(trace3y);

            sv = {{ $volumetricsValuesASC[0]['fldrdis'] / 15.5 }};

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

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample3x.push(j);
                    sample3y.push(yp);
                }
            }

            // End of IP Formula

            // Current Formula
            sample4x = [];
            sample4y = [];
            xy = [];
            k;
            jj;
            h = [];
            d = [];
            u = [];
            a = [];
            b = [];
            m = [];

            rec = trace4x.length;
            n = rec - 2;
            tempj = 0;

            xy[0] = [];
            xy[0][0] = trace4x[0];
            xy[0][1] = trace4y[0];
            rec = 4;

            // console.log(trace4x);
            // console.log(trace4y);

            sv = {{ $volumetricsValuesASC[0]['fldrdis'] / 15.5 }};

            k = 1;
            jj = 0;

            for (let i = 0; i <= rec - 1; i++) {
                for (let j = jj; j <= trace4x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace4y[i] + (j - trace4x[i]) * (((trace4y[i + 1]) - trace4y[(i)]) / (trace4x[i + 1] -
                            trace4x[i]));
                        xy[k] = [];
                        xy[k][0] = parseFloat(parseFloat(j).toFixed(2));
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }
            // debugger
            if (xy[k - 1][0] != trace4x[rec - 1]) {
                xy[k] = [];
                xy[k][0] = trace4x[rec - 1];
                xy[k][1] = trace4y[rec - 1];
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

                for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample4x.push(j);
                    sample4y.push(yp);
                }
            }

            // End of Current Formula

            if (!pointPicked) {
                @foreach ($volumetricsValues as $vol)
                    trace1x.push({{ $vol['fldrdis'] }});
                    trace1y.push({{ $vol['fldrthead'] }});
                    trace2x.push({{ $vol['fldrdis'] }});
                    trace2y.push({{ $vol['fldrdlwl'] }});
                    trace3x.push({{ $vol['fldrdis'] }});
                    trace3y.push({{ $vol['fldipow'] }});
                    trace4x.push({{ $vol['fldrdis'] }});
                    trace4y.push({{ $vol['fldcurr'] }});
                @endforeach
            }

            // for (let i = 1; i < trace1x.length; i++) {
            //     trace1x.splice(i, 1);
            //     trace1y.splice(i, 1);

            //     trace2x.splice(i, 1);
            //     trace2y.splice(i, 1);

            //     trace3x.splice(i, 1);
            //     trace3y.splice(i, 1);
            // }

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

            // DLWL

            trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'DLWL',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: '#2CA02C'
                }
            };

            trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'DLWL',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of DLWL

            // IP

            trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'IP',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
            };

            trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'IP',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
                showlegend: false
            };

            // End of IP

            // Current

            trace4 = {
                x: sample4x,
                y: sample4y,
                name: 'Current',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
                },
            };

            trace4sub = {
                x: trace4x,
                y: trace4y,
                name: 'Current',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
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

            // Duty Point
            trace5 = {
                x: [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,
                    {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }},
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}
                ],
                y: [0, {{ $pumpValues['fldthead'] }}, {{ $pumpValues['flddlwl'] }}, 0,
                    {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }},
                    {{ $pumpValues['flddlwl'] }}, 0, {{ $pumpValues['fldthead'] }},
                    {{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }},
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                ],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew",
                        "line-ew", "line-ew", "line-ew"
                    ]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " +
                    "{{ $pumpValues['flddlwl'] }}) Duty Point", '', '', '', "({{ $pumpValues['flddis'] }}" +
                    ", " + "{{ $pumpValues['fldthead'] }}) Duty Point", ''
                ]
            };
            // End of Duty Point

            trace6 = {
                x: [{{ $pumpValues['flddis'] }} * 0.92, {{ $pumpValues['flddis'] }} * 0.92],
                y: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                type: 'scatter',
                marker: {
                    symbol: ['line-ew', 'line-ew']
                },
                hoverinfo: 'none',
                showlegend: false
            }

            // data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4, trace4sub, trace5, trace6, tracetest];
            data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4, trace4sub, trace5, trace6, tracetest];

            layout = {
                title: {
                    text: 'G7',
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
                        text: 'TH & DLWL',
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
                        text: 'IP',
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

            Plotly.react('myDiv', data, layout, config);
        }





        // let trace1x = [];
        // let trace1y = [];
        // let trace2x = [];
        // let trace2y = [];
        // let trace3x = [];
        // let trace3y = [];
        // let trace4x = [];
        // let trace4y = [];

        @foreach ($volumetricsValues as $vol)
            // trace1x.push({{ $vol['fldrdis'] }});
            // trace1y.push({{ $vol['fldrthead'] }});
            // trace2x.push({{ $vol['fldrdis'] }});
            // trace2y.push({{ $vol['fldrdlwl'] }});
            // trace3x.push({{ $vol['fldrdis'] }});
            // trace3y.push({{ $vol['fldipow'] }});
            // trace4x.push({{ $vol['fldrdis'] }});
            // trace4y.push({{ $vol['fldcurr'] }});
            //
        @endforeach

        function obsValues(discharge = {{ $pumpValues['flddis'] }}, tHead = {{ $pumpValues['fldthead'] }}, dlwl1 =
            {{ $pumpValues['flddlwl1'] }}, dlwl2 = {{ $pumpValues['flddlwl2'] }}) {

            var graphDiv = document.getElementById('myDiv');

            for (let i = graphDiv.data.length; i > 0; i--) {
                try {
                    const g = graphDiv.data[i];
                    if (g.name == 'Q vs DLWL') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Q vs TH') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Q vs IP') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Duty Point vs IP') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Q vs I Connector') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Q vs I Connector 2') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                    if (g.name == 'Q vs I') {
                        Plotly.deleteTraces('myDiv', i);
                    }
                } catch (error) {

                }
            }

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

            // DLWL

            trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'DLWL',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: '#2CA02C'
                }
            };

            trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'DLWL',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of DLWL

            // IP

            trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'IP',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
            };

            trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'IP',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
                showlegend: false
            };

            // End of IP

            // Current

            trace4 = {
                x: sample4x,
                y: sample4y,
                name: 'Current',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
                },
            };

            trace4sub = {
                x: trace4x,
                y: trace4y,
                name: 'Current',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
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

            // Duty Point
            trace5 = {
                x: [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,
                    {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }},
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}
                ],
                y: [0, {{ $pumpValues['fldthead'] }}, {{ $pumpValues['flddlwl'] }}, 0,
                    {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }},
                    {{ $pumpValues['flddlwl'] }}, 0, {{ $pumpValues['fldthead'] }},
                    {{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }},
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                ],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew",
                        "line-ew", "line-ew", "line-ew"
                    ]
                },
                yaxis: 'y2',
                hoverinfo: 'text',
                text: ['', '', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " +
                    "{{ $pumpValues['flddlwl'] }}) Duty Point", '', '', '', "({{ $pumpValues['flddis'] }}" +
                    ", " + "{{ $pumpValues['fldthead'] }}) Duty Point", ''
                ]
            };
            // End of Duty Point

            dptoYTrace = {
                x: [{{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                type: 'scatter',
                yaxis: 'y2',
            }

            trace6 = {
                x: [{{ $pumpValues['flddis'] }} * 0.92, {{ $pumpValues['flddis'] }} * 0.92],
                y: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                type: 'scatter',
                marker: {
                    symbol: ['line-ew', 'line-ew']
                },
                hoverinfo: 'none',
            };

            // Q vs DLWL Points Intercept Calculation
            var qvsdlwlPoints = findLineIntercepts(trace2, trace6);
            // End Q vs DLWL Points Intercept Calculation

            // Q vs DLWL Line
            var qvsdlwlTrace = {
                x: [parseFloat(qvsdlwlPoints.x).toFixed(2), parseFloat(qvsdlwlPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsdlwlPoints.y).toFixed(2), parseFloat(qvsdlwlPoints.y).toFixed(2)],
                name: 'Q vs DLWL',
                type: 'scatter',
                // line: {
                //     color: '#8C564B'
                // }
            };

            // Q vs TH Points Intercept Calculation
            var qvsthPoints = findLineIntercepts(trace1, trace6);
            // End Q vs TH Points Intercept Calculation

            // Q vs TH Line
            var qvsthTrace = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsthPoints.y).toFixed(2), parseFloat(qvsthPoints.y).toFixed(2)],
                name: 'Q vs TH',
                type: 'scatter',
                // line: {
                //     color: '#8C564B'
                // }
            };

            // Q vs IP Points Intercept Calculation
            var qvsipPoints = findLineIntercepts(trace3, trace6);
            // End Q vs IP Points Intercept Calculation

            // Q vs IP Line
            var qvsipTrace = {
                x: [parseFloat(qvsipPoints.x).toFixed(2), parseFloat(qvsipPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsipPoints.y).toFixed(2), parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Q vs IP',
                type: 'scatter',
                yaxis: 'y2',
            };

            // Duty Point vs IP Points Intercept Calculation
            var dpvsipPoints = findLineIntercepts(trace3, dptoYTrace);
            // End Duty Point vs IP Points Intercept Calculation

            var dpvsipTrace = {
                x: [parseFloat(dpvsipPoints.x).toFixed(2), parseFloat(dpvsipPoints.x).toFixed(2), 0],
                y: [0, parseFloat(dpvsipPoints.y).toFixed(2), parseFloat(dpvsipPoints.y).toFixed(2)],
                name: 'Duty Point vs IP',
                type: 'scatter',
                yaxis: 'y2',
            }

            // End of Q vs TH Line

            // DLWL 1 (e.g: 10)
            var trace7 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [dlwl1, dlwl1],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#E377C2'
                }
            };
            // End of DLWL 1 (e.g: 10)

            // DLWL 2 (e.g: 20)
            var trace8 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [dlwl2, dlwl2],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#7F7F7F'
                }
            };
            // End of DLWL 2 (e.g: 20)

            var dlwlIntercept = findLineIntercepts(trace2, trace7);

            var traceReplaced7 = {
                x: [0, parseFloat(dlwlIntercept.x).toFixed(2), parseFloat(dlwlIntercept.x).toFixed(2),
                    parseFloat(dlwlIntercept.x).toFixed(2)
                ],
                y: [dlwl1, parseFloat(dlwlIntercept.y).toFixed(2),
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

            var dlwlIntercept2 = findLineIntercepts(trace2, trace8);

            var traceReplaced8 = {
                x: [0, parseFloat(dlwlIntercept2.x).toFixed(2), parseFloat(dlwlIntercept2.x).toFixed(2),
                    parseFloat(dlwlIntercept2.x).toFixed(2)
                ],
                y: [dlwl2, parseFloat(dlwlIntercept2.y).toFixed(2),
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

            var dlwlIIntercept = findLineIntercepts(trace4, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(dlwlIntercept.x).toFixed(2), parseFloat(dlwlIntercept.x).toFixed(2)],
                y: [dlwl1, parseFloat(dlwlIntercept.y).toFixed(2),
                    // {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                    dlwlIIntercept.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                },
            }

            var dlwlIIntercept2 = findLineIntercepts(trace4, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(dlwlIntercept2.x).toFixed(2), parseFloat(dlwlIntercept2.x).toFixed(2)],
                y: [dlwl2, parseFloat(dlwlIntercept2.y).toFixed(2),
                    // {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                    dlwlIIntercept2.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                        {{ $isiGraphScaleValues['yaxis3'] * 18 }})
                ],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                },
            }

            var trace3SubTrace = {
                // x: [dlwlIIntercept.x, dlwlIIntercept.x, 0],
                // y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, dlwlIIntercept.y, dlwlIIntercept.y],
                x: [dlwlIIntercept.x, 0],
                y: [dlwlIIntercept.y, dlwlIIntercept.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            };
            var trace3SubTrace2 = {
                // x: [dlwlIIntercept2.x, dlwlIIntercept2.x, 0],
                // y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, dlwlIIntercept2.y, dlwlIIntercept2.y],
                x: [dlwlIIntercept2.x, 0],
                y: [dlwlIIntercept2.y, dlwlIIntercept2.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#7F7F7F'
                }
            };

            var graph = document.getElementById('myDiv');

            graph.data.push(qvsdlwlTrace);
            graph.data.push(qvsthTrace);
            graph.data.push(qvsipTrace);
            graph.data.push(dpvsipTrace);
            graph.data.push(traceReplaced7);
            graph.data.push(traceReplaced8);
            graph.data.push(trace3SubTrace);
            graph.data.push(trace3SubTrace2);

            Plotly.redraw('myDiv', {});

            // config = {
            //     displaylogo: false
            // }

            // Plotly.newPlot('myDiv', data, layout, config);

            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#observedIP').html(parseFloat(qvsipPoints.y).toFixed(2));
            $('#observedDLWL').html(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#addDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#reportObsDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#reportObsTH').val(parseFloat(qvsthPoints.y).toFixed(2));
            $('#reportObsIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#reportObsDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#dischargeResult').html('Pass');

            // TotalHead Pass Fail

            if (parseFloat(qvsthPoints.y).toFixed(2) >= {{ $pumpValues['fldthead'] }}) {
                $('#thResult').html('Pass');
            } else {
                if (parseFloat(qvsthPoints.y).toFixed(2) >= ({{ $pumpValues['fldthead'] }} * 0.92)) {
                    $('#thResult').html('Pass');
                } else {
                    $('#thResult').html('Fail');
                }
            }

            // End of TotalHead Pass Fail

            // DLWL Pass Fail

            if (parseFloat(qvsdlwlPoints.y).toFixed(2) >= {{ $pumpValues['flddlwl'] }}) {
                $('#dlwlResult').html('Pass');
            } else {
                if (parseFloat(qvsdlwlPoints.y).toFixed(2) >= ({{ $pumpValues['flddlwl'] }} * 0.92)) {
                    $('#dlwlResult').html('Pass');
                } else {
                    $('#dlwlResult').html('Fail');
                }
            }

            // End of DLWL Pass Fail

            // IP Pass Fail

            if (parseFloat(qvsipPoints.y).toFixed(2) < ({{ $pumpValues['fldpi'] }} * 1.1)) {
                $('#ipResult').html('Pass');
            } else {
                $('#ipResult').html('Fail');
            }

            // End of IP Pass Fail

            // Current Pass Fail

            if (dlwlIIntercept.y > dlwlIIntercept2.y) {
                $('#observedI').html(parseFloat(dlwlIIntercept.y).toFixed(2));
                $('#addCurr').val(parseFloat(dlwlIIntercept.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(dlwlIIntercept.y).toFixed(2));

                if (parseFloat(dlwlIIntercept.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            } else {
                $('#observedI').html(parseFloat(dlwlIIntercept2.y).toFixed(2));
                $('#addCurr').val(parseFloat(dlwlIIntercept2.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(dlwlIIntercept2.y).toFixed(2));

                if (parseFloat(dlwlIIntercept2.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            }

            // End of Current Pass Fail

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#dlwlResult').html() ==
                'Pass' && $('#ipResult').html() == 'Pass' && $('#iResult').html() == 'Pass') {
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

            var datas = [trace1, trace2];

            var layout = {
                autosize: false,
                width: 400,
                height: 300,
                barmode: 'group',
            };

            config = {
                displaylogo: false
            }

            Plotly.newPlot('dischargeBarChart', datas, layout, config);
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

            var datas = [trace1, trace2];

            Plotly.newPlot('thBarChart', datas, layout, config);
            // End Total Head BarChart

            // DLWL BarChart
            var trace1 = {
                x: ['DLWL'],
                y: [{{ $pumpValues['flddlwl'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['DLWL'],
                y: [parseFloat(qvsdlwlPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var datas = [trace1, trace2];

            Plotly.newPlot('dlwlBarChart', datas, layout, config);
            // End DLWL BarChart

            // IP BarChart
            var trace1 = {
                x: ['IP'],
                y: [{{ $pumpValues['fldpi'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['IP'],
                y: [parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var datas = [trace1, trace2];

            Plotly.newPlot('ipBarChart', datas, layout, config);
            // End IP BarChart

            // Current BarChart
            var trace1 = {
                x: ['Current'],
                y: [{{ $pumpValues['fldmcurr'] }}],
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

            var datas = [trace1, trace2];

            Plotly.newPlot('currBarChart', datas, layout, config);
            // End Current BarChart

            // Discharge PieChart
            var datas = [{
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

            Plotly.newPlot('dischargePieChart', datas, layout, config);
            // End of Discharge PieChart

            // Total Head PieChart
            var datas = [{
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

            Plotly.newPlot('thPieChart', datas, layout, config);
            // End of Total Head PieChart

            // DLWL PieChart
            var datas = [{
                values: [{{ $pumpValues['flddlwl'] }}, parseFloat(qvsdlwlPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['flddlwl'] }}, parseFloat(qvsdlwlPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('dlwlPieChart', datas, layout, config);
            // End of DLWL PieChart

            // IP PieChart
            var datas = [{
                values: [{{ $pumpValues['fldpi'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldpi'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('ipPieChart', datas, layout, config);
            // End of IP PieChart

            // Current PieChart
            var datas = [{
                values: [{{ $pumpValues['fldmcurr'] }}, $('#observedI').html()],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldmcurr'] }}, $('#observedI').html()],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('currPieChart', datas, layout, config);
            // End of Current PieChart

            $('#obsValuesModal').modal('open');
            $('#btnReport').attr('disabled', false);
            $('#btnAddPrint').attr('disabled', false);

            $('#openGrid').removeAttr('checked');
            $('#showPoints').removeAttr('checked');

            if ($('#observedQ').html() == 'NaN') {
                $('#observedQ').html('');
            }
            if ($('#observedTH').html() == 'NaN') {
                $('#observedTH').html('');
            }
            if ($('#observedDLWL').html() == 'NaN') {
                $('#observedDLWL').html('');
            }
            if ($('#observedIP').html() == 'NaN') {
                $('#observedIP').html('');
            }
            if ($('#observedI').html() == 'NaN') {
                $('#observedI').html('');
            }
        }

        function dutyPointModalOpen() {
            console.log(globalDischarge);
            console.log(globalTotalHead);
            console.log(globalDLWL);
            console.log(globalDLWLRange1);
            console.log(globalDLWLRange2);
            if (globalDischarge == 0 && globalTotalHead == 0 && globalDLWL == 0 && globalDLWLRange1 == 0 &&
                globalDLWLRange2 == 0) {
                $('#dutyDischarge').val('{{ $pumpValues['flddis'] }}');
                $('#dutyTHead').val('{{ $pumpValues['fldthead'] }}');
                $('#dutyDLWL').val('{{ $pumpValues['flddlwl'] }}');
                $('#dutyDLWLRange1').val('{{ $pumpValues['flddlwl1'] }}');
                $('#dutyDLWLRange2').val('{{ $pumpValues['flddlwl2'] }}');
            } else {
                $('#dutyDischarge').val(globalDischarge);
                $('#dutyTHead').val(globalTotalHead);
                $('#dutyDLWL').val(globalDLWL);
                $('#dutyDLWLRange1').val(globalDLWLRange1);
                $('#dutyDLWLRange2').val(globalDLWLRange2);
            }
            $('#dutyPointChangeModal').modal('open');
        }

        $('#changeDutyPointBtn').click(function(e) {
            globalDischarge = $('#dutyDischarge').val();
            globalTotalHead = $('#dutyTHead').val();
            globalDLWL = $('#dutyDLWL').val();
            globalDLWLRange1 = $('#dutyDLWLRange1').val();
            globalDLWLRange2 = $('#dutyDLWLRange2').val();
            $('#reportH1').val(globalDLWLRange1);
            $('#reportH2').val(globalDLWLRange2);
            $('#btnReport').attr('disabled', false);
            $('#btnAddPrint').attr('disabled', false);
            // obsValues(globalDischarge, globalTotalHead, globalHeadRange1, globalHeadRange2);
            $('#declaredDis').html(globalDischarge);
            $('#declaredTHead').html(globalTotalHead);
            newDutyPoint(globalDischarge, globalTotalHead, globalDLWL, globalDLWLRange1, globalDLWLRange2);
        });

        function newDutyPoint(globalDischarge, globalTotalHead, globalDLWL, globalDLWLRange1, globalDLWLRange2) {

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

            // DLWL

            trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'DLWL',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                    color: '#2CA02C'
                }
            };

            trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'DLWL',
                type: 'scatter',
                mode: 'markers',
                line: {
                    color: '#2CA02C'
                },
                showlegend: false
            };

            // End of DLWL

            // IP

            trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'IP',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
            };

            trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'IP',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                    color: '#FF7F0E'
                },
                showlegend: false
            };

            // End of IP

            // Current

            trace4 = {
                x: sample4x,
                y: sample4y,
                name: 'Current',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
                },
            };

            trace4sub = {
                x: trace4x,
                y: trace4y,
                name: 'Current',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                    color: '#FD0000'
                },
                showlegend: false
            };
            // End of Current

            // Duty Point
            trace5 = {
                x: [0, globalDischarge, globalDischarge, 0, globalDischarge, 0, globalDischarge, globalDischarge,
                    globalDischarge, 0, globalDischarge, globalDischarge
                ],
                y: [0, globalTotalHead, globalDLWL, 0, globalDLWL, globalDLWL, globalDLWL, 0, globalTotalHead,
                    globalTotalHead, globalTotalHead, {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                ],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew",
                        "line-ew", "line-ew", "line-ew"
                    ]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', '', "(" + globalDischarge + ", " + globalDLWL + ") Duty Point", '', '', '',
                    "(" + globalDischarge + ", " + globalTotalHead + ") Duty Point", ''
                ]
            };
            // End of Duty Point

            console.log(globalDischarge);

            dptoYTrace = {
                x: [globalDischarge, globalDischarge],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                type: 'scatter',
                yaxis: 'y2',
                showlegend: false
            }

            trace6 = {
                x: [globalDischarge * 0.92, globalDischarge * 0.92],
                y: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                type: 'scatter',
                marker: {
                    symbol: ['line-ew', 'line-ew']
                },
                hoverinfo: 'none',
                showlegend: false
            };

            var data = [trace1, trace2, trace3, trace4, trace5, dptoYTrace, trace6];

            var layout = {
                title: {
                    text: 'G7',
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
                        text: 'TH & DLWL',
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
                        text: 'IP',
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
            var qvsthPoints = findLineIntercepts(trace1, trace6);
            // End Q vs TH Points Intercept Calculation

            // Q vs TH Line
            var qvsthTrace = {
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
                // Duty Point
                trace5 = {
                    x: [0, globalDischarge, globalDischarge, 0, globalDischarge, 0, globalDischarge, globalDischarge,
                        globalDischarge, 0, globalDischarge, globalDischarge
                    ],
                    y: [0, globalTotalHead, globalDLWL, 0, globalDLWL, globalDLWL, globalDLWL, 0, globalTotalHead,
                        globalTotalHead, globalTotalHead, {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                    ],
                    name: 'Duty Point',
                    type: 'scatter',
                    marker: {
                        size: 15,
                        symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew",
                            "line-ew", "line-ew", "line-ew"
                        ]
                    },
                    hoverinfo: 'text',
                    line: {
                        color: randomColor
                    },
                    text: ['', '', '', '', '', '', "(" + globalDischarge + ", " + globalDLWL + ") Duty Point", '', '',
                        '', "(" + globalDischarge + ", " + globalTotalHead + ") Duty Point", ''
                    ]
                };
                // End of Duty Point

                dptoYTrace = {
                    x: [globalDischarge, globalDischarge],
                    y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                    type: 'scatter',
                    line: {
                        color: randomColor
                    },
                    yaxis: 'y2',
                    showlegend: false
                }

                trace6 = {
                    x: [globalDischarge * 0.92, globalDischarge * 0.92],
                    y: [0, {{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                    type: 'scatter',
                    marker: {
                        symbol: ['line-ew', 'line-ew']
                    },
                    line: {
                        color: randomColor
                    },
                    hoverinfo: 'none',
                    showlegend: false
                };
                data[4] = trace5;
                data[5] = dptoYTrace;
                data[6] = trace6;

                // End of Duty Point Replace
            }

            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            $('#reportObsDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#reportObsTH').val(parseFloat(qvsthPoints.y).toFixed(2));
            // End of Q vs TH Line

            // Q vs DLWL Points Intercept Calculation
            var qvsdlwlPoints = findLineIntercepts(trace2, trace6);
            // End Q vs DLWL Points Intercept Calculation

            // Q vs DLWL Line
            var qvsdlwlTrace = {
                x: [parseFloat(qvsdlwlPoints.x).toFixed(2), parseFloat(qvsdlwlPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsdlwlPoints.y).toFixed(2), parseFloat(qvsdlwlPoints.y).toFixed(2)],
                name: 'Q vs DLWL',
                type: 'scatter',
                // line: {
                //     color: '#8C564B'
                // }
            };
            // End of Q vs DLWL Line

            $('#observedDLWL').html(parseFloat(qvsdlwlPoints.y).toFixed(2));
            $('#addDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));
            $('#reportObsDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));

            // Q vs IP Points Intercept Calculation
            var qvsipPoints = findLineIntercepts(trace3, trace6);
            // End Q vs IP Points Intercept Calculation

            // Q vs IP Line
            var qvsipTrace = {
                x: [parseFloat(qvsipPoints.x).toFixed(2), parseFloat(qvsipPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsipPoints.y).toFixed(2), parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Q vs IP',
                type: 'scatter',
                yaxis: 'y2',
            };

            $('#observedIP').html(parseFloat(qvsipPoints.y).toFixed(2));
            $('#addIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#reportObsIP').val(parseFloat(qvsipPoints.y).toFixed(2));

            // Duty Point vs IP Points Intercept Calculation
            var dpvsipPoints = findLineIntercepts(trace3, dptoYTrace);
            // End Duty Point vs IP Points Intercept Calculation

            var dpvsipTrace = {
                x: [parseFloat(dpvsipPoints.x).toFixed(2), parseFloat(dpvsipPoints.x).toFixed(2), 0],
                y: [0, parseFloat(dpvsipPoints.y).toFixed(2), parseFloat(dpvsipPoints.y).toFixed(2)],
                name: 'Duty Point vs IP',
                type: 'scatter',
                yaxis: 'y2',
                line: {
                    color: randomColor
                }
            }

            // End of Q vs TH Line

            // DLWL 1 (e.g: 10)
            var trace7 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [globalDLWLRange1, globalDLWLRange1],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#E377C2'
                }
            };
            // End of DLWL 1 (e.g: 10)

            // DLWL 2 (e.g: 20)
            var trace8 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [globalDLWLRange2, globalDLWLRange2],
                name: 'Q vs I Connector 2',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 4,
                    color: '#7F7F7F'
                }
            };
            // End of DLWL 2 (e.g: 20)

            // Trace 7 Points Intercept Calculation
            var dlwlTHIntercept = findLineIntercepts(trace2, trace7);

            console.log(dlwlTHIntercept);

            var traceReplaced7 = {
                x: [0, parseFloat(dlwlTHIntercept.x).toFixed(2), parseFloat(dlwlTHIntercept.x).toFixed(2),
                    parseFloat(dlwlTHIntercept.x).toFixed(2)
                ],
                y: [globalDLWLRange1, parseFloat(dlwlTHIntercept.y).toFixed(2),
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

            // End Trace 7 Points Intercept Calculation

            // Trace 8 Points Intercept Calculation
            var dlwlTHIntercept2 = findLineIntercepts(trace2, trace8);

            var traceReplaced8 = {
                x: [0, parseFloat(dlwlTHIntercept2.x).toFixed(2), parseFloat(dlwlTHIntercept2.x).toFixed(2),
                    parseFloat(dlwlTHIntercept2.x).toFixed(2)
                ],
                y: [globalDLWLRange2, parseFloat(dlwlTHIntercept2.y).toFixed(2),
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

            // End Trace 8 Points Intercept Calculation

            console.log(traceReplaced7);
            console.log(traceReplaced8);

            var dlwlIIntercept = findLineIntercepts(trace4, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(dlwlTHIntercept.x).toFixed(2), parseFloat(dlwlTHIntercept.x).toFixed(2)],
                y: [globalDLWLRange1, parseFloat(dlwlTHIntercept.y).toFixed(2),
                    dlwlIIntercept.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
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

            // data[6] = traceReplaced7;
            // End of Trace 7 Reassign

            var dlwlIIntercept2 = findLineIntercepts(trace4, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(dlwlTHIntercept2.x).toFixed(2), parseFloat(dlwlTHIntercept2.x).toFixed(2)],
                y: [globalDLWLRange2, parseFloat(dlwlTHIntercept2.y).toFixed(2),
                    dlwlIIntercept2.y * ({{ $isiGraphScaleValues['yaxis1'] * 18 }} /
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

            // data[7] = traceReplaced8;
            // End of Trace 7 Reassign

            var trace3SubTrace = {
                x: [dlwlIIntercept.x, 0],
                y: [dlwlIIntercept.y, dlwlIIntercept.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            };

            // data.push(trace3SubTrace);

            var trace3SubTrace2 = {
                x: [dlwlIIntercept2.x, 0],
                y: [dlwlIIntercept2.y, dlwlIIntercept2.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: randomColor
                }
            };

            // data.push(trace3SubTrace2);

            var graph = document.getElementById('myDiv');

            graph.data.push(trace5);
            graph.data.push(dptoYTrace);
            graph.data.push(trace6);
            graph.data.push(qvsdlwlTrace);
            graph.data.push(qvsthTrace);
            graph.data.push(qvsipTrace);
            graph.data.push(dpvsipTrace);
            graph.data.push(traceReplaced7);
            graph.data.push(traceReplaced8);
            graph.data.push(trace3SubTrace);
            graph.data.push(trace3SubTrace2);

            Plotly.redraw('myDiv', {});

            // TotalHead Pass Fail

            if (parseFloat(qvsthPoints.y).toFixed(2) >= {{ $pumpValues['fldthead'] }}) {
                $('#thResult').html('Pass');
            } else {
                if (parseFloat(qvsthPoints.y).toFixed(2) >= ({{ $pumpValues['fldthead'] }} * 0.92)) {
                    $('#thResult').html('Pass');
                } else {
                    $('#thResult').html('Fail');
                }
            }

            // End of TotalHead Pass Fail

            // DLWL Pass Fail

            if (parseFloat(qvsdlwlPoints.y).toFixed(2) >= {{ $pumpValues['flddlwl'] }}) {
                $('#dlwlResult').html('Pass');
            } else {
                if (parseFloat(qvsdlwlPoints.y).toFixed(2) >= ({{ $pumpValues['flddlwl'] }} * 0.92)) {
                    $('#dlwlResult').html('Pass');
                } else {
                    $('#dlwlResult').html('Fail');
                }
            }

            // End of DLWL Pass Fail

            // IP Pass Fail

            if (parseFloat(qvsipPoints.y).toFixed(2) < ({{ $pumpValues['fldpi'] }} * 1.1)) {
                $('#ipResult').html('Pass');
            } else {
                $('#ipResult').html('Fail');
            }

            // End of IP Pass Fail

            // Current Pass Fail

            if (dlwlIIntercept.y > dlwlIIntercept2.y) {
                $('#observedI').html(parseFloat(dlwlIIntercept.y).toFixed(2));
                $('#addCurr').val(parseFloat(dlwlIIntercept.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(dlwlIIntercept.y).toFixed(2));

                if (parseFloat(dlwlIIntercept.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            } else {
                $('#observedI').html(parseFloat(dlwlIIntercept2.y).toFixed(2));
                $('#addCurr').val(parseFloat(dlwlIIntercept2.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(dlwlIIntercept2.y).toFixed(2));

                if (parseFloat(dlwlIIntercept2.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            }

            // End of Current Pass Fail

            Plotly.newPlot('dummyDiv', data, layout, config);

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#dlwlResult').html() ==
                'Pass' && $('#ipResult').html() == 'Pass' && $('#iResult').html() == 'Pass') {
                $('#overallResult').html('<i class="material-icons left pt-1 green-text">circle</i>Pump Pass');
            } else {
                $('#overallResult').html('<i class="material-icons left pt-1 red-text">circle</i>Pump Fail');
            }

            // Discharge Chart
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

            var datas = [trace1, trace2];

            var layout = {
                autosize: false,
                width: 400,
                height: 300,
                barmode: 'group',
            };

            config = {
                displaylogo: false
            }

            Plotly.newPlot('dischargeBarChart', datas, layout, config);
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

            var datas = [trace1, trace2];

            Plotly.newPlot('thBarChart', datas, layout, config);
            // End Total Head BarChart

            // DLWL BarChart
            var trace1 = {
                x: ['DLWL'],
                y: [globalDLWL],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['DLWL'],
                y: [parseFloat(qvsdlwlPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var datas = [trace1, trace2];

            Plotly.newPlot('dlwlBarChart', datas, layout, config);
            // End DLWL BarChart

            // IP BarChart
            var trace1 = {
                x: ['IP'],
                y: [{{ $pumpValues['fldpi'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['IP'],
                y: [parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var datas = [trace1, trace2];

            Plotly.newPlot('ipBarChart', datas, layout, config);
            // End IP BarChart

            // Current BarChart
            var trace1 = {
                x: ['Current'],
                y: [{{ $pumpValues['fldmcurr'] }}],
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

            var datas = [trace1, trace2];

            Plotly.newPlot('currBarChart', datas, layout, config);
            // End Current BarChart

            // Discharge PieChart
            var datas = [{
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

            Plotly.newPlot('dischargePieChart', datas, layout, config);
            // End of Discharge PieChart

            // Total Head PieChart
            var datas = [{
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

            Plotly.newPlot('thPieChart', datas, layout, config);
            // End of Total Head PieChart

            // DLWL PieChart
            var datas = [{
                values: [{{ $pumpValues['flddlwl'] }}, parseFloat(qvsdlwlPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['flddlwl'] }}, parseFloat(qvsdlwlPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('dlwlPieChart', datas, layout, config);
            // End of DLWL PieChart

            // IP PieChart
            var datas = [{
                values: [{{ $pumpValues['fldpi'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldpi'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('ipPieChart', datas, layout, config);
            // End of IP PieChart

            // Current PieChart
            var datas = [{
                values: [{{ $pumpValues['fldmcurr'] }}, $('#observedI').html()],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldmcurr'] }}, $('#observedI').html()],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('currPieChart', datas, layout, config);
            // End of Current PieChart

            // Plotly.addTraces('myDiv', [trace4Replaced, trace5, traceReplaced6, traceReplaced7, traceReplaced8,
            //     trace3SubTrace,
            //     trace3SubTrace2
            // ]);

            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#observedIP').html(parseFloat(qvsipPoints.y).toFixed(2));
            $('#observedDLWL').html(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#addDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#reportObsDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#reportObsTH').val(parseFloat(qvsthPoints.y).toFixed(2));
            $('#reportObsIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#reportObsDLWL').val(parseFloat(qvsdlwlPoints.y).toFixed(2));

            $('#dischargeResult').html('Pass');

            $('#obsValuesModal').modal('open');
            $('#btnReport').attr('disabled', false);
            $('#btnAddPrint').attr('disabled', false);

            $('#openGrid').removeAttr('checked');
            $('#showPoints').removeAttr('checked');

            if ($('#observedQ').html() == 'NaN') {
                $('#observedQ').html('');
            }
            if ($('#observedTH').html() == 'NaN') {
                $('#observedTH').html('');
            }
            if ($('#observedDLWL').html() == 'NaN') {
                $('#observedDLWL').html('');
            }
            if ($('#observedIP').html() == 'NaN') {
                $('#observedIP').html('');
            }
            if ($('#observedI').html() == 'NaN') {
                $('#observedI').html('');
            }
        }

        function thvsq() {
            let totalHead;
            if (totalHead = prompt('Enter Total Head')) {

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

                @foreach ($volumetricsValues as $vol)
                    // trace1x.push({{ $vol['fldRDis'] }});
                    // trace1y.push({{ $vol['fldRTHead'] }});
                    //
                @endforeach

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
                    } else if (selectedPick == 'DLWL') {
                        clickPoint(trace2sub);
                        pickedPointType = 'DLWL';
                    } else if (selectedPick == 'IP') {
                        clickPoint(trace3sub);
                        pickedPointType = 'IP';
                    } else {
                        clickPoint(trace4sub);
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
            myPlot.removeAllListeners("plotly_click");
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
                        } else if (pickedPointType == 'DLWL') {
                            tracePosition = 3;
                            heatx = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis1'] * 18 }};
                            yAxis = 'y1';
                        } else if (pickedPointType == 'IP') {
                            tracePosition = 5;
                            heatx = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis2'] * 18 }};
                            yAxis = 'y2';
                        } else {
                            tracePosition = 7;
                            heatx = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            heaty = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            heatz = {{ $isiGraphScaleValues['yaxis3'] * 18 }};
                            yAxis = 'y3';
                        }
                        // defaultGraph();
                        // Heatmap
                        var heatmapTrace = {
                            x: heatmapCalc(x, heatx)[0],
                            y: heatmapCalc(x, heaty)[1],
                            z: heatmapCalc(x, heatz)[2],
                            type: 'heatmap',
                            name: 'Heatmaps',
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
                                console.log(obj.curveNumber);
                                return obj.curveNumber >= 5
                            });
                            if (dataTrace.length == 0) {
                                return;
                            }
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
                                yaxis: yAxis,
                                line: {
                                    color: data[tracePosition].hasOwnProperty('line') ? data[
                                        tracePosition].line.color : ''
                                }
                            }

                            console.log(changedTrace);

                            console.log(data);

                            data[tracePosition] = changedTrace;

                            if (pickedPointType == 'TH') {
                                trace1sub = changedTrace;
                                trace1y = changedTrace.y;
                            } else if (pickedPointType == 'DLWL') {
                                trace2sub = changedTrace;
                                trace2y = changedTrace.y;
                            } else if (pickedPointType == 'IP') {
                                trace3sub = changedTrace;
                                trace3y = changedTrace.y;
                            } else {
                                trace4sub = changedTrace;
                                trace4y = changedTrace.y;
                            }

                            for (let i = 0; i < data.length; i++) {
                                const g = data[i];
                                if (g.name == 'Heatmaps') {
                                    Plotly.deleteTraces('myDiv', i);
                                }
                            }

                            console.log(data);

                            defaultGraph();

                            // Plotly.newPlot('myDiv', data, layout, {
                            //     displaylogo: false
                            // });
                            myPlot.removeAllListeners("plotly_click");
                            if (pointPicked) {
                                clickPoint(changedTrace);
                            }
                            // }
                        });
                    }
                }
            });
        }

        // var myPlot = document.getElementById('myDiv');

        // myPlot.on('plotly_hover', function(eventdata) {
        //     var points = eventdata.points[0],
        //         pointNum = points.pointNumber;
        //     console.log(points);

        //     Plotly.Fx.hover('myDiv', [{
        //             curveNumber: 0,
        //             pointNumber: pointNum
        //         },
        //         {
        //             curveNumber: 1,
        //             pointNumber: pointNum
        //         },
        //         {
        //             curveNumber: 2,
        //             pointNumber: pointNum
        //         },
        //     ]);
        // });

        function changeLineColor(trace, colorInput) {
            $('#myDiv')[0].data[trace].line.color = $('#' + colorInput).val();
            $('#myDiv')[0].data[trace + 1].line.color = $('#' + colorInput).val();

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
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g7/excel') }}" + "?" +
                parameters[1];
        }

        function callG1() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g6') }}" + "?" + parameters[1];
        }

        function callG7() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g7') }}" + "?" + parameters[1];
        }

        function callG8() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g8') }}" + "?" + parameters[1];
        }

        function callG9() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g9') }}" + "?" + parameters[1];
        }

        function callG10() {
            let ufd = $('input[name="unitsForDischarge"]:checked').val();
            let unit = 'unitFormat=' + ufd;
            let unitFD = 'unitForDischarge=' + unitForDischarge;

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_rd/graphs/vol/g10') }}" + "?" + parameters[1];
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
                x: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 18 }}, heatx)[0],
                y: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 18 }}, heaty)[1],
                z: heatmapCalc({{ $isiGraphScaleValues['xaxis'] * 18 }}, heatz)[2],
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
                            return ('Q : ' + d.x.toFixed(2) + ', TH / DLWL : ' + (d.y * (
                                    {{ $isiGraphScaleValues['yaxis1'] * 18 }} /
                                    {{ $isiGraphScaleValues['yaxis3'] * 18 }})).toFixed(2) +
                                ', IP : ' + (d.y * ({{ $isiGraphScaleValues['yaxis2'] * 18 }} /
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
