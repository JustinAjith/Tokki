<div ng-controller="editProductSpecialFeatures">
    <form class="form-horizontal" method="post" action="{{ route('user.product.special.features.edit', $product) }}">
        @csrf
        <div class="row mt-3">
            <div class="col-md-12">
                <h4>Special Features</h4>
                <hr>
            </div>
        </div>
        <?php
            $features = json_decode($product->features);
            $featuresDescription = json_decode($product->features_description);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Special Feature Title</label>
                    <input type="text" name="features[]" class="form-control" value="{{ array_get($features, 0) }}" placeholder="enter special feature title">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Special Feature Title</label>
                    <input type="text" name="features[]" class="form-control" value="{{ array_get($features, 1) }}" placeholder="enter special feature title">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Special Feature Description</label>
                    <input type="text" name="features_description[]" class="form-control special_feature_tags" value="{{ array_get($featuresDescription, 0) }}" id="tags_1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Special Feature Description</label>
                    <input type="text" name="features_description[]" class="form-control special_feature_tags" value="{{ array_get($featuresDescription, 1) }}" id="tags_2">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="float-right">
                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>

</div>

@section('script')
    <script>
        app.controller('editProductSpecialFeatures', function($scope) {

        });
    </script>

    <script type="text/javascript">
        function onAddTag(tag) {
            alert("Added a tag: " + tag);
        }
        function onRemoveTag(tag) {
            alert("Removed a tag: " + tag);
        }
        function onChangeTag(input,tag) {
            alert("Changed a tag: " + tag);
        }
        $(function() {
            $('.special_feature_tags').tagsInput({width:'auto'});
        });
    </script>
@endsection