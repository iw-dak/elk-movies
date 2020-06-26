<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Movies</title>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('_partials.header',['platform' => session('platform')])
        @yield('content')
        @include('_partials.footer')
    </body>
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>
</html>
