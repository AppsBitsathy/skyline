@extends('includes.master')
@section('content')
    <div class="row">
        <div class="col s12 m9 l9 mt-3" id="chartDiv">
            <h4 id="hoverinfo" class="white mb-0 center" style="display: none">
                <br>
            </h4>
            <div id='myDiv'></div>
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
                <h5 class="m-2">G1</h5>
                <div class="col m6 pb-1"><a onclick="callG1()" class="btn waves-effect col m12">G1</a>
                </div>
                <div class="col m6 pb-1"><a onclick="callG2()" class="btn waves-effect col m12">G2</a></div>
                <div class="col m6 pb-1"><a onclick="callG3()" class="btn waves-effect col m12">G3</a></div>
                <div class="col m6 pb-1"><a onclick="callG4()" class="btn waves-effect col m12">G4</a></div>
                <div class="col m6 pb-1"><a onclick="callG5()" class="btn waves-effect col m12">G5</a></div>
                <div class="col m6 pb-1"><a onclick="callG6()" class="btn waves-effect col m12">G6</a></div>
                <div class="col m12 pb-1"><a onclick="obsValues()" class="btn waves-effect col m12">Obs.
                        Values</a>
                </div>
                <div class="col m12 pb-1"><a href="#perChartModal" class="btn waves-effect modal-trigger col m12">Per.
                        Chart</a>
                </div>
                <div class="col m12 pb-1">
                    <form action="{{ route('8472_entryPumpTestISIVolGraphAddPrint') }}" method="post">
                        @csrf
                        <input type="hidden" name="coPumpNo" value="{{ $coPump['coPumpNo'] }}" required>
                        <input type="hidden" name="coPumpType" value="{{ $coPump['coPumpType'] }}" required>
                        <input type="hidden" id="addDis" name="addDis" value="" required>
                        <input type="hidden" id="addTH" name="addTH" value="" required>
                        <input type="hidden" id="addIP" name="addIP" value="" required>
                        <input type="hidden" id="addCurr" name="addCurr" value="" required>
                        <input class="btn btn-primary col m12" type="submit" disabled id="btnAddPrint" value="Add / Print">
                    </form>
                </div>
                <div class="col m12 pb-1">
                    <p class="m-0">
                        <label>
                            <input type="checkbox" id="openGrid" />
                            <span>Grid</span>
                        </label>
                    </p>
                </div>
                <br>
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
                        <td>IP - Input Power in (kW)</td>
                        <td id="declaredIP">{{ $pumpValues['fldip'] }}</td>
                        <td id="observedIP"></td>
                        <td id="ipResult"></td>
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
                    <h5 id="chkval" class="hide"></h5>
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
                        <div id="ipPieChart"></div>
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
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'});
                console.log('{{ session('status') }}');
            @endif
        });

        let globalDischarge = 0;
        let globalTotalHead = 0;
        let globalHeadRange1 = 0;
        let globalHeadRange2 = 0;

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

        function findLineIntercepts(t1, t2) {
            const lineIntercepts = (() => {
                const Point = (x, y) => ({
                    x,
                    y
                });
                const Line = (p1, p2) => ({
                    p1,
                    p2
                });
                const Vector = line => Point(line.p2.x - line.p1.x, line.p2.y - line.p1.y);

                function interceptSegs(line1, line2) {
                    const a = Vector(line1),
                        b = Vector(line2);
                    const c = a.x * b.y - a.y * b.x;
                    if (c) {
                        const e = Point(line1.p1.x - line2.p1.x, line1.p1.y - line2.p1.y);
                        const u = (a.x * e.y - a.y * e.x) / c;
                        if (u >= 0 && u <= 1) {
                            const u = (b.x * e.y - b.y * e.x) / c;
                            if (u >= 0 && u <= 1) {
                                return Point(line1.p1.x + a.x * u, line1.p1.y + a.y * u);
                            }
                        }
                    }
                }
                const PointFromTable = (t, idx) => Point(t.x[idx], t.y[idx]);
                const LineFromTable = (t, idx) => Line(PointFromTable(t, idx++), PointFromTable(t, idx));
                return function(table1, table2) {
                    const results = [];
                    var i = 0,
                        j;
                    while (i < table1.x.length - 1) {

                        const line1 = LineFromTable(table1, i);
                        j = 0;
                        while (j < table2.x.length - 1) {
                            const line2 = LineFromTable(table2, j);
                            const point = interceptSegs(line1, line2);
                            if (point) {
                                results.push({
                                    description: `'${table1.name}' line seg index ${i}-${i+1} intercepts '${table2.name}' line seg index ${j} - ${j+1}`,

                                    // The description (line above) can be replaced 
                                    // with relevant data as follows
                                    /*  remove this line to include additional info per intercept
                                                            tableName1: table1.name,
                                                            tableName2: table2.name,
                                                            table_1_PointStartIdx: i,
                                                            table_1_PointEndIdx: i + 1,   
                                                            table_2_PointStartIdx: j,
                                                            table_2_PointEndIdx: j + 1,   
                                    and remove this line */

                                    x: point.x,
                                    y: point.y,
                                });
                            }
                            j++;
                        }
                        i++;
                    }
                    if (results.length) {
                        // console.log("Found " + results.length + " intercepts for '" + table1.name + "' and '" + table2.name + "'");
                        // console.log(results);
                        return results;
                    }
                    // console.log("No intercept found for  '" + table1.name + "' and '" + table2.name + "'");
                }
            })();

            const results = lineIntercepts(t1, t2);

            if (results) {

                for (const intercept of results) {
                    const x = intercept.x; // get x
                    const y = intercept.y; // get y
                }

            }

            return results[0];

        }

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
        var trace4;
        var data;
        var layout;
        var tracetest;

        var thLineColor = '#1F77B4';
        var ipLineColor = '#FF7F0E';
        var currLineColor = '#2CA02C';

        var thTextColor = '#1F77B4';
        var ipTextColor = '#FF7F0E';
        var currTextColor = '#2CA02C';
        var disTextColor = '#7F7F7F';

        defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis);

        function defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis) {

            // Total Head
            let trace1x = [];
            let trace1y = [];
            let trace2x = [];
            let trace2y = [];
            let trace3x = [];
            let trace3y = [];

            @foreach ($volumetricsValues as $vol)
                trace1x.push({{ $vol['fldrdis'] }});
                trace1y.push({{ $vol['fldrthead'] }});
                trace2x.push({{ $vol['fldrdis'] }});
                trace2y.push({{ $vol['fldrip'] }});
                trace3x.push({{ $vol['fldrdis'] }});
                trace3y.push({{ $vol['fldcurr'] }});
            @endforeach

            trace1 = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                line: {
                    color: thLineColor
                },
            };
            // End of Total Head

            // IP
            trace2 = {
                x: trace2x,
                y: trace2y,
                name: 'IP',
                yaxis: 'y2',
                type: 'scatter',
                line: {
                    color: '#2CA02C'
                },
            };
            // End of IP

            // I
            trace3 = {
                x: trace3x,
                y: trace3y,
                name: 'I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    color: '#FF7F0E'
                },
            };
            // End of I

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
                B = [{{ $pumpValues['flddis'] }}, {{ $pumpValues['fldthead'] }}],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            trace4 = {
                x: [0, {{ $pumpValues['flddis'] }}, p1[0], {{ $pumpValues['flddis'] }},
                    {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0
                ],
                y: [0, {{ $pumpValues['fldthead'] }}, p1[1], {{ $pumpValues['fldthead'] }}, 0,
                    {{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }}
                ],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " +
                    "{{ $pumpValues['fldthead'] }}) Duty Point", ''
                ]
            };
            // End of Duty Point

            data = [trace1, trace2, trace3, trace4, tracetest];

            layout = {
                title: {
                    text: 'G1',
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
            var qvsthPoints = findLineIntercepts(trace1, trace4);

            if (qvsthPoints == undefined) {
                qvsthPoints.x = 0;
                qvsthPoints.y = 0;
            }
            // End Q vs TH Points Intercept Calculation

            if (qvsthPoints != undefined) {
                let newDutyPointLineX = [];
                let newDutyPointLineY = [];
                if (qvsthPoints.x <= {{ $pumpValues['flddis'] }} && qvsthPoints.y <= {{ $pumpValues['fldthead'] }}) {
                    newDutyPointLineX = [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }},
                        {{ $pumpValues['flddis'] }}, 0
                    ];
                    newDutyPointLineY = [0, {{ $pumpValues['fldthead'] }}, 0, {{ $pumpValues['fldthead'] }},
                        {{ $pumpValues['fldthead'] }}
                    ];
                    symbols = ['line-ew', "line-ew", "line-ew", "", "line-ew"];
                    texts = ['', '', '', "(" + {{ $pumpValues['flddis'] }} + ", " + {{ $pumpValues['fldthead'] }} +
                        ") Duty Point", ''
                    ];
                } else {
                    newDutyPointLineX = [0, {{ $pumpValues['flddis'] }}, qvsthPoints.x, {{ $pumpValues['flddis'] }},
                        {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }},
                        0
                    ];
                    newDutyPointLineY = [0, {{ $pumpValues['fldthead'] }}, qvsthPoints.y,
                        {{ $pumpValues['fldthead'] }},
                        0, {{ $pumpValues['fldthead'] }},
                        {{ $pumpValues['fldthead'] }}
                    ];
                    symbols = ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew"];
                    texts = ['', '', '', '', '', "(" + {{ $pumpValues['flddis'] }} + ", " +
                        {{ $pumpValues['fldthead'] }} + ") Duty Point"
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
                    hoverinfo: 'text',
                    text: texts
                };
                data[3] = trace4Replaced;
                // End of Duty Point Replace
            }

            Plotly.newPlot('myDiv', data, layout, config);
        }





        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];

        @foreach ($volumetricsValues as $vol)
            trace1x.push({{ $vol['fldrdis'] }});
            trace1y.push({{ $vol['fldrthead'] }});
            trace2x.push({{ $vol['fldrdis'] }});
            trace2y.push({{ $vol['fldrip'] }});
            trace3x.push({{ $vol['fldrdis'] }});
            trace3y.push({{ $vol['fldcurr'] }});
        @endforeach

        function obsValues(discharge = {{ $pumpValues['flddis'] }}, tHead = {{ $pumpValues['fldthead'] }}, headR1 =
            {{ $pumpValues['fldheadr1'] }}, headR2 = {{ $pumpValues['fldheadr2'] }}) {

            // Total Head

            var trace1 = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                line: {
                    color: thLineColor
                },
            };

            // End of Total Head

            // IP
            var trace2 = {
                x: trace2x,
                y: trace2y,
                name: 'IP',
                yaxis: 'y2',
                type: 'scatter',
                line: {
                    color: ipLineColor
                },
            };
            // End of IP

            // I
            var trace3 = {
                x: trace3x,
                y: trace3y,
                name: 'I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    color: currLineColor
                },
            };
            // End of I

            // Duty Point Extend Calculation

            var A = [0, 0],
                B = [discharge, tHead],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            var trace4 = {
                x: [0, discharge, p1[0], discharge, discharge, discharge, 0],
                y: [0, tHead, p1[1], tHead, 0, tHead, tHead],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', "(" + discharge + ", " + tHead + ") Duty Point", '']
            };
            // End of Duty Point

            var data = [trace1, trace2, trace3, trace4];

            var layout = {
                title: {
                    text: 'G1',
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
                    newDutyPointLineX = [0, discharge, discharge, discharge, 0];
                    newDutyPointLineY = [0, tHead, 0, tHead, tHead];
                    symbols = ['line-ew', "line-ew", "line-ew", "", "line-ew"];
                    texts = ['', '', '', "(" + discharge + ", " + tHead + ") Duty Point", ''];
                } else {
                    newDutyPointLineX = [0, discharge, qvsthPoints.x, discharge, discharge, discharge, 0];
                    newDutyPointLineY = [0, tHead, qvsthPoints.y, tHead, 0, tHead, tHead];
                    symbols = ['line-ew', "", "line-ew", "line-ew", "line-ew", "line-ew", "line-ew"];
                    texts = ['', '', '', '', '', "(" + discharge + ", " + tHead + ") Duty Point", ''];
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
                data[3] = trace4Replaced;
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

            // Q vs IP Line
            var trace6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2)],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                name: 'Q vs IP',
                yaxis: 'y2',
                type: 'scatter'
            };
            // End of Q vs IP Line

            // Head Range (e.g: 13)
            var trace7 = {
                x: [0, {{ $isiGraphScaleValues['xaxis'] * 20 }}],
                y: [headR1, headR1],
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
                y: [headR2, headR2],
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

            Plotly.newPlot('myDiv', data, layout, config);



            // Q vs IP Points Intercept Calculation
            var qvsipPoints = findLineIntercepts(trace2, trace6);

            //////////// Plotly.extendTraces(myDiv, 
            //////////// {
            ////////////     x:[[parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2)]],
            ////////////     y:[[25.92, parseFloat(qvsipPoints.y).toFixed(2)]]
            //////////// }, [5]);

            var traceReplaced6 = {
                x: [parseFloat(qvsthPoints.x).toFixed(2), parseFloat(qvsthPoints.x).toFixed(2), 0],
                y: [0, parseFloat(qvsipPoints.y).toFixed(2), parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Q vs IP',
                yaxis: 'y2',
                type: 'scatter',
            };

            data[5] = traceReplaced6;

            $('#observedIP').html(parseFloat(qvsipPoints.y).toFixed(2));
            $('#addIP').val(parseFloat(qvsipPoints.y).toFixed(2));
            $('#reportObsIP').val(parseFloat(qvsipPoints.y).toFixed(2));

            if (parseFloat(qvsipPoints.y).toFixed(2) < ({{ $pumpValues['fldip'] }} * 1.1)) {
                $('#ipResult').html('Pass');
            } else {
                $('#ipResult').html('Fail');
            }
            // End Q vs IP Points Intercept Calculation


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
                y: [headR2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
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
            Plotly.newPlot('myDiv', data, layout, config);

            var headRangeIIntercept = findLineIntercepts(trace3, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2)],
                y: [headR1, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    // {{ $isiGraphScaleValues['yaxis1'] * 18 }}
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

            data[6] = traceReplaced7;
            // End of Trace 7 Reassign

            var headRangeIIntercept2 = findLineIntercepts(trace3, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2)],
                y: [headR2, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    // {{ $isiGraphScaleValues['yaxis1'] * 18 }}
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

            data[7] = traceReplaced8;
            // End of Trace 7 Reassign

            var trace3SubTrace = {
                // x: [headRangeIIntercept.x, headRangeIIntercept.x, 0],
                // y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, headRangeIIntercept.y, headRangeIIntercept.y],
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
                // x: [headRangeIIntercept2.x, headRangeIIntercept2.x, 0],
                // y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, headRangeIIntercept2.y, headRangeIIntercept2.y],
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

                if (parseFloat(headRangeIIntercept.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            } else {
                $('#observedI').html(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#addCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));
                $('#reportObsCurr').val(parseFloat(headRangeIIntercept2.y).toFixed(2));

                if (parseFloat(headRangeIIntercept2.y).toFixed(2) <= ({{ $pumpValues['fldmcurr'] }} * 1.07)) {
                    $('#iResult').html('Pass');
                } else {
                    $('#iResult').html('Fail');
                }
            }

            Plotly.newPlot('myDiv', data, layout, config);

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#ipResult').html() ==
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

            // Input Power BarChart
            var trace1 = {
                x: ['Input Power'],
                y: [{{ $pumpValues['fldip'] }}],
                name: 'Declared',
                type: 'bar',
                marker: {
                    color: 'red'
                }
            };

            var trace2 = {
                x: ['Input Power'],
                y: [parseFloat(qvsipPoints.y).toFixed(2)],
                name: 'Observed',
                type: 'bar',
                marker: {
                    color: 'limegreen'
                }
            };

            var data = [trace1, trace2];

            Plotly.newPlot('ipBarChart', data, layout, config);
            // End Input Power BarChart

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

            // Input Power PieChart
            var data = [{
                values: [{{ $pumpValues['fldip'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldip'] }}, parseFloat(qvsipPoints.y).toFixed(2)],
                textinfo: 'text',
                hoverinfo: 'none',
                marker: {
                    colors: ['red', 'limegreen']
                }
            }];

            Plotly.newPlot('ipPieChart', data, layout, config);
            // End of Input Power PieChart

            // Current PieChart
            var data = [{
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

            Plotly.newPlot('currPieChart', data, layout, config);
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
            if ($('#observedIP').html() == 'NaN') {
                $('#observedIP').html('');
            }
            if ($('#observedI').html() == 'NaN') {
                $('#observedI').html('');
            }
        }

        function callG1() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('8472/entry/pump_testing_isi/graphs/vol/g6') }}" + "?" + parameters[1];
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
    </script>
@endsection
