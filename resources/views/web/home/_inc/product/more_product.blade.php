<div class="row mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="productCollectionHeading">More Products</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-sm-4 productListCardMain" ng-repeat="moreProduct in moreProducts" ng-show="moreProductsDiv">
                        <a ng-href="@{{ moreProduct.link }}" ng-if="moreProduct.name !== null">
                            <div class="productListCard">
                                <div class="productListDiscountBadge badge-danger p-0" ng-if="moreProduct.discount !== 0">
                                    <span ng-if="moreProduct.discount_type === 'LKR'" class="badge badge-danger">@{{ moreProduct.discount | currency : "" }} @{{ moreProduct.discount_type }}</span>
                                    <span ng-if="moreProduct.discount_type === '%'" class="badge badge-danger">@{{ moreProduct.discount }} @{{ moreProduct.discount_type }}</span>
                                </div>
                                <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                    <img ng-src="{{ asset('storage/display_image') }}/@{{ moreProduct.image }}" class="productListImage">
                                </div>
                                <div class="row justify-content-center">
                                    <small>@{{ moreProduct.qty }} Pieces Available</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="productListHeading"><small>@{{ moreProduct.name }}</small></h2>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <span class="productListPrice">LKR @{{ moreProduct.price }} </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            <div ng-if="moreProduct.name === null" class="emptyProductListDiv d-none d-sm-block">
                                <img src="{{ asset('images/general/empty.jpg') }}" class="productListImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" ng-show="moreProductLoading">
                        <div class="text-center mt-5 mb-5">
                            <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>