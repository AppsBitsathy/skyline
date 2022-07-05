@extends('includes.master')
<title>Report - Pump Observed Values</title>
@php
$rId = 32;
$rMain = 3;
@endphp

@section('content')
    <h4 class="m-4 white-text">Report - Pump Observed Values</h4>
    <div class="container">
        <div class="row center-align">
            <div class="card p-3">
                <div class="card-body">
                    <form method="POST" action="{{ route('6595_reportPumpObservedFetch') }}" id="frmReportDate"
                        target="blank">
                        @csrf
                        <div class="row">
                            <div class="col m3">
                                <div class="input-field">
                                    <select required name="pumpType">
                                        <option value="" disabled selected>Choose your option</option>
                                        @isset($pumpDD)
                                            @foreach ($pumpDD as $pump)
                                                <option value="{{ $pump->fldsno }}">{{ $pump->fldptype }}</option>
                                            @endforeach
                                        @endisset
                                    </select>
                                    <label>Pump Type</label>
                                </div>
                            </div>
                            <div class="input-field col m3">
                                <select name="isitype" id="isitype" required>
                                    <option value="" disabled selected>Choose your option</option>
                                    <option value="ISI">ISI</option>
                                    <option value="Non ISI">Non ISI</option>
                                </select>
                                <label>Type</label>
                            </div>
                            <div class="col m3">
                                <span>Start Date</span>
                                <input class="input-field" name="startDate" type="date" required autocomplete="on">
                            </div>
                            <div class="col m3">
                                <span>To Date</span>
                                <input class="input-field" name="toDate" type="date" required autocomplete="on">
                            </div>
                        </div>
                        <div class="">
                            <button class="waves-effect waves-green btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
        });
    </script>
@endsection
