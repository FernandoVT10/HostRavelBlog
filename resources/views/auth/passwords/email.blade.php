@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 formulary">
            <h1 class="title">{{ __('Reset Password') }}</h1>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
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

                <button type="submit" class="formulary-button">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
