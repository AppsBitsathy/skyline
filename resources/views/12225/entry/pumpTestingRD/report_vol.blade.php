<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Pump Testing R & D - Volumetric - Report</title>
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
            <h6>CENTRIFUGAL JET PUMP PERFORMANCE TEST AS PER IS - 12225</h6>
            <a class="btn waves-effect btn-flat" href="{{ route('12225_entryPumpTestRDVolReportDownload') }}">Click
                here to download</a>
        </div>

        @isset($pumpData)
            <div class="row left-align">
                <table class="centered white">
                    <tr>
                        <td class="no-border"><b>Date</b></td>
                        <td class="no-border"><span id="dateht">{{ explode(' ', $pumpData->flddate)[0] }}</span></td>
                        <td class="no-border"><b>Pump No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpmno }}</span></td>
                        <td class="no-border"><b>Inpass No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldipno }}</span></td>
                        <td class="no-border"><b>Pump Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldptype }}</span></td>
                        <td class="no-border"><b>Suction Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddsize }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>Delivery Size</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddisize }}</span>&nbsp;mm</td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Pressure Size</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpsize }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>HP / kW</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldhpkw }}</span></td>
                        <td class="no-border"><b>Frequency</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddfreq }}</span>&nbsp;Hz</td>
                        <td class="no-border"><b>Current</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmcurr }}</span>&nbsp;Amps</td>
                        <td class="no-border"><b>Submergence</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldsub }}</span>&nbsp;m</td>
                        <td class="no-border"><b>Min. Operating Pr.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmop }}</span>&nbsp;kg/cm&#178;</td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Rated Speed</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldrspeed }}</span>&nbsp;rpm</td>
                        <td class="no-border"><b>Discharge</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddis }}</span>&nbsp;Lps</td>
                        <td class="no-border"><b>Total Head</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddthead }}</span>&nbsp;m</td>
                        <td class="no-border"><b>DLWL</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldddlwl }}</span>&nbsp;m</td>
                        <td class="no-border"><b>Power Input</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpi }}</span>&nbsp;kW</td>
                        <td class="no-border"><b>DLWL Range</b></td>
                        <td class="no-border">
                            <span>{{ $pumpData->flddlwl1 }}&nbsp;-&nbsp;{{ $pumpData->flddlwl2 }}</span>&nbsp;m
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="no-border-left no-border-right"><b>Measurement of Discharge</b></td>
                        <td colspan="2" class="no-border-right"><span>Volumetric Method</span></td>
                        <td colspan="2" class="no-border-right"><b>Delivery Pressure</b></td>
                        <td colspan="2" class="no-border-right"><span>Pressure Gauge</span></td>
                        <td colspan="2" class="no-border-right"><b>Suction Pressure</b></td>
                        <td colspan="2" class="no-border-right"><span>Pressure Gauge</span></td>
                        <td colspan="2" class="no-border-right"><b>Speed</b></td>
                        <td colspan="2" class="no-border-right"><span>Techometer</span></td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>Sl. No.</b></td>
                        <td rowspan="2"><b>Speed (rpm)</b></td>
                        <td colspan="3"><b>DLWL in MWC</b></td>
                        <td colspan="4"><b>TOTAL HEAD in MWC</b></td>
                        <td colspan="2"><b>DISCHARGE</b></td>
                        <td colspan="3"><b>POWER WMC = {{ $pumpData->fldwmc }} AMC = {{ $pumpData->fldamc }}</b></td>
                        <td colspan="5"><b>Calculation at Rated {{ $pumpData->fldcalc }}</b></td>
                    </tr>
                    <tr>
                        <td><b>Ejec. Head (G1)</b></td>
                        <td><b>Corr. Head (Z)</b></td>
                        <td><b>DLWL = (G1+Z+6)</b></td>
                        <td><b>Press. Gauge Reading (Kg/cm&#178;)</b></td>
                        <td><b>Delivery Head (G2)</b></td>
                        <td><b>Corr. Head (Z)</b></td>
                        <td><b>Total Head (G2+Z)</b></td>
                        <td><b>Time for {{ $pumpData->fldvol }} lts Collect. (secs)</b></td>
                        <td><b>Actual Discharge (lph)</b></td>
                        <td><b>Voltage (V)</b></td>
                        <td><b>Current (A)</b></td>
                        <td><b>Watts (W)</b></td>
                        <td><b>Frequency (Hz)</b></td>
                        <td><b>DLWL (mwc)</b></td>
                        <td><b>Total Head (mwc)</b></td>
                        <td><b>Discharge (lph)</b></td>
                        <td><b>Input Power (kW)</b></td>
                    </tr>
                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data->fldread }}</td>
                            <td>{{ round($data->fldspd, 2) }}</td>
                            <td>{{ round($data->fldehead, 2) }}</td>
                            <td>{{ round($data->fldchead, 2) }}</td>
                            <td>{{ round($data->flddlwl, 2) }}</td>
                            <td>{{ round($data->fldprgread, 2) }}</td>
                            <td>{{ round($data->flddhead, 2) }}</td>
                            <td>{{ round($data->fldchead, 2) }}</td>
                            <td>{{ round($data->fldthead, 2) }}</td>
                            <td>{{ round($data->fldtime, 2) }}</td>
                            <td>{{ round($data->fldadis, 2) }}</td>
                            <td>{{ round($data->fldvolt, 2) }}</td>
                            <td>{{ round($data->fldcurr, 2) }}</td>
                            <td>{{ round($data->fldwatts, 2) }}</td>
                            <td>{{ round($data->fldfreq, 2) }}</td>
                            <td>{{ round($data->fldrdlwl, 2) }}</td>
                            <td>{{ round($data->fldrthead, 2) }}</td>
                            <td>{{ round($data->fldrdis, 2) }}</td>
                            <td>{{ round($data->fldipow, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="22" class="no-border-left no-border-right"></td>
                    </tr>
                    <tr>
                        <td colspan="22" class="no-border-left no-border-right"><b>Note : DLWL - Depth to Low Water
                                Level</b></td>
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
        @endisset
    </div>
    @include('includes.bottom')
</body>

</html>
