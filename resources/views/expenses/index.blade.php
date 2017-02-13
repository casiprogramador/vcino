@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Lista de gastos</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de gastos</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;" href="{{ route('transaction.expense.create') }}"> Nuevo gasto </a>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Fecha</th>
                                <th style="vertical-align:bottom">Nro.<br/>Documento</th>
                                <th style="vertical-align:bottom">Proveedor</th>
                                <th style="vertical-align:bottom">Categoría</th>
                                <th style="vertical-align:bottom">Concepto</th>
                                <th style="vertical-align:bottom">Cuenta</th>
                                <th style="vertical-align:bottom">Forma<br/> de pago</th>
                                <th style="vertical-align:bottom">Ref. pago</th>
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="120"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($expenses as $expense)
                            <tr>
                                <td>{{ date_format(date_create($expense->transaction->fecha_pago),'d/m/Y') }}</td>
                                <td>{{$expense->transaction->nro_documento}}</td>
                                <td>{{$expense->supplier->razon_social}}</td>
                                <td>{{$expense->category->description}}</td>
                                <td>{{$expense->transaction->concepto}}</td>
                                <td>{{$expense->account->tipo_cuenta}} {{$expense->account->nro_cuenta}}</td>
                                <td>{{$expense->transaction->forma_pago}}</td>
                                <td>{{$expense->transaction->numero_forma_pago}}</td>
                                <td style="text-align: right;">{{$expense->transaction->importe_debito}}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('transaction.expense.show', $expense->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar gasto">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
							@endforeach
                           

                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>

    </div>

</div>



@endsection



