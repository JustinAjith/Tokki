@extends('admin.layouts.master')
@section('style')
    <style>
        .orderProductDetails ul li{margin-bottom: 10px;}
        .orderProductImage{width: 70%;}
        .orderProductImageList{width: 10%; height: 10%;cursor: pointer;}
    </style>
@endsection
@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Order</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('admin.order') }}">Order List</a></li>
                <li class="breadcrumb-item active">Order</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="orderController" ng-cloak>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row orderProductDetails">
                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                        $productImage = json_decode($order->product->image);
                                        ?>
                                        <center><img ng-src="{{ asset('storage/product') }}/@{{ viewBigImage }}" alt="" class="orderProductImage"></center>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <img ng-repeat="image in images | limitTo : 6" ng-src="{{ asset('storage/product') }}/@{{ image }}" class="orderProductImageList m-1" ng-click="showImage(image)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <small class="float-right badge @if($order->status == 'Accept') badge-success @elseif($order->status == 'Complete') badge-primary @elseif($order->status == 'Pending') badge-warning @elseif($order->status == 'Reject') badge-danger @endif" style="margin-top: 12px;">{{ $order->status }}</small>
                                <h2><small><a href="{{ route('admin.product.show', $order->product_id) }}">{{ $order->product->heading }}</a></small></h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        Name<br>
                                        {{ $order->name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        Contact<br>
                                        <div class="row">
                                            <div class="col"><small>M.</small> {{ $order->mobile }}</div>
                                            <div class="col"><small>T.</small> {{ $order->telephone }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        Address<br>
                                        {{ $order->street }}<br>
                                        {{ $order->city }}
                                    </div>
                                    <div class="col-md-6">
                                        Delivery place<br>
                                        {{ $order->delivery_places }}
                                    </div>
                                </div>
                                <hr>
                                @if(isset($order->features))
                                    <div class="row">
                                        <?php
                                        $productFeatures = json_decode($order->features);
                                        $productFeaturesDescription= json_decode($order->features_description);
                                        ?>
                                        @foreach($productFeatures as $key => $feature)
                                            <div class="col-md-6 mb-3">
                                                {{ $feature }}<br>
                                                {{ array_get($productFeaturesDescription, $key) }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        Order Qty<br>
                                        {{ $order->qty }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        Total Price<br>
                                        @if($order->discount > 0)
                                            @if($order->discount_type == 'LKR')
                                                <?php
                                                $discountPrice = $order->price - $order->discount;
                                                ?>
                                                LKR {{ number_format($discountPrice * $order->qty, 2) }}  | <small> ( {{ number_format($discountPrice, 2) }} * {{ $order->qty }} ) </small>
                                            @else
                                                <?php
                                                $discountPrice = (1 - $order->discount/100) * $order->price;
                                                ?>
                                                LRK {{ number_format($discountPrice * $order->qty, 2) }}  | <small> ( {{ number_format($discountPrice, 2) }} * {{ $order->qty }} ) </small>
                                            @endif
                                        @else
                                            LKR {{ number_format($order->price * $order->qty, 2) }} | <small> ( {{ number_format($order->price, 2) }} * {{ $order->qty }} ) </small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        Order Date<br>
                                        {{ $order->date }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        @if($order->status == 'Reject')
                                            <span><small>{{ $order->comment }}</small></span>
                                        @endif

                                        @if($order->delete_status == 1)
                                            <button class="float-right btn btn-sm btn-danger" ng-click="deleteOrder()">Delete</button>
                                            <h6 class="text-danger">This order was deleted.</h6>
                                        @endif
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
    <script>
        app.controller('orderController', function($scope, $http) {
            $scope.images = @json($productImage);
            $scope.viewBigImage = $scope.images[0];
            $scope.showImage = function($image) {
                $scope.viewBigImage = $image;
            };

            $scope.deleteOrder = function() {
                var id = "{{ $order->id }}";
                var routeUrl = '{{ route('admin.order.delete', ['id'=>'ID']) }}';
                routeUrl = routeUrl.replace('ID', id);
                swal({
                    title: "Are you sure?",
                    text: "Do you want delete this order?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((isConfirm) => {
                    if (isConfirm) {
                        $http({
                            method: 'DELETE',
                            url: routeUrl,
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).then(function(response){
                            swal("Your action was successfully completed!", {icon: "success",});
                            window.location.href = '{{ route('admin.delete.order') }}';
                        },function(error) {

                        });
                    }
                });
            };
        });
    </script>
@endsection