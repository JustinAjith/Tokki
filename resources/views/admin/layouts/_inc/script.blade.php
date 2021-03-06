<script type="text/javascript" src="{{ asset('js/tokki/auth/script.js') }}"></script>
<script type="text/javascript">
    const app = angular.module('appModule', []);
    app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
    }]);
</script>
<script type="text/javascript">
    @if(session('success'))
        $.jnoty("Your action was successfully completed!", {
            header: 'Success',
            theme: 'jnoty-success',
            icon: 'fa fa-check-circle-o'
        });
    @endif
    @if($errors->any() || session('error'))
        $.jnoty("Please try again!", {
            header: 'Error',
            theme: 'jnoty-danger',
            icon: 'fa fa-exclamation-circle'
        });
    @endif
    @if(session('autherror'))
        swal("Ooops!", "You are not authorized!", "error");
    @endif
</script>
<script type="text/javascript">
    app.controller('topController', function($scope, $http, $timeout){
        $scope.notificationalert = false;
        var getNotification = "{{ route('admin.get.notification') }}";
        $http.get(getNotification).then(function(response){
            $scope.unReadNotification = response.data.unread;
            $scope.notifications = response.data.notification;
            if($scope.unReadNotification > 0){
                $scope.notificationalert = true;
            } else{
                $scope.notificationalert = false;
            }
        });

        $scope.readNotification = function() {
            var readNotification = "{{ route('admin.read.notification') }}";
            $http.get(readNotification).then(function() {
                $timeout(function() {
                    $scope.notificationalert = false;
                },800);
            })
        };

        var getMessage = "{{ route('admin.get.message') }}";
        $http.get(getMessage).then(function(response){
            $scope.unReadMessage = response.data.unread;
            $scope.messages = response.data.messages;
            if($scope.unReadMessage > 0){
                $scope.messagealert = true;
            } else{
                $scope.messagealert = false;
            }
        });

        $scope.readMessage = function() {
            var readMessage = "{{ route('admin.read.message') }}";
            $http.get(readMessage).then(function() {
                $timeout(function() {
                    $scope.readMessage = false;
                }, 800);
            })
        };

    });
</script>