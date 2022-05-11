<div class="divider"></div>
<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu1">
            <a class="collapsible-header waves-effect"><i class="material-icons left">dns</i>Master</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu11">
                        <a class="waves-effect" href="{{ route('masterPumpDeclaredValues') }}"><i
                                class="material-icons left">format_list_numbered</i>Pump Declared Values</a>
                    </li>
                    <li id="submenu12">
                        <a class="waves-effect" href="{{ route('masterMotorDeclaredValues') }}"><i
                                class="material-icons left">format_list_numbered_rtl</i>Motor
                            Declared Values</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>

<li>
    <div class="divider"></div>
</li>

<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu2">
            <a class="collapsible-header waves-effect"><i class="material-icons left">view_list</i>Entry</a>
            <div class="collapsible-body">
                <ul>
                    <li>
                        <ul class="collapsible collapsible-accordion">
                            <li id="submenu21">
                                <a class="collapsible-header waves-effect"><i
                                        class="material-icons left">looks_one</i>Pump
                                    Testing
                                    (ISI)</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li id="semisubmenu211"><a class="waves-effect pl-5"
                                                href="{{ route('entryPumpTestISIVol') }}"><i
                                                    class="material-icons left">subdirectory_arrow_right</i>Volumetric</a>
                                        </li>
                                        <li id="semisubmenu212"><a class="waves-effect pl-5"
                                                href="{{ route('entryPumpTestISIFlow') }}"><i
                                                    class="material-icons left">subdirectory_arrow_right</i>Flowmetric</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="collapsible collapsible-accordion">
                            <li id="submenu22">
                                <a class="collapsible-header waves-effect"><i
                                        class="material-icons left">looks_two</i>Pump Testing (R&D)</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li id="semisubmenu221">
                                            <a class="waves-effect pl-5" href="{{ route('entryPumpTestRDVol') }}"><i
                                                    class="material-icons left">subdirectory_arrow_right</i>Volumetric</a>
                                        </li>
                                        <li id="semisubmenu222">
                                            <a class="waves-effect pl-5" href="{{ route('entryPumpTestRDFlow') }}"><i
                                                    class="material-icons left">subdirectory_arrow_right</i>Flowmetric</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li id="submenu23">
                        <a class="waves-effect" href="{{ route('entryMotorTesting') }}"><i
                                class="material-icons left">looks_3</i>Motor Testing</a>
                    </li>
                    <li id="submenu24">
                        <a class="waves-effect" href="{{ route('entryRoutineTesting') }}"><i
                                class="material-icons left">looks_4</i>Routine
                            Testing</a>
                    </li>
                    <li id="submenu25">
                        <a class="waves-effect" href="{{ route('entryFullDetails') }}"><i
                                class="material-icons left">list_alt</i>Full
                            Details</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>

<li>
    <div class="divider"></div>
</li>

<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu3">
            <a class="collapsible-header waves-effect"><i class="material-icons">description</i>Report</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu31"><a class="waves-effect" href="{{ route('reportPumpMaxMin') }}"><i
                                class="material-icons left">import_export</i>Pump Max. Min.
                            Values Report</a>
                    </li>
                    <li id="submenu32"><a class="waves-effect" href="{{ route('reportPumpObserved') }}"><i
                                class="material-icons left">vertical_align_center</i>Pump
                            Observed Values Report</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>

<li>
    <div class="divider"></div>
</li>

<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu4">
            <a class="collapsible-header waves-effect"><i class="material-icons">compare</i>Pump
                Comparison</a>
            <div class="collapsible-body">
                <ul>
                    <li>
                        <ul class="collapsible collapsible-accordion">
                            <li id="submenu41">
                                <a class="collapsible-header waves-effect"><i
                                        class="material-icons left mr-4">compare_arrows</i>All Curve
                                    Comparison</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li id="semisubmenu411"><a class="waves-effect pl-5"
                                                href="{{ route('pumpCompareAllCurveTypewise') }}"><i
                                                    class="material-icons">subdirectory_arrow_right</i>Typewise</a>
                                        </li>
                                        <li id="semisubmenu412"><a class="waves-effect pl-5"
                                                href="{{ route('pumpCompareAllCurveAllType') }}"><i
                                                    class="material-icons">subdirectory_arrow_right</i>All
                                                Type</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <ul class="collapsible collapsible-accordion">
                                    <li id="submenu42">
                                        <a class="collapsible-header waves-effect"><i
                                                class="material-icons left mr-4">looks_one</i>Individual
                                            Curve
                                            Comparison</a>
                                        <div class="collapsible-body">
                                            <ul>
                                                <li>
                                                    <ul class="collapsible collapsible-accordion">
                                                        <li id="semisubmenu421">
                                                            <a class="collapsible-header waves-effect pl-5" href="#!"><i
                                                                    class="material-icons">subdirectory_arrow_right</i>Typewise</a>
                                                            <div class="collapsible-body">
                                                                <ul>
                                                                    <li id="supersemisubmenu4211">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveTypewiseTH') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>TotalHead</a>
                                                                    </li>
                                                                    <li id="supersemisubmenu4212">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveTypewiseOAE') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>Overall
                                                                            Efficiency</a>
                                                                    </li>
                                                                    <li id="supersemisubmenu4213">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveTypewiseI') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>Current</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul class="collapsible collapsible-accordion">
                                                        <li id="semisubmenu422">
                                                            <a class="collapsible-header waves-effect pl-5" href="#!"><i
                                                                    class="material-icons">subdirectory_arrow_right</i>All
                                                                Type</a>
                                                            <div class="collapsible-body">
                                                                <ul>
                                                                    <li id="supersemisubmenu4221">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveAllTypeTH') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>TotalHead</a>
                                                                    </li>
                                                                    <li id="supersemisubmenu4222">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveAllTypeOAE') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>Overall
                                                                            Efficiency</a>
                                                                    </li>
                                                                    <li id="supersemisubmenu4223">
                                                                        <a class="waves-effect pl-5 ml-3"
                                                                            href="{{ route('pumpCompareIndividualCurveAllTypeI') }}"><i
                                                                                class="material-icons">fiber_manual_record</i>Current</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>Typewise</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>TotalHead</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>Overall Efficiency</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>Current</a></li>
                                                                                                                                                                                                                        
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>All Type</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>TotalHead</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>Overall Efficiency</a></li>
                                                                                                                                                                                                                        <li><a class="subheader" href="#!"><i class="material-icons">cloud</i>Current</a></li> -->
                </ul>
            </div>
        </li>
    </ul>
</li>

<li>
    <div class="divider"></div>
</li>

{{-- <li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu5">
            <a class="collapsible-header waves-effect"><i class="material-icons">home_repair_service</i>Utilities</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu51"><a class="waves-effect"><i class="material-icons left">backup</i>Backup</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>

<li>
    <div class="divider"></div>
</li> --}}

<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu6">
            <a class="collapsible-header waves-effect"><i class="material-icons">help</i>Help</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu61"><a class="waves-effect" href="{{ route('helpHelpTopics') }}"><i
                                class="material-icons left">quiz</i>Help Topics</a></li>
                    <li id="submenu62"><a class="waves-effect" href="{{ route('helpErrHelpTopics') }}"><i
                                class="material-icons left">live_help</i>Error Help Topics</a></li>
                    <li id="submenu63">
                        <a class="waves-effect" href="{{ route('helpswp') }}"><i
                                class="material-icons left">account_tree</i>Software Working Procedure</a>
                    </li>
                    <!-- software working procedure export -->
                    <div class="divider"></div>
                    <li id="submenu64"><a class="waves-effect" href="{{ route('aboutSoftware') }}"><i
                                class="material-icons left">info</i>About Software</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</li>
<li>
    <div class="divider"></div>
</li>
