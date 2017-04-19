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
		<div class="row">
			<div class="table-responsive">
			<img src="{{ URL::asset(Auth::user()->company->logotipo)}}">
			<h1 style="text-align: center;">COMUNICADO</h1>
			<h2 style="text-align: center;"> Asunto:{{$communication->asunto}}</h2>
			</div>
		</div>

		</div>
		<h3 style="text-align: center;">{{ $cuerpo_remitente }}</h3>
		<div><?php echo $comunicado_cuerpo ?></div>
		
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
			<div class="text-center">
				<h6 style="text-align: center;">&copy; 2016 V-CINO. Todos los derechos reservados.</h6>
			</div>
	
			<div class="text-center">
			<h6 style="text-align: center;">F.P. 2016-09-29 15:58:34</h6>
			</div>
		</div>

	</body>

</html>