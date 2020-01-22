@extends('layouts.app')

@section('title', $article["title"]." - ")

@section('content')
<div class="modal fade" id="edit-comment" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form action="{{ url('/comments') }}"
            method="post">
                <div class="modal-body">
                    @method("PUT")
                    @csrf
                    <div class="form-group">
                        <label for="id_content">
                            <h5 class="font-weight-bold">Comment</h5>
                        </label>

                        <textarea
                        class="form-control"
                        name="content"
                        id="id_edit_content"
                        placeholder="Comment"
                        required
                        rows="3"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Save comment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="cover-container"
style="width: 100%;height: 200px;background-size: cover;
background-position: center;background-image: url({{asset("img/articles/".$article["thumb"])}});
background-attachment: fixed;">
</div>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-12 bg-white py-3 show-article-container">
            <h1 class="font-weight-bold h2 mb-3">{{$article["title"]}}</h1>
            <div class="h5 article-content">
                {!! $article["content"] !!}
            </div>
        </div>
    </div>
    <div class="row bg-white mt-5">
        <div class="col-12 col-lg-8 py-3 show-article-comments" id="comments">
            <h4 class="font-weight-bold mb-3">Comments : {{count($comments)}}</h4>

            @if (old("message"))
                <div class="alert alert-success mb-3">
                    {{old("message")}}
                </div>
            @endif

            <div class="media add-comment mb-5">
                @auth
                    <img src="{{asset("img/avatars/".$current_user["avatar"])}}"
                    class="mr-3 rounded-circle icon" alt="icon" width="50" height="50" />
                @endauth

                @guest
                    <img src="{{asset("img/avatars/default.png")}}" class="mr-3 rounded-circle icon"
                    alt="icon" width="50" height="50" />
                @endguest

                <form action="{{ url('/comments') }}" method="post" class="media-body">
                    @csrf
                    <h5 class="font-weight-bold mb-2">Add comment</h5>

                    <input type="hidden" name="article_id" value="{{$article["id"]}}" />

                    <div class="form-group">
                        <textarea
                        class="form-control"
                        name="content"
                        id="id_content"
                        placeholder="Comment"
                        maxlength="500"
                        rows="3"
                        required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
            
            @if (count($comments))
                @foreach ($comments as $comment)
                    @component('components.comment', ['comment' => $comment])
                    @endcomponent
                @endforeach
            @else
                <h4 class="font-weight-bold text-center">There are no comments</h4>
            @endif
        </div>
    </div>
</main>

@can('create_article')
<div class="float-button-right dropbutton dropleft dropbutton-primary">
    <button class="toggle">
        <i class="fas fa-cog"></i>
    </button>

    <div class="dropbutton-menu">
        <a
        class="dropbutton-item"
        href="{{ url('/articles/'.$article["id"].'/edit') }}">
            <i class="fas fa-pencil-alt"></i>
        </a>

        <form
        method="post"
        onsubmit="deleteArticleConfirm(event)"
        action="{{ url('/articles/'.$article["id"]) }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn dropbutton-item">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>
@endcan

<script>
    function editComment(id, content) {
        $("#edit-comment").modal("show");

        $("#id_edit_content").val(content);

        document.forms[0].action = `/comments/${id}`
    }

    function deleteArticleConfirm(e) {
        if(!confirm("Do you want to delete this article?")) {
            e.preventDefault();
        }
    }
</script>
@endsection