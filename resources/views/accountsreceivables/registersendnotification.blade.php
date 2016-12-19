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
                <strong>Avisos enviados</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
					<div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('communication.communication.create') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="generar Avisos" style="margin-right: 10px;"> Generar aviso de pago </a>

                            <a href="{{ route('communication.register.send') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de comunicados" data-original-title="Ver registro de envíos de comunicados"> Registro de avisos enviados </a>
                    </div>
                </div>

                <div class="ibox-content">
                    

                    <!--    INFORME DE ENVIO        -->
                    <div class="row">
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-10">
                            <h4 style="padding-bottom: 10px;">Informe de envío</h4>
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
                                            <td class="col-md-1">{{ $sendalertpayment->property->nro }}</td>
                                            <td class="col-md-2">{{ $sendalertpayment->destinatarios }}</td>
                                            <td class="col-md-2">
												@foreach($correos as $correo)
													{{$correo}}
												@endforeach
											</td>
                                            <td class="col-md-2">
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
											<td class="col-md-2">
												{{ $sendalertpayment->fecha_envio}}
											</td>
											@if($sendalertpayment->enviado == 1)
											<td class="text-success col-md-2">
                                                <i class="fa fa-lg fa-check-circle"></i>&nbsp;&nbsp;Envío exitoso
                                            </td>
											@else
                                            <td class="text-danger col-md-2">
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