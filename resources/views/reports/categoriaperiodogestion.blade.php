@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Categorías por periodo y gestión</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Categorías por periodo y gestión</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Categorías por periodo y gestión</h5>
                </div>
				{!! Form::open(array('route' => 'report.categoriaperiodogestion.show', 'class' => 'form-horizontal')) !!}
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-8">
                            <form role="form" class="form-horizontal">

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gestión</label>
                                    <div class="col-sm-4">
                                        {{ Form::select('anio',$gestiones, date("Y"), ['class' => 'form-control input-sm']) }}
                                    </div>
                                </div>

                                

                            </form>
                        </div>
                        <div class="col-sm-4"><h4 class="text-muted">Categorías por periodo y gestión</h4>
                            <p class="text-muted">Este reporte refleja los gastos durante una gestión por categorías mes a mes.</p>
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
            
        });
    </script>
@endsection

