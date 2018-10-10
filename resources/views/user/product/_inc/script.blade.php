<script>
    app.controller('productController', function($scope, $http, $timeout) {
        $scope.createCategorySelect = true;
        $scope.productCreateForm = false;

        $scope.selectCategory = function(category, subCategory) {
            $scope.createCategorySelect = false;
            $scope.productCreateForm = true;
            $scope.category = category.name;
            $scope.subCategory = subCategory.name;
            $scope.category_id = category.id;
            $scope.subCategory_id = subCategory.id;
        };

        $scope.goBackToSelectCategory = function() {
            $scope.createCategorySelect = true;
            $scope.productCreateForm = false;
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
