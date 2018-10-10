@extends('admin.layouts.master')
@section('style')
    <style>
        .singleProductDetails ul li{margin-bottom: 10px;}
        .singleProductImage{width: 70%;}
        .singleProductImageList{width: 10%; height: 10%;cursor: pointer;}
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
                <li class="breadcrumb-item active"><a href="{{ route('admin.product') }}">Product List</a></li>
                <li class="breadcrumb-item active">Product</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="singleProductView">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row singleProductDetails">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                            $productImage = json_decode($product->image);
                                        ?>
                                        <center><img ng-src="{{ asset('storage/product') }}/@{{ viewBigImage }}" alt="" class="singleProductImage"></center>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <img ng-repeat="image in images | limitTo : 6" ng-src="{{ asset('storage/product') }}/@{{ image }}" class="singleProductImageList m-1" ng-click="showImage(image)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <small class="float-right badge @if($product->status == 'Accept') badge-success @elseif($product->status == 'Pending') badge-warning @elseif($product->status == 'Reject') badge-danger @endif" style="margin-top: 12px;">{{ $product->status }}</small>
                                <h2><small>{{ $product->heading }}</small></h2>
                                <hr>
                                <ul>
                                    <li>Price : LRK @if($product->discount > 0) <strike>{{ number_format($product->price, 2) }}</strike> @else {{ number_format($product->price, 2) }} @endif <small> / piece</small></li>
                                    @if($product->discount > 0)
                                        @if($product->discount_type == 'LKR')
                                            <li>Discount Price : LKR {{ number_format($product->price - $product->discount, 2) }} <small> / piece</small> <span class="badge badge-danger">{{ number_format($product->discount, 2) }} LKR</span></li>
                                        @else
                                            <?php
                                            $discountPrice = (1 - $product->discount/100) * $product->price;
                                            ?>
                                            <li>Discount Price : LRK {{ number_format($discountPrice, 2) }} <small> / piece</small> <span class="badge badge-danger">{{ $product->discount }} %</span></li>
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
                                <hr>
                                <a href="{{ route('admin.product.order', $product) }}" class="btn btn-sm btn-secondary"><i class="fa fa-shopping-cart"></i> Orders</a>
                                @if($product->status == 'Accept')
                                    <button class="btn btn-sm btn-danger changeProductStatus" value="Reject">Reject</button>
                                @elseif($product->status == 'Pending')
                                    <button class="btn btn-sm btn-success changeProductStatus" value="Accept">Accept</button> <button class="btn btn-sm btn-danger changeProductStatus" value="Reject">Reject</button>
                                @elseif($product->status == 'Reject')
                                    <button class="btn btn-sm btn-success changeProductStatus" value="Accept">Accept</button>
                                @endif
                            </div>
                        </div>
                        <div class="row singleProductDetails">
                            <div class="col-md-12">

                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#productDetailsTab" role="tab">Product Details</a></li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#feedBackTab" role="tab">Feedback</a></li>
                                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#chartTab" role="tab">Chart</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div class="tab-pane active p-20" id="productDetailsTab" role="tabpanel">
                                        <div class="row">
                                            <?php
                                            $productDetailsTitle = json_decode($product->title);
                                            $productDetailsDescription= json_decode($product->description);
                                            ?>
                                            @foreach($productDetailsTitle as $key => $title)
                                                <div class="col-md-6">
                                                    {{ $title }} : {{ array_get($productDetailsDescription, $key) }}
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane  p-20" id="feedBackTab" role="tabpanel">
                                        Feed Back
                                    </div>
                                    <div class="tab-pane p-20" id="chartTab" role="tabpanel">
                                        Chart
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin.product._inc.script')
    <script>
        app.controller('singleProductView', function($scope){
            $scope.images = @json($productImage);
            $scope.viewBigImage = $scope.images[0];
            $scope.showImage = function($image) {
                $scope.viewBigImage = $image;
            }
        });
    </script>
@endsection