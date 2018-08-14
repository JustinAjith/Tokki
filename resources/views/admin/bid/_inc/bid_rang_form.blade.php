<div class="form-group">
    <label class="col-sm-12 control-label">From Price</label>
    <div class="col-sm-10">
        <input type="text" name="from" value="@if($errors->any()){{ old('from') }}@endif" class="form-control" placeholder="enter from price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">To Price</label>
    <div class="col-sm-10">
        <input type="text" name="to" value="@if($errors->any()){{ old('to') }}@endif" class="form-control" placeholder="enter to price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">Bid</label>
    <div class="col-sm-10">
        <input type="text" name="bid" value="@if($errors->any()){{ old('bid') }}@endif" class="form-control" placeholder="enter bid value">
    </div>
</div>