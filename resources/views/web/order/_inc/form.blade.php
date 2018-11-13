<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12 orderFormHeading mb-2">
                <h4>Delivery details</h4>
            </div>
        </div>

        @if(isset($features))
            <div class="row">
                @foreach($features as $key=>$feature)
                    @if($feature != null)
                        <?php $feature_descriptions = explode(",", array_get($features_description, $key)); ?>
                        <div class="form-group col-md-6 col-sm-6">
                            <label class="mb-1">{{ $feature }}</label>
                            <input type="hidden" value="{{ $feature }}" name="features[]">
                            <select class="form-control" name="features_description[]">
                                <option value="">Choose one</option>
                                @foreach($feature_descriptions as $feature_description)
                                    <option value="{{ $feature_description }}">{{ $feature_description }}</option>
                                @endforeach
                            </select>
                            <small>@{{ errors[0].features_description }}</small>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Street address</label>
                <input type="text" name="street" class="form-control" placeholder="enter street address">
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">City</label>
                <input type="text" name="city" class="form-control" placeholder="enter city">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Delivery place</label>
                <select class="form-control" name="delivery_places">
                    <option value="">Choose place</option>
                    @if(array_get($places, 0) != 'All Srilanka')
                        @foreach($places as $place)
                            <option value="{{ $place }}">{{ $place }}</option>
                        @endforeach
                    @else
                        @foreach(city() as $place)
                            @if($place == 'All Srilanka')
                                @continue
                            @endif
                            <option value="{{ $place }}">{{ $place }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Qty</label>
                <div class="row m-0 p-0">
                    <div class="col-1 input-group-prepend">
                        <button type="button" class="btn btn-dark btn-sm" id="minus-btn" ng-click="productQtyMinus()"><i class="fa fa-minus"></i></button>
                    </div>
                    <div class="col-10 m-0 p-0">
                        <input type="number" name="qty" id="qty_input" class="form-control form-control-sm" value="1" min="1">
                    </div>
                    <div class="col-1 input-group-prepend">
                        <button type="button" class="btn btn-dark btn-sm" id="plus-btn" ng-click="productQtyPlus()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Full name</label>
                <input type="text" name="name" class="form-control" placeholder="enter your full name">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Mobile Number</label>
                <input type="text" name="mobile" class="form-control" placeholder="enter mobile number">
            </div>
            <div class="form-group col-md-6 col-sm-6">
                <label class="mb-1">Telephone Number</label>
                <input type="text" name="telephone" class="form-control" placeholder="enter telephone number">
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12 orderFormHeading mb-2">
                <h4>Order summary</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h5><small>Price :</small> <b class="float-right" id="singleProductPrice">@if($product->discount > 0) {{ number_format($discountPrice, 2) }} @else {{ number_format($product->price, 2) }} @endif</b></h5>
                <h5><small>T.Qty :</small> <b class="float-right" id="totalQtyValueInOrderSummery"></b></h5>
                <h5><small>Total :</small> <b class="float-right" id="totalPriceInOrderSummery">@{{ totalPrice | number: 2 }}</b></h5>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 mt-1">
                <button type="button" class="btn btn-sm btn-dark" ng-click="showSingleProductDetailsList()">Close</button>
                <button type="submit" class="btn btn-sm tokkiAccessButton">Submit Order</button>
            </div>
        </div>
    </div>
</div>