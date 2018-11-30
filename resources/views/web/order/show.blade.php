@extends('web.layouts.master')
@section('style')
    <style>
        .input-group-prepend{padding: 0;}
        .singleProductOrderForm form .orderFormHeading{border-bottom: 2px solid #ff970c; }
        #totalPriceInOrderSummery{color: #ff970c;}
        .productDetailTitle{color: #455a64;;font-size: 15px;}
        #orderHistory .table .thead-light tr th{padding: 6px .75rem}
        .productCollectionHeading {background: #e4e4e4;padding: 6px 5px;}
    </style>
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row" ng-controller="singleProductView">
            <div class="col-12">
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
                    <div class="col-md-7" ng-cloak>
                        <h2 class="singleProductHeading"><small>{{ $product->heading }}</small></h2>
                        <hr>
                        <div class="singleProductDetailsList">
                            <ul class="list-unstyled">
                                <?php
                                $discountPrice = $product->price;
                                ?>
                                <li><span class="productDetailTitle">Price :</span> LRK @if($product->discount > 0) <strike>{{ number_format($discountPrice, 2) }}</strike> @else {{ number_format($discountPrice, 2) }} @endif <small> / piece</small>
                                @if($product->discount > 0)
                                    @if($product->discount_type == 'LKR')
                                        <?php $discountPrice = $product->price - $product->discount; ?>
                                        <li><span class="productDetailTitle">Discount Price :</span> LKR {{ number_format($discountPrice, 2) }} <small> / piece</small> <span class="badge badge-danger">{{ number_format($product->discount, 2) }} LKR</span></li>
                                    @else
                                        <?php
                                        $discountPrice = (1 - $product->discount/100) * $product->price;
                                        ?>
                                        <li><span class="productDetailTitle">Discount Price :</span> LRK {{ number_format($discountPrice, 2) }} <small> / piece</small> <span class="badge badge-danger">{{ $product->discount }} %</span></li>
                                    @endif
                                @endif
                                @if($product->features != null)
                                    <?php
                                    $features = json_decode($product->features);
                                    $features_description = json_decode($product->features_description);
                                    ?>
                                    @foreach($features as $key => $feature)
                                        @if($feature != null)
                                            <?php $feature_descriptions = explode(",", array_get($features_description, $key)); ?>
                                            <li>
                                                <span class="productDetailTitle">{{ $feature }} :</span> @foreach($feature_descriptions as $feature_description)<span class="singleProductFeatures">{{ $feature_description }}</span>@endforeach
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                                <li><span class="productDetailTitle">Available Qty :</span> {{ $product->qty }}</li>
                                <?php
                                $places = json_decode($product->delivery_places);
                                ?>
                                <li><span class="productDetailTitle">Delivery Places :</span> @foreach($places as $place)<span class="singleProductFeatures">{{ $place }}</span>@endforeach</li>
                                <li><span class="productDetailTitle">Delivery :</span> {{ $product->delivery_duration }}</li>
                                <li><span class="productDetailTitle">Seller :</span> <a href="{{ route('seller.product.show', [str_replace(' ', '-', $product->name), $product->user_id]) }}">{{ $product->name }}</a></li>
                            </ul>
                            <hr>
                            <button class="btn btn-sm tokkiAccessButton" ng-click="showProductOrderForm()">Buy Now</button>
                        </div>
                    </div>
                </div>

                <div class="row singleProductDetails mt-2" ng-show="singleProductDetailsTab">
                    <div class="col-md-12">

                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#productDetailsTab" role="tab">Product Details</a></li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#orderHistory" role="tab">History</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active p-20" id="productDetailsTab" role="tabpanel">
                                <div class="row mt-2">
                                    <?php
                                    $productDetailsTitle = json_decode($product->title);
                                    $productDetailsDescription= json_decode($product->description);
                                    ?>
                                    @foreach($productDetailsTitle as $key => $title)
                                        <div class="col-md-6 mb-2 p-0">
                                            {{ $title }} : {{ array_get($productDetailsDescription, $key) }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane  p-20" id="orderHistory" role="tabpanel" ng-cloak>
                                <div class="text-center">
                                    <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading" ng-show="orderHistoryLoading">
                                </div>
                                <table class="table mt-2" ng-show="orderHistoryShow">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Buyer</th>
                                        <th>Place</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr ng-repeat="order in orderHistory">
                                        <td>@{{ order.name }}</td>
                                        <td>@{{ order.delivery_places }}</td>
                                        <td>@{{ order.qty }} piece</td>
                                        <td>@{{ order.date }}</td>
                                    </tr>
                                    <tr ng-if="orderHistory.length === 0">
                                        <td colspan="4"><center>No order to show</center></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="singleProductOrderForm mt-2" ng-show="singleProductOrderForm">
                    <form id="newProductOrder" ng-submit="newProductOrderSubmit()">
                        @include('web.order._inc.form')
                    </form>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <h2 class="productCollectionHeading">Related Products</h2>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-2 col-sm-4 col-xs-2 productListCardMain" ng-repeat="relatedProduct in relatedProducts" ng-show="relatedProductDiv">
                                <a ng-href="@{{ relatedProduct.link }}" ng-if="relatedProduct.name !== null">
                                    <div class="productListCard">
                                        <div class="productListDiscountBadge badge-danger p-0" ng-if="relatedProduct.discount !== 0">
                                            <span ng-if="relatedProduct.discount_type === 'LKR'" class="badge badge-danger">@{{ relatedProduct.discount | currency : "" }} @{{ relatedProduct.discount_type }}</span>
                                            <span ng-if="relatedProduct.discount_type === '%'" class="badge badge-danger">@{{ relatedProduct.discount }} @{{ relatedProduct.discount_type }}</span>
                                        </div>
                                        <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                            <img ng-src="{{ asset('storage/display_image') }}/@{{ relatedProduct.image }}" class="productListImage">
                                        </div>
                                        <div class="row justify-content-center">
                                            <small>@{{ relatedProduct.qty }} Pieces Available</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="productListHeading"><small>@{{ relatedProduct.name }}</small></h2>
                                            </div>
                                        </div>
                                        <div class="row pb-2">
                                            <div class="col-12">
                                                <span class="productListPrice">LKR @{{ relatedProduct.price }} </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                    <div ng-if="relatedProduct.name === null" class="emptyProductListDiv d-none d-sm-block">
                                        <img src="{{ asset('images/general/empty.jpg') }}" class="productListImage">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12" ng-show="relatedProductLoading">
                                <div class="text-center mt-5 mb-5">
                                    <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading">
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
    @include('web.order._inc.script')
@endsection