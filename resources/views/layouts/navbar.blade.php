<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand font-weight-bold" href="{{url("/")}}">
        {{config("app.name", "Laravel")}}
    </a>
    
    <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
    >
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route("home")}}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url("/articles")}}">Articles</a>
            </li>
            @if (!Auth::check())
                <li class="nav-item">
                    <a class="nav-link" href="{{route("login")}}">{{__("Login")}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("register")}}">{{__("Register")}}</a>
                </li>          
            @else
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="navbarDropdown"
                        role="button"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        My profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('edit-profile') }}">
                            {{__("Edit Profile")}}
                        </a>

                        @can('create_article')
                            <a class="dropdown-item" href="{{ url('/articles/create') }}">
                                Create Article
                            </a>
                        @endcan

                        @can('edit_user')
                            <a class="dropdown-item" href="{{ url('users') }}">
                                Manage Users
                            </a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('close-session') }}">
                            {{__("Close Session")}}
                        </a>
                    </div>
                </li>
            @endif
        </ul>
    </div>
</nav>
