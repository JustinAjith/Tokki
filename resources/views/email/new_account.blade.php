@extends('email._inc.master')
@section('content')
    <div style="padding-left: 5px;">
        <h3>Welcome!</h3>
        <p>Now you're ready to sell you product in <a href="{{ route('welcome') }}">Tokki</a> and you can now log in with the following credentials.</p>
        <p style="margin-bottom: 6px;">Email : {{ $data->email }}</p>
        <p style="margin-top: 2px;">Password : {{ $data->password }}</p>
        <p style="margin-bottom: 5px;">Best Regards,</p>
        <p style="margin-top: 0px;">Tokki</p>
    </div>
@endsection