@extends('email._inc.master')
@section('content')
    <div style="padding-left: 5px;">
        <h3>Your password has been reset.</h3>
        <p>Tokki has been reset your password successfully and you can now log in with the following credentials.</p>
        <p>New password : {{ $password }}</p>
        <p>If you did not request this password reset, please let us know.</p>
        <p style="margin-bottom: 5px;">Best Regards,</p>
        <p style="margin-top: 0px;">Tokki</p>
    </div>
@endsection