@extends('includes.master')
<title>Master - Declared Values</title>
@php
$rMain = 2;
$rId = 21;
@endphp
@section('content')
    <h4 class="m-4 white-text">Declaration Entry</h4>
    <div class="container">
        <div class="row">
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-4 pb-2">
                        <div class="row mb-4">
                            <div class="col m2 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" href="#openModal" id="btnOpen">Open
                                    <i class="material-icons right">folder</i>
                                </a>
                            </div>
                            <div class="col m2 center-align">
                                <form action="{{ route('9283_entryMotorEntryDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpNo" id="deletePumpNo">
                                    <input type="hidden" name="deletePumpType" id="deletePumpType">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete<i class="material-icons right">delete</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m2 center-align">
                                <a class="btn waves-effect waves-light" disabled name="btnReport" id="btnReport">Report<i
                                        class="material-icons right">picture_as_pdf</i>
                                </a>
                            </div>
                            <div class="col m2 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" href="#reportCustomModal"
                                    id="btnCustReport">Custom Report<i class="material-icons right">picture_as_pdf</i>
                                </a>
                            </div>
                            <div class="col m2 center-align ">
                                <a class="btn waves-effect waves-light modal-trigger" disabled href="#resultModal"
                                    name="btnResult" id="btnResult">Result<i class="material-icons right">summarize</i>
                                </a>
                            </div>
                            {{-- <div class="col m2 center-align hide">
                                <button class="btn waves-effect waves-light" name="btnGraph" id="btnGraph">Readings
                                    Automation<i class="material-icons right">auto_stories</i>
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col s12">
                <ul class="tabs z-depth-1">
                    <li class="tab col s3"><a class="active" href="#basicInputs">{{ __('Basic Inputs') }}</a>
                    </li>
                    <li class="tab col s3"><a class="" href="#loadTests">{{ __('Load Tests') }}</a></li>
                    <li class="tab col s3"><a class="" href="#otherTests">{{ __('Other Tests') }}</a>
                    </li>
                    <li class="tab col s3"><a class="" href="#dimensions">{{ __('Dimensions') }}</a>
                    </li>
                </ul>

                <div class="col m12 card p-3">
                    <div class="card-body">
                        <!-- basic inputs -->
                        <form action="{{ route('9283_entryMotorEntrySubmit') }}" method="POST" id="formEntryMotor">
                            @csrf
                            <div id="basicInputs" class="row">
                                <h6><u>Basic Inputs</u></h6>
                                <div class="col m6 row">
                                    <div class="col m6">
                                        <span>Motor Number</span>
                                        <input class="input-field" type="text" name="basicMotorNo" id="basicMotorNo"
                                            placeholder="Motor Number" autocomplete="on" required>
                                    </div>
                                    <div class="input-field col m6">
                                        <select name="basicListMotorTypes" id="basicListMotorTypes" required>
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($allMotors)
                                                @foreach ($allMotors as $motorSno => $motorType)
                                                    <option value="{{ $motorSno }}">{{ $motorType }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Choose Motor type</label>
                                    </div>
                                    <div class="col m6">
                                        <span>Type</span>
                                        <input class="input-field" type="text" name="basicType" id="basicType"
                                            placeholder="Motor Number" autocomplete="on" required>
                                    </div>
                                    <div class="input-field col m6" id="basicConnAdd">
                                        <select name="basicConnection" id="basicConnection" required>
                                            <option value="0" disabled selected>Choose your option</option>
                                        </select>
                                        <label>Choose Connection type</label>
                                    </div>
                                    <div class="input-field col m6 hide" id="basicConnUpd">
                                        <span>Connection Type</span>
                                        <input class="input-field" type="text" name="basicConnection"
                                            id="basicConnectionTxt" placeholder="Basic Connection" autocomplete="on"
                                            required readonly>
                                    </div>
                                    <div class="col m6">
                                        <span>Tested date</span>
                                        <input class="input-field datepicker" type="text" name="basicTestedDate"
                                            id="basicTestedDate" autocomplete="on" required placeholder="Choose date">
                                    </div>
                                    <div class="col m6">
                                        <span>Break Drum Radius (R) &plus; Belt Thickness</span>
                                        <input class="input-field" type="text" name="basicBreakBelt" id="basicBreakBelt"
                                            autocomplete="on" required
                                            placeholder="Break Drum Radius &plus; Belt Thickness">
                                    </div>
                                    <div class="col m6">
                                        <span>Lock Arm Length</span>
                                        <input class="input-field" type="text" name="basicArmLength" id="basicArmLength"
                                            autocomplete="on" required placeholder="Lock Arm Length">
                                    </div>
                                    <div class="col m6">
                                        <span>Max. Leakage Current</span>
                                        <input class="input-field" type="text" name="basicMaxLeakCurr"
                                            id="basicMaxLeakCurr" autocomplete="on" required
                                            placeholder="Max. Leakage Current">
                                    </div>
                                </div>
                                <div class="col m6 row">
                                    <div class="col m6">
                                        <span>Stator Resistance &#47; Phase</span>
                                        <input class="input-field" type="text" name="basicResistPhase"
                                            id="basicResistPhase" autocomplete="on" required
                                            placeholder="Stator Resistance &hslash; Phase">
                                    </div>
                                    <div class="col m6">
                                        <span>Initial Temperature &deg;C</span>
                                        <input class="input-field" type="text" name="basicInitTemp" id="basicInitTemp"
                                            autocomplete="on" required placeholder="Initial Temperature &deg;C">
                                    </div>
                                    <h6><u>Reduced Voltage Test</u></h6>
                                    <div class="col m6">
                                        <span>Speed in Clockwise (rpm)</span>
                                        <input class="input-field" type="text" name="basicSpeedClock"
                                            id="basicSpeedClock" autocomplete="on" required
                                            placeholder="Speed in Clockwise">
                                    </div>
                                    <div class="col m6">
                                        <span>Speed in Anti&hyphen;Clockwise (rpm)</span>
                                        <input class="input-field" type="text" name="basicAntiClock" id="basicAntiClock"
                                            autocomplete="on" required placeholder="Speed in Anti&hyphen;Clockwise">
                                    </div>
                                    <h6><u>Insulation Resistance Test</u></h6>
                                    <div class="col m6">
                                        <span>Before High Voltage (M Ohm)</span>
                                        <input class="input-field" type="text" name="basicBeforeVolt"
                                            id="basicBeforeVolt" autocomplete="on" required
                                            placeholder="Before High Voltage">
                                    </div>
                                    <div class="col m6">
                                        <span>After High Voltage (M Ohm)</span>
                                        <input class="input-field" type="text" name="basicAfterVolt" id="basicAfterVolt"
                                            autocomplete="on" required placeholder="After High Voltage">
                                    </div>
                                    <div class="col m6">
                                        <span>High Voltage Test (1500 V)</span>
                                        <input class="input-field" type="text" name="basicHighVolt" id="basicHighVolt"
                                            autocomplete="on" required placeholder="High Voltage Test">
                                    </div>
                                </div>
                            </div>

                            <!-- load tests -->
                            <div class="row" id="loadTests">
                                <div class="col m6">
                                    <h6><u>No Load Tests</u></h6>
                                    <div class="col m6">
                                        <span>Volts (V)</span>
                                        <input class="input-field" type="text" name="loadnltVolt" id="loadnltVolt"
                                            autocomplete="on" required placeholder="Volts">
                                    </div>
                                    <div class="col m6">
                                        <span>Amps (A)</span>
                                        <input class="input-field" type="text" name="loadnltAmp" id="loadnltAmp"
                                            autocomplete="on" required placeholder="Amps">
                                    </div>
                                    <h6><u>Power</u></h6>
                                    <div class="col m6">
                                        <span>W1</span>
                                        <input class="input-field" type="text" name="loadnltw1" id="loadnltw1"
                                            autocomplete="on" required placeholder="W1">
                                    </div>
                                    <div class="col m6">
                                        <span>W2</span>
                                        <input class="input-field" type="text" name="loadnltw2" id="loadnltw2"
                                            autocomplete="on" required placeholder="W2">
                                    </div>
                                    <div class="col m6">
                                        <span>Constant (C1)</span>
                                        <input class="input-field" type="text" name="loadnltConst" id="loadnltConst"
                                            autocomplete="on" required placeholder="Constant">
                                    </div>
                                    <div class="col m6 offset-m6"></div>
                                    <div class="col m6">
                                        <span>Speed (rpm)</span>
                                        <input class="input-field" type="text" name="loadnltSpeed" id="loadnltSpeed"
                                            autocomplete="on" required placeholder="Speed">
                                    </div>
                                    <div class="col m6">
                                        <span>Frequency (Hz)</span>
                                        <input class="input-field" type="text" name="loadnltFreq" id="loadnltFreq"
                                            autocomplete="on" required placeholder="Frequency">
                                    </div>
                                </div>
                                <div class="col m6">
                                    <h6><u>Full Load Tests</u></h6>
                                    <div class="col m6">
                                        <span>Volts (V)</span>
                                        <input class="input-field" type="text" name="loadfltVolt" id="loadfltVolt"
                                            autocomplete="on" required placeholder="Volts">
                                    </div>
                                    <div class="col m6">
                                        <span>Amps (A)</span>
                                        <input class="input-field" type="text" name="loadfltAmp" id="loadfltAmp"
                                            autocomplete="on" required placeholder="Amps">
                                    </div>
                                    <h6><u>Power</u></h6>
                                    <div class="col m6">
                                        <span>W3</span>
                                        <input class="input-field" type="text" name="loadfltw3" id="loadfltw3"
                                            autocomplete="on" required placeholder="W3">
                                    </div>
                                    <div class="col m6">
                                        <span>W4</span>
                                        <input class="input-field" type="text" name="loadfltw4" id="loadfltw4"
                                            autocomplete="on" required placeholder="W4">
                                    </div>
                                    <div class="col m6">
                                        <span>Constant (C2)</span>
                                        <input class="input-field" type="text" name="loadfltConst" id="loadfltConst"
                                            autocomplete="on" required placeholder="Constant">
                                    </div>
                                    <div class="col m6 offset-m6"></div>
                                    <div class="col m6">
                                        <span>Speed (rpm)</span>
                                        <input class="input-field" type="text" name="loadfltSpeed" id="loadfltSpeed"
                                            autocomplete="on" required placeholder="Speed">
                                    </div>
                                    <div class="col m6">
                                        <span>Frequency (Hz)</span>
                                        <input class="input-field" type="text" name="loadfltFreq" id="loadfltFreq"
                                            autocomplete="on" required placeholder="Frequency">
                                    </div>
                                </div>
                            </div>

                            <!-- other tests -->
                            <div id="otherTests" class="row">
                                <div class="col m4">
                                    <h6><u>Locked Rotor Tests</u></h6>
                                    <div class="col m12">
                                        <span>Volts (V)</span>
                                        <input class="input-field" type="text" name="otherVoltv" id="otherVoltv"
                                            autocomplete="on" required placeholder="Volts">
                                    </div>
                                    <div class="col m12">
                                        <span>Volts (Actual)</span>
                                        <input class="input-field" type="text" name="otherVolta" id="otherVolta"
                                            autocomplete="on" required placeholder="Volts">
                                    </div>
                                    <div class="col m12">
                                        <span>Amps (A)</span>
                                        <input class="input-field" type="text" name="otherAmp" id="otherAmp"
                                            autocomplete="on" required placeholder="Amps">
                                    </div>
                                    <div class="col m12">
                                        <span>Power (W)</span>
                                        <input class="input-field" type="text" name="otherPower" id="otherPower"
                                            autocomplete="on" required placeholder="Power">
                                    </div>
                                    <div class="col m12">
                                        <span>Weight (Kg)</span>
                                        <input class="input-field" type="text" name="otherWeight" id="otherWeight"
                                            autocomplete="on" required placeholder="Weight">
                                    </div>
                                </div>
                                <div class="col m4">
                                    <h6><u>At Rated Voltage of 100 &percnt;</u></h6>
                                    <div class="col m12">
                                        <span>Initial Resistance / Phase</span>
                                        <input class="input-field" type="text" name="otherInitResistHun"
                                            id="otherInitResistHun" autocomplete="on" required
                                            placeholder="Initial Resistance / Phase">
                                    </div>
                                    <div class="col m12">
                                        <span>Initial Temperature</span>
                                        <input class="input-field" type="text" name="otherInitTempHun"
                                            id="otherInitTempHun" autocomplete="on" required
                                            placeholder="Initial Temperature">
                                    </div>
                                    <div class="col m12">
                                        <span>Final Resistance / Phase</span>
                                        <input class="input-field" type="text" name="otherFinalResistHun"
                                            id="otherFinalResistHun" autocomplete="on" required
                                            placeholder="Final Resistance / Phase">
                                    </div>
                                    <div class="col m12">
                                        <span>Final Temperature</span>
                                        <input class="input-field" type="text" name="otherFinalTempHun"
                                            id="otherFinalTempHun" autocomplete="on" required
                                            placeholder="Final Temperature">
                                    </div>
                                </div>
                                <div class="col m4">
                                    <h6><u>At Rated Voltage of 85 &percnt;</u></h6>
                                    <div class="col m12">
                                        <span>Initial Resistance / Phase</span>
                                        <input class="input-field" type="text" name="otherInitResistEig"
                                            id="otherInitResistEig" autocomplete="on" required
                                            placeholder="Initial Resistance / Phase">
                                    </div>
                                    <div class="col m12">
                                        <span>Initial Temperature</span>
                                        <input class="input-field" type="text" name="otherInitTempEig"
                                            id="otherInitTempEig" autocomplete="on" required
                                            placeholder="Initial Temperature">
                                    </div>
                                    <div class="col m12">
                                        <span>Final Resistance / Phase</span>
                                        <input class="input-field" type="text" name="otherFinalResistEig"
                                            id="otherFinalResistEig" autocomplete="on" required
                                            placeholder="Final Resistance / Phase">
                                    </div>
                                    <div class="col m12">
                                        <span>Final Temperature</span>
                                        <input class="input-field" type="text" name="otherFinalTempEig"
                                            id="otherFinalTempEig" autocomplete="on" required
                                            placeholder="Final Temperature">
                                    </div>
                                </div>
                            </div>

                            <!-- dimensions -->
                            <div id="dimensions" class="row">
                                <h6><u>Observed Values</u></h6>
                                <div class="col m4">
                                    <span>Dia of the Shaft (mm)</span>
                                    <input class="input-field" type="text" name="dimDiaShaft" id="dimDiaShaft"
                                        autocomplete="on" required placeholder="Dia of the Shaft">
                                </div>
                                <div class="col m4">
                                    <span>Shaft Extension Run Out (mm)</span>
                                    <input class="input-field" type="text" name="dimShaftExt" id="dimShaftExt"
                                        autocomplete="on" required placeholder="Shaft Extension Run Out">
                                </div>
                                <div class="col m4">
                                    <span>Spigot Dia (mm)</span>
                                    <input class="input-field" type="text" name="dimSpigotDia" id="dimSpigotDia"
                                        autocomplete="on" required placeholder="Spigot Dia">
                                </div>
                                <div class="col m4">
                                    <span>Concentricity (mm)</span>
                                    <input class="input-field" type="text" name="dimConcentricity" id="dimConcentricity"
                                        autocomplete="on" required placeholder="Concentricity">
                                </div>
                                <div class="col m4">
                                    <span>Outside Dia (mm)</span>
                                    <input class="input-field" type="text" name="dimOutDia" id="dimOutDia"
                                        autocomplete="on" required placeholder="Outside Dia">
                                </div>
                                <div class="col m4">
                                    <span>Perpendicularity (mm)</span>
                                    <input class="input-field" type="text" name="dimPerpend" id="dimPerpend"
                                        autocomplete="on" required placeholder="Perpendicularity">
                                </div>
                            </div>
                            <div class="center"><input type="submit" class="btn"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- open modal --}}
    <div id="openModal" class="modal">
        <form method="GET" action="{{ route('9283_entryMotorEntry') }}" id="frmOpen">
            <div class="modal-content">
                <h4>Open</h4>
                <div class="row">
                    <div class="col m6 center-align">
                        <input type="hidden" value="open" name="mode">
                        <div class="input-field">
                            <select required name="oMotorType" id="ddOpenMotorType">
                                <option value="" disabled selected>Choose your option</option>
                                @isset($allMotors)
                                    @foreach ($allMotors as $motorNo => $motorType)
                                        <option value="{{ $motorNo }}">{{ $motorType }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <label>Choose motor type</label>
                        </div>
                    </div>
                    <div class="col m6 center-align">
                        <div class="input-field">
                            <select required name="oMotorNo" id="ddOpenMotorNo">
                                {{-- @isset($allEntryValues)
                                        @foreach ($allEntryValues as $motorNo => $motorSno)
                                            <option value="{{ $motorSno }}">{{ $motorNo }}</option>
                                        @endforeach
                                    @endisset --}}
                            </select>
                            <label>Choose motor no.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-green btn-flat" onclick="">ok</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </form>
    </div>

    {{-- custom report modal --}}
    <div id="reportCustomModal" class="modal">
        <form method="post" action="{{ route('9283_entryMotorTestingViewCustomReport') }}" id="frmReportDate"
            target="blank">
            @csrf
            <div class="modal-content">
                <h4>Select date for pump min max values report</h4>
                <div class="row">
                    <div class="input-field col m4">
                        <select name="motortype" required>
                            <option value="" disabled selected>Choose your option</option>
                            @isset($allMotors)
                                @foreach ($allMotors as $motorSno => $motorType)
                                    <option value="{{ $motorSno }}">{{ $motorType }}</option>
                                @endforeach
                            @endisset
                        </select>
                        <label>Type</label>
                    </div>
                    <div class="col m4">
                        <span>Start Date</span>
                        <input class="input-field" name="startDate" type="date" required autocomplete="on">
                    </div>
                    <div class="col m4">
                        <span>To Date</span>
                        <input class="input-field" name="toDate" type="date" required autocomplete="on">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-green btn-flat">ok</button>
                <a class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </form>
    </div>

    {{-- open modal --}}
    <div id="resultModal" class="modal">
        <div class="modal-content">

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Declared</th>
                        <th>Observed</th>
                        <th>Result</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Minimum Starting Torque</td>
                        <td id="dflt"></td>
                        <td id="oflt"></td>
                        <td id="rflt"></td>
                    </tr>
                    <tr>
                        <td>Minimum Efficiency</td>
                        <td id="deff"></td>
                        <td id="oeff"></td>
                        <td id="reff"></td>
                    </tr>
                    <tr>
                        <td>Maximum Leakage Current</td>
                        <td id="dlcur"></td>
                        <td id="olcur"></td>
                        <td id="rlcur"></td>
                    </tr>
                </tbody>
            </table>
            <div class="row m-0 mt-3">
                <div class="col s12">
                    <h5 id="overallResult"></h5>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <a class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        @isset($resultModal)
            $('#dflt').html('{{ $resultModal['dflt'] }}');
            $('#oflt').html('{{ $resultModal['oflt'] }}');
            $('#rflt').html('{{ $resultModal['rflt'] }}');
            $('#deff').html('{{ $resultModal['deff'] }}');
            $('#oeff').html('{{ $resultModal['oeff'] }}');
            $('#reff').html('{{ $resultModal['reff'] }}');
            $('#dlcur').html('{{ $resultModal['dlcur'] }}');
            $('#olcur').html('{{ $resultModal['olcur'] }}');
            $('#rlcur').html('{{ $resultModal['rlcur'] }}');
            @if ($resultModal['ores'] == 'Pass')
                $('#overallResult').html('<i class="material-icons left pt-1 green-text">circle</i>Pump Pass');
            @else
                $('#overallResult').html('<i class="material-icons left pt-1 red-text">circle</i>Pump Fail');
            @endif
        
            document.addEventListener('DOMContentLoaded', function() {
            var Modalelem = document.querySelector('#resultModal');
            var instance = M.Modal.init(Modalelem, {
            dismissible: false
            });
            instance.open();
            });
        
            $('#btnResult').attr("disabled", false);
        @endisset


        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif

            @isset($basicConnection)
                console.log('{{ $basicConnection }}');
            @endisset

            @isset($entryMinp)
                @isset($entryMcal)
                    $('#btnDelete').attr("disabled", false);
                    $('#deletePumpNo').val('{{ $entryMinp->fldmno }}');
                    $('#deletePumpType').val('{{ $entryMinp->fldmtype }}');
            
                    $('#btnReport').attr("disabled", false);
                    var url = "{{ URL::to('9283/entry/motor_entry/report/view_report/motorNo/motorType') }}";
                    url = url.replace('motorNo', "{{ $entryMinp->fldmno }}");
                    url = url.replace('motorType', "{{ $entryMinp->fldmtype }}");
                    $('#btnReport').attr("href", url);
                    $('#btnReport').attr("target", "blank");
            
                    // do with entries
                    $('#basicMotorNo').val('{{ $entryMinp->fldmno }}');
                    $('#basicListMotorTypes').val('{{ $entryMinp->fldmtype }}');
                    $('#basicType').val('{{ $entryMinp->fldtype }}');
                    $('#basicConnAdd').addClass('hide');
                    $('#basicConnUpd').removeClass('hide');
                    $('#basicConnectionTxt').val('{{ $entryMinp->fldconn }}');
                    $('#basicMaxLeakCurr').val('{{ $entryMcal->fldlcur }}');
                    $('#basicBreakBelt').val('{{ $entryMinp->fldbtr_bt }}');
                    $('#basicArmLength').val('{{ $entryMinp->fldarm }}');
                    $('#basicResistPhase').val('{{ $entryMinp->fldsres }}');
                    $('#basicInitTemp').val('{{ $entryMinp->flditemp }}');
                    $('#basicSpeedClock').val('{{ $entryMinp->fldspeedclk }}');
                    $('#basicAntiClock').val('{{ $entryMinp->fldspeedaclk }}');
                    $('#basicBeforeVolt').val('{{ $entryMinp->fldbhv }}');
                    $('#basicAfterVolt').val('{{ $entryMinp->fldahv }}');
                    $('#basicHighVolt').val('{{ $entryMinp->fldhv }}');
                    $('#loadnltVolt').val('{{ $entryMinp->fldnlv }}');
                    $('#loadnltAmp').val('{{ $entryMinp->fldnla }}');
                    $('#loadnltw1').val('{{ $entryMinp->fldnlw1 }}');
                    $('#loadnltw2').val('{{ $entryMinp->fldnlw2 }}');
                    $('#loadnltConst').val('{{ $entryMinp->fldnlc1 }}');
                    $('#loadnltSpeed').val('{{ $entryMinp->fldnlspeed }}');
                    $('#loadnltFreq').val('{{ $entryMinp->fldnlfreq }}');
                    $('#loadfltVolt').val('{{ $entryMinp->fldflv }}');
                    $('#loadfltAmp').val('{{ $entryMinp->fldfla }}');
                    $('#loadfltw3').val('{{ $entryMinp->fldflw3 }}');
                    $('#loadfltw4').val('{{ $entryMinp->fldflw4 }}');
                    $('#loadfltConst').val('{{ $entryMinp->fldflc2 }}');
                    $('#loadfltSpeed').val('{{ $entryMinp->fldflspeed }}');
                    $('#loadfltFreq').val('{{ $entryMinp->fldflfreq }}');
                    $('#otherVoltv').val('{{ $entryMinp->fldlrv }}');
                    $('#otherVolta').val('{{ $entryMinp->fldlrav }}');
                    $('#otherAmp').val('{{ $entryMinp->fldlra }}');
                    $('#otherPower').val('{{ $entryMinp->fldlrpower }}');
                    $('#otherWeight').val('{{ $entryMinp->fldlrweight }}');
                    $('#otherInitResistHun').val('{{ $entryMinp->fldtrires }}');
                    $('#otherInitTempHun').val('{{ $entryMinp->fldtritemp }}');
                    $('#otherFinalResistHun').val('{{ $entryMinp->fldtrfres }}');
                    $('#otherFinalTempHun').val('{{ $entryMinp->fldtrftemp }}');
                    $('#otherInitResistEig').val('{{ $entryMinp->fldtrires1 }}');
                    $('#otherInitTempEig').val('{{ $entryMinp->fldtritemp1 }}');
                    $('#otherFinalResistEig').val('{{ $entryMinp->fldtrfres1 }}');
                    $('#otherFinalTempEig').val('{{ $entryMinp->fldtrftemp1 }}');
                    $('#dimDiaShaft').val('{{ $entryMinp->fldodshaft }}');
                    $('#dimShaftExt').val('{{ $entryMinp->fldoext }}');
                    $('#dimSpigotDia').val('{{ $entryMinp->fldosdia }}');
                    $('#dimConcentricity').val('{{ $entryMinp->fldocon }}');
                    $('#dimOutDia').val('{{ $entryMinp->fldoodia }}');
                    $('#dimPerpend').val('{{ $entryMinp->fldoper }}');
                    $('#basicTestedDate').val('{{ $entryMcal->flddate }}');
            
            
                    $('#basicMotorNo').attr('readonly','readonly');
                    // $('#basicListMotorTypes').attr('readonly','readonly');
            
            
            
                    // if ($('#dischargeResult').html() == 'Pass' && $('#thResult').html() == 'Pass' && $('#oaeResult').html() ==
                    // 'Pass' &&
                    // $('#iResult').html() == 'Pass') {
                    // $('#overallResult').html('<i class="material-icons left pt-1 green-text">circle</i>Pump Pass');
                    // } else {
                    // $('#overallResult').html('<i class="material-icons left pt-1 red-text">circle</i>Pump Fail');
                    // }
            
                    // end of entries
                @endisset
            @endisset
        });

        // $('#formEntryMotor').submit(function() {
        // $('#formEntryMotor input').blur(function() {
        //     if ($(this).val()) {
        // $("input[type='submit']").removeClass('disabled');
        // M.toast({
        //     html: 'Fill all the fields.',
        //     classes: 'rounded'
        // });
        //     }
        // });
        // });

        // $('#motorType').on('change', function(e) {
        //     $('#hideMotorType').val(this.value);
        // });

        $('#basicListMotorTypes').on('change', function(e) {
            let selectedMotor = e.target.value;
            console.log(selectedMotor);

            $.ajax({
                url: "get_motor/" + selectedMotor,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    $('#basicConnection').html(res);
                    $('select').formSelect();
                }
            });
        });

        $('#ddOpenMotorType').on('change', function(e) {
            let selectedMotor = e.target.value;
            let motorNoOptions = $('#ddOpenMotorNo');
            let html = '';

            @isset($allEntryValues)
                @foreach ($allEntryValues as $motorNo)
                    if (selectedMotor == {{ $motorSno }}) {
                    html += '<option value="{{ $motorNo }}">{{ $motorNo }}</option>';
                    }
                @endforeach
            @endisset

            $('#ddOpenMotorNo').html(html);
            $('select').formSelect();
        });
    </script>
@endsection
