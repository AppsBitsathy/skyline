<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report - Observed Values Report</title>
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
            <h6>Typewise Results for Observed Values</h6>
            @isset($startDate)
                @isset($toDate)
                    <h6>Period : {{ $startDate }} to {{ $toDate }} </h6>
                @endisset
            @endisset
            <form action="{{ route('8472_reportPumpObservedFetchDownload') }}" method="post">
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
                        <td><span>{{ $pump->fldphase }}</span></td>
                        <td><b>Voltage</b></td>
                        <td><span>{{ $pump->fldvolt }}</span>&nbsp;Volts</td>
                        <td><b>Suction Size</b></td>
                        <td><span>{{ $pump->fldssize }}</span>&nbsp;mm</td>
                        <td><b>Delivery Size</b></td>
                        <td><span>{{ $pump->flddsize }}</span>&nbsp;mm</td>
                        <td><b>Pump Type</b></td>
                        <td><span>{{ $pump->fldptype }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Total Head</b></td>
                        <td><span>{{ $pump->fldthead }}</span>&nbsp;m</td>
                        <td><b>Discharge</b></td>
                        <td><span>{{ $pump->flddis }}</span>&nbsp;Lph</td>
                        <td><b>Input Power</b></td>
                        <td><span>{{ $pump->fldpi }}</span>&nbsp;k.W</td>
                        <td><b>Max. Current</b></td>
                        <td><span>{{ $pump->fldmcurr }}</span>&nbsp;A</td>
                        <td><b>Head range</b></td>
                        <td><span>{{ $pump->fldheadr1 }} - {{ $pump->fldheadr2 }}</span>&nbsp;m</td>
                    </tr>
                @endisset
                <tr>
                    <td colspan="2"><b>Pump No</b></td>
                    <td colspan="2"><b>Date</b></td>
                    <td colspan="2"><b>Discharge (Lph)</b></td>
                    <td colspan="2"><b>Total Head (m)</b></td>
                    <td colspan="2"><b>Input Power (kW)</b></td>
                    <td colspan="2"><b>Current (A)</b></td>
                </tr>

                @isset($dataList)
                    @foreach ($dataList as $data)
                        <tr>
                            <td colspan="2">{{ $data->fldpno }}</td>
                            <td colspan="2">{{ explode(' ', $data->flddate)[0] }}</td>
                            <td colspan="2">{{ $data->flddis }}</td>
                            <td colspan="2">{{ $data->fldthead }}</td>
                            <td colspan="2">{{ $data->fldip }}</td>
                            <td colspan="2">{{ $data->fldcurr }}</td>
                        </tr>
                    @endforeach
                @endisset

                <tr>
                    <td colspan="14" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="7"><b>Tested By</b></td>
                    <td colspan="7"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="14"></td>
                </tr>
                <tr>
                    <td colspan="14"></td>
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
