<script>
    app.controller('orderController', function($scope, $http) {
        $scope.images = @json($productImage);
        var id = '{{ $order->id }}';
        $scope.viewBigImage = $scope.images[0];
        $scope.showImage = function($image) {
            $scope.viewBigImage = $image;
        };
        $scope.pendingStatus = true;
        $scope.rejectForm = false;
        $scope.showRejectForm = function() {
            $scope.pendingStatus = false;
            $scope.rejectForm = true;
        };
        $scope.closeRejectForm = function() {
            $scope.pendingStatus = true;
            $scope.rejectForm = false;
        };

        $scope.customerReviewShow = false;
        var getCustomerRiview = "{{ route('user.order.customer.review', ['id'=>'ID']) }}";
        getCustomerRiview = getCustomerRiview.replace('ID', id);
        $http.get(getCustomerRiview).then(function(response){
            $scope.customerReview = response.data;
            $scope.customerReviewShow = true;
        });

        $scope.orderRejectSubmit = function() {
            var routeUrl = '{{ route('user.order.reject.status', ['status'=>'Reject','id'=>'ID']) }}';
            routeUrl = routeUrl.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to change status to Reject?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $http({
                        method: 'POST',
                        url: routeUrl,
                        data: $('#orderRejectSubmit').serialize(),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function(response){
                        swal("Your action was successfully completed!", {icon: "success",});
                        setTimeout(location.reload(), 300);
                    },function(error) {

                    });
                }
            });
        };

        $scope.orderAccept = function(status) {
            var routeUrl = '{{ route('user.order.accept.status', ['status'=>'STATUS','id'=>'ID']) }}';
            routeUrl = routeUrl.replace('ID', id);
            routeUrl = routeUrl.replace('STATUS', status);
            swal({
                title: "Are you sure?",
                text: "Do you want to change status to "+status+"?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $http({
                        method: 'POST',
                        url: routeUrl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function(response){
                        swal("Your action was successfully completed!", {icon: "success",});
                        setTimeout(location.reload(), 300);
                    },function(error) {

                    });
                }
            });
        };


        $scope.deleteOrder = function() {
            var routeUrl = '{{ route('user.order.delete', ['id'=>'ID']) }}';
            routeUrl = routeUrl.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "You want to delete this order?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $http({
                        method: 'DELETE',
                        url: routeUrl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).then(function(response){
                        swal("Your action was successfully completed!", {icon: "success",});
                        window.location.href = '{{ route('user.order') }}';
                    },function(error) {

                    });
                }
            });
        };
    });
</script>