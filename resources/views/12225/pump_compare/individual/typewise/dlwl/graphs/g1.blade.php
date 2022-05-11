@extends('includes.master')
@section('content')
    <div class="row">
        <div class="col s12 m10 l10 mt-3" id="chartDiv">
            <h4 id="hoverinfo" class="white mb-0 center" style="display: none">
                <br>
            </h4>
            <div id='myDiv'></div>
        </div>
        <div class="col s12 m10 l10 mt-3 hide" id="chartDiv">
            <div id='dummyDiv'>
            </div>
        </div>
        {{-- <div class="col s12 m1 l1 mt-3">
            <a id="hide_show" class="btn waves-effect right"><i class="material-icons">swap_horiz</i></a>
        </div> --}}
        <div class="col s12 m2 l2 card mt-3">
            <div class="row center">
                <h5 class="m-2">G1</h5>
                <div class="col m6 pb-1"><a onclick="callG1()" class="btn waves-effect col m12">G1</a>
                </div>
                <div class="col m6 pb-1"><a onclick="callG2()" class="btn waves-effect col m12">G2</a></div>
                <div class="col m6 pb-1"><a onclick="callG3()" class="btn waves-effect col m12">G3</a></div>
                <div class="col m6 pb-1"><a onclick="callG4()" class="btn waves-effect col m12">G4</a></div>
                <div class="col m6 pb-1"><a onclick="callG5()" class="btn waves-effect col m12">G5</a></div>
                <div class="col m6 pb-1"><a onclick="callG6()" class="btn waves-effect col m12">G6</a></div>
                <div class="col m12 pb-1"><a class="btn waves-effect modal-trigger col m12" id="graphPrintBtn">Print</a>
                </div>
                <div class="col m12 pb-1" id="selectedPumpDetails">

                </div>
            </div>
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

        

        var unitForDischarge = 1;

        var visibleX1;
        var visibleX2;
        var visibleX3;

        var selectedXAxis = '';

        var trace1;
        var trace2;
        var trace3;
        var trace4;
        var data = [];
        var layout;

        // Total Head

        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];
        let trace4x = [];
        let trace4y = [];

        let randomColor;

        let parameters = window.location.href.split('?')[1].split('&');

        let pump = parameters[0].split('=')[1];
        let pumpNos = parameters[2].split('=')[1].split(',');

        let ufd = parameters[3].split('=')[1];
        unitForDischarge = parameters[4].split('=')[1];

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

        let htm = '';

        pumpNos.forEach(pn => {
            const p = pump;

            htm += '<h6>';
            htm += '<i class="material-icons left circles">fiber_manual_record</i>' + p.toUpperCase() + ' (' + pn +
                ')';
            htm += '</h6>';
        });

        $('#selectedPumpDetails').html(htm);

        let count = 0;

        let colors = ['#00FF00', '#FF0000', '#0000CD', '#8A2BE2', '#A52A2A', '#D2691E', '#00FFFF', '#00008B', '#006400',
            '#8B008B', '#FF8C00', '#FF1493', '#FFD700', '#000080', '#008080', '#FF6347'
        ];

        @foreach ($metricsValues as $met)
        
            @foreach ($met as $m)
                trace1x.push({{ $m['fldrdis'] }});
                trace1y.push({{ $m['fldrthead'] }});
                trace2x.push({{ $m['fldrdis'] }});
                trace2y.push({{ $m['fldrdlwl'] }});
                trace3x.push({{ $m['fldrdis'] }});
                trace3y.push({{ $m['fldipow'] }});
                trace4x.push({{ $m['fldrdis'] }});
                trace4y.push({{ $m['fldcurr'] }});
            @endforeach
        
            randomColor = colors[count];
        
            $('.circles:eq('+count+')').css('color',randomColor);
        
            count++;
        
            trace1 = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                line: {
                color: randomColor
                // color: '#1F77B4'
                },
                marker: {
                size: 10,
                color: randomColor,
                symbol: 'diamond'
                }
            };
            // End of Total Head
        
            trace1x = [];
            trace1y = [];
        
            // DLWL
            trace2 = {
                x: trace2x,
                y: trace2y,
                name: 'DLWL',
                type: 'scatter',
                line: {
                color: randomColor
                // color: '#2CA02C'
                },
                marker: {
                size: 10,
                color: randomColor,
                }
            };
            // End of DLWL
        
            trace2x = [];
            trace2y = [];

            // IP
            trace3 = {
                x: trace3x,
                y: trace3y,
                name: 'IP',
                yaxis: 'y2',
                type: 'scatter',
                line: {
                color: randomColor
                // color: '#2CA02C'
                },
                marker: {
                size: 10,
                color: randomColor,
                }
            };
            // End of IP
        
            trace3x = [];
            trace3y = [];
        
            // I
            trace4 = {
                x: trace4x,
                y: trace4y,
                name: 'I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                color: randomColor
                // color: '#FF7F0E'
                },
                marker: {
                size: 10,
                color: randomColor,
                symbol: 'x'
                }
            };
            // End of I
        
            trace4x = [];
            trace4y = [];
        
            data.push(trace2);
        @endforeach

        tracetest = {
            x: [],
            y: [],
            xaxis: selectedXAxis,
            type: 'scatter',
            line: {
                color: '#2CA02C'
            }
        }

        data.push(tracetest);

        // Duty Point
            trace5 = {
                x: [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,{{ $pumpValues['flddis'] }},{{ $pumpValues['flddis'] }}],
                y: [0, {{ $pumpValues['fldthead'] }}, {{ $pumpValues['flddlwl'] }}, 0, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, 0,{{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }},{{ $pumpValues['fldthead'] }},{{ $isiGraphScaleValues->yaxis1 * 18 }}],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew","line-ew","line-ew","line-ew","line-ew","line-ew"]
                },
                hoverinfo: 'text',
                text: ['', '', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " + "{{ $pumpValues['flddlwl'] }}) Duty Point", '', '', '', "({{ $pumpValues['flddis'] }}" + ", " + "{{ $pumpValues['fldthead'] }}) Duty Point", '']
            };
            // End of Duty Point
 
            trace6 = {
                x: [{{ $pumpValues['flddis'] }} * 0.92,{{ $pumpValues['flddis'] }} * 0.92],
                y: [0,{{ $isiGraphScaleValues->yaxis1 * 18 }}],
                type: 'scatter',
                marker: {
                    symbol: ['line-ew','line-ew']
                },
                hoverinfo: 'none',
                showlegend:false
            }

        data.push(trace5);
        data.push(trace6);

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
                range: [0, {{ $isiGraphScaleValues->xaxis * 20 }}],
                dtick: {{ $isiGraphScaleValues->xaxis * 20 }} / 10,
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
                range: [0, {{ $isiGraphScaleValues->xaxis * 20 }} * unitForDischarge],
                dtick: ({{ $isiGraphScaleValues->xaxis * 20 }} * unitForDischarge) / 10,
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
                range: [0, {{ $isiGraphScaleValues->xaxis * 20 }} * unitForDischarge],
                dtick: ({{ $isiGraphScaleValues->xaxis * 20 }} * unitForDischarge) / 10,
                // ticks: '',
                overlaying: 'x',
                visible: visibleX3,
            },
            yaxis: {
                title: {
                    text: 'DLWL',
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
                range: [0, {{ $isiGraphScaleValues->yaxis1 * 18 }}],
                dtick: {{ $isiGraphScaleValues->yaxis1 * 18 }} / 18,
                ticklen: 10,
            },
        };

        var config = {
            displaylogo: false,
        }

        Plotly.newPlot('myDiv', data, layout, config);

        function callG1() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/typewise/dlwl/graphs/g6') }}" + "?" + parameters[1];
        }

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
