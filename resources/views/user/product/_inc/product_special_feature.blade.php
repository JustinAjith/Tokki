<div class="row">
    <div class="col-md-12">
        <h4>Special Features</h4>
        <input type="hidden" name="select_special_features" ng-value="select_special_features">
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Category</label>
            <input type="text" name="features[]" class="form-control" ng-disabled="specialFeaturesInput()">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label">Category</label>
            <input type="text" name="features_description[]" class="form-control tags" id="tags_1" ng-disabled="specialFeaturesInput()">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="float-right">
            <button type="button" class="btn btn-sm btn-dark" ng-click="goBackToGeneralForm()">Back</button>
            <button type="button" class="btn btn-sm btn-primary">Next</button>
        </div>
    </div>
</div>