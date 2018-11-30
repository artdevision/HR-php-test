<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <script src="{{ asset('/js/app.js') }}"></script>
        <script src="{{ asset('/js/script.js') }}"></script>
    </head>
    <body>
    @include('layouts.navbar')
    <main role="main">
        @yield('content')
    </main>
    @include('layouts.footer')
    </body>