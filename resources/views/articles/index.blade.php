@extends('layouts.app')

@section('title', "Articles - ")

@section('content')
<main class="container bg-white mt-5 py-3">
    <div class="row align-items-center mb-3">
        <div class="col-12 col-md-6">
            <h3 class="font-weight-bold title text-center text-md-left">
                Articles
            </h3>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
            <form action="{{ url('/articles/') }}" method="get" class="form-inline flex-nowrap">
                <input
                type="search"
                name="search"
                id="id_search"
                value="{{app('request')->input('search')}}"
                placeholder="Search an article"
                class="form-control" />

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row articles justify-content-md-start justify-content-center">
                @if (count($articles))
                    @foreach ($articles as $article)
                        @component('components.article_card', ["article" => $article])
                        @endcomponent
                    @endforeach
                @else
                    <div class="col-12 mt-3">
                        <h3 class="font-weight-bold text-center">Results Not Found</h3>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 d-flex justify-content-center">
            {{$articles -> links()}}
        </div>
    </div>
</main>

@can('create_article')
    <a href="{{ url('/articles/create') }}">
        <button class="float-button-right">
            <i class="fas fa-plus"></i>
        </button>
    </a>
@endcan

@endsection