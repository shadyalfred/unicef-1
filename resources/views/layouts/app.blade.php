<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/unicef_logo.png') }}">

    <title>@yield('title', 'UNICEF Egypt')</title>

    <!-- Styles -->
    @yield('css')
</head>
<body class="@yield('body-class')">
    @yield('content')

    <!-- Scripts -->
    @yield('javascript')
</body>
</html>
