<script type="application/javascript">
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.removeNotification').on('click', function(){
            var removeRow = $(this).closest('tr');
            var id = $(this).val();
            var routeUrl = "{{ route('user.remove.notification', ['id'=>'ID']) }}";
            routeUrl = routeUrl.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to change status to Reject?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        method: 'POST',
                        url: routeUrl,
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                        success: function (response) {
                            $.jnoty("Your action was successfully completed!", {
                                header: 'Success',
                                theme: 'jnoty-success',
                                icon: 'fa fa-check-circle-o'
                            });
                        removeRow.remove();
                        }
                    });
                }
            });
        });
    });
</script>