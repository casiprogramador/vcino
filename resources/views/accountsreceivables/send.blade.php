@extends('layouts.admin')

@section('admin-content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Avisos de cobranza</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
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

            <div class="ibox">
				@if (Session::has('message'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {!! session('message') !!}
                    </div>
                @endif

                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Avisos de cobranza</h5>
					<div class="ibox-tools" style="padding-bottom: 7px;">
                            <a href="{{ route('transaction.accountsreceivable.generatenotification') }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Nuevo aviso de cobranza para cada propiedad" data-original-title="Nuevo aviso de cobranza para cada propiedad" style="margin-right: 5px; color: white;">Nuevo aviso de cobranza</a>

                            <a href="{{ route('transaction.accountsreceivable.registernotification') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Ver registro de envíos de avisos de cobranza" data-original-title="Ver registro de envíos de avisos de cobranza" style="margin-right: 5px;"> Registro de envíos </a>
                    </div>
                </div>

                <div class="ibox-content">

					<div class="row">
						<div class="col-sm-12">
							
                            {!! Form::open(array('route' => 'transaction.accountsreceivable.sendnotification','id'=>'form-send-alertpayment')) !!}
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align:bottom; text-align: center;" width="50">
                                                <input type="checkbox" checked="" id="check-all">
                                            </th>
                                            <th style="vertical-align:bottom">Propiedad</th>
                                            <th style="vertical-align:bottom">Periodo/Gestión</th>
                                            <th style="vertical-align:bottom; text-align: right;">Importe total</th>
                                            <th style="vertical-align:bottom" width="50"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

										@foreach($sendalertpayments as $sendalertpayment)
										@var $periodos = explode(',',$sendalertpayment->periodos)
										@var $gestiones = explode(',',$sendalertpayment->gestiones)
                                        <tr>
                                            <td style="vertical-align:middle; text-align: center;">
												<input type="checkbox" class="i-checks check-submit" name="sendalertpayment[]" value="{{$sendalertpayment->id}}" checked>
                                            </td>
                                            <td style="vertical-align:middle;">{{ $sendalertpayment->property->nro }}</td>
                                            <td style="vertical-align:middle;">
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
											<td style="vertical-align:middle; text-align: right; padding-right: 30px;">{{ $sendalertpayment->importe_total }}</td>
                                            <td style="vertical-align:middle; text-align: center;">
                                                <div class="btn-group">
                                                    <a href="{{ route('transaction.accountsreceivable.print', $sendalertpayment->id) }}" class="btn btn-success btn-xs btn-outline" data-toggle="tooltip" data-placement="bottom" title="Ver aviso de cobranza" style="margin-bottom: 0px;">
														<i class="fa fa-eye"></i>
													</a>
                                                </div>
											</td>
                                        </tr>
											
										@endforeach
                                    </tbody>
                                </table>

								<div class="hr-line-dashed"></div>

								<div class="form-group">
									<button name="submit" class="btn btn-success" type="submit" value="enviar" style="margin-right: 10px;"><i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Enviar seleccionados</button>
									<button name="submit"class="btn btn-success"type="submit" value="imprimir" ><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir seleccionados</button>
									<span class="text-muted" style="margin: 0 10px;">|</span>
									<button name="submit" class="btn btn-danger" type="submit" value="borrar"><i class="fa fa-trash"></i>&nbsp;&nbsp;Eliminar seleccionados</button>
								</div>
							
							</div>
                            {!! Form::close() !!}

							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<label class="col-sm-2 control-label">Proceso de envío</label>
								<div class="col-sm-9" style="margin-top: 5px">
									<div class="progress">
										<div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-success">&nbsp;&nbsp;<span id="progress-text">0% Completado</span>
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
                    "sZeroRecords":    "No se encontraron resultados.",
                    "sEmptyTable":     "No se encontraron Avisos de cobranza.",
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
                "columnDefs": [ { "orderable": false, "targets": 0 }, { "orderable": false, "targets": 4 } ]
            });
        } );
    </script>
    <script>
        $(document).ready(function () {
			$('#check-all').change(function() {
				if ($('#check-all').is(':checked')) {
					
					console.log("checked");
					$('.check-submit').prop( "checked", true );
				}else{
					console.log("NO checked");
					$('.check-submit').prop( "checked", false );
				}
			});

			$( "#form-send-alertpayment" ).on("click", ":submit", function(e){
				
				var value_submit = $( this ).val();
				console.log(value_submit);
				if(value_submit == "enviar"){
					var value = 0;

					function barAnim(){
						value += 5;
						$( ".progress-bar" ).css( "width", value + "%" ).attr( "aria-valuenow", value );
						$("#progress-text").text(value + "% Completado");
						if ( value == 25 || value == 55 || value == 85 ) { 
							return setTimeout(barAnim, 1000); 
						}
						return value >= 100 || setTimeout(barAnim, 50);
					}

					setTimeout(barAnim, 50);
				}
				
				$( "#form-send-communication" ).submit();
				//e.preventDefault();
			 });
        });
    </script>
@endsection

