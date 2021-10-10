<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:url" content="https://beautybooth.shop/" />
    <meta name=”robots” content="index, follow">
    <meta property="og:site_name" content="{{ $title }}" />
    <title>@yield('title')</title>
    @if (count(request()->segments()) == 0)
        <title>{{ $title }}</title>
    @endif
    @isset($category)
        @include('partials.meta',['data'=>$category])
    @endisset
    @isset($post)
        @include('partials.meta',['data'=>$post])
    @endisset

    @stack('styles')
</head>

<body class="antialiased">
    <div id="app">
        <header-menu></header-menu>
        @yield('content')
      
    </div>
    <script>
        __STATE = {
            appName: @JSON(env('APP_NAME')),
            user: @JSON(Auth::user()),
            role: @JSON(Auth::check() ? Auth::user()->role()->first()->name : null),
            menu: @JSON(\App\Models\Category::where('level',0)->whereNull('parent_id')->get())
        }

    </script>
    <script src="{{ asset('/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
