@extends('includes.master')
<title>Entry - Pump Testing RD - Flowmetric</title>
@php
$rId = 222;
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
                                <form action="{{ route('entryPumpTestRDFlowDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpNo">
                                    <input type="hidden" name="deletePumpType">
                                    <button class="btn waves-effect waves-light disabled" name="btnDelete"
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
                                <a class="btn waves-effect waves-light disabled" name="btnGraph" id="btnGraph">Graph
                                    <i class="material-icons right">multiline_chart</i>
                                </a>
                            </div>
                            <div class="col m4 center-align hide">
                                <button class="btn waves-effect waves-light" name="btnGraph" id="btnGraph">Readings
                                    Automation
                                    <i class="material-icons right">auto_stories</i>
                                </button>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('entryPumpTestRDFlowSubmit') }}" id="entryForm">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Pump No</span>
                                    <input class="input-field" type="text" name="pumpNo" placeholder="Enter Pump No"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Inpass No</span>
                                    <input class="input-field" type="text" name="inpassNo" placeholder="Enter Inpass No"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <div class="input-field pl-0 m-0">
                                        <span>Pump Type</span>
                                        <select name="pumpType" id="pumpType">
                                            <option value="" disabled selected>Choose your option</option>
                                            @foreach ($allPumps as $pump)
                                                <option value="{{ $pump }}">{{ $pump }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Rated Speed</span>
                                    <input class="input-field" type="text" name="ratedSpeed"
                                        placeholder="Enter Rated Speed" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>WMC</span>
                                    <input class="input-field" type="text" name="wmc" placeholder="Enter WMC" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>AMC</span>
                                    <input class="input-field" type="text" name="amc" placeholder="Enter AMC" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Gauge Distance</span>
                                    <input class="input-field" type="text" name="gaugeDistance"
                                        placeholder="Enter Gauge Distance" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Date</span>
                                    <input class="input-field datepicker" type="text" name="date" placeholder="Select Date"
                                        required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <div class="input-field pl-0 m-0">
                                        <span>Calc (Based on)</span>
                                        <select name="calc" id="calc">
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
                                                <th>Speed (rpm)</th>
                                                <th>Vaccum Gauge Reading (mmHg)</th>
                                                <th>Pressure Gauge Reading (kg/cm2)</th>
                                                <th>Discharge (lps)</th>
                                                <th>Voltage (V)</th>
                                                <th>Current (A)</th>
                                                <th>Watts1 (W)</th>
                                                <th>Watts2 (W)</th>
                                                <th>Frequency (Hz)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr>
                                                <td>1</td>
                                                <td><input type="text" name="speed[]"></td>
                                                <td><input type="text" name="vaccumGaugeReading[]"></td>
                                                <td><input type="text" name="pressureGaugeReading[]"></td>
                                                <td><input type="text" name="discharge[]"></td>
                                                <td><input type="text" name="voltage[]"></td>
                                                <td><input type="text" name="current[]"></td>
                                                <td><input type="text" name="watts1[]"></td>
                                                <td><input type="text" name="watts2[]"></td>
                                                <td><input type="text" name="frequency[]"></td>
                                                <td><a id="addRow" class="btn waves-effect blue"><i
                                                            class="material-icons">add</i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col m12 center mt-3">
                                    <button class="btn waves-effect">SAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- open modal --}}
        <div id="openModal" class="modal">
            <form method="GET" action="{{ route('entryPumpTestRDFlow') }}" id="frmOpen">
                <div class="modal-content">
                    <h4>Open</h4>
                    <div class="row">
                        <div class="col m6 center-align">
                            <input type="hidden" value="open" name="mode">
                            <div class="input-field">
                                <select required name="oPumpType" id="ddOpenPumpType">
                                    <option value="" disabled selected>Choose your option</option>
                                    @foreach ($allPumps as $pumpNo => $pumpType)
                                        <option value="{{ $pumpNo }}">{{ $pumpType }}</option>
                                    @endforeach
                                </select>
                                <label>Choose pump type</label>
                            </div>
                        </div>
                        <div class="col m6 center-align">
                            <div class="input-field">
                                <select required name="oPumpNo" id="ddOpenPumpNo">
                                    {{-- @foreach ($allEntryValues as $pumpNo => $pumpSno)
                                        <option value="{{ $pumpSno }}">{{ $pumpNo }}</option>
                                    @endforeach --}}
                                </select>
                                <label>Choose pump no.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="waves-effect waves-green btn-flat" onclick="">ok</button>
                    <a class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </form>
        </div>

        <div id="coOrdinatesModal" class="modal">
            <form method="GET" action="{{ route('entryPumpTestRDFlowGraphG1') }}" id="frmCoord">
                <div class="modal-content">
                    <h4>Co-ordinate Values</h4>
                    <div class="row">
                        <input type="hidden" value="coord" name="mode">
                        <input type="hidden" value="" name="coPumpNo">
                        <input type="hidden" value="" name="coPumpType">
                        <input type="hidden" value="Flowmetric" name="gType">
                        <div class="input-field col m6">
                            <span>Enter the unit for Discharge (X-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="xaxis">
                        </div>
                        <div class="input-field col m6">
                            <span>Enter the unit for Total Head (Y-Axis) 1cm</span>
                            <input placeholder="1.02" type="text" value="" name="yaxis1">
                        </div>
                        <div class="input-field col m6">
                            <span>Enter the unit for Efficiency (Y-Axis) 1cm</span>
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
                    <a class="modal-close waves-effect waves-green btn-flat">Close</a>
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

            @if (isset($entries) && count($entries) > 0)
                $('input[name="pumpNo"]').val('{{ $entries[0]->fldPno }}');
                $('input[name="inpassNo"]').val('{{ $entries[0]->fldIpNo }}');
                $('input[name="ratedSpeed"]').val('{{ $entries[0]->fldRSpeed }}');
                $('input[name="wmc"]').val('{{ $entries[0]->fldwmc }}');
                $('input[name="amc"]').val('{{ $entries[0]->fldamc }}');
                $('input[name="gaugeDistance"]').val('{{ $entries[0]->fldGDist }}');
                $('input[name="date"]').val('{{ $entries[0]->fldht }}');
                $('input[name="calc"]').val('{{ $entries[0]->fldCalc }}');
            
                $('input[name="pumpNo"]').attr('readonly','readonly');
                $('input[name="inpassNo"]').attr('readonly','readonly');
            
                $('input[name="coPumpNo"]').val('{{ $entries[0]->fldPno }}');
                $('input[name="coPumpType"]').val('{{ $entries[0]->fldSno }}');
            
                $('input[name="deletePumpNo"]').val('{{ $entries[0]->fldPno }}');
                $('input[name="deletePumpType"]').val('{{ $entries[0]->fldSno }}');
            
                let pumpTypes = $('#pumpType option');
                let calcTypes = $('#calc option');
                let pno = $('input[name="coPumpNo"]').val();
                let ptype = $('input[name="coPumpType"]').val();
            
                for (let i = 0; i < pumpTypes.length; i++) { const p=pumpTypes[i]; if (p.value=='{{ $entries[0]->fldPtype }}' ) {
                    p.setAttribute('selected','selected'); }else{ p.setAttribute('disabled','disabled'); } }; for (let i=0; i <
                    calcTypes.length; i++) { const c=calcTypes[i]; if (c.value=='{{ $entries[0]->fldCalc }}' ) {
                    c.setAttribute('selected','selected'); } }; $('select').formSelect(); let htm='' ; let tr=$('#tableBody tr');
                    @for ($i = 0; $i < count($entries); $i++)
                    if ({{ $i }} == 0) {
                    $('input[name="speed[]"]').val('{{ $entries[$i]->fldSpeed }}');
                    $('input[name="vaccumGaugeReading[]"]').val('{{ $entries[$i]->fldVGauge }}');
                    $('input[name="pressureGaugeReading[]"]').val('{{ $entries[$i]->fldPGauge }}');
                    $('input[name="discharge[]"]').val('{{ $entries[$i]->fldDis }}');
                    $('input[name="voltage[]"]').val('{{ $entries[$i]->fldVolt }}');
                    $('input[name="current[]"]').val('{{ $entries[$i]->fldCurr }}');
                    $('input[name="watts1[]"]').val('{{ $entries[$i]->fldw1 }}');
                    $('input[name="watts2[]"]').val('{{ $entries[$i]->fldw2 }}');
                    $('input[name="frequency[]"]').val('{{ $entries[$i]->fldFreq }}');
                    }else{
                    htm = '';
            
                    sno = tr.length + 1;
            
                    sid++;
            
                    htm += '<tr id="row' + sid + '">';
                        htm += '<td>{{ $entries[$i]->fldRead }}</td>';
                        htm += '<td><input type="text" name="speed[]" value="{{ $entries[$i]->fldSpeed }}"></td>';
                        htm += '<td><input type="text" name="vaccumGaugeReading[]" value="{{ $entries[$i]->fldVGauge }}"></td>';
                        htm += '<td><input type="text" name="pressureGaugeReading[]" value="{{ $entries[$i]->fldPGauge }}"></td>';
                        htm += '<td><input type="text" name="discharge[]" value="{{ $entries[$i]->fldDis }}"></td>';
                        htm += '<td><input type="text" name="voltage[]" value="{{ $entries[$i]->fldVolt }}"></td>';
                        htm += '<td><input type="text" name="current[]" value="{{ $entries[$i]->fldCurr }}"></td>';
                        htm += '<td><input type="text" name="watts1[]" value="{{ $entries[$i]->fldw1 }}"></td>';
                        htm += '<td><input type="text" name="watts2[]" value="{{ $entries[$i]->fldw2 }}"></td>';
                        htm += '<td><input type="text" name="frequency[]" value="{{ $entries[$i]->fldFreq }}"></td>';
                        htm += '<td><a id="removeRow" onclick="removeRow(' + sid + ')" class="btn waves-effect blue">'+
                                '<i class="material-icons">remove</i></a>';
                            htm += ' </td>';
                        htm += '</tr>';
            
                    $('#tableBody').append(htm);
                    }
            @endfor $('#entryForm').attr('action','{{ route('entryPumpTestRDFlowUpdate') }}');
            $('#btnGraph').removeClass('disabled'); $('#btnDelete').removeClass('disabled');
            $('#btnReport').attr("disabled", false); var
            url="{{ URL::to('9079/entry/pump_testing_rd/flowmetric/report/pumpNo/pumpName') }}" ;
            url=url.replace('pumpNo', ptype ); url=url.replace('pumpName', pno ); $('#btnReport').attr("href", url);
            $('#btnReport').attr("target", "blank" );
            @endif
        });

        let sid = 1;
        $('#addRow').click(function(e) {
            let html = '';

            let tr = $('#tableBody tr');

            sno = tr.length + 1;

            sid++;

            html += '<tr id="row' + sid + '">';
            html += '<td>' + sno + '</td>';
            html += '<td><input type="text" name="speed[]"></td>';
            html += '<td><input type="text" name="vaccumGaugeReading[]"></td>';
            html += '<td><input type="text" name="pressureGaugeReading[]"></td>';
            html += '<td><input type="text" name="discharge[]"></td>';
            html += '<td><input type="text" name="voltage[]"></td>';
            html += '<td><input type="text" name="current[]"></td>';
            html += '<td><input type="text" name="watts1[]"></td>';
            html += '<td><input type="text" name="watts2[]"></td>';
            html += '<td><input type="text" name="frequency[]"></td>';
            html += '<td><a id="removeRow" onclick="removeRow(' + sid + ')" class="btn waves-effect blue">' +
                '<i class="material-icons">remove</i></a>';
            html += '    </td>';
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

        $('#ddOpenPumpType').change((e) => {
            let selectedPump = e.target.value;

            let pumpNoOptions = $('#ddOpenPumpNo');

            let html = '';

            @foreach ($allEntryValues as $pumpNo => $pumpSno)
                if (selectedPump == {{ $pumpSno }}) {
                html += '<option value="{{ $pumpNo }}">{{ $pumpNo }}</option>';
                }
            @endforeach

            $('#ddOpenPumpNo').html(html);

            $('select').formSelect();

        })

        $('#btnGraph').click(function() {

            $('#progress').removeClass('hide');

            let pno = $('input[name="coPumpNo"]').val();
            let ptype = $('input[name="coPumpType"]').val();

            $.ajax({
                url: "flowmetric_getcoords/" + pno + "/" + ptype,
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
