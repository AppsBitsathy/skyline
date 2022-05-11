@extends('includes.master')
<title>Entry - Full Details</title>
@php
$rId = 25;
$rMain = 2;
@endphp

@section('content')
    <h4 class="m-4 white-text">Entry - Routine Testing</h4>
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
                    {{-- <div class="card-title">{{ __('Entry') }}</div> --}}
                    <div class="card-body pt-5 pb-2">
                        <form method="POST" action="{{ route('12225_entryFullDetailsEntry') }}">
                            @csrf
                            <div class="row">
                                <div class="row col m6 ">
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Serial Number</span>
                                        <input class="input-field" type="text" name="slno" placeholder="Serial Number"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Pump Number</span>
                                        <input class="input-field" type="text" name="pno" placeholder="Pump Number"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <div class="input-field">
                                            <select required name="pumpType">
                                                <option value="" disabled selected>Choose your option</option>
                                                @foreach ($pumpDD as $pump)
                                                    <option value="{{ $pump->id }}">{{ $pump->fldptype }}</option>
                                                @endforeach
                                            </select>
                                            <label>Pump Type</label>
                                        </div>
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Discharge (lps)</span>
                                        <input class="input-field" type="text" name="dis" placeholder="Discharge"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Total Head (m)</span>
                                        <input class="input-field" type="text" name="th" placeholder="Total Head"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>DLWL (m)</span>
                                        <input class="input-field" type="text" name="dlwl" placeholder="DLWL" required
                                            autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Input Power (kW)</span>
                                        <input class="input-field" type="text" name="ipow" placeholder="Input Power"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Current (amps)</span>
                                        <input class="input-field" type="text" name="curr" placeholder="Current" required
                                            autocomplete="on">
                                    </div>
                                </div>
                                <div class="row col m6">
                                    <div class="col m12 pl-5 pr-5">
                                        <h6><u><b>Balancing Test</b></u></h6>
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Rotor</span>
                                        <input class="input-field" type="text" name="rotor" placeholder="Rotor" required
                                            autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Implore</span>
                                        <input class="input-field" type="text" name="implore" placeholder="Implore"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <h6><u><b>Marked Test</b></u></h6>
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Earth</span>
                                        <input class="input-field" type="text" name="earth" placeholder="Earth" required
                                            autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Rotation</span>
                                        <input class="input-field" type="text" name="rotation" placeholder="Rotation"
                                            required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Casing test</span>
                                        <input class="input-field" type="text" name="casingTest"
                                            placeholder="Casing Test" required autocomplete="on">
                                    </div>
                                    <div class="col m12 pl-5 pr-5">
                                        <span>Tested Date</span>
                                        <input class="input-field datepicker" type="text" name="date" placeholder="Date"
                                            required autocomplete="on">
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
                    {{-- {{ $allMotorTestEntry }} --}}
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col m6 center-align">
                                <form action="{{ route('12225_entryFullDetailsDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpId" id="deletePumpId">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </form>
                            </div>
                            {{-- <div class="col m4 center-align">
                                <form action="{{ route('12225_entryRoutineTestingReport') }}" method="post" target="blank">
                                    @csrf
                                    <input type="hidden" name="reportPnoId" id="reportPnoId">
                                    <button class="btn waves-effect waves-light" disabled name="btnReport"
                                        id="btnReport">Report
                                        <i class="material-icons right">picture_as_pdf</i>
                                    </button>
                                </form>
                            </div> --}}
                            <div class="col m6 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" disabled name="btnReport"
                                    id="btnReport" href="#reportDateModal">Report
                                    <i class="material-icons right">picture_as_pdf</i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <form id="pumpSelectionForm" method="GET" action="#">
                                @csrf
                                <div class="col m4 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="pumpwiseradio" type="radio" id="pumpnowise"
                                                value="pumpnowise" />
                                            <span>Pump No. wise</span>
                                        </label>
                                    </div>
                                    <div class="input-field col m12">
                                        <select name="listInpassWise" id="listpumpnowise">
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($pumpNoDD)
                                                @foreach ($pumpNoDD as $pumpno)
                                                    <option value="{{ $pumpno->id }}">{{ $pumpno->fldpno }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Choose Pump No.</label>
                                    </div>
                                </div>
                                <div class="col m4 center-align">
                                    <div class="pb-4">
                                        <label>
                                            <input class="with-gap" name="pumpwiseradio" type="radio"
                                                id="pumptypewise" value="pumptypewise" />
                                            <span>Pump Type wise</span>
                                        </label>
                                    </div>
                                    <div class="input-field col m12">
                                        <select name="listTypeWise" id="listTypeWise">
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($pumpDD)
                                                @foreach ($pumpDD as $pump)
                                                    <option value="{{ $pump->id }}">{{ $pump->fldptype }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Choose Pump Type</label>
                                    </div>
                                </div>
                                <div class="col m4 center-align">
                                    <label class="">
                                        <input class="with-gap" name="pumpwiseradio" id="pumplistall" type="radio"
                                            value="pumplistall" checked />
                                        <span>List All</span>
                                    </label>
                                </div>
                                {{-- <input type="submit" class="btn btn-primary"> --}}
                            </form>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll">
                    <table class="responsive-table white">
                        <thead>
                            <tr>
                                <th>Serial No.</th>
                                <th>Pump No.</th>
                                <th>Pump Type</th>
                                <th>Discharge</th>
                                <th>Total Head</th>
                                <th>DLWL</th>
                                <th>Input Power</th>
                                <th>Current</th>
                                <th>Test Date</th>
                                <th>Rotor</th>
                                <th>Implore</th>
                                <th>Earth</th>
                                <th>Rotation</th>
                                <th>Casing Test</th>
                                <th></th>
                            </tr>
                        </thead>
                        @isset($tableData)
                            <tbody>
                                {{-- {{ $i = 1 }} --}}
                                @foreach ($tableData as $data)
                                    <tr>
                                        <td>{{ $data->fldsno }}</td>
                                        <td>{{ $data->fldpno }}</td>
                                        <td>{{ $data->fldPtype }}</td>
                                        <td>{{ $data->fldrdis }}</td>
                                        <td>{{ $data->fldrthead }}</td>
                                        <td>{{ $data->fldrdlwl }}</td>
                                        <td>{{ $data->fldrip }}</td>
                                        <td>{{ $data->fldcurr }}</td>
                                        <td>{{ explode(' ', $data->flddate)[0] }}</td>
                                        <td>{{ $data->fldrotor }}</td>
                                        <td>{{ $data->fldimp }}</td>
                                        <td>{{ $data->fldearth }}</td>
                                        <td>{{ $data->fldrotation }}</td>
                                        <td>{{ $data->fldctest }}</td>
                                        <td><a onclick="edit({{ $tableData->find($data->id) }})" href="#editModal"
                                                class="btn waves-effect modal-trigger"><i class="material-icons">edit</i></a>
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

    {{-- open modal --}}
    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('12225_entryFullDetailsEntry') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="row col m6 ">
                        <div class="col m12 pl-5 pr-5">
                            <span>Serial Number</span>
                            <input class="input-field" type="text" name="slno" id="slno" readonly>
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Pump Number</span>
                            <input class="input-field" type="text" name="pno" id="pno" readonly>
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Pump Type</span>
                            <input class="input-field" type="text" id="pumpType" readonly>
                            <input name="pumpType" id="ptype" type="hidden">
                            {{-- <div class="input-field">
                                <select required name="pumpType">
                                    <option value="" disabled selected>Choose your option</option>
                                    @foreach ($pumpDD as $pump)
                                        <option value="{{ $pump->id }}">{{ $pump->fldPtype }}</option>
                                    @endforeach
                                </select>
                                <label>Pump Type</label>
                            </div> --}}
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Discharge (lps)</span>
                            <input class="input-field" type="text" name="dis" id="dis" placeholder="Discharge" required
                                autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Total Head (m)</span>
                            <input class="input-field" type="text" name="th" id="th" placeholder="Total Head" required
                                autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>DLWL (m)</span>
                            <input class="input-field" type="text" name="dlwl" id="dlwl" placeholder="DLWL" required
                                autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Input Power (kW)</span>
                            <input class="input-field" type="text" name="ipow" id="ipow" placeholder="Input Power"
                                required autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Current (amps)</span>
                            <input class="input-field" type="text" name="curr" id="curr" placeholder="Current" required
                                autocomplete="on">
                        </div>
                    </div>
                    <div class="row col m6">
                        <div class="col m12 pl-5 pr-5">
                            <h6><u><b>Balancing Test</b></u></h6>
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Rotor</span>
                            <input class="input-field" type="text" name="rotor" id="rotor" placeholder="Rotor" required
                                autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Implore</span>
                            <input class="input-field" type="text" name="implore" id="implore" placeholder="Implore"
                                required autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <h6><u><b>Marked Test</b></u></h6>
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Earth</span>
                            <input class="input-field" type="text" name="earth" id="earth" placeholder="Earth" required
                                autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Rotation</span>
                            <input class="input-field" type="text" name="rotation" id="rotation" placeholder="Rotation"
                                required autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Casing test</span>
                            <input class="input-field" type="text" name="casingTest" id="casingTest"
                                placeholder="Casing Test" required autocomplete="on">
                        </div>
                        <div class="col m12 pl-5 pr-5">
                            <span>Tested Date</span>
                            <input class="input-field datepicker" type="text" name="date" id="date" placeholder="Date"
                                required autocomplete="on">
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

    {{-- open modal --}}
    <div id="reportDateModal" class="modal">
        <form method="post" action="{{ route('12225_entryFullDetailsReport') }}" id="frmReportDate" target="blank">
            @csrf
            <div class="modal-content">
                <h4>Select date for report</h4>
                <div class="row">
                    <input type="hidden" name="pumpId" id="reportPumpid">
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
    <script type="text/javascript">
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
                console.log('{{ session('status') }}');
            @endif

            @isset($type)
                @isset($tableData)
                    if ('{{ $type }}' == 'ptypewise') {
                    $('#btnReport').removeAttr('disabled');
                    $('#reportPumpid').val('{{ count($tableData) > 0 ? $tableData[0]->fldptype : 0 }}');
                    } else if ('{{ $type }}' == 'pnowise') {
                    $('#btnReport').attr('disabled', true);
                    $('#btnDelete').removeAttr('disabled');
                    $('#deletePumpId').val('{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}');
                    } else {
                    $('#btnReport').attr('disabled', true);
                    $('#btnDelete').attr('disabled', true);
                    }
                @endisset
            @endisset
        });

        function edit(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#slno').val(data.fldsno);
            $('#pumpType').val(data.fldPtype);
            $('#pno').val(data.fldpno);
            $('#ptype').val(data.fldptype);
            $('#dis').val(data.fldrdis);
            $('#th').val(data.fldrthead);
            $('#dlwl').val(data.fldrdlwl);
            $('#ipow').val(data.fldrip);
            $('#curr').val(data.fldcurr);
            $('#rotor').val(data.fldrotor);
            $('#implore').val(data.fldimp);
            $('#earth').val(data.fldearth);
            $('#rotation').val(data.fldrotation);
            $('#casingTest').val(data.fldctest);
            $('#date').val(data.flddate.split(' ')[0]);
        }

        $('#listpumpnowise').change(function(e) {
            let selectedPno = e.target.value;
            window.location.href = "{{ URL::to('12225/entry/full_details') }}" + "/pumpnowise/" + selectedPno;
        });

        $('#listTypeWise').change(function(e) {
            let selectedPump = e.target.value;
            window.location.href = "{{ URL::to('12225/entry/full_details') }}" + "/pumptypewise/" + selectedPump;
        });

        $('#pumplistall').change(function(e) {
            window.location.href = "{{ URL::to('12225/entry/full_details') }}";
        });

        if (window.location.href.indexOf("full_details/pumpnowise/") > -1) {
            $('input[type=radio]:eq(0)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listpumpnowise option');
            for (let i = 0; i < options.length; i++) {
                console.log(options[i]['outerHTML']);
                const opt = options[i];
                @isset($tableData)
                    let pumpType = '{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}';
                    if (opt.value == pumpType) {
                    opt.setAttribute('selected', 'selected');
                    }
                @endisset
            }
            $('select').formSelect();
        } else if (window.location.href.indexOf("full_details/pumptypewise/") > -1) {
            $('input[type=radio]:eq(1)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listTypeWise option');
            for (let i = 0; i < options.length; i++) {
                console.log(options[i]);
                const opt = options[i];
                @isset($tableData)
                    let pumpType = '{{ count($tableData) > 0 ? $tableData[0]->fldptype : 0 }}';
                    if (opt.value == pumpType) {
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
