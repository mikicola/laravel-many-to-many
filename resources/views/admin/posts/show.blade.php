@extends('layouts.admin')

@section('title', $post->title)

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>

        {{-- <b>{{ $post->user->name }}</b> - --}}
        {{-- <b>{{ $post->user->userInfo->phone }}</b><br> --}}

        <b>{{ $post->category->name }}</b>
        <p>{{ $post->content }}</p>
    </div>

@endsection
