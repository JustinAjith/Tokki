<div class="row mt-3">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="productCollectionHeading">More To Love</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 col-sm-4 productListCardMain" ng-repeat="loveProduct in loveProducts" ng-show="moreToLoveProducts">
                        <a ng-href="@{{ loveProduct.link }}" ng-if="loveProduct.name !== null">
                            <div class="productListCard">
                                <div class="productListDiscountBadge badge-danger p-0" ng-if="loveProduct.discount !== 0">
                                    <span ng-if="loveProduct.discount_type === 'LKR'" class="badge badge-danger">@{{ loveProduct.discount | currency : "" }} @{{ loveProduct.discount_type }}</span>
                                    <span ng-if="loveProduct.discount_type === '%'" class="badge badge-danger">@{{ loveProduct.discount }} @{{ loveProduct.discount_type }}</span>
                                </div>
                                <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                    <img ng-src="{{ asset('storage/display_image') }}/@{{ loveProduct.image }}" class="productListImage">
                                </div>
                                <div class="row justify-content-center">
                                    <small>@{{ loveProduct.qty }} Pieces Available</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="productListHeading"><small>@{{ loveProduct.name }}</small></h2>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <span class="productListPrice">LKR @{{ loveProduct.price }} </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            <div ng-if="loveProduct.name === null" class="emptyProductListDiv">
                                <img src="{{ asset('images/general/empty.jpg') }}" class="productListImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" ng-show="moreToLoveLoading">
                        <div class="text-center mt-5 mb-5">
                            <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>