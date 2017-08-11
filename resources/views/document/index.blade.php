@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Directorio de documentos</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Comunicación & Información
            </li>
            <li class="active">
                <strong>Directorio de documentos</strong>
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
                    <h5 style="padding-top: 7px;">Documentos</h5>
                    <div class="ibox-tools" style="padding-bottom: 7px; padding-right: 5px;">
                        <div class="btn-group">
                            <a href="{{ route('communication.document.create') }}" class="btn btn-sm btn-success" style="color: white;">Subir documento</a>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">

                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="vertical-align:bottom"></th>
                                <th style="vertical-align:bottom">Documento</th>
                                <th style="vertical-align:bottom">Fecha actualización</th>
                                <th style="vertical-align:bottom">Tamaño</th>
                                <th style="vertical-align:bottom">Tipo</th>
                                <th style="vertical-align:bottom" width="120"></th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($documents as $document)
                            <tr>
								
                                <td style="vertical-align: middle; text-align: center; padding: 0;">
                                    <div class="icon" style="padding: 15px 0px; width: 110px; background-color: white; border-left: 1px #E8E8E8 solid; border-right: 1px #E8E8E8 solid;">
										@if($document->type == 'jpg' || $document->type == 'png')

										<img src="{{ URL::asset($document->archivo)}}" width="110" alt="image" class="img-responsive">
										
										@elseif($document->type == 'pdf')
										<i class="fa fa fa-file-pdf-o fa-3x"></i>

										@elseif($document->type == 'doc' || $document->type == 'txt' || $document->type == 'docx')
										<i class="fa fa-file-word-o fa-3x"></i>

										@elseif($document->type == 'xls' || $document->type == 'xlsx')
										<i class="fa fa-file-excel-o fa-3x"></i>

										@elseif($document->type == 'rar' || $document->type == 'zip')
										<i class="fa fa-file-archive-o fa-3x"></i>

										@else
										<i class="fa fa-file fa-3x"></i>
										@endif
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">{{$document->nombre}}</td>
                                <td style="vertical-align: middle;">{{ date_format(date_create($document->fecha),'d/m/Y') }}</td>
                                <td style="vertical-align: middle;">{{bytesToHuman($document->size)}}</td>
                                <td style="vertical-align: middle;">{{strtoupper($document->type)}}</td>
                                <td style="vertical-align:middle; text-align:right;">
                                    <div class="btn-group">

										<a href="{{ URL::asset($document->archivo)}}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Ver equipo" target="_blank">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                        <a href="{{ URL::asset($document->archivo)}}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Descargar documento" download>
                                            <i class="fa fa-download"></i>
                                        </a>
                                        <a href="{{ route('communication.document.edit', $document->id) }}" class="btn btn-success btn-xs btn-outline btn-bitbucket" data-toggle="tooltip" data-placement="bottom" title="Editar registro de documento">
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
