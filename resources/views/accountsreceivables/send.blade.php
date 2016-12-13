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
                <strong>Avisos de cobranza</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5 style="padding-top: 2px;">Enviar aviso de cobranza</h5>
					<div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('transaction.accountsreceivable.generatenotification') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Nuevo comunicado" data-original-title="generar Avisos" style="margin-right: 10px;"> Generar aviso de pago </a>

                            <a href="{{ route('communication.register.send') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de comunicados" data-original-title="Ver registro de envíos de comunicados"> Registro de avisos enviados </a>
                    </div>
                </div>

                <div class="ibox-content">


                    <!--        LISTA DE DISTRIBUCIÓN QUE SE GENERA CON TODAS LAS PROPIEDADES EN MORA       -->
                    <div class="row">

						<div class="col-sm-12">
							 <div class="form-group">
                                <label class="col-sm-3 control-label" style="text-align: left;">Propiedad: <span style="font-weight: normal;">Todas</span></label>
                                <label class="col-sm-3 control-label" style="text-align: left;">Vencimiento: <span style="font-weight: normal;">Octubre</span></label>
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							
                            <div class="table-responsive">
								{!! Form::open(['route' => 'transaction.accountsreceivable.sendnotification']) !!}
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom; text-align: center;" width="50">
                                                <input type="checkbox" checked="">
                                            </th>
                                            <th style="vertical-align:bottom">Propiedad</th>
                                            <th style="vertical-align:bottom">Periodo/Gestion</th>
                                            <th style="vertical-align:bottom; text-align: right;">Importe total</th>
                                            <th style="vertical-align:bottom" width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

										@foreach($sendalertpayments as $sendalertpayment)
										@var $periodos = explode(',',$sendalertpayment->periodos)
										@var $gestiones = explode(',',$sendalertpayment->gestiones)
                                        <tr>
                                            <td style="text-align: center;">
												<input type="checkbox" class="i-checks" name="propiedades[]" value="{{$sendalertpayment->id}}" checked>
                                            </td>
                                            <td>{{ $sendalertpayment->property->nro }}</td>
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
                                            <td style="text-align: right;">{{ $sendalertpayment->importe_total }}</td>
                                            <td style="text-align:right;">
                                                <div class="btn-group">
                                                    <a href="{{ route('transaction.accountsreceivable.print', $sendalertpayment->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver aviso" style="margin-bottom: 0px;">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </div>
                                           </td>
                                        </tr>

											
										@endforeach
                                    </tbody>
                                </table>
								<div class="col-sm-12">
									<button class="btn btn-success" type="submit"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar</button>
									<button class="btn btn-success" ><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
								</div>
								{!! Form::close() !!}
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
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection