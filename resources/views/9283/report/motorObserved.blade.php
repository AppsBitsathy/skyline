@extends('includes.master')
<title>Report - Motor Observed Values</title>
@php
$rId = 32;
$rMain = 3;
@endphp

@section('content')
    <h4 class="m-4 white-text">Report - Motor Observed Values</h4>
    <div class="container">
        <div class="row center-align">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('9283_reportMotorObservedFetch') }}" id="frmReportDate"
                        target="blank">
                        @csrf
                        <div class="row">
                            <div class="col m4">
                                <div class="input-field">
                                    <select required name="motorType">
                                        <option value="" disabled selected>Choose your option</option>
                                        @isset($motorDD)
                                            @foreach ($motorDD as $motor)
                                                <option value="{{ $motor->fldsno }}">{{ $motor->fldmtype }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <label>Motor Type</label>
                                </div>
                            </div>
                            <div class="col m4">
                                <span>Start Date</span>
                                <input class="input-field datepicker" name="startDate" type="text" required
                                    placeholder="Satrt Dtae" autocomplete="on">
                            </div>
                            <div class="col m4">
                                <span>To Date</span>
                                <input class="input-field datepicker" name="toDate" type="text" required
                                    placeholder="To Date" autocomplete="on">
                            </div>
                        </div>
                        <input class="btn" type="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
                console.log('{{ session('status') }}');
            @endif
        });
    </script>
@endsection
