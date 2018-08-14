<div class="horizontal-form">
    <form class="form-horizontal" method="POST" action="{{ route('admin.user.reset.password') }}">
        @csrf
        <div class="form-group">
            <label class="col-sm-12 control-label">Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" placeholder="enter password">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12 control-label">Re-type Password</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" placeholder="re-type password">
            </div>
        </div>
        <input type="hidden" value="{{ $user->id }}" name="user_id">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </div>
        </div>
    </form>
</div>