@extends('includes.master')

<title>Verify Password</title>
@php
$rId = 0;
$rMain = 0;
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col m8 offset-m2">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-content">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-script')
    <script>
        $(document).ready(function() {
            @if (session('resent'))
                M.toast({html:'A fresh verification link has been sent to your email address.', classes: 'rounded'})
            @endif

        });
    </script>
@endsection
