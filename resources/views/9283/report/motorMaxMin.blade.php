@extends('includes.master')
<title>Report - Motor Min Max Values</title>
@php
$rId = 31;
$rMain = 3;
@endphp

@section('content')
    <h4 class="m-4 white-text">Report - Motor Max. Min. Values</h4>
    <div class="container">
        <div class="row center-align">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row m-2">
                        <div class="col m6">
                            <button class="btn waves-effect modal-trigger" data-target="reportMotorMaxMinModal"
                                id="btnReportModal">Choose dates for generate report</button>
                        </div>
                        <div class="col m6">
                            <form method="post" action="{{ route('9283_reportMotorMaxMinGetObservedValuesReport') }}"
                                target="blank">
                                @csrf
                                <input type="hidden" name="startDate" id="startDate" value="">
                                <input type="hidden" name="toDate" id="toDate" value="">
                                <input type="hidden" name="type" value="report">
                                <button class="btn waves-effect" id="btnReport" disabled>Report</button>
                            </form>
                        </div>
                    </div>
                    <div style="overflow-x: scroll">
                        <table class="responsive-table white">
                            <thead>
                                <tr>
                                    <th>Motor Type</th>
                                    <th>Max FLT</th>
                                    <th>Min FLT</th>
                                    <th>Max Eff</th>
                                    <th>Min Eff</th>
                                    <th>Max Current</th>
                                    <th>Min Current</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($observed_list)
                                    @foreach ($observed_list as $data)
                                        <tr>
                                            <td>{{ $data->motortype }}</td>
                                            <td>{{ $data->fltmax }}</td>
                                            <td>{{ $data->fltmin }}</td>
                                            <td>{{ $data->effmax }}</td>
                                            <td>{{ $data->effmin }}</td>
                                            <td>{{ $data->currmax }}</td>
                                            <td>{{ $data->currmin }}</td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- open modal --}}
    <div id="reportMotorMaxMinModal" class="modal">
        <form method="post" action="{{ route('9283_reportMotorMaxMinGetObservedValues') }}" id="frmReportDate">
            @csrf
            <div class="modal-content">
                <h4>Select date for motor min max values report</h4>
                <div class="row">
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
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
                console.log('{{ session('status') }}');
            @endif

            @isset($startDate)
                @isset($toDate)
                    $('#startDate').val('{{ $startDate }}');
                    $('#toDate').val('{{ $toDate }}');
                    $('#btnReport').attr('disabled', false);
                @endisset
            @endisset

        });
    </script>

@endsection
