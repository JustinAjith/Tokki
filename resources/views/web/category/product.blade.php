@extends('web.layouts.master')
@section('style')
    <style>
        .page-item.active .page-link {background-color: #ff970c;border-color: #ff970c;}
        .page-link {padding: .35rem .6rem}
    </style>
@endsection
@section('content')
    <div class="container" ng-controller="CategoryController">
        <div class="row mt-3">
            <div class="col-md-12 col-sm-12">
                <h2 class="productCollectionHeading">{{ $heading }}</h2>
                @if(!count($products))
                    <div class="emptyProductList p-3">
                        <img src="{{ asset('images/general/empty_search.png') }}">
                        <span>Whooops, no listing match search criteria...</span>
                    </div>
                @else
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-2 col-md-4 col-sm-6 productListCardMain">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-right mt-3">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection