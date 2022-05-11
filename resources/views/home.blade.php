@extends('includes.master')
<title>Home</title>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m8">
                <div class="card p-5">
                    <div class="card-title">{{ __('Dashboard') }}</div>

                    <div class="card-content">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
