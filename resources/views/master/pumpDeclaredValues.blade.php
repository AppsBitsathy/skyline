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
                        <form method="POST" action="{{ route('masterPumpDeclaredValuesEntrySubmit') }}">
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
                                    <input class="input-field" name="phase" placeholder="Phase" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Voltage (V)</span>
                                    <input class="input-field" type="number" step="any" name="voltage"
                                        placeholder="Voltage (V)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Room Temperature (deg.C)</span>
                                    <input class="input-field" type="number" step="any" name="roomTemp"
                                        placeholder="Room Temperature (deg.C)" required autocomplete="on">
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
                                    <span>Overall Efficiency (&percnt;)</span>
                                    <input class="input-field" type="number" step="any" name="overallEfficiency"
                                        placeholder="Overall Efficiency (&percnt;)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Max. Current (A)</span>
                                    <input class="input-field" type="number" step="any" name="maxCurr"
                                        placeholder="Max. Current (A)" required autocomplete="on">
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
                            {{-- @foreach ($users as $user)
                                {{ $user }}
                            @endforeach --}}
                            <form id="pumpSelectionForm" method="GET" action="{{ route('masterPumpDeclaredValues') }}">
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
                                        @foreach ($allPumpsDD as $pumpType)
                                            <option value="{{ $pumpType }}">{{ $pumpType }}</option>
                                        @endforeach
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
                            <th colspan="17">Total Records: {{ count($allPumps) }}</th>
                            <tr>
                                <th>Serial No.</th>
                                <th>Pump Type</th>
                                <th>HP / kW</th>
                                <th>Suction Size (mm)</th>
                                <th>Delivery Size (mm)</th>
                                <th>Phase</th>
                                <th>Voltage (V)</th>
                                <th>Room Temperature (deg.C)</th>
                                <th>Total Head (m)</th>
                                <th>Discharge (Lps)</th>
                                <th>Overall Efficiency (&percnt;)</th>
                                <th>Max. Current (A)</th>
                                <th>Head Range 1 (m)</th>
                                <th>Head Range 2 (m)</th>
                                <th>Frequency (Hz)</th>
                                <th>Efficiency Calc.</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- {{ $allPumps }} --}}
                            @foreach ($allPumps as $pump)
                                <tr>
                                    <td>{{ $pump->fldsno }}</td>
                                    <td>{{ $pump->fldPtype }}</td>
                                    <td>{{ $pump->fldhp }}</td>
                                    <td>{{ $pump->fldSsize }}</td>
                                    <td>{{ $pump->fldDsize }}</td>
                                    <td>{{ $pump->fldPhase }}</td>
                                    <td>{{ $pump->fldVolt }}</td>
                                    <td>{{ $pump->fldRtemp }}</td>
                                    <td>{{ $pump->fldThead }}</td>
                                    <td>{{ $pump->flddis }}</td>
                                    <td>{{ $pump->fldoeff }}</td>
                                    <td>{{ $pump->fldMcurr }}</td>
                                    <td>{{ $pump->fldHeadr1 }}</td>
                                    <td>{{ $pump->fldHeadr2 }}</td>
                                    <td>{{ $pump->fldFreq }}</td>
                                    <td>{{ $pump->fldtol }}</td>
                                    <td><a onclick="edit({{ $allPumps->find($pump->id) }})" href="#editModal"
                                            class="btn waves-effect modal-trigger"><i class="material-icons">edit</i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('masterPumpDeclaredValuesUpdate') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Serial No.</span>
                        <input class="input-field" name="serialNo" id="serialNo" placeholder="Serial No." required
                            autofocus autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Pump Type</span>
                        <input class="input-field" name="pumpType" id="pumpType" placeholder="Pump Type" required
                            autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>HP/kW</span>
                        <input class="input-field" name="hpkw" id="hpkw" placeholder="HP/kW" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Suction Size (mm)</span>
                        <input class="input-field" type="number" step="any" name="suctionSize" id="suctionSize"
                            placeholder="Suction Size (mm)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Delivery Size (mm)</span>
                        <input class="input-field" type="number" step="any" name="deliverySize" id="deliverySize"
                            placeholder="Delivery Size (mm)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Phase</span>
                        <input class="input-field" name="phase" id="phase" placeholder="Phase" required
                            autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Voltage (V)</span>
                        <input class="input-field" type="number" step="any" name="voltage" id="voltage"
                            placeholder="Voltage (V)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Room Temperature (deg.C)</span>
                        <input class="input-field" type="number" step="any" name="roomTemp" id="roomTemp"
                            placeholder="Room Temperature (deg.C)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Total Head (m)</span>
                        <input class="input-field" type="number" step="any" name="totalHead" id="totalHead"
                            placeholder="Total Head (m)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Discharge (Lps)</span>
                        <input class="input-field" type="number" step="any" name="discharge" id="discharge"
                            placeholder="Discharge (Lps)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Overall Efficiency (&percnt;)</span>
                        <input class="input-field" type="number" step="any" name="overallEfficiency"
                            id="overallEfficiency" placeholder="Overall Efficiency (&percnt;)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Max. Current (A)</span>
                        <input class="input-field" type="number" step="any" name="maxCurr" id="maxCurr"
                            placeholder="Max. Current (A)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Head Range 1 (m)</span>
                        <input class="input-field" type="number" step="any" name="headRange1" id="headRange1"
                            placeholder="Head Range 1 (m)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Head Range 2 (m)</span>
                        <input class="input-field" type="number" step="any" name="headRange2" id="headRange2"
                            placeholder="Head Range 2 (m)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <span>Frequency (Hz)</span>
                        <input class="input-field" type="number" name="frequency" id="frequency"
                            placeholder="Frequency (Hz)" required autocomplete="on">
                    </div>
                    <div class="col m6 pl-5 pr-5 mt-2">
                        <div class="input-field pl-0 mt-0">
                            <span>Efficiency Calc.</span>
                            <select required name="efficiencyCalc" id="efficiencyCalc">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="With Tolerance">With Tolerance</option>
                                <option value="Without Tolerance">Without Tolerance</option>
                            </select>
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
            $('#pumpType').val(pump.fldPtype);
            $('#hpkw').val(pump.fldhp);
            $('#suctionSize').val(pump.fldSsize);
            $('#deliverySize').val(pump.fldDsize);
            $('#phase').val(pump.fldPhase);
            $('#voltage').val(pump.fldVolt);
            $('#roomTemp').val(pump.fldRtemp);
            $('#totalHead').val(pump.fldThead);
            $('#discharge').val(pump.flddis);
            $('#overallEfficiency').val(pump.fldoeff);
            $('#maxCurr').val(pump.fldMcurr);
            $('#headRange1').val(pump.fldHeadr1);
            $('#headRange2').val(pump.fldHeadr2);
            $('#frequency').val(pump.fldFreq);
            let options = $('#efficiencyCalc option');
            for (let i = 0; i < options.length; i++) {
                const opt = options[i];
                if (opt.value == pump.fldtol) {
                    opt.setAttribute('selected', 'selected');
                }
            }
            $('select').formSelect();

            // $('#serialNo').attr('disabled', 'disabled')
            // $('#pumpType').attr('disabled', 'disabled')
        }

        $('#listPumpTypes').change(function(e) {
            let selectedPump = e.target.value;
            window.location.href = "{{ URL::to('9079/master/pump_declared_values') }}" + "/" + selectedPump;
        });

        $('#pumpListAll').change(function(e) {
            window.location.href = "{{ URL::to('9079/master/pump_declared_values') }}";
        })

        if (window.location.href.indexOf("pump_declared_values/") > -1) {
            $('input[name="pumpWiseOrList"]').first().attr('checked', 'checked');
            let options = $('#listPumpTypes option');
            for (let i = 0; i < options.length; i++) {
                const opt = options[i];
                let pumpType = '{{ count($allPumps) > 0 ? $allPumps[0]->fldPtype : 0 }}';
                if (opt.value == pumpType) {
                    opt.setAttribute('selected', 'selected');
                }
            }
            $('select').formSelect();
        } else {
            $('input[name="pumpWiseOrList"]').first().removeAttr('checked');
        }
    </script>
@endsection
