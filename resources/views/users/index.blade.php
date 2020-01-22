@extends('layouts.app')

@section('title', 'Manage Users - ')

@section('content')
<main class="container bg-white py-3 mt-5">
    <div class="row align-items-center mb-3">
        <div class="col-12 col-md-6">
            <h3 class="font-weight-bold title text-center text-md-left">
                Users
            </h3>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
            <form action="{{ url('/users/') }}" method="get" class="form-inline flex-nowrap">
                <input
                type="search"
                name="search"
                id="id_search"
                value="{{app('request')->input('search')}}"
                placeholder="Search by name or id"
                class="form-control" />

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row mt-4">
        @if (count($users))
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user["id"] }}</th>
                                <td>{{ $user["name"] }}</td>
                                <td>{{ $user["email"] }}</td>
                                <td>
                                    @component('components.role_badge', ["user" => $user])
                                    @endcomponent
                                </td>
                                <td>
                                    <div class="dropbutton dropleft float-right">
                                        <button class="toggle">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                    
                                        <div class="dropbutton-menu">
                                            <a
                                            class="dropbutton-item"
                                            href="{{ url('/users/'.$user["id"].'/edit') }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                            
                                            <form
                                            method="post"
                                            onsubmit="deleteArticleConfirm(event)"
                                            action="{{ url('/users/'.$user["id"]) }}">
                                                @csrf
                                                @method('DELETE')
                            
                                                <button type="submit" class="btn dropbutton-item">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="col-12">
                <h4 class="font-weight-bold text-center">Results not found</h4>
            </div>
        @endif
    </div>

    <div class="row justify-content-center mt-3">
        {{ $users -> links() }}
    </div>
</main>

<script>
    function deleteArticleConfirm(e) {
        if(!confirm("Do you want to delete this user?")) {
            e.preventDefault();
        }
    }
</script>

@endsection