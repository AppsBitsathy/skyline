<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Pump Testing R & D - Pump Report</title>
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

        table td.no-border-top {
            border-top: #ffffff;
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
            <h6>Observed Values Report for Modified Duty Point</h6>
            <a class="btn waves-effect btn-flat" href="{{ route('8472_entryPumpTestRDVolGraphReportDownload') }}">Click
                here to download</a>
        </div>
        @isset($pumpData)
            <div class="row left-align">
                <table class="centered white">
                    <tr>
                        <td class="no-border"><b>Pump No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldpno }}</span></td>
                        <td class="no-border"><b>Inpass No.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldipno }}</span></td>
                        <td class="no-border"><b>Pump Type</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldptype }}</span></td>
                        <td class="no-border"><b>H. P. / K. W.</b></td>
                        <td class="no-border"><span>{{ $pumpData->fldhp }}</span></td>
                    </tr>
                    <tr>
                        <td class="no-border-left no-border-right"><b>Pipe Size</b></td>
                        <td class="no-border-left no-border-right"><span>{{ $pumpData->fldssize }}</span>&nbsp;m</td>
                        <td class="no-border-left no-border-right"><b>Voltage</b></td>
                        <td class="no-border-left no-border-right"><span>{{ $pumpData->fldvolt }}</span>&nbsp;V</td>
                        <td class="no-border-left no-border-right"><b>Frequency</b></td>
                        <td class="no-border-left no-border-right"><span>{{ $pumpData->fldfreq }}</span>&nbsp;Hz</td>
                        <td class="no-border-left no-border-right"><b>Head Range</b></td>
                        <td class="no-border-left no-border-right"><span>{{ $pumpData->fldheadr }}</span>&nbsp;m</td>
                    </tr>
                    <tr>
                        <td rowspan="2"><b>Sl. No.</b></td>
                        <td colspan="2"><b>Rated</b></td>
                        <td rowspan="2"><b>Input Power (k.W.)</b></td>
                        <td rowspan="2"><b>Current (A)</b></td>
                        {{-- <td rowspan="2" class="no-border-bottom no-border-right no-border-top"></td> --}}
                    </tr>
                    <tr>
                        <td><b>Dis (Lph)</b></td>
                        <td><b>Total Head (m)</b></td>
                    </tr>
                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data['fldread'] }}</td>
                            <td>{{ round($data['fldrq'], 2) }}</td>
                            <td>{{ round($data['fldrth'], 2) }}</td>
                            <td>{{ round($data['fldroae'], 2) }}</td>
                            <td>{{ $data['fldri'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="2" class="no-border-left no-border-right"></td>
                    </tr>
                    <tr>
                        <td class="no-border-left"></td>
                        <td rowspan=""><b>Declared</b></td>
                        <td rowspan=""><b>Observed</b></td>
                    </tr>
                    <tr>
                        <td><b>Discharge Q in Lph</b></td>
                        <td>{{ $data['flddq'] }}</td>
                        <td>{{ $data['fldoq'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Total Head TH in M</b></td>
                        <td>{{ $data['flddth'] }}</td>
                        <td>{{ $data['fldoth'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Input Power in k.W.</b></td>
                        <td>{{ $data['flddoae'] }}</td>
                        <td>{{ $data['fldooae'] }}</td>
                    </tr>
                    <tr>
                        <td><b>Current in A</b></td>
                        <td>{{ $data['flddi'] }}</td>
                        <td>{{ $data['fldoi'] }}</td>
                    </tr>
                </table>

            </div>
        @endisset
    </div>
    @include('includes.bottom')
</body>

</html>
