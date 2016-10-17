@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contactos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li class="active">
                <strong>Lista de contactos</strong>
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
                <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-6 m-b-xs">
                        <div class="btn-group">
                            <a href="{{ route('properties.contact.list', 'todos') }}" class="btn btn-sm btn-white active">
                                Todos </a>
							 <a href="{{ route('properties.contact.list', 'propietario') }}" class="btn btn-sm btn-white active">
                                Propietarios </a>
							 <a href="{{ route('properties.contact.list', 'inquilino') }}" class="btn btn-sm btn-white active">
                                Inquilinos </a>
							 <a href="{{ route('properties.contact.list', 'inactivo') }}" class="btn btn-sm btn-white active">
                                Inactivos </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom">Número</th>
                                <th style="vertical-align:bottom">Nombre completo</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom">E-mail</th>
                                <th style="vertical-align:bottom">T. móvil</th>
                                <th style="vertical-align:bottom" width="70"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)	
                            <tr>
                                <td>{{ $contact->property->nro }}</td>
                                <td>{{ $contact->nombre }} {{ $contact->apellido }}</td>
                                <td>{{ $contact->typecontact->nombre }}&nbsp;&nbsp;:&nbsp;&nbsp;{{ $contact->relationcontact->nombre }}</td>
                                <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                                <td>{{ $contact->telefono_movil }}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">
                                        <a href="{{ route('properties.contact.show', $contact->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver registro">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('properties.contact.edit', $contact->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                    </div>
                               </td>
                            </tr>
							@endforeach
                        </tbody>
                    </table>
					<a href="{{ route('properties.contact.create') }}" class="btn btn-success" >Nuevo Contacto</a>
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
				"columnDefs": [ { "orderable": false, "targets": 4 },{ "orderable": false, "targets": 5 } ]
            });
        } );
    </script>
@endsection

