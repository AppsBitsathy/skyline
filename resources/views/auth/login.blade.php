<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    @include('includes.top')
</head>

<title>Login</title>

@php
$rMain = 98;
$rId = 0;
@endphp

<nav class="transparent z-depth-0 p-2">
    <div class="nav-wrapper">
        <a href="{{ route('home') }}" class="brand-logo center black-text p-1"><img
                src="{{ asset('assets/images/logo.png') }}" alt="Skyline Logo"></a>
    </div>
</nav>

<body style="background-image: url('{{ asset('assets/images/login_background.png') }}');background-repeat: no-repeat;
    background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col m5 offset-m8 mt-5">
                <div class="card p-4 mt-5" style="border-radius:10px">
                    {{-- <div class="card-title">{{ __('Login') }}</div> --}}

                    <div class="card-content">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row">
                                {{-- <label for="email" class="col m4 text-md-right">{{ __('E-Mail Address') }}</label> --}}

                                <div class="input-field col m12">
                                    <i class="material-icons prefix">mail</i>
                                    <input id="email" type="email" placeholder="Enter your Mail ID"
                                        class="input-field @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                {{-- <label for="password" --}}
                                {{-- class="col m4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                                <div class="input-field col m12">
                                    <i class="material-icons prefix">lock</i>
                                    <input id="password" type="password" placeholder="Enter your password"
                                        class="input-field @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col m12 offset-m4">
                                    <label for="remember">
                                        <input class="filled-in" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <span>{{ __('Remember Me') }}</span>
                                    </label>
                                </div>
                            </div> --}}

                            <div class="row">
                                <div class="col m12 center">
                                    @if (Route::has('password.request'))
                                        <a class="indigo-text" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="row m0">
                                <div class="col m12 center mt-3">
                                    <button type="submit" class="btn blue">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            {{-- <div class="row m0">
                                <div class="col m12 center mt-4">
                                    <a class="btn blue" href="{{ route('register') }}">
                                        {{ __('Register') }}
                                    </a>
                                </div>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.bottom')

</body>

{{-- @section('content') --}}

{{-- @endsection --}}
