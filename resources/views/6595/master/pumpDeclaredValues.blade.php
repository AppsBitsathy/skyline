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
                        <form method="POST" action="{{ route('6595_masterPumpDeclaredValuesEntrySubmit') }}">
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
                                    <span>Delivery Size (mm)</span>
                                    <input class="input-field" type="number" step="any" name="deliverySize"
                                        placeholder="Delivery Size (mm)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Phase</span>
                                    <input class="input-field" type="text" step="any" name="phase" placeholder="Phase"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Voltage (V)</span>
                                    <input class="input-field" type="number" step="any" name="voltage"
                                        placeholder="Voltage (V)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Room Temperature (&#x2103;)</span>
                                    <input class="input-field" type="number" step="any" name="roomTemp"
                                        placeholder="Room Temperature (&#x2103;)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Total Head (m)</span>
                                    <input class="input-field" type="number" step="any" name="totalHead"
                                        placeholder="Total Head (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Discharge (Lps)</span>
                                    <input class="input-field" type="number" step="any" name="discharge"
                                        placeholder="Discharge (Lps)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Pump Efficiency (&percnt;)</span>
                                    <input class="input-field" type="number" step="any" name="eff"
                                        placeholder="Pump Efficiency (&percnt;)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Input Power (kW)</span>
                                    <input class="input-field" type="number" step="any" name="maxCurr"
                                        placeholder="Input Power (kW)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Head Range 1 (m)</span>
                                    <input class="input-field" type="number" step="any" name="headRange1"
                                        placeholder="Head Range 1 (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Head Range 2 (m)</span>
                                    <input class="input-field" type="number" step="any" name="headRange2"
                                        placeholder="Head Range 2 (m)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Frequency (Hz)</span>
                                    <input class="input-field" type="number" name="frequency"
                                        placeholder="Frequency (Hz)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <div class="input-field col s12">
                                        <select required name="efficiencyCalc">
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="With Tolerance">With Tolerance</option>
                                            <option value="Without Tolerance">Without Tolerance</option>
                                        </select>
                                        <label>Efficiency Calc.</label>
                                    </div>
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
                                action="{{ route('6595_masterPumpDeclaredValues') }}">
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
                                <th>Delivery Size</th>
                                <th>Phase</th>
                                <th>Room Temp.</th>
                                <th>Total Head</th>
                                <th>Discharge</th>
                                <th>Pump Eff.</th>
                                <th>Voltage</th>
                                <th>Input Power</th>
                                <th>Head Range 1</th>
                                <th>Head Range 2</th>
                                <th>Frequency</th>
                                <th>Efficiency Calc.</th>
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
                                        <td>{{ $pump->fldssize }}</td>
                                        <td>{{ $pump->flddsize }}</td>
                                        <td>{{ $pump->fldphase }}</td>
                                        <td>{{ $pump->fldrtemp }}</td>
                                        <td>{{ $pump->fldthead }}</td>
                                        <td>{{ $pump->flddis }}</td>
                                        <td>{{ $pump->fldoeff }}</td>
                                        <td>{{ $pump->fldvolt }}</td>
                                        <td>{{ $pump->fldmcurr }}</td>
                                        <td>{{ $pump->fldheadr1 }}</td>
                                        <td>{{ $pump->fldheadr2 }}</td>
                                        <td>{{ $pump->fldfreq }}</td>
                                        <td>{{ $pump->fldtol }}</td>
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
            <form method="POST" action="{{ route('6595_masterPumpDeclaredValuesUpdate') }}">
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
                        <span>Delivery Size (mm)</span>
                        <input class="input-field" type="number" step="any" name="deliverySize" id="deliverySize"
                            placeholder="Delivery Size (mm)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Phase</span>
                        <input class="input-field" type="text" step="any" name="phase" id="phase" placeholder="Phase"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Voltage (V)</span>
                        <input class="input-field" type="number" step="any" name="voltage" id="voltage"
                            placeholder="Voltage (V)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Room Temperature</span>
                        <input class="input-field" type="text" step="any" name="roomTemp" id="roomTemp"
                            placeholder="Room Temperature" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Total Head (m)</span>
                        <input class="input-field" type="number" step="any" name="totalHead" id="totalHead"
                            placeholder="Total Head (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Discharge (Lps)</span>
                        <input class="input-field" type="number" step="any" name="discharge" id="discharge"
                            placeholder="Discharge (Lps)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Pump Efficiency (&percnt;)</span>
                        <input class="input-field" type="number" step="any" name="eff" id="eff"
                            placeholder="Pump Efficiency (&percnt;)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Input Power (kW)</span>
                        <input class="input-field" type="number" step="any" name="maxCurr" id="maxCurr"
                            placeholder="Input Power (kW)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Head Range 1 (m)</span>
                        <input class="input-field" type="number" step="any" name="headRange1" id="headRange1"
                            placeholder="Head Range 1 (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Head Range 2 (m)</span>
                        <input class="input-field" type="number" step="any" name="headRange2" id="headRange2"
                            placeholder="Head Range 2 (m)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Frequency (Hz)</span>
                        <input class="input-field" type="number" name="frequency" id="frequency"
                            placeholder="Frequency (Hz)" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <div class="input-field col s12">
                            <select required name="efficiencyCalc" id="efficiencyCalc">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="With Tolerance">With Tolerance</option>
                                <option value="Without Tolerance">Without Tolerance</option>
                            </select>
                            <label>Efficiency Calc.</label>
                        </div>
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

        function edit(pump) {
            console.log(pump);
            $('#id').val(pump.id);
            $('#serialNo').val(pump.fldsno);
            $('#pumpType').val(pump.fldptype);
            $('#hpkw').val(pump.fldhp);
            $('#suctionSize').val(pump.fldssize);
            $('#deliverySize').val(pump.flddsize);
            $('#phase').val(pump.fldphase);
            $('#roomTemp').val(pump.fldrtemp);
            $('#totalHead').val(pump.fldthead);
            $('#discharge').val(pump.flddis);
            $('#eff').val(pump.fldoeff);
            $('#voltage').val(pump.fldvolt);
            $('#maxCurr').val(pump.fldmcurr);
            $('#headRange1').val(pump.fldheadr1);
            $('#headRange2').val(pump.fldheadr2);
            $('#frequency').val(pump.fldfreq);
            $('#efficiencyCalc').val(pump.fldtol);
        }

        $('#listPumpTypes').change(function(e) {
            let selectedPump = e.target.value;
            window.location.href = "{{ URL::to('6595/master/pump_declared_values') }}" + "/" + selectedPump;
        });

        $('#pumpListAll').change(function(e) {
            window.location.href = "{{ URL::to('6595/master/pump_declared_values') }}";
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