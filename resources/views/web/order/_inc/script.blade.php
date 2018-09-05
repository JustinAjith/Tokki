<script>
    $(document).ready(function(){
        $('#qty_input').prop('readonly', true);
        $('#plus-btn').click(function(){
            $('#qty_input').val(parseInt($('#qty_input').val()) + 1 );
        });
        $('#minus-btn').click(function(){
            $('#qty_input').val(parseInt($('#qty_input').val()) - 1 );
            if ($('#qty_input').val() == 0) {
                $('#qty_input').val(1);
            }
        });
    });
</script>
<script>
    app.controller('singleProductView', function($scope, $http){
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
            var routeUrl = "{{ route('new.product.order', $product->id) }}";
            $http({
                method: 'POST',
                url: routeUrl,
                data: $('#newProductOrder').serialize(),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response){

            },function(response){

            });
        }
    });
</script>