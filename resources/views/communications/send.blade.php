@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Comunicados</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="#/">Inicio</a>
                </li>
                <li>
                    Comunicación & Información
                </li>
                <li>
                    <a href="#">Lista de comunicados</a>
                </li>
                <li class="active">
                    <strong>Enviar comunicado</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">

                    <div class="ibox-title">
                        <h5 style="padding-top: 2px;">Enviar comunicado</h5>
                    </div>

                    <div class="ibox-content">

                        <form method="get" class="form-horizontal">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Comunicado</label>
                                <div class="col-sm-9">
									{{ Form::select('comunicado',$communications, old('comunicado'), ['class' => 'form-control input-sm']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Remitente</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" name="remitente">
                                        <option value="todos">Administración</option>
                                        <option value="copropietarios">Directorio</option>
                                        <option value="inquilinos">Sin remitente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirigido a</label>
                                <div class="col-sm-5">
                                    <select class="form-control input-sm" id="dirigido-a" name="dirigido">
                                        <option value="todos">Todos los contactos</option>
                                        <option value="copropietarios">Copropietarios</option>
                                        <option value="inquilinos">Inquilinos</option>
                                        <option value="directorio">Directorio</option>
                                        <option value="propiedad">Seleccionar propiedad</option>
                                        <option value="contacto">Seleccionar contacto(s)</option>
                                        <option value="correo">Dirección de E-mail</option>
                                        <option value="prueba">Prueba de envío</option>
                                    </select>
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Seleccionar propiedad             -->
                            <div class="form-group" id="select-propiedad">
                                <label class="col-sm-3 control-label">Propiedad</label>
                                <div class="col-sm-5">
									{{ Form::select('propiedad',$properties, old('property'), ['class' => 'form-control input-sm']) }}
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Seleccionar contacto(s)             -->
                            <div class="form-group" id="select-contacto">
                                <label class="col-sm-3 control-label">Destinatario</label>
                                <div class="col-sm-8">
									{{ Form::select('destinatario',$contacts, old('destinatario'), ['multiple' => true,'class' => 'form-control input-sm chosen-select']) }}
                                </div>
                            </div>


                            <!--    ESTE SELECT PARA: Dirección de correo                -->
                            <div class="form-group" id="correo">
                                <label class="col-sm-3 control-label">Dirección de correo</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control input-sm">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Proceso de envío</label>
                                <div class="col-sm-9" style="margin-top: 5px">
                                    <div class="progress">
                                        <div style="width: 65%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="65" role="progressbar" class="progress-bar progress-bar-success">
                                            <span>65% Completado</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--    PANEL REGISTRO DE ENVIO DE COMUNICADOS              -->
                            <div class="form-group">
                                <label class="col-sm-3 control-label"></label>
                                <div class="col-sm-9">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Registro de envío
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Fecha envío</label>
                                                <div class="col-sm-3">
                                                    <p class="form-control-static">07/04/2016</p>
                                                </div>
                                                <label class="col-sm-2 control-label">Hora envío</label>
                                                <div class="col-sm-3">
                                                    <p class="form-control-static">14:34</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Destinatarios</label>
                                                <div class="col-sm-8">
                                                    <p class="form-control-static">Directorio; joseluisbr@gmail.com</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <!--    FIN - PANEL REGISTRO DE ENVIO DE COMUNICADOS            -->


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit">Enviar</button>
                                    <button class="btn btn-white" type="submit">Cancelar</button>
                                </div>
                            </div>

                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/chosen/chosen.css') }}" />
@endsection
@section('javascript')
	<script type="text/javascript" src="{{ URL::asset('js/chosen/chosen.jquery.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#select-propiedad').hide();
            $('#select-contacto').hide();
            $('#correo').hide();
            $('#dirigido-a').change(function(){
                    if ( $(this).val() === "propiedad" ) {
                        $('#select-propiedad').show("slow");
                        $('#select-contacto').hide();
						$('#correo').hide();
                    }else if( $(this).val() === "contacto" ){
                        $('#select-propiedad').hide();
                        $('#select-contacto').show("slow");
						$('#correo').hide();
                    }else if( $(this).val() === "correo" ){
                        $('#select-propiedad').hide();
                        $('#select-contacto').hide();
						$('#correo').show("slow");
                    }else if( $(this).val() === "prueba" ){
                        $('#select-propiedad').hide();
                        $('#select-contacto').hide();
						$('#correo').show("slow");
                    }
					
            });

        });
		$(".chosen-select").chosen();
    </script>
@endsection