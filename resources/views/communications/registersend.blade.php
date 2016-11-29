@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Comunicados</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Comunicación & Información
            </li>
            <li>
                <a href="#">Comunicados</a>
            </li>
            <li class="active">
                <strong>Registro de envíos</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Registro de envíos de comunicados</h5>
                </div>

                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th style="vertical-align:bottom">Fecha<br>comunicado</th>
                            <th style="vertical-align:bottom">Asunto</th>
                            <th style="vertical-align:bottom">Destinatarios</th>
                            <th style="vertical-align:bottom">Fecha y hora de envío</th>
                            <th width="80"></th>
                        </tr>
                        </thead>
                        <tbody>
							@foreach ($sendcommunications as $sendcommunication)
							
							<tr class="gradeX">
								<td>{{ date_format(date_create($sendcommunication->communication->created_at),"d/m/Y") }}</td>
								<td>{{ $sendcommunication->communication->asunto }}</td>
								<td>
									@if($sendcommunication->dirigido == 'correo' || $sendcommunication->dirigido == 'contacto')	
										@foreach( ( explode(",",$sendcommunication->correos) ) as $correo)
											<span class="badge">{{$correo}}</span>
										@endforeach
									@else
										<span class="badge">{{ ucwords($sendcommunication->dirigido) }}</span>
									@endif											
								</td>
								<td>{{ date_format(date_create( $sendcommunication->created_at ),"d/m/Y H:i") }}</td>
									<td style="vertical-align:middle; text-align:right;">
										<div class="btn-group">
											<a href="{{ route('communication.communication.show', $sendcommunication->communication_id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver comunicado">
												<i class="fa fa-eye"></i>
											</a>
										</div>
										<div class="btn-group">
											<a href="{{ route('communication.communication.resend', $sendcommunication->communication_id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Reenviar...">
												<i class="fa fa-share"></i>
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
                "paging":   false,
                "info":     false,
                "columnDefs": [ { "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection
