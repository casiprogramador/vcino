@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cobranzas por estado</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Cobranzas por estado</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Cobranzas por estado</h5>
                </div>
				{!! Form::open(array('route' => 'report.estadopagos.show')) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-8">
                            <div role="form" class="form-horizontal">

                                <div class="form-group"  id="meses">
                                    <label class="col-sm-4 control-label">Mes</label>
                                    <div class="col-sm-5">
                                        <select class="form-control input-sm" name="mes">
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="gestiones">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-5">
										{{ Form::select('anio',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-4"><h4 class="text-muted"> </h4>
                            <p class="text-muted"> </p>
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


        });
    </script>
@endsection



