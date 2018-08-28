@extends('web.layouts.master')
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
                    <div class="col-md-7">
                        <h2 class="singleProductHeading"><small>{{ $product->heading }}</small></h2>
                        <hr>
                        <div class="singleProductDetailsList">
                            <ul class="list-unstyled">
                                <li>Price : LRK @if($product->discount > 0) <strike>{{ number_format($product->price, 2) }}</strike> @else {{ number_format($product->price, 2) }} @endif <small> / piece</small>
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

                        </div>
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
                                        <div class="col-md-6 mb-2">
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
@endsection

@section('script')
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