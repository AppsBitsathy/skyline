@extends('includes.master')
<title>Pump Comparison - Individual Curve - Typewise - TotalHead</title>
@php
$rId = 4211;
$ssrId = 421;
$srId = 42;
$rMain = 4;
@endphp
@section('content')

    <div class="container">
        <div class="row pt-3">
            <div class="col m6 offset-m3">
                <div class="card p-4 m-4">
                    <div class="row p-3">
                        <div class="col m12 p-2">
                            <p class="m-0">
                                <label>
                                    <input type="radio" name="unitsForDischarge" class="with-gap" value="lps"
                                        checked />
                                    <span>Lps</span>
                                </label>
                            </p>
                        </div>
                        <br>
                        <div class="col m12 p-2">
                            <p class="m-0">
                                <label>
                                    <input type="radio" name="unitsForDischarge" class="with-gap" value="us/gpm" />
                                    <span>Us/gpm</span>
                                </label>
                            </p>
                        </div>
                        <br>
                        <div class="col m12 p-2">
                            <p class="m-0">
                                <label>
                                    <input type="radio" name="unitsForDischarge" class="with-gap" value="m3/hr" />
                                    <span>m<sup>3</sup>/hr</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col m6 offset-m3">
                <div class="card p-4 m-4">
                    <div class="row p-3">
                        <div class="col m12 center-align">
                            <input type="hidden" value="open" name="mode">
                            <div class="input-field">
                                <select required name="oPumpType" id="ddOpenPumpType">
                                    <option value="" disabled selected>Choose your option</option>
                                    @foreach ($allPumps as $p)
                                        <option value="{{ $p['fldsno'] }}">{{ $p['fldptype'] }}</option>
                                    @endforeach
                                </select>
                                <label>Choose pump type</label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="col m12 center-align">
                            <div class="input-field">
                                <select required name="oPumpNo" id="ddOpenPumpNo" multiple>

                                </select>
                                <label>Choose pump no.</label>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        <div class="col m12 center-align mt-4">
                            <a class="btn waves-effect" id="showGraphButtons">Graph</a>
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div id="unitForDischargeModal" class="modal" style="width: 20%">
        <div class="modal-content">
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="lps" checked />
                        <span>Lps</span>
                    </label>
                </p>
            </div>
            <br>
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="us/gpm" />
                        <span>Us/gpm</span>
                    </label>
                </p>
            </div>
            <br>
            <div class="col m3">
                <p class="m-0">
                    <label>
                        <input type="radio" name="unitsForDischarge" class="with-gap" value="m3/hr" />
                        <span>m<sup>3</sup>/hr</span>
                    </label>
                </p>
            </div>
        </div>
        <div class="modal-footer">
            <a id="setUnitsForDischarge"  class="modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div> --}}

@endsection
@section('custom-script')
    <script>
        var unitForDischarge = 1;

        var selectedXAxis = '';

        let ufd;

        $('#ddOpenPumpType').change((e) => {
            let selectedPump = e.target.value;

            let pumpNoOptions = $('#ddOpenPumpNo');

            let html = '';

            @foreach ($volumetricValues as $v)
                if (selectedPump == {{ $v->fldsno }}) {
                html += '<option value="{{ $v->fldpmno }}">{{ $v->fldpmno }}</option>';
                }
            @endforeach

            $('#ddOpenPumpNo').html(html);

            var options = $('#ddOpenPumpNo option');
            var arr = options.map(function(_, o) {
                return {
                    t: $(o).text(),
                    v: o.value
                };
            }).get();
            arr.sort(function(o1, o2) {
                return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0;
            });
            options.each(function(i, o) {
                o.value = arr[i].v;
                $(o).text(arr[i].t);
            });

            $('select').formSelect();

        });

        $('#showGraphButtons').click((e) => {

            ufd = $('input[name="unitsForDischarge"]:checked').val();
            if (ufd == 'lps') {
                unitForDischarge = 1;
            } else if (ufd == 'us/gpm') {
                unitForDischarge = 15.850323141489;
            } else if (ufd == 'm3/hr') {
                unitForDischarge = 3.6;
            }

            let selectedPumps = $('#ddOpenPumpNo').val();
            if (selectedPumps != null) {

                let pno = $('input[name="coPumpNo"]').val();
                let ptype = $('input[name="coPumpType"]').val();

                let htm = '';

                let pumpType;
                let pumpNo;
                let unit;
                let unitFD;

                selectedPumps.forEach(sp => {
                    htm += '<h5>';
                    htm += $('#ddOpenPumpType option:selected').html().toUpperCase() + ' (' + sp + ')';
                    htm += '</h5>';
                });

                pump = 'coPump=' + $('#ddOpenPumpType option:selected').html();
                pumpType = 'coPumpType=' + $('#ddOpenPumpType').val();
                pumpNo = 'coPumpNo=' + selectedPumps;
                unit = 'unitFormat=' + ufd;
                unitFD = 'unitForDischarge=' + unitForDischarge;

                window.location.href = "{{ URL::to('8472/pump_comparison/individual_curve/typewise/th/graphs/g1') }}" + "?" +
                    pump + '&' + pumpType + '&' + pumpNo + '&' + unit + '&' + unitFD;
                $('#selectedPumps').html(htm);
            } else {
                M.toast({
                    html: 'Select Pump Number',
                    classes: 'rounded'
                });
            }
        });
    </script>
@endsection
