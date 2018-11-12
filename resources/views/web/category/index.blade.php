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
            <div class="col-md-3 d-none d-md-block">
                <div class="refineCategory">
                    <div class="refineCategoryList">
                        <h5><small>Related Categories</small></h5>
                        <hr class="mt-2 mb-2">
                        <ul class="list-unstyled">
                            @foreach($categories as $category)
                                <li><a href="{{ route('web.category.product', $category->ref_id) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="refineCategoryRecentProductList">
                        <h5><small>Recent Products</small></h5>
                        <hr class="mt-2 mb-2">
                        <div class="row">
                            <div class="col-md-6 p-1" ng-repeat="newProduct in newProducts">
                                <div class="productListCard">
                                    <a ng-href="@{{ newProduct.link }}" ng-if="newProduct.name !== null"><img ng-src="{{ asset('storage/display_image') }}/@{{ newProduct.image }}" class="recentProductImage"></a>
                                </div>
                                <img src="{{ asset('images/general/empty.jpg') }}" ng-if="newProduct.name === null" class="recentProductImage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="float-right" style="margin-top: 6px;">
                    <div class="productFilterOptionsDiv">
                        <span>Sort by:</span>
                    </div>
                    <div class="productFilterOptionsDiv">
                        <div class="btn-group btn-group-sm">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Order By</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('web.category.product.filter', [$sub_category->ref_id, 'order-by', 'asc']) }}">ASC Order</a>
                                    <a class="dropdown-item" href="{{ route('web.category.product.filter', [$sub_category->ref_id, 'order-by', 'desc']) }}">DESC order</a>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Discount</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('web.category.product.filter', [$sub_category->ref_id, 'discount', '%']) }}">Discount by %</a>
                                    <a class="dropdown-item" href="{{ route('web.category.product.filter', [$sub_category->ref_id, 'discount', 'LKR']) }}">Discount by LKR</a>
                                </div>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Place</button>
                                <div class="dropdown-menu" style="overflow: auto;height: 190px;">
                                    @foreach(city() as $key=>$place)
                                        @if($key == 'All Srilanka')
                                            @continue
                                        @endif
                                        <a class="dropdown-item" href="{{ route('web.category.product.filter', [$sub_category->ref_id, 'place', $place]) }}">{{ $place }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="productCollectionHeading">{{ $sub_category->name }}</h2>
                @if(!count($products))
                    <div class="emptyProductList p-3">
                        <img src="{{ asset('images/general/empty_search.png') }}">
                        <span>Whooops, no listing match search criteria...</span>
                    </div>
                @else
                    <div class="row">
                        @foreach($products as $product)
                            <div class="col-lg-3 col-md-4 col-sm-6 productListCardMain">
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

@section('script')
    <script>
        app.controller('CategoryController', function($http, $scope){
            $scope.baseUrl = '{{ URL::to('api/web-home') }}';
            $http.get($scope.baseUrl + '/new-products').then(function(response){
                $scope.newProducts = [];
                if(response.data.length !== 4) {
                    for(var i=0; i < 4; i++) {
                        if(response.data[i]) {
                            $scope.newProducts.push(response.data[i]);
                        } else {
                            $scope.newProducts.push({name: null});
                        }
                    }
                } else {
                    $scope.newProducts = response.data;
                }
            });
        });
    </script>
@endsection