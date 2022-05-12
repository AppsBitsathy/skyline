<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Pump Testing ISI - Volumetric - Report</title>
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
            <h6>CENTRIFUGAL PUMP PERFORMANCE TEST AS PER IS - 6595</h6>
            <a class="btn waves-effect btn-flat" href="{{ route('6595_entryPumpTestISIVolReportDownload') }}">Click
                here to download</a>
        </div>

        @isset($pumpData)
            <div class="row left-align">
                <table class="centered white">
                    <tr>
                        <td class="no-border"><b>Date</b></td>
                        <td class="no-border"><span id="dateht">{{ explode(' ', $pumpData->fldht)[0] }}</span></td>
                        <td class="no-border"><b>Pump No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpno }}</span></td>
                        <td class="no-border"><b>Inpass No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldipno }}</span></td>
                        <td class="no-border"><b>Pump Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldptype }}</span></td>
                        <td class="no-border"><b>Suction Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldssize }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>Delivery Size</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddsize }}</span>&nbsp;mm</td>
                        <td class="no-border"><b>Impellar Dia</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddia }}</span>&nbsp;mm</td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Motor Eff. Ref.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmno }}</span></td>
                        <td class="no-border"><b>Phase</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldphase }}</span></td>
                        <td class="no-border"><b>HP / kW</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldhp }}</span></td>
                        <td class="no-border"><b>Voltage</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldvolt }}</span>&nbsp;V</td>
                        <td class="no-border"><b>Frequency</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddfreq }}</span>&nbsp;Hz</td>
                        <td class="no-border"><b>Input Power</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldmcurr }}</span>&nbsp;Amps</td>
                        <td class="no-border"><b>Ammeter</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldamc }}</span></td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Motor Make</b></td>
                        <td class="no-border"><span>{{ __('MAHEE') }}</span></td>
                        <td class="no-border"><b>Rated Speed</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldrspeed }}</span>&nbsp;rpm</td>
                        <td class="no-border"><b>Total Speed</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddthead }}</span>&nbsp;m</td>
                        <td class="no-border"><b>Discharge</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldddis }}</span>&nbsp;Lps</td>
                        <td class="no-border"><b>Pump Efficiency</b></td>
                        <td class="no-border"><span>{{ $pumpData->flddoeff }}</span>&nbsp;&percnt;</td>
                        <td class="no-border"><b>Head Range</b></td>
                        <td class="no-border">
                            <span>{{ $pumpData->fldheadr1 }}&nbsp;-&nbsp;{{ $pumpData->fldheadr2 }}</span>&nbsp;m
                        </td>
                        <td class="no-border"><b>Watt Meter</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldwmc }}</span></td>
                    </tr>
                    <tr>
                        <td class="no-border-left no-border-right"><b>Connection</b></td>
                        <td class="no-border-right"><span>{{ $pumpData->fldcon }}</span></td>
                        <td class="no-border-right"><b>Measurement of Discharge</b></td>
                        <td class="no-border-right"><span>Volumetric</span></td>
                        <td class="no-border-right"><b>Suction Pressure</b></td>
                        <td class="no-border-right"><span>Vaccum Gauge</span></td>
                        <td class="no-border-right"><b>Delivery Pressure</b></td>
                        <td class="no-border-right"><span>Pressure Gauge</span></td>
                        <td class="no-border-right"><b>Speed</b></td>
                        <td class="no-border-right"><span>Techometer</span></td>
                        <td class="no-border-right"><b>Power</b></td>
                        <td class="no-border-right"><span>Watt Meter</span></td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>Sl. No.</b></td>
                        <td rowspan="2"><b>Speed (rpm)</b></td>
                        <td colspan="5"><b>Head</b></td>
                        <td colspan="2"><b>Flow</b></td>
                        <td colspan="6"><b>POWER</b></td>
                        <td colspan="5"><b>At Rated of speed {{ $pumpData->fldrspeed }}</b></td>
                        <td rowspan="2"><b>Re-Marks</b></td>
                    </tr>
                    <tr>
                        <td><b>Suction Head (m)</b></td>
                        <td><b>Delivery Head (m)</b></td>
                        <td><b>Vel. Corr. Head (m)</b></td>
                        <td><b>Gauge Distance (m)</b></td>
                        <td><b>Total Head (m)</b></td>
                        <td><b>Time for {{ $pumpData->fldvol }} lts Collect. (secs)</b></td>
                        <td><b>Discharge (lps)</b></td>
                        <td><b>Voltage (V)</b></td>
                        <td><b>Current (A)</b></td>
                        <td><b>W1 (W)</b></td>
                        <td><b>W2 (W)</b></td>
                        <td><b>Motor Input (kW)</b></td>
                        <td><b>Pump Input (kW)</b></td>
                        <td><b>Total Head (m)</b></td>
                        <td><b>Discharge (lps)</b></td>
                        <td><b>Pump Input (kW)</b></td>
                        <td><b>Pump Output (kW)</b></td>
                        <td><b>Pump Eff. (&percnt;)</b></td>
                    </tr>
                    @isset($tableData)
                        @foreach ($tableData as $data)
                            <tr>
                                <td>{{ $data->fldread }}</td>
                                <td>{{ round($data->fldspeed, 2) }}</td>
                                <td>{{ round($data->fldshead, 2) }}</td>
                                <td>{{ round($data->flddhead, 2) }}</td>
                                <td>{{ round($data->fldvchead, 2) }}</td>
                                <td>{{ round($data->fldgdist, 2) }}</td>
                                <td>{{ round($data->fldthead, 2) }}</td>
                                <td>{{ round($data->fldtime, 2) }}</td>
                                <td>{{ round($data->flddis, 2) }}</td>
                                <td>{{ round($data->fldvolt, 2) }}</td>
                                <td>{{ round($data->fldcurr, 2) }}</td>
                                <td>{{ round($data->fldw1, 2) }}</td>
                                <td>{{ round($data->fldw2, 2) }}</td>
                                <td>{{ round($data->fldop, 2) }}</td>
                                <td>{{ round($data->fldip, 2) }}</td>
                                <td>{{ round($data->fldrthead, 2) }}</td>
                                <td>{{ round($data->fldrdis, 2) }}</td>
                                <td>{{ round($data->fldrip, 2) }}</td>
                                <td>{{ round($data->fldpop, 2) }}</td>
                                <td>{{ round($data->fldoeff, 2) }}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="21" class="no-border-left no-border-right"></td>
                        </tr>
                        <tr>
                            <td colspan="6">Casing Test</td>
                            <td colspan="15">(1) 1.5 times shut off
                                pressure&nbsp;=&nbsp;<b>{{ round($pumpData->fld1_5, 2) }}</b>&nbsp;Kg/cm&#178;</td>
                        </tr>
                        {{-- <tr>
                            <td colspan="15">(2) 2 times duty
                                pressure&nbsp;=&nbsp;<b>{{ round($pumpData->fld2, 2) }}</b>&nbsp;Kg/cm&#178;
                            </td>
                        </tr> --}}
                        <tr>
                            <td colspan="21" class="no-border">Casing withstood a pressure
                                of&nbsp;&nbsp;&nbsp;<b>{{ round($pumpData->fld2m, 2) }}</b>&nbsp;m
                                of water</td>
                        </tr>
                    @endisset
                    <tr>
                        <td colspan="10" class="no-border"><b>Tested By</b></td>
                        <td colspan="10" class="no-border"><b>Checked By</b></td>
                    </tr>
                    <tr>
                        <td colspan="21" class="no-border"></td>
                    </tr>
                    <tr>
                        <td colspan="21" class="no-border"></td>
                    </tr>
                </table>

            </div>
        @endisset
    </div>
    @include('includes.bottom')
</body>

</html>
