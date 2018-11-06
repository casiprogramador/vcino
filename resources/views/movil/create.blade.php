@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Usuarios móviles</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Propiedades
            </li>
            <li>
                <a href="#">Lista de usuarios móviles</a>
            </li>
            <li class="active">
                <strong>Nuevo usuario</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Nuevo usuario</h5>
                </div>

                <div class="ibox-content">
                    {!! Form::open(array('route' => 'movil.store', 'class' => 'form-horizontal')) !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-5">
                            {{ Form::select('property',$properties, old('property'), ['class' => 'form-control input-sm']) }}
							@if ($errors->has('property'))
								<span class="help-block">
									<strong>{{ $errors->first('property') }}</strong>
								</span>
							@endif
                        </div>

                        <div class="col-sm-5">
                            <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-search"></i>&nbsp;&nbsp;Buscar contactos</button>
                        </div>

                                <!-- VENTANA MODAL DE usuarios-->
                                <div class="modal inmodal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Contactos</h4>
                                                <p>Lista de contactos <b>activos</b> propiedad <b>3 AB</b></p>
                                            </div>
                                            <div class="modal-body" style="background-color: white;">


                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align:bottom">Nombre completo</th>
                                                                <th style="vertical-align:bottom">E-mail</th>
                                                                <th style="vertical-align:bottom">Tipo</th>
                                                                <th style="vertical-align:bottom" width="40"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Juan Perez Rivera</td>
                                                                <td><a href="mailto:juanperez@gmail.com">juanperez@gmail.com</a></td>
                                                                <td>Propietario: Titular</td>
                                                                <td style="vertical-align:middle; text-align:right;">
                                                                    <div class="btn-group">
                                                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Utilizar información de contacto">
                                                                            <i class="fa fa-user-plus"></i>
                                                                        </a>
                                                                    </div>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Maria Fernandez Lopez</td>
                                                                <td><a href="mailto:juanperez@gmail.com">maria123@hotmail.com</a></td>
                                                                <td>Propietario: Esposa/ Esposo</td>
                                                                <td style="vertical-align:middle; text-align:right;">
                                                                    <div class="btn-group">
                                                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Utilizar información de contacto">
                                                                            <i class="fa fa-user-plus"></i>
                                                                        </a>
                                                                    </div>
                                                               </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Alejandro Rivera Torres</td>
                                                                <td><a href="mailto:juanperez@gmail.com">aleriverat@gmail.com</a></td>
                                                                <td>Inquilino: Titular</td>
                                                                <td style="vertical-align:middle; text-align:right;">
                                                                    <div class="btn-group">
                                                                        <a class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Utilizar información de contacto">
                                                                            <i class="fa fa-user-plus"></i>
                                                                        </a>
                                                                    </div>
                                                               </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control input-sm" name="nombre">
							@if ($errors->has('nombre'))
											<span class="help-block">
												<strong>{{ $errors->first('nombre') }}</strong>
											</span>
											@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Apellido</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control input-sm" name="apellido">
							@if ($errors->has('apellido'))
											<span class="help-block">
												<strong>{{ $errors->first('apellido') }}</strong>
											</span>
											@endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('nro_mobile') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Nro. Móvil</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control input-sm" name="nro_mobile">
											@if ($errors->has('nro_mobile'))
											<span class="help-block">
												<strong>{{ $errors->first('nro_mobile') }}</strong>
											</span>
											@endif
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="sistema">
                                <option value="SN" selected>Sin identificar</option>
                                <option value="android">Android</option>
                                <option value="ios" >iOS</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">E-mail (usuario)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="email">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success btn-sm"><i class="fa fa-check"></i>&nbsp;&nbsp;Verificar usuario</button>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label"></label>
                        <div id="pwd-container1">
                            <div class="col-sm-3" id="pwd-container1">
                                <input type="password" class="form-control example1" id="password1" placeholder="Contraseña" name="password" value="" name="password">
								@if ($errors->has('password'))
											<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
											</span>
											@endif
                            </div>
                            <div class="pwstrength_viewport_progress"></div>
                            <div class="col-sm-3" id="pwd-container1">
                                <input type="password" class="form-control example1" id="password2" placeholder="Repetir contraseña" value="" name="password_confirmation">
								@if ($errors->has('password_confirmation'))
											<span class="help-block">
												<strong>{{ $errors->first('password_confirmation') }}</strong>
											</span>
											@endif
                            </div>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('typecontact') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-3">
                            {{ Form::select('typecontact',$typecontacts, old('typecontact'), ['class' => 'form-control input-sm']) }}
								@if ($errors->has('typecontact'))
									<span class="help-block">
										<strong>{{ $errors->first('typecontact') }}</strong>
									</span>
								@endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Estado</label>
                        <div class="col-sm-3">
                            <select class="form-control input-sm" name="estado">
                                <option value="1" selected>Activo</option>
                                <option value="0">Inactivo</option>
                                <option value="2">Eliminado</option>
                            </select>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-success" type="submit" style="margin-right: 10px;">Crear usuario</button>
                            <a href="{{ route('movil.index') }}" class="btn btn-white" type="submit">Cancelar</a>
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

    $(document).ready(function(){

        // Example 1
        var options1 = {};
        options1.ui = {
            container: "#pwd-container1",
            showVerdictsInsideProgressBar: true,
            viewports: {
                progress: ".pwstrength_viewport_progress"
            }
        };
        options1.common = {
            debug: false,
        };
        $('.example1').pwstrength(options1);

    })

</script>
@endsection

