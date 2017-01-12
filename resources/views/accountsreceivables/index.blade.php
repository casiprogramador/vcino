@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Transacciones
            </li>
            <li class="active">
                <strong>Cuotas por cobrar</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
			@if (Session::has('message'))
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					{!! session('message') !!}
				</div>
			@endif
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Lista de cuotas por cobrar</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <a href="{{ route('transaction.accountsreceivable.create') }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo cuota por cobrar" style="margin-right: 5px;"> Nueva cuota </a>

                    </div>
                </div>

                <div class="ibox-content">
                <div class="row">
					{!! Form::open(array('route' => 'transaction.accountsreceivable.search', 'class' => 'form-horizontal')) !!}
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="estado">
                            <option value="todos">Estado: Todas</option>
                            <option value="1">Canceladas</option>
                            <option value="0">Pendientes</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="gestion">
                            <option value="todos">Gestión: Todas</option>
                            <option value="2017">2017</option>
							<option value="2016">2016</option>
                            <option value="2016">2015</option>
                            <option value="2014">2014</option>
                        </select>
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline" name="periodo">
                            <option value="todos">Periodo: Todos</option>
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
                    <div class="col-sm-3 m-b-xs">
                        {{ Form::select('propiedad',['todos'=>'Propiedad: Todas']+$properties, old('propiedad'), ['class' => 'form-control input-sm']) }}
                    </div>
                    <div class="col-sm-2 m-b-xs">
                        {{ Form::select('cuota',['todos'=>'Cuota: Todas']+$quotas, old('cutas'), ['class' => 'form-control input-sm']) }}
                    </div>
					<button class="btn btn-white" type="submit">Buscar</button>
					{!! Form::close() !!}
                </div>
                <div class="row">
                    <div class="col-sm-12 m-b-xs">
                        <hr>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Propiedad</th>
                                <th style="vertical-align:bottom">Gestión</th>
                                <th style="vertical-align:bottom">Periodo</th>
                                <th style="vertical-align:bottom">Cuota</th>
                                <th style="vertical-align:bottom">Vencimiento</th>
                                <th style="vertical-align:bottom" class="text-right">Importe</th>
                                <th style="vertical-align:bottom">Cancelada</th>
                                <th style="vertical-align:bottom"></th>
								<th style="vertical-align:bottom"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($accountsreceivables as $accountsreceivable)
                                @if($accountsreceivable->cancelada == 1)
									<tr>
										<td>{{ $accountsreceivable->property->nro }}</td>
										<td>{{ $accountsreceivable->gestion }}</td>
										<td>{{ $accountsreceivable->periodo }}</td>
										<td>{{ $accountsreceivable->quota->cuota }}</td>
										<td>{{ date_format(date_create($accountsreceivable->fecha_vencimiento),'d/m/Y') }}</td>
										<td class="text-right">{{ $accountsreceivable->importe_por_cobrar }}</td>
										<td>
											<i class="fa fa-lg fa-check-square text-primary"></i>
										</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												<a href="{{ route('transaction.accountsreceivable.show', $accountsreceivable->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver">
													<i class="fa fa-eye"></i>
												</a>
												<a class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar...">
													<i class="fa fa-files-o"></i>
												</a>
												<a href="{{ route('transaction.accountsreceivable.edit', $accountsreceivable->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar">
													<i class="fa fa-pencil"></i>
												</a>
											</div>
									   </td>
									</tr>
								@else
									<tr>
										<td>{{ $accountsreceivable->property->nro }}</td>
										<td>{{ $accountsreceivable->gestion }}</td>
										<td>{{ $accountsreceivable->periodo }}</td>
										<td>{{ $accountsreceivable->quota->cuota }}</td>
										<td>{{ date_format(date_create($accountsreceivable->fecha_vencimiento),'d/m/Y') }}</td>
										<td class="text-right">{{ $accountsreceivable->importe_por_cobrar }}</td>
										<td>
											<i class="fa fa-lg fa-square-o text-muted"></i>
										</td>
										<td style="vertical-align:middle; text-align:right;">
											<div class="btn-group">
												<a href="{{ route('transaction.accountsreceivable.show', $accountsreceivable->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver">
													<i class="fa fa-eye"></i>
												</a>
												<a href="{{ route('transaction.accountsreceivable.copy', $accountsreceivable->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar...">
													<i class="fa fa-files-o"></i>
												</a>
												<a href="{{ route('transaction.accountsreceivable.edit', $accountsreceivable->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar">
													<i class="fa fa-pencil"></i>
												</a>
											</div>
									   </td>
									   <td style="text-align:right;">

										   {!! Form::open(['route' => ['transaction.accountsreceivable.destroy', $accountsreceivable->id], 'method' => 'delete']) !!}
					{!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger', 'onclick' => "return confirm('¿Esta usted seguro de eliminar esta cuota por pagar?')"]) !!}
					{!! Form::close() !!}
										   
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
                "order": [[ 1, "asc" ]],
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
                "paging":   false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 4 }, { "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection


