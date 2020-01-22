@extends('layouts.app')

@section('title', 'Edit User - ')

@section('content')
<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-6 formulary">
            <form method="POST" action="{{ url('/users/'.$user["id"]) }}">
                @csrf
                @method('PUT')

                <h1 class="title">{{ __("Edit User") }}</h1>

                <div class="formulary-group">
                    <label for="id_name">
                        Name
                    </label>
                    <input
                    type="text"
                    name="name"
                    class="@error('name') is-invalid @enderror"
                    id="id_name"
                    value="{{ $user["name"] }}"
                    required />

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_email">
                        Email
                    </label>
                    <input
                    type="email"
                    name="email"
                    class="@error('email') is-invalid @enderror"
                    id="id_email"
                    value="{{ $user["email"] }}"
                    required />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_role">
                        Role
                    </label>
                    <select
                    name="role"
                    id="id_role" 
                    class="@error('role') is-invalid @enderror">
                        <option value="none">
                            None
                        </option>
                        @foreach ($roles as $role)
                            @if ($role["name"] == $user_role)
                                <option value="{{ $role["name"] }}" selected>
                                    {{ $role["name"] }}
                                </option>
                            @else
                                <option value="{{ $role["name"] }}">
                                    {{ $role["name"] }}
                                </option>
                            @endif
                        @endforeach
                    </select>

                    @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button class="formulary-button" type="submit">Save Changes</button>
            </form>
        </div>
    </div>
</main>
@endsection