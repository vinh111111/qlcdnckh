<!DOCTYPE html>
<html>

<head>
    <title>Trang admin</title>

    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('ad/img/logo.png')}}" />

    <!-- Import lib -->
    <link rel="stylesheet" type="text/css" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('ad/assets/fontawesome-free/css/all.min.css')}}">
    <link href="{{ asset('https://fonts.googleapis.com/css2?family=Roboto&display=swap')}}" rel="stylesheet">

    <!-- End import lib -->

    <link rel="stylesheet" type="text/css" href="{{ asset('ad/assets/style.css')}}">
    @yield('css')
</head>

<body class="overlay-scrollbar">

    @include('admin.posts.layout.header')
    @yield('postads')
    @include('admin.posts.layout.footer')

</body>
<!-- end main content -->
<!-- import script -->
<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js')}}"></script>
<script src="{{asset('ad/assets/index.js')}}"></script>
@yield('js')

</html>