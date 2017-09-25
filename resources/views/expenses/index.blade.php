@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Gastos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Gastos</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Gastos</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px; color: white;" href="{{ route('transaction.expense.create') }}"> Nuevo gasto </a>

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
                                <th style="vertical-align:bottom; text-align: right;">Importe</th>
                                <th style="vertical-align:bottom" width="100"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($expenses as $expense)
							@if($expense->transaction->anulada == 1)
                            <tr style="color: #bbb">
                                <td data-order="{{ $expense->transaction->fecha_pago }}">{{ date_format(date_create($expense->transaction->fecha_pago),'d/m/Y') }}</td>
                                <td>{{ str_pad($expense->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</td>
                                <td>{{$expense->supplier->razon_social}}</td>
                                <td>{{$expense->category->nombre}}</td>
                                <td>{{$expense->transaction->concepto}}</td>
                                <td>{{$expense->account->nombre}} {{$expense->account->nro_cuenta}}</td>
                                <td>{{ucfirst($expense->transaction->forma_pago)}} {{$expense->transaction->numero_forma_pago}}</td>
                                <td style="text-align: right;">{{ number_format($expense->transaction->importe_debito, 2, '.', '.') }}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                     <span class="label label-warning">ANULADA</span>
                               </td>
                            </tr>
							@else
							<tr>
                                <td data-order="{{ $expense->transaction->fecha_pago }}">{{ date_format(date_create($expense->transaction->fecha_pago),'d/m/Y') }}</td>
                                <td>{{ str_pad($expense->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</td>
                                <td>{{$expense->supplier->razon_social}}</td>
                                <td>{{$expense->category->nombre}}</td>
                                <td>{{$expense->transaction->concepto}}</td>
                                <td>{{$expense->account->nombre}} {{$expense->account->nro_cuenta}}</td>
                                <td>{{ucfirst($expense->transaction->forma_pago)}} {{$expense->transaction->numero_forma_pago}}</td>
                                <td style="text-align: right;">{{ number_format($expense->transaction->importe_debito, 2, '.', '.') }}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('transaction.expense.show',Crypt::encrypt($expense->id) ) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comprobante">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('transaction.expense.copy',Crypt::encrypt($expense->id) ) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar gasto">
                                            <i class="fa fa-files-o"></i>
                                        </a>
                                        <a href="{{ route('transaction.expense.edit', Crypt::encrypt($expense->id) ) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar comprobante">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
							
							@endif
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
@section('style')
    <link rel="stylesheet" href="{{ URL::asset('css/datatables.min.css') }}" />
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "order": [[ 0, "desc" ], [ 1, "desc" ]],
                "pageLength": 100,
                "lengthMenu": [ [50, 100, 200, -1], [50, 100, 200, "Todos"] ],
                "paging":   true,
                "bLengthChange" : false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 4 }, {"orderable": false, "targets": 6 }, {"orderable": false, "targets": 8 } ]
            });
        } );
    </script>
@endsection



