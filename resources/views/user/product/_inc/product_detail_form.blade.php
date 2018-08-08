<div class="row">
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
<div class="row">
    <div class="col-sm-4 col-md-5"><span class="error_response">@{{ productDetailTitleError }}</span></div>
    <div class="col-sm-7 col-md-6"><span class="error_response">@{{ productDetailDescriptionError }}</span></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-dark" ng-click="goBackToGeneralForm()">Back</button>
            <button type="button" class="btn btn-sm btn-primary" ng-click="productDetailCheck()">Next</button>
        </div>
    </div>
</div>
