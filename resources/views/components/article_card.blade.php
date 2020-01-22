<article class="col-12 col-sm-10 col-md-6 col-lg-4">
    <div class="card article_card" style="width: 100%;">
        <img
        class="card-img-top"
        src="{{ asset("img/articles/".$article["thumb"]) }}" 
        alt="{{ $article["title"] }}" />
        
        <div class="card-body">
            <h5 class="card-title">{{$article["title"]}}</h5>
            <p class="card-text">{{$article["description"]}}</p>
            <a
            href="{{ url('articles', ["id" => $article["id"]]) }}"
            class="btn btn-primary">
                View More
            </a>
        </div>

        @can('edit_article')
        <div class="dropbutton dropleft">
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
    </div>
</article>

<script>
    function deleteArticleConfirm(e) {
        if(!confirm("Do you want to delete this article?")) {
            e.preventDefault();
        }
    }
</script>