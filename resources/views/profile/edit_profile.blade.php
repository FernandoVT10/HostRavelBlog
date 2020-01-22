@extends('layouts.app')

@section('title', 'Edit Profile - ')

@section('content')
<main class="container edit-profile mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 col-lg-3 mb-4">
            @component('components.profile_nav')
                @section('edit-profile', 'active')
            @endcomponent
        </div>

        <div class="col-12 col-md-8 col-lg-9 mt-3 formulary">
            <form method="POST" action="{{ route('update-profile') }}">
                @csrf

                
                <h1 class="title">{{ __('Edit Profile') }}</h1>

                @if (old("message"))
                    <div class="alert alert-success">
                        {{ old("message") }}
                    </div>
                @endif

                <div class="formulary-group">
                    <label for="id_name">
                        {{ __('Name') }}
                    </label>
                    
                    <input
                    id="id_name"
                    type="text"
                    class="@error('name') is-invalid @enderror"
                    name="name"
                    value="{{ $user["name"] }}"
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
                    <label for="email">
                        {{ __('E-Mail') }}
                    </label>
                    
                    @if (old("email"))
                        <input
                        id="email"
                        type="email"
                        class="@error('email') is-invalid @enderror"
                        name="email"
                        value="{{ old("email") }}"
                        required
                        autocomplete="email"/>
                    @else
                        <input
                        id="email"
                        type="email"
                        class="@error('email') is-invalid @enderror"
                        name="email"
                        value="{{ $user["email"] }}"
                        required
                        autocomplete="email"/>
                    @endif

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="formulary-button" type="submit">Update Profile</button>
            </form>
        </div>
    </div>
</main>
@endsection