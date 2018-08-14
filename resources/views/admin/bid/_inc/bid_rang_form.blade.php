<div class="form-group">
    <label class="col-sm-12 control-label">From Price</label>
    <div class="col-sm-10">
        <input type="text" name="from" value="@if(isset($bid)){{ $bid->from }}@else @if($errors->any()){{ old('from') }}@endif @endif" class="form-control" placeholder="enter from price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">To Price</label>
    <div class="col-sm-10">
        <input type="text" name="to" value="@if(isset($bid)){{ $bid->to }}@else @if($errors->any()){{ old('to') }}@endif @endif" class="form-control" placeholder="enter to price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">Bid</label>
    <div class="col-sm-10">
        <input type="text" name="bid" value="@if(isset($bid)){{ $bid->bid }}@else @if($errors->any()){{ old('bid') }}@endif @endif" class="form-control" placeholder="enter bid value">
    </div>
</div>