<script>
    app.controller('productController', function($scope, $http, $timeout) {
        $scope.createCategorySelect = true;
        $scope.productGeneralDetails = false;
        $scope.productDetails = false;
        $scope.productSpecialFeature = false;
        $scope.productImages = false;

        $scope.select_special_features = 'no';
        var errorClass = 'is-invalid';
        $scope.selectCategory = function(c, s) {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = true;
            $scope.productDetails = false;
            $scope.productSpecialFeature = false;
            $scope.productImages = false;
            $scope.category = c;
            $scope.subCategory = s;
        };

        $scope.specialFeaturesInput = true;

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
                $scope.productSpecialFeature = false;
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
                } else {
                    $scope.categoryInput = '';
                }
                if(error.sub_category) {
                    $scope.subCategoryInput = errorClass;
                } else {
                    $scope.subCategoryInput = '';
                }
                if(error.heading) {
                    $scope.headingInput = errorClass;
                } else {
                    $scope.headingInput = '';
                }
                if(error.key_word) {
                    $scope.keywordInput = errorClass;
                } else {
                    $scope.keywordInput = ''
                }
                if(error.price) {
                    $scope.priceInput = errorClass;
                } else {
                    $scope.priceInput = '';
                }
                if(error.discount) {
                    $scope.discountInput = errorClass;
                } else {
                    $scope.discountInput = '';
                }
                if(error.discount_type) {
                    $scope.discountTypeInput = errorClass;
                } else {
                    $scope.discountTypeInput = '';
                }
            });
        };

        $scope.goBackToSelectCategory = function() {
            $scope.createCategorySelect = true;
            $scope.productGeneralDetails = false;
            $scope.productDetails = false;
            $scope.productSpecialFeature = false;
            $scope.productImages = false;
        };

        $scope.generalProductDetailCheckAndGoSpecialFeatures = function() {
            var generalProductDetailCheck = "{{ route('user.general.product.check') }}";
            $http({
                method: 'POST',
                url: generalProductDetailCheck,
                data: $('#userProductDetails').serialize(),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                $scope.createCategorySelect = false;
                $scope.productGeneralDetails = false;
                $scope.productDetails = false;
                $scope.productSpecialFeature = true;
                $scope.productImages = false;
                $scope.specialFeaturesInput = false;
                $scope.select_special_features = 'yes';
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
                } else {
                    $scope.categoryInput = '';
                }
                if(error.sub_category) {
                    $scope.subCategoryInput = errorClass;
                } else {
                    $scope.subCategoryInput = '';
                }
                if(error.heading) {
                    $scope.headingInput = errorClass;
                } else {
                    $scope.headingInput = '';
                }
                if(error.key_word) {
                    $scope.keywordInput = errorClass;
                } else {
                    $scope.keywordInput = ''
                }
                if(error.price) {
                    $scope.priceInput = errorClass;
                } else {
                    $scope.priceInput = '';
                }
                if(error.discount) {
                    $scope.discountInput = errorClass;
                } else {
                    $scope.discountInput = '';
                }
                if(error.discount_type) {
                    $scope.discountTypeInput = errorClass;
                } else {
                    $scope.discountTypeInput = '';
                }
            });
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
                $scope.productSpecialFeature = false;
                $scope.productImages = true;
            },function(errors) {
                $scope.productDetailTitleError = 'The title field is required';
                $scope.productDetailDescriptionError = 'The description field is required';
            });
        };

        $scope.goBackToGeneralForm = function() {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = true;
            $scope.productDetails = false;
            $scope.productSpecialFeature = false;
            $scope.productImages = false;
            $scope.specialFeaturesInput = false;
            $scope.select_special_features = 'no';
        };

        $scope.goBackToProductDetailForm = function() {
            $scope.createCategorySelect = false;
            $scope.productGeneralDetails = false;
            $scope.productDetails = true;
            $scope.productSpecialFeature = false;
            $scope.productImages = false;
        };

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
        $('#tags_1').tagsInput({width:'auto'});
    });
</script>
