<div ng-controller="editProductDetailsController">
    <form class="form-horizontal" method="post" action="{{ route('user.product.edit.product.details', $product) }}">
        @csrf
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
        <?php
            $titles = json_decode($product->title);
            $description = json_decode($product->description);
        ?>
        <div class="row" ng-repeat="detail in details">
            <div class="col-sm-4 col-md-5">
                <div class="form-group">
                    <input type="text" name="title[]" ng-model="detail.productTitle" class="form-control" placeholder="enter title">
                </div>
            </div>
            <div class="col-sm-7 col-md-6">
                <div class="form-group">
                    <input type="text" name="description[]" ng-model="detail.productDescription" class="form-control" placeholder="enter description">
                </div>
            </div>
            <div class="col-sm-1 col-md-1">
                <button type="button" class="btn btn-sm btn-danger" ng-click="removeProductDetail($index)" style="margin-top: 6px;"><i class="fa fa-times"></i></button>
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
        app.controller('editProductDetailsController', function($scope) {

            var title = @json($titles);
            var description = @json($description);

            $scope.details = [];
            $scope.add = function() {
                $scope.details.push({});
            };
            for(var i=0; i < title.length; i++){
                $scope.details.push({
                    'productTitle': title[i],
                    'productDescription': description[i],
                });
            }

            $scope.removeProductDetail = function(index) {
                var detailCount = $scope.details.length;
                if (detailCount > 1) {
                    $scope.details.splice(index, 1);
                } else {
                    swal("Ooops!", "You must add minimum one product detail !", "error");
                }
            };
        });
    </script>
@endsection