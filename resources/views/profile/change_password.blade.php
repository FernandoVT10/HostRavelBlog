@extends('layouts.app')

@section('title', 'Change Password - ')

@section('content')
<main class="container change-avatar mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 col-lg-3 mb-4">
            @component('components.profile_nav')
                @section('change-password', 'active')
            @endcomponent
        </div>

        <div class="col-12 col-md-8 col-lg-9 mt-3 formulary">
            <form method="POST" action="{{ route('update-password') }}">
                @csrf

                <h1 class="title">{{ __('Change Password') }}</h1>

                @if (old("message"))
                    <div class="alert alert-success">
                        {{ old("message") }}
                    </div>
                @endif

                <div class="formulary-group">
                    <label for="id_new_password">
                        {{ __('New Password') }}
                    </label>
                    
                    <input
                    id="id_new_password"
                    type="password"
                    class="@error('new_password') is-invalid @enderror"
                    name="new_password"
                    required
                    autofocus />

                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_repeat_new_password">
                        {{ __('Repeat New Password') }}
                    </label>
                    
                    <input
                    id="id_repeat_new_password"
                    type="password"
                    class="@error('repeat_new_password') is-invalid @enderror"
                    name="repeat_new_password"
                    required />

                    @error('repeat_new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_current_password">
                        {{ __('Current Password') }}
                    </label>
                    
                    <input
                    id="id_current_password"
                    type="password"
                    class="@error('current_password') is-invalid @enderror"
                    name="current_password"
                    required />

                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="formulary-button">Update Password</button>
            </form>
        </div>
    </div>
</main>
@endsection