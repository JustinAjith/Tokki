<form class="form-horizontal" method="post" action="{{ route('user.product.price', $product) }}">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label" style="padding-top: 0px;">Price</label>
                <input type="text" name="price" class="form-control" placeholder="enter product price" value="{{ $product->price }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label class="control-label">Discount</label>
                <div class="row">
                    <div class="col-8" style="padding-right: 5px;">
                        <input type="text" name="discount" class="form-control" placeholder="enter product discount" value="{{ $product->discount }}">
                    </div>
                    <div class="col-4" style="padding-left: 0px;">
                        <select name="discount_type" class="form-control">
                            @foreach(discountType() as $key => $value)
                                <option value="{{ $value }}" @if($product->discount_type == $value) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="float-right">
                <button type="button" class="btn btn-sm btn-dark" ng-click="closeProductPriceForm()">Close</button>
                <button type="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
    </div>

</form>