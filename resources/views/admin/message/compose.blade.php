@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Compose</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Compose</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="messageController" ng-cloak="">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="inbox-leftbar">
                            <a href="{{ route('admin.message.index') }}" class="btn btn-danger btn-block waves-effect waves-light">Inbox</a>
                            <div class="mail-list mt-4">
                                <a href="{{ route('admin.message.index') }}" class="list-group-item border-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                <a href="{{ route('admin.message.send') }}" class="list-group-item border-0"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                            </div>
                        </div>

                        <div class="inbox-rightbar">
                            <div class="mt-4">
                                <form role="form" ng-submit="messageSubmit()" id="messageForm">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="To" readonly value="{{ $user->name }}" name="name">
                                        <input type="hidden" class="form-control" placeholder="To" value="{{ $user->id }}" name="user_id">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" rows="8" cols="80" class="form-control" style="height:300px" ng-model="message"></textarea>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-sm btn-purple waves-effect waves-light"> <span>Send</span> <i class="fa fa-send m-l-10"></i> </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        app.controller('messageController', function($scope, $http){
            $scope.messageSubmit = function() {
                $http({
                    method: 'POST',
                    url: "{{ route('admin.message.store') }}",
                    data: $('#messageForm').serialize(),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response) {
                    $.jnoty("Your action was successfully completed!", {
                        header: 'Success',
                        theme: 'jnoty-success',
                        icon: 'fa fa-check-circle-o'
                    });
                    $scope.message = '';
                },function(error){
                    $.jnoty("Please try again!", {
                        header: 'Error',
                        theme: 'jnoty-danger',
                        icon: 'fa fa-exclamation-circle'
                    });
                });
            }
        });
    </script>
@endsection