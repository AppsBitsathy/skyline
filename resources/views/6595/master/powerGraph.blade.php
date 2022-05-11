@extends('includes.master')
<title>Master - Power IO Graph</title>
@php
$rMain = 1;
$rId = 12;
@endphp
@section('content')
    <h4 class="m-4 white-text">Pump Declared Values</h4>
    <div class="container">
        {{-- <div class="row">
            <div class="col s12">
                <ul class="tabs z-depth-1">
                    <li class="tab col s6"><a class="active" href="#list">{{ __('List') }}</a></li>
                    <li class="tab col s6"><a class="" href="#entry">{{ __('Entry') }}</a></li>
                </ul>
            </div>
        </div> --}}
        <div class="row">
            <!-- entry -->
            <div id="entry" class="col m12">
                <div class="card">
                    <!-- <div class="card-title">{{ __('Entry') }}</div> -->
                    <div class="card-body pt-5 pb-2">
                        <div class="row mb-4">
                            <div class="col m3 center-align">
                                <a class="btn waves-effect waves-light modal-trigger" href="#openModal" id="btnOpen">Open
                                    <i class="material-icons right">folder</i>
                                </a>
                            </div>
                            <div class="col m3 center-align">
                                <form action="{{ route('6595_masterPowerGraphDelete') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="deletePumpType">
                                    <button class="btn waves-effect waves-light" disabled name="btnDelete"
                                        id="btnDelete">Delete
                                        <i class="material-icons right">delete</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m3 center-align">
                                <form action="{{ route('6595_masterPowerGraphReport') }}" method="post" target="blank">
                                    @csrf
                                    <input type="hidden" name="reportPumpType">
                                    <button class="btn waves-effect waves-light" disabled name="btnReport"
                                        id="btnReport">Report<i class="material-icons right">picture_as_pdf</i>
                                    </button>
                                </form>
                            </div>
                            <div class="col m3 center-align">
                                {{-- <form action="{{ route('6595_masterPowerShowGraph') }}" method="POST"> --}}
                                    <button class="btn waves-effect waves-light" disabled name="btnGraph" id="btnGraph">Graph
                                        <i class="material-icons right">multiline_chart</i>
                                    </button>
                                {{-- </form> --}}
                            </div>
                        </div>
                        <form method="POST" action="{{ route('6595_masterPowerGraphStore') }}">
                            @csrf
                            <div class="row">
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Enter the motor ref. no.</span>
                                    <input class="input-field" name="motorRefNo" placeholder="Enter Motor Ref No"
                                        required autocomplete="on" id="motorRefNo">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Enter the speed (RPM)</span>
                                    <input class="input-field" name="speed" id="speed"
                                        placeholder="Enter the speed (RPM)" required autocomplete="on">
                                </div>
                                <div class="col m4 pl-5 pr-5 mt-3">
                                    <span>Enter the H.P./k.W.</span>
                                    <input class="input-field" name="hpkw" id="hpkw" placeholder="Enter the H.P./k.W."
                                        required autocomplete="on">
                                </div>
                                <div class="col s12 m12 l12 p-5">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th style="width: 50px">Serial No.</th>
                                                <th>Power - I (kW)</th>
                                                <th>Power - O (kW)</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">
                                            <tr id="row1">
                                                <td>1</td>
                                                <td><input type="text" name="poweri[]" id="tblPoweri" required></td>
                                                <td><input type="text" name="powero[]" id="tblPowero" required>
                                                </td>
                                                <td><a id="addRow" class="btn waves-effect blue"><i
                                                            class="material-icons">add</i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col m12 center mt-4">
                                    <input class="btn btn-primary" type="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- open modal --}}
    <div id="openModal" class="modal">
        <form method="GET" action="{{ route('6595_masterPowerGraph') }}">
            <div class="modal-content">
                <h4>Open</h4>
                <div class="row">
                    <div class="col m12 center-align">
                        <div class="input-field">
                            <select required name="oPumpType">
                                <option value="" disabled selected>Choose your option</option>
                                @isset($pumps)
                                    @foreach ($pumps as $pump)
                                        <option value="{{ $pump->fldptype }}">{{ $pump->fldptype }}</option>
                                    @endforeach
                                @endisset
                            </select>
                            <label>Choose pump type</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="waves-effect waves-green btn-flat" onclick="">ok</button>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </form>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('status'))
                M.toast({html:'{{ session('status') }}', classes: 'rounded'})
            @endif

            @isset($entries)
                console.log('{{ $entries }}');
                $('#btnDelete').attr("disabled", false);
                $('#btnReport').attr("disabled", false);
                $('#motorRefNo').attr("readonly", true);
                $('#hpkw').attr("readonly", true);
            
                // var url = "{{ URL::to('6595/master/power_io_graph/report/pump') }}";
                // url = url.replace('pump', '{{ $entries[0]->fldptype }}');
                // $('#btnReport').attr("href", url);
                // $('#btnReport').attr("target", "blank");
                $('#btnGraph').attr("disabled", false);
            
                let html = '';
            
                let tr = $('#tableBody tr');
            
                sno = tr.length + 1;
            
                sid++;
            
                @foreach ($entries as $data)
                    $('#motorRefNo').val('{{ $data->fldptype }}');
                    $('#speed').val('{{ $data->fldspeed }}');
                    $('#hpkw').val('{{ $data->fldhp }}');
            
                    // $('#pumpType').attr('disabled','disabled');
            
                    // $('input[name="coPumpNo"]').val('{{ $entries[0]->fldpno }}');
                    // $('input[name="coPumpType"]').val('{{ $entries[0]->fldsno }}');
            
                    $('input[name="deletePumpType"]').val('{{ $data->fldptype }}');
                    $('input[name="reportPumpType"]').val('{{ $data->fldptype }}');
            
                    @if ($data->fldread == 1)
                        $('#tblPoweri').val('{{ $data->fldx }}');
                        $('#tblPowero').val('{{ $data->fldy }}');
                    @else
                        html += '<tr id="row' + {{ $data->fldread }} + '">'
                            +'<td>' + {{ $data->fldread }} + '</td>'
                            +'<td><input type="text" name="poweri[]" required value="'+{{ $data->fldx }}+'"></td>'
                            +'<td><input type="text" name="powero[]" required value="'+{{ $data->fldy }}+'"></td>'
                            +'<td><a onclick="removeRow(' + {{ $data->fldread }} +')" class="btn waves-effect blue">'
                                    +'<i class="material-icons">remove</i></a></td>';
                            html+='</tr>';
                    @endif
                @endforeach
            
                // $('#tableBody').empty();
                $('#tableBody').append(html);
                $('#btnGraph').removeClass('disabled');
            @endisset
        });

        // $('#pumpType').on('change', function(e) {
        //     $('#hidePumpType').val(this.value);
        // });

        let sid = 1;
        $('#addRow').click(function(e) {
            let html = '';
            let tr = $('#tableBody tr');
            sno = tr.length + 1;
            sid++;
            html += '<tr id="row' + sno + '">';
            html += '<td>' + sno + '</td>';
            html += '<td><input type="text" name="poweri[]" required></td>';
            html += '<td><input type="text" name="powero[]" required></td>';
            html += '<td><a onclick="removeRow(' + sno +
                ')" class="btn waves-effect blue"><i class="material-icons">remove</i></a>';
            html += '</td>';
            html += '</tr>';

            $('#tableBody').append(html);

        });

        function removeRow(sno) {
            $('#row' + sno).remove();
            let tr = $('#tableBody tr');
            for (let i = 0; i < tr.length; i++) {
                const t = tr[i];
                console.log(t);
                let td = $(t).children();
                console.log(td[0].innerHTML);

                td[0].innerHTML = i + 1;
            }
        }

        $('#btnGraph').click(function() {

            let parameters = window.location.href.split('?');
            window.location.href = "{{ URL::to('6595/master/power_io_graph/show_graph') }}" + "?" + parameters[1];

        // //     $('#progress').removeClass('hide');

        // //     let pno = $('input[name="coPumpNo"]').val();
        // //     let ptype = $('input[name="coPumpType"]').val();

        // //     $.ajax({
        // //         url: "volumetric_getcoords/" + pno + "/" + ptype,
        // //         type: 'GET',
        // //         success: function(res) {
        // //             console.log(res);
        // //             // if (res.id != undefined) {
        // //             $('#coOrdinatesModal').modal('open');
        // //             $('input[name="xaxis"]').val(res.xaxis);
        // //             $('input[name="yaxis1"]').val(res.yaxis1);
        // //             $('input[name="yaxis2"]').val(res.yaxis2);
        // //             $('input[name="yaxis3"]').val(res.yaxis3);
        //             $('#progress').addClass('hide');
        // //             // }
        // //         }
        // //     });
        });
    </script>
@endsection
