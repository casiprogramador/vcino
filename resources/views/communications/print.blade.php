@extends('layouts.admin')

@section('admin-content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Imprimir comunicado</h2>
        <ol class="breadcrumb">
            <li>
                <a href="#/">Inicio</a>
            </li>
            <li>
                Comunicación & Información
            </li>
            <li>
                Comunicados
            </li>
            <li class="active">
                <strong>Imprimir comunicado</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <button id="printButton" class="btn btn-success">
            <i class="fa fa-print">&nbsp;&nbsp;&nbsp;</i>Imprimir comunicado</button>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox float-e-margins">
                <div class="ibox-content p-xl" id="printableArea">
                    <div class="row">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="border: 0;">
                                        <div class="p-h-xl"><img src="files/logoEmpresa.png" width="150"></div>
                                    </td>
                                    <td style="border: 0; vertical-align:bottom">
                                        <div class="p-h-xl text-right">
                                            <h2 style="line-height: 0;">COMUNICADO</h2>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row" style="padding: 0 0 20px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-1">
                            Fecha:
                            <br/>
                            De:
                        </div>
                        <div class="col-sm-5">
                            <span style="margin-left: -15px;">{{ date_format(date_create($communication->fecha),'d/m/Y') }}</span>
                            <br/>
                            <span style="margin-left: -15px;"></span>
                        </div>
                        <div class="col-sm-1">
                            <br/>
                            Para:
                        </div>
                        <div class="col-sm-5">
                            <br/>
                            <span style="margin-left: -15px;"></span>
                        </div>
                    </div>

                    <div class="row" style="padding: 15px 0 30px 0;">
                        <div class="col-sm-1">
                            Asunto:
                        </div>
                        <div class="col-sm-11">
                            <span style="margin-left: -15px;"><strong>{{$communication->asunto}}</strong></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            
                            <?php echo $communication->cuerpo ?>
                    
                        </div>
                    </div>

                    <div class="row" style="padding: 20px 0;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6">
                            <div class="hr-line-solid"></div>
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <h6>&copy; 2016 V-CINO. Todos los derechos reservados.</h6>
                        </div>
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3 text-right">
                        <h6>F.P. 2016-09-29 15:58:34</h6>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript" src="{{ URL::asset('js/jquery.PrintArea.js') }}"></script>
<script>
	$(document).ready(function () {
		$("#printButton").click(function(){
			var mode = 'iframe'; //popup
			var close = mode == "popup";
			var options = { mode : mode, popClose : close};
			$("#printableArea").printArea( options );
		});
	});
</script>
@endsection