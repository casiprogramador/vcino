@extends('layouts.app')
@section('body-class', 'gray-bg')
@section('content')
    <div class="text-center animated fadeInDown">
        <div class="col-md-6 col-md-offset-3">
            <div>

                <h1 class="logo-name">VCino</h1>

            </div>
            <div class="col-md-6 col-md-offset-3">
                    <h3>Bienvenido a V-Cino</h3>
                    <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                        <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
                    </p>
                    <p>Login in. To see it in action.</p>
                            <form class="m-t" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b">Ingresar</button>

                                <a href="#"><small>Forgot password?</small></a>
                                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                                <a class="btn btn-sm btn-white btn-block" href="{{ url('/register') }}">Registrar</a>
                            </form>
                    <p class="m-t"> <small>Sistema &copy; 2016</small> </p>
                </div>
        </div>
    </div>
@endsection
