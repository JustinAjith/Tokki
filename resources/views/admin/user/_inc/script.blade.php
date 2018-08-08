<script type="text/javascript">
    $(document).ready(function() {
        var fixmeTop = $('.user-profile-basic-info').offset().top;
        $(window).scroll(function() {
            var currentScroll = $(window).scrollTop();
            if (currentScroll >= fixmeTop) {
                $('.user-profile-basic-info').css({
                    position: 'fixed',
                    top: '10px',
                    width: '24%'
                });
            } else {
                $('.user-profile-basic-info').css({
                    position: 'static',
                    top: '0px',
                    width: '100%'
                });
            }
        });
    });
</script>
<script type="text/javascript">
    app.controller('userController', function($scope, $timeout){
        $scope.aboutCompany = true;
        $scope.userPasswordReset = false;
        $scope.showPasswordForm = function() {
            $timeout(function() {
                $scope.userPasswordReset = true;
                $scope.aboutCompany = false;
            }, 500);
        }
    });
</script>