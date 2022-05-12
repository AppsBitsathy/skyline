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
            <a class="btn waves-effect btn-flat" href="{{ route('entryPumpTestRDFlowGraphReportDownload') }}">Click
                here to
                download</a>
        </div>
        {{-- {{ $pumpData }} --}}
        <div class="row left-align">
            <table class="centered white">
                <tr>
                    <td class="no-border"><b>Pump No.</b></td>
                    <td class="no-border"><span>{{ $pumpData->fldPno }}</span></td>
                    <td class="no-border"><b>Inpass No.</b></td>
                    <td class="no-border"><span>{{ $pumpData->fldIpNo }}</span></td>
                    <td class="no-border"><b>Pump Type</b></td>
                    <td class="no-border"><span>{{ $pumpData->fldPtype }}</span></td>
                    <td class="no-border"><b>H. P. / K. W.</b></td>
                    <td class="no-border"><span>{{ $pumpData->fldHp }}</span></td>
                </tr>
                <tr>
                    <td class="no-border-left no-border-right"><b>Pipe Size</b></td>
                    <td class="no-border-left no-border-right"><span>{{ $pumpData->fldSsize }}</span>&nbsp;m</td>
                    <td class="no-border-left no-border-right"><b>Voltage</b></td>
                    <td class="no-border-left no-border-right"><span>{{ $pumpData->fldVolt }}</span>&nbsp;V</td>
                    <td class="no-border-left no-border-right"><b>Frequency</b></td>
                    <td class="no-border-left no-border-right"><span>{{ $pumpData->fldFreq }}</span>&nbsp;Hz</td>
                    <td class="no-border-left no-border-right"><b>Head Range</b></td>
                    <td class="no-border-left no-border-right"><span>{{ $pumpData->fldHeadr }}</span>&nbsp;m</td>
                </tr>
                <tr>
                    <td rowspan="2"><b>Sl. No.</b></td>
                    <td colspan="2"><b>Rated</b></td>
                    <td rowspan="2" colspan="2"><b>Over-all Efficiency (&#37;)</b></td>
                    <td rowspan="2" colspan="2"><b>Current (A)</b></td>
                    {{-- <td rowspan="2" class="no-border-bottom no-border-right no-border-top"></td> --}}
                </tr>
                <tr>
                    <td><b>Dis (Lps)</b></td>
                    <td><b>Total Head (m)</b></td>
                </tr>
                @foreach ($tableData as $data)
                    <tr>
                        <td>{{ $data['fldRead'] }}</td>
                        <td>{{ $data['fldRq'] }}</td>
                        <td>{{ round($data['fldRth'], 2) }}</td>
                        <td colspan="2">{{ round($data['fldRoae'], 2) }}</td>
                        <td colspan="2">{{ $data['fldRi'] }}</td>
                        {{-- <td class="no-border-right no-border-bottom"></td> --}}
                        {{-- <td>{{ round($data->fldPGauge, 2) }}</td> --}}
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
                    <td><b>Discharge Q in Lps</b></td>
                    <td>{{ $data['fldDq'] }}</td>
                    <td>{{ $data['fldOq'] }}</td>
                </tr>
                <tr>
                    <td><b>Total Head TH in M</b></td>
                    <td>{{ $data['fldDth'] }}</td>
                    <td>{{ $data['fldOth'] }}</td>
                </tr>
                <tr>
                    <td><b>Over-all Efficiency in &#37;</b></td>
                    <td>{{ $data['fldDoae'] }}</td>
                    <td>{{ $data['fldOoae'] }}</td>
                </tr>
                <tr>
                    <td><b>Current in A</b></td>
                    <td>{{ $data['fldDi'] }}</td>
                    <td>{{ $data['fldOi'] }}</td>
                </tr>
            </table>

        </div>
    </div>
    @include('includes.bottom')
</body>

</html>
