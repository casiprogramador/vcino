@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Cobranzas por periodo y gestión</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('admin.home') }}">Inicio</a>
            </li>
            <li>
                Reportes
            </li>
            <li class="active">
                <strong>Cobranzas por periodo y gestión</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5 style="padding-top: 7px;">Cobranzas por periodo y gestión</h5>

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
                    <h3><i class="fa fa-table">&nbsp;&nbsp;</i>Cobranzas por periodo y gestión</h3>
                    <small style="padding-left:35px;">Gestión: {{$gestion}} - Moneda: Bolivianos</small>
                    <div class="pull-right">
                        <small style="padding-left:41px;">Cobranza correspondiente a: <b>{{nombremes($mes)}} {{date('Y')}}</b></small>
                    </div>
                </div>

                <div class="ibox-content">
					<div id="printableArea">

                        <!-- Título del Reportes    -->
                        <div class="titreporte" style="display: none;">
                            <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td style="border: 0; padding-left: 0;">
                                            <div class="p-h-xl"><img src="{{ URL::asset(Auth::user()->company->logotipo) }}" width="{{Auth::user()->company->width_logo}}"></div>
                                        </td>
                                        <td style="border: 0; vertical-align:bottom; padding-right: 0;">
                                            <div class="p-h-xl text-right">
                                                <h3>Cobranzas por periodo y gestión</h3>
                                                <p style="font-size: 10px;">Gestión: {{$gestion}} - Moneda: Bolivianos</br>
                                                Cobranza correspondiente a: <b>{{nombremes($mes)}} {{date('Y')}}</b></p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>


                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Cuota(s): {{$cuotas}}</h4>
                                </div>
                            </div>
                            <div class="table-responsive" style="margin-top: 20px;">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr bgcolor="#D6D6D6">
                                            <th>Propiedad</th>
											@if($mes==1 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Ene</span>
                                            </th>
											@else
    											<th style="text-align:right;">Ene</th>
											@endif
                                            @if($mes==2 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Feb</span>
                                            </th>
											@else
											<th style="text-align:right;">Feb</th>
											@endif
                                            @if($mes==3 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Mar</span>
                                            </th>
											@else
											<th style="text-align:right;">Mar</th>
											@endif
                                            @if($mes==4 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Abr</span>
                                            </th>
											@else
											<th style="text-align:right;">Abr</th>
											@endif
                                            @if($mes==5 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">May</span>
                                            </th>
											@else
											<th style="text-align:right;">May</th>
											@endif
                                            @if($mes==6 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Jun</span>
                                            </th>
											@else
											<th style="text-align:right;">Jun</th>
											@endif
                                            @if($mes==7 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Jul</span>
                                            </th>
											@else
											<th style="text-align:right;">Jul</th>
											@endif
                                            @if($mes==8 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Ago</span>
                                            </th>
											@else
											<th style="text-align:right;">Ago</th>
											@endif
                                            @if($mes==9 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Sep</span>
                                            </th>
											@else
											<th style="text-align:right;">Sep</th>
											@endif
                                            @if($mes==10 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Oct</span>
                                            </th>
											@else
											<th style="text-align:right;">Oct</th>
											@endif
                                            @if($mes==11 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Nov</span>
                                            </th>
											@else
											<th style="text-align:right;">Nov</th>
											@endif
                                            @if($mes==12 && date('Y')==$gestion)
                                            <th style="text-align:right;">
                                                <span class="text-success">Dic</span>
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
											
                                            @if($mes==1 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][1],'*') === false )
													{{ $propiedades[$i][1] > 0 ? number_format($propiedades[$i][1], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][1]), 2, ',', '.')}}*
												@endif
											</td>
											
                                            @if($mes==2 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][2],'*') === false )
													{{ $propiedades[$i][2] > 0 ? number_format($propiedades[$i][2], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][2]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==3 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][3],'*') === false )
													{{ $propiedades[$i][3] > 0 ? number_format($propiedades[$i][3], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][3]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==4 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][4],'*') === false )
													{{ $propiedades[$i][4] > 0 ? number_format($propiedades[$i][4], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][4]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==5 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][5],'*') === false )
													{{ $propiedades[$i][5] > 0 ? number_format($propiedades[$i][5], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][5]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==6 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][6],'*') === false )
													{{ $propiedades[$i][6] > 0 ? number_format($propiedades[$i][6], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][6]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==7 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][7],'*') === false )
													{{ $propiedades[$i][7] > 0 ? number_format($propiedades[$i][7], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][7]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==8 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][8],'*') === false )
													{{ $propiedades[$i][8] > 0 ? number_format($propiedades[$i][8], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][8]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==9 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][9],'*') === false )
													{{ $propiedades[$i][9] > 0 ? number_format($propiedades[$i][9], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][9]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==10 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][10],'*') === false )
													{{ $propiedades[$i][10] > 0 ? number_format($propiedades[$i][10], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][10]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==11 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][11],'*') === false )
													{{ $propiedades[$i][11] > 0 ? number_format($propiedades[$i][11], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][11]), 2, ',', '.')}}*
												@endif
											</td>

                                            @if($mes==12 && date('Y')==$gestion)
                                                <td style="text-align:right; font-weight: bold; color: #383838;" >
                                            @else
                                                <td style="text-align:right;">
                                            @endif
												@if(strpos($propiedades[$i][12],'*') === false )
													{{ $propiedades[$i][12] > 0 ? number_format($propiedades[$i][12], 2, ',', '.') : " - " }}
												@else
													
													{{number_format(str_replace('*','',$propiedades[$i][12]), 2, ',', '.')}}*
												@endif
											</td>
                                        </tr>
                                        @endfor
                                    </tbody>
                                    <tfoot>
                                            <th>Total</td>
                                            <th style="text-align:right;">
												{{number_format($total[1], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[2], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[3], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[4], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[5], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[6], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[7], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[8], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[9], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[10], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[11], 2, ',', '.')}}
											</td>
                                            <th style="text-align:right;">
												{{number_format($total[12], 2, ',', '.')}}
											</td>
                                    </tfoot>
                                </table>
                            </div>
                            <h5 style="font-weight: normal; color: #B8B8B8;">* Sin cancelar o parcialmente cancelado.</h5>
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
    <link rel="stylesheet" href="{{ URL::asset('css/varios.css') }}" media="print"/>
    <link rel="stylesheet" href="{{ URL::asset('css/horizontal.css') }}" media="print"/>
@endsection

@section('javascript')
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

