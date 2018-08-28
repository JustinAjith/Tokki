@extends('web.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tokki/web/menu.css') }}">
@endsection
@section('content')
    <div ng-controller="homeController" ng-cloak>
        @include('web.home._inc.header.menu_bar')
        @include('web.home._inc.header.top_slider')
        <div class="productCollectionList">
            @include('web.home._inc.product.new_product')
        </div>
    </div>
@endsection

@section('script')
    @include('web.home._inc.script')
    <script src="{{ asset('js/tokki/web/menuPlu.js') }}"></script>
    <script src="{{ asset('js/tokki/web/menu.js') }}"></script>
    <script>
        var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
    </script>
@endsection