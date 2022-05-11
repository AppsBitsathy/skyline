@extends('includes.master')
@section('content')
    {{-- <div class="container">
        <div class="row">
            <div class="col m2"><a href="{{ route('entryPumpTestISIFlowGraphG1') }}" class="btn waves-effect">G1</a>
            </div>
            <div class="col m2"><a class="btn waves-effect">G2</a></div>
            <div class="col m2"><a class="btn waves-effect">G3</a></div>
            <div class="col m2"><a class="btn waves-effect">G4</a></div>
            <div class="col m2"><a class="btn waves-effect">G5</a></div>
            <div class="col m2"><a class="btn waves-effect">G6</a></div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col s12 m9 l9 mt-3" id="chartDiv">
            <div id='myDiv'></div>
        </div>
        <div class="col s12 m1 l1 mt-3">
            <a id="hide_show" class="btn waves-effect right"><i class="material-icons">swap_horiz</i></a>
        </div>
        <div class="col s12 m2 l2 card">
            <div class="row center">
                <h4 class="m-4">G1</h4>
                <div class="input-field col s12">
                    <select name="unitForDischarge" id="unitForDischarge">
                        <option value="Lps">Lps</option>
                        <option value="Us/gpm">Us/gpm</option>
                        <option value="m3/hr">m<sup>3</sup>/hr</option>
                        <option value="All">All</option>
                    </select>
                    <label for="unitForDischarge">Unit for Discharge</label>
                </div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G1</a>
                </div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G2</a></div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G3</a></div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G4</a></div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G5</a></div>
                <div class="col m6 p-2"><a class="btn waves-effect m12">G6</a></div>
                <div class="col m12 pb-1"><a onclick="obsValues()" class="btn waves-effect col m12">Obs. Values</a>
                </div>
                <div class="col m12 pb-1"><a href="#perChartModal" class="btn waves-effect modal-trigger col m12">Per.
                        Chart</a>
                </div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Excel</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Duty Point</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">TH vs Q</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Q vs TH</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Report</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Pick Point</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Color</a></div>
                <div class="col m12 pb-1"><a onclick="saveAsImage()" class="btn waves-effect col m12">Save</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Preview</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12">Add / Print</a></div>
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
                        <td>{{ $pumpValues['flddis'] }}</td>
                        <td id="observedQ"></td>
                        <td id="dischargeResult"></td>
                    </tr>
                    <tr>
                        <td>TH - Total Head in m</td>
                        <td>{{ $pumpValues['fldThead'] }}</td>
                        <td id="observedTH"></td>
                        <td id="thResult"></td>
                    </tr>
                    <tr>
                        <td>OAE - Overall Efficiency in %</td>
                        <td>{{ $pumpValues['fldoeff'] }}</td>
                        <td id="observedOAE"></td>
                        <td id="oaeResult"></td>
                    </tr>
                    <tr>
                        <td>I - Current in Amps</td>
                        <td>{{ $pumpValues['fldMcurr'] }}</td>
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
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            console.log('{{ $isiGraphScaleValues['xaxis'] }}');
        });

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






        // $('#slide-out').hide();
        // $('.sidenav-trigger').hide();
        // $('main').addClass('pl-0');


        // Total Head

        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];

        @foreach ($volumetricsValues as $vol)
            trace1x.push({{ $vol['fldRDis'] }});
            trace1y.push({{ $vol['fldRTHead'] }});
            trace2x.push({{ $vol['fldRDis'] }});
            trace2y.push({{ $vol['fldOeff'] }});
            trace3x.push({{ $vol['fldRDis'] }});
            trace3y.push({{ $vol['fldCurr'] }});
        @endforeach

        var trace1 = {
            x: trace1x,
            y: trace1y,
            name: 'TH',
            type: 'scatter',
            //   line: {
            //       shape: 'spline',
            //       smoothing: 1.5,
            //   }
        };
        // End of Total Head

        // OAE
        var trace2 = {
            x: trace2x,
            y: trace2y,
            name: 'OAE',
            yaxis: 'y2',
            type: 'scatter'
        };
        // End of OAE

        // I
        var trace3 = {
            x: trace3x,
            y: trace3y,
            name: 'I',
            yaxis: 'y3',
            type: 'scatter'
        };
        // End of I

        // Duty Point Extend Calculation

        var A = [0, 0],
            B = [{{ $pumpValues['flddis'] }}, {{ $pumpValues['fldThead'] }}],
            p0 = pointAtX(A, B, 0),
            p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

        // End of Duty Point Extend Calculation

        // Duty Point
        var trace4 = {
            x: [0, {{ $pumpValues['flddis'] }}, p1[0]],
            y: [0, {{ $pumpValues['fldThead'] }}, p1[1]],
            name: 'Duty Point',
            type: 'scatter'
        };
        // End of Duty Point

        var data = [trace1, trace2, trace3, trace4];

        var layout = {
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
                    color: '#d62728'
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
        };

        var config = {
            responsive: true,
            displaylogo: false,
        }

        Plotly.newPlot('myDiv', data, layout, config);

        

        

        function obsValues() {
            // Total Head

            let trace1x = [];
            let trace1y = [];
            let trace2x = [];
            let trace2y = [];
            let trace3x = [];
            let trace3y = [];

            @foreach ($volumetricsValues as $vol)
                trace1x.push({{ $vol['fldRDis'] }});
                trace1y.push({{ $vol['fldRTHead'] }});
                trace2x.push({{ $vol['fldRDis'] }});
                trace2y.push({{ $vol['fldOeff'] }});
                trace3x.push({{ $vol['fldRDis'] }});
                trace3y.push({{ $vol['fldCurr'] }});
            @endforeach

            var trace1 = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                
            };
            // End of Total Head

            // OAE
            var trace2 = {
                x: trace2x,
                y: trace2y,
                name: 'OAE',
                yaxis: 'y2',
                type: 'scatter',
                line: {
                    color: oaeLineColor
                },
            };
            // End of OAE

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
                B = [{{ $pumpValues['flddis'] }}, {{ $pumpValues['fldThead'] }}],
                p0 = pointAtX(A, B, 0),
                p1 = pointAtX(A, B, {{ $isiGraphScaleValues['xaxis'] * 20 }});;

            // End of Duty Point Extend Calculation

            // Duty Point
            var trace4 = {
                x: [0, {{ $pumpValues['flddis'] }}, p1[0]],
                y: [0, {{ $pumpValues['fldThead'] }}, p1[1]],
                name: 'Duty Point',
                type: 'scatter'
            };
            // End of Duty Point

            var data = [trace1, trace2, trace3, trace4];

            var layout = {
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
                responsive: true,
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

            $('#observedQ').html(parseFloat(qvsthPoints.x).toFixed(2));
            $('#addDis').val(parseFloat(qvsthPoints.x).toFixed(2));
            $('#observedTH').html(parseFloat(qvsthPoints.y).toFixed(2));
            $('#addTH').val(parseFloat(qvsthPoints.y).toFixed(2));

            if (parseFloat(qvsthPoints.x).toFixed(2) >= {{ $pumpValues['flddis'] }}) {
                $('#dischargeResult').html('Pass');
            } else {
                if (parseFloat(qvsthPoints.x).toFixed(2) >= ({{ $pumpValues['flddis'] }} - 0.5)) {
                    $('#dischargeResult').html('Pass');
                } else {
                    $('#dischargeResult').html('Fail');
                }
            }

            if (parseFloat(qvsthPoints.y).toFixed(2) >= {{ $pumpValues['fldThead'] }}) {
                $('#thResult').html('Pass');
            } else {
                if (parseFloat(qvsthPoints.y).toFixed(2) >= ({{ $pumpValues['fldThead'] }} - 0.5)) {
                    $('#thResult').html('Pass');
                } else {
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
                y: [{{ $pumpValues['fldHeadr1'] }}, {{ $pumpValues['fldHeadr1'] }}],
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
                y: [{{ $pumpValues['fldHeadr2'] }}, {{ $pumpValues['fldHeadr2'] }}],
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

            data[5] = traceReplaced6;

            $('#observedOAE').html(parseFloat(qvsoaePoints.y).toFixed(2));

            if (parseFloat(qvsoaePoints.y).toFixed(2) >= {{ $pumpValues['fldoeff'] }}) {
                $('#oaeResult').html('Pass');
            } else {
                if (parseFloat(qvsoaePoints.y).toFixed(2) >= ({{ $pumpValues['fldoeff'] }} - 0.5)) {
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
                y: [{{ $pumpValues['fldHeadr1'] }}, parseFloat(headRangeTHIntercept.y).toFixed(2),
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

            data[6] = traceReplaced7;
            // End Trace 7 Points Intercept Calculation

            // Trace 8 Points Intercept Calculation
            var headRangeTHIntercept2 = findLineIntercepts(trace1, trace8);

            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2),
                    parseFloat(headRangeTHIntercept2.x).toFixed(2)
                ],
                y: [{{ $pumpValues['fldHeadr2'] }}, parseFloat(headRangeTHIntercept2.y).toFixed(2),
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

            data[7] = traceReplaced8;
            // End Trace 8 Points Intercept Calculation
            Plotly.newPlot('myDiv', data, layout, config);

            var headRangeIIntercept = findLineIntercepts(trace3, traceReplaced7);

            // Trace 7 Reassign
            var traceReplaced7 = {
                x: [0, parseFloat(headRangeTHIntercept.x).toFixed(2), parseFloat(headRangeTHIntercept.x).toFixed(2)],
                y: [{{ $pumpValues['fldHeadr1'] }}, parseFloat(headRangeTHIntercept.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}
                ],
                name: 'Q vs I Connector',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#E377C2'
                }
            }

            data[6] = traceReplaced7;
            // End of Trace 7 Reassign

            var headRangeIIntercept2 = findLineIntercepts(trace3, traceReplaced8);

            // Trace 8 Reassign
            var traceReplaced8 = {
                x: [0, parseFloat(headRangeTHIntercept2.x).toFixed(2), parseFloat(headRangeTHIntercept2.x).toFixed(2)],
                y: [{{ $pumpValues['fldHeadr2'] }}, parseFloat(headRangeTHIntercept2.y).toFixed(2),
                    {{ $isiGraphScaleValues['yaxis1'] * 18 }}
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
                x: [headRangeIIntercept.x, headRangeIIntercept.x, 0],
                y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, headRangeIIntercept.y, headRangeIIntercept.y],
                name: 'Q vs I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    dash: 'dot',
                    width: 2,
                    color: '#E377C2'
                }
            };

            data.push(trace3SubTrace);

            var trace3SubTrace2 = {
                x: [headRangeIIntercept2.x, headRangeIIntercept2.x, 0],
                y: [{{ $isiGraphScaleValues['yaxis1'] * 18 }}, headRangeIIntercept2.y, headRangeIIntercept2.y],
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

                if (parseFloat(headRangeIIntercept.y).toFixed(2) < {{ $pumpValues['fldMcurr'] }}) {
                    $('#iResult').html('Pass');
                } else {
                    if (parseFloat(headRangeIIntercept.y).toFixed(2) < ({{ $pumpValues['fldMcurr'] + 0.5 }})) {
                        $('#iResult').html('Fail');
                    } else {
                        $('#iResult').html('Pass');
                    }
                }
            } else {
                $('#observedI').html(parseFloat(headRangeIIntercept2.y).toFixed(2));

                if (parseFloat(headRangeIIntercept2.y).toFixed(2) < {{ $pumpValues['fldMcurr'] }}) {
                    $('#iResult').html('Pass');
                } else {
                    if (parseFloat(headRangeIIntercept2.y).toFixed(2) < ({{ $pumpValues['fldMcurr'] + 0.5 }})) {
                        $('#iResult').html('Fail');
                    } else {
                        $('#iResult').html('Pass');
                    }
                }

            }

            // Plotly.deleteTraces('myDiv', [6, 7]);

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
                y: [{{ $pumpValues['flddis'] }}],
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
                y: [{{ $pumpValues['fldThead'] }}],
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
                values: [{{ $pumpValues['flddis'] }}, parseFloat(qvsthPoints.x).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['flddis'] }}, parseFloat(qvsthPoints.x).toFixed(2)],
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
                values: [{{ $pumpValues['fldThead'] }}, parseFloat(qvsthPoints.y).toFixed(2)],
                labels: ['Declared', 'Observed'],
                type: 'pie',
                text: [{{ $pumpValues['fldThead'] }}, parseFloat(qvsthPoints.y).toFixed(2)],
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
        }
    </script>
@endsection
