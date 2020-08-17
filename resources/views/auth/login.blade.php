@extends('template')

@section('plugins-js')
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
</script>
<script>
    var onloadCallback = function() {
        grecaptcha.render('g-recaptcha', {
            'sitekey' : '6LcSEcAZAAAAAHpxsr3DlKFISIyhlc2PbYkoWj4j',
            'callback': function(){
               $('.divingresar').html('<input type="submit" class="btn btn-success" id="ingresarButton" value="Ingresar">');
            },
            'expired-callback': function(){
                $('#ingresarButton').remove();
            }
        });
    };
</script>
@endsection
@section('plugins-css')
<style>
    #g-recaptcha > div{
        width: auto !important;
    }
</style>
@endsection

@section('content')

<div class="content-page">

    @if($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                <p>{{$errors->first()}}</p>
            </div>
        </div>
    </div>
    @endif

    {!! Form::open(["url" => "auth/login","id" => "loginform"]) !!}
    <div class="row">
        <div class="col-12 text-center">
            <h1>Bienvenido</h1>
        </div>
        <div class="col-12">
            <label for="email" class="control-label">Correo electr&oacute;nico: </label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="col-12">
            <label for="password" class="control-label">Contrase&ntilde;a: </label>
            <input type="password" name="password" class="form-control" required value="{{ old('password') }}">
        </div>

        <div class="col-12 mt-10 text-center">
            <div id="g-recaptcha"></div>
        </div>

        <div class="col-12 mt-10 text-center divingresar">
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection