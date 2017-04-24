@extends('layouts.admin')

@section('admin-content')
    
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Propiedades</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li class="active">
                <strong>Propiedades</strong>
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
                    <h5 style="padding-top: 7px;">Lista de propiedades</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <a href="{{ route('properties.property.create') }}" class="btn btn-sm btn-default">Nueva Propiedad</a>
                    </div>
                </div>
                <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
								<th style="vertical-align:bottom">Orden</th>
								<th style="vertical-align:bottom">Número</th>
                                <th style="vertical-align:bottom">Tipo propiedad</th>
                                <th style="vertical-align:bottom">Etiquetas</th>
                                <th style="vertical-align:bottom">Situación <br>habitacional</th>
                                <th style="vertical-align:bottom">Propietario</th>
                                <th style="vertical-align:bottom" width="90"></th>
                                <th style="vertical-align:bottom" width="60"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($properties as $property)
                            <tr>
                                
								<td>{{ $property->orden }}</td>
								<td>{{ $property->nro }}</td>
                                <td>{{ $property->typeProperty->tipo_propiedad }}</td>
                                <td>{{ $property->etiquetas }}</td>
                                <td>{{ $property->situacionHabitacionals->nombre }}</td>
                                <td>
									@foreach ( $property->contact as $contact)
										@if( $contact->typecontact->nombre == 'Propietario' && $contact->relationcontact->nombre == 'Titular' && $contact->activa == 1)
											{{$contact->nombre}} {{$contact->apellido}}
											<br>
										@endif
									 
									@endforeach
								</td>
                                <td style="text-align:center;">
                                    <a href="{{ route('properties.property.contact', $property->id) }}">Contactos ({{ count($property->contact) }})</a>
                                </td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('properties.property.show', $property->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver propiedad">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('properties.property.edit', $property->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar propiedad">
                                            <i class="fa fa-pencil"></i>
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
                    "sZeroRecords":    "No se encontraron propiedades.",
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
				"columnDefs": [ { "targets": [0],"visible": false,"searchable": false },{ "orderable": false, "targets": 5 },{ "orderable": false, "targets": 6 } ]
            });
        } );
    </script>
@endsection