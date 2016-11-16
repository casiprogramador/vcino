@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Equipamiento</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('equipment.machinery.index') }}">Equipos y maquinarias</a>
                </li>
                <li class="active">
                    <strong>Ver</strong>
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
                                <li class="active"><a data-toggle="tab" href="#tab-1">Detalle: {{$equipment->equipo}}</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('equipo') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Equipo</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control input-sm" name="equipo" value="{{$equipment->equipo}}" readonly>

                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('tipo_equipo') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Tipo de equipamiento</label>
                                            <div class="col-sm-3">
                                                {{ Form::select('tipo_equipo',array('0' => 'Seleccione','Equipo' => 'Equipo', 'Mobiliario' => 'Mobiliario', 'Instalaciones' => 'Instalaciones', 'Otro' => 'Otro'),$equipment->tipo_equipo,['class' => 'form-control input-sm','disabled'=>'disabled']) }}
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('ubicacion') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Ubicación</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="ubicacion" value="{{$equipment->ubicacion}}" readonly>

                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('proveedor') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Proveedor</label>
                                            <div class="col-sm-6">
                                                {{ Form::select('proveedor',['0' => 'Seleccione un proveedor']+$suppliers,$equipment->supplier_id, ['class' => 'form-control input-sm','disabled'=>'disabled']) }}

                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('fecha_instalacion') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fecha de instalación o compra</label>
                                            <div class="col-sm-4">
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <input type="text" class="form-control date-picker" value="{{date('d/m/Y', strtotime($equipment->fecha_instalacion)) }}" name="fecha_instalacion" readonly>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('vida') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Vida útil (meses)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="vida" value="{{$equipment->vida}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('garantia') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Garantía (meses)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="garantia" value="{{$equipment->garantia}}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('mantenimiento') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Frecuencia mantenimiento (meses)</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control input-sm" name="mantenimiento" value="{{$equipment->mantenimiento}}" readonly>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('notas') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Notas</label>
                                            <div class="col-sm-9">
                                                <?php echo $equipment->notas ?>
                                            </div>

                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('documento') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Documento</label>
                                            <div class="col-sm-3">
                                                <a href="{{asset($equipment->documento)}}" target="_blank" class="btn btn-default" role="button">Ver Documento</a>
                                            </div>
                                            <div class="col-sm-5">
                                                <p style="font-size: 11px; color: #B0B0B0;">Manual, ficha técnica. Documento que se adjunta al equipo.</p>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group{{ $errors->has('fotografia_1') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fotografía #1</label>
                                            <div class="col-sm-9">
                                                <img src="{{ $equipment->fotografia_1 }}" class="img-responsive" width="100">
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('fotografia_2') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fotografía #2</label>
                                            <div class="col-sm-9">
                                                <img src="{{ $equipment->fotografia_2 }}" class="img-responsive" width="100">
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('fotografia_3') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Fotografía #3</label>
                                            <div class="col-sm-9">
                                                <img src="{{ $equipment->fotografia_3 }}" class="img-responsive" width="100">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Activa</label>
                                            <div class="col-sm-4">
                                                <label><input type="checkbox" class="i-checks" name="activa" value="1" {{ ($equipment->activa == 1) ? 'checked' : '' }} disabled="disabled"></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <a href="{{ route('equipment.machinery.index') }}" class="btn btn-success">Volver</a>
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
