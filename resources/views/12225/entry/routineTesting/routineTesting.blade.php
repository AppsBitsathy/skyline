@extends('includes.master')
<title>Entry - Routine Testing</title>
@php
$rId = 24;
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
                        <form method="POST" action="{{ route('12225_entryRoutineTestingEntry') }}">
                            @csrf
                            <div class="row">
                                <div class="col m6 pl-5 pr-5">
                                    <div class="input-field col s12">
                                        <select required name="testType" id="testTypee">
                                            <option selected value="Routine">Routine</option>
                                            <option value="Type">Type</option>
                                        </select>
                                        <label>Type of Test</label>
                                    </div>
                                </div>
                                <div class="col m6 pl-5 pr-5">
                                    <span>Choose date</span>
                                    <input class="input-field datepicker" type="text" name="date" placeholder="Choose date"
                                        required autocomplete="on">
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>General</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Pump No.</span>
                                    <input class="input-field" name="pumpNo" placeholder="Pump No." required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Inpass No.</span>
                                    <input class="input-field" name="ipNo" placeholder="Inpass No." required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <div class="input-field col s12">
                                        <select required name="pumpType">
                                            <option value="" disabled selected>Choose your option</option>
                                            @isset($pumpDD)
                                                @foreach ($pumpDD as $pump)
                                                    <option value="{{ $pump->id }}">{{ $pump->fldPtype }}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                        <label>Pump Type</label>
                                    </div>
                                </div>
                                <div class="col m12 pl-5 pr-5">
                                    <h6><u><b>Shut Off Reading</b></u></h6>
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Current (A)</span>
                                    <input class="input-field" name="sorCurr" placeholder="Current (A)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Watts (W)</span>
                                    <input class="input-field" name="sorWatts" placeholder="Watts (W)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Speed (rpm)</span>
                                    <input class="input-field" name="sorSpeed" placeholder="Speed (rpm)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Frequency (Hz)</span>
                                    <input class="input-field" name="sorFrequency" placeholder="Frequency (Hz)" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>Total Head (m)</span>
                                    <input class="input-field" name="totalHead" placeholder="Total Head" required
                                        autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5">
                                    <span>DLWL (m)</span>
                                    <input class="input-field" name="dlwl" placeholder="DLWL" required autocomplete="on">
                                </div>
                                <div id="typetestreading">
                                    <div class="col m12 pl-5 pr-5">
                                        <h6><u><b>For Type Test</b></u></h6>
                                    </div>
                                    <div class="col m1"></div>
                                    <div class="col m2">
                                        <span>Max Current (A)</span>
                                        <input class="input-field" name="maxcurr" id="emaxcurr"
                                            placeholder="Max Current (A)" autocomplete="on">
                                    </div>
                                    <div class="col m2">
                                        <span>DLWL (m)</span>
                                        <input class="input-field" name="edlwl" id="edlwl" placeholder="DLWL (m)"
                                            autocomplete="on">
                                    </div>
                                    <div class="col m2">
                                        <span>Total Head (m)</span>
                                        <input class="input-field" name="th" id="eth" placeholder="Total Head (m)"
                                            autocomplete="on">
                                    </div>
                                    <div class="col m2">
                                        <span>Discharge (Lph)</span>
                                        <input class="input-field" name="dis" id="edis" placeholder="Discharge (Lph)"
                                            autocomplete="on">
                                    </div>
                                    <div class="col m2">
                                        <span>Input Power (kW)</span>
                                        <input class="input-field" name="ipow" id="eipow" placeholder="Input Power (kW)"
                                            autocomplete="on">
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
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col m4 center-align">
                                <form action="{{ route('12225_entryRoutineTestingDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpIpNoId" id="deletePumpIpNoId">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete<i class="material-icons right">delete</i></button>
                                </form>
                            </div>
                            <div class="col m4 center-align">
                                <form action="{{ route('12225_entryRoutineTestingReport') }}" method="post"
                                    target="blank">
                                    @csrf
                                    <input type="hidden" name="reportPnoId" id="reportPnoId">
                                    <button class="btn waves-effect waves-light" disabled name="btnReport"
                                        id="btnReport">Report<i class="material-icons right">picture_as_pdf</i></button>
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
                                        <select name="listpumpnowise" id="listpumpnowise">
                                            <option value="0" disabled selected>Choose your option</option>
                                            @isset($pumpNoDD)
                                                @foreach ($pumpNoDD as $pumpNo)
                                                    <option value="{{ $pumpNo->id }}">
                                                        {{ $pumpNo->fldpno }}</option>
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
                                                    <option value="{{ $pump->id }}">{{ $pump->fldPtype }}</option>
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
                    @isset($tableData)
                        <table class="responsive-table white">
                            <thead>
                                <th colspan="14">Total Records : {{ count($tableData) }}</th>
                                <tr>
                                    {{-- <th>Sno.</th> --}}
                                    <th>Pump No.</th>
                                    <th>Inpass No.</th>
                                    <th>Pump Type</th>
                                    <th>Date</th>
                                    <th>Current</th>
                                    <th>Watts</th>
                                    <th>Speed</th>
                                    <th>Frequency</th>
                                    <th>Total Head</th>
                                    <th>DLWL</th>
                                    <th>Max. Current</th>
                                    <th>Total Head</th>
                                    <th>Discharge</th>
                                    <th>Efficiency</th>
                                    <th>Type of Test</th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- {{ $i = 1 }} --}}
                                @foreach ($tableData as $data)
                                    <tr>
                                        {{-- <td>{{ $i++ }}</td> --}}
                                        <td>{{ $data->fldpno }}</td>
                                        <td>{{ $data->fldsno }}</td>
                                        <td>{{ $data->fldPtype }}</td>
                                        <td>{{ explode(' ', $data->flddate)[0] }}</td>
                                        <td>{{ $data->fldcurr }}</td>
                                        <td>{{ $data->fldwatt1 }}</td>
                                        <td>{{ $data->fldspeed }}</td>
                                        <td>{{ $data->fldfreq }}</td>
                                        <td>{{ $data->fldthead }}</td>
                                        <td>{{ $data->flddlwl }}</td>
                                        <td>{{ $data->fldmcurr }}</td>
                                        <td>{{ $data->fldrthead }}</td>
                                        <td>{{ $data->flddis }}</td>
                                        <td>{{ $data->fldeff }}</td>
                                        <td>{{ $data->fldtest }}</td>
                                        <td><a onclick="edit({{ $tableData->find($data->id) }})" href="#editModal"
                                                class="btn waves-effect modal-trigger"><i class="material-icons">edit</i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>EDIT</h4>
            <form method="POST" action="{{ route('12225_entryRoutineTestingEntry') }}">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" id="id">
                    <div class="col m6 pl-5 pr-5">
                        <span>Motor Type</span>
                        <input class="input-field" name="testType" id="testType" readonly>
                    </div>
                    <div class="col m6 pl-5 pr-5">
                        <span>Choose date</span>
                        <input class="input-field" name="date" id="date" readonly>
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>General</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Pump No.</span>
                        <input class="input-field" name="pumpNo" id="pumpNo" readonly>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Inpass No.</span>
                        <input class="input-field" name="ipNo" id="ipNo" readonly>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Pump Type</span>
                        <input class="input-field" id="pumpType" readonly>
                        <input name="pumpType" id="ptype" type="hidden">
                    </div>
                    <div class="col m12 pl-5 pr-5">
                        <h6><u><b>Shut Off Reading</b></u></h6>
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Current (A)</span>
                        <input class="input-field" name="sorCurr" id="sorCurr" placeholder="Current (A)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Watts (W)</span>
                        <input class="input-field" name="sorWatts" id="sorWatts" placeholder="Watts (W)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Speed (rpm)</span>
                        <input class="input-field" name="sorSpeed" id="sorSpeed" placeholder="Speed (rpm)" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Frequency (Hz)</span>
                        <input class="input-field" name="sorFrequency" id="sorFrequency" placeholder="Frequency (Hz)"
                            required autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>Total Head (m)</span>
                        <input class="input-field" name="totalHead" id="totalHead" placeholder="Total Head" required
                            autocomplete="on">
                    </div>
                    <div class="col m4 pl-5 pr-5">
                        <span>DLWL (m)</span>
                        <input class="input-field" name="dlwl" id="dlwl" placeholder="DLWL" required autocomplete="on">
                    </div>
                    <div id="edittypetestreading">
                        <div class="col m12 pl-5 pr-5">
                            <h6><u><b>For Type Test</b></u></h6>
                        </div>
                        <div class="col m1 pl-5"></div>
                        <div class="col m2">
                            <span>Max Current (A)</span>
                            <input class="input-field" name="maxcurr" id="maxcurr" placeholder="Max Current (A)"
                                autocomplete="on">
                        </div>
                        <div class="col m2">
                            <span>DLWL (m)</span>
                            <input class="input-field" name="edlwl" id="edlwl1" placeholder="DLWL (m)"
                                autocomplete="on">
                        </div>
                        <div class="col m2">
                            <span>Total Head (m)</span>
                            <input class="input-field" name="th" id="th" placeholder="Total Head (m)" autocomplete="on">
                        </div>
                        <div class="col m2">
                            <span>Discharge (Lph)</span>
                            <input class="input-field" name="dis" id="dis" placeholder="Discharge (Lph)"
                                autocomplete="on">
                        </div>
                        <div class="col m2">
                            <span>Input Power (kW)</span>
                            <input class="input-field" name="ipow" id="ipow" placeholder="Input Power (kW)"
                                autocomplete="on">
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
    <div id="reportCustomDate" class="modal">
        <form method="post" action="{{ route('12225_entryRoutineTestingCustomReport') }}" id="frmCustomReportDate"
            target="blank">
            @csrf
            <div class="modal-content">
                <h4>Select date for custom report</h4>
                <div class="row">
                    <input type="hidden" name="pumpId" id="customReportPumpid">
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

            $('#typetestreading').hide();

            @isset($type)
                @isset($tableData)
                    if ('{{ $type }}' == 'ptypewise') {
                    $('#btnCustReport').removeAttr('disabled');
                    $('#customReportPumpid').val('{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}');
                    } else if ('{{ $type }}' == 'pnowise') {
                    $('#btnReport').removeAttr('disabled');
                    $('#btnDelete').removeAttr('disabled');
                    $('#deletePumpIpNoId').val('{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}');
                    $('#reportPnoId').val('{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}');
                    } else {
                    $('#btnCustReport').attr('disabled', true);
                    $('#btnReport').attr('disabled', true);
                    $('#btnDelete').attr('disabled', true);
                    }
                @endisset
            @endisset
        });


        $('#testTypee').on('change', function() {
            if (this.value == 'Type') {
                $('#typetestreading').show();
                $('#emaxcurr').attr('required', true);
                $('#edlwl1').attr('required', true);
                $('#eth').attr('required', true);
                $('#edis').attr('required', true);
                $('#eipow').attr('required', true);
            } else {
                $('#typetestreading').hide();
                $('#emaxcurr').removeAttr('required');
                $('#edlwl1').removeAttr('required');
                $('#eth').removeAttr('required');
                $('#edis').removeAttr('required');
                $('#eipow').removeAttr('required');
            }
        });

        function edit(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#testType').val(data.fldtest);
            $('#date').val(data.flddate.split(' ')[0]);
            $('#pumpNo').val(data.fldpno);
            $('#ipNo').val(data.fldsno);
            $('#pumpType').val(data.fldPtype);
            $('#ptype').val(data.pumpid);
            // $('#forCurr').val(data.fldcurr);
            // $('#forWatts').val(data.fldwatt);
            // $('#forSpeed').val(data.fldspeed);
            // $('#forFrequency').val(data.fldfreq);
            $('#sorCurr').val(data.fldcurr);
            $('#sorWatts').val(data.fldwatt1);
            $('#sorSpeed').val(data.fldspeed);
            $('#sorFrequency').val(data.fldfreq);
            $('#totalHead').val(data.fldthead);
            $('#dlwl').val(data.flddlwl);
            $('#maxcurr').val(data.fldmcurr);
            $('#edlwl1').val(data.fldrdlwl);
            $('#th').val(data.fldrthead);
            $('#dis').val(data.flddis);
            $('#ipow').val(data.fldeff);

            if (data.fldtest == 'Type') {
                $('#edittypetestreading').show();
                $('#maxcurr').attr('required', true);
                $('#dlwl').attr('required', true);
                $('#th').attr('required', true);
                $('#dis').attr('required', true);
                $('#ipow').attr('required', true);
            } else {
                $('#edittypetestreading').hide();
                $('#maxcurr').removeAttr('required');
                $('#dlwl').removeAttr('required');
                $('#th').removeAttr('required');
                $('#dis').removeAttr('required');
                $('#ipow').removeAttr('required');
            }
        }


        $('#listpumpnowise').change(function(e) {
            let selectedPno = e.target.value;
            window.location.href = "{{ URL::to('12225/entry/routine_testing') }}" + "/pumpnowise/" + selectedPno;
        });

        $('#listTypeWise').change(function(e) {
            let selectedPump = e.target.value;
            window.location.href = "{{ URL::to('12225/entry/routine_testing') }}" + "/pumptypewise/" +
                selectedPump;
        });

        $('#pumplistall').change(function(e) {
            window.location.href = "{{ URL::to('12225/entry/routine_testing') }}";
        })

        if (window.location.href.indexOf("routine_testing/pumpnowise/") > -1) {
            $('input[type=radio]:eq(0)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listpumpnowise option');
            for (let i = 0; i < options.length; i++) {
                // console.log(options[i]['outerHTML']);
                const opt = options[i];
                @isset($tableData)
                    let pumpType = '{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}';
                    if (opt.value == pumpType) {
                    opt.setAttribute('selected', 'selected');
                    }
                @endisset
            }
            $('select').formSelect();
        } else if (window.location.href.indexOf("routine_testing/pumptypewise/") > -1) {
            $('input[type=radio]:eq(1)').attr('checked', 'checked');
            // $('input[name="motorListWise"]').first().attr('checked', 'checked');
            let options = $('#listTypeWise option');
            for (let i = 0; i < options.length; i++) {
                console.log(options[i]);
                const opt = options[i];
                @isset($tableData)
                    let pumpType = '{{ count($tableData) > 0 ? $tableData[0]->id : 0 }}';
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
