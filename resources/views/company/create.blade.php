@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Empresa Nueva</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/company') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Nombre</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Direccion</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">

                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Telefono</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}">

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('dias_mora') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Dias de mora</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="dias_mora" value="{{ old('dias_mora') }}">

                                    @if ($errors->has('dias_mora'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dias_mora') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
