@extends('includes.master')
<title>Help - Software Working Procedure</title>
@php
$rId = 53;
$rMain = 5;
@endphp

@section('content')
    <h4 class="m-4 white-text">Help - Software Working Procedure</h4>
    <div class="container">

        <div class="row">
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-3 pb-2">
                        <h4 class="center light-blue-text text-darken-1">Working Procedure for Monoblock Pumps (IS:9283)
                        </h4>
                        <div class="p-3">
                            <h5><u>Motor Entry Procedure</u></h5>
                            <h6><u>Motor Declared Values</u></h6>

                            <ol>
                                <li>
                                    <dt>Open Motor Declared values Form from the menu</dt>
                                    <dd>Master -> Declared Values</dd>
                                </li>
                                <li>To enter the new declared values, click <span class="materialize-red-text">NEW</span>
                                    button and automatically the cursor will be in Serial number.</li>
                                <li>Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.</li>
                                <li>Before pressing <span class="materialize-red-text">SAVE</span> button verify whether
                                    all values are given.</li>
                                <li>To fill another type, click <span class="materialize-red-text">NEW</span> button and
                                    repeat the above procedure.</li>
                                <li>To modify the value of an existing type click <span
                                        class="materialize-red-text">LIST</span>, click <span
                                        class="materialize-red-text">LISTALL</span> option button, select
                                    the type in the list and then click <span class="materialize-red-text">MODIFY</span>
                                    button.</li>
                                <li>Now the values of the selected type can be viewed, here any values can be changed and
                                    saved here.</li>
                            </ol>

                            <h6><u>Motor Testing</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Motor Testing Form from the menu</dt>
                                    <dd>Entry -> Motor Entry</dd>
                                </li>
                                <li>To enter new Motor testing values, click <span class="materialize-red-text">NEW</span>
                                    button and automatically the cursor will be in Motor number.</li>
                                <li>Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.</li>
                                <li>Before pressing <span class="materialize-red-text">SAVE</span> button verify whether
                                    all values are given.</li>
                                <li>To fill another Motor number, click <span class="materialize-red-text">NEW</span>
                                    button and repeat the above procedure.</li>
                                <li>To modify the value of an existing Motor number click <span
                                        class="materialize-red-text">OPEN</span> button. Select the Motor Type and Motor
                                    number and click <span class="materialize-red-text">OK</span> button.</li>
                                <li>The values for the selected Motor number can be viewed. Here any values can be changed
                                    and saved.</li>

                                <li>After clicking the <span class="materialize-red-text">SAVE</span> button, the result for
                                    the performance of the Motor [Pass/Fail] is shown.</li>

                                <li>To view the Report for the selected Motor number click <span
                                        class="materialize-red-text">REPORT</span> button and here printout can be taken.
                                </li>

                                <li>The <span class="materialize-red-text">CUSTOMIZE REPORT</span> button is used to view
                                    the report for the selected Motor Type between the given two dates.</li>

                                <li>Select the Motor type, select the From and To date and click <span
                                        class="materialize-red-text">OK</span> button.</li>

                                <li>The values are displayed and can be taken printout.</li>
                            </ol>

                            <h5><u>REPORTS</u></h5>
                            <h6><u>Maximum & Minimum Values Report</u></h6>

                            <ol>
                                <li>
                                    <dt>To open Maximum & Minimum values Report for Motor types, click</dt>
                                    <dd>Report -> Motor Maximum Minimum Values Report</dd>
                                </li>
                                <li>This report is used to find the Maximum & Minimum values for Full Load Torque (FLT),
                                    Efficiency and Current in between two dates for all types with corresponding Motor
                                    numbers.</li>
                                <li>Using this report, we can find out the performance of the motors between any of the
                                    given two dates.</li>
                                <li>Select the FROM an TO dates for which the report is required. Click <span
                                        class="materialize-red-text">OK</span> button.</li>
                                <li>Now the values will be displayed.</li>
                                <li>If there is no Motor readings available between the given two dates, an error message of
                                    "No records available in this period of date" will be displayed.</li>
                                <li>Click <span class="materialize-red-text">REPORT</span> button to take the printout.
                                </li>
                            </ol>

                            <h6><u>Observed values Report</u></h6>
                            <ol>
                                <li>
                                    <dt>To open motor observed values report for particular Motor type, click</dt>
                                    <dd>Report -> Motor Observed values Report</dd>
                                </li>
                                <li>This report is used to take report for observed values of a particular motor type
                                    between given two dates.</li>
                                <li>From this report only, we are arriving Maximum & Minimum values Report</li>
                                <li>Select the motor type, select the From and To dates for which the report is required.
                                    Click <span class="materialize-red-text">OK</span>
                                    button.</li>
                                <li>If there is no Motor readings available between the given two dates, an error message of
                                    "No records available in this period of date" will be displayed.</li>
                                <li>Click <span class="materialize-red-text">REPORT</span> button to take the printout.
                                </li>
                            </ol>
                        </div>
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
