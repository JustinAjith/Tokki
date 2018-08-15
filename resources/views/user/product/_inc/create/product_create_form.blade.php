{{--    General Product Details     --}}
<div class="row">
    <div class="col-md-12">
        <h4>General Details</h4>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Category</label>
            <input type="text" name="category" class="form-control" readonly="true" ng-value="category">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Sub category</label>
            <input type="text" name="sub_category" class="form-control" readonly="true" ng-value="subCategory">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Code (optional)</label>
            <input type="text" name="code" class="form-control" placeholder="enter product code" value="{{ old('code') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Heading</label>
            <input type="text" name="heading" class="form-control" placeholder="enter product heading" value="{{ old('heading') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Key word</label>
            <input type="text" name="key_word" class="form-control" placeholder="enter product key word" value="{{ old('key_word') }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="enter product price" value="{{ old('price') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Discount</label>
            <div class="row">
                <div class="col-8" style="padding-right: 5px;">
                    <input type="text" name="discount" class="form-control" placeholder="enter product discount" value="{{ old('discount') }}">
                </div>
                <div class="col-4" style="padding-left: 0px;">
                    <select name="discount_type" class="form-control">
                        @foreach(discountType() as $key => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Available Qty</label>
            <input type="text" name="qty" class="form-control" placeholder="enter available qty" value="{{ old('qty') }}">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Delivery Places</label>
            <select name="delivery_places[]" class="form-control selectpicker" multiple>
                @foreach(city() as $key => $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Product Images</label>
            <input type="file" name="image[]" class="form-control" multiple>
        </div>
    </div>
</div>

{{--    Product Infomation     --}}
<div class="row mt-3">
    <div class="col-md-12">
        <div class="float-right"><button type="button" class="btn btn-sm btn-warning" ng-click="add()">Add</button></div>
        <h4>Product Details</h4>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-md-5"><h3><small>Title</small></h3></div>
    <div class="col-sm-8 col-md-7"><h3><small>Description</small></h3></div>
</div>
<div class="row" ng-repeat="detail in details">
    <div class="col-sm-4 col-md-5">
        <div class="form-group">
            <input type="text" name="title[]" class="form-control" placeholder="enter title">
        </div>
    </div>
    <div class="col-sm-7 col-md-6">
        <div class="form-group">
            <input type="text" name="description[]" class="form-control" placeholder="enter description">
        </div>
    </div>
    <div class="col-sm-1 col-md-1">
        <button type="button" class="btn btn-sm btn-danger" ng-click="removeProductDetail($index)" style="margin-top: 6px;"><i class="fa fa-times"></i></button>
    </div>
</div>

{{--    Product Special Features    --}}
<div class="row mt-3">
    <div class="col-md-12">
        <h4>Special Features</h4>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Special Feature Title</label>
            <input type="text" name="features[]" class="form-control" placeholder="enter special feature title">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Special Feature Title</label>
            <input type="text" name="features[]" class="form-control" placeholder="enter special feature title">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Special Feature Description</label>
            <input type="text" name="features_description[]" class="form-control special_feature_tags" id="tags_1">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Special Feature Description</label>
            <input type="text" name="features_description[]" class="form-control special_feature_tags" id="tags_2">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-dark" ng-click="goBackToSelectCategory()">Back</button>
            <button type="submit" class="btn btn-sm btn-success">Submit</button>
        </div>
    </div>
</div>
