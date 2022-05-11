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
            <h6>Routine Test Report For Self-Priming Pump As Per IS - 8472</h6>
            {{-- <h6>Period : </h6> --}}
            @isset($report_motor)
                @isset($fdate)
                    @isset($tdate)
                        <form action="{{ route('9283_entryMotorTestingCustomReportDownload') }}" method="post">
                            @csrf
                            <input type="hidden" name="motortype" value="{{ $report_motor->fldsno }}">
                            <input type="hidden" name="startDate" value="{{ $fdate }}">
                            <input type="hidden" name="toDate" value="{{ $tdate }}">
                            <input class="btn waves-effect btn-flat" type="submit" value="Click here to download">
                        </form>
                        <h6>Period: {{ $fdate }} to {{ $tdate }}</h6>
                    @endisset
                @endisset
            @endisset
        </div>

        <div class="row left-align">
            @isset($report_motor)
                @isset($report_minp)
                    @isset($report_mcal)
                        <table class="centered white">
                            <tr>
                                <td colspan="2"><b>Motor Type</b></td>
                                <td colspan="2"><span>{{ $report_motor->fldmtype }}</span></td>
                            </tr>
                            <tr>
                                <td rowspan="2"><b>Date</b></td>
                                <td rowspan="2"><b>Motor No.</b></td>
                                <td rowspan="2"><b>H. P.</b></td>
                                <td colspan="3"><b>Insulation Test meg ohm</b></td>
                                <td colspan="5"><b>No Load Test</b></td>
                                <td colspan="2"><b>Reduces Voltage Test at 240 V</b></td>
                                <td colspan="2"><b>Shaft Extension</b></td>
                                <td rowspan="2"><b>Res. Room Temperature</b></td>
                            </tr>
                            <tr>
                                <td><b>Before H.V.</b></td>
                                <td><b>H.V Test 1.5 KV</b></td>
                                <td><b>After H.V.</b></td>
                                <td><b>Frequency</b></td>
                                <td><b>Volts</b></td>
                                <td><b>Amps</b></td>
                                <td><b>Watts</b></td>
                                <td><b>Speed</b></td>
                                <td><b>Speed Clockwise</b></td>
                                <td><b>Speed Anti-Clockwise</b></td>
                                <td><b>Concent</b></td>
                                <td><b>Run out</b></td>
                            </tr>

                            @php
                                $i = 0;
                            @endphp
                            @foreach ($report_minp as $data)
                                <tr>
                                    <td>{{ $data->flddate }}</td>
                                    <td>{{ $data->fldmno }}</td>
                                    <td>{{ $report_motor->fldhp }}</td>
                                    <td>{{ $data->fldbhv }}</td>
                                    <td>{{ $data->fldhv }}</td>
                                    <td>{{ $data->fldahv }}</td>
                                    <td>{{ $data->fldnlfreq }}</td>
                                    <td>{{ $data->fldnlv }}</td>
                                    <td>{{ $data->fldnla }}</td>
                                    <td>{{ $report_mcal[$i]->fldnltp }}</td>
                                    <td>{{ $data->fldnlspeed }}</td>
                                    <td>{{ $data->fldspeedclk }}</td>
                                    <td>{{ $data->fldspeedaclk }}</td>
                                    <td>{{ $data->fldocon }}</td>
                                    <td>{{ $data->fldoext }}</td>
                                    <td>{{ $data->flditemp }}</td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
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
                @endisset
            @endisset
        </div>
    </div>
    @include('includes.bottom')
</body>

</html>
