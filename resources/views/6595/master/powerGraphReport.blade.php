<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master - Power IO Graph - Report</title>
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
        @isset($tableData)
            <div class="pb-1">
                <h4>Skyline Softwares, Coimbatore - 15.</h4>
                <h5>Centrifugal Pump As Per IS - 8472 (Part I)</h5>
                <h6>Power Input and Power Output Report</h6>
                <form method="post" action="{{ route('6595_masterPowerGraphReportDownload') }}">
                    @csrf
                    <input type="hidden" name="reportPumpType" value="{{ $tableData[0]->fldptype }}">
                    <input class="btn waves-effect btn-flat" value="Click here to download" type="submit">
                </form>
            </div>

            <div class="row left-align">
                <table class="centered white">
                    <tr>
                        <td><b>Motor No.</b></td>
                        <td><span>{{ $tableData[0]->fldptype }}</span></td>
                        <td><b>H.P / k.W.</b></td>
                        <td><span>{{ $tableData[0]->fldhp }}</span></td>
                        <td><b>Speed</b></td>
                        <td><span>{{ $tableData[0]->fldspeed }}</span></td>
                    </tr>
                </table>
                <table class="centered white">
                    <tr>
                        <td><b>Power Input (kW)</b></td>
                        <td><b>Power Output (kW)</b></td>
                    </tr>

                    @foreach ($tableData as $data)
                        <tr>
                            <td>{{ $data->fldx }}</td>
                            <td>{{ $data->fldy }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endisset
    </div>
    @include('includes.bottom')
</body>

</html>
