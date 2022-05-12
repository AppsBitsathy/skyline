<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
<script src="{{ asset('assets/js/init.js') }}"></script>
<script src="{{ asset('assets/js/plotly.min.js') }}"></script>
{{-- <script src="{{ asset('assets/js/html2canvas.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        $('#ddisiStandard').val({{ session('isi') }});

        @if (isset($rId))
            {
        
            $('#menu' + {{ $rMain }}).addClass('active blue').children()
            .addClass('white-text').children().addClass('white-text');
        
            @if (strlen($rId) == 3)
                {
                console.log({{ $rMain }});
                console.log({{ $srId }});
                console.log({{ $rId }});
                $('#semisubmenu' + {{ $rId }}).addClass('active').children().children().addClass('white-text');
        
                $('#submenu' + {{ $srId }}).addClass('active grey lighten-1');
        
                }
            @elseif (strlen($rId) == 4)
                {
                console.log({{ $rMain }});
                console.log({{ $srId }});
                console.log({{ $ssrId }});
                console.log({{ $rId }});
        
                $('#submenu' + {{ $srId }}).addClass('active grey lighten-1');
        
                $('#semisubmenu' + {{ $ssrId }}).addClass('active grey lighten-2');
        
                $('#supersemisubmenu' + {{ $rId }}).addClass('active');
                }
            @else
                {
                console.log({{ $rMain }});
                console.log({{ $rId }});
        
                $('#submenu' + {{ $rId }}).addClass('active').children().children().addClass('white-text');
        
                }
            @endif
        
            }
        @endif
    });

    $('#ddisiStandard').on('change', function() {
        console.log(this.value);

        $('#progress').removeClass('hide');

        let url = window.location.protocol+ "//" + window.location.host;;

        $.ajax({
            url: url + "/home/changeisi",
            method: 'get',
            data: {
                'isi': this.value
            },
            success: function(res) {
                console.log(res);
                if (res != 0)
                    location.replace('{{ route('home') }}');
            }
        });
    });

    function downloadURI(uri, name) {
        var link = document.createElement("a");

        link.download = name;
        link.href = uri;
        document.body.appendChild(link);
        link.click();
        link.remove();
    }

    function saveAsImage() {
        let standard = '';

        @if (session('isi'))
            standard = {{ session('isi') }};
        @endif

        let parameters = window.location.href.split('?');

        let route = parameters[0].split(standard.toString())[1].replaceAll('/','_');

        var element = $("#myDiv")[0];
        // $('body').css('visibility', 'hidden');
        // $('#chartDiv').css('visibility', 'visible');
        // $('#chartDiv').addClass('m12 l12');
        // Plotly.relayout('myDiv', {});
        // $('#chartDiv').css({ 'position': 'absolute', 'left': 0, 'top': 0, 'size': 'landscape' });
        html2canvas(element).then(function(canvas) {
            var myImage = canvas.toDataURL();
            downloadURI(myImage, standard.toString() + '' + route.toString());
        });
        // $('body').css('visibility', 'visible');
        // $('#chartDiv').css('visibility', 'visible');
        // $('#chartDiv').removeClass('m12 l12');
        // Plotly.relayout('myDiv', {});
        // $('#chartDiv').css({ 'position': '', 'left': '', 'top': '' });
    }

    @php
    if (isset($isiGraphScaleValues)) {
        if (isset($isiGraphScaleValues->yaxis1)) {  
    @endphp
        let maxValue =  Math.max({{ $isiGraphScaleValues->yaxis1 }} * 18, {{ $isiGraphScaleValues->yaxis2 }} * 18, {{ $isiGraphScaleValues->yaxis3 }} * 18);
    @php
        } else {
    @endphp
        let maxValue =  Math.max({{ $isiGraphScaleValues["yaxis1"] }} * 18, {{ $isiGraphScaleValues["yaxis2"] }} * 18, {{ $isiGraphScaleValues["yaxis3"] }} * 18);
    @php
        }
    }
    @endphp
    
</script>
