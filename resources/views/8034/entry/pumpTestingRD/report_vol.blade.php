<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Pump Testing RD - Volumetric - Report</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
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
            font-size: 12px;
            line-height: normal;
            padding: 8px;
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
            <h6>Submersible Pumpsets Performance Test As Per IS - 8034</h6>
            <a class="btn waves-effect btn-flat" href="{{ route('8034_entryPumpTestRDVolReportDownload') }}">Click
                here to download</a>
        </div>

        @isset($pumpData)
            <div class="row left-align">
                <table class="centered white">
                    <tr>
                        <td class="no-border"><b>Date</b></td>
                        <td class="no-border"><span id="dateht">{{ explode(' ', $pumpData->fldht)[0] }}</span></td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Pump No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpno }}</span></td>
                        <td class="no-border"><b>Inpass No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldipno }}</span></td>
                        <td class="no-border"><b>Pump Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldptype }}</span></td>
                        <td class="no-border"><b>Delivery Size</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddsize }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>Number of stages</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldstage }}</span></td>
                        <td class="no-border"><b>Min. Sub</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldsub }}</span>&nbsp;m</td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Phase</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldphase }}</span></td>
                        <td class="no-border"><b>HP / kW</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldhp }}/{{ $pumpData->fldkw }}</span></td>
                        <td class="no-border"><b>Voltage</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldvolts }}</span>&nbsp;V</td>
                        <td class="no-border"><b>Frequency</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldfreqs }}</span>&nbsp;Hz</td>
                        <td class="no-border"><b>Current</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmcurr }}</span>&nbsp;Amps</td>
                        <td class="no-border"><b>Bore size</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldbdia }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>Pump Dia</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddia }}</span>&nbsp;mm</td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Rated Speed</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldrspeed }}</span>&nbsp;rpm</td>
                        <td class="no-border"><b>Total Speed</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddthead }}</span>&nbsp;m</td>
                        <td class="no-border"><b>Discharge</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldddis }}</span>&nbsp;Lps</td>
                        <td class="no-border"><b>Efficiency</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddoeff }}</span>&nbsp;%</td>
                        <td class="no-border"><b>Head Range</b></td>
                        <td class="no-border">
                            <span>{{ $pumpData->fldheadr1 }}&nbsp;-&nbsp;{{ $pumpData->fldheadr2 }}</span>&nbsp;m
                        </td>
                        <td class="no-border"><b>Category</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldcat }}</span>&nbsp;lts</td>
                        <td class="no-border"><b>Motor Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmtype }}</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="no-border-left no-border-right"><b>Measurement of Discharge</b></td>
                        <td colspan="2" class="no-border-right"><span>Volumetric Method</span></td>
                        <td colspan="2" class="no-border-right"><b>Delivery Pressure</b></td>
                        <td colspan="2" class="no-border-right"><span>Pressure Gauge</span></td>
                        <td colspan="2" class="no-border-right"><b>Power</b></td>
                        <td colspan="2" class="no-border-right"><span>Watt meter</span></td>
                        <td colspan="2" class="no-border-right"><b>Speed</b></td>
                        <td colspan="2" class="no-border-right"><span>Split Speed meter</span></td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>Sl. No.</b></td>
                        <td rowspan="2"><b>Speed (rpm)</b></td>
                        <td colspan="5"><b>Head</b></td>
                        <td colspan="2"><b>Flow</b></td>
                        <td colspan="6"><b>POWER WMC = {{ $pumpData->fldwmc }} AMC = {{ $pumpData->fldamc }}</b></td>
                        <td colspan="5"><b>Calculation at Rated {{ $pumpData->fldcalc }}</b></td>
                    </tr>
                    <tr>
                        <td><b>Pr. Gauge Reading (Kg/cm&#178;)</b></td>
                        <td><b>Delivery Head (m)</b></td>
                        <td><b>Vel. Corr. Head (m)</b></td>
                        <td><b>Corr. Distance (m)</b></td>
                        <td><b>Total Head (m)</b></td>
                        <td><b>Time for {{ $pumpData->fldvol }} lts Collect. (secs)</b></td>
                        <td><b>Discharge (lph)</b></td>
                        <td><b>Voltage (V)</b></td>
                        <td><b>Current (A)</b></td>
                        <td><b>W1 (W)</b></td>
                        <td><b>W2 (W)</b></td>
                        <td><b>Input Power (kW)</b></td>
                        <td><b>Frequency (Hz)</b></td>
                        <td><b>Total Head (mwc)</b></td>
                        <td><b>Discharge (lph)</b></td>
                        <td><b>Input Power (kW)</b></td>
                        <td><b>Output Power (kW)</b></td>
                        <td><b>Overall Efficiency (&percnt;)</b></td>
                    </tr>
                    @isset($tableData)
                        @foreach ($tableData as $data)
                            <tr>
                                <td>{{ $data->fldread }}</td>
                                <td>{{ round($data->fldshead, 2) }}</td>
                                <td>{{ round($data->fldpguage, 2) }}</td>
                                <td>{{ round($data->flddhead, 2) }}</td>
                                <td>{{ round($data->fldvchead, 2) }}</td>
                                <td>{{ round($data->fldchead, 2) }}</td>
                                <td>{{ round($data->fldthead, 2) }}</td>
                                <td>{{ round($data->fldtime, 2) }}</td>
                                <td>{{ round($data->flddis, 2) }}</td>
                                <td>{{ round($data->fldvolt, 2) }}</td>
                                <td>{{ round($data->fldcurr, 2) }}</td>
                                <td>{{ round($data->fldw1, 2) }}</td>
                                <td>{{ round($data->fldw2, 2) }}</td>
                                <td>{{ round($data->fldip, 2) }}</td>
                                <td>{{ round($data->fldfreq, 2) }}</td>
                                <td>{{ round($data->fldrthead, 2) }}</td>
                                <td>{{ round($data->fldrdis, 2) }}</td>
                                <td>{{ round($data->fldrip, 2) }}</td>
                                <td>{{ round($data->fldpop, 2) }}</td>
                                <td>{{ round($data->fldoeff, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="20" class="no-border-left no-border-right"></td>
                        </tr>
                        <tr>
                            <td colspan="5" rowspan="2">Casting Test</td>
                            <td colspan="15">(1) 1.5 times shut off
                                pressure&nbsp;=&nbsp;<b>{{ round($pumpData->fldsp, 2) }}</b>&nbsp;Kg/cm&#178;</td>
                        </tr>
                        <tr>
                            <td colspan="15">(2) 2 times duty
                                pressure&nbsp;=&nbsp;<b>{{ round($pumpData->flddp, 2) }}</b>&nbsp;Kg/cm&#178;
                            </td>
                        </tr>
                        <tr>
                            <td colspan="20" class="no-border">Casting withstood a pressure
                                of&nbsp;&nbsp;&nbsp;<b>{{ round($pumpData->fldws, 2) }}</b>&nbsp;m
                                of water</td>
                        </tr>
                    @endisset
                    <tr>
                        <td colspan="10" class="no-border"><b>Tested By</b></td>
                        <td colspan="10" class="no-border"><b>Checked By</b></td>
                    </tr>
                    <tr>
                        <td colspan="20" class="no-border"></td>
                    </tr>
                    <tr>
                        <td colspan="20" class="no-border"></td>
                    </tr>
                </table>

            </div>
        @endisset
    </div>
    @include('includes.bottom')
</body>

</html>
