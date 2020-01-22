@extends('layouts.app')

@section('title', "Login - ")

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 formulary">
            <h1 class="title">{{ __('Login') }}</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="formulary-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input
                    id="email"
                    type="email"
                    class="@error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="password">{{ __('Password') }}</label>
                    <input
                    id="password"
                    type="password"
                    class="@error('password') is-invalid @enderror"
                    name="password"
                    required
                    autocomplete="current-password" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-check custom-control custom-checkbox">
                    <input
                    type="checkbox"
                    class="custom-control-input"
                    id="remember"
                    name="remember"
                    {{ old('remember') ? 'checked' : '' }}/>

                    <label for="remember" class="custom-control-label">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <button type="submit" class="formulary-button">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
