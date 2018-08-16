@extends('admin.layouts.master')
@section('style')
    <style>
        .productListImage {width: 65%;height: 65%;}
        .productListCard:hover{box-shadow: 0px 5px 25px rgba(0,0,0,0.1);z-index: 10;}
        .productListHeading {font-size: 14px;display: block;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;}
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
                                <?php $image = json_decode($product->image); ?>
                                <div class="col-3 mb-3">
                                    <div class="productListCard p-3">
                                        <div class="row justify-content-center">
                                            <img src="{{ asset('storage/product') }}/{{ array_get($image, 0) }}" class="productListImage">
                                        </div>
                                        <div class="row justify-content-center">
                                            <span><small>{{ $product->qty }} Pieces Available</small></span>
                                        </div>
                                        <div class="row">
                                            <dic class="col-12">
                                                <span class="productListHeading">{{ $product->heading }}</span>
                                            </dic>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-12">
                                                @if($product->discount_type == 'LKR')
                                                    <span>LKR {{ number_format($product->price - $product->discount, 2) }} <small> / piece</small></span>
                                                @else
                                                    <?php
                                                    $discountPrice = (1 - $product->discount/100) * $product->price;
                                                    ?>
                                                    <span>LRK {{ number_format($discountPrice, 2) }} <small> / piece</small></span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row justify-content-center mb-2">
                                            <small class="float-right badge @if($product->status == 'Accept') badge-success @elseif($product->status == 'Pending') badge-warning @elseif($product->status == 'Reject') badge-danger @endif">{{ $product->status }}</small>
                                        </div>
                                        <div class="row justify-content-center">
                                            <a href="{{ route('admin.product.show', $product->id) }}" class="btn btn-sm btn-primary">Show</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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