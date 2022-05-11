<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report - Observed Values Report</title>
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
            <h6>Performance Analysing System For Pump Results for Observed Values</h6>
            @isset($startDate)
                @isset($toDate)
                    <h6>Period : {{ $startDate }} to {{ $toDate }} </h6>
                @endisset
            @endisset
            <form action="{{ route('reportPumpObservedFetchDownload') }}" method="post">
                @csrf
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="toDate" id="toDate">
                <input type="hidden" name="pumpType" id="pumpType">
                <button class="btn waves-effect btn-flat">Click here to download</button>
            </form>
        </div>

        <div class="row left-align">
            <table class="centered white">
                @isset($pump)
                    <tr>
                        <td><b>HP / kW</b></td>
                        <td><span>{{ $pump->fldhp }}</span></td>
                        <td><b>Phase</b></td>
                        <td><span>{{ $pump->fldPhase }}</span></td>
                        <td><b>Voltage</b></td>
                        <td><span>{{ $pump->fldVolt }}</span>&nbsp;Volts</td>
                        <td><b>Suction Type</b></td>
                        <td><span>{{ $pump->fldSsize }}</span>&nbsp;mm</td>
                        <td><b>Delivery Size</b></td>
                        <td><span>{{ $pump->fldDsize }}</span>&nbsp;mm</td>
                        <td><b>Pump Type</b></td>
                        <td><span>{{ $pump->fldPtype }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Room Temperature</b></td>
                        <td><span>{{ $pump->fldRtemp }}</span>&deg;C</td>
                        <td><b>Total Head</b></td>
                        <td><span>{{ $pump->fldThead }}</span>&nbsp;m</td>
                        <td><b>Discharge</b></td>
                        <td><span>{{ $pump->flddis }}</span>&nbsp;Lps</td>
                        <td><b>Overall Efficiency</b></td>
                        <td><span>{{ $pump->fldoeff }}</span>%</td>
                        <td><b>Max. Current</b></td>
                        <td><span>{{ $pump->fldMcurr }}</span>&nbsp;A</td>
                        <td><b>Head Range</b></td>
                        <td><span>{{ $pump->fldHeadr1 }} to {{ $pump->fldHeadr2 }}</span>&nbsp;m</td>
                    </tr>
                @endisset
                <tr>
                    <td colspan="2"><b>Pump No</b></td>
                    <td colspan="2"><b>Date</b></td>
                    <td colspan="2"><b>Discharge (Lps)</b></td>
                    <td colspan="2"><b>Total Head (m)</b></td>
                    <td colspan="2"><b>Overall Efficiency (&percnt;)</b></td>
                    <td colspan="2"><b>Current (A)</b></td>
                </tr>

                @isset($dataList)
                    {{-- {{ json_encode($observed_list) }} --}}
                    @foreach ($dataList as $data)
                        <tr>
                            <td colspan="2">{{ $data->fldpno }}</td>
                            <td colspan="2">{{ explode(' ', $data->flddate)[0] }}</td>
                            <td colspan="2">{{ $data->flddis }}</td>
                            <td colspan="2">{{ $data->fldthead }}</td>
                            <td colspan="2">{{ $data->fldoeff }}</td>
                            <td colspan="2">{{ $data->fldcurr }}</td>
                        </tr>
                    @endforeach
                @endisset

                <tr>
                    <td colspan="20" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="7"><b>Tested By</b></td>
                    <td colspan="7"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="22"></td>
                </tr>
                <tr>
                    <td colspan="22"></td>
                </tr>
            </table>
        </div>
    </div>
    @include('includes.bottom')
</body>

<script type="text/javascript">
    $(document).ready(function() {
        @if (session('status'))
            M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            console.log('{{ session('status') }}');
        @endif

        @isset($startDate)
            @isset($toDate)
                @isset($pump)
                    $('#startDate').val('{{ $startDate }}');
                    $('#toDate').val('{{ $toDate }}');
                    $('#pumpType').val('{{ $pump->fldsno }}');
                @endisset
            @endisset
        @endisset
    });
</script>

</html>
