@extends('includes.master')
<title>Master - Motor Declared Values</title>
@php
$rMain = 1;
$rId = 13;
@endphp
@section('content')
    <h4 class="m-4 white-text">Motor Declared Values</h4>
    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs z-depth-1">
                    <li class="tab col s6"><a class="active" href="#list">{{ __('List') }}</a></li>
                    <li class="tab col s6"><a class="" href="#entry">{{ __('Entry') }}</a></li>
                </ul>
            </div>
        </div>
        <form method="POST" action="{{ route('6595_masterMotorDeclaredValuesStore') }}">
            @csrf
            <div id="entry" class="col s12">
                <div class="card p-5 m-3">
                    <div class="row">
                        <div class="input-field col s6">
                            <input placeholder="Enter Serial No" name="serialNo" type="text" class="validate"
                                required>
                            <label for="motorType">Serial No.</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Enter Motor Type" name="motorType" type="text" class="validate"
                                required>
                            <label for="motorType">Motor Type</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Drum Radius (m)" name="drumRadius" type="text" class="validate"
                                required>
                            <label for="drumRadius">Drum Radius (m)</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Belt Thickness (m)" name="beltThickness" type="text" class="validate"
                                required>
                            <label for="beltThickness">Belt Thickness (m)</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Enter Rated Voltage (Volts)" name="ratedVoltage" type="text"
                                class="validate" required>
                            <label for="ratedVoltage">Rated Voltage (Volts)</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Enter Power (kW)" name="power" type="text" class="validate" required>
                            <label for="power">Power (kW)</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Enter Rated Full Load Speed (rpm)" name="ratedFullLoadSpeed" type="text"
                                class="validate" required>
                            <label for="ratedFullLoadSpeed">Rated Full Load Speed (rpm)</label>
                        </div>
                        <div class="input-field col s6">
                            <input placeholder="Enter Length of the Arm (m)" name="lengthOfArm" type="text"
                                class="validate" required>
                            <label for="lengthOfArm">Length of the Arm (m)</label>
                        </div>
                        <div class="col s12 center mt-3">
                            <button class="btn waves-effect">SUBMIT</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div id="list" class="col s12">
            <div class="card m-3 p-3">
                <div class="row">
                    <form action="{{ route('6595_masterMotorDeclaredValues') }}" method="GET">
                        @csrf
                        <div class="col s12">
                            <div class="col m6 center-align">
                                <label>
                                    <input class="with-gap" name="motorWiseOrList" type="radio"
                                        value="motorTypewise" />
                                    <span>Motor Typewise</span>
                                </label>
                            </div>
                            <div class="col m6 center-align">
                                <label>
                                    <input class="with-gap" name="motorWiseOrList" id="motorListAll" type="radio"
                                        value="motorListAll" checked />
                                    <span>List All</span>
                                </label>
                            </div>
                            <div class="input-field col m4 l4 offset-m4 offset-l4 mt-4">
                                <select name="listMotorTypes" id="listMotorTypes">
                                    <option value="0" disabled selected>Choose your option</option>
                                    @isset($allMotorsDD)
                                        @foreach ($allMotorsDD as $motorType)
                                            <option value="{{ $motorType }}">{{ $motorType }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <label>Choose Motor type</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="p-3" style="overflow-x: scroll">
                <table class="responsive-table white">
                    <thead>
                        @isset($allMotors)
                            <th colspan="8">Total Records: {{ count($allMotors) }}</th>
                        @endisset
                        <tr>
                            <th>Serial No</th>
                            <th>Motor Type</th>
                            <th>Voltage</th>
                            <th>Radius</th>
                            <th>Thickness</th>
                            <th>Power</th>
                            <th>Speed</th>
                            <th>Arm Length</th>
                        </tr>
                    </thead>

                    <tbody>
                        @isset($allMotors)
                            {{-- {{ $allMotors }} --}}
                            @foreach ($allMotors as $motor)
                                <tr>
                                    <td>{{ $motor->fldsno }}</td>
                                    <td>{{ $motor->fldmtype }}</td>
                                    <td>{{ $motor->fldvoltage }}</td>
                                    <td>{{ $motor->flddradius }}</td>
                                    <td>{{ $motor->fldbthickness }}</td>
                                    <td>{{ $motor->fldpower }}</td>
                                    <td>{{ $motor->fldspeed }}</td>
                                    <td>{{ $motor->fldarmlength }}</td>
                                    <td><a onclick="edit({{ $allMotors->find($motor->id) }})" href="#editModal"
                                            class="btn waves-effect modal-trigger"><i class="material-icons">edit</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('6595_masterMotorDeclaredValuesUpdate') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="input-field col s6">
                        <input placeholder="Serial No." name="serialNo" id="serialNo" type="text" class="validate"
                            required readonly>
                        <label for="motorType">Motor Type</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Motor Type" name="motorType" id="motorType" type="text"
                            class="validate" required readonly>
                        <label for="motorType">Motor Type</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Motor Type" name="drumRadius" id="drumRadius" type="text"
                            class="validate" required>
                        <label for="drumRadius">Drum Radius (m)</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Motor Type" name="beltThickness" id="beltThickness" type="text"
                            class="validate" required>
                        <label for="beltThickness">Belt Thickness (m)</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Rated Voltage (Volts)" name="ratedVoltage" id="ratedVoltage" type="text"
                            class="validate" required>
                        <label for="ratedVoltage">Rated Voltage (Volts)</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Power (kW)" name="power" id="power" type="text" class="validate"
                            required>
                        <label for="power">Power (kW)</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Rated Full Load Speed (rpm)" name="ratedFullLoadSpeed"
                            id="ratedFullLoadSpeed" type="text" class="validate" required>
                        <label for="ratedFullLoadSpeed">Rated Full Load Speed (rpm)</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Enter Length of the Arm (m)" name="lengthOfArm" id="lengthOfArm" type="text"
                            class="validate" required>
                        <label for="lengthOfArm">Length of the Arm (m)</label>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <button class="modal-close waves-effect waves-green btn-flat">UPDATE</button>
            </form>
            <a class="modal-close waves-effect waves-red btn-flat">CLOSE</a>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif

        });

        function edit(motor) {
            $('#id').val(motor.id);
            $('#serialNo').val(motor.fldsno);
            $('#motorType').val(motor.fldmtype);
            $('#ratedVoltage').val(motor.fldvoltage);
            $('#drumRadius').val(motor.flddradius);
            $('#beltThickness').val(motor.fldbthickness);
            $('#power').val(motor.fldpower);
            $('#ratedFullLoadSpeed').val(motor.fldspeed);
            $('#lengthOfArm').val(motor.fldarmlength);
        }

        $('#listMotorTypes').change(function(e) {
            $('#progress').removeClass('hide');
            let selectedMotor = e.target.value;
            window.location.href = "{{ URL::to('6595/master/motor_declared_values') }}" + "/" + selectedMotor;
        });

        $('#motorListAll').change(function(e) {
            $('#progress').removeClass('hide');
            window.location.href = "{{ URL::to('6595/master/motor_declared_values') }}";
        })

        if (window.location.href.indexOf("motor_declared_values/") > -1) {
            $('input[name="motorWiseOrList"]').first().attr('checked', 'checked');
            let options = $('#listMotorTypes option');
            for (let i = 0; i < options.length; i++) {
                const opt = options[i];
                @isset($allMotors)
                    let motorType = '{{ count($allMotors) > 0 ? $allMotors[0]->fldmtype : 0 }}';
                    if (opt.value == motorType) {
                    opt.setAttribute('selected', 'selected');
                    }
                @endisset
            }
            $('select').formSelect();
        } else {
            $('input[name="motorWiseOrList"]').first().removeAttr('checked');
        }
    </script>
@endsection
