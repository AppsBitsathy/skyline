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
                <h5 class="m-2">G4</h5>
                <div class="col m6 pb-1"><a onclick="callG1()" class="btn waves-effect col m12">G1</a></div>
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

        function findLineIntercepts(t1, t2) {
            try {
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

                console.log(results);

                return results[0];

            } catch (error) {
                console.log(error);
                return [{
                    x: 0,
                    y: 0
                }];
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

        var sample1x = [];
        var sample1y = [];
        var sample2x = [];
        var sample2y = [];
        var sample3x = [];
        var sample3y = [];
        var sample3x = [];
        var sample3y = [];

        let xy = [];
        let k;
        let jj;
        let h = [];
        let d = [];
        let u = [];
        let a = [];
        let b = [];
        let m = [];
        let rec;
        let n;
        let sv;
        let i;

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
        
            // TotalHead Curve Formula

            sample1x = [];
            sample1y = [];
            xy = [];
            k;
            jj;
            h = [];
            d = [];
            u = [];
            a = [];
            b = [];
            m = [];

            xy[0] = [];
            xy[0][0] = trace1x[0];
            xy[0][1] = trace1y[0];
            k = 1;
            jj = 0;

            rec = trace1x.length;
            n = rec - 2;
            
            @php
                $count = 0;
            @endphp
            
                sv = {{ ($metricsValuesASC[$count][0]['fldrdis'] / 17) * 4 }};
            
            @php
                $count++;
            @endphp

            for (let i = 0; i <= rec; i++) {
                for (let j = jj; j <= trace1x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace1y[i] + (j - trace1x[i]) * (((trace1y[i + 1]) - trace1y[(i)]) / (trace1x[i + 1] -
                            trace1x[
                                i]));
                        xy[k] = [];
                        xy[k][0] = j;
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
                        a[i][j] = tempUse2 - factor * tempUse1;
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

            // DLWL Curve Formula

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

            xy[0] = [];
            xy[0][0] = trace2x[0];
            xy[0][1] = trace2y[0];
            k = 1;
            jj = 0;

            rec = trace2x.length;
            n = rec - 2;

            for (let i = 0; i <= rec; i++) {
                for (let j = jj; j <= trace2x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace2y[i] + (j - trace2x[i]) * (((trace2y[i + 1]) - trace2y[(i)]) / (trace2x[i + 1] -
                            trace2x[
                                i]));
                        xy[k] = [];
                        xy[k][0] = j;
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }
            // debugger
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
                        a[i][j] = tempUse2 - factor * tempUse1;
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

            // End of DLWL Curve Formula

            // IP Curve Formula

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

            xy[0] = [];
            xy[0][0] = trace3x[0];
            xy[0][1] = trace3y[0];
            k = 1;
            jj = 0;

            rec = trace3x.length;
            n = rec - 2;

            for (let i = 0; i <= rec; i++) {
                for (let j = jj; j <= trace3x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace3y[i] + (j - trace3x[i]) * (((trace3y[i + 1]) - trace3y[(i)]) / (trace3x[i + 1] -
                            trace3x[
                                i]));
                        xy[k] = [];
                        xy[k][0] = j;
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }
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
                        a[i][j] = tempUse2 - factor * tempUse1;
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
            i = xy[0][0];
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
                sk3 = (tempUse2 - tempUse1) / (6 * h[k]);
                let jj;
                for (let j = i; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample3x.push(j);
                    sample3y.push(yp);
                    jj = j;
                }
                i = jj - 0.001;
            }

            // End of IP Curve Formula

            // Current Curve Formula

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

            xy[0] = [];
            xy[0][0] = trace4x[0];
            xy[0][1] = trace4y[0];
            k = 1;
            jj = 0;

            rec = trace4x.length;
            n = rec - 2;

            for (let i = 0; i <= rec; i++) {
                for (let j = jj; j <= trace4x[i + 1]; j = j + sv) {
                    if (j > 0) {
                        let y1 = trace4y[i] + (j - trace4x[i]) * (((trace4y[i + 1]) - trace4y[(i)]) / (trace4x[i + 1] -
                            trace4x[
                                i]));
                        xy[k] = [];
                        xy[k][0] = j;
                        xy[k][1] = y1;
                        k = k + 1;
                    }
                    jj = jj + sv;
                }
            }
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
                        a[i][j] = tempUse2 - factor * tempUse1;
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
            i = xy[0][0];
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
                sk3 = (tempUse2 - tempUse1) / (6 * h[k]);
                let jj;
                for (let j = i; j <= xy[k + 1][0]; j = j + 0.050) {
                    w = j - xy[k][0];
                    yp = ((((sk3 * w) + sk2) * w + sk1) * w) + xy[k][1];
                    sample4x.push(j);
                    sample4y.push(yp);
                    jj = j;
                }
                i = jj - 0.001;
            }

            // End of Current Curve Formula

            // Total Head
            
            trace1 = {
                x: sample1x,
                y: sample1y,
                name: 'TH',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                color: randomColor
                },
                showlegend: false,
            };

            trace1sub = {
                x: trace1x,
                y: trace1y,
                name: 'TH',
                type: 'scatter',
                mode: 'markers',
                line: {
                color: randomColor
                },
                // showlegend: false,
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
                x: sample2x,
                y: sample2y,
                name: 'DLWL',
                type: 'scatter',
                hoverinfo: 'none',
                line: {
                color: randomColor
                },
                showlegend: false,
            };

            trace2sub = {
                x: trace2x,
                y: trace2y,
                name: 'DLWL',
                type: 'scatter',
                mode: 'markers',
                line: {
                color: randomColor
                },
                // showlegend: false,
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
                x: sample3x,
                y: sample3y,
                name: 'IP',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y2',
                line: {
                color: randomColor
                },
                showlegend: false,
            };

            trace3sub = {
                x: trace3x,
                y: trace3y,
                name: 'IP',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y2',
                line: {
                color: randomColor
                },
                // showlegend: false,
                marker: {
                size: 10,
                color: randomColor,
                }
            };

            // End of IP

            trace3x = [];
            trace3y = [];

            // Current

            trace4 = {
                x: sample4x,
                y: sample4y,
                name: 'I',
                type: 'scatter',
                hoverinfo: 'none',
                yaxis: 'y3',
                line: {
                color: randomColor
                },
                showlegend: false,
            };

            trace4sub = {
                x: trace4x,
                y: trace4y,
                name: 'I',
                type: 'scatter',
                mode: 'markers',
                yaxis: 'y3',
                line: {
                color: randomColor
                },
                // showlegend: false,
                marker: {
                size: 10,
                color: randomColor,
                symbol: 'x'
                }
            };

            // End of Current

            trace4x = [];
            trace4y = [];

            data.push(trace3);
            data.push(trace3sub);
                                                                
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

        // data.push(trace5);
        // data.push(trace6);

        layout = {
            title: {
                text: 'G4',
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
                range: [0, {{ $isiGraphScaleValues->yaxis1 * 18 }}],
                dtick: {{ $isiGraphScaleValues->yaxis1 * 18 }} / 18,
                ticklen: 10,
                visible: false,
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
                range: [0, {{ $isiGraphScaleValues->yaxis2 * 18 }}],
                dtick: {{ $isiGraphScaleValues->yaxis2 * 18 }} / 18,
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
                range: [0, {{ $isiGraphScaleValues->yaxis3 * 18 }}],
                dtick: {{ $isiGraphScaleValues->yaxis3 * 18 }} / 18,
                ticklen: 0,
            },
        };

        var config = {
            displaylogo: false,
        }

        Plotly.newPlot('myDiv', data, layout, config);

        function callG1() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/pump_comparison/individual_curve/alltype/ip/graphs/g6') }}" + "?" + parameters[1];
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
