<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h4 class="productCollectionHeading">New Products</h4>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-3 productListCardMain" ng-repeat="newProduct in newProducts">
                        <a ng-href="@{{ newProduct.link }}">
                            <div class="productListCard">
                                <div class="row justify-content-center" style="padding: 25px 30px 0 30px">
                                    <img ng-src="{{ asset('storage/display_image') }}/@{{ newProduct.image }}" class="productListImage">
                                </div>
                                <div class="row justify-content-center">
                                    <span><small>@{{ newProduct.qty }} Pieces Available</small></span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <span class="productListHeading">@{{ newProduct.name }}</span>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>