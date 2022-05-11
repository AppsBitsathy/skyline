<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Routine Testing - Report</title>
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
            <h6>Routine Test Report For Self-Priming Pump As Per IS - 8034</h6>
            {{-- <h6>Period : </h6> --}}
            <a class="btn waves-effect btn-flat" href="{{ route('8034_entryRoutineTestingReportDownload') }}">Click
                here to download</a>
            <h6>Period: {{ explode(' ', $tableData[0]->fldfdate)[0] }} to
                {{ explode(' ', $tableData[0]->fldtdate)[0] }}</h6>
        </div>

        <div class="row left-align">
            @isset($tableData)
                <table class="centered white">
                    <tr>
                        <td class="no-border"><b>Pump Type</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldptype }}</span></td>
                        <td class="no-border"><b>HP/kW</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldhp }}</span></td>
                        <td class="no-border"><b>Phase</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldphase }}</span></td>
                        <td class="no-border"><b>Voltage</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldvolts }} <b>V</b></span>
                        </td>
                        <td class="no-border"><b>Head Range</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldheadr1 }} -
                                {{ $tableData[0]->fldheadr2 }}<b>m</b></span></td>
                    </tr>
                    <tr>
                        <td class="no-border"><b>Total Head</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldtheads }} <b>m</b></span>
                        </td>
                        <td class="no-border"><b>Discharge</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->flddiss }} <b>Lph</b></span>
                        </td>
                        <td class="no-border"><b>Max. Current</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldmcurrs }} <b>A</b></span>
                        </td>
                        <td class="no-border"><b>Efficiency</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldoeffs }} <b>%</b></span>
                        </td>
                        <td class="no-border"><b>Volume</b></td>
                        <td class="no-border"><span id="">{{ $tableData[0]->fldvols }} <b>ltrs</b></span>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>Inpass No.</b></td>
                        <td rowspan="2"><b>Pump No.</b></td>
                        <td rowspan="2"><b>Date</b></td>
                        <td rowspan="2"><b>Casing Pr. Test</b></td>
                        <td rowspan="2"><b>Impeller Balancing</b></td>
                        <td colspan="5"><b>Full Open Reading</b></td>
                        <td colspan="7"><b>Shut Off Reading</b></td>
                        <td colspan="4"><b>Performance At Rated Speed</b></td>
                    </tr>
                    <tr>
                        <td><b>Volts (V)</b></td>
                        <td><b>Current (A)</b></td>
                        <td><b>Power (kW)</b></td>
                        <td><b>Speed (rpm)</b></td>
                        <td><b>Frequency (Hz)</b></td>
                        <td><b>Current (A)</b></td>
                        <td><b>Power (kW)</b></td>
                        <td><b>Speed (rpm)</b></td>
                        <td><b>Frequency (Hz)</b></td>
                        <td><b>Suct. Head (m)</b></td>
                        <td><b>Dly. Head (m)</b></td>
                        <td><b>Total Head (m)</b></td>
                        <td><b>Discharge (lph)</b></td>
                        <td><b>Total Head (m)</b></td>
                        <td><b>Max. Curr (A)</b></td>
                        <td><b>Efficiency (&percnt;)</b></td>
                    </tr>

                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data->fldpno }}</td>
                            <td>{{ $data->fldsno }}</td>
                            <td>{{ explode(' ', $data->flddate)[0] }}</td>
                            <td>W</td>
                            <td>Done</td>
                            <td>{{ $data->fldvolts }}</td>
                            <td>{{ $data->fldcur }}</td>
                            <td>{{ $data->fldpow }}</td>
                            <td>{{ $data->fldspeed }}</td>
                            <td>{{ $data->fldfreq }}</td>
                            <td>{{ $data->fldcur1 }}</td>
                            <td>{{ $data->fldpow1 }}</td>
                            <td>{{ $data->fldspeed1 }}</td>
                            <td>{{ $data->fldfreq1 }}</td>
                            <td>{{ $data->fldshead }}</td>
                            <td>{{ $data->flddhead }}</td>
                            <td>{{ $data->fldthead }}</td>
                            <td>{{ $data->flddis }}</td>
                            <td>{{ $data->fldrthead }}</td>
                            <td>{{ $data->fldmcur }}</td>
                            <td>{{ $data->fldeff }}</td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="22" class="no-border-left no-border-right"></td>
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
            @endisset
        </div>
    </div>
    @include('includes.bottom')
</body>

</html>
