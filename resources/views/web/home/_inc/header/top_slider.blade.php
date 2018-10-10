<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div id="tokkiHomeTopSlider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach($sliders as $key=>$slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/slider') }}/{{ $slider->image }}" class="tokkiHomeSliderImage">
                            <div class="carousel-caption">
                                <h3>{{ $slider->title }}</h3>
                                <p>{{ $slider->text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#tokkiHomeTopSlider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#tokkiHomeTopSlider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>