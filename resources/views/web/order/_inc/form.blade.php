@if(isset($features))
    <div class="row">
        @foreach($features as $key=>$feature)
            <?php $feature_descriptions = explode(",", array_get($features_description, $key)); ?>
            <div class="form-group col-md-6 col-sm-6 mb-2 {{ $key % 2 ? 'pr-0' : ' pl-0' }}">
                <label class="mb-1">{{ $feature }}</label>
                <input type="hidden" value="{{ $feature }}" name="features[]">
                <select class="form-control" name="features_description[]">
                    <option value="">Choose one</option>
                    @foreach($feature_descriptions as $feature_description)
                        <option value="{{ $feature_description }}">{{ $feature_description }}</option>
                    @endforeach
                </select>
            </div>
        @endforeach
    </div>
@endif

<div class="row">
    <div class="form-group col-md-6 col-sm-6 pl-0 mb-2">
        <label class="mb-1">Street address</label>
        <input type="text" name="street" class="form-control" placeholder="enter street address">
    </div>
    <div class="form-group col-md-6 col-sm-6 pr-0 mb-2">
        <label class="mb-1">City</label>
        <input type="text" name="city" class="form-control" placeholder="enter city">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-sm-6 pl-0 mb-2">
        <label class="mb-1">Delivery place</label>
        <select class="form-control" name="delivery_places">
            <option value="">Choose place</option>
            @foreach($places as $place)
                <option value="{{ $place }}">{{ $place }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6 col-sm-6 pl-0 mb-2">
        <label class="mb-1">Mobile Number</label>
        <input type="text" name="mobile" class="form-control" placeholder="enter mobile number">
    </div>
    <div class="form-group col-md-6 col-sm-6 pr-0 mb-2">
        <label class="mb-1">Telephone Number</label>
        <input type="text" name="telephone" class="form-control" placeholder="enter telephone number">
    </div>
</div>