<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/tokki/tokki.png') }}">
    <title>{{ env('APP_NAME') }} | @yield('title')</title>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    @include('web.layouts._inc.style')
    @yield('style')
</head>
<body ng-app="appModule" ng-cloak>

@include('web.layouts._inc.top_header_bar')

<div class="page-wrapper">
    @yield('content')
</div>

@include('web.layouts._inc.footer')

@include('web.layouts._inc.script')
@yield('script')
</body>
</html>
