<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- google fonts import -->
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700|Roboto&display=swap" rel="stylesheet">
    @stack('styles')

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <body class="@yield('body_class')">
        @component('components.nav')
        @endcomponent
        <main>        
            @yield('main')
        </main>

{{--         @component('components.footer')
        @endcomponent
 --}}
        <div></div>


        <script src="{{'scripts/feather.js'}}"></script>
        <script src="{{asset('scripts/script.js')}}"></script>
        @stack('scripts');
    </body>
</html>