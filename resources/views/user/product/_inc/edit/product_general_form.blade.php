<form class="form-horizontal" method="post" action="{{ route('user.product.edit.general.details', $product) }}">
    @csrf
    <div class="row mt-3">
        <div class="col-md-12">
            <h4>General Details</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Code (optional)</label>
                <input type="text" name="code" class="form-control" placeholder="enter product code" value="{{ $product->code }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Heading</label>
                <input type="text" name="heading" class="form-control" placeholder="enter product heading" value="{{ $product->heading }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Key word</label>
                <input type="text" name="key_word" class="form-control" placeholder="enter product key word" value="{{ $product->key_word }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Available Qty</label>
                <input type="text" name="qty" class="form-control" placeholder="enter available qty" value="{{ $product->qty }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <?php
                    $city = json_decode($product->delivery_places);
                ?>
                <label class="control-label">Delivery Places</label>
                <select name="delivery_places[]" class="form-control selectpicker" multiple>
                    @foreach(city() as $key => $value)
                        <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Delivery Duration</label>
                <select name="delivery_duration" class="form-control">
                    @foreach(deliveryDuration() as $key => $value)
                        <option value="{{ $value }}" @if($product->delivery_duration == $value) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="float-right">
                <button type="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
        </div>
    </div>


</form>

@section('script')
    <script>
        $(document).ready(function(){
            var city = @json($city);
            $('.selectpicker').selectpicker('val', city);
        });
    </script>
@endsection