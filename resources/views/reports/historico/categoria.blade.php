@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading migaspan">
    <div class="col-lg-10">
        <h2>Histórico de transacciones</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Histórico de transacciones</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">


    <!--	**********************	-->
    <!--		  CATEGORIAS		-->
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Histórico de transacciones</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                           <button type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte" onClick="window.print()">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.historicotransacciones.categorias.excel', $mes.'_'.$anio.'_'.$categoria->id) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Histórico de transacciones - Categorías</h3>
                    @if($mes != 0)
                    <small style="padding-left:36px;">Periodo: {{nombremes($mes)}}/{{$anio}} - Moneda: Bolivianos</small>
                    @else
                    <small style="padding-left:36px;">Gestion: {{$anio}} - Moneda: Bolivianos</small>
                    @endif
                </div>

                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">

                    	<div class="row">
	                    	<div class="col-sm-9">
	                    		<h3>Categoría: {{$categoria->nombre}}</h3>
	                    	</div>
	                    	<div class="col-sm-3">
	                    		<h3 class="text-right"><small>Fecha reporte: {{ date('d/m/Y') }}</small></h3>
	                    	</div>
	                    </div>

                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th style="vertical-align:bottom">Fecha</th>
                                        <th style="vertical-align:bottom">Documento</th>
                                        <th style="vertical-align:bottom">Proveedor</th>
                                        <th style="vertical-align:bottom">Concepto</th>
                                        <th style="vertical-align:bottom">Cuenta</th>
                                        <th style="vertical-align:bottom">Forma de pago</th>
                                        <th style="text-align:right; vertical-align:bottom">Importe</th>
                                    </tr>
                                </thead>

                                <tbody>
									@for ($i = 0; $i < count($datos); $i++)
									<tr>
										<td>{{$datos[$i][0]}}</td>
										<td>{{$datos[$i][1]}}</td>
										<td>{{$datos[$i][2]}}</td>
										<td>{{$datos[$i][3]}}</td>
										<td>{{$datos[$i][4]}}</td>
										<td>{{$datos[$i][5]}}</td>
										<td style="text-align:right;">{{$datos[$i][6]}}</td>
									</tr>
									@endfor
                                <tfoot>
									<th colspan="6">Total</th>
									<th style="text-align:right;">{{$monto}}</th>
                                </tfoot>
                            </table>
                        </div>


                    </div>
                    <div class="col-sm-1">
                    </div>

                    <div class="row sec-volver">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                 <a href="{{ route('report.historicotransacciones') }}" class="btn btn-success" type="submit">Volver</a>
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
    <link rel="stylesheet" href="{{ URL::asset('css/varios.css') }}" media="print"/>
@endsection
