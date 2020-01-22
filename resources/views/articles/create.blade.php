@extends('layouts.app')

@section('title', 'Create Article - ')

@section('content')
<main class="container mt-5">
    <article class="row">
        <div class="col-12 formulary article-form">
            <form
            method="POST"
            action="{{ url('/articles/') }}"
            enctype="multipart/form-data">
                @csrf

                <h1 class="title">{{ __('Create Article') }}</h1>

                <div class="formulary-group">
                    <label for="id_title">
                        {{ __('Title') }}
                    </label>
                    
                    <input
                    id="id_title"
                    type="text"
                    class="@error('title') is-invalid @enderror"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    autocomplete="off"
                    autofocus />

                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_thumb" class="preview">
                        <div class="add-thumb">
                            Add Thumb
                        </div>

                        <div class="image">
                            <i class="fas fa-edit"></i>

                            <img
                            src=""
                            id="preview"
                            alt="Thumb" />
                        </div>
                    </label>

                    <input
                    type="file"
                    name="thumb"
                    id="id_thumb"
                    accept="image/jpeg, image/png"
                    hidden />

                    @error('thumb')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_description">
                        {{ __('Little Description') }}
                    </label>

                    <textarea
                    id="id_description"
                    class="@error('description') is-invalid @enderror"
                    name="description"
                    rows="3"
                    required
                    autocomplete="off">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="formulary-group">
                    <label for="id_content">
                        {{ __('Content') }}
                    </label>

                    @component('components.text_editor', ["content" => old('content')])
                    @endcomponent

                    @error('content')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="formulary-button">Create Article</button>
            </form>
        </div>
    </article>
</main>

<script>
    const inputFile = document.getElementById("id_thumb");

    inputFile.addEventListener("change", () => {
        const file = inputFile.files[0];

        if(file.type === "image/jpeg" || file.type === "image/png" || file.type === "image/jpg") {
            const src = URL.createObjectURL(file);
            
            document.getElementById("preview").setAttribute("src", src);
            document.querySelector(".preview").classList.add("active");
        }
    });
</script>
@endsection