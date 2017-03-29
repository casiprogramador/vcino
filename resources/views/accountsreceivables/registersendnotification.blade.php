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
                <strong>Registro de envios</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">

                <div class="ibox-title">
					<div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('transaction.accountsreceivable.generatenotification') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Generar nuevos avisos de cobranza" data-original-title="generar nuevos avisos de cobranza" style="margin-right: 5px;"> Generar avisos de cobranza </a>

                            <a href="{{ route('transaction.accountsreceivable.registernotification') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de avisos de cobranza" data-original-title="Ver registro de envíos de avisos de cobranza" style="margin-right: 5px;"> Registro de envios </a>
                    </div>
                </div>

                <div class="ibox-content">
                    

                    <!--    INFORME DE ENVIO        -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom">Propiedad</th>
                                            <th style="vertical-align:bottom">Destinatario</th>
                                            <th style="vertical-align:bottom">E-mail</th>
                                            <th style="vertical-align:bottom">Periodo(s)</th>
    										<th style="vertical-align:bottom">Fecha Envio</th>
                                            <th style="vertical-align:bottom">Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody>
    									@foreach($sendalertpayments as $sendalertpayment)
    									@var $periodos = explode(',',$sendalertpayment->periodos)
    									@var $gestiones = explode(',',$sendalertpayment->gestiones)
    									@var $correos = explode(',',$sendalertpayment->correos)
                                        <tr>
                                            <td>{{ $sendalertpayment->property->nro }}</td>
                                            <td>{{ $sendalertpayment->destinatarios }}</td>
                                            <td>
    											@foreach($correos as $correo)
    												{{$correo}}
    											@endforeach
    										</td>
                                            <td>
    											@for ($i = 0; $i < count($periodos); $i++)
    											 @if($periodos[$i] == 1)
    												{{ 'Enero'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 2)
    												{{ 'Febrero'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 3)
    												{{ 'Marzo'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 4)
    												{{ 'Abril'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 5)
    												{{ 'Mayo'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 6)
    												{{ 'Junio'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 7)
    												{{ 'Julio'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 8)
    												{{ 'Agosto'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 9)
    												{{ 'Septiembre'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 10)
    												{{ 'Octubre'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 11)
    												{{ 'Noviembre'.'/'.$gestiones[$i] }}
    											 @elseif($periodos[$i] == 12)
    												{{ 'Diciembre'.'/'.$gestiones[$i] }}
    											 @endif
    											@endfor
    										</td>
    										<td>
    											{{ $sendalertpayment->fecha_envio}}
    										</td>
    										@if($sendalertpayment->enviado == 1)
        										<td class="text-success" style="width: 120px;">
                                                    <i class="fa fa-lg fa-check-circle"></i>&nbsp;&nbsp;Envío exitoso
                                                </td>
        										@else
                                                <td class="text-danger" style="width: 120px;">
                                                    <i class="fa fa-lg fa-times-circle"></i>&nbsp;&nbsp;Error de envío
                                                </td>
    										@endif
                                        </tr>
    									@endforeach
                                    </tbody>
                                </table>
								<div class="form-group">
									<div class="col-sm-12">
										 <a href="{{ route('transaction.accountsreceivable.send') }}" class="btn btn-success" >Atras</a>
									</div>
								</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>



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
                "info":     false
            });
        } );
    </script>
@endsection

