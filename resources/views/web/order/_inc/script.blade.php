<script>
    app.controller('singleProductView', function($scope){
        $scope.images = @json($productImage);
        $scope.viewBigImage = $scope.images[0];
        $scope.showImage = function($image) {
            $scope.viewBigImage = $image;
        };

        $scope.singleProductDetailsList = true;
        $scope.singleProductOrderForm = false;
        $scope.showProductOrderForm = function() {
            $scope.singleProductDetailsList = false;
            $scope.singleProductOrderForm = true;
        };
        $scope.showSingleProductDetailsList = function() {
            $scope.singleProductDetailsList = true;
            $scope.singleProductOrderForm = false;
        };

        $scope.newProductOrderSubmit = function() {
            var routeUrl = "{{ route('new.product.order', ['product'=>'ID']) }}";
            routeUrl = routeUrl.repeat('ID', {{ $product->id }});
            $http({
                method: 'POST',
                url: routeUrl,
                data: $('#newProductOrder').serialize()
            }).then(function(response){

            },error(function(response){

            });
        }
    });
</script>