@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Edit</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.product') }}">Products</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.product.show', $product) }}">Show</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if($type == 'general-details')
                            @include('user.product._inc.edit.product_general_form')
                        @elseif($type == 'product-details')
                            @include('user.product._inc.edit.product_details')
                        @elseif($type == 'special-features')
                            @include('user.product._inc.edit.special_features_form')
                        @elseif($type == 'images')
                            @include('user.product._inc.edit.images')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection