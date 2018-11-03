@extends('web.layouts.master')
@section('style')
    <style>
        .shoppingCart{font-size: 80px;}
    </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-9">
                <center>
                    <i class="fa fa-shopping-cart shoppingCart" aria-hidden="true"></i>
                    <h5>Your select product did not match any products. Please try again.</h5>
                    <a href="{{ route('welcome') }}" class="btn btn-md btn-outline-danger">Go back to home</a>
                </center>
            </div>
            <div class="col-md-3">

            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 col-sm-12">
                <h2 class="productCollectionHeading">More Products</h2>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-2 productListCardMain">
                            <a href="{{ route('single.product.show', [str_replace(' ', '-', $product->heading), $product->id]) }}">
                                <div class="productListCard">
                                    @if($product->discount > 0)
                                        <span class="productListDiscountBadge badge-danger">
                                                @if($product->discount_type == 'LKR')
                                                {{ number_format($product->discount, 2) }} {{ $product->discount_type }}
                                            @else
                                                {{ $product->discount }}{{ $product->discount_type }}
                                            @endif
                                            </span>
                                    @endif
                                    <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                        <img src="{{ asset('storage/display_image') }}/{{ $product->display_image }}" class="productListImage">
                                    </div>
                                    <div class="row justify-content-center">
                                        <small>{{ $product->qty }} Pieces Available</small>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h2 class="productListHeading"><small>{{ $product->heading }}</small></h2>
                                        </div>
                                    </div>
                                    <div class="row pb-2">
                                        <div class="col-12">
                                            <span class="productListPrice">
                                                LKR
                                                @if($product->discount == 0)
                                                    {{ number_format($product->price, 2) }}
                                                @else
                                                    @if($product->discount_type == 'LKR')
                                                        {{ number_format($product->price - $product->discount, 2) }}
                                                    @else
                                                        <?php
                                                        $discountPrice = (1 - $product->discount/100) * $product->price;
                                                        ?>
                                                        {{ number_format($discountPrice, 2) }}
                                                    @endif
                                                @endif
                                            </span> <small>/ piece</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection