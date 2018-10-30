@extends('user.layouts.master')
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
                <li class="breadcrumb-item active"><a href="{{ route('user.order') }}">Order List</a></li>
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
                                <h2><small><a href="{{ route('user.product.show', $order->product_id) }}">{{ $order->product->heading }}</a></small></h2>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        Name<br>
                                        {{ $order->name }}
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        Contact<br>
                                        <div class="row">
                                            @if($order->status == 'Pending' || $order->status == 'Reject')
                                                <div class="col"><small>M.</small> **********</div>
                                                <div class="col"><small>T.</small> **********</div>
                                            @else
                                                <div class="col"><small>M.</small> {{ $order->mobile }}</div>
                                                <div class="col"><small>T.</small> {{ $order->telephone }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        Address<br>
                                        @if($order->status == 'Pending' || $order->status == 'Reject')
                                            *****************************
                                        @else
                                            {{ $order->street }}
                                        @endif<br>
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
                                    <div class="col-md-6" ng-cloak>
                                        <br>
                                        <small ng-show="customerReviewShow">Customer Review : @{{ customerReview }}</small>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="float-right">
                                            <button class="btn btn-sm btn-danger" ng-click="deleteOrder()"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</button>
                                        </div>
                                        @if($order->status == 'Pending')
                                            <div ng-show="pendingStatus">
                                                <button type="button" class="btn btn-sm btn-success" ng-click="orderAccept('Accept')">Accept</button>
                                                <button type="button" class="btn btn-sm btn-danger" ng-click="showRejectForm()">Reject</button>
                                            </div>
                                            <div ng-show="rejectForm">
                                                <form ng-submit="orderRejectSubmit()" id="orderRejectSubmit">
                                                    <div class="form-group">
                                                        <label>Reason</label>
                                                        <textarea class="form-control" rows="4" placeholder="please enter reason for reject" name="comment"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-sm btn-dark" ng-click="closeRejectForm()">Close</button>
                                                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        @elseif($order->status == 'Accept')
                                            <button type="button" class="btn btn-sm btn-success" ng-click="orderAccept('Complete')">Complete</button>
                                        @elseif($order->status == 'Reject')
                                            <span><small>{{ $order->comment }}</small></span>
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
    @include('user.order._inc.script')
@endsection