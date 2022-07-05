@extends('includes.master')
<title>Master - Pump Declared Values</title>
@php
$rMain = 1;
$rId = 11;
@endphp
@section('content')
    <h4 class="m-4 white-text">Pump Declared Values</h4>
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
                        <form method="POST" action="{{ route('12225_masterPumpDeclaredValuesEntrySubmit') }}">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5">
                                    <span>Serial No.</span>
                                    <input class="input-field" name="serialNo" placeholder="Serial No." required
                                        autofocus autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Pump Type</span>
                                    <input class="input-field" name="pumpType" placeholder="Pump Type" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>HP/kW</span>
                                    <input class="input-field" name="hpkw" placeholder="HP/kW" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Suction Size (mm)</span>
                                    <input class="input-field" type="number" step="any" name="suctionSize"
                                        placeholder="Suction Size (mm)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Discharge Size (mm)</span>
                                    <input class="input-field" type="number" step="any" name="dischargeSize"
                                        placeholder="Discharge Size (mm)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Pressure Size (mm)</span>
                                    <input class="input-field" name="pressureSize" placeholder="Pressure Size (mm)"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Total Head (m)</span>
                                    <input class="input-field" type="number" step="any" name="totalHead"
                                        placeholder="Total Head (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>DLWL (m)</span>
                                    <input class="input-field" type="number" step="any" name="dlwl"
                                        placeholder="DLWL (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Power Input (kW)</span>
                                    <input class="input-field" type="number" step="any" name="powerInput"
                                        placeholder="Power Input (kW)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Discharge (Lph)</span>
                                    <input class="input-field" type="number" step="any" name="discharge"
                                        placeholder="Discharge (Lps)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Max. Current (A)</span>
                                    <input class="input-field" type="number" step="any" name="maxCurr"
                                        placeholder="Max. Current (A)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Voltage (V)</span>
                                    <input class="input-field" type="number" step="any" name="voltage"
                                        placeholder="Voltage (V)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>DLWL Range 1 (m)</span>
                                    <input class="input-field" type="number" step="any" name="dlwlRange1"
                                        placeholder="DLWL Range 1 (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>DLWL Range 2 (m)</span>
                                    <input class="input-field" type="number" step="any" name="dlwlRange2"
                                        placeholder="DLWL Range 2 (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Min. Operting Pressure (kg/cm&#178;)</span>
                                    <input class="input-field" type="number" step="any" name="minOpertingPressure"
                                        placeholder="Min. Operting Pressure (kg/cm&#178;)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Frequency (Hz)</span>
                                    <input class="input-field" type="number" name="frequency"
                                        placeholder="Frequency (Hz)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Submergence (m)</span>
                                    <input class="input-field" type="number" step="any" name="submergence"
                                        placeholder="Submergence (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Phase</span>
                                    <input class="input-field" type="text" step="any" name="phase" placeholder="Phase"
                                        required autocomplete="on">
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
                            <form id="pumpSelectionForm" method="GET"
                                action="{{ route('12225_masterPumpDeclaredValues') }}">
                                @csrf
                                {{-- {{ method_field('put') }} --}}
                                <div class="col m6 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="pumpWiseOrList" type="radio"
                                                value="pumpTypewise" />
                                            <span>Pump Typewise</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col m6 center-align">
                                    <label class="">
                                        <input class="with-gap" name="pumpWiseOrList" id="pumpListAll" type="radio"
                                            value="pumpListAll" checked />
                                        <span>List All</span>
                                    </label>
                                </div>
                                <div class="input-field col m4 l4 offset-m4 offset-l4">
                                    <select name="listPumpTypes" id="listPumpTypes">
                                        <option value="0" disabled selected>Choose your option</option>
                                        @isset($allPumpsDD)
                                            @foreach ($allPumpsDD as $pumpType)
                                                <option value="{{ $pumpType }}">{{ $pumpType }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <label>Choose Pump type</label>
                                </div>
                                {{-- <input type="submit" class="btn btn-primary"> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll">
                    <table class="responsive-table white">
                        <thead>
                            @isset($allPumps)
                                <th colspan="17">Total Records: {{ count($allPumps) }}</th>
                            @endisset
                            <tr>
                                <th>Serial No.</th>
                                <th>Pump Type</th>
                                <th>HP / kW</th>
                                <th>Suction Size</th>
                                <th>Dis. Size</th>
                                <th>Press. Size</th>
                                <th>DLWL</th>
                                <th>Total Head</th>
                                <th>Discharge</th>
                                <th>Input Power</th>
                                <th>Voltage</th>
                                <th>Max. Current</th>
                                <th>DLWL 1</th>
                                <th>DLWL 2</th>
                                <th>M.O.P</th>
                                <th>Submergence</th>
                                <th>Frequency</th>
                                <th>Phase</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @isset($allPumps)
                                {{-- {{ $allPumps }} --}}
                                @foreach ($allPumps as $pump)
                                    <tr>
                                        <td>{{ $pump->fldsno }}</td>
                                        <td>{{ $pump->fldptype }}</td>
                                        <td>{{ $pump->fldhp }}</td>
                                        <td>{{ $pump->flddsize }}</td>
                                        <td>{{ $pump->flddisize }}</td>
                                        <td>{{ $pump->fldpsize }}</td>
                                        <td>{{ $pump->flddlwl }}</td>
                                        <td>{{ $pump->fldthead }}</td>
                                        <td>{{ $pump->flddis }}</td>
                                        <td>{{ $pump->fldpi }}</td>
                                        <td>{{ $pump->fldvolt }}</td>
                                        <td>{{ $pump->fldmcurr }}</td>
                                        <td>{{ $pump->flddlwl1 }}</td>
                                        <td>{{ $pump->flddlwl2 }}</td>
                                        <td>{{ $pump->fldmop }}</td>
                                        <td>{{ $pump->fldsub }}</td>
                                        <td>{{ $pump->fldfreq }}</td>
                                        <td>{{ $pump->fldphase }}</td>
                                        <td><a onclick="edit({{ $allPumps->find($pump->id) }})" href="#editModal"
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
            <form method="POST" action="{{ route('12225_masterPumpDeclaredValuesUpdate') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col m4 pl-5 pr-5">
                        <span>Serial No.</span>
                        <input class="input-field" name="serialNo" id="serialNo" placeholder="Serial No." required
                            autofocus autocomplete="on" disabled>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Pump Type</span>
                        <input class="input-field" name="pumpType" id="pumpType" placeholder="Pump Type" required
                            autocomplete="on" disabled>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>HP/kW</span>
                        <input class="input-field" name="hpkw" id="hpkw" placeholder="HP/kW" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Suction Size (mm)</span>
                        <input class="input-field" type="number" step="any" name="suctionSize" id="suctionSize"
                            placeholder="Suction Size (mm)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Discharge Size (mm)</span>
                        <input class="input-field" type="number" step="any" name="dischargeSize" id="dischargeSize"
                            placeholder="Discharge Size (mm)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Pressure Size (mm)</span>
                        <input class="input-field" name="pressureSize" id="pressureSize" placeholder="Pressure Size (mm)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Total Head (m)</span>
                        <input class="input-field" type="number" step="any" name="totalHead" id="totalHead"
                            placeholder="Total Head (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>DLWL (m)</span>
                        <input class="input-field" type="number" step="any" name="dlwl" id="dlwl" placeholder="DLWL (m)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Power Input (kW)</span>
                        <input class="input-field" type="number" step="any" name="powerInput" id="powerInput"
                            placeholder="Power Input (kW)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Discharge (Lph)</span>
                        <input class="input-field" type="number" step="any" name="discharge" id="discharge"
                            placeholder="Discharge (Lps)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Max. Current (A)</span>
                        <input class="input-field" type="number" step="any" name="maxCurr" id="maxCurr"
                            placeholder="Max. Current (A)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Voltage (V)</span>
                        <input class="input-field" type="number" step="any" name="voltage" id="voltage"
                            placeholder="Voltage (V)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>DLWL Range 1 (m)</span>
                        <input class="input-field" type="number" step="any" name="dlwlRange1" id="dlwlRange1"
                            placeholder="Head Range 1 (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>DLWL Range 2 (m)</span>
                        <input class="input-field" type="number" step="any" name="dlwlRange2" id="dlwlRange2"
                            placeholder="Head Range 2 (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Min. Operting Pressure (kg/cm&#178;)</span>
                        <input class="input-field" type="number" step="any" name="minOpertingPressure"
                            id="minOpertingPressure" placeholder="Min. Operting Pressure (kg/cm&#178;)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Frequency (Hz)</span>
                        <input class="input-field" type="number" name="frequency" id="frequency"
                            placeholder="Frequency (Hz)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Submergence (m)</span>
                        <input class="input-field" type="number" step="any" name="submergence" id="submergence"
                            placeholder="Submergence (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Phase</span>
                        <input class="input-field" type="text" step="any" name="phase" id="phase" placeholder="Phase"
                            required autocomplete="on">
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

        function edit(pump) {
            console.log(pump);
            $('#id').val(pump.id);
            $('#serialNo').val(pump.fldsno);
            $('#pumpType').val(pump.fldptype);
            $('#hpkw').val(pump.fldhp);
            $('#suctionSize').val(pump.flddsize);
            $('#dischargeSize').val(pump.flddisize);
            $('#pressureSize').val(pump.fldpsize);
            $('#totalHead').val(pump.fldthead);
            $('#dlwl').val(pump.flddlwl);
            $('#powerInput').val(pump.fldpi);
            $('#discharge').val(pump.flddis);
            $('#maxCurr').val(pump.fldmcurr);
            $('#voltage').val(pump.fldvolt);
            $('#dlwlRange1').val(pump.flddlwl1);
            $('#dlwlRange2').val(pump.flddlwl2);
            $('#minOpertingPressure').val(pump.fldmop);
            $('#frequency').val(pump.fldfreq);
            $('#submergence').val(pump.fldsub);
            $('#phase').val(pump.fldphase);
        }

        $('#listPumpTypes').change(function(e) {
            let selectedPump = e.target.value;
            window.location.href = "{{ URL::to('12225/master/pump_declared_values') }}" + "/" + selectedPump;
        });

        $('#pumpListAll').change(function(e) {
            window.location.href = "{{ URL::to('12225/master/pump_declared_values') }}";
        })

        if (window.location.href.indexOf("pump_declared_values/") > -1) {
            $('input[name="pumpWiseOrList"]').first().attr('checked', 'checked');
            let options = $('#listPumpTypes option');
            @isset($allPumps)
                for (let i = 0; i < options.length; i++) { const opt=options[i]; let
                    pumpType='{{ count($allPumps) > 0 ? $allPumps[0]->fldptype : 0 }}' ; if (opt.value==pumpType) {
                opt.setAttribute('selected', 'selected' ); } } @endisset
            $('select').formSelect();
        } else {
            $('input[name="pumpWiseOrList"]').first().removeAttr('checked');
        }
    </script>
@endsection
