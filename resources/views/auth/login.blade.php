@extends('layouts.app')
@section('body-class')
@section('content')
    <div class="text-center animated fadeInDown">
        <div class="col-md-6">
        </div>
        <div class="col-md-4">
            <div class="col-md-12" style="width: 330px; margin: auto;">

                <div style="padding-top: 100px; padding-bottom: 50px; width: 300px;">
                    <img src="img/system/logo-login.png">
                </div>

                    <p style="color: #91A5BC;">Diseñado para la administración de condominios.</p>
                    
                            <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-success block full-width m-b">Ingresar</button>

                                <a href="#"><small>¿Olvidaste tu contraseña?</small></a>
                                <!--
                                <p class="text-center"><small>¿No tienes una cuenta?
                                <a href="{{ url('/register') }}">Registrarse</a></small>.</p>
                                -->
                            </form>
                    <p class="m-t" style="color: #91A5BC;"> <small>Constantemente actualizado y mejorado por el equipo de Versión Digital.</small> </p>
                    <p class="m-t" style="color: #91A5BC;"> <small>Versión Digital SAAS &copy; 2017</small> </p>
                </div>
        </div>
        <div class="col-md-2">
        </div>

    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}"/>
@endsection

@section('javascript')

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2954971-37', 'auto');
  ga('send', 'pageview');

</script>

@endsection


