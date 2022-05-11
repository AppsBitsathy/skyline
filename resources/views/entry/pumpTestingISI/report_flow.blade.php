<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Pump Testing ISI - Flowmetric - Report</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/images/favicon.ico') }}">
    @include('includes.top')
    <style>
        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
        }

        table td {
            border: 2px solid rgba(0, 0, 0, 0.12);
            /* background-color: #0000ff66; */
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
    <div class="center-align">
        <div class="pb-1">
            <h4>Skyline Softwares, Coimbatore - 15.</h4>
            <h6>Monoblock Pump Performance Test As Per IS - 9079</h6>
            <a class="btn waves-effect btn-flat" href="{{ route('entryPumpTestISIVolReportDownload') }}">Click here to
                download</a>
        </div>
        {{-- {{ $pumpData }} --}}
        <div class="row left-align">
            <table class="centered white">
                <tr>
                    <td colspan="2" class="no-border"><b>Date</b></td>
                    <td colspan="2" class="no-border"><span id="dateht">{{ $pumpData->fldht }}</span></td>
                </tr>
                <tr>
                    <td colspan="2" class="no-border"><b>Pump No.</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldpno }}</span></td>
                    <td colspan="2" class="no-border"><b>Inpass No.</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldIpNo }}</span></td>
                    <td colspan="2" class="no-border"><b>Pump Type</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldPType }}</span></td>
                    <td colspan="2" class="no-border"><b>Suction Type</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldSsize }}</span>&nbsp;mm</td>
                    <td colspan="2" class="no-border"><b>Delivery Size</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldDsize }}</span>&nbsp;mm</td>
                </tr>
                <tr>
                    <td colspan="2" class="no-border"><b>Phase</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldPhase }}</span></td>
                    <td colspan="2" class="no-border"><b>HP / kW</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldhp }}</span></td>
                    <td colspan="2" class="no-border"><b>Voltage</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldVolt }}</span>&nbsp;Volts</td>
                    <td colspan="2" class="no-border"><b>Frequency</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldDFreq }}</span>&nbsp;Hz</td>
                    <td colspan="2" class="no-border"><b>Current</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldMCurr }}</span>&nbsp;Amps</td>
                </tr>
                <tr>
                    <td colspan="2" class="no-border"><b>Rated Speed</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldRSpeed }}</span>&nbsp;rpm</td>
                    <td colspan="2" class="no-border"><b>Total Head</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldDTHead }}</span>&nbsp;m</td>
                    <td colspan="2" class="no-border"><b>Discharge</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldDDis }}</span>&nbsp;Lps</td>
                    <td colspan="2" class="no-border"><b>Efficiency</b></td>
                    <td colspan="2" class="no-border"><span>{{ $pumpData->fldDOeff }}</span>&nbsp;&#37;</td>
                    <td colspan="2" class="no-border"><b>Head Range</b></td>
                    <td colspan="2" class="no-border">
                        <span>{{ $pumpData->fldHeadr1 }}&nbsp;-&nbsp;{{ $pumpData->fldHeadr2 }}</span>&nbsp;m
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="no-border-left no-border-right"><b>Measurement of Discharge</b></td>
                    <td colspan="2" class="no-border-right"><span>Flow Meter Method</span></td>
                    <td colspan="2" class="no-border-right"><b>Delivery Pressure</b></td>
                    <td colspan="2" class="no-border-right"><span>Pressure Gauge</span></td>
                    <td colspan="2" class="no-border-right"><b>Suction Pressure</b></td>
                    <td colspan="2" class="no-border-right"><span>Vaccum Gauge</span></td>
                    <td colspan="2" class="no-border-right"><b>Speed</b></td>
                    <td colspan="2" class="no-border-right"><span>Techometer</span></td>
                </tr>
                <tr>
                    <td rowspan="2"><b>Sl. No.</b></td>
                    <td rowspan="2"><b>Speed (rpm)</b></td>
                    <td colspan="7"><b>HEAD</b></td>
                    <td colspan="2"><b>FLOW</b></td>
                    <td colspan="5"><b>POWER WMC = {{ $pumpData->fldwmc }} AMC = {{ $pumpData->fldamc }}</b></td>
                    <td rowspan="2"><b>Frequency (Hz)</b></td>
                    <td colspan="5"><b>Calculation at Rated {{ $pumpData->fldCalc }}</b></td>
                </tr>
                <tr>
                    <td><b>Vac. Gauge Read. (mmHg)</b></td>
                    <td><b>Suct. Head (m)</b></td>
                    <td><b>Pr. Gauge Read. (Kg/cm&#178;)</b></td>
                    <td><b>Dly. Head (m)</b></td>
                    <td><b>Vel. Cor. Head (m)</b></td>
                    <td><b>Gauge Distance (m)</b></td>
                    <td><b>Total Head (m)</b></td>
                    <td><b>Time for {{ $pumpData->fldVol }} lts Collect. (secs)</b></td>
                    <td><b>Discharge (Lps)</b></td>
                    <td><b>Voltage (V)</b></td>
                    <td><b>Current (A)</b></td>
                    <td><b>W1 (W)</b></td>
                    <td><b>W2 (W)</b></td>
                    <td><b>Input Power (kW)</b></td>
                    <td><b>Total Head (m)</b></td>
                    <td><b>Discharge (Lps)</b></td>
                    <td><b>Input Power (kW)</b></td>
                    <td><b>Output Power (kW)</b></td>
                    <td><b>Over-all Eff. (&#37;)</b></td>
                </tr>
                @foreach ($tableData as $data)
                    <tr>
                        <td>{{ $data->fldRead }}</td>
                        <td>{{ $data->fldSpeed }}</td>
                        <td>{{ $data->fldVGauge }}</td>
                        <td>{{ round($data->fldSHead, 2) }}</td>
                        <td>{{ round($data->fldPGauge, 2) }}</td>
                        <td>{{ round($data->fldDHead, 2) }}</td>
                        <td>{{ round($data->fldVCHead, 2) }}</td>
                        <td>{{ round($data->fldGDist, 2) }}</td>
                        <td>{{ round($data->fldTHead, 2) }}</td>
                        <td>{{ round($data->fldTime, 2) }}</td>
                        <td>{{ round($data->fldDis, 2) }}</td>
                        <td>{{ round($data->fldVolt, 2) }}</td>
                        <td>{{ round($data->fldCurr, 2) }}</td>
                        <td>{{ round($data->fldw1, 2) }}</td>
                        <td>{{ round($data->fldw2, 2) }}</td>
                        <td>{{ round($data->fldIp, 2) }}</td>
                        <td>{{ round($data->fldFreq, 2) }}</td>
                        <td>{{ round($data->fldRTHead, 2) }}</td>
                        <td>{{ round($data->fldRDis, 2) }}</td>
                        <td>{{ round($data->fldRIp, 2) }}</td>
                        <td>{{ round($data->fldPop, 2) }}</td>
                        <td>{{ round($data->fldOeff, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="22" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="7" rowspan="2">Casting Test</td>
                    <td colspan="15">(1) 1.5 times shut off
                        pressure&nbsp;=&nbsp;<b>{{ round($pumpData->fld1_5, 2) }}</b>&nbsp;Kg/cm&#178;</td>
                </tr>
                <tr>
                    <td colspan="15">(2) 2 times duty
                        pressure&nbsp;=&nbsp;<b>{{ round($pumpData->fld2, 2) }}</b>&nbsp;Kg/cm&#178;
                    </td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border">Casting withstood a pressure
                        of&nbsp;&nbsp;&nbsp;<b>{{ round($pumpData->fld2m, 2) }}</b>&nbsp;m
                        of water</td>
                </tr>
                <tr>
                    <td colspan="11" class="no-border"><b>Tested By</b></td>
                    <td colspan="11" class="no-border"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
                </tr>
            </table>

        </div>

        {{-- <div class="col s12 pb-5">
            <div class="col s6">
                <span>Casing Test: </span>
            </div>
            <div class="col s6 left-align">
                <span>1. 1.5 times shutoff pressure = 3.02 Kg/cm&#178; </span>
            </div>
            <div class="col s6 offset-s6 left-align">
                <span>2. 2.0 times shutoff pressure = 3.20 Kg/cm&#178; </span>
            </div>
            <div class="col s6 pt-2">
                <span>Casing withstood a pressure of </span>
            </div>
            <div class="col s6 left-align pt-2">
                <span>30.20 m of water </span>
            </div>
        </div>
        <div class="col s12">
            <div class="col s6">
                <span><b>Tested By</b></span>
            </div>
            <div class="col s6">
                <span><b>Checked By</b></span>
            </div>
        </div> --}}
    </div>
    @include('includes.bottom')
</body>

</html>
