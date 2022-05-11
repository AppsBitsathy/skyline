@extends('includes.master')
<title>Help - Help Topics</title>
@php
$rId = 61;
$rMain = 6;
@endphp

@section('content')
    {{-- <h4 class="m-4 white-text">Help - Help Topics</h4> --}}
    <div class="container">

        <div class="row">
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-3 pb-2 center light-blue-text">
                        <h2>Skyline Softwares</h2>
                        <div class="divider"></div>
                        <h4>Pump Performance Testing software</h4>
                        <h4>As Per IS 8472</h4>
                        <h4>Help Software Version 2.0</h4>
                        <h4>Skyline Softwares, Coimbatore - 641 015</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script type="text/javascript">
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
                console.log('{{ session('status') }}');
            @endif
        });
    </script>
@endsection
