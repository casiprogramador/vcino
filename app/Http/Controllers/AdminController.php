<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Collection;
use App\Accountsreceivable;
use App\Transaction;
use App\Task;
use App\MaintenancePlan;
use Illuminate\Support\Facades\DB;
use Redis;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;
        //Redis::set('user', 'Taylor');
        Session::set('company_name', $company->nombre);
		//dd(date('d'));
		$cobranzas = $this->cobranzas_barras();
		$gastos_torta = $this->gastos_torta();
		//Definimos el mes y el anio actual y lo cambiamos si es prepago o pospago
		$mes_actual = date('m');
		$anio_actual = date('Y');
		if($company->pago == 'prepago' ){
			$mes_actual = date('m');
		}else{
			$mes_actual = ($mes_actual == 1) ? 12 : $mes_actual-1;
		}
		
		//obtenermos las cuotas por cobrar para el box
		$cuotas_cobrar_box = $this->cuotas_cobrar($mes_actual,$anio_actual);
		//Obtenermos los ingresos para el box
		$ingresos_box = $this->ingresos($mes_actual,$anio_actual);	
		//Obtenemos los gastos para el box
		$gastos_box = $this->gastos($mes_actual,$anio_actual);		
		
		$mes_anterior = ($mes_actual == 1) ? 12 : $mes_actual-1;
		
		$mes_anterior_anterior = ($mes_anterior == 1) ? 12 : $mes_anterior -1;

		$anio_anterior = ($mes_actual == 1) ? date('Y')-1 : date('Y');
		$anio_anterior_anterior = ($mes_anterior == 1 || $mes_anterior == 12) ? date('Y')-1 : date('Y');
		
		$cuotas_pagadas_actual = $this->cuotas_pagadas($mes_actual,$anio_actual);
		$cuotas_pagadas_anterior = $this->cuotas_pagadas($mes_anterior,$anio_anterior);
		$cuotas_pagadas_anterior_anterior = $this->cuotas_pagadas($mes_anterior_anterior,$anio_anterior_anterior);
		//Promedio de las tres ultimas cuotas por pagar
		$importe_promedio = ($cuotas_pagadas_actual['importe_pagado']+$cuotas_pagadas_anterior['importe_pagado']+$cuotas_pagadas_anterior_anterior['importe_pagado'])/3 ;
		$importe_promedio_total = ($cuotas_pagadas_actual['importe_total']+$cuotas_pagadas_anterior['importe_total']+$cuotas_pagadas_anterior_anterior['importe_total'])/3 ;
		//Ultimas transacciones
		$transacciones = $this->ultimas_transacciones();
		//dd($importe_promedio/$importe_promedio_total*100);

		$tasks = Task::where('company_id',$company->id )->where('estado_solicitud','<>','completada' )->orderBy('fecha', 'desc')->limit(3);

		$maintenances = MaintenancePlan::where('company_id',$company->id )
			->where('id', '<>', 'maintenance_plans_records.maintenance_plan_id')
			->orderBy('fecha_estimada', 'asc')
			->limit(3);
		$maintenances_count = $maintenances->get()->count();
		$tasks_count = $tasks->get()->count();

        return view('admin')
			->with('transacciones',$transacciones)
			->with('importe_pagado_actual',$cuotas_pagadas_actual['importe_pagado'])
			->with('importe_pagado_total',$cuotas_pagadas_actual['importe_total'])
			->with('importe_pagado_anterior',$cuotas_pagadas_anterior['importe_pagado'])
			->with('importe_pagado_total_anterior',$cuotas_pagadas_anterior['importe_total'])
			->with('importe_pagado_promedio',$importe_promedio)
			->with('importe_pagado_promedio_total',$importe_promedio_total)
			// Datos torta
			->with('gastos_torta_importe',json_encode($gastos_torta['importes']))
			->with('gastos_torta_nombre',json_encode($gastos_torta['nombres']))
			->with('gastos_torta_color',json_encode($gastos_torta['colores']))
			// Datos Box
			->with('cuotas_cobrar_box',$cuotas_cobrar_box)
			->with('ingresos_box',$ingresos_box)
			->with('gastos_box',$gastos_box)
				
			->with('mes_actual',$mes_actual)
			->with('mes_anterior',$mes_anterior)
			->with('cobranzas_mes_actual',json_encode($cobranzas['cobranza_mes_actual']))
			->with('cobranza_mes_anterior',json_encode($cobranzas['cobranza_mes_anterior']))
			->with('maintenances',$maintenances->get())
			->with('tasks',$tasks->get())
			->with('maintenances_count', $maintenances_count)
			->with('tasks_count', $tasks_count);		
    }
	
	public function cobranzas_barras(){
		$company = Auth::user()->company;
		$dia = date('d');
		$mes = date('m');
    	$anio = date('Y');
		$array_mes_cobranzas_actual = array();
		
		for ($index = 1; $index <= 31; $index++) {
			$dia = str_pad($index, 1, "0", STR_PAD_LEFT);
			$fecha_actual = $anio.'-'.$mes.'-'.$dia;
			//$fecha_actual = '2017-05-09';
			$cobranzas =DB::table('collections')
				->select('transactions.importe_credito as importe')
				->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
				->where('transactions.anulada',0)
				->where('collections.company_id',$company->id)
				->where('transactions.excluir_reportes',0)
				->where('transactions.fecha_pago', '=', $fecha_actual)
				->sum('importe_credito');

			$importe = (is_null($cobranzas)) ? 0 : $cobranzas;
			array_push($array_mes_cobranzas_actual, $importe);
		}
		
		$mes_anterior = (date('m') == 1) ? 12 : date('m')-1;
		$array_mes_cobranzas_anterior = array();
		for ($index = 1; $index <= 31; $index++) {
			$dia = str_pad($index, 1, "0", STR_PAD_LEFT);
			
			$fecha_actual = $anio.'-'.$mes_anterior.'-'.$dia;
			//$fecha_actual = '2017-05-09';
			$cobranzas =DB::table('collections')
				->select('transactions.importe_credito as importe')
				->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
				->where('transactions.anulada',0)
				->where('collections.company_id',$company->id)
				->where('transactions.excluir_reportes',0)
				->where('transactions.fecha_pago', '=', $fecha_actual)
				->sum('importe_credito');

			$importe = (is_null($cobranzas)) ? 0 : $cobranzas;
			array_push($array_mes_cobranzas_anterior, $importe);
		}
		
		return array('cobranza_mes_actual'=>$array_mes_cobranzas_actual,'cobranza_mes_anterior'=>$array_mes_cobranzas_anterior);
		
	}
	
	function gastos_torta(){
		$company = Auth::user()->company;
		$mes = date('m');
    	$anio = date('Y');
		
		$array_colores = [	"#4E5B6C","#91A5BC","#D1DAE3",
							"#E06F27","#EDB527","#F6D58F",
							"#1A7CC0","#90BFE1","#CCE2F1",
							"#32BFCE","#ABEEEA","#DDF8F7",
							"#FBEEC0"];

		$egresos = DB::table('expenses')
			->select('categories.nombre as categoria','transactions.importe_debito as importe')
			->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
			->join('categories', 'categories.id', '=', 'expenses.category_id')
			->where('transactions.anulada',0)
			->where('expenses.company_id',$company->id)
			->where('transactions.excluir_reportes',0);
			
		$egresos->whereMonth('transactions.fecha_pago', '=', $mes);
		$egresos->whereYear('transactions.fecha_pago', '=', $anio);
        $egresos->groupBy('categories.nombre');
		$egresos->sum('transactions.importe_debito');
		$resultado = $egresos->get();
		//dd($resultado);
		$array_nombre_gastos = array();
		$array_importe_gastos = array();
		$array_color_gastos = array();
		

		foreach ($resultado as $gasto) {
			array_push($array_nombre_gastos, $gasto->categoria);
			array_push($array_importe_gastos, $gasto->importe);
			//Color aleatorio
			$color = array_rand($array_colores,1);
			array_push($array_color_gastos, $array_colores[$color]);		
		}
		
		return array('nombres'=>$array_nombre_gastos,'importes'=>$array_importe_gastos,'colores'=>$array_colores);
	}
	
	function cuotas_pagadas($mes,$anio){
		$company = Auth::user()->company;
        $accountsreceivables = Accountsreceivable::where('company_id',$company->id )
				->where('gestion',$anio)
				->where('periodo',$mes)
				->where('cancelada',1)
				->sum('importe_por_cobrar');
		$importe_pagado= (is_null($accountsreceivables)) ? 0 : $accountsreceivables;
		
		$accountsreceivables = Accountsreceivable::where('company_id',$company->id )
				->where('gestion',$anio)
				->where('periodo',$mes)
				->sum('importe_por_cobrar');
		$importe_total= (is_null($accountsreceivables)) ? 0 : $accountsreceivables;

		
		return array('importe_pagado'=>$importe_pagado,'importe_total'=>$importe_total);
	}
	
	function ultimas_transacciones(){
		$transactions = Transaction::where('user_id',Auth::user()->id )
				->where('tipo_transaccion', '!=' , 'Traspaso-Egreso')
				->orderBy('fecha_pago', 'desc')
				->limit(5)
				->get();
		$resultado = array();
		foreach ($transactions as $transaction) {
			$fecha = date_format(date_create($transaction->fecha_pago),'d/m/Y');
			$tipo = ($transaction->tipo_transaccion == 'Traspaso-Ingreso') ? 'Traspaso' : $transaction->tipo_transaccion;
			if($transaction->tipo_transaccion == 'Ingreso'){
				$beneficiario = $transaction->collection->property->nro;
				$importe = $transaction->importe_credito;

			}elseif ($transaction->tipo_transaccion == 'Egreso') {
				$beneficiario = $transaction->expense->supplier->razon_social;
				$importe = $transaction->importe_debito;
			}else{
				$beneficiario = '';
				$importe = $transaction->importe_credito;
			}
			$nro_documento = str_pad($transaction->nro_documento, 6, "0", STR_PAD_LEFT);
			$transaccion = array($fecha,$nro_documento,$tipo,$beneficiario,$transaction->concepto,$importe);
			array_push($resultado, $transaccion);
		}
		
		return $resultado;
	}
	/*
	 * Funciones para las cajas superiores de cuotas por cobrar, ingresos y gastos
	 */
	
	function cuotas_cobrar($mes,$anio){
		$company = Auth::user()->company;
		$date_gestion_periodo = new \DateTime($anio.'-'.$mes.'-'.'02');
		
		$totalCuotasCobrar = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('fecha_gestion_periodo','<=',$date_gestion_periodo)
					->sum('importe_por_cobrar');
		
		$mesCuotasCobrar = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('gestion','<=',$anio)
					->where('periodo','<=',$mes)
					->sum('importe_por_cobrar');
		
		$resultado = [
			'mes_cobrar'=>$mesCuotasCobrar,
			'total_cobrar'=>$totalCuotasCobrar
		];
		
		return $resultado;
	}
	
	function ingresos($mes,$anio){
		$company = Auth::user()->company;
		$date_gestion_periodo = new \DateTime($anio.'-'.$mes.'-'.'02');
		
		$ingresoMesActual =  Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',1)
					->where('gestion','<=',$anio)
					->where('periodo','<=',$mes)
					->sum('importe_por_cobrar');
		
		$mes_anterior = ($mes == 1) ? 12 : $mes-1;
		$anio_anterior = ($mes == 1) ? $anio-1 : $anio;
		
		
		$ingresoMesAnterior =  Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',1)
					->where('gestion','<=',$anio_anterior)
					->where('periodo','<=',$mes_anterior)
					->sum('importe_por_cobrar');
		
		
		$resultado = [
			'mes_actual_ingreso'=>$ingresoMesActual,
			'mes_anterior_ingreso'=>$ingresoMesAnterior
		];
		
		return $resultado;
	}
	
	function gastos($mes,$anio){
		 $gastos_actual = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->whereMonth('fecha_pago', '=', $mes)
					->whereYear('fecha_pago', '=', $anio)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
					->sum('importe_debito');
		 
		$mes_anterior = ($mes == 1) ? 12 : $mes-1;
		$anio_anterior = ($mes == 1) ? $anio-1 : $anio;

		$gastos_anterior = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->whereMonth('fecha_pago', '=', $mes_anterior)
					->whereYear('fecha_pago', '=', $anio_anterior)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
					->sum('importe_debito');
		$resultado = [
			'mes_actual_gastos'=>$gastos_actual,
			'mes_anterior_gastos'=>$gastos_anterior
		];
		
		return $resultado;
	}
	
	
	
}
