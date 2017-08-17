@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Estado de cobranzas</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Estado de cobranzas</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Estado de cobranzas</h5>

                    <div class="ibox-tools" style="padding-bottom: 7px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-default" id="printButton" data-toggle="tooltip" data-placement="bottom" title="Imprimir reporte" data-original-title="Imprimir reporte">
                                <i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir...
                            </button>
                            <a href="{{ route('report.estadocobranzas.excel', $opcion) }}" type="button" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="bottom" title="Exportar reporte a Excel" data-original-title="Exportar reporte a Excel">
                                <i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Exportar...
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content ibox-heading" style="background-color: #ECF7FE">
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Estado de cobranzas</h3>
                    <small style="padding-left:35px;">Gestión: {{$gestion}} - Moneda: Bolivianos</small>
                    <div class="pull-right">
                        <small style="padding-left:41px;">Cobranza correspondiente a: <b>{{nombremes(date('m'))}} {{date('Y')}}</b></small>
                    </div>
                </div>

                <div class="ibox-content">
					<div id="printableArea">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>{{$cuotas}}</h3>
                                </div>
                            </div>
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Propiedad</th>
											@if(date('m')==1 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Ene</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Ene</th>
											@endif
                                            @if(date('m')==2 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Feb</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Feb</th>
											@endif
                                            @if(date('m')==3 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Mar</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Mar</th>
											@endif
                                            @if(date('m')==4 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Abr</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Abr</th>
											@endif
                                            @if(date('m')==5 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">May</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">May</th>
											@endif
                                            @if(date('m')==6 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Jun</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Jun</th>
											@endif
                                            @if(date('m')==7 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Jul</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Jul</th>
											@endif
                                            @if(date('m')==8 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Ago</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Ago</th>
											@endif
                                            @if(date('m')==9 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Sep</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Sep</th>
											@endif
                                            @if(date('m')==10 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Oct</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Oct</th>
											@endif
                                            @if(date('m')==11 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Nov</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Nov</th>
											@endif
                                            @if(date('m')==12 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <i class="fa fa-angle-right fa-fw text-success" aria-hidden="true"></i>
                                                <span class="text-success">Dic</span>
                                                <i class="fa fa-angle-left fa-fw text-success" aria-hidden="true"></i>
                                            </th>
											@else
											<th style="text-align:right;">Dic</th>
											@endif
                                        </tr>
                                    </thead>

                                    <tbody>
										@for ($i = 0; $i < count($propiedades); $i++)
                                        <tr>
                                            <td>{{$propiedades[$i][0]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][1]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][2]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][3]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][4]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][5]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][6]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][7]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][8]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][9]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][10]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][11]}}</td>
                                            <td style="text-align:right;">{{$propiedades[$i][12]}}</td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                            <th>Total</td>
                                            <th style="text-align:right;">{{$total[1]}}</td>
                                            <th style="text-align:right;">{{$total[2]}}</td>
                                            <th style="text-align:right;">{{$total[3]}}</td>
                                            <th style="text-align:right;">{{$total[4]}}</td>
                                            <th style="text-align:right;">{{$total[5]}}</td>
                                            <th style="text-align:right;">{{$total[6]}}</td>
                                            <th style="text-align:right;">{{$total[7]}}</td>
                                            <th style="text-align:right;">{{$total[8]}}</td>
                                            <th style="text-align:right;">{{$total[9]}}</td>
                                            <th style="text-align:right;">{{$total[10]}}</td>
                                            <th style="text-align:right;">{{$total[11]}}</td>
                                            <th style="text-align:right;">{{$total[12]}}</td>
                                    </tfoot>
                                </table>
                            </div>
                            <h5 style="font-weight: normal; color: #B8B8B8;">* Monto parcial cancelado.</h5>
                        </div>
                    </div>
                                        
                   

                </div>
					 <div class="row">
                        <div class="col-sm-12">
                            <div class="hr-line-dashed"></div>

                            <div class="form-group text-left">
                                <a href="{{ route('report.estadocobranzas') }}" class="btn btn-success" type="submit">Volver</a>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
 <link rel="stylesheet" href="{{ URL::asset('css/varios.css') }}" media="print"/>
@endsection


@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script>
    $(document).ready(function () {

        $("#printButton").click(function () {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {mode: mode, popClose: close};
            $("#printableArea").printArea(options);
        });
    });
</script>
@endsection



