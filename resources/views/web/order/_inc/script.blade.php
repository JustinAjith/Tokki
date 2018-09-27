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

        $(".tokkiAccessButton").click(function() {
            $('html, body').animate({
                scrollTop: $(".singleProductOrderForm").offset().top
            }, 2000);
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

        $scope.singleProductDetailsTab = true;
        $scope.singleProductOrderForm = false;
        $scope.showProductOrderForm = function() {
            $scope.singleProductDetailsTab = false;
            $scope.singleProductOrderForm = true;
        };
        $scope.showSingleProductDetailsList = function() {
            $scope.singleProductDetailsTab = true;
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
                $.jnoty("Your action was successfully completed!", {
                    header: 'Success',
                    theme: 'jnoty-success',
                    icon: 'fa fa-check-circle-o'
                });
            },function(response){
                $.jnoty("Please try again!", {
                    header: 'Error',
                    theme: 'jnoty-danger',
                    icon: 'fa fa-exclamation-circle'
                });
            });
        }
    });
</script>