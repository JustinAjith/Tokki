<script>
    app.controller('homeController', function($http, $scope){
        $scope.baseUrl = '{{ URL::to('api/web-home') }}';
        $http.get($scope.baseUrl + '/new-products').then(function(response){
            $scope.newProducts = response.data;
        });
    });
</script>