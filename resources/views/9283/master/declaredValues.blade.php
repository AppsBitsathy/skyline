@extends('includes.master')
<title>Master - Declared Values</title>
@php
$rMain = 1;
$rId = 11;
@endphp
@section('content')
    <h4 class="m-4 white-text">Declaration Entry</h4>
    <div class="container">
        <div class="row">
            <!-- <div class="col m4"></div> -->
            <div class="col s12">
                <ul class="tabs z-depth-1">
                    <li class="tab col s6"><a class="active" href="#list">{{ __('List') }}</a></li>
                    <li class="tab col s6"><a class="" href="#entry">{{ __('Entry') }}</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <!-- entry -->
            <div id="entry" class="col m12">
                <div class="card">
                    <!-- <div class="card-title">{{ __('Entry') }}</div> -->
                    <div class="card-body pt-5 pb-2">
                        <form method="POST" action="{{ route('9283_masterDeclaredValuesEntrySubmit') }}">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5">
                                    <span>Serial No.</span>
                                    <input class="input-field" name="serialNo" placeholder="Serial No." required
                                        autofocus autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Motor Type Type</span>
                                    <input class="input-field" name="motorType" placeholder="Motor Type" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Bore size (mm)</span>
                                    <input class="input-field" name="boreSize" placeholder="Bore Size" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>H.P.</span>
                                    <input class="input-field" name="hp" placeholder="H.P." required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>K.W.</span>
                                    <input class="input-field" name="kw" placeholder="K.W." required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <div class="input-field col s12">
                                        <select required name="phase">
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="THREE">THREE</option>
                                        </select>
                                        <label>Phase</label>
                                    </div>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Minimum Efficiency (&percnt;)</span>
                                    <input class="input-field" name="minEff" placeholder="Minimum Efficiency (&percnt;)"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Minimum Full Load Speed (RPM)</span>
                                    <input class="input-field" name="minFullLoadSpeed"
                                        placeholder="Minimum Full Load Speed (RPM)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Minimum Full Load Speed (RPM)</span>
                                    <input class="input-field" name="minFullLoadCurr"
                                        placeholder="Minimum Full Load Speed (RPM)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Maximum Starting Torque (&percnt;)</span>
                                    <input class="input-field" name="maxStartTorque"
                                        placeholder="Maximum Starting Torque (&percnt;)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Maximum Leakage Current (A)</span>
                                    <input class="input-field" name="maxLeakCurr"
                                        placeholder="Maximum Leakage Current (A)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Dia of the shaft (mm)</span>
                                    <input class="input-field" name="diaShaft" placeholder="Dia of the shaft (mm)"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Shaft Extension run out (mm)</span>
                                    <input class="input-field" name="shaftExtRunout"
                                        placeholder="Shaft Extension run out (mm)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Spigot Dia (mm)</span>
                                    <input class="input-field" name="spigotDia" placeholder="Spigot Dia (mm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Concentricity (mm)</span>
                                    <input class="input-field" name="concentricity" placeholder="Concentricity (mm)"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Outside Dia (mm)</span>
                                    <input class="input-field" name="outsideDia" placeholder="Outside Dia (mm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Perpendicularity (mm)</span>
                                    <input class="input-field" name="perpendicularity"
                                        placeholder="Perpendicularity (mm)" required autocomplete="on">
                                </div>
                                <div class="col m12 center">
                                    <input class="btn btn-primary" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- list -->
            <div id="list" class="col m12">
                <div class="card p-3">
                    <!-- <div class="card-title">{{ __('List') }}</div> -->
                    <div class="card-body">
                        <div class="row">
                            <form id="motorSelectionForm" method="GET" action="{{ route('9283_masterDeclaredValues') }}">
                                @csrf
                                {{-- {{ method_field('put') }} --}}
                                <div class="col m6 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="motorWiseOrList" type="radio"
                                                value="motorTypewise" />
                                            <span>Motor Typewise</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col m6 center-align">
                                    <label class="">
                                        <input class="with-gap" name="motorWiseOrList" id="motorListAll" type="radio"
                                            value="motorListAll" checked />
                                        <span>List All</span>
                                    </label>
                                </div>
                                <div class="input-field col m4 l4 offset-m4 offset-l4">
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
                                {{-- <input type="submit" class="btn btn-primary"> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll">
                    <table class="responsive-table white">
                        <thead>
                            @isset($allMotors)
                                <th colspan="17">Total Records: {{ count($allMotors) }}</th>
                            @endisset
                            <tr>
                                <th>Serial No.</th>
                                <th>Motor Type</th>
                                <th>Bore</th>
                                <th>HP</th>
                                <th>kW</th>
                                <th>Phase</th>
                                <th>Eff.</th>
                                <th>Speed</th>
                                <th>F Curr</th>
                                <th>Torque</th>
                                <th>L Curr</th>
                                <th>D Shaft</th>
                                <th>Ext.</th>
                                <th>S Dia</th>
                                <th>Con.</th>
                                <th>O Dia</th>
                                <th>Per.</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @isset($allMotors)
                                {{-- {{ $allMotors }} --}}
                                @foreach ($allMotors as $motor)
                                    <tr>
                                        <td>{{ $motor->fldsno }}</td>
                                        <td>{{ $motor->fldmtype }}</td>
                                        <td>{{ $motor->fldbore }}</td>
                                        <td>{{ $motor->fldhp }}</td>
                                        <td>{{ $motor->fldkw }}</td>
                                        <td>{{ $motor->fldphase }}</td>
                                        <td>{{ $motor->fldmeff }}</td>
                                        <td>{{ $motor->fldfspeed }}</td>
                                        <td>{{ $motor->fldfcur }}</td>
                                        <td>{{ $motor->fldstorque }}</td>
                                        <td>{{ $motor->fldlcur }}</td>
                                        <td>{{ $motor->flddshaft }}</td>
                                        <td>{{ $motor->fldext }}</td>
                                        <td>{{ $motor->fldsdia }}</td>
                                        <td>{{ $motor->fldcon }}</td>
                                        <td>{{ $motor->fldodia }}</td>
                                        <td>{{ $motor->fldper }}</td>
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
    </div>

    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('9283_masterDeclaredValuesUpdate') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col m4 pl-5 pr-5">
                        <span>Serial No.</span>
                        <input class="input-field" id="serialNo" placeholder="Serial No." required autofocus
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Motor Type Type</span>
                        <input class="input-field" id="motorType" placeholder="Motor Type" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Bore size (mm)</span>
                        <input class="input-field" name="boreSize" id="boreSize" placeholder="Bore Size" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>H.P.</span>
                        <input class="input-field" name="hp" id="hp" placeholder="H.P." required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>K.W.</span>
                        <input class="input-field" name="kw" id="kw" placeholder="K.W." required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <div class="input-field col s12">
                            <select required name="phase" id="phase">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="SINGLE">SINGLE</option>
                                <option value="THREE">THREE</option>
                            </select>
                            <label>Phase</label>
                        </div>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Minimum Efficiency (&percnt;)</span>
                        <input class="input-field" name="minEff" id="minEff" placeholder="Minimum Efficiency (&percnt;)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Minimum Full Load Speed (RPM)</span>
                        <input class="input-field" name="minFullLoadSpeed" id="minFullLoadSpeed"
                            placeholder="Minimum Full Load Speed (RPM)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Minimum Full Load Speed (RPM)</span>
                        <input class="input-field" name="minFullLoadCurr" id="minFullLoadCurr"
                            placeholder="Minimum Full Load Speed (RPM)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Maximum Starting Torque (&percnt;)</span>
                        <input class="input-field" name="maxStartTorque" id="maxStartTorque"
                            placeholder="Maximum Starting Torque (&percnt;)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Maximum Leakage Current (A)</span>
                        <input class="input-field" name="maxLeakCurr" id="maxLeakCurr"
                            placeholder="Maximum Leakage Current (A)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Dia of the shaft (mm)</span>
                        <input class="input-field" name="diaShaft" id="diaShaft" placeholder="Dia of the shaft (mm)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Shaft Extension run out (mm)</span>
                        <input class="input-field" name="shaftExtRunout" id="shaftExtRunout"
                            placeholder="Shaft Extension run out (mm)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Spigot Dia (mm)</span>
                        <input class="input-field" name="spigotDia" id="spigotDia" placeholder="Spigot Dia (mm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Concentricity (mm)</span>
                        <input class="input-field" name="concentricity" id="concentricity"
                            placeholder="Concentricity (mm)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Outside Dia (mm)</span>
                        <input class="input-field" name="outsideDia" id="outsideDia" placeholder="Outside Dia (mm)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Perpendicularity (mm)</span>
                        <input class="input-field" name="perpendicularity" id="perpendicularity"
                            placeholder="Perpendicularity (mm)" required autocomplete="on">
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
            $(window).keydown(function(event){
                if (event.keyCode === 13 && event.target.nodeName === 'INPUT') {
                    var form = event.target.form;
                    var index = Array.prototype.indexOf.call(form, event.target);
                    form.elements[index + 1].focus();
                    event.preventDefault();
                }
            });
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif

        });

        function edit(motor) {
            console.log(motor);
            $('#id').val(motor.id);
            $('#serialNo').val(motor.fldsno);
            $('#motorType').val(motor.fldmtype);
            $('#boreSize').val(motor.fldbore);
            $('#hp').val(motor.fldhp);
            $('#kw').val(motor.fldkw);
            $('#phase').val(motor.fldphase);
            $('#minEff').val(motor.fldmeff);
            $('#minFullLoadSpeed').val(motor.fldfspeed);
            $('#minFullLoadCurr').val(motor.fldfcur);
            $('#maxStartTorque').val(motor.fldstorque);
            $('#maxLeakCurr').val(motor.fldlcur);
            $('#diaShaft').val(motor.flddshaft);
            $('#shaftExtRunout').val(motor.fldext);
            $('#spigotDia').val(motor.fldsdia);
            $('#concentricity').val(motor.fldcon);
            $('#outsideDia').val(motor.fldodia);
            $('#perpendicularity').val(motor.fldper);
        }

        $('#listMotorTypes').change(function(e) {
            let selectedMotors = e.target.value;
            window.location.href = "{{ URL::to('9283/master/declared_values') }}" + "/" + selectedMotors;
        });

        $('#motorListAll').change(function(e) {
            window.location.href = "{{ URL::to('9283/master/declared_values') }}";
        })

        if (window.location.href.indexOf("declared_values/") > -1) {
            $('input[name="motorWiseOrList"]').first().attr('checked', 'checked');
            let options = $('#listMotorTypes option');
            @isset($allMotors)
                for (let i = 0; i < options.length; i++) { const opt=options[i]; let
                    motorType='{{ count($allMotors) > 0 ? $allMotors[0]->fldmtype : 0 }}' ; if (opt.value==motorType) {
                opt.setAttribute('selected', 'selected' ); } } @endisset
            $('select').formSelect();
        } else {
            $('input[name="motorWiseOrList"]').first().removeAttr('checked');
        }
    </script>
@endsection
