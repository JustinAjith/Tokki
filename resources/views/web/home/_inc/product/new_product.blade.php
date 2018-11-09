<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="productCollectionHeading">New Products</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-sm-4 col-xs-2 productListCardMain" ng-repeat="newProduct in newProducts" ng-show="newProductDiv">
                        <a ng-href="@{{ newProduct.link }}" ng-if="newProduct.name !== null">
                            <div class="productListCard">
                                <div class="productListDiscountBadge badge-danger p-0" ng-if="newProduct.discount !== 0">
                                    <span ng-if="newProduct.discount_type === 'LKR'" class="badge badge-danger">@{{ newProduct.discount | currency : "" }} @{{ newProduct.discount_type }}</span>
                                    <span ng-if="newProduct.discount_type === '%'" class="badge badge-danger">@{{ newProduct.discount }} @{{ newProduct.discount_type }}</span>
                                </div>
                                <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                    <img ng-src="{{ asset('storage/display_image') }}/@{{ newProduct.image }}" class="productListImage">
                                </div>
                                <div class="row justify-content-center">
                                    <small>@{{ newProduct.qty }} Pieces Available</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="productListHeading"><small>@{{ newProduct.name }}</small></h2>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <span class="productListPrice">LKR @{{ newProduct.price }} </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            {{--<span ng-if="newProduct.name === null" class="productListEmptyProduct">No product to show</span>--}}
                            <div ng-if="newProduct.name === null" class="emptyProductListDiv d-none d-sm-block">
                                <img src="{{ asset('images/general/empty.jpg') }}" class="productListImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" ng-show="newProductLoading">
                        <div class="text-center mt-5 mb-5">
                            <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>