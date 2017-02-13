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
            <li>
                <a href="#">Lista de gastos</a>
            </li>
            <li class="active">
                <strong>Ver detalle gasto</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Ver detalle gasto</h5>

                </div>
                <div class="ibox-content">


							<div class="alert alert-success alert-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								Transacción registrada correctamente.
							</div>

							<div class="row">
								<div class="table-responsive">
									<table class="table" style="width: 80%; margin: auto; margin-bottom: 10px;">
										<tbody>
											<tr>
												<td style="border: 0;">
													<div class="p-h-xl"><img src="files/logoEmpresa.png" width="150"></div>
												</td>
												<td style="border: 0; vertical-align:bottom">
													<div class="p-h-xl text-right">
														<h2 style="line-height: 0;">RECIBO DE EGRESO</h2>
														<h3 style="line-height: 0; padding-top: 20px;">N&#186;&nbsp;<span>{{ str_pad($expense->transaction->nro_documento, 6, "0", STR_PAD_LEFT)}}</span></h3>
													</div>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-3">
								</div>
								<div class="col-sm-6">
									<div class="hr-line-solid"></div>
								</div>
								<div class="col-sm-3">
								</div>
							</div>

							<div class="row">
								<table style="margin: 10px auto; text-align: left; width: 80%; font-size: 13px;">
									<tr>
										<td>
											<div class="row" style="padding: 0 0 30px 0; line-height: 20px;">
												<div class="col-sm-1" style="width: 80px;">
													<span>Fecha:</span>
													<br/>
													<span>Proveedor:</span>
												</div>
												<div class="col-sm-8">
													<span>{{ date_format(date_create($expense->transaction->fecha_pago),'d/m/Y') }}</span>
													<br/>
													<span style="text-transform: uppercase;"><strong>{{$expense->supplier->razon_social}}</strong></span>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<table cellpadding="0" cellspacing="0" style="width: 100%;">
												<tr>
													<td style="border-top: #333 1px solid; padding: 3px 0;" colspan="2">
														{{$expense->category->description}}: {{$expense->transaction->concepto}}
													</td>
												</tr>
												<tr>
													<td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
														{{$expense->account->tipo_cuenta}} {{$expense->account->nro_cuenta}}
													</td>
												</tr>
												<tr>
													<td style="border-top: #eee 1px solid; padding: 3px 0;" colspan="2">
														Forma de pago: {{$expense->transaction->forma_pago}} No. {{$expense->transaction->numero_forma_pago}}
													</td>
												</tr>

												<tr style="font-size: 14px;">
													<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" class="alignright" width="80%; padding: 5px 0;">Total Bs.</td>
													<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700; text-align: right; padding: 3px 0;">{{$expense->transaction->importe_debito}}</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td style="padding-top: 8px;">
											<h4>SON: {{ numeroaliteral($expense->transaction->importe_debito) }}</h4>
										</td>
									</tr>
								</table>
							</div>

							<div class="row">
								<div class="table-responsive">
									<table style="margin: auto; text-align: left; width: 80%; font-size: 14px; margin-top: 10px;">
										<tr>
											<td>
												<div class="col-sm-3" style="width: 190px; padding-left: 0;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Recibí conforme</span><br/>
													<span style="color: #F2F2F2; font-size: 16px;">_ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
												</div>
												<div class="col-sm-1">
												</div>
											</td>
											<td>
												<div class="col-sm-3" style="width: 190px; padding-left: 0;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Vo. Bo. Tesorero</span><br/>
													<span style="color: #F2F2F2; font-size: 16px;">_ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
												</div>
											</td>
											<td>
												<div class="col-sm-1">
												</div>
												<div class="col-sm-3" style="width: 190px;">
													<div class="hr-line-solid" style="margin-bottom: 1px; border-top: 1px solid #A4A4A4;"></div>
													<span style="font-size: 10px;">Entregue conforme<br>
														Administración</span>
												</div>
											</td>
										</tr>
									</table>
								</div>
							</div>

							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<button class="btn btn-success" type="submit">
											<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir</button>
										<button class="btn btn-default">
											<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Exportar</button>
										<span class="text-muted" style="margin: 0 10px;">|</span>
										<button class="btn btn-default">
											<i class="fa fa-file-o"></i>&nbsp;&nbsp;Nuevo gasto</button>
									</div>
								</div>
							</div>

							<div class="hr-line-dashed"></div>

							<div class="form-group">
								<div class="row">
									<div class="col-sm-12">
										<button class="btn btn-danger" type="submit">
											<i class="fa fa-trash"></i>&nbsp;&nbsp;Anular...</button>
									</div>
								</div>
							</div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection


