@extends('layouts.admin')

@section('admin-content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Proveedores</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li class="active">
                    Configuración
                </li>
                <li class="active">
                    <a href="{{ route('config.supplier.index') }}">Proveedores</a>
                </li>
                <li class="active">
                    <strong>Editar proveedor</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">

                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::open(array('route' => array('config.supplier.update', $supplier->id),'method' => 'patch' ,'class' => 'form-horizontal')) !!}

                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#tab-1">Editar proveedor</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane active">
                                    <div class="panel-body">

                                        <div class="form-group{{ $errors->has('razon_social') ? ' has-error' : '' }}">
                                            <label class="col-sm-3 control-label">Razón social/ Nombre</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" name="razon_social" value="{{ $supplier->razon_social }}">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Contacto</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Nombre" class="form-control" name="contacto_nombre" value="{{ $supplier->contacto_nombre }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Apellido" class="form-control" name="contacto_apellido" value="{{ $supplier->contacto_apellido }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Cheque a nombre de</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-sm" style="text-transform: uppercase;" name="nombre_cheque" value="{{ $supplier->nombre_cheque }}">
                                                <span class="help-block m-b-none" style="color: #BDBDBD">Nombre o razón social para emitir el cheque.</span>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Teléfonos</label>
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Oficina" class="form-control" name="telefono_oficina" value="{{ $supplier->telefono_oficina }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Móvil" class="form-control" name="telefono_movil" value="{{ $supplier->telefono_movil }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" placeholder="Emergencias" class="form-control" style="background-color: #ECF7FE" name="telefono_emergencia" value="{{ $supplier->telefono_emergencia }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">E-mail</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control input-sm" name="email" value="{{ $supplier->email }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Sitio web</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control input-sm" name="sitio_web" value="{{ $supplier->sitio_web }}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Dirección</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control input-sm" name="direccion" value="{{ $supplier->direccion }}">
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Notas</label>
                                            <div class="col-sm-9">
                                                <textarea rows="4" class="form-control input-sm" name="notas">{{ $supplier->notas }}</textarea>
                                            </div>
                                        </div>

                                        <div class="hr-line-dashed"></div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Activo</label>
                                            <div class="col-sm-4">

                                                <input type="checkbox" class="i-checks" name="activa" value="1" {{ ($supplier->activa == 1) ? 'checked' : '' }}>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success" type="submit" style="margin-right: 10px;">Guardar</button>
                                    <a href="{{ route('config.supplier.index') }}" class="btn btn-white" >Cancelar</a>
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

        });
    </script>
@endsection