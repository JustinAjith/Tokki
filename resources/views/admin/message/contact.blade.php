@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            @if(isset($user))
                <h3 class="text-primary">{{ $user->name }} Inbox</h3> </div>
        @else
            <h3 class="text-primary">Contact</h3> </div>
    @endif
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Contact</li>
        </ol>
    </div>
    </div>

    <div class="container-fluid" ng-controller="contactController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="inbox-leftbar">
                            @if(isset($user))
                                <a href="{{ route('admin.message.compose', $user->id) }}" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>
                                <div class="mail-list mt-4">
                                    <a href="{{ route('admin.message.index.user', $user->id) }}" class="list-group-item border-0 text-danger"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                    <a href="{{ route('admin.message.send.user', $user->id) }}" class="list-group-item border-0"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                                </div>
                            @else
                                <div class="mail-list mt-4">
                                    <a href="{{ route('admin.message.index') }}" class="list-group-item border-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                    <a href="{{ route('admin.message.send') }}" class="list-group-item border-0"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                                    <a href="{{ route('admin.contact.message') }}" class="list-group-item border-0 text-danger"><i class="fa fa-phone font-18 align-middle mr-2"></i>Contact</a>
                                </div>
                            @endif
                        </div>

                        <div class="inbox-rightbar" ng-cloak>
                            <div class="">
                                <div class="mt-4">
                                    <div ng-show="contactList">
                                        <ul class="message-list">
                                            @foreach($contacts as $contact)
                                                <li>
                                                    <div class="col-mail col-mail-1">
                                                        <p class="title">{{ $contact->name }}</p>
                                                        <span class="star-toggle fa fa-star-o"></span>
                                                    </div>
                                                    <a href="" ng-click="readMessageFun({{ $contact }})">
                                                        <div class="col-mail col-mail-2">
                                                            <div class="subject">
                                                                <span class="teaser">{{ $contact->message }}</span>
                                                            </div>
                                                            <div class="date">{{ $contact->created_at->toDateString() }}</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                            @if(count($contacts) == 0)
                                                <li class="text-center">
                                                    <span>No message to show</span>
                                                </li>
                                            @endif
                                        </ul>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="float-right">
                                                    {{ $contacts->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-show="contactMessageRead">
                                        <div class="media mb-4">
                                            <img class="d-flex mr-3 rounded-circle thumb-sm" src="{{ asset('images/tokki/tokki.png') }}" alt="Tokki Logo">
                                            <div class="media-body">
                                                <span class="pull-right">@{{ readMessageDate }}</span>
                                                <h6 class="m-0"><small class="text-muted">From: </small>@{{ messageUser }}</h6>
                                                <small class="text-muted">Email: @{{ messageUserEmail }}</small>
                                            </div>
                                        </div>

                                        <p>@{{ readMessageText }}</p>
                                        <hr/>
                                        <div class="text-right">
                                            <button class="btn btn-sm btn-dark" ng-click="closeReadMessage()">Close</button>
                                        </div>

                                    </div>
                                </div>
                                <!-- panel body -->
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        app.controller('contactController', function($scope){
            $scope.contactList = true;
            $scope.contactMessageRead = false;
            $scope.readMessageFun = function(contact) {
                $scope.contactList = false;
                $scope.contactMessageRead = true;
                $scope.messageUser = contact.name;
                $scope.messageUserEmail = contact.email;
                $scope.readMessageText = contact.message;
                $scope.readMessageDate = contact.created_at;
            };
            $scope.closeReadMessage = function() {
                $scope.contactList = true;
                $scope.contactMessageRead = false;
            }
        });
    </script>
@endsection