<script>
    app.controller('productController', function($scope, $http, $timeout) {
        $scope.createCategorySelect = true;
        $scope.productGeneralDetails = false;
        $scope.productDetails = false;
        $scope.productImages = false;
        var errorClass = 'is-invalid';
        $scope.selectCategory = function(c, s) {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = true;
            $scope.productDetails = false;
            $scope.productImages = false;
            $scope.category = c;
            $scope.subCategory = s;
        };

        $scope.generalProductDetailCheck = function() {
            var generalProductDetailCheck = "{{ route('user.general.product.check') }}";
            $http({
                method: 'POST',
                url: generalProductDetailCheck,
                data: $('#userProductDetails').serialize(),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                $scope.createCategorySelect = false;
                $scope.productGeneralDetails = false;
                $scope.productDetails = true;
                $scope.productImages = false;
                $scope.categoryInput = '';
                $scope.subCategoryInput = '';
                $scope.headingInput = '';
                $scope.keywordInput = '';
                $scope.priceInput = '';
                $scope.discountInput = '';
                $scope.discountTypeInput = '';
            },function(errors){
                var error = errors.data.errors;
                if(error.category){
                    $scope.categoryInput = errorClass;
                } if(error.sub_category) {
                    $scope.subCategoryInput = errorClass;
                } if(error.heading) {
                    $scope.headingInput = errorClass;
                } if(error.key_word) {
                    $scope.keywordInput = errorClass;
                } if(error.price) {
                    $scope.priceInput = errorClass;
                } if(error.discount) {
                    $scope.discountInput = errorClass;
                } if(error.discount_type) {
                    $scope.discountTypeInput = errorClass;
                }
            });
        };

        $scope.goBackToSelectCategory = function() {
            $scope.createCategorySelect = true;
            $scope.productGeneralDetails = false;
            $scope.productDetails = false;
            $scope.productImages = false;
        };

        $scope.details = [{}];
        $scope.add = function() {
            $scope.details.push({});
        };

        $scope.removeProductDetail = function(index) {
            var detailCount = $scope.details.length;
            if (detailCount > 1) {
                $scope.details.splice(index, 1);
            } else {
                swal("Ooops!", "You must add minimum one product detail !", "error");
            }
        };

        $scope.goBackToGeneralForm = function() {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = true;
            $scope.productDetails = false;
            $scope.productImages = false;
        };

        $scope.productDetailCheck = function() {
            var productDetailCheck = "{{ route('user.product.detail.check') }}";
            $http({
                method: 'POST',
                url : productDetailCheck,
                data: $('#userProductDetails').serialize(),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response){
                $scope.productDetailTitleError = '';
                $scope.productDetailDescriptionError = '';
                $scope.createCategorySelect = false;
                $scope.productGeneralDetails = false;
                $scope.productDetails = false;
                $scope.productImages = true;
            },function(errors) {
                $scope.productDetailTitleError = 'The title field is required';
                $scope.productDetailDescriptionError = 'The description field is required';
            });
        };

        $scope.goBackToProductDetailForm = function() {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = false;
            $scope.productDetails = true;
            $scope.productImages = false;
        }


    });
</script>
