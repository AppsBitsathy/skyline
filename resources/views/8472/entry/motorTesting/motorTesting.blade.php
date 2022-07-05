@extends('includes.master')
<title>Entry - Motor Testing</title>
@php
$rId = 23;
$rMain = 2;
@endphp
@section('content')
    <h4 class="m-4 white-text">Entry - Motor Testing</h4>
    <div class="container">
        <div class="row">
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
                    <div class="card-body pt-5 pb-2">
                        <form method="POST" action="{{ route('8472_entryMotorTestingEntry') }}">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5">
                                    <span>Inpass No.</span>
                                    <input class="input-field" name="ipNo" placeholder="Inpass No." required autofocus
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Serial No.</span>
                                    <input class="input-field" name="serialNo" placeholder="Motor No." required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <div class="input-field col s12">
                                        <select required name="motorType">
                                            <option value="" disabled selected>Choose your option</option>
                                            @isset($allMotorsDD)
                                                @foreach ($allMotorsDD as $motorType)
                                                    <option value="{{ $motorType->id }}">{{ $motorType->fldmtype }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Motor Type</label>
                                    </div>
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Insulation Resistance</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Before HV</span>
                                    <input class="input-field" name="irBeforeHV" placeholder="Before HV" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>After HV</span>
                                    <input class="input-field" name="irAfterHV" placeholder="After HV" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>HV Test</span>
                                    <input class="input-field" name="irhvTest" placeholder="HV Test" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Resistance Measurement</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>R1&nbsp;(ohm)</span>
                                    <input class="input-field" name="rmr1" placeholder="R1&nbsp;(ohm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>T1&nbsp;(deg)</span>
                                    <input class="input-field" name="rmt1" placeholder="T1&nbsp;(deg)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>No Load Reading</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Volts (V)</span>
                                    <input class="input-field" name="nlrVolts" placeholder="Volts (V)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Current (Amps)</span>
                                    <input class="input-field" name="nlrCurr" placeholder="Current (Amps)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Watts</span>
                                    <input class="input-field" name="nlrWatts" placeholder="Watts" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Speed (rpm)</span>
                                    <input class="input-field" name="nlrSpeed" placeholder="Speed (rpm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Frequency (Hz)</span>
                                    <input class="input-field" name="nlrFreq" placeholder="Frequency (Hz)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Locked Rotor Reading</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Volts (V)</span>
                                    <input class="input-field" name="lrrVolts" placeholder="Volts (V)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>T1 ~ T2 (Kgs)</span>
                                    <input class="input-field" name="lrrt1t2" placeholder="T1 ~ T2 (Kgs)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Pullup Torque Reading</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Volts (V)</span>
                                    <input class="input-field" name="ptrVolts" placeholder="Volts (V)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>T1 ~ T2 (Kgs)</span>
                                    <input class="input-field" name="ptrt1t2" placeholder="T1 ~ T2 (Kgs)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Temperature Rise Test at 100% Voltage</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>R2 (ohm)</span>
                                    <input class="input-field" name="trtr2" placeholder="R2 (ohm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>T2 (deg)</span>
                                    <input class="input-field" name="trtt2" placeholder="T2 (deg)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>BT (deg)</span>
                                    <input class="input-field" name="trtbt2" placeholder="BT (deg)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Temperature Rise Test at 85% Voltage</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>R3 (ohm)</span>
                                    <input class="input-field" name="trtr3" placeholder="R3 (ohm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>T3 (deg)</span>
                                    <input class="input-field" name="trtt3" placeholder="T3 (deg)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>BT (deg)</span>
                                    <input class="input-field" name="trtbt3" placeholder="BT (deg)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Casing Pr. Test & Balancing</span>
                                    <input class="input-field" name="trtCasePrtb"
                                        placeholder="Casing Pr. Test & Balancing" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Choose date</span>
                                    <input class="input-field datepicker" type="text" name="date" placeholder="Choose date"
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
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col m4 center-align">
                                <form action="{{ route('8472_entryMotorTestingDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deleteMotorIpNoId" id="deleteMotorIpNoId">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m4 center-align">
                                <form action="{{ route('8472_entryMotorTestingViewReport') }}" method="post"
                                    target="blank">
                                    @csrf
                                    <input type="hidden" name="reportInpassId" id="reportInpassId">
                                    <button class="btn waves-effect waves-light" disabled name="btnReport"
                                        id="btnReport">Report
                                        <i class="material-icons right">picture_as_pdf</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m4 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" disabled name="btnCustReport"
                                    id="btnCustReport" href="#reportCustomDate">Customize Report
                                    <i class="material-icons right">picture_as_pdf</i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <form id="motorSelectionForm" method="GET" action="#">
                                @csrf
                                <div class="col m4 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="motorListWise" type="radio"
                                                id="motorinpasswise" value="motorinpasswise" />
                                            <span>Inpass No. wise</span>
                                        </label>
                                    </div>
                                    <div class="input-field col m12">
                                        <select name="listInpassWise" id="listInpassWise">
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($allMotorsInpassDD)
                                                @foreach ($allMotorsInpassDD as $inpass)
                                                    <option value="{{ $inpass->id }}">
                                                        {{ $inpass->fldinpass }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Choose Inpass No.</label>
                                    </div>
                                </div>
                                <div class="col m4 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="motorListWise" type="radio"
                                                id="motortypewise" value="motortypewise" />
                                            <span>Motor Type wise</span>
                                        </label>
                                    </div>
                                    <div class="input-field col m12">
                                        <select name="listMotorWise" id="listMotorWise">
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($allMotorsDD)
                                                @foreach ($allMotorsDD as $motorType)
                                                    <option value="{{ $motorType->id }}">{{ $motorType->fldmtype }}
                                                    </option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Choose Motor Type</label>
                                    </div>
                                </div>
                                <div class="col m4 center-align">
                                    <label class="">
                                        <input class="with-gap" name="motorListWise" id="motorlistall" type="radio"
                                            value="motorlistall" checked />
                                        <span>List All</span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll">
                    <table class="responsive-table white">
                        @isset($allMotorTestEntry)
                            <thead>
                                <th colspan="23">Total Records : {{ count($allMotorTestEntry) }}</th>
                                <tr>
                                    {{-- <th>Sno</th> --}}
                                    <th>Serial No.</th>
                                    <th>Inpass No.</th>
                                    <th>Motor Type</th>
                                    <th>Before HV</th>
                                    <th>After HV</th>
                                    <th>HV Test</th>
                                    <th>R1 (ohm)</th>
                                    <th>T1 (deg)</th>
                                    <th>Volts</th>
                                    <th>Current</th>
                                    <th>Watts</th>
                                    <th>Speed</th>
                                    <th>Frequency</th>
                                    <th>Volts</th>
                                    <th>T1 ~ T2</th>
                                    <th>R2 (ohm)</th>
                                    <th>T2 (deg)</th>
                                    <th>BT (deg)</th>
                                    <th>R3 (ohm)</th>
                                    <th>T3 (deg)</th>
                                    <th>BT (deg)</th>
                                    <th>Casing Pr. Testing & Balancing</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- {{ $i = 1 }} --}}
                                {{-- <td>{{ $i++ }}</td> --}}
                                @foreach ($allMotorTestEntry as $motorTestEntry)
                                    <tr>
                                        <td>{{ $motorTestEntry->fldsno }}</td>
                                        <td>{{ $motorTestEntry->fldinpass }}</td>
                                        <td>{{ $motorTestEntry->fldmtype }}</td>
                                        <td>{{ $motorTestEntry->fldbeforehv }}</td>
                                        <td>{{ $motorTestEntry->fldafterhv }}</td>
                                        <td>{{ $motorTestEntry->fldhvtest }}</td>
                                        <td>{{ $motorTestEntry->fldr1 }}</td>
                                        <td>{{ $motorTestEntry->fldt1 }}</td>
                                        <td>{{ $motorTestEntry->fldnlrvolts }}</td>
                                        <td>{{ $motorTestEntry->fldcurrent }}</td>
                                        <td>{{ $motorTestEntry->fldwatts }}</td>
                                        <td>{{ $motorTestEntry->fldspeed }}</td>
                                        <td>{{ $motorTestEntry->fldfrequency }}</td>
                                        <td>{{ $motorTestEntry->fldlrrvolts }}</td>
                                        <td>{{ $motorTestEntry->fldlrrt1t2 }}</td>
                                        <td>{{ $motorTestEntry->fldr2 }}</td>
                                        <td>{{ $motorTestEntry->fldt2 }}</td>
                                        <td>{{ $motorTestEntry->fldbt240 }}</td>
                                        <td>{{ $motorTestEntry->fldr3 }}</td>
                                        <td>{{ $motorTestEntry->fldt3 }}</td>
                                        <td>{{ $motorTestEntry->fldbt204 }}</td>
                                        <td>{{ $motorTestEntry->fldcpt }}</td>
                                        <td><a onclick="edit({{ $allMotorTestEntry->find($motorTestEntry->id) }})"
                                                href="#editModal" class="btn waves-effect modal-trigger"><i
                                                    class="material-icons">edit</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endisset
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('8472_entryMotorTestingEntry') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col m4 pl-5 pr-5">
                        <span>Inpass No.</span>
                        <input class="input-field" name="ipNo" id="ipNo" readonly>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Motor No.</span>
                        <input class="input-field" name="serialNo" id="serialNo" readonly>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Motor Type</span>
                        <input class="input-field" id="motortype" readonly>
                        <input class="input-field" name="motorType" id="mtype" type="hidden">
                        {{-- <div class="input-field">
                            <select name="motorType" id="mtype">
                                <option value="0" disabled>Choose your option</option>
                                @foreach ($allMotorsDD as $motorType)
                                    <option value="{{ $motorType->id }}">{{ $motorType->fldmtype }}</option>
                                @endforeach
                            </select>
                            <label>Choose Motor Type</label>
                        </div> --}}
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Insulation Resistance</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Before HV</span>
                        <input class="input-field" name="irBeforeHV" id="irBeforeHV" placeholder="Before HV" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>After HV</span>
                        <input class="input-field" name="irAfterHV" id="irAfterHV" placeholder="After HV" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>HV Test</span>
                        <input class="input-field" name="irhvTest" id="irhvTest" placeholder="HV Test" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Resistance Measurement</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>R1&nbsp;(ohm)</span>
                        <input class="input-field" name="rmr1" id="rmr1" placeholder="R1&nbsp;(ohm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>T1&nbsp;(deg)</span>
                        <input class="input-field" name="rmt1" id="rmt1" placeholder="T1&nbsp;(deg)" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>No Load Reading</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Volts (V)</span>
                        <input class="input-field" name="nlrVolts" id="nlrVolts" placeholder="Volts (V)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Current (Amps)</span>
                        <input class="input-field" name="nlrCurr" id="nlrCurr" placeholder="Current (Amps)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Watts</span>
                        <input class="input-field" name="nlrWatts" id="nlrWatts" placeholder="Watts" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Speed (rpm)</span>
                        <input class="input-field" name="nlrSpeed" id="nlrSpeed" placeholder="Speed (rpm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Frequency (Hz)</span>
                        <input class="input-field" name="nlrFreq" id="nlrFreq" placeholder="Frequency (Hz)" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Locked Rotor Reading</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Volts (V)</span>
                        <input class="input-field" name="lrrVolts" id="lrrVolts" placeholder="Volts (V)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>T1 ~ T2 (Kgs)</span>
                        <input class="input-field" name="lrrt1t2" id="lrrt1t2" placeholder="T1 ~ T2 (Kgs)" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Pullup Torque Reading</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Volts (V)</span>
                        <input class="input-field" name="ptrVolts" id="ptrVolts" placeholder="Volts (V)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>T1 ~ T2 (Kgs)</span>
                        <input class="input-field" name="ptrt1t2" id="ptrt1t2" placeholder="T1 ~ T2 (Kgs)" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Temperature Rise Test at 100%</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>R2 (ohm)</span>
                        <input class="input-field" name="trtr2" id="trtr2" placeholder="R2 (ohm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>T2 (deg)</span>
                        <input class="input-field" name="trtt2" id="trtt2" placeholder="T2 (deg)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>BT (deg)</span>
                        <input class="input-field" name="trtbt2" id="trtbt2" placeholder="BT (deg)" required
                            autocomplete="on">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Temperature Rise Test at 85%</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>R3 (ohm)</span>
                        <input class="input-field" name="trtr3" id="trtr3" placeholder="R3 (ohm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>T3 (deg)</span>
                        <input class="input-field" name="trtt3" id="trtt3" placeholder="T3 (deg)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>BT (deg)</span>
                        <input class="input-field" name="trtbt3" id="trtbt3" placeholder="BT (deg)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Casing Pr. Test & Balancing</span>
                        <input class="input-field" name="trtCasePrtb" id="trtCasePrtb"
                            placeholder="Casing Pr. Test & Balancing" required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Choose date</span>
                        <input class="input-field datepicker" type="text" name="date" id="date" placeholder="Choose date"
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

    {{-- open modal --}}
    <div id="reportCustomDate" class="modal">
        <form method="post" action="{{ route('8472_entryMotorTestingViewCustomReport') }}" id="frmCustomReportDate"
            target="blank">
            @csrf
            <div class="modal-content">
                <h4>Select date for custom report</h4>
                <div class="row">
                    <input type="hidden" name="motorId" id="customReportMotorid">
                    <div class="col m6">
                        <span>Start Date</span>
                        <input class="input-field" name="startDate" type="date" required autocomplete="on">
                    </div>
                    <div class="col m6">
                        <span>To Date</span>
                        <input class="input-field" name="toDate" type="date" required autocomplete="on">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-green btn-flat" onclick="">ok</button>
                <a class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </form>
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
                console.log('{{ session('status') }}');
            @endif

            @isset($type)
                if ('{{ $type }}' == 'mtype') {
                $('#btnCustReport').removeAttr('disabled');
                @isset($allMotorTestEntry)
                    $('#customReportMotorid').val('{{ count($allMotorTestEntry) > 0 ? $allMotorTestEntry[0]->fldmtype : 0 }}');
                @endisset
                } else if ('{{ $type }}' == 'inpass') {
                $('#btnReport').removeAttr('disabled');
                $('#btnDelete').removeAttr('disabled');
                @isset($allMotorTestEntry)
                    $('#deleteMotorIpNoId').val('{{ count($allMotorTestEntry) > 0 ? $allMotorTestEntry[0]->id : 0 }}');
                    $('#reportInpassId').val('{{ count($allMotorTestEntry) > 0 ? $allMotorTestEntry[0]->id : 0 }}');
                @endisset
                } else {
                $('#btnCustReport').attr('disabled', true);
                $('#btnReport').attr('disabled', true);
                $('#btnDelete').attr('disabled', true);
                }
            @endisset

        });

        function edit(motor) {
            console.log(motor);
            $('#id').val(motor.id);
            $('#ipNo').val(motor.fldinpass);
            $('#serialNo').val(motor.fldsno);
            $('#motortype').val(motor.fldMotorType);
            $('#mtype').val(motor.fldmtype);
            $('#irBeforeHV').val(motor.fldbeforehv);
            $('#irAfterHV').val(motor.fldafterhv);
            $('#irhvTest').val(motor.fldhvtest);
            $('#rmr1').val(motor.fldr1);
            $('#rmt1').val(motor.fldt1);
            $('#nlrVolts').val(motor.fldnlrvolts);
            $('#nlrCurr').val(motor.fldcurrent);
            $('#nlrWatts').val(motor.fldwatts);
            $('#nlrSpeed').val(motor.fldspeed);
            $('#nlrFreq').val(motor.fldfrequency);
            $('#lrrVolts').val(motor.fldlrrvolts);
            $('#lrrt1t2').val(motor.fldlrrt1t2);
            $('#ptrVolts').val(motor.fldputvolts);
            $('#ptrt1t2').val(motor.fldputt1t2);
            $('#trtr2').val(motor.fldr2);
            $('#trtt2').val(motor.fldt2);
            $('#trtbt2').val(motor.fldbt240);
            $('#trtr3').val(motor.fldr3);
            $('#trtt3').val(motor.fldt3);
            $('#trtbt3').val(motor.fldbt204);
            $('#trtCasePrtb').val(motor.fldcpt);
            $('#date').val(motor.flddate.split(' ')[0]);
        }

        $('#listInpassWise').change(function(e) {
            let selectedInpass = e.target.value;
            window.location.href = "{{ URL::to('8472/entry/motor_testing') }}" + "/motorinpasswise/" +
                selectedInpass;
        });

        $('#listMotorWise').change(function(e) {
            let selectedMotor = e.target.value;
            window.location.href = "{{ URL::to('8472/entry/motor_testing') }}" + "/motortypewise/" +
                selectedMotor;
        });

        $('#motorlistall').change(function(e) {
            window.location.href = "{{ URL::to('8472/entry/motor_testing') }}";
        })

        if (window.location.href.indexOf("motor_testing/motorinpasswise/") > -1) {
            $('input[type=radio]:eq(0)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listInpassWise option');
            for (let i = 0; i < options.length; i++) {
                console.log(options[i]['text']);
                console.log(options[i]['value']);
                @isset($allMotorTestEntry)
                    const opt = options[i];
                    let motorType = '{{ count($allMotorTestEntry) > 0 ? $allMotorTestEntry[0]->id : 0 }}';
                    if (opt.value == motorType) {
                    opt.setAttribute('selected', 'selected');
                    }
                @endisset
            }
            $('select').formSelect();
        } else if (window.location.href.indexOf("motor_testing/motortypewise/") > -1) {
            $('input[type=radio]:eq(1)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listMotorWise option');
            for (let i = 0; i < options.length; i++) {
                console.log(options[i]);
                const opt = options[i];
                @isset($allMotorTestEntry)
                    let motorType = '{{ count($allMotorTestEntry) > 0 ? $allMotorTestEntry[0]->fldmtype : 0 }}';
                    if (opt.value == motorType) {
                    opt.setAttribute('selected', 'selected');
                    }
                @endisset
            }
            $('select').formSelect();
        } else {
            // $('input[name="motorListWise"]').first().removeAttr('checked');
        }
    </script>
@endsection
