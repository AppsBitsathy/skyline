<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Routine Testing - Report</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    @include('includes.top')
    <style>
        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
        }

        table tr td {
            border: 2px solid rgba(0, 0, 0, 0.12);
        }

        .rowspan {
            border-left-width: 10px;
        }

        table td.no-border-bottom {
            border-bottom: #ffffff;
        }

        table td.no-border-right {
            border-right: #ffffff;
        }

        table td.no-border-left {
            border-left: #ffffff;
        }

        table td.no-border {
            border: #ffffff;
        }

        table tr.no-border {
            border: #ffffff;
        }

    </style>
</head>

<body class="grey lighten-2">
    <div class="progress mt-0 hide" id="progress">
        <div class="indeterminate"></div>
    </div>
    <div class="center-align" id="makeprint">
        <div class="pb-1">
            <h4>Skyline Softwares, Coimbatore - 15.</h4>
            <h6>SUBMERSIBLE MOTOR PERFORMANCE TEST RECORDS AS PER IS : 9283 - 95</h6>
            {{-- <h6>Period : </h6> --}}
            <a class="btn waves-effect btn-flat" id="btnDownload" href="#">Download</a>
        </div>
        @isset($report_motor)
            @isset($report_minp)
                @isset($report_mcal)
                    <div class="row">
                        <div class="col m12">
                            <table class="white">
                                <tr>
                                    <td><b>Motor No.</b></td>
                                    <td><span>{{ $report_minp->fldmno }}</span></td>
                                    <td><b>Motor Type</b></td>
                                    <td><span>{{ $report_motor->fldmtype }}</span></td>
                                    <td><b>Date of testing</b></td>
                                    <td><span>{{ $report_minp->flddate }}</span></td>
                                    <td><b>Bore Size</b>&nbsp;(mm)</td>
                                    <td><span>{{ $report_motor->fldbore }}</span></td>
                                    <td><b>H. P.</b></td>
                                    <td><span>{{ $report_motor->fldhp }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>K. W.</b></td>
                                    <td><span>{{ $report_motor->fldkw }}</span></td>
                                    <td><b>Type</b></td>
                                    <td><span>{{ $report_minp->fldtype }}</span></td>
                                    <td><b>Speed</b>&nbsp;(RPM)</td>
                                    <td><span>{{ $report_motor->fldfspeed }}</span></td>
                                    <td><b>Phase</b></td>
                                    <td><span>{{ $report_motor->fldphase }}</span></td>
                                    <td><b>Connection</b></td>
                                    <td><span>{{ $report_minp->fldconn }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>I</b>&nbsp;(a)&nbsp;<b>Stator Resistance / Phase</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_minp->fldsres }}</span></td>
                                    <td><b>Initial Temperature</b>&deg;C</td>
                                    <td><span>{{ $report_minp->flditemp }}</span></td>
                                </tr>
                                <tr>
                                    <td>(b)&nbsp;<b>Reduced Voltage Test Apply<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1/Root 3
                                            of Rated Voltage</b></td>
                                    <td></td>
                                    <td><b>Speed in Clockwise</b>&deg;(RPM)</td>
                                    <td><span>{{ $report_minp->fldspeedclk }}</span></td>
                                    <td><b>Speed in Anti-Clockwise</b>&deg;(RPM)</td>
                                    <td><span>{{ $report_minp->fldspeedaclk }}</span></td>
                                </tr>

                                <tr>
                                    <td>(c)&nbsp;<b>Insulation Resistance Tests</b></td>
                                    <td></td>
                                    <td><b>Before High Voltage</b>(M ohm)</td>
                                    <td><span>{{ $report_minp->fldbhv }}</span></td>
                                    <td><b>After High Voltage</b>(M ohm)</td>
                                    <td><span>{{ $report_minp->fldahv }}</span></td>
                                </tr>

                                <tr>
                                    <td>(d)&nbsp;<b>High Voltage Test</b>&nbsp;(1500 V)<br>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Applied for 30 secs.</b>
                                    </td>
                                    <td>
                                        <span>{{ $report_minp->fldhv }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h6><b>II</b>&nbsp;NO LOAD TESTS</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2"><b>Volts&nbsp;V</b></td>
                                    <td rowspan="2"><b>Amps&nbsp;A</b></td>
                                    <td colspan="4" class="center"><b>Power</b></td>
                                    <td rowspan="2"><b>Speed&nbsp;RPM</b></td>
                                    <td rowspan="2"><b>Frequency&nbsp;Hz</b></td>
                                </tr>
                                <tr>
                                    <td><b>W1&nbsp;W</b></td>
                                    <td><b>W2&nbsp;W</b></td>
                                    <td><b>C1</b></td>
                                    <td><b>Total&nbsp;P1&nbsp;(W)</b></td>
                                </tr>
                                <tr>
                                    <td><span>{{ $report_minp->fldnlv }}</span></td>
                                    <td><span>{{ $report_minp->fldnla }}</span></td>
                                    <td><span>{{ $report_minp->fldnlw1 }}</span></td>
                                    <td><span>{{ $report_minp->fldnlw2 }}</span></td>
                                    <td><span>{{ $report_minp->fldnlc1 }}</span></td>
                                    <td><span>{{ $report_mcal->fldnltp }}</span></td>
                                    <td><span>{{ $report_minp->fldnlspeed }}</span></td>
                                    <td>
                                        <span>{{ $report_minp->fldnlfreq }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h6><b>III</b>&nbsp;FULL LOAD TESTS</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="2"><b>Volts&nbsp;V</b></td>
                                    <td rowspan="2"><b>Amps&nbsp;A</b></td>
                                    <td colspan="4" class="center"><b>Power</b></td>
                                    <td rowspan="2"><b>Speed&nbsp;RPM</b></td>
                                    <td rowspan="2"><b>Frequency&nbsp;Hz</b></td>
                                </tr>
                                <tr>
                                    <td><b>W3&nbsp;W</b></td>
                                    <td><b>W4&nbsp;W</b></td>
                                    <td><b>C2</b></td>
                                    <td><b>Total&nbsp;P2&nbsp;(W)</b></td>
                                </tr>
                                <tr>
                                    <td><span>{{ $report_minp->fldflv }}</span></td>
                                    <td><span>{{ $report_minp->fldfla }}</span></td>
                                    <td><span>{{ $report_minp->fldflw3 }}</span></td>
                                    <td><span>{{ $report_minp->fldflw4 }}</span></td>
                                    <td><span>{{ $report_minp->fldflc2 }}</span></td>
                                    <td><span>{{ $report_mcal->fldfltp }}</span></td>
                                    <td><span>{{ $report_minp->fldflspeed }}</span></td>
                                    <td>
                                        <span>{{ $report_minp->fldflfreq }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h6><b>IV</b>&nbsp;LOCKED ROTOR TESTS</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Volts&nbsp;V</b></td>
                                    <td><b>Volts&nbsp;(Actual)&nbsp;V</b></td>
                                    <td><b>Amps&nbsp;A</b></td>
                                    <td><b>Power</b></td>
                                    <td><b>Weight&nbsp;Kg</b></td>
                                </tr>
                                <tr>
                                    <td><span>{{ $report_minp->fldlrv }}</span></td>
                                    <td><span>{{ $report_minp->fldlrav }}</span></td>
                                    <td><span>{{ $report_minp->fldlra }}</span></td>
                                    <td><span>{{ $report_minp->fldlrpower }}</span></td>
                                    <td>
                                        <span>{{ $report_minp->fldlrweight }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h6><b>V</b>&nbsp;CALCULATION</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Resitance at 50 &deg;C</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_mcal->fldres50 }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Constant Losses</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldconstl }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>No Load I2R Losses</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldnll }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Full Load I2R Losses</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldfll }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Total Losses</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldtotall }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Rotor Input</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldsop }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Rotor Output</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldrotorl }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Stray Loss</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldstrayl }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Output</b>&nbsp;(W)</td>
                                    <td><span>{{ $report_mcal->fldop }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Efficiency</b>&nbsp;(%)</td>
                                    <td><span>{{ $report_mcal->fldeff }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Slip</b>&nbsp;(%)</td>
                                    <td><span>{{ round($report_mcal->fldslip, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Rated Torque</b>&nbsp;(Kg-m)</td>
                                    <td><span>{{ $report_mcal->fldrt }}</span></td>
                                </tr>
                                {{-- <tr>
                                    <td><b>Full Load Kilogram</b></td>
                                    <td><span>{{ $report_mcal->fldflkg }}</span></td>
                                </tr> --}}
                                <tr>
                                    <td><b>Break Away Torque</b>&nbsp;(Kg-m)</td>
                                    <td><span>{{ $report_mcal->fldbwt }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>FLT</b>&nbsp;(%)</td>
                                    <td>
                                        <span>{{ round($report_mcal->fldflt, 2) }}</span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <h6><b>VI</b>&nbsp;TEMP RISE TESTS&nbsp;(At rated voltage of 100%)</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Initial Resistance/Phase</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_minp->fldtrires }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Initial Temperature</b>&nbsp;&deg;C</td>
                                    <td><span>{{ $report_minp->fldtritemp }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Final Resistance/Phase</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_minp->fldtrfres }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Final Temperature</b>&nbsp;&deg;C</td>
                                    <td><span>{{ $report_minp->fldtrftemp }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Temperature Rise</b>&nbsp;&deg;C</td>
                                    <td>
                                        <span>{{ $report_mcal->fldtx }}</span>
                                    </td>
                                </tr>


                                <tr>
                                    <td>
                                        <h6><b>VII</b>&nbsp;TEMP RISE TESTS&nbsp;(At rated voltage of 85%)</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Initial Resistance/Phase</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_minp->fldtrires1 }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Initial Temperature</b>&nbsp;&deg;C</td>
                                    <td><span>{{ $report_minp->fldtritemp1 }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Final Resistance/Phase</b>&nbsp;(ohm)</td>
                                    <td><span>{{ $report_minp->fldtrfres1 }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Final Temperature</b>&nbsp;&deg;C</td>
                                    <td><span>{{ $report_minp->fldtrftemp1 }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Temperature Rise</b>&nbsp;&deg;C</td>
                                    <td>
                                        <span>{{ $report_mcal->fldty }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>RESULTS</td>
                                    <td>DECLARED</td>
                                    <td>OBSERVED</td>
                                </tr>
                                <tr>
                                    <td><b>Min. Efficiency</b>&nbsp;%</td>
                                    <td><span>{{ $report_motor->fldmeff }}</span></td>
                                    <td><span>{{ round($report_mcal->fldeff, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Min. Starting Torque</b>&nbsp;%</td>
                                    <td><span>{{ $report_motor->fldstorque }}</span></td>
                                    <td><span>{{ round($report_mcal->fldflt, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Max. Leakage Current</b>&nbsp;(Ma)</td>
                                    <td><span>{{ $report_motor->fldlcur }}</span></td>
                                    <td>
                                        <span>{{ $report_mcal->fldlcur }}</span>
                                    </td>
                                </tr>

                                <tr>
                                    <td>DIMENSIONS</td>
                                    <td>DECLARED</td>
                                    <td>OBSERVED</td>
                                </tr>
                                <tr>
                                    <td><b>Dia. of the Shaft</b>&nbsp;(mm)</td>
                                    <td><span>{{ $report_motor->flddshaft }}</span></td>
                                    <td><span>{{ $report_minp->fldodshaft }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Shaft Extension run out</b>&nbsp;(microns)</td>
                                    <td><span>{{ $report_motor->fldext }}</span></td>
                                    <td><span>{{ $report_minp->fldoext }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Spigot Dia.</b>&nbsp;(mm)</td>
                                    <td><span>{{ $report_motor->fldsdia }}</span></td>
                                    <td><span>{{ $report_minp->fldosdia }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Concentricity</b>&nbsp;(microns)</td>
                                    <td><span>{{ $report_motor->fldcon }}</span></td>
                                    <td><span>{{ $report_minp->fldocon }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Outside Dia.</b>&nbsp;(mm)</td>
                                    <td><span>{{ $report_motor->fldodia }}</span></td>
                                    <td><span>{{ $report_minp->fldoodia }}</span></td>
                                </tr>
                                <tr>
                                    <td><b>Perpendicularity</b>&nbsp;(microns)</td>
                                    <td><span>{{ $report_motor->fldper }}</span></td>
                                    <td><span>{{ $report_minp->fldoper }}</span></td>
                                </tr>

                                <tr>
                                    <td colspan="22" class="no-border-left no-border-right"></td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="no-border center"><b>Tested By</b></td>
                                    <td colspan="5" class="no-border center"><b>Checked By</b></td>
                                </tr>
                                <tr>
                                    <td colspan="22" class="no-border"></td>
                                </tr>
                                <tr>
                                    <td colspan="22" class="no-border"></td>
                                </tr>
                            </table>
                            {{-- </div> --}}
                        </div>
                    @endisset
                @endisset
            @endisset
        </div>
        @include('includes.bottom')
</body>

<script>
    $(document).ready(function() {

        @isset($report_minp)
            var url = "{{ URL::to('9283/entry/motor_entry/report/view_report/download/motorNo/motorType') }}";
            url = url.replace('motorNo', "{{ $report_minp->fldmno }}");
            url = url.replace('motorType', "{{ $report_minp->fldmtype }}");
            $('#btnDownload').attr("href", url);
            $('#btnDownload').attr("target", "blank");
        @endisset
    });
</script>

</html>
