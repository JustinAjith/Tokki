<script>
    $(document).ready(function() {
        $('#bidActions').on('click', '#bidAccept', function() {
            var id = '{{ $userBid->id }}';
            var bidAcceptRoute = '{{ route('admin.bid.accept', ['bid'=>'ID']) }}';
            bidAcceptRoute = bidAcceptRoute.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to change Bid status to Accept?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: bidAcceptRoute,
                        type: 'PATCH',
                        data: {'_token': '{{ csrf_token() }}'},
                        success: function(response) {
                            if(response.success === 'success'){
                                swal("Your action was successfully completed!", {icon: "success",});
                                       setTimeout(location.reload(), 300);
                            } else {
                                swal("Ooobs!", "Your action was failed!", "error");
                            }
                        }
                    });
                }
            });
        });

        $('#bidActions').on('click', '#bidReject', function() {
            var id = '{{ $userBid->id }}';
            var bidRejectRoute = '{{ route('admin.bid.reject', ['bid'=>'ID']) }}';
            bidRejectRoute = bidRejectRoute.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to change Bid status to Reject?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        url: bidRejectRoute,
                        type: 'PATCH',
                        data: {'_token': '{{ csrf_token() }}'},
                        success: function(response) {
                            if(response.success === 'success'){
                                swal("Your action was successfully completed!", {icon: "success",});
                                       setTimeout(location.reload(), 300);
                            } else {
                                swal("Ooobs!", "Your action was failed!", "error");
                            }
                        }
                    });
                }
            });
        });
    });
</script>