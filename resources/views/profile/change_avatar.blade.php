@extends('layouts.app')

@section('title', 'Change Avatar - ')

@section('content')
<main class="container change-avatar mt-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-4 col-lg-3 mb-4">
            @component('components.profile_nav')
                @section('change-avatar', 'active')
            @endcomponent
        </div>

        <div class="col-12 col-md-8 col-lg-9 mt-3 formulary">
            <h1 class="title">{{ __('Change Avatar') }}</h1>

            <form
            method="POST"
            action="{{ route('update-avatar') }}"
            enctype="multipart/form-data">
                @csrf

                @if (old("message"))
                    <div class="alert alert-success">
                        {{ old("message") }}
                    </div>
                @endif

                <div class="formulary-group">
                    <label for="id_avatar" class="change-avatar-label">
                        <i class="fas fa-edit"></i>

                        <img src="{{ asset('img/avatars/'.$user["avatar"]) }}"
                        id="preview"
                        alt="Avatar" />
                    </label>

                    <input
                    type="file"
                    name="avatar"
                    id="id_avatar"
                    accept="image/jpeg, image/png"
                    required
                    hidden />
                </div>

                <button type="submit" class="formulary-button w-auto">Update Avatar</button>
            </form>
        </div>
    </div>
</main>

<script>
    const inputFile = document.getElementById("id_avatar");

    inputFile.addEventListener("change", () => {
        const file = inputFile.files[0];

        if(file.type === "image/jpeg" || file.type === "image/png" || file.type === "image/jpg") {
            const src = URL.createObjectURL(file);
            
            document.getElementById("preview").setAttribute("src", src);
        }
    });
</script>
@endsection