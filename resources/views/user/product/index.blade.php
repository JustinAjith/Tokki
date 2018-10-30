@extends('user.layouts.master')
@section('style')
    <style>
        .productListImage {width: 100%;height: 100%;}
        .productListCard:hover{box-shadow: 0px 5px 25px rgba(0,0,0,0.1);z-index: 10;}
        .productListHeading {font-size: 14px;display: block;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
        .productPrice {font-weight: 700;font-size: 16px;color: #ff970c;}
        .emptyProductList {background: #f1f1f1;}
        .emptyProductList img{width: 95px;opacity: 0.8;}
        .productListCard .productStatusBadge {position: absolute;top: 10px;padding: 2px 5px;font-size: 12px;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Product List</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Product List</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-3 mb-3">
                                    <a href="{{ route('user.product.show', $product->id) }}">
                                        <div class="productListCard p-3">
                                            <div class="productStatusBadge badge @if($product->status == 'Accept') badge-success @elseif($product->status == 'Pending') badge-warning @elseif($product->status == 'Reject') badge-danger @endif">
                                                <span>{{ $product->status }}</span>
                                            </div>
                                            <div class="row justify-content-center" style="padding: 0 20px;">
                                                <img src="{{ asset('storage/display_image') }}/{{ $product->display_image }}" class="productListImage">
                                            </div>
                                            <div class="row justify-content-center">
                                                <span><small>{{ $product->qty }} Pieces Available</small></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="productListHeading">{{ $product->heading }}</span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    @if($product->discount_type == 'LKR')
                                                        <span class="productPrice">LKR {{ number_format($product->price - $product->discount, 2) }}</span> <small> / piece</small>
                                                    @else
                                                        <?php
                                                        $discountPrice = (1 - $product->discount/100) * $product->price;
                                                        ?>
                                                        <span class="productPrice">LRK {{ number_format($discountPrice, 2) }}</span> <small> / piece</small>
                                                    @endif
                                                </div>
                                            </div>
                                            {{--<div class="row justify-content-center mb-2">--}}
                                                {{--<small class="float-right">{{ $product->status }}</small>--}}
                                            {{--</div>--}}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            @if(!count($products))
                                    <div class="col-md-12 emptyProductList p-3">
                                        <img src="{{ asset('images/general/empty_search.png') }}">
                                        <span>Whooops, no listing match search criteria...</span>
                                    </div>
                            @endif
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection