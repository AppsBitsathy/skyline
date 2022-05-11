@extends('includes.master')
<title>Help - Software Working Procedure</title>
@php
$rId = 63;
$rMain = 6;
@endphp

@section('content')
    <h4 class="m-4 white-text">Help - Software Working Procedure</h4>
    <div class="container">

        <div class="row">
            <div class="col m12">
                <div class="card">
                    <div class="card-body pt-3 pb-2">
                        <h4 class="center light-blue-text text-darken-1">Working Procedure for Centrifugal Jet Pumps
                            (IS:14220)
                        </h4>
                        <div class="p-3">
                            <h5><u>Pump Entry Procedure</u></h5>
                            <h6><u>Pump Declared Values</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Pump Declared values Form from the menu</dt>
                                    <dd>Master -> Pump Declared Values</dd>
                                </li>
                                <li>
                                    To enter new declared values, click <span class="materialize-red-text">NEW</span>
                                    button and automatically the cursor will be in Serial number.
                                </li>
                                <li>
                                    Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.
                                    <ol type="a">
                                        <li>For volumetric method, give the collection tank volume for which the pump
                                            readings are taken.</li>
                                        <li>For Flowmetric method, give the collection tank volume as 1, if the value is
                                            not known. Here time is taken for 1 litre collection of water. If the
                                            collection tank volume is known, fill the same and time will be calculated
                                            for the given collection tank volume.</li>
                                    </ol>
                                </li>
                                <li>
                                    Before pressing <span class="materialize-red-text">SAVE</span> button verify whether
                                    all values are given.
                                </li>
                                <li>
                                    To fill another type, click <span class="materialize-red-text">NEW</span> button and
                                    repeat the above procedure.
                                </li>
                                <li>
                                    To modify the value of an existing type click <span
                                        class="materialize-red-text">LIST</span>, click <span
                                        class="materialize-red-text">LISTALL</span> option
                                    button select the type in the list and then click <span
                                        class="materialize-red-text">MODIFY</span> button.
                                </li>
                                <li>
                                    Now the values of the selected type can be viewed, any values can be changed and
                                    saved here.
                                </li>
                            </ol>

                            <h6><u>Pump Testing Entry ISI version</u></h6>

                            <ol>
                                <li>
                                    <dt>
                                        Open Pump Testing Form for ISI Entry, Volumetric method from the menu</dt>
                                    <dd>Entry -> Pump Testing ISI -> Volumetric</dd>
                                </li>
                                <li>
                                    To enter new Pump Testing values click <span class="materialize-red-text">NEW</span>
                                    Button and the cursor will be
                                    automatically in Pump Number.
                                </li>
                                <li>
                                    Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.
                                </li>
                                <li>
                                    While filling the values, select the Pump Type and Date.
                                </li>
                                <li>
                                    Before pressing <span class="materialize-red-text">SAVE</span> button, verify whether
                                    all values are given.
                                </li>
                                <li>
                                    To fill another entry press <span class="materialize-red-text">NEW</span> button and
                                    repeat the procedure.
                                </li>
                                <li>
                                    To view an existing sample reading, click <span class="materialize-red-text">OPEN</span>
                                    button, select the Type, select the
                                    Pump Number, and click <span class="materialize-red-text">OK</span> button.
                                </li>
                                <li>
                                    Now the existing readings can be viewed.
                                </li>
                                <li>
                                    To modify a Pump reading, Open the particular pump, change the values and save it.

                                </li>
                                <li>
                                    To modify Pump number and Inpass number, open the reading and click <span
                                        class="materialize-red-text">NEW</span>. Then "clear
                                    all fields" message will be displayed. Here click <span
                                        class="materialize-red-text">NO</span>, now enter new Pump number and
                                    Inpass number and save it.

                                </li>
                                <li>
                                    To view the report with the calculated values click <span
                                        class="materialize-red-text">REPORT</span> button.

                                </li>
                                <li>
                                    To view the Graph, click <span class="materialize-red-text">GRAPH</span> button. The
                                    scale values for X and Y axis are shown.
                                    If required the values can be rounded off to the nearest decimal and click <span
                                        class="materialize-red-text">OK</span>. [Best
                                    result can be seen without modifying the scale values].

                                </li>
                                <li>
                                    Now the 6 Graph option buttons and other buttons are shown.

                                </li>
                                <li>
                                    Press <span class="materialize-red-text">G1</span> button to see the curve, click
                                    <span class="materialize-red-text">OBS.VALUES</span> button to view the Pump Result
                                    [Pass/Fail]

                                </li>
                                <li>
                                    Similarly <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span class="materialize-red-text">G5</span>
                                    & <span class="materialize-red-text">G6</span> graph options can be
                                    checked.

                                </li>
                                <li>
                                    By viewing all the 6 graph options, the required correct graph curve can be selected.

                                </li>
                                <li>
                                    For the selected curve, check observed values by clicking <span
                                        class="materialize-red-text">OBS.VALUES</span> button.

                                </li>
                                <li>
                                    The performance chart for the pump can be viewed by clicking the <span
                                        class="materialize-red-text">PER.CHART</span> button and
                                    select Bar or Pie chart option.

                                </li>
                                <li>
                                    The <span class="materialize-red-text">FULL VIEW</span> button can be used to hide
                                    the buttons for better view of curves. Tosee the buttons again, click <span
                                        class="materialize-red-text">EXIT</span> button at the bottom right corner.

                                </li>
                                <li>
                                    For taking print out, click <span class="materialize-red-text">PRINT</span> button,
                                    click <span class="materialize-red-text">HIGH QUALITY</span> select whether <span
                                        class="materialize-red-text">COLOR</span> or
                                    <span class="materialize-red-text">BLACK & WHITE</span>, then press <span
                                        class="materialize-red-text">OK</span>. This printout process may take few
                                    minutes.

                                </li>
                                <li>
                                    At the lower right corner of the form a check box named "<span
                                        class="materialize-red-text">Grid</span>" can be viewed. If we
                                    want to take Graph Printout with gridlines, click on the check box and go for
                                    printout. This Grid option can be activated at any time when you are in the graph
                                    form i.e., it can be activated in the beginning before clicking <span
                                        class="materialize-red-text">G1</span>, <span class="materialize-red-text">G2</span>
                                    etc., or at
                                    the end before taking Printout. This option gives the closer values to check the
                                    critical values when we are in the new pump development. Since it is an optional
                                    one, this can be used whenever the need arises.
                                </li>
                                <li>
                                    Press <span class="materialize-red-text">EXIT</span> button to quit from this form.

                                </li>
                                <li>
                                    <dt>Open Pump Testing form for ISI entry Flowmetric method from the menu</dt>
                                    <dd>Entry -> Pump Testing ISI -> Flowmetric</dd>
                                </li>
                                <li>
                                    Repeat the above procedure for Flowmetric method. [The difference here is instead of
                                    giving time in volumetric method, the discharge values must be entered.]

                                </li>
                            </ol>

                            <h6><u>Pump Testing Entry Export and R&D version</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Pump Testing form for Export and R&D entry Volumetric method from the menu
                                    </dt>
                                    <dd>Entry -> Pump Testing R&D -> Volumetric</dd>
                                </li>
                                <li>
                                    To enter new Pump Testing values click <span class="materialize-red-text">NEW</span>
                                    Button and cursor will be automatically in Pump Number.
                                </li>
                                <li>
                                    Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.
                                </li>
                                <li>
                                    While filling the values, select the Pump Type and Date.
                                </li>
                                <li>
                                    Before pressing <span class="materialize-red-text">SAVE</span> button, verify whether
                                    all values are given.
                                </li>
                                <li>
                                    To fill another entry press <span class="materialize-red-text">NEW</span> button and
                                    repeat the procedure.
                                </li>
                                <li>
                                    To view an existing sample reading, click <span class="materialize-red-text">OPEN</span>
                                    button, select the Type, select the Pump Number, and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>
                                    Now the existing readings can be viewed.
                                </li>
                                <li>
                                    To modify a Pump reading, Open the particular pump, change the values and save it.

                                </li>
                                <li>
                                    To modify Pump number and Inpass number, open the reading and click <span
                                        class="materialize-red-text">NEW</span>. Then "<span
                                        class="materialize-red-text">clear all fields</span>"
                                    message will be displayed. Here click <span class="materialize-red-text">NO</span>, now
                                    enter new Pump number and Inpass number and save it.
                                </li>
                                <li>
                                    To view the report with the calculated values click <span
                                        class="materialize-red-text">REPORT</span> button.
                                </li>
                                <li>
                                    To view the Graph, click <span class="materialize-red-text">GRAPH</span> button. The
                                    scale values for X and Y axis are shown. If required the values can be rounded off to
                                    the nearest decimal and click <span class="materialize-red-text">OK</span>. [Best result
                                    can be seen without modifying the scale values].
                                </li>
                                <li>
                                    Unit selection option form displays the different units to be used for Discharge (Q).
                                    Select the unit and click <span class="materialize-red-text">OK</span>.
                                </li>
                                <li>
                                    Now 10 graph buttons and other buttons are shown.
                                </li>
                                <li>
                                    Press <span class="materialize-red-text">G1</span> button to see the curve, click <span
                                        class="materialize-red-text">OBS.VALUES</span> button to view the Pump Result
                                    [Pass/Fail]
                                </li>
                                <li>
                                    Similarly <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span>, <span
                                        class="materialize-red-text">G7</span>, <span
                                        class="materialize-red-text">G8</span>, <span class="materialize-red-text">G9</span>
                                    & <span class="materialize-red-text">G10</span> graph options can be checked.
                                </li>
                                <li>
                                    By viewing all the 10 graph options, the required correct graph curve can be
                                    selected.
                                </li>
                                <li>
                                    After clicking <span class="materialize-red-text">OBS.VALUES</span> button, if the curve
                                    is to be taken from Autocad click <span class="materialize-red-text">AUTOCAD</span>
                                    button [Autocad software should be installed in your system, Release 14 or Release
                                    2000]. Note: - Auotcad will not be supplied with our software.
                                </li>
                                <li>
                                    Now Autocad will be opened in a separate window. In <span
                                        class="materialize-red-text">TOOLS</span> menu click <span
                                        class="materialize-red-text">LOAD APPLICATION</span>. Click
                                    <span class="materialize-red-text">FILE</span> button, select the <span
                                        class="materialize-red-text">14220.lsp</span> file and
                                    click <span class="materialize-red-text">OPEN</span>. Click <span
                                        class="materialize-red-text">LOAD</span> button and Type
                                    <span class="materialize-red-text">14220</span> in command line and press <span
                                        class="materialize-red-text">ENTER</span>. Here the Autocad curve is shown. Printout
                                    can be taken from here. While closing Autocad, control will be focussed to Graph form.
                                </li>
                                <li>
                                    In Autocad, If Duty point values and Headrange values are not correctly fixed and if
                                    wrong values
                                    are
                                    obtained then do the following procedure to correct it.
                                    <ol type="i">
                                        <li>In command line give the <span class="materialize-red-text">PICKBOX</span>
                                            command and press <span class="materialize-red-text">ENTER</span> and the value
                                            of 2 or 3 can be seen.</li>
                                        <li>If the value is 3 then change it to 2 and vice versa and exit from Autocad.</li>
                                        <li>Repeat the procedure in point 19.</li>
                                        <li>Even if the problem is not solved, uninstall Autocad and do the fresh
                                            installation.</li>
                                    </ol>
                                </li>
                                <li>
                                    If curve is to be taken from <span class="materialize-red-text">Excel</span> click EXCEL
                                    button and the Excel curve is shown. Printout can be taken from here. While closing
                                    Excel, control is focussed to graph form. (In Excel curve, duty point cannot be fixed
                                    and observed values cannot be calculated.) Note: - Excel will not be supplied with our
                                    software.
                                </li>
                                <li>
                                    To check the pump with different duty point values click <span
                                        class="materialize-red-text">DUTY POINT</span> button. Change
                                    the duty point values and click <span class="materialize-red-text">OK</span> button. Now
                                    new observed values for the changed duty point will be shown.Repeat the operation to
                                    check the pump with different duty point values.
                                </li>
                                <li>
                                    Click the <span class="materialize-red-text">REPORT</span> button to view the observed
                                    values for the changed duty point and take printout.
                                </li>
                                {{-- <li>
                                    Even if the problem is not solved, uninstall Autocad and do the fresh
                                    installation.
                                </li> --}}
                                <li>
                                    To get the Discharge for different TotalHead values for a particular pump click <span
                                        class="materialize-red-text">TH</span> vs <span
                                        class="materialize-red-text">Q</span> button. Enter the TotalHead value to see the
                                    corresponding Discharge value. Then click <span class="materialize-red-text">OK</span>
                                    button.
                                </li>
                                <li>
                                    To get the TotalHead for different Discharge values for a particular pump click <span
                                        class="materialize-red-text">Q</span> vs <span
                                        class="materialize-red-text">TH</span> button. Enter the Discharge value to see the
                                    corresponding TotalHead value. then click <span class="materialize-red-text">OK</span>
                                    button.
                                </li>
                                <li>
                                    To modify the graph points slightly, to get the better smooth curve [the modified
                                    graph point values will not control real reading], click the <span
                                        class="materialize-red-text">PICK POINT</span> button, select any one
                                    option i.e., TotalHead, Input Power or Current. Click <span
                                        class="materialize-red-text">OK</span> button. If TotalHead is selected,
                                    move the mouse pointer nearest to the TotalHead point to be modified and drag the point
                                    to the nearest position wanted. Now click the <span
                                        class="materialize-red-text">GRAPH</span> button and view the difference.
                                </li>
                                <li>
                                    The same procedure can be followed for Input Power and Current.
                                </li>
                                <li>
                                    If the real Pump graph points have to be fixed again, click <span
                                        class="materialize-red-text">EXIT</span>. Click <span
                                        class="materialize-red-text">SAVE</span> button in Pump
                                    Entry form. Now the real Graph points will be calculated.
                                </li>
                                <li>
                                    To change the color for curve and X & Y axis text, click <span
                                        class="materialize-red-text">COLOR</span> button. Click the
                                    check box for the required curve and axis and select the color. Click <span
                                        class="materialize-red-text">APPLY</span> button. If the default
                                    color is required click <span class="materialize-red-text">COLOR</span> button and click
                                    <span class="materialize-red-text">DEFAULT</span>.
                                </li>
                                <li>
                                    If the graph is to be saved as an external image file format (. JPEG, .GIF, .BMP
                                    etc.) click <span class="materialize-red-text">SAVE</span> button, select <span
                                        class="materialize-red-text">COLOR</span> or <span
                                        class="materialize-red-text">BLACK</span> & <span
                                        class="materialize-red-text">WHITE</span> option and click <span
                                        class="materialize-red-text">OK</span>. Select the
                                    path of the file, type the file name with extension and click <span
                                        class="materialize-red-text">SAVE</span>.
                                </li>
                                <li>
                                    Before going to print out, if the preview of the graph is to be seen, click <span
                                        class="materialize-red-text">PREVIEW</span> button select <span
                                        class="materialize-red-text">COLOR</span> or <span
                                        class="materialize-red-text">BLACK</span> & <span
                                        class="materialize-red-text">WHITE</span> and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>
                                    At the lower right corner of the form a check box named "<span
                                        class="materialize-red-text">Grid</span>" can be viewed. If we
                                    want to take Graph Printout with gridlines, click on the check box and go for printout.
                                    This Grid option can be activated at any time when you are in the graph form i.e., it
                                    can be activated in the beginning before clicking <span
                                        class="materialize-red-text">G1</span>, <span
                                        class="materialize-red-text">G2</span> etc., or at the end before
                                    taking Printout. This option gives the closer values to check the critical values when
                                    we are in the new pump development. Since it is an optional one, this can be used
                                    whenever the need arises.
                                </li>
                            </ol>

                            <h5><u>Motor Entry Procedure</u></h5>
                            <h6><u>Motor Declared Values</u></h6>

                            <ol>
                                <li>
                                    <dt>Open Motor Declared values Form from the menu</dt>
                                    <dd>Master -> Motor Declared Values</dd>
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
                                    saved
                                    here.</li>
                            </ol>

                            <h6><u>Motor Testing</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Motor Testing Form from the menu</dt>
                                    <dd>Master -> Motor Testing</dd>
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
                                        class="materialize-red-text">LIST</span>, click <span
                                        class="materialize-red-text">LISTALL</span> option button,
                                    select the Motor number in the list and then click <span
                                        class="materialize-red-text">MODIFY</span> button.</li>
                                <li>Now the values of the selected Motor number can be viewed, here any values can be
                                    changed and saved.</li>
                            </ol>

                            <h6><u>Routine Testing</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Routine Testing Entry Form from the menu</dt>
                                    <dd>Entry -> Routine Testing</dd>
                                </li>
                                <li>To enter new routine testing values, click <span
                                        class="materialize-red-text">NEW</span> button and automatically the cursor will
                                    be in Serial number.</li>
                                <li>Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.</li>
                                <li>Before pressing <span class="materialize-red-text">SAVE</span> button, verify whether
                                    all values are given.</li>
                                <li>To fill another Pump number, click <span class="materialize-red-text">NEW</span> button
                                    and repeat the above procedure.</li>
                                <li>To modify the value of an existing Pump number click <span
                                        class="materialize-red-text">LIST</span>, click <span
                                        class="materialize-red-text">LISTALL</span> option button,
                                    select the Pump number in the list and then click <span
                                        class="materialize-red-text">MODIFY</span> button.</li>
                                <li>Now the values of the selected Pump number can be viewed, here any values can be changed
                                    and
                                    saved.</li>
                            </ol>

                            <h6><u>Full Details</u></h6>
                            <ol>
                                <li>
                                    <dt>Open Full Details Entry Form from the menu</dt>
                                    <dd>Entry -> Full Details</dd>
                                </li>
                                <li>To enter new Full Details values, click <span class="materialize-red-text">NEW</span>
                                    button and automatically the cursor will be in Serial number.</li>
                                <li>Fill the required values by pressing <span class="materialize-red-text">ENTER</span>
                                    Key.</li>
                                <li>Before pressing <span class="materialize-red-text">SAVE</span> button, verify whether
                                    all values are given.</li>
                                <li>To fill another Pump number, click <span class="materialize-red-text">NEW</span> button
                                    and repeat the above procedure.</li>
                                <li>To modify the value of an existing Pump number click <span
                                        class="materialize-red-text">LIST</span>, click <span
                                        class="materialize-red-text">LISTALL</span> option button,
                                    select the Pump number in the list and then click <span
                                        class="materialize-red-text">MODIFY</span> button.</li>
                                <li>Now the values of the selected Pump number can be viewed, here any values can be changed
                                    and
                                    saved.</li>
                            </ol>


                            <h5><u>REPORTS</u></h5>
                            <h6><u>Maximum & Minimum Values Report</u></h6>

                            <ol>
                                <li>
                                    <dt>To open Maximum & Minimum values Report for Pump types, click</dt>
                                    <dd>Report -> Pump Maximum Minimum Values Report</dd>
                                </li>
                                <li>This report is used to find the Maximum & Minimum values for TotalHead, Input
                                    Power and Current in between two dates for all types with corresponding Pump numbers.
                                </li>
                                <li>Using this report, we can find out the performance of the pumps between any of the given
                                    two dates.</li>
                                <li>Select the FROM an TO dates for which the report is required. Click <span
                                        class="materialize-red-text">OK</span> button.</li>
                                <li>Now the values will be displayed.</li>
                                <li>If there is no Pump readings available between the given two dates, an error message of
                                    "No records available in this period of date" will be displayed.</li>
                                <li>Click <span class="materialize-red-text">REPORT</span> button to take the printout.
                                </li>
                            </ol>

                            <h6><u>Observed values Report</u></h6>
                            <ol>
                                <li>
                                    <dt>To open pump observed values report for particular pump type, click</dt>
                                    <dd>Report -> Pump Observed values Report</dd>
                                </li>
                                <li>This report is used to take report for observed values of a particular pump type between
                                    given two dates.</li>
                                <li>From this report only, we are arriving Maximum & Minimum values Report</li>
                                <li>Select the pump type, select the From and To dates for which the report is required.
                                    Click <span class="materialize-red-text">OK</span>
                                    button.</li>
                                <li>If there is no Pump readings available between the given two dates, an error message of
                                    "No records available in this period of date" will be displayed.</li>
                                <li>Click <span class="materialize-red-text">REPORT</span> button to take the printout.
                                </li>
                            </ol>

                            <h5><u>Pump Comparison (All Types)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "All curves Comparison" for all pump types click</dt>
                                    <dd>Pump Comparison -> All Curve Comparison -> All Types</dd>
                                </li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>


                            <h5><u>Pump Comparison (Type-wise)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "All curves Comparison" for single pump type click</dt>
                                    <dd>Pump Comparison -> All Curve Comparison -> Typewise</dd>
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (TotalHead - All Types)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "Individual curves Comparison" for TotalHead for all pump types click</dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> All Types -> TotalHead</dd>
                                </li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (TotalHead - Type-wise)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "Individual curves Comparison" for Total Head for single pump type click
                                    </dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> Type wise -> TotalHead</dd>
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (Input Power - All Types)</u></h5>
                            <ol>

                                <li>
                                    <dt>To open “Individual curves Comparison” for Input Power for all pump types click.
                                    </dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> All Types -> Input Power.</dd>
                                </li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>Select the pump type from the top right corner Combo box.</li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (Input Power - Type-wise)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "Individual curves Comparison" for Input Power for single pump types
                                        click</dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> Type wise -> Input Power
                                    </dd>
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (Current - All Types)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "Individual curves Comparison" for Current for all pump types click</dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> All Types -> Current</dd>
                                </li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span> button.
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text boxes
                                    provided. Then click the <span class="materialize-red-text">NEXT</span> button.</li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
                            </ol>

                            <h5><u>Pump Comparison (Current - Type-wise)</u></h5>
                            <ol>
                                <li>
                                    <dt>To open "Individual curves Comparison" for Current single pump types click</dt>
                                    <dd>Pump Comparison -> Individual Curve Comparison -> Type wise -> Current</dd>
                                </li>
                                <li>Select the pump type from the top right corner Combo box</li>
                                <li>The unit options frame will be displayed. Select the required unit and click <span
                                        class="materialize-red-text">OK</span>
                                    button.</li>
                                <li>All the pump numbers in the selected pump type will appear in the below list box.</li>
                                <li>Double click the pump numbers to be compared or type the pump numbers in the text
                                    boxes provided. Then click the <span class="materialize-red-text">NEXT</span> button.
                                </li>
                                <li>Now the 6 Graph options and other buttons are shown.</li>
                                <li>Click <span class="materialize-red-text">G1</span> button to see the graph.</li>
                                <li>Similarly the Graphs <span class="materialize-red-text">G2</span>, <span
                                        class="materialize-red-text">G3</span>, <span
                                        class="materialize-red-text">G4</span>, <span
                                        class="materialize-red-text">G5</span>, <span
                                        class="materialize-red-text">G6</span> can be checked.</li>
                                <li>By viewing all the 6 graph options the required correct graph curve can be selected.
                                </li>
                                <li>For taking printout, click <span class="materialize-red-text">PRINT</span> button. The
                                    printout process may take few minutes.</li>
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
