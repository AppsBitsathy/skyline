@extends('includes.master')
<title>Help - Error Help Topics</title>
@php
$rId = 62;
$rMain = 6;
@endphp

@section('content')
    <h4 class="m-4 white-text">Help - Error Help Topics</h4>
    <div class="container">

        <div class="row">
            <div class="col m12">
                <ul class="collapsible white">
                    <h5 class="pl-2">Errors :-</h5>
                    <hr>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">quiz</i>Data Type Conversion Error
                        </div>
                        <div class="collapsible-body">
                            <ol type="a">
                                <li>
                                    A very large size data have been Entered.</li>
                                <li>A character type data have been entered in the numeric fields.</li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">quiz</i>Permission Denied</div>
                        <div class="collapsible-body">
                            <ol type="a">
                                <li>Check whether the Destination path is correct or not.</li>
                                <li>Check whether the destination folder is Read Only.</li>
                                <li>Check whether database file is already open.</li>
                                <li>Check whether the database name is already available in the Destination folder. First
                                    delete that database in the destination folder and take backup.</li>
                                <li>Check whether the floppy disk is write protected.</li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">quiz</i>Device Unavailable</div>
                        <div class="collapsible-body">
                            <ol>
                                <li>Floppy disk is not present in the drive.</li>
                                <li>Insert a floppy disk and then take Backup.</li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">quiz</i>Disk Full</div>
                        <div class="collapsible-body">
                            <ol>
                                <li>Floppy disk capacity is less than the database capacity.</li>
                            </ol>
                        </div>
                    </li>
                    <li>
                        <div class="collapsible-header"><i class="material-icons">quiz</i>Fill in the Required Fields
                        </div>
                        <div class="collapsible-body">
                            <ol>
                                <li>Check whether all the fields contain correct details.</li>
                                <li>In the Pump entry, the save button must be clicked when the cursor is at the end of
                                    readings last field</li>
                                <li>In the Pump entry, check if any reading is blank.</li>
                            </ol>
                        </div>
                    </li>
                </ul>
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
