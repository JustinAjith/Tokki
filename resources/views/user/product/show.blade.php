@extends('user.layouts.master')
@section('style')
    <style>
        .singleProductDetails ul li{margin-bottom: 10px;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Product</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('user.product') }}">Product List</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row singleProductDetails">
                            <div class="col-md-5">
                                <?php
                                    $productImage = json_decode($product->image);
                                ?>
                                <img src="{{ asset('storage/product') }}/{{ $productImage[0] }}" alt="">
                            </div>
                            <div class="col-md-7">
                                <small class="float-right" style="margin-top: 12px;">{{ $product->status }}</small>
                                <h2><small>{{ $product->heading }}</small></h2>
                                <hr>
                                <ul>
                                    <li>Price : LRK @if($product->discount > 0) <strike>{{ $product->price }}</strike> @else {{ $product->price }} @endif <small> / piece</small></li>
                                    @if($product->discount > 0)
                                        @if($product->discount_type == 'LKR')
                                            <li>Discount Price : LKR {{ number_format($product->price - $product->discount, 2) }} <small> / piece</small> <span class="badge badge-danger">{{ number_format($product->discount, 2) }} LKR</span></li>
                                        @else
                                            <?php
                                                $discountPrice = (1 - $product->discount/100) * $product->price;
                                            ?>
                                            <li>Discount Price : LRK {{ number_format($discountPrice, 2) }} / <small> / piece</small> <span class="badge badge-danger">{{ $product->discount }} %</span></li>
                                        @endif
                                    @endif
                                    @if($product->features != null)
                                        <?php
                                            $features = json_decode($product->features);
                                            $features_description = json_decode($product->features_description);
                                        ?>
                                        @foreach($features as $key => $feature)
                                            <li>
                                                {{ $feature }} : {{ array_get($features_description, $key) }}
                                            </li>
                                        @endforeach
                                    @endif
                                    <li>Available Qty : {{ $product->qty }}</li>
                                    <?php
                                        $places = json_decode($product->delivery_places);
                                    ?>
                                    <li>Delivery Places : @foreach($places as $place) {{ $place }} , @endforeach</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection