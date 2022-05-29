<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'sito bello') }} - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- defer per mettere script nell'head  --}}
</head>
<body>
    {{-- chiamo componente navbar e imposto il colore --}}
    <x-navbar color="dark" />

    <div class="container mt-4">
        <div class="row">
            <div class="col-2">
                <ul>
                    <li><a href="{{ route('admin.posts.index') }}">All Posts</a></li>
                    <li><a href="{{ route('admin.posts.create') }}">New Post</a></li>
                    <li><a href="{{ route('admin.categories.index') }}">All Categories</a></li>
                    <li><a href="{{ route('admin.categories.create') }}">New Category</a></li>

                </ul>

            </div>

            <div class="col-10">
                @yield('content')

            </div>
        </div>
    </div>

</body>
</html>
