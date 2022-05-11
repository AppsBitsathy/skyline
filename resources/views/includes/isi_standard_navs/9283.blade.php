<div class="divider"></div>
<li>
    <ul class="collapsible collapsible-accordion">
        <li id="menu1">
            <a class="collapsible-header waves-effect"><i class="material-icons left">dns</i>Master</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu11">
                        <a class="waves-effect" href="{{ route('9283_masterDeclaredValues') }}"><i
                                class="material-icons left">format_list_numbered</i>Declared Values</a>
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
                    <li id="submenu21">
                        <a class="waves-effect" href="{{ route('9283_entryMotorEntry') }}"><i
                                class="material-icons left">format_list_bulleted</i>Motor
                            Entry</a>
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
                    <li id="submenu31"><a class="waves-effect" href="{{ route('9283_reportMotorMaxMin') }}"><i
                                class="material-icons left">import_export</i>Motor Max. Min. Values Report</a>
                    </li>
                    <li id="submenu32"><a class="waves-effect" href="{{ route('9283_reportMotorObserved') }}"><i
                                class="material-icons left">vertical_align_center</i>Motor Observed Values Report</a>
                    </li>
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
        <li id="menu4">
            <a class="collapsible-header waves-effect"><i class="material-icons">home_repair_service</i>Utilities</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu41"><a class="waves-effect"><i class="material-icons left">backup</i>Backup</a>
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
        <li id="menu5">
            <a class="collapsible-header waves-effect"><i class="material-icons">help</i>Help</a>
            <div class="collapsible-body">
                <ul>
                    <li id="submenu51"><a class="waves-effect" href="{{ route('9283_helpHelpTopics') }}"><i
                                class="material-icons left">quiz</i>Help Topics</a></li>
                    <li id="submenu52"><a class="waves-effect" href="{{ route('9283_helpErrHelpTopics') }}"><i
                                class="material-icons left">live_help</i>Error Help Topics</a></li>
                    <li id="submenu53">
                        <a class="waves-effect" href="{{ route('9283_helpswp') }}"><i
                                class="material-icons left">account_tree</i>Software Working Procedure</a>
                    </li>
                    <!-- software working procedure export -->
                    <div class="divider"></div>
                    <li id="submenu54"><a class="waves-effect" href="{{ route('9283_aboutSoftware') }}"><i
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
