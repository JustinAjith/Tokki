@extends('user.layouts.master')

@section('content')
    <!-- Breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Inbox</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Inbox</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid" ng-controller="messageController">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="inbox-leftbar">
                            <a href="{{ route('user.message.compose') }}" class="btn btn-danger btn-block waves-effect waves-light">Compose</a>
                            <div class="mail-list mt-4">
                                <a href="{{ route('user.message.index') }}" class="list-group-item border-0"><i class="fa fa-inbox font-18 align-middle mr-2"></i>Inbox @if($unread > 0) <span class="label label-danger float-right ml-2">{{ $unread }}</span> @endif</a>
                                <a href="{{ route('user.message.send') }}" class="list-group-item border-0 text-danger"><i class="fa fa-send font-18 align-middle mr-2"></i>Sent Message</a>
                            </div>
                        </div>

                        <div class="inbox-rightbar" ng-cloak>
                            <div class="">
                                <div class="mt-2">
                                    <div ng-show="messageList">
                                        <ul class="message-list">
                                            @foreach($messages as $message)
                                                <li class="{{ $message->user_status == 1 ? 'unread' : '' }}">
                                                    <div class="col-mail col-mail-1">
                                                        <p class="title">Tokki</p>
                                                        <span class="star-toggle fa fa-star-o"></span>
                                                    </div>
                                                    <a href="" ng-click="readMessageFun({{ $message }})">
                                                        <div class="col-mail col-mail-2">
                                                            <div class="subject">
                                                                <span class="teaser">{{ $message->message }}</span>
                                                            </div>
                                                            <div class="date">{{ $message->created_at->toDateString() }}</div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                            @if(count($messages) == 0)
                                                <li class="text-center">
                                                    <span>No message to show</span>
                                                </li>
                                             @endif
                                        </ul>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <div class="float-right">
                                                    {{ $messages->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div ng-show="messageRead">
                                        @include('user.message._inc.read')
                                    </div>
                                </div>
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
    @include('user.message._inc.script')
@endsection