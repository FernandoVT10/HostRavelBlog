@extends('layouts.app')

@section('content')
<main class="container">
    <article class="row align-items-center bg-white mt-5 home-main-article">
        @if ($main_article)
            <div class="col-12 col-lg-6 p-0">
                <img
                src="{{asset("img/articles/".$main_article["thumb"])}}"
                class="image"
                alt="{{$main_article["title"]}}" />
            </div>
            <div class="col-12 col-lg-6 p-4">
                <h2>{{$main_article["title"]}}</h2>
                <p class="font-weight-bold text-justify h5 my-3 description">
                    {{$main_article["description"]}}
                </p>
                <a
                href="{{ url('articles', ["id" => $main_article["id"]]) }}"
                class="btn btn-link link">
                    View Article
                </a>
            </div>
        @else
            <h3 class="font-weight-bold my-5 mx-auto text-center">There are no articles</h3>
        @endif
    </article>

    <div class="row mt-5 bg-white">
        <div class="col-12 home-articles py-3">
            <h3 class="font-weight-bold title text-center text-md-left mb-3">
                Recent Articles
            </h3>

            <div class="row articles justify-content-md-start justify-content-center">
                @if (count($recent_articles))
                    @foreach ($recent_articles as $article)
                        @component('components.article_card', ["article" => $article])
                        @endcomponent
                    @endforeach
                @else
                    <h4 class="font-weight-bold ml-4">There are no articles</h4>
                @endif
            </div>

        </div>
    </div>
    
    <div class="row mt-5 bg-white">
        <div class="col-12 home-articles py-3">
            <h3 class="font-weight-bold title text-center text-md-left mb-3">
                Articles You Might Like
            </h3>

            <div class="row articles justify-content-md-start justify-content-center">
                @if (count($other_articles))
                    @foreach ($other_articles as $article)
                        @component('components.article_card', ["article" => $article])
                        @endcomponent
                    @endforeach
                @else
                    <h4 class="font-weight-bold ml-4">There are no articles</h4>
                @endif
            </div>

        </div>
    </div>
</main>
@endsection