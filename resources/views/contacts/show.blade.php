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
                <strong>Ver contacto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-content">
					<form action="#" class="form-horizontal">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-1">Ver contacto</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tab-1" class="tab-pane active">
                                <div class="panel-body">

                                    <div class="form-group{{ $errors->has('property') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Propiedad</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('property',$properties, $contact->property_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
                                            {{ Form::select('typecontact',$typecontacts, $contact->typecontact_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
                                            {{ Form::select('relationcontact',$relationcontacts, $contact->relationcontact_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
                                            <input type="text" class="form-control input-sm" name="nombre" value="{{$contact->nombre}}" readonly>
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
                                            <input type="text" class="form-control input-sm" name="apellido" value="{{$contact->apellido}}" readonly>
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
													<input type="text" placeholder="" class="form-control input-sm" name="telefono_movil" value="{{$contact->telefono_movil}}" readonly>
													@if ($errors->has('telefono_movil'))
													<span class="help-block">
														<strong>{{ $errors->first('telefono_movil') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-4{{ $errors->has('telefono_domicilio') ? ' has-error' : '' }}">
													<input type="text" placeholder="" class="form-control input-sm" name="telefono_domicilio" value="{{$contact->telefono_domicilio}}" readonly>
													@if ($errors->has('telefono_domicilio'))
													<span class="help-block">
														<strong>{{ $errors->first('telefono_domicilio') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-4{{ $errors->has('telefono_oficina') ? ' has-error' : '' }}">
													<input type="text" placeholder="" class="form-control input-sm" name="telefono_oficina" value="{{$contact->telefono_oficina}}" readonly>
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
													<input type="text" placeholder="E-mail" class="form-control input-sm" name="email" value="{{$contact->email}}" readonly>
													@if ($errors->has('email'))
													<span class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
													@endif
												</div>
                                                <div class="col-sm-6"><input type="text" placeholder="" class="form-control input-sm" name="email_alterno" value="{{$contact->email_alterno}}" readonly></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Dirección</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control input-sm" name="direccion" value="{{$contact->direccion}}" readonly>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('fotografia') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Fotografía</label>
                                        <div class="col-sm-8">
                                            <label title="Upload image file" for="inputImage" >
												@if(empty($contact->fotografia))
													<img src="{{ URL::asset('img/system/user150.png')}}" class="img-thumbnail" width="100" />
												@else
													<img src="{{asset($contact->fotografia)}}" class="img-thumbnail" width="150" />	
												@endif
                                            </label>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Profesión</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="profesion" value="{{$contact->profesion}}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nacionalidad</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control input-sm" name="nacionalidad" value="{{$contact->nacionalidad}}" readonly>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group{{ $errors->has('correspondencia') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Correspondencia</label>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
											<input type="checkbox" class="i-checks" name='correspondencia[]' value="Comunicados" {{ (in_array('Comunicados',explode(',',$contact->correspondencia))) ? 'checked' : '' }} disabled="disabled">&nbsp;&nbsp;Comunicados</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                <input type="checkbox" class="i-checks" name='correspondencia[]' value="Cobranzas" {{ (in_array('Cobranzas',explode(',',$contact->correspondencia))) ? 'checked' : '' }} disabled="disabled">&nbsp;&nbsp;Cobranzas</label>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="checkbox-inline" style="padding-top: 0; padding-left: 0;">
                                                <input type="checkbox" class="i-checks" name='correspondencia[]' value="Directorio" {{ (in_array('Directorio',explode(',',$contact->correspondencia))) ? 'checked' : '' }} disabled="disabled">&nbsp;&nbsp;Directorio</label>
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('media') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Medio preferido</label>
                                        <div class="col-sm-3">
                                            {{ Form::select('media',$medias, $contact->media_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
											@if ($errors->has('media'))
												<span class="help-block">
													<strong>{{ $errors->first('media') }}</strong>
												</span>
											@endif
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Miembro Directorio</label>
                                        <div class="col-sm-4">
                                            <label><input type="checkbox" class="i-checks" name="miembro_directorio" value="1" {{ ($contact->miembro_directorio == 1) ? 'checked' : '' }} disabled="disabled"></label>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    
                                    <!--
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Mostrar mis datos</label>
                                        <div class="col-sm-1">
                                            <label><input type="checkbox" class="i-checks" name="mostrar_datos" value="1" {{ ($contact->mostrar_datos == 1) ? 'checked' : '' }} disabled="disabled"></label>
                                        </div>
                                        <div class="col-md-6">
                                            <p style="font-size: 11px; color: #B0B0B0;">Se refiere a que los datos del contacto son visibles para otros miembros.</p>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    -->

                                    <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
                                        <label class="col-sm-3 control-label">Notas</label>
                                        <div class="col-sm-9">
                                            <textarea rows="4" class="form-control input-sm" name="notas" readonly>{{ $contact->notas }}</textarea>
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
                                            <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($contact->activa == 1) ? 'checked' : '' }} disabled="disabled">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <a href="{{ url()->previous() }}" class="btn btn-success" >Volver</a>
                            </div>
                        </div>

                    </div>
				</form>
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