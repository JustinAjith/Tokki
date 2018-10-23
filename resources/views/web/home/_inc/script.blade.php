<script>
    app.controller('homeController', function($http, $scope){
        $scope.baseUrl = '{{ URL::to('api/web-home') }}';
        // Web New Products
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
        });
        // Web More To Love Products
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
        });
    });
</script>