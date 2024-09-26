@extends('layouts.app')

@section('content')
<style>
    /* Custom styles for the Breezeway theme */
    body {
        background-color: #f8f9fa; /* Light background for contrast */
    }
    .breezeway-title {
        font-family: 'Georgia', serif; /* Artistic font style */
        font-size: 2.5rem; /* Larger font size */
        color: #ff7f30; /* Orange color */
        text-align: center; /* Centered title */
        margin-bottom: 20px; /* Space below title */
    }
    .card {
        /* border: 1px solid #ff7f30;  */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Elevation for the card */
    }
    .btn-primary {
        background-color: #ff7f30; /* Orange button */
        border-color: #ff7f30; /* Orange border for button */
    }
    .btn-primary:hover {
        background-color: #e76f24; /* Darker orange on hover */
        border-color: #e76f24; /* Darker border on hover */
    }
    .form-check-label {
        color: #333; /* Darker color for checkbox label */
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center breezeway-title">BreezeBuy</div> <!-- Artistic System Name -->

            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
