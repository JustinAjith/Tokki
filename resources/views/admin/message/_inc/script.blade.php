<script>
    app.controller('messageController', function($scope){
        $scope.messageList = true;
        $scope.messageRead = false;
        $scope.readMessageFun = function(message) {
            $scope.messageList = false;
            $scope.messageRead = true;
            $scope.readMessageText = message.message;
            $scope.messageUser = message.user.name;
            $scope.messageUserEmail = message.user.email;
            $scope.messageUserId = message.user.id;
        };
        $scope.closeReadMessage = function() {
            $scope.messageList = true;
            $scope.messageRead = false;
        }
    });
</script>
<script type="application/javascript">
    {{--$(document).ready(function(){--}}
        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
        {{--$('.removeMessage').on('click', function(){--}}
            {{--var removeRow = $(this).closest('li');--}}
            {{--var id = $(this).attr('data-id');--}}
            {{--var routeUrl = "{{ route('admin.remove.message', ['id'=>'ID']) }}";--}}
            {{--routeUrl = routeUrl.replace('ID', id);--}}
            {{--swal({--}}
                {{--title: "Are you sure?",--}}
                {{--text: "Do you want to change status to Reject?",--}}
                {{--icon: "warning",--}}
                {{--buttons: true,--}}
                {{--dangerMode: true,--}}
            {{--}).then((isConfirm) => {--}}
                {{--if (isConfirm) {--}}
                    {{--$.ajax({--}}
                        {{--method: 'POST',--}}
                        {{--url: routeUrl,--}}
                        {{--headers: {'Content-Type': 'application/x-www-form-urlencoded'},--}}
                        {{--success: function (response) {--}}
                            {{--$.jnoty("Your action was successfully completed!", {--}}
                                {{--header: 'Success',--}}
                                {{--theme: 'jnoty-success',--}}
                                {{--icon: 'fa fa-check-circle-o'--}}
                            {{--});--}}
                            {{--removeRow.remove();--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}
            {{--});--}}
        {{--});--}}
    {{--});--}}
</script>