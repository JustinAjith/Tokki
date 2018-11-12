<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle thumb-sm" src="{{ asset('images/tokki/tokki.png') }}" alt="Tokki Logo">
    <div class="media-body">
        <span class="pull-right">@{{ readMessageDate }}</span>
        <h6 class="m-0"><small class="text-muted">From: </small>Tokki</h6>
        <small class="text-muted">Email: justinajith94@gmail.com</small>
    </div>
</div>

<p>@{{ readMessageText }}</p>
<hr/>
<div class="text-right">
    <button class="btn btn-sm btn-dark" ng-click="closeReadMessage()">Close</button>
    <a href="{{ route('user.message.compose') }}" class="btn btn-sm btn-primary">Replay</a>
</div>
