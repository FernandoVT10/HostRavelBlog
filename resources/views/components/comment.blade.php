<div class="media mb-5 comment-item">
    <img src="{{asset("img/avatars/".$comment -> user["avatar"])}}"
    class="mr-3 rounded-circle icon" alt="icon" width="50" height="50" />
    <div class="media-body">
        <h5 class="mt-0">
            {{$comment -> user["name"]}}
            <span class="text-secondary h6 
            d-block d-md-inline float-none 
            float-md-right">
                {{$comment["updated_at"]}}
            </span>
        </h5>

        {{$comment["content"]}}

        <div class="comment-options d-flex align-items-center mt-2">
            <a
            href="/like/{{$comment["id"]}}"
            class="btn btn-default shadow-none text-primary">
                @if ($comment["user_likes"])
                    <i class="fas fa-thumbs-up"></i>
                @else
                    <i class="far fa-thumbs-up"></i>
                @endif
                {{$comment -> likes -> count()}}
            </a>

            @if ($comment["user_comment"])
                <a
                href="javascript:void(0)"
                onclick="editComment({{$comment['id']}}, '{{$comment['content']}}')">
                    <button>Edit</button>
                </a>

                <form
                action="{{ url('/comments', 
                    ["id" => $comment["id"]]) 
                }}"
                method="post">
                    @csrf
                    @method("DELETE")
                    <button type="submit">Delete</button>
                </form>
            @endif
        </div>
    </div>
</div>