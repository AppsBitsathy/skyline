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
            <div id='dummyDiv'></div>
        </div>
        <div class="col s12 m1 l1 mt-3">
            <a id="hide_show" class="btn waves-effect right"><i class="material-icons">swap_horiz</i></a>
        </div>
        <div class="col s12 m2 l2 card">
            <div class="row center">
                <h5 class="m-2">G4</h5>
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
                    <form action="{{ route('12225_entryPumpTestISIFlowGraphAddPrint') }}" method="post">
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
            <a  class="modal-close waves-effect waves-green btn-flat">CLOSE</a>
        </div>
    </div>

@endsection

@section('custom-script')
    <script>
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
        var trace4;
        var trace1sub;
        var trace2sub;
        var trace3sub;
        var trace4sub;
        var trace5;
        var trace6;
        var data;
        var layout;
        var tracetest;

        var sample1x = [];
        var sample1y = [];
        var sample2x = [];
        var sample2y = [];
        var sample3x = [];
        var sample3y = [];
        var sample4x = [];
        var sample4y = [];

        // defaultGraph(visibleX1, visibleX2, visibleX3, selectedXAxis);

        let trace1x = [];
        let trace1y = [];
        let trace2x = [];
        let trace2y = [];
        let trace3x = [];
        let trace3y = [];
        let trace4x = [];
        let trace4y = [];

        @foreach ($flowmetricsValues as $flow)
            trace1x.push({{ $flow['fldrdis'] }});
            trace1y.push({{ $flow['fldrthead'] }});
            trace2x.push({{ $flow['fldrdis'] }});
            trace2y.push({{ $flow['fldrdlwl'] }});
            trace3x.push({{ $flow['fldrdis'] }});
            trace3y.push({{ $flow['fldipow'] }});
            trace4x.push({{ $flow['fldrdis'] }});
            trace4y.push({{ $flow['fldcurr'] }});
        @endforeach

        // function defaultGraph(visibleX1 = true, visibleX2 = false, visibleX3 = false, selectedXAxis = 'x1') {

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

        xy[0] = [];
        xy[0][0] = trace1x[0];
        xy[0][1] = trace1y[0];
        k = 1;
        jj = 0;

        let rec = trace1x.length;
        let n = rec - 2;
        let sv = {{ ($flowmetricsValuesASC[0]['fldrdis'] / 17) * 4 }};

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
            for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.003) {
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
            for (let j = xy[k][0]; j <= xy[k + 1][0]; j = j + 0.003) {
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
        let i = xy[0][0];
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
            for (let j = i; j <= xy[k + 1][0]; j = j + 0.003) {
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
            for (let j = i; j <= xy[k + 1][0]; j = j + 0.003) {
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
                color: '#1F77B4'
            },
        };

        trace1sub = {
            x: trace1x,
            y: trace1y,
            name: 'TH',
            type: 'scatter',
            mode: 'markers',
            line: {
                color: '#1F77B4'
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
            x: [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,{{ $pumpValues['flddis'] }},{{ $pumpValues['flddis'] }}],
            y: [0, {{ $pumpValues['fldthead'] }}, {{ $pumpValues['flddlwl'] }}, 0, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, 0,{{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }},{{ $pumpValues['fldthead'] }},{{ $isiGraphScaleValues['yaxis1'] * 18 }}],
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
            y: [0,{{ $isiGraphScaleValues['yaxis1'] * 18 }}],
            type: 'scatter',
            marker: {
                symbol: ['line-ew','line-ew']
            },
            hoverinfo: 'none',
            showlegend: false
        }

        data = [trace1, trace1sub, trace2, trace2sub, trace3, trace3sub, trace4, trace4sub, trace5, trace6, tracetest];

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
        // }

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
                line: {
                    color: thLineColor
                },
            };
            // End of Total Head

            // DLWL
            trace2 = {
                x: sample2x,
                y: sample2y,
                name: 'DLWL',
                yaxis: 'y1',
                type: 'scatter',
                line: {
                    color: dlwlLineColor
                },
            };
            // End of DLWL

            // IP
            trace3 = {
                x: sample3x,
                y: sample3y,
                name: 'IP',
                yaxis: 'y2',
                type: 'scatter',
                line: {
                    color: ipLineColor
                },
            };
            // End of IP
            
            // I
            trace4 = {
                x: sample4x,
                y: sample4y,
                name: 'I',
                yaxis: 'y3',
                type: 'scatter',
                line: {
                    color: currLineColor
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

            // Duty Point
            trace5 = {
                x: [0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, 0, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}, 0,{{ $pumpValues['flddis'] }},{{ $pumpValues['flddis'] }}],
                y: [0, {{ $pumpValues['fldthead'] }}, {{ $pumpValues['flddlwl'] }}, 0, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, {{ $pumpValues['flddlwl'] }}, 0,{{ $pumpValues['fldthead'] }}, {{ $pumpValues['fldthead'] }},{{ $pumpValues['fldthead'] }},{{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                name: 'Duty Point',
                type: 'scatter',
                marker: {
                    size: 15,
                    symbol: ['line-ew', "", "", "line-ew", "line-ew", "line-ew", "line-ew","line-ew","line-ew","line-ew","line-ew","line-ew"]
                },
                yaxis: 'y2',
                hoverinfo: 'text',
                text: ['', '', '', '', '', '', "({{ $pumpValues['flddis'] }}" + ", " + "{{ $pumpValues['flddlwl'] }}) Duty Point", '', '', '', "({{ $pumpValues['flddis'] }}" + ", " + "{{ $pumpValues['fldthead'] }}) Duty Point", '']
            };
            // End of Duty Point

            dptoYTrace = {
                x: [{{ $pumpValues['flddis'] }}, {{ $pumpValues['flddis'] }}],
                y: [0, {{ $isiGraphScaleValues['yaxis2'] * 18 }}],
                type: 'scatter',
                yaxis: 'y2',
            }
 
            trace6 = {
                x: [{{ $pumpValues['flddis'] }} * 0.92,{{ $pumpValues['flddis'] }} * 0.92],
                y: [0,{{ $isiGraphScaleValues['yaxis1'] * 18 }}],
                type: 'scatter',
                marker: {
                    symbol: ['line-ew','line-ew']
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

            Plotly.redraw('myDiv',{});

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

            if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#dlwlResult').html() == 'Pass' && $('#ipResult').html() == 'Pass' && $('#iResult').html() == 'Pass') {
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

        function callG1() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g1') }}" + "?" + parameters[1];
        }

        function callG2() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g2') }}" + "?" + parameters[1];
        }

        function callG3() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g3') }}" + "?" + parameters[1];
        }

        function callG4() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g4') }}" + "?" + parameters[1];
        }

        function callG5() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g5') }}" + "?" + parameters[1];
        }

        function callG6() {
            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('12225/entry/pump_testing_isi/graphs/flow/g6') }}" + "?" + parameters[1];
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
                var graph = document.getElementById('myDiv');

                graph.data.push(gridTrace);

                Plotly.redraw('myDiv',{});
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
                var graph = document.getElementById('myDiv');

                graph.data.push(heatmapTrace);

                Plotly.redraw('myDiv',{});

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
    </script>
@endsection
