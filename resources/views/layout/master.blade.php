<!DOCTYPE html>
<html lang="en">

<head>
    <title>Trang chủ 01</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('ad/img/logo.png')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/util.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/ghide.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-rC2IEdkp8hKCcvrRqvydHwUnGO0iujHlh4M3Ud3I/9+qUe4k9tc+BiiaYV8It2v3" crossorigin="anonymous">

    <!--===============================================================================================-->
    @yield('css')
</head>

<body>
    @include('layout.header')
    @yield('content')
    @include('layout.footer')
    <!--===============================================================================================-->
    <script src="{{ asset('theme/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('theme/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('theme/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('theme/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('theme/js/main.js') }}"></script>
    @yield('js')
</body>

</html>