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
                <strong>Mostrar usuario</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Mostrar usuario</h5>
                </div>

                <div class="ibox-content">
					{!! Form::open(array('route' => null,'method' => 'patch' ,'class' => 'form-horizontal')) !!}
					<div class="form-group">
                        <label class="col-sm-2 control-label">Propiedad</label>
                        <div class="col-sm-5">
                            {{ Form::select('property',$properties, $user->property_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
							@if ($errors->has('property'))
								<span class="help-block">
									<strong>{{ $errors->first('property') }}</strong>
								</span>
							@endif
                        </div>
					</div>
                    <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">Nombre</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control input-sm" name="nombre" value="{{$user->nombre}}" readonly>
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
                            <input type="text" class="form-control input-sm" name="apellido" value="{{$user->apellido}}" readonly>
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
                            <input type="text" class="form-control input-sm" name="nro_mobile" value="{{$user->nro_movil}}" readonly>
											@if ($errors->has('nro_mobile'))
											<span class="help-block">
												<strong>{{ $errors->first('nro_mobile') }}</strong>
											</span>
											@endif
                        </div>
                        <div class="col-sm-3">
							{{ Form::select('sistema',
							array(
							'SN' => 'Sin identificar', 
							'android' => 'Android',
							'ios' => 'IOS',
							'otro' => 'Otro'),  
							$user->sistema , 
							['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                        </div>

                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
						<label class="col-sm-2 control-label">E-mail (usuario)</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control input-sm" name="email" value="{{$user->email}}" readonly>
                        </div>
                    </div>


                    <div class="hr-line-dashed"></div>

                    <div class="form-group{{ $errors->has('typecontact') ? ' has-error' : '' }}">
                        <label class="col-sm-2 control-label">Tipo</label>
                        <div class="col-sm-3">
                            {{ Form::select('typecontact',$typecontacts, $user->typecontact_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}
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
							{{ Form::select('estado',
							array(
							'0' => 'Inactivo', 
							'1' => 'Activo',
							'2' => 'Eliminado'),  
							$user->estado , 
							['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <a href="{{ route('movil.index') }}" class="btn btn-success" type="submit">Atras</a>
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

