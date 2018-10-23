@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Notifications</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Notifications</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th width="100%">Notifications</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($notifications as $notification)
                                            <tr>
                                                <td>
                                                    {{ $notification->message }}<br>
                                                    <small>{{ $notification->created_at }}</small>
                                                </td>
                                                <td><center><button class="btn btn-sm btn-danger removeNotification" value="{{ $notification->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></button></center></td>
                                            </tr>
                                        @endforeach
                                        @if(count($notifications) == 0)
                                            <tr>
                                                <td colspan="2">No Notification to show</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="float-right">
                                    {{ $notifications->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
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
                var routeUrl = "{{ route('admin.remove.notification', ['id'=>'ID']) }}";
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
@endsection