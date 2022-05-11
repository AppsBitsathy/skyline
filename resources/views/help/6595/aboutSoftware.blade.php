@extends('includes.master')
<title>Help - About Software</title>
@php
$rId = 64;
$rMain = 6;
@endphp

@section('content')
    {{-- <h4 class="m-4 white-text">Help - Help Topics</h4> --}}
    <div class="container">

        <div class="row">
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-3 pb-2 center light-blue-text">
                        <h4>Pump Performance Testing software</h4>
                        <h4>As Per IS 6595</h4>
                        <h5>Version 2.0</h5>
                        <h6 class="black-text">The copy right of this product is licensed to skyline softwares,
                            Coimbatore-15.</h6>
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
