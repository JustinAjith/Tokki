<div class="form-group">
    <label class="col-sm-12 control-label">From Price</label>
    <div class="col-sm-10">
        <input type="text" name="from" value="@if(isset($from)){{ $from }}@endif" class="form-control" placeholder="enter from price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">To Price</label>
    <div class="col-sm-10">
        <input type="text" name="to" value="@if(isset($to)){{ $to }}@endif" class="form-control" placeholder="enter to price">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-12 control-label">Bid</label>
    <div class="col-sm-10">
        <input type="text" name="bid" value="@if(isset($bid)){{ $bid }}@endif" class="form-control" placeholder="enter bid value">
    </div>
</div>