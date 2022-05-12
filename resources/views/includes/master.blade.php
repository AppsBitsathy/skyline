<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    @include('includes.top')
    @yield('custom-css')
    @include('includes.nav')
</head>

<body class="grey lighten-2" style="background-image: url('{{ asset('assets/images/home_background.jpg') }}');background-repeat: no-repeat;
    background-size: cover;">
    <div>
    </div>
    <main>
        <div id="progress" class="center-screen hide">
            <div class="preloader-wrapper small active center-screen">
                <div class="spinner-layer spinner-blue-only">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="progress mt-0 hide" id="progress">
            <div class="indeterminate"></div>
        </div> --}}
        @yield('content')
    </main>

    @include('includes.bottom')

    @yield('custom-script')
</body>

</html>
