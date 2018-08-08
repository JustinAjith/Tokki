<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    @include('admin.layouts._inc.style')
    <link rel="stylesheet" href="{{ asset('css/tokki/auth/icons/icons.css') }}">
    @yield('style')
</head>
<body class="fix-header fix-sidebar" ng-app="appModule" ng-cloak>
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    @include('admin.layouts._inc.top_header')
    @include('admin.layouts._inc.left_sidebar')

    <div class="page-wrapper">
        @yield('content')

        <footer class="footer"> © {{ date("Y") }} All rights reserved by <a href="{{ route('welcome') }}">Tokki</a></footer>
    </div>
</div>

@include('admin.layouts._inc.script')
@yield('script')
</body>
</html>
