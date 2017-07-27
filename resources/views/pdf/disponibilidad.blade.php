<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>V-cino</title>
		<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" />
	</head>
	<body>
				<div id="printableArea">
                <div class="ibox-content">
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-10">
                        <div class="table-responsive" style="margin-top: 20px;">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr bgcolor="#D6D6D6">
                                        <th>Cuenta</th>
                                        <th style="text-align:right;">Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
									@for ($i = 0; $i < count($cuentas); $i++)
                                    <tr>
                                        <td>{{$cuentas[$i]['cuenta']}}</td>
                                        <td style="text-align:right;">{{money_format('%i', $cuentas[$i]['ingreso']-$cuentas[$i]['egreso']+$cuentas[$i]['ingreso_trans']-$cuentas[$i]['egreso_trans'])}}</td>
                                    </tr>
									@endfor
                                </tbody>
                                <tfoot>
                                    <th>Total</th>
                                    <th style="text-align:right;">{{money_format('%i', $suma_total)}}</th>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-1">
                    </div>


                </div>
                </div>		
	</body>

</html>



