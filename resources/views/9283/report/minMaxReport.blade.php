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
            <h5>Motor Performance Test as per IS - 9283</h5>
            <h6>Typewise Results for Maximum and Minimum in Observed Values</h6>
            @isset($startDate)
                @isset($toDate)
                    <h6>Period : {{ $startDate }} to {{ $toDate }} </h6>
                @endisset
            @endisset
            <form action="{{ route('9283_reportMotorMaxMinGetObservedValuesReportDownload') }}" method="post">
                @csrf
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="toDate" id="toDate">
                <button class="btn waves-effect btn-flat">Click here to download</button>
            </form>
        </div>

        <div class="row left-align">
            <table class=" white">
                <tr>
                    <th><b>Motor Type</b></th>
                    <th><b>Max FLT</b></th>
                    <th><b>Min FLT</b></th>
                    <th><b>Max Eff</b></th>
                    <th><b>Min Eff</b></th>
                    <th><b>Max I</b></th>
                    <th><b>Min I</b></th>
                </tr>
                @isset($observed_list)
                    @foreach ($observed_list as $data)
                        <tr>
                            <td>{{ $data->motortype }}</td>
                            <td>{{ $data->fltmax }}</td>
                            <td>{{ $data->fltmin }}</td>
                            <td>{{ $data->effmax }}</td>
                            <td>{{ $data->effmin }}</td>
                            <td>{{ $data->currmax }}</td>
                            <td>{{ $data->currmin }}</td>
                        </tr>
                    @endforeach
                @endisset

                <tr>
                    <td colspan="6" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="3" class="no-border center"><b>Tested By</b></td>
                    <td colspan="3" class="no-border center"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="3" class="no-border"></td>
                </tr>
                <tr>
                    <td colspan="3" class="no-border"></td>
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
