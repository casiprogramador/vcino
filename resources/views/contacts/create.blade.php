@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contactos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li>
                <a href="{{ route('properties.contact.index') }}">Contactos</a>
            </li>
            <li class="active">
                <strong>Nuevo contacto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    {!! Form::open(array('route' => 'properties.contact.store', 'class' => 'form-horizontal', 'files' => true)) !!}

                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Nuevo contacto</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="form-group{{ $errors->has('property') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Propiedad</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('property',$properties, old('property'), ['class' => 'form-control input-sm']) }}
											@if ($errors->has('property'))
											<span class="help-block">
												<strong>{{ $errors->first('property') }}</strong>
											</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('typecontact') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Tipo</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('typecontact',$typecontacts, old('typecontact'), ['class' => 'form-control input-sm']) }}
											@if ($errors->has('typecontact'))
											<span class="help-block">
												<strong>{{ $errors->first('typecontact') }}</strong>
											</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('relationcontact') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Relación</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('relationcontact',$relationcontacts, old('relationcontact'), ['class' => 'form-control input-sm']) }}
											@if ($errors->has('relationcontact'))
											<span class="help-block">
												<strong>{{ $errors->first('relationcontact') }}</strong>
											</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Nombre</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="nombre" value="{{old('nombre')}}">
											@if ($errors->has('nombre'))
											<span class="help-block">
												<strong>{{ $errors->first('nombre') }}</strong>
											</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Apellido</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="apellido" value="{{old('apellido')}}">
											@if ($errors->has('apellido'))
											<span class="help-block">
												<strong>{{ $errors->first('apellido') }}</strong>
											</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Teléfonos</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-4{{ $errors->has('telefono_movil') ? ' has-error' : '' }}">
													<input type="text" placeholder="Móvil" class="form-control input-sm" name="telefono_movil" value="{{old('telefono_movil')}}">
													@if ($errors->has('telefono_movil'))
													<span class="help-block">
														<strong>{{ $errors->first('telefono_movil') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-4{{ $errors->has('telefono_domicilio') ? ' has-error' : '' }}">
													<input type="text" placeholder="Domicilio" class="form-control input-sm" name="telefono_domicilio" value="{{old('telefono_domicilio')}}">
													@if ($errors->has('telefono_domicilio'))
													<span class="help-block">
														<strong>{{ $errors->first('telefono_domicilio') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-4{{ $errors->has('telefono_oficina') ? ' has-error' : '' }}">
													<input type="text" placeholder="Oficina" class="form-control input-sm" name="telefono_oficina" value="{{old('telefono_oficina')}}">
													@if ($errors->has('telefono_oficina'))
													<span class="help-block">
														<strong>{{ $errors->first('telefono_oficina') }}</strong>
													</span>
													@endif
												</div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">E-mail</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-6{{ $errors->has('email') ? ' has-error' : '' }}">
													<input type="text" placeholder="E-mail" class="form-control input-sm" name="email" value="{{old('email')}}">
													@if ($errors->has('email'))
													<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-6"><input type="text" placeholder="E-mail alterno" class="form-control input-sm" name="email_alterno" value="{{old('email_alterno')}}"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm" name="direccion" value="{{old('direccion')}}">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
									
                                    <div class="form-group{{ $errors->has('media') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Medio preferido contacto</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('media',$medias, old('media'), ['class' => 'form-control input-sm']) }}
                                            @if ($errors->has('media'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('media') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('correspondencia') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Correspondencia</label>
                                        <div class="col-sm-3">
                                           <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                <input type="checkbox" class="i-checks" name='correspondencia[]' value="Comunicados">&nbsp;&nbsp;Comunicados</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                <input type="checkbox" class="i-checks" name='correspondencia[]' value="Cobranzas">&nbsp;&nbsp;Cobranzas</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                <input type="checkbox" class="i-checks" name='correspondencia[]' value="Directorio">&nbsp;&nbsp;Directorio</label>
                                        </div>
                                    </div>
									
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Miembro Directorio</label>
                                        <div class="col-sm-4">
                                            <label><input type="checkbox" class="i-checks" name="miembro_directorio" value="1"></label>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Profesión</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="profesion" value="{{old('profesion')}}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nacionalidad</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="nacionalidad" value="{{old('nacionalidad')}}">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('fotografia') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Fotografía</label>
                                        <div class="col-sm-8">
                                            <label title="Upload image file" for="inputImage">

                                                <div class="fileinput input-group fileinput-new" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                                    <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Seleccionar archivo...</span><span class="fileinput-exists">Cambiar</span>
                                                        <input type="file" name="fotografia"></span>
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Eliminar</a>
                                                </div>
                                            </label>
                                            @if ($errors->has('fotografia'))
                                                <span class="help-block">
                                                        <strong>{{ $errors->first('fotografia') }}</strong>
                                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <!--
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mostrar mis datos</label>
                                        <div class="col-sm-1">
                                            <label><input type="checkbox" class="i-checks" name="mostrar_datos" value="1"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size: 11px; color: #B0B0B0;">Se refiere a que los datos de contacto son visibles para otros miembros.</p>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    -->

                                    <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Notas</label>
                                        <div class="col-sm-9">
                                            <textarea rows="4" class="form-control input-sm" name="notas">{{old('notas')}}</textarea>
											@if ($errors->has('notas'))
											<span class="help-block">
												<strong>{{ $errors->first('notas') }}</strong>
											</span>
											@endif
										</div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Activa</label>
                                        <div class="col-sm-4">
                                            <input type="checkbox" class="i-checks" name="activa" value="1" checked>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear contacto</button>
                                <a href="{{ url()->previous() }}" class="btn btn-white" >Cancelar</a>
                            </div>
                        </div>

                    </div>
					{!! Form::close() !!}

                </div>

            </div>
        </div>

    </div>

</div>

@endsection
@section('javascript')
<script>
	$(document).ready(function () {
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green',
		});

	});
</script>
@endsection

