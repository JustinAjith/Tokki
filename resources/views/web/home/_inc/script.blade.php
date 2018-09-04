<script>
    app.controller('homeController', function($http, $scope){
        $scope.baseUrl = '{{ URL::to('api/web-home') }}';
        $http.get($scope.baseUrl + '/new-products').then(function(response){
            $scope.newProducts = [];
            if(response.data.length !== 4) {
                for(var i=0; i < 4; i++) {
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
    });
</script>