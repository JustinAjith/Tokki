@extends('web.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tokki/web/menu.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="main d-none d-md-block">
                <nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
                    <div class="cbp-hsinner">
                        <ul class="cbp-hsmenu">
                            <li>
                                <a href="#">Lovely Spirits</a>
                                <ul class="cbp-hssubmenu">
                                    <li>
                                        <h6><small>Women's Clothing</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                            <li>sad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Men's Clothing</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Kids and Baby</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Bags and Shoes</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Jewelries</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Watches</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Fashion Accessories</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Phones and Accessories</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Computer and Office</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Home and Furniture</small></h6>
                                        <ul class="mb-2">
                                            <li>asd</li>
                                            <li>ad</li>
                                            <li>sad</li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h6><small>Servicesgit</small></h6>
                                    </li>
                                    <li>
                                        <h6><small>Software Development</small></h6>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/tokki/web/menuPlu.js') }}"></script>
    <script src="{{ asset('js/tokki/web/menu.js') }}"></script>
    <script>
        var menu = new cbpHorizontalSlideOutMenu( document.getElementById( 'cbp-hsmenu-wrapper' ) );
    </script>
@endsection