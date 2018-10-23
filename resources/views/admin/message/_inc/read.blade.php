<div class="media mb-4">
    <img class="d-flex mr-3 rounded-circle thumb-sm" src="{{ asset('images/tokki/tokki.png') }}" alt="Tokki Logo">
    <div class="media-body">
        <span class="pull-right">07:23 AM</span>
        <h6 class="m-0"><small class="text-muted">To: </small>@{{ messageUser }}</h6>
        <small class="text-muted">Email: @{{ messageUserEmail }}</small>
    </div>
</div>

<p>@{{ readMessageText }}</p>
<hr/>
<div class="text-right">
    <button class="btn btn-sm btn-dark" ng-click="closeReadMessage()">Close</button>
    <a href="/admin/message/compose/@{{ messageUserId }}" class="btn btn-sm btn-primary">Replay</a>
</div>
