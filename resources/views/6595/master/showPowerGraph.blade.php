@extends('includes.master')
<title>Master - Power IO Graph</title>
@php
$rMain = 1;
$rId = 12;
@endphp
@section('content')
    <div class="row">
        <div class="col s12 m10 l10 mt-3" id="chartDiv">
            <div id='myDiv'></div>
        </div>
        <div class="col s12 m2 l2 card mt-3">
            <div class="row center">
                <h6 class="m-2"><br>H.P/k.W :- {{ $entries[0]['fldhp'] }}<br><br>Speed(rpm) :- {{ $entries[0]['fldspeed'] }}</h6>
                <div class="col m12 pb-1"><a onclick="powerOP()" class="btn waves-effect col m12">Power O/P (KW)</a></div>
                <br>
                <br>
                <div class="col m12 pb-1">
                    <input class="btn btn-primary col m12" type="submit" id="graphPrintBtn" value="Print">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-script')
<script>
            let trace1x = [];
            let trace1y = [];

            @foreach ($entries as $ent)
                trace1x.push({{ $ent['fldx'] }});
                trace1y.push({{ $ent['fldy'] }});
            @endforeach

            var trace1 = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                line: {
                    color: thLineColor
                },
            };

            var data = [trace1];

            layout = {
                height: 700,
                margin: {
                    l: 10,
                    r: 20,
                    b: 100,
                    t: 100,
                    pad: 4
                },
                xaxis: {
                    title: {
                        text: 'Power I/P (Kilo Watts)',
                        font: {
                            size: 20,
                            color: '#7f7f7f'
                        },
                    },
                    tickfont: {
                        color: '#7f7f7f'
                    },
                    domain: [0.2, 1.0],
                    autorange: true,
                    ticklen: 10,
                },
                yaxis: {
                    title: {
                        text: 'Power O/P (Kilo Watts)',
                        font: {
                            size: 20,
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
                    autorange: true,
                    ticklen: 10,
                },
            };

            var config = {
                displaylogo: false,
            }

            Plotly.newPlot('myDiv', data, layout, config);

            function powerOP() {
                var temp1x=[];
                var temp1y=[];
                let fx='';
                let startval=0;
                let ii=0;
                if (fx = prompt('Enter the Motor Output in Kilo Watts')) {
                    for (let i = 0; i <= trace1x.length; i++) {
                        temp1x[i] = trace1x[i];
                        temp1y[i] = trace1y[i];
                    }
                    for (let i = 0; i <= trace1x.length - 1; i++) {
                        if (fx < temp1x[i]) {
                            startval = i - 1;
                        }
                        ii = i;
                    }
                    let y1 = temp1y[startval] + (parseFloat(fx) - temp1x[startval]) * (((temp1y[ii] - temp1y[startval]))/ (temp1x[ii] - temp1x[startval]));
                    console.log(y1);
                    alert('Pump Input in Kilo Watts :- ' + parseFloat(y1).toFixed(2));
                }
            }
</script>
@endsection
