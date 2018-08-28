<div class="row topHeaderBar tokkiBackground">
    <div class="container">
        <div class="row topHeaderBarContents">
            <div class="col-12">
                <div class="float-left">
                    <ul class="list-unstyled list-inline d-none d-sm-block">
                        <li class="list-inline-item">v1.0</li>
                        <li class="list-inline-item"><i class="fa fa-phone" aria-hidden="true"></i> 077-5932985</li>
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item"><i class="fa fa-envelope-o" aria-hidden="true"></i> justinajith94@gmail.com</li>
                    </ul>
                </div>
                <div class="float-right">
                    <ul class="list-unstyled list-inline">
                        @if(Auth::user())
                            <li class="list-inline-item"><a href="{{ route('home') }}" class="userLink"><i class="fa fa-user-circle-o" aria-hidden="true"></i> {{ Auth::user()->name }}</a></li>
                        @else
                            <li class="list-inline-item"><a href="{{ route('login') }}" class="userLink">Sell</a></li>
                        @endif
                        <li class="list-inline-item">|</li>
                        <li class="list-inline-item"><i class="fa fa-question-circle" aria-hidden="true"></i> Help</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row topMiddleBar">
    <div class="container">
        <div class="row topMiddleBarContents">
            <div class="col-md-3 col-sm-2 d-none d-md-block">
                <a href="{{ route('welcome') }}"><img src="{{ asset('images/tokki/logo-text.png') }}" class="logo"></a>
            </div>
            <div class="col-md-7 col-sm-10 col-xs-12">
                <form action="">
                    <div class="row">
                        <div class="col-7 mt-3 p-0">
                            <input type="text" class="form-control searchTextInput" placeholder="I'm shopping for...">
                        </div>
                        <div class="col-5 mt-3 p-0">
                            <div class="input-group">
                                <select class="form-control searchSelectInput" style="height: 35px;">
                                    @foreach(categories() as $key=>$value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <button class="input-group-text tokkiBackground"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2 col-sm-2 d-none d-sm-block">AADASSFSDS</div>
        </div>
    </div>
</div>