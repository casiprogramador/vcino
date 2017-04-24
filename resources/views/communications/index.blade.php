@extends('layouts.admin')

@section('admin-content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Comunicados</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('admin.home') }}">Inicio</a>
                </li>
                <li>
                    Comunicación & Información
                </li>
                <li class="active">
                    <strong>Comunicados</strong>
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
                        <h5 style="padding-top: 7px;">Comunicados</h5>
                        <div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('communication.communication.create') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="Nuevo comunicado" style="margin-right: 10px; color: white;"> Nuevo comunicado </a>

                            <a href="{{ route('communication.register.send') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de comunicados" data-original-title="Ver registro de envíos de comunicados" style="margin-right: 5px;"> Registro de envíos </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
									<th style="vertical-align:bottom">Fecha Original</th>
                                    <th style="vertical-align:bottom">Fecha</th>
                                    <th style="vertical-align:bottom">Asunto</th>
                                    <th style="vertical-align:bottom">Destinatario(s)</th>
                                    <th style="vertical-align:bottom">Estado</th>
                                    <th style="vertical-align:bottom" width="150"></th>
                                </tr>
                                </thead>
                                <tbody>
								@foreach ($communications as $communication)
                                <tr>
									<td>{{ $communication->fecha }}</td>
                                    <td>{{ date_format(date_create($communication->fecha),'d/m/Y') }}</td>
                                    <td>{{$communication->asunto}}</td>
                                    <td>
										@foreach($communication->sendcommunication as $send)
											@if($send->dirigido == 'correo')	
												@foreach( ( explode(",",$send->correos) ) as $correo)
													<span class="badge">{{$correo}}</span>
												@endforeach
											@elseif($send->dirigido == 'todos')							
												<span class="badge">Todos los contactos</span>
											@else
												<span class="badge">{{ ucwords($send->dirigido) }}</span>
											@endif
											
										@endforeach
									</td>
                                    <td>
										@if( count($communication->sendcommunication) )
											Enviado
										@else
											Borrador
										@endif
									</td>
                                    <td style="vertical-align:middle; text-align:right;">
                                        <div class="btn-group">			
                                            <a href="{{ route('communication.communication.show', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('communication.communication.copy', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Copiar...">
                                                <i class="fa fa-files-o"></i>
                                            </a>
											@if( count($communication->sendcommunication) )
											<a class="btn btn-default btn-xs disabled" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                                <i class="fa fa-pencil"></i>
                                            </a>
											@else
                                            <a href="{{ route('communication.communication.edit', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                                <i class="fa fa-pencil"></i>
                                            </a>
											@endif
                                        </div>
                                        <div class="btn-group">
                                            <a href="{{ route('communication.communication.print', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Imprimir...">
                                                <i class="fa fa-print"></i>
                                            </a>
											@if( count($communication->sendcommunication) )
											<a href="{{ route('communication.communication.resend', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Reenviar...">
                                                <i class="fa fa-reply"></i>
                                            </a>
											@else
											<a href="{{ route('communication.communication.send', $communication->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Enviar...">
                                                <i class="fa fa-envelope-o"></i>
                                            </a>
											@endif
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
                    "sEmptyTable":     "No se encontraron Comunicados.",
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
                "order": [[ 0, "desc" ]],
                "paging":   false,
                "info":     false,
                "columnDefs": [ { "targets": [0],"visible": false,"searchable": false },{ "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection