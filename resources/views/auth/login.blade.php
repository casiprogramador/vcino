@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    <div class="text-center animated fadeInDown">
        <div class="col-md-6 col-md-offset-3">
            <div>

                <h1 class="logo-name" style="font-size: 140px;">V-CINO</h1>

            </div>
            <div class="col-md-6 col-md-offset-3">
                    <h3>Bienvenido a V-CINO</h3>
                    <p>Diseñado para la administración de propiedades.</p>
                    
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
                                <p class="text-center"><small>¿No tienes una cuenta?
                                <a href="{{ url('/register') }}">Registrarse</a></small>.</p>
                            </form>
                    <p class="m-t"> <small>Constantemente actualizado y mejorado por el equipo de Esfera SAAS.</small> </p>
                    <p class="m-t"> <small>Esfera SAAS &copy; 2016</small> </p>
                </div>
        </div>
    </div>
@endsection
