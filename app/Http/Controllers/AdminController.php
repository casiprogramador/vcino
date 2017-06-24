<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Collection;
use App\Accountsreceivable;
use App\Transaction;
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

		$mes_actual = date('m');
		
		$mes_actual = 6;
		
		$mes_anterior = ($mes_actual == 1) ? 12 : $mes_actual-1;
		
		$mes_anterior_anterior = ($mes_anterior == 1) ? 12 : $mes_anterior -1;
		$anio_actual = date('Y');
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
        return view('admin')
			->with('transacciones',$transacciones)
			->with('importe_pagado_actual',$cuotas_pagadas_actual['importe_pagado'])
			->with('importe_pagado_total',$cuotas_pagadas_actual['importe_total'])
			->with('importe_pagado_anterior',$cuotas_pagadas_anterior['importe_pagado'])
			->with('importe_pagado_total_anterior',$cuotas_pagadas_anterior['importe_total'])
			->with('importe_pagado_promedio',$importe_promedio)
			->with('importe_pagado_promedio_total',$importe_promedio_total)
			->with('gastos_torta_importe',json_encode($gastos_torta['importes']))
			->with('gastos_torta_nombre',json_encode($gastos_torta['nombres']))
			->with('gastos_torta_color',json_encode($gastos_torta['colores']))
			->with('mes_actual',$mes_actual)
			->with('mes_anterior',$mes_anterior)
			->with('cobranzas_mes_actual',json_encode($cobranzas['cobranza_mes_actual']))
			->with('cobranza_mes_anterior',json_encode($cobranzas['cobranza_mes_anterior']));
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
		
		//$mes = 5;
    	//$anio = 2017;
		
		$array_colores = ["#ACDAFE", "#90AABF", "#3876A5", "#C1E4FF", "#D1EBFF", "#FFE9A7", "#BFB38E", "#A68A36", "#FFEEBD", "#FFF3CF", "#FFC0A7", "#BF9C8E", "#A65636", "#FFD0BD", "#FFDCCF"];
		
		$egresos = DB::table('expenses')
			->select('categories.nombre as categoria','transactions.importe_debito as importe')
			->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
			->join('categories', 'categories.id', '=', 'expenses.category_id')
			->where('transactions.anulada',0)
			->where('expenses.company_id',$company->id)
			->where('transactions.excluir_reportes',0);

		$egresos->whereMonth('transactions.fecha_pago', '=', $mes);
		$egresos->whereYear('transactions.fecha_pago', '=', $anio);
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
		
		return array('nombres'=>$array_nombre_gastos,'importes'=>$array_importe_gastos,'colores'=>$array_color_gastos);
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
}
