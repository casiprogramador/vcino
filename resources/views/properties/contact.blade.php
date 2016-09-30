@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Contactos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                <a href="{{ route('properties.property.index') }}">Lista de propiedades</a>
            </li>
            <li class="active">
                <strong>Contactos por propiedad</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content" style="background-color: #f9f9f9;">                
                    <form method="get" class="form-horizontal">
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-3 control-label">Número propiedad:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static"><b>{{ $property->nro }}</b></p>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <div class="col-sm-12">
                                <div class="row">
                                    <label class="col-sm-3 control-label">Tipo propiedad:</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static">{{ $property->typeProperty->tipo_propiedad }}</p>
                                    </div>

                                    <label class="col-sm-3 control-label">Situación habitacional:</label>
                                    <div class="col-sm-3">
                                        <p class="form-control-static">{{ $property->situacionHabitacionals->nombre }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 0px;">
                            <label class="col-sm-3 control-label">Etiquetas:</label>
                            <div class="col-sm-9">
                                <p class="form-control-static">{{ $property->etiquetas }}</p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                <div class="ibox-title">
                    <h5>Contactos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <th style="vertical-align:bottom">Nombre completo</th>
                                    <th style="vertical-align:bottom">Tipo</th>
                                    <th style="vertical-align:bottom">Relación</th>
                                    <th style="vertical-align:bottom">E-mail</th>
                                    <th style="vertical-align:bottom">T. móvil</th>
                                    <th style="vertical-align:bottom">Correspondencia</th>
                                    <th style="vertical-align:bottom">Estado</th>
                                    <th style="vertical-align:bottom" width="70"></th>
                                </tr>
                            </thead>
                            <tbody>
								@foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->nombre }} {{ $contact->apellido }}</td>
                                    <td>{{ $contact->typecontact->nombre }}</td>
                                    <td>{{ $contact->relationcontact->nombre }}</td>
                                    <td><a href="mailto:juanperez@gmail.com">{{ $contact->email }}</a></td>
                                    <td>{{ $contact->telefono_movil }}</td>
                                    <td>
											@if(in_array('Comunicados',explode(',',$contact->correspondencia)))
												<span class="badge">Com</span>
											@endif
											@if(in_array('Cobranzas',explode(',',$contact->correspondencia)))
												<span class="badge">Cob</span>
											@endif
											@if(in_array('Directorio',explode(',',$contact->correspondencia)))
												<span class="badge">Dir</span>
											@endif
                                    </td>
                                    <td>
										@if($contact->activa == 1)
											Activo
										@else
											Inactivo
										@endif
									</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="row">
        <div class="col-lg-12">
            <div class="ibox collapsed">

                <div class="ibox-title">
                    <h5>Vehículos</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

                <div class="ibox-content">
                    
                    <!-- Aqui el contenido      -->


                </div>
            </div>
        </div>
    </div>


</div>

@endsection



