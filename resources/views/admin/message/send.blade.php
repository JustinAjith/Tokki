@extends('admin.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            @if(isset($user))
                <h3 class="text-primary">{{ $user->name }} Send</h3> </div>
                @else
                    <h3 class="text-primary">Send</h3> </div>
            @endif
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Send</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="messageController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="inbox-leftbar">
                            @if(isset($user))
                                <a href="{{ route('admin.message.compose', $user->id) }}" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>
                                <div class="mail-list mt-4">
                                    <a href="{{ route('admin.message.index.user', $user->id) }}" class="list-group-item border-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                    <a href="{{ route('admin.message.send.user', $user->id) }}" class="list-group-item border-0 text-danger"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                                </div>
                            @else
                                <div class="mail-list mt-4">
                                    <a href="{{ route('admin.message.index') }}" class="list-group-item border-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                    <a href="{{ route('admin.message.send') }}" class="list-group-item border-0 text-danger"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                                </div>
                            @endif
                        </div>

                        <div class="inbox-rightbar">
                            <div class="">
                                <div class="mt-2">
                                    <div ng-show="messageList">
                                        <ul class="message-list">
                                            @foreach($messages as $message)
                                                <li class="{{ $message->admin_status == 1 ? 'unread' : '' }}">
                                                    <div class="col-mail col-mail-1">
                                                        <p class="title">{{ $message->user->name }}</p>
                                                        <span class="star-toggle fa fa-star-o"></span>
                                                    </div>
                                                    <a href="#" ng-click="readMessageFun({{ $message }})">
                                                        <div class="col-mail col-mail-2">
                                                            <div class="subject">
                                                                <span class="teaser">{{ $message->message }}</span>
                                                            </div>
                                                            <div class="date">11:49 am</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div ng-show="messageRead">
                                        @include('admin.message._inc.read')
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
    @include('admin.message._inc.script')
@endsection