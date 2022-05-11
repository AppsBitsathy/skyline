<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Full Details - Report</title>
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
            <h6>Full Details Report For Centrifugal Jet Pump As Per IS - 6595</h6>
            <form action="{{ route('6595_entryFullDetailsReportDownload') }}" method="post">
                @csrf
                <input type="hidden" name="pumpId" id="reportPumpid">
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="toDate" id="toDate">
                <button class="btn waves-effect btn-flat">Click here to download</button>
            </form>
            @isset($d)
                <h6>Period: {{ $d['startDate'] }} to {{ $d['toDate'] }}</h6>
            @endisset
        </div>
        <div class="row left-align">

            <table class="centered white">
                <tr>
                    <td colspan="2"><b>Pump Type</b></td>
                    <td colspan="2"><span>{{ $pump->fldptype }}</span></td>
                </tr>
                <tr>
                    <td rowspan="2"><b>Serial No.</b></td>
                    <td rowspan="2"><b>Pump No.</b></td>
                    <td rowspan="2"><b>Date</b></td>
                    <td rowspan="2"><b>Discharge (Lph)</b></td>
                    <td rowspan="2"><b>Total Head (m)</b></td>
                    <td rowspan="2"><b>Efficiency (&percnt;)</b></td>
                    <td rowspan="2"><b>Power (kW)</b></td>
                    <td colspan="2"><b>Balance Test</b></td>
                    <td colspan="2"><b>Marked Test</b></td>
                    <td rowspan="2"><b>Casing Test</b></td>
                </tr>
                <tr>
                    <td><b>Rotor</b></td>
                    <td><b>Implore</b></td>
                    <td><b>Earth</b></td>
                    <td><b>Rotation</b></td>
                </tr>
                @isset($tableData)
                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data->fldsno }}</td>
                            <td>{{ $data->fldpno }}</td>
                            <td>{{ explode(' ', $data->flddate)[0] }}</td>
                            <td>{{ $data->fldrdis }}</td>
                            <td>{{ $data->fldrthead }}</td>
                            <td>{{ $data->fldoeff }}</td>
                            <td>{{ $data->fldcur }}</td>
                            <td>{{ $data->fldrotor }}</td>
                            <td>{{ $data->fldimp }}</td>
                            <td>{{ $data->fldearth }}</td>
                            <td>{{ $data->fldrotation }}</td>
                            <td>{{ $data->fldctest }}</td>
                        </tr>
                    @endforeach
                @endisset
                <tr>
                    <td colspan="12" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="6" class="no-border"><b>Tested By</b></td>
                    <td colspan="6" class="no-border"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="12" class="no-border"></td>
                </tr>
                <tr>
                    <td colspan="12" class="no-border"></td>
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

        $('#reportPumpid').val("{{ $d['pumpId'] }}");
        $('#startDate').val("{{ $d['startDate'] }}");
        $('#toDate').val("{{ $d['toDate'] }}");

    })
</script>

</html>
