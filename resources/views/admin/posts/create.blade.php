@extends('layouts.admin')

@section('title', 'create post')

@section('content')
    <div class="container">
        <form action="{{ route('admin.posts.store') }}" method="post">
            @csrf
            <div class="mb-3">
                {{-- __('Title') è traducibile  --}}
                <label for="title" class="form-label">{{ __('Title') }}</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Post Title">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="slug" class="form-label">{{ __('Slug') }}</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
            </div>
            <input type="button" value="Generate slug" id="btn-slugger">
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <select class="form-select mt-3" aria-label="Default select example" name="category_id" id="category">
                <option value="" selected>Select your category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="content" class="form-label">{{ __('Content') }}</label>
                <textarea class="form-control" id="content" rows="10" name="content" placeholder="Post Description">{{ old('content') }}</textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button>Send</button>
        </form>
    </div>

@endsection
