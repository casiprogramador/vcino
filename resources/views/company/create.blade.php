@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Empresa Nueva</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/company') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
							<div class="form-group{{ $errors->has('logotipo') ? ' has-error' : '' }}">
								 <label for="name" class="col-md-3 control-label">Logotipo</label>
								<div class="col-md-6">
								{{Form::file('logotipo', array('class'=>'') )}}
								</label>
								@if ($errors->has('logotipo'))
									<span class="help-block">
										<strong>{{ $errors->first('logotipo') }}</strong>
									</span>
								@endif
								</div>
							</div>

                            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Nombre Empresa</label>

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
                                <label for="name" class="col-md-3 control-label">Direccion</label>

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
                                <label for="name" class="col-md-3 control-label">Telefono Empresa</label>

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
                                <label for="name" class="col-md-3 control-label">Dias de mora</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="dias_mora" value="{{ old('dias_mora') }}">

                                    @if ($errors->has('dias_mora'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('dias_mora') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
							<div class="form-group{{ $errors->has('dias_mora') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Pago:</label>

                                <div class="col-md-6">
                                    {{ Form::select('pago',array('prepago' => 'Prepago', 'postpago' => 'Postpago'),old('prepago'),['class' => 'form-control input-sm']) }}
                                </div>
                            </div>
							<div class="form-group{{ $errors->has('email_prueba') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-3 control-label">Email para pruebas:</label>

                                <div class="col-md-6">
                                    <input id="email-prueba" type="text" class="form-control" name="email_prueba" value="{{ old('email_prueba') }}">

                                    @if ($errors->has('dias_mora'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email_prueba') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
							<div class="form-group{{ $errors->has('forma_pago') ? ' has-error' : '' }}">
								<label class="col-sm-3 control-label">Forma de Pago:</label>
								<div class="col-sm-9">
									<div class="no-padding">
										<textarea id="summernote" name="forma_pago"></textarea>
									</div>
									@if ($errors->has('forma_pago'))
										<span class="help-block">
											<strong>{{ $errors->first('forma_pago') }}</strong>
										</span>
									@endif
								</div>
							</div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-user"></i> Registrar
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
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/summernote.css') }}" />
@endsection
@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                ['style', ['style']],
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
               ]
            });
        });
    </script>
@endsection