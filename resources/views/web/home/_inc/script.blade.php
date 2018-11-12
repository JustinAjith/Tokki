<script>
    app.controller('homeController', function($http, $scope){
        $scope.baseUrl = '{{ URL::to('api/web-home') }}';
        // Web New Products
        $scope.newProductDiv = false;
        $scope.newProductLoading = true;
        $http.get($scope.baseUrl + '/new-products').then(function(response){
            $scope.newProducts = [];
            if(response.data.length !== 6) {
                for(var i=0; i < 6; i++) {
                    if(response.data[i]) {
                        $scope.newProducts.push(response.data[i]);
                    } else {
                        $scope.newProducts.push({name: null});
                    }
                }
            } else {
                $scope.newProducts = response.data;
            }
            $scope.newProductDiv = true;
            $scope.newProductLoading = false;
        });
        // Web More To Love Products
        $scope.moreToLoveProducts = false;
        $scope.moreToLoveLoading = true;
        $http.get($scope.baseUrl + '/more-to-love').then(function(response){
            $scope.loveProducts = [];
            if(response.data.length !== 6) {
                for(var i=0; i < 6; i++) {
                    if(response.data[i]) {
                        $scope.loveProducts.push(response.data[i]);
                    } else {
                        $scope.loveProducts.push({name: null});
                    }
                }
            } else {
                $scope.loveProducts = response.data;
            }
            $scope.moreToLoveProducts = true;
            $scope.moreToLoveLoading = false;
        });

        // Recent Offer To Love Products
        $scope.recentOfferDiv = false;
        $scope.recentOfferLoading = true;
        $http.get($scope.baseUrl + '/recent-offer').then(function(response){
            $scope.recentOffers = [];
            if(response.data.length !== 6) {
                for(var i=0; i < 6; i++) {
                    if(response.data[i]) {
                        $scope.recentOffers.push(response.data[i]);
                    } else {
                        $scope.recentOffers.push({name: null});
                    }
                }
            } else {
                $scope.recentOffers = response.data;
            }
            $scope.recentOfferDiv = true;
            $scope.recentOfferLoading = false;
        });

        // more Products
        $scope.moreProductsDiv = false;
        $scope.moreProductLoading = true;
        $http.get($scope.baseUrl + '/more-products').then(function(response){
            $scope.moreProducts = [];
            if(response.data.length !== 12) {
                for(var i=0; i < 12; i++) {
                    if(response.data[i]) {
                        $scope.moreProducts.push(response.data[i]);
                    } else {
                        $scope.moreProducts.push({name: null});
                    }
                }
            } else {
                $scope.moreProducts = response.data;
            }
            $scope.moreProductsDiv = true;
            $scope.moreProductLoading = false;
        });
    });
</script>