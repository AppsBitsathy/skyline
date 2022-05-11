<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report - Min Max Values Report</title>
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
            <h6>Performance Analysing System For Pump Results for Maximum and Minimum Values</h6>
            @isset($startDate)
                @isset($toDate)
                    <h6>Period : {{ $startDate }} to {{ $toDate }} </h6>
                @endisset
            @endisset
            <form action="{{ route('reportPumpMaxMinGetObservedValuesReportDownload') }}" method="post">
                @csrf
                {{-- <input type="hidden" name="pumpId" id="reportPumpid"> --}}
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="toDate" id="toDate">
                <button class="btn waves-effect btn-flat">Click here to download</button>
            </form>
        </div>

        <div class="row left-align">
            <table class="centered white">
                <tr>
                    <td><b>Pump Type</b></td>
                    <td><b>Max Dis</b></td>
                    <td><b>Dis Pno</b></td>
                    <td><b>Min Dis</b></td>
                    <td><b>Dis Pno</b></td>
                    <td><b>Max Total Head</b></td>
                    <td><b>Total Head Pno</b></td>
                    <td><b>Min Total Head</b></td>
                    <td><b>Total Head Pno</b></td>
                    <td><b>Max Eff</b></td>
                    <td><b>Eff Pno</b></td>
                    <td><b>Min Eff</b></td>
                    <td><b>Eff Pno</b></td>
                    <td><b>Max Current</b></td>
                    <td><b>Current Pno</b></td>
                    <td><b>Min Current</b></td>
                    <td><b>Current Pno</b></td>
                </tr>

                @isset($observed_list)
                    {{-- {{ json_encode($observed_list) }} --}}
                    @foreach ($observed_list as $data)
                        <tr>
                            <td>{{ $data->pumptype }}</td>
                            <td>{{ $data->dismax }}</td>
                            <td>{{ $data->dismaxpno }}</td>
                            <td>{{ $data->dismin }}</td>
                            <td>{{ $data->disminpno }}</td>
                            <td>{{ $data->thmax }}</td>
                            <td>{{ $data->thmaxpno }}</td>
                            <td>{{ $data->thmin }}</td>
                            <td>{{ $data->thminpno }}</td>
                            <td>{{ $data->oeffmax }}</td>
                            <td>{{ $data->oeffmaxpno }}</td>
                            <td>{{ $data->oeffmin }}</td>
                            <td>{{ $data->oeffminpno }}</td>
                            <td>{{ $data->currmax }}</td>
                            <td>{{ $data->currmaxpno }}</td>
                            <td>{{ $data->currmin }}</td>
                            <td>{{ $data->currminpno }}</td>
                        </tr>
                    @endforeach
                @endisset

                <tr>
                    <td colspan="20" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="7" class="no-border"><b>Tested By</b></td>
                    <td colspan="7" class="no-border"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
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
                $('#startDate').val('{{ $startDate }}');
                $('#toDate').val('{{ $toDate }}');
                $('#btnReport').attr('disabled', false);
            @endisset
        @endisset

    })
</script>

</html>
