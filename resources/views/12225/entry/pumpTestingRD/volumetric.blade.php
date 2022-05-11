@extends('includes.master')
<title>Entry - Pump Testing R & D - Volumetric</title>
@php
$rId = 221;
$srId = 22;
$rMain = 2;
@endphp
@section('content')
    <h4 class="m-4 white-text">Standard Values</h4>
    <div class="container">
        <div class="row">
            <!-- entry -->
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-4 pb-2">
                        <div class="row mb-4">
                            <div class="col m3 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" href="#openModal" id="btnOpen">Open
                                    <i class="material-icons right">folder</i>
                                </a>
                            </div>
                            <div class="col m3 center-align">
                                <form action="{{ route('12225_entryPumpTestRDVolDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpNo">
                                    <input type="hidden" name="deletePumpType">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m3 center-align">
                                <a class="btn waves-effect waves-light" disabled name="btnReport" id="btnReport">Report
                                    <i class="material-icons right">picture_as_pdf</i>
                                </a>
                            </div>
                            <div class="col m3 center-align">
                                <button class="btn waves-effect waves-light" disabled name="btnGraph" id="btnGraph">Graph
                                    <i class="material-icons right">multiline_chart</i>
                                </button>
                            </div>
                            <div class="col m4 center-align hide">
                                <button class="btn waves-effect waves-light" name="btnGraph" id="btnGraph">Readings
                                    Automation
                                    <i class="material-icons right">auto_stories</i>
                                </button>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('12225_entryPumpTestRDVolAdd') }}">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Pump No</span>
                                    <input class="input-field" name="pumpNo" placeholder="Enter Pump No" required
                                        autocomplete="on" id="pumpNo">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Inpass No</span>
                                    <input class="input-field" name="inpassNo" id="inpassNo"
                                        placeholder="Enter Impass No" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <div class="input-field pl-0 m-0">
                                        <span>Pump Type</span>
                                        <select required name="pumpType" id="pumpType">
                                            <option value="" disabled selected>Choose your option</option>
                                            @isset($allPumps)
                                                @foreach ($allPumps as $pumpNo => $pumpType)
                                                    <option value="{{ $pumpNo }}">{{ $pumpType }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="pumpType" id="hidePumpType">
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Rated Speed</span>
                                    <input class="input-field" name="ratedSpeed" id="ratedSpeed"
                                        placeholder="Enter Rated Speed" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>WMC</span>
                                    <input class="input-field" name="wmc" placeholder="Enter WMC" required
                                        autocomplete="on" id="wmc">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>AMC</span>
                                    <input class="input-field" name="amc" placeholder="Enter AMC" required
                                        autocomplete="on" id="amc">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Coll. Tank Vol.</span>
                                    <input class="input-field" name="collTankVol" id="collTankVol"
                                        placeholder="Coll. Tank Vol." required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Date</span>
                                    <input class="input-field datepicker" type="text" name="date" placeholder="Select Date"
                                        required autocomplete="on" id="date">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <div class="input-field pl-0 m-0">
                                        <span>Calc (Based on)</span>
                                        <select name="calc" required id="calc">
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="Speed">Speed</option>
                                            <option value="Frequency">Frequency</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col s12 m12 l12 p-5">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">Serial No.</th>
                                                <th>Speed</th>
                                                <th>Ejector Head Reading</th>
                                                <th>Correction Head Reading</th>
                                                <th>Pressure Gauge Reading</th>
                                                <th>Time</th>
                                                <th>Voltage</th>
                                                <th>Current</th>
                                                <th>Watts</th>
                                                <th>Frequency</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr id="row1">
                                                <td>1</td>
                                                <td><input type="text" name="speed[]" id="tblSpeed" required></td>
                                                <td><input type="text" name="ejectGaugeReading[]" id="tblEGauge" required>
                                                </td>
                                                <td><input type="text" name="correctGaugeReading[]" id="tblCGauge" required>
                                                </td>
                                                <td><input type="text" name="pressureGaugeReading[]" id="tblPGauge"
                                                        required></td>
                                                <td><input type="text" name="time[]" id="tblTime" required></td>
                                                <td><input type="text" name="voltage[]" id="tblVolt" required></td>
                                                <td><input type="text" name="current[]" id="tblCurr" required></td>
                                                <td><input type="text" name="watts[]" id="tblwatts" required></td>
                                                <td><input type="text" name="frequency[]" id="tblFreq" required></td>
                                                <td><a id="addRow" class="btn waves-effect blue"><i
                                                            class="material-icons">add</i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col m12 center mt-4">
                                    <input class="btn btn-primary" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- open modal --}}
        <div id="openModal" class="modal">
            {{-- {{  }} --}}
            <form method="GET" action="{{ route('12225_entryPumpTestRDVol') }}" id="frmOpen">
                <div class="modal-content">
                    <h4>Open</h4>
                    <div class="row">
                        <div class="col m6 center-align">
                            <input type="hidden" value="open" name="mode">
                            <div class="input-field">
                                <select required name="oPumpType" id="ddOpenPumpType">
                                    <option value="" disabled selected>Choose your option</option>
                                    @isset($allPumps)
                                        @foreach ($allPumps as $pumpNo => $pumpType)
                                            <option value="{{ $pumpNo }}">{{ $pumpType }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                                <label>Choose pump type</label>
                            </div>
                        </div>
                        <div class="col m6 center-align">
                            <div class="input-field">
                                <select required name="oPumpNo" id="ddOpenPumpNo">
                                    {{-- @isset($allEntryValues)
                                        @foreach ($allEntryValues as $pumpNo => $pumpSno)
                                            <option value="{{ $pumpSno }}">{{ $pumpNo }}</option>
                                        @endforeach
                                    @endisset --}}
                                </select>
                                <label>Choose pump no.</label>
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

        <div id="coOrdinatesModal" class="modal">
            <form method="GET" action="{{ route('12225_entryPumpTestRDVolGraphG1') }}" id="frmCoord">
                <div class="modal-content">
                    <h4>Co-ordinate Values</h4>
                    <div class="row">
                        <input type="hidden" value="coord" name="mode">
                        <input type="hidden" value="" name="coPumpNo">
                        <input type="hidden" value="" name="coPumpType">
                        <input type="hidden" value="Volumetric" name="gType">
                        <div class="input-field col m6">
                            <span>Enter the unit for Discharge (X-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="xaxis">
                        </div>
                        <div class="input-field col m6">
                            <span>Enter the unit for Total Head / DLWL (Y-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="yaxis1">
                        </div>
                        <div class="input-field col m6">
                            <span>Enter the unit for Input Power (Y-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="yaxis2">
                        </div>
                        <div class="input-field col m6">
                            <span>Enter the unit for Current (Y-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="yaxis3">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-green btn-flat" onclick="">ok</button>
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif

            @isset($entries)
                $('#btnDelete').attr("disabled", false);
                $('#btnReport').attr("disabled", false);
                var url = "{{ URL::to('12225/entry/pump_testing_rd/volumetric/report/pumpNo/pumpName') }}";
                url = url.replace('pumpNo', '{{ $pType }}');
                url = url.replace('pumpName', "{{ $entries[0]['fldpmno'] }}");
                $('#btnReport').attr("href", url);
                $('#btnReport').attr("target", "blank");
                $('#btnGraph').attr("disabled", false);
            
                let html = '';
            
                let tr = $('#tableBody tr');
            
                sno = tr.length + 1;
            
                sid++;
            
                @foreach ($entries as $data)
                    $('#pumpNo').val('{{ $data->fldpmno }}');
                    $('#inpassNo').val('{{ $data->fldipno }}');
                    $('#pumpType').val('{{ $pType }}');
                    $('#hidePumpType').val('{{ $pType }}');
                    $('#ratedSpeed').val('{{ $data->fldrspeed }}');
                    $('#wmc').val('{{ $data->fldwmc }}');
                    $('#amc').val('{{ $data->fldamc }}');
                    $('#collTankVol').val('{{ $data->fldvol }}');
                    $('#date').val('{{ explode(' ', $data->flddate)[0] }}');
                    $('#calc').val('{{ $data->fldcalc }}');
            
                    $('input[name="pumpNo"]').attr('readonly','readonly');
                    $('input[name="inpassNo"]').attr('readonly','readonly');
                    // $('input[name="pumpType"]').attr('disabled','disabled');
                    $('#pumpType').attr('disabled','disabled');
            
                    $('input[name="coPumpNo"]').val('{{ $entries[0]->fldpmno }}');
                    $('input[name="coPumpType"]').val('{{ $entries[0]->fldsno }}');
            
                    $('input[name="deletePumpNo"]').val('{{ $entries[0]->fldpmno }}');
                    $('input[name="deletePumpType"]').val('{{ $entries[0]->fldsno }}');
            
                    @if ($data->fldread == 1)
                        $('#tblSpeed').val('{{ $data->fldspd }}');
                        $('#tblEGauge').val('{{ $data->fldehead }}');
                        $('#tblCGauge').val('{{ $data->fldchead }}');
                        $('#tblPGauge').val('{{ $data->flddhead / 10 }}');
                        $('#tblTime').val('{{ $data->fldtime }}');
                        $('#tblVolt').val('{{ $data->fldvolt }}');
                        $('#tblCurr').val('{{ $data->fldcurr }}');
                        $('#tblwatts').val('{{ $data->fldwatts }}');
                        $('#tblFreq').val('{{ $data->fldfreq }}');
                    @else
                        {{ $dhead = $data->flddhead / 10 }}
                        {{ $curr = $data->fldcurr / $data->fldamc }}
                        html += '<tr id="row' + {{ $data->fldread }} + '">'
                            +'<td>' + {{ $data->fldread }} + '</td>'
                            +'<td><input type="text" name="speed[]" required value="'+{{ $data->fldspd }}+'"></td>'
                            +'<td><input type="text" name="ejectGaugeReading[]" required value="'+{{ $data->fldehead }}+'"></td>'
                            +'<td><input type="text" name="correctGaugeReading[]" required value="'+{{ $data->fldchead }}+'"></td>'
                            +'<td><input type="text" name="pressureGaugeReading[]" required value="'+{{ $dhead }}+'"></td>'
                            +'<td><input type="text" name="time[]" required value="'+{{ $data->fldtime }}+'"></td>'
                            +'<td><input type="text" name="voltage[]" required value="'+{{ $data->fldvolt }}+'"></td>'
                            +'<td><input type="text" name="current[]" required value="'+{{ round($curr, 2) }}+'"></td>'
                            +'<td><input type="text" name="watts[]" required value="'+{{ $data->fldwatts }}+'"></td>'
                            +'<td><input type="text" name="frequency[]" required value="'+{{ $data->fldfreq }}+'"></td>'
                            +'<td><a onclick="removeRow(' + {{ $data->fldread }} +')" class="btn waves-effect blue">'
                                    +'<i class="material-icons">remove</i></a></td>';
                            html+='</tr>';
                    @endif
                @endforeach
            
                // $('#tableBody').empty();
                $('#tableBody').append(html);
                $('#btnGraph').removeClass('disabled');
            @endisset
        });

        $('#pumpType').on('change', function(e) {
            $('#hidePumpType').val(this.value);
        });

        $('#ddOpenPumpType').on('change', function(e) {
            let selectedPump = e.target.value;
            let pumpNoOptions = $('#ddOpenPumpNo');
            let html = '';

            @isset($allEntryValues)
                @foreach ($allEntryValues as $pumpNo => $pumpSno)
                    if (selectedPump == {{ $pumpSno }}) {
                    html += '<option value="{{ $pumpNo }}">{{ $pumpNo }}</option>';
                    }
                @endforeach
            @endisset

            $('#ddOpenPumpNo').html(html);
            $('select').formSelect();
        });


        let sid = 1;
        $('#addRow').click(function(e) {
            let html = '';
            let tr = $('#tableBody tr');
            sno = tr.length + 1;
            sid++;
            html += '<tr id="row' + sno + '">';
            html += '<td>' + sno + '</td>';
            html += '<td><input type="text" name="speed[]" required></td>';
            html += '<td><input type="text" name="ejectGaugeReading[]" required></td>';
            html += '<td><input type="text" name="correctGaugeReading[]" required></td>';
            html += '<td><input type="text" name="pressureGaugeReading[]" required></td>';
            html += '<td><input type="text" name="time[]" required></td >';
            html += '<td><input type="text" name="voltage[]" required></td>';
            html += '<td><input type="text" name="current[]" required></td>';
            html += '<td><input type="text" name="watts[]" required></td>';
            html += '<td><input type="text" name="frequency[]" required></td>';
            html += '<td><a onclick="removeRow(' + sno +
                ')" class="btn waves-effect blue"><i class="material-icons">remove</i></a>';
            html += '</td>';
            html += '</tr>';

            $('#tableBody').append(html);

        });

        function removeRow(sno) {
            $('#row' + sno).remove();
            let tr = $('#tableBody tr');
            for (let i = 0; i < tr.length; i++) {
                const t = tr[i];
                console.log(t);
                let td = $(t).children();
                console.log(td[0].innerHTML);

                td[0].innerHTML = i + 1;
            }
        }

        $('#btnGraph').click(function() {

            $('#progress').removeClass('hide');

            let pno = $('input[name="coPumpNo"]').val();
            let ptype = $('input[name="coPumpType"]').val();

            $.ajax({
                url: "volumetric_getcoords/" + pno + "/" + ptype,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    // if (res.id != undefined) {
                    $('#coOrdinatesModal').modal('open');
                    $('input[name="xaxis"]').val(res.xaxis);
                    $('input[name="yaxis1"]').val(res.yaxis1);
                    $('input[name="yaxis2"]').val(res.yaxis2);
                    $('input[name="yaxis3"]').val(res.yaxis3);
                    $('#progress').addClass('hide');
                    // }
                }
            });
        });
    </script>
@endsection
