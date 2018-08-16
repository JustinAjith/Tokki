<div ng-controller="editProductImageController">
    <form class="form-horizontal" method="post" action="{{ route('user.product.image.edit', $product) }}" enctype="multipart/form-data">
        @csrf
        <div class="row mt-3">
            <div class="col-md-12">
                <h4>Product Images</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">New Images</label>
                    <input type="file" name="image[]" class="form-control" multiple>
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

    <div class="row mt-3">
        <div class="col-md-12">
            <h4>Current Images</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <?php
            $currentImages = json_decode($product->image);
        ?>
        <div class="col-md-2 mb-3" ng-repeat="image in images">
            <img ng-src="{{ asset('storage/product') }}/@{{ image }}" alt="" style="width: 100%;">
            <center><button class="btn btn-sm btn-danger mt-1 removeProductImage" ng-click="removeProductImage($index, image)"><i class="fa fa-trash-o" aria-hidden="true"></i> Remove</button></center>
        </div>
    </div>

</div>

@section('script')
    <script>
        app.controller('editProductImageController', function($scope) {
            $scope.images = @json($currentImages);

            $scope.removeProductImage = function(index, image) {
                var imagesCount = $scope.images.length;
                var id = '{{ $product->id }}';
                var imageName = image;
                if (imagesCount > 1) {
                    var routeUrl = '{{ route('user.product.image.delete', ['image'=>'IMAGE', 'id'=>'ID']) }}';
                    routeUrl = routeUrl.replace('ID', id);
                    routeUrl = routeUrl.replace('IMAGE', imageName);
                    swal({
                        title: "Are you sure?",
                        text: "You want to remove this image?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((isConfirm) => {
                        if (isConfirm) {
                            $.ajax({
                                url: routeUrl,
                                type: 'DELETE',
                                data: {'_token': '{{ csrf_token() }}'},
                                success: function(response) {
                                    swal("Your action was successfully completed!", {icon: "success",});
                                    setTimeout(location.reload(), 300);
                                }
                            });
                        }
                    });
                } else {
                    swal("Ooops!", "You have minimum one product image !", "error");
                }
            }
        });
    </script>
@endsection