@extends('user.layouts.master')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/tokki/auth/tagsinput.css') }}">
    <style>
        ol{padding-left: 1.5rem;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">New Product</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.product') }}">Product List</a></li>
                <li class="breadcrumb-item active">New Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="productController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="createCategorySelect" ng-show="createCategorySelect" ng-cloak>
                            @include('user.product._inc.categories')
                        </div>
                        <div class="createForm">
                            <div class="horizontal-form">
                                <form class="form-horizontal" method="POST" action="{{ route('user.product.store') }}" enctype="multipart/form-data" id="userProductDetails">
                                    @csrf
                                    <div class="productGeneralDetails" ng-show="productGeneralDetails" ng-cloak>
                                        @include('user.product._inc.general_form')
                                    </div>
                                    <div class="productDetails" ng-show="productDetails" ng-cloak>
                                        @include('user.product._inc.product_detail_form')
                                    </div>
                                    <div class="productSpecialFeature" ng-show="productSpecialFeature" ng-cloak>
                                        @include('user.product._inc.product_special_feature')
                                    </div>
                                    <div class="productImages" ng-show="productImages" ng-cloak>
                                        @include('user.product._inc.product_image_form')
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('user.product._inc.script')
    <script src="{{ asset('js/tokki/auth/tagsinput.js') }}"></script>
@endsection
