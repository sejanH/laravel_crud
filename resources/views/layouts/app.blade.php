<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <title>{{env('APP_NAME')}}</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @stack('styles')
    </head>
    <body class="antialiased">
        <div id="app">
            <header-menu app-name=@JSON(env('APP_NAME')) :user="{{json_encode(Auth::user())}}"></header-menu>
            @yield('content')
        </div>
        <script src="{{asset("/js/app.js")}}"></script>
        <script>
        </script>
        @stack('scripts')
    </body>
</html>