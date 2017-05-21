@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cuentas por cobrar</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Cuentas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Cuentas por cobrar</h5>
                </div>

                <div class="ibox-content">
					{!! Form::open(array('route' => 'report.cuentascobrar.show', 'class' => 'form-horizontal')) !!}
                    <div class="row">
                        <div class="col-sm-6">
                            
							
                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Periodo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="periodo">
                                            <option value="actual">A la fecha</option>
                                            <option value="anterior">Mes anterior</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Tipo</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="tipo" id="tipo">
                                            <option value="detallado">Detallado</option>
                                            <option value="consolidado">Consolidado</option>
                                            <option value="porpropiedad">Por propiedad</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="propiedades" style="padding-top: 10px;">
                                    <label class="col-sm-4 control-label">Propiedad</label>
                                    <div class="col-sm-5">
                                        {{ Form::select('propiedad',$properties, old('propiedad'), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                        </div>
                        <div class="col-sm-6"><h4 class="text-muted">Cuentas por cobrar</h4>
                            <p class="text-muted">Este reporte refleja el estado de las cuotas por cobrar de cada propiedad, detallado por cuota, periodo y gestión. El reporte también incluye la opción de totalizar por propiedad.</p>
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
            //Oculta campose dependiendo la opcion
            $('#propiedades').hide();
            $('#tipo').change(function(){

                    if ( $(this).val() == "detallado" ) {
                        $('#propiedades').hide();
						
                    }else if($(this).val() == "consolidado"){
                        $('#propiedades').hide();
                    }else if($(this).val() == "porpropiedad"){
                        $('#propiedades').show();
                    }else{
						$('#propiedades').hide();
					}
            });
        });
    </script>
@endsection
