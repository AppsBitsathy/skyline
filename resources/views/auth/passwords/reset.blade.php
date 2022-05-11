@extends('includes.master')

<title>Reset Password</title>

@php
$rId = 0;
$rMain = 0;
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m8 offset-m2">
                <div class="card">
                    <div class="card-title">{{ __('Reset Password') }}</div>

                    <div class="card-content">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row">
                                <label for="email" class="col m4 ">{{ __('E-Mail Address') }}</label>

                                <div class="col m6">
                                    <input id="email" type="email" class="input-field @error('email') is-invalid @enderror"
                                        name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                        autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="password" class="col m4">{{ __('Password') }}</label>

                                <div class="col m6">
                                    <input id="password" type="password"
                                        class="input-field @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label for="password-confirm" class="col m4">{{ __('Confirm Password') }}</label>

                                <div class="col m6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row m0">
                                <div class="col m6 offset-m4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
