@extends('layouts.admin')

@section('title', 'Index')

@section('content')
    <div class="container">
        <form action="" method="get">
            <div class="mb-3">
                <label for="search-string" class="form-label">{{ __('Search string') }}</label>
                <input type="text" class="form-control" id="search-string" name="search-string" value="{{ old('title') }}" placeholder="Post Title">
            </div>

            <select class="form-select mt-3" aria-label="Default select example" name="category" id="category">
                <option value="" selected>Select your category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <select class="form-select mt-3" aria-label="Default select example" name="author" id="author">
                <option value="" selected>Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>

            <button>Apply filters</button>
        </form>

        <table class="table table-striped table-dark table-hover my-5">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Category</th>
                <th scope="col">Tags</th>
                <th scope="col">Slug</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr data-id="{{ $post->slug }}">
                        <th class="text-center" scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->user_id }}</td>
                        <td>{{ $post->category->id }}</td>
                        <td>{{ $post->tags->pluck('name')->join(', ') }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ date('d/m/Y', strtotime($post->created_at)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($post->updated_at)) }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger btn-delete">Delete</button>
                        </td>
                    </tr>
                @endforeach
            <tbody>
        </table>

        {{-- per paginate  --}}
        {{ $posts->links() }}

        <section id="confirmation" class="overlay d-none">
            <div class="popup">
                <h1>Sei sicuro di voler eliminare?</h1>
                <div class="d-flex justify-content-center">
                    <button id="btn-no" class="btn btn-primary me-3">Annulla</button>
                    <form method="POST" data-base="{{ route('admin.posts.destroy', '*****') }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">ELIMINA</button>
                    </form>
                </div>
            </div>
        </section>
    </div>



@endsection
