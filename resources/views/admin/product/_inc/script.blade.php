<script type="text/javascript">
    $(document).ready(function() {
        $('.changeProductStatus').on('click', function() {
            var status = $(this).val();
            var id = '{{ $product->id }}';
            var routeUrl = '{{ route('admin.product.status', ['status'=>'STATUS', 'id'=>'ID']) }}';
            routeUrl = routeUrl.replace('STATUS', status);
            routeUrl = routeUrl.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to change Product status to "+status+'?',
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        url: routeUrl,
                        type: 'PATCH',
                        data: {'_token': '{{ csrf_token() }}'},
                        success: function(response) {
                            swal("Your action was successfully completed!", {icon: "success",});
                            setTimeout(location.reload(), 300);
                        }
                    });
                }
            });
        });

        $('.deleteSingleProduct').on('click', function() {
            var id = '{{ $product->id }}';
            var routeUrl = '{{ route('admin.product.delete', ['id'=>'ID']) }}';
            routeUrl = routeUrl.replace('ID', id);
            swal({
                title: "Are you sure?",
                text: "Do you want to delete this Product?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((isConfirm) => {
                if (isConfirm) {
                    $.ajax({
                        url: routeUrl,
                        type: 'DELETE',
                        data: {'_token': '{{ csrf_token() }}'},
                        success: function(response) {
                            swal("Your action was successfully completed!", {icon: "success",});
                            window.location.href = '{{ route('admin.delete.products') }}';
                        }
                    });
                }
            });
        });
    });
</script>