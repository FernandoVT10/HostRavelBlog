@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 formulary">
            <h1 class="title">{{ __('Reset Password') }}</h1>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="formulary-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input
                    id="email"
                    type="email"
                    class="@error('email') is-invalid @enderror"
                    name="email"
                    value="{{ $email ?? old('email') }}"
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
                    autocomplete="new-password" />

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input
                    id="password-confirm"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password">
                </div>

                <button type="submit" class="formulary-button">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
