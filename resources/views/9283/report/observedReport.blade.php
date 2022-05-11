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
            <h6>Typewise Results for Observed Values</h6>
            @isset($startDate)
                @isset($toDate)
                    <h6>Period : {{ $startDate }} to {{ $toDate }} </h6>
                @endisset
            @endisset
            <form action="{{ route('9283_reportMotorObservedFetchDownload') }}" method="post">
                @csrf
                <input type="hidden" name="startDate" id="startDate">
                <input type="hidden" name="toDate" id="toDate">
                <input type="hidden" name="motorType" id="motorType">
                <button class="btn waves-effect btn-flat">Click here to download</button>
            </form>
        </div>

        <div class="row left-align">
            @isset($dataList)
                @isset($motor)
                    <table class="centered white">
                        <tr>
                            <td colspan="2"><b>Motor No</b></td>
                            <td colspan="2"><b>Motor Type</b></td>
                            <td colspan="2"><b>Date</b></td>
                            <td colspan="2"><b>FLT (&percnt;) </b><br>{{ $motor->fldstorque }}</td>
                            <td colspan="2"><b>Efficiency (&percnt;)</b><br>{{ $motor->fldmeff }}</td>
                            <td colspan="2"><b>Leakage Current (A)</b><br>{{ $motor->fldlcur }}</td>
                        </tr>

                        @foreach ($dataList as $data)
                            <tr>
                                <td colspan="2">{{ $data->fldmno }}</td>
                                <td colspan="2">{{ $motor->fldmtype }}</td>
                                <td colspan="2">{{ $data->flddate }}</td>
                                <td colspan="2">{{ $data->fldflt }}</td>
                                <td colspan="2">{{ $data->fldeff }}</td>
                                <td colspan="2">{{ $data->fldlcur }}</td>
                            </tr>
                        @endforeach

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
                @endisset
            @endisset
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
                @isset($motor)
                    $('#startDate').val('{{ $startDate }}');
                    $('#toDate').val('{{ $toDate }}');
                    $('#motorType').val('{{ $motor->fldsno }}');
                @endisset
            @endisset
        @endisset
    });
</script>

</html>
