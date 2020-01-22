@extends('layouts.app')

@section('title', "Register - ")

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 formulary">
            <h1 class="title">{{ __('Register') }}</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="formulary-group">
                    <label for="name">{{ __('Name') }}</label>
                    <input
                    id="name"
                    type="text"
                    class="@error('name') is-invalid @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus />

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input
                    id="email"
                    type="email"
                    class="@error('email') is-invalid @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email" />

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
                    autocomplete="new-password" />
                </div>

                <button type="submit" class="formulary-button">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
