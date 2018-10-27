<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="productCollectionHeading">Recent Offer</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-2 productListCardMain" ng-repeat="recentOffer in recentOffers" ng-show="recentOfferDiv">
                        <a ng-href="@{{ recentOffer.link }}" ng-if="recentOffer.name !== null">
                            <div class="productListCard">
                                <div class="productListDiscountBadge badge-danger p-0" ng-if="recentOffer.discount !== 0">
                                    <span ng-if="recentOffer.discount_type === 'LKR'" class="badge badge-danger">@{{ recentOffer.discount | currency : "" }} @{{ recentOffer.discount_type }}</span>
                                    <span ng-if="recentOffer.discount_type === '%'" class="badge badge-danger">@{{ recentOffer.discount }} @{{ recentOffer.discount_type }}</span>
                                </div>
                                <div class="row justify-content-center" style="padding: 1rem 1rem 0 1rem">
                                    <img ng-src="{{ asset('storage/display_image') }}/@{{ recentOffer.image }}" class="productListImage">
                                </div>
                                <div class="row justify-content-center">
                                    <small>@{{ recentOffer.qty }} Pieces Available</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h2 class="productListHeading"><small>@{{ recentOffer.name }}</small></h2>
                                    </div>
                                </div>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <span class="productListPrice">LKR @{{ recentOffer.price }} </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="text-center">
                            <div ng-if="recentOffer.name === null" class="emptyProductListDiv">
                                <img src="{{ asset('images/general/empty.jpg') }}" class="productListImage">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" ng-show="recentOfferLoading">
                        <div class="text-center mt-5 mb-5">
                            <img src="{{ asset('images/general/loading.gif') }}" class="tokkiLoading">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>