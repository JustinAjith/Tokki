<div class="row">
    <div class="col-md-12">
        <h4>General Details</h4>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group ng-class: categoryInput;">
            <label class="control-label">Category</label>
            <input type="text" name="category" class="form-control" readonly="true" ng-value="category">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group ng-class: subCategoryInput;">
            <label class="control-label">Sub category</label>
            <input type="text" name="sub_category" class="form-control" readonly="true" ng-value="subCategory">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Code (optional)</label>
            <input type="text" name="code" class="form-control" placeholder="enter product code">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group ng-class: headingInput;">
            <label class="control-label">Heading</label>
            <input type="text" name="heading" class="form-control" placeholder="enter product heading">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group ng-class: keywordInput;">
            <label class="control-label">Key word</label>
            <input type="text" name="key_word" class="form-control" placeholder="enter product key word">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group ng-class: priceInput;">
            <label class="control-label">Price</label>
            <input type="text" name="price" class="form-control" placeholder="enter product price">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Discount</label>
            <div class="row">
                <div class="col-8 ng-class: discountInput;" style="padding-right: 5px;">
                    <input type="text" name="discount" class="form-control" placeholder="enter product discount">
                </div>
                <div class="col-4 ng-class: discountTypeInput;" style="padding-left: 0px;">
                    <input type="text" name="discount_type" class="form-control" placeholder="enter product discount type">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-dark" ng-click="goBackToSelectCategory()">Back</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="generalProductDetailCheckAndGoSpecialFeatures()">Special Features</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="generalProductDetailCheck()">Next</button>
        </div>
    </div>
</div>
