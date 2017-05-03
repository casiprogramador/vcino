@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Disponibilidad</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Disponibilidad</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Disponibilidad</h5>
                </div>
				{!! Form::open(array('route' => 'report.disponibilidad.show')) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-6">
                            <div role="form" class="form-horizontal">
                                <div class="form-group" id="fecha" style="padding-top: 10px;">
                                    <label class="col-sm-3 control-label">Fecha</label>
                                    <div class="col-sm-6 input-group date" style="padding-left:15px;">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <input type="text" class="form-control input-sm date-picker" name="fecha" value="{{ date('d/m/Y') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6"><h4 class="text-muted">Disponibilidad</h4>
                            <p class="text-muted">Este reporte refleja el total de dinero disponible en cada una de las cuentas para la fecha seleccionada. Incluye las cuentas de tipo Cuenta corriente, Caja de ahorro y efectivo.</p>
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
	$('.date-picker').datetimepicker({
		format: 'DD/MM/YYYY'
	});
</script>
@endsection

