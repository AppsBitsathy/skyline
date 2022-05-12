<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entry - Motor Testing - Custom Report</title>
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
            <h6>Motor Performance Test As Per IS - 12225</h6>
            <a class="btn waves-effect btn-flat"
                href="{{ route('12225_entryMotorTestingCustomReportDownload') }}">Click here
                to download</a>
        </div>

        <div class="row left-align">
            {{-- {{ $tableData }} --}}
            <table class="centered white">
                <tr>
                    <td colspan="2" class="no-border"><b>Motor Type</b></td>
                    <td colspan="2" class="no-border"><span id="dateht">{{ $motorType }}</span></td>
                </tr>
                <tr>
                    <td rowspan="2"><b>Date</b></td>
                    <td rowspan="2"><b>Inpass No.</b></td>
                    <td rowspan="2"><b>Sno</b></td>
                    <td colspan="2"><b>Insulation Resistance</b></td>
                    <td rowspan="2"><b>HV Test</b></td>
                    <td colspan="2"><b>Resistance Measure</b></td>
                    <td colspan="5"><b>No Load Reading</b></td>
                    <td colspan="2"><b>Locked Rotor Reading</b></td>
                    <td colspan="3"><b>Temp. Rise Test at 100 %</b></td>
                    <td colspan="3"><b>Temp. Rise Test at 85 %</b></td>
                    <td colspan="3"><b>Performance Values</b></td>
                    <td rowspan="2"><b>Cas. Press. Test & Balancing</b></td>
                </tr>
                <tr>
                    <td><b>Before Hv M Ohm</b></td>
                    <td><b>After Hv M Ohm</b></td>
                    <td><b>R1 Ohm</b></td>
                    <td><b>T1 &deg;C</b></td>
                    <td><b>Volts V</b></td>
                    <td><b>Current A</b></td>
                    <td><b>Watts W</b></td>
                    <td><b>Speed Rpm</b></td>
                    <td><b>Frequency Hz</b></td>
                    <td><b>Volts V</b></td>
                    <td><b>T1 ~ T2 Kgs</b></td>
                    <td><b>R2 Ohm</b></td>
                    <td><b>T2 &deg;C</b></td>
                    <td><b>BT &deg;C</b></td>
                    <td><b>R3 Ohm</b></td>
                    <td><b>T3 &deg;C</b></td>
                    <td><b>BT &deg;C</b></td>
                    <td><b>Locked Rotor %</b></td>
                    <td><b>Temp Rise at 100 %</b></td>
                    <td><b>Temp Rise at 85 %</b></td>
                </tr>
                @foreach ($tableData as $data)
                    <tr>
                        <td>{{ explode(' ', $data->flddate)[0] }}</td>
                        <td>{{ $data->fldinpass }}</td>
                        <td>{{ $data->fldsno }}</td>
                        <td>{{ $data->fldbeforehv }}</td>
                        <td>{{ $data->fldafterhv }}</td>
                        <td>{{ $data->fldhvtest }}</td>
                        <td>{{ $data->fldr1 }}</td>
                        <td>{{ $data->fldt1 }}</td>
                        <td>{{ $data->fldnlrvolts }}</td>
                        <td>{{ $data->fldcurrent }}</td>
                        <td>{{ $data->fldwatts }}</td>
                        <td>{{ $data->fldspeed }}</td>
                        <td>{{ $data->fldfrequency }}</td>
                        <td>{{ $data->fldlrrvolts }}</td>
                        <td>{{ $data->fldlrrt1t2 }}</td>
                        <td>{{ $data->fldr2 }}</td>
                        <td>{{ $data->fldt2 }}</td>
                        <td>{{ $data->fldbt240 }}</td>
                        <td>{{ $data->fldr3 }}</td>
                        <td>{{ $data->fldt3 }}</td>
                        <td>{{ $data->fldbt204 }}</td>
                        <td>{{ $data->fldlockedrotor }}</td>
                        <td>{{ $data->fldtrise240 }}</td>
                        <td>{{ $data->fldtrise204 }}</td>
                        <td>{{ $data->fldcptb }}</td>

                        {{-- <td>{{ round($data->fldOeff, 2) }}</td> --}}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="24" class="no-border-left no-border-right"></td>
                </tr>
                <tr>
                    <td colspan="12" class="no-border"><b>Tested By</b></td>
                    <td colspan="12" class="no-border"><b>Checked By</b></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
                </tr>
                <tr>
                    <td colspan="22" class="no-border"></td>
                </tr>
            </table>

        </div>

        {{-- <div class="col s12 pb-5">
            <div class="col s6">
                <span>Casing Test: </span>
            </div>
            <div class="col s6 left-align">
                <span>1. 1.5 times shutoff pressure = 3.02 Kg/cm&#178; </span>
            </div>
            <div class="col s6 offset-s6 left-align">
                <span>2. 2.0 times shutoff pressure = 3.20 Kg/cm&#178; </span>
            </div>
            <div class="col s6 pt-2">
                <span>Casing withstood a pressure of </span>
            </div>
            <div class="col s6 left-align pt-2">
                <span>30.20 m of water </span>
            </div>
        </div>
        <div class="col s12">
            <div class="col s6">
                <span><b>Tested By</b></span>
            </div>
            <div class="col s6">
                <span><b>Checked By</b></span>
            </div>
        </div> --}}
    </div>
    @include('includes.bottom')
</body>

</html>
