@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Estado de Resultados</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Estado de Resultados</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Estado de Resultados</h5>
                </div>
				{!! Form::open(array('route' => 'report.estadoresultados.show')) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-7">
                        <div role="form" class="form-horizontal">
                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Periodo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" id="periodo" name="periodo">
                                            <optgroup>
                                                <option value="actual">Mes actual</option>
                                                <option value="anterior">Mes anterior</option>
                                                <option value="gestionactual">Gestión actual</option>
                                                <option value="gestionanterior">Gestión anterior</option>
                                            </optgroup>
                                            <optgroup>
                                                <option value="mesygestion">Por mes y gestión</option>
                                                <option value="porgestion">Por gestión</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="meses">
                                    <label class="col-sm-4 control-label">Mes</label>
                                    <div class="col-sm-4">
                                        {{ Form::select('mes',
										array(
										'1' => 'Enero',
										'2' => 'Febrero',
										'3' => 'Marzo',
										'4' => 'Abril',
										'5' => 'Mayo',
										'6' => 'Junio',
										'7' => 'Julio',
										'8' => 'Agosto',
										'9' => 'Septiembre',
										'10' => 'Octubre',
										'11' => 'Noviembre',
										'12' => 'Diciembre',
										),date("m"),
										['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="gestiones">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-4">

                                        {{ Form::select('anio',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                <div class="form-group" id="mesanterior">
                                    <label class="col-sm-4 control-label">Incluir mes anterior</label>
                                    <div class="col-sm-4">
                                        <label><input type="checkbox" name="checkmesanterior" value="1" class="i-checks"></label>
                                    </div>
                                </div>

                                <div class="form-group" id="gestionanterior">
                                    <label class="col-sm-4 control-label">Incluir gestión anterior</label>
                                    <div class="col-sm-4">
                                        <label><input type="checkbox" name="checkgestionanterior" value="1" class="i-checks"></label>
                                    </div>
                                </div>
                        </div>
                        </div>
                        <div class="col-sm-5"><h4 class="text-muted">Estado de Resultados</h4>
                            <p class="text-muted">Este reporte refleja el resultado de todo el ingreso y egreso de dinero en un periodo de tiempo.</p>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-12">
                        <div class="hr-line-dashed"></div>

                        <div class="form-group text-right">
                            <button class="btn btn-success" type="submit">Siguiente</button>
                        </div>
                    </div>
                    </div>

                </div>
				{!! Form::close() !!}
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
            //Oculta campose dependiendo la opcion
            $('#meses').hide();
            $('#gestiones').hide();
            //$('#mesanterior').hide();
			$('#gestionanterior').hide();
            $('#periodo').change(function(){

                    if ( $(this).val() == "actual" ) {
                        $('#meses').hide();
						$('#gestiones').hide();
						$('#mesanterior').show();
						$('#gestionanterior').hide();
                    }else if($(this).val() == "anterior"){
                        $('#meses').hide();
						$('#gestiones').hide();
						$('#mesanterior').hide();
						$('#gestionanterior').hide();
                    }else if($(this).val() == "gestionactual"){
                        $('#meses').hide();
						$('#gestiones').hide();
						$('#mesanterior').hide();
						$('#gestionanterior').show();
                    }else if($(this).val() == "gestionanterior"){
                        $('#meses').hide();
						$('#gestiones').hide();
						$('#mesanterior').hide();
						$('#gestionanterior').hide();
                    }else if($(this).val() == "mesygestion"){
                        $('#meses').show();
						$('#gestiones').show();
						$('#mesanterior').hide();
						$('#gestionanterior').hide();
                    }else if($(this).val() == "porgestion"){
                        $('#meses').hide();
						$('#gestiones').show();
						$('#mesanterior').hide();
						$('#gestionanterior').hide();
                    }
            });
        });
    </script>
@endsection
