<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Gestion;
use App\Collection;
use App\Accountsreceivable;
use App\Http\Requests;

class ReportEstadoPagosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
	}
	
    function estadopagos(){
		$company = Auth::user()->company;
		$gestiones = Gestion::lists('nombre','nombre')->all();
	
		return view('reports.estadopagos')
				->with('gestiones',$gestiones);
	}
	
	function estadopagos_show(Request $request){
		$mes = $request->mes;
		$anio = $request->anio;
		$arr_estado_pagos = $this->estadopagos_array($mes,$anio);
		return view('reports.estadopagos_show')
			->with('mes',$mes)
			->with('anio',$anio)
			->with('estado_pagos',$arr_estado_pagos);
	}
	
	function estadopagos_array($periodo,$gestion){
		$pagos_vigentes = $this->pagosVigentes($periodo,$gestion);
		$pagos_total = $this->pagosTotal($periodo,$gestion);
		$pagos_atrasados = $this->pagosAtrasados($periodo,$gestion);
		$pagos_adelantados = $this->pagosAdelantados($periodo,$gestion);
		return array(
			array('Total',$pagos_vigentes+$pagos_atrasados+$pagos_adelantados),
			array('Vigentes',$pagos_vigentes),
			array('Atrasados',$pagos_atrasados),
			array('Adelantados',$pagos_adelantados)
			);
	}
	
	
	function pagosTotal($periodo,$gestion){
		$company = Auth::user()->company;
		$cuentas_cobrar =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			//->where('periodo','=',$periodo)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();
		//dd($cuentas_cobrar);
		$suma_total = 0;
		foreach ($cuentas_cobrar as $cuentacobrar) {
			$suma_total = $suma_total + $cuentacobrar->importe;
		}
		return $suma_total;
	}
	
	function pagosVigentes($periodo,$gestion){
		$company = Auth::user()->company;
		$date_gestion_periodo_ini = new \DateTime($gestion.'-'.$periodo.'-'.'01');
		$date_gestion_periodo_fin = new \DateTime($gestion.'-'.$periodo.'-'.'31');
		$cuentas_cobrar =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			->where('periodo','=',$periodo)
			->where('gestion','=',$gestion)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();
		//dd($cuentas_cobrar);
		$suma_vigente = 0;
		foreach ($cuentas_cobrar as $cuentacobrar) {
			$fecha_pago = $cuentacobrar->fecha_pago;
			$gestion_cobro = $cuentacobrar->gestion;
			$periodo_cobro = $cuentacobrar->periodo;
			$gestion_pago = date('Y', strtotime($fecha_pago));
			$periodo_pago = date('m', strtotime($fecha_pago));
			if($gestion_cobro == $gestion_pago && $periodo_cobro == $periodo_pago){
				$suma_vigente = $suma_vigente + $cuentacobrar->importe;
			}
		}
		return $suma_vigente;
	}
	
	function pagosAtrasados($periodo,$gestion){
		$company = Auth::user()->company;
		$date_gestion_periodo_ini = new \DateTime($gestion.'-'.$periodo.'-'.'01');
		$date_gestion_periodo_fin = new \DateTime($gestion.'-'.$periodo.'-'.'31');

		$cuentas_cobrar_gestion_pasada =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			->where('gestion','<',$gestion)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();
		$suma_atrasados_gestion_pasada = 0;
		
		foreach ($cuentas_cobrar_gestion_pasada as $cuentacobrar) {
			$suma_atrasados_gestion_pasada = $suma_atrasados_gestion_pasada + $cuentacobrar->importe;
		}
		
		$cuentas_cobrar_gestion_actual =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			->where('periodo','<',$periodo)
			->where('gestion','=',$gestion)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();

		$suma_atrasados_gestion_actual = 0;
		
		foreach ($cuentas_cobrar_gestion_actual as $cuentacobrar) {
			$suma_atrasados_gestion_actual = $suma_atrasados_gestion_actual + $cuentacobrar->importe;
		}
		
		return $suma_atrasados_gestion_pasada+$suma_atrasados_gestion_actual;
	}
	
	function pagosAdelantados($periodo,$gestion){
		$company = Auth::user()->company;
		$date_gestion_periodo_ini = new \DateTime($gestion.'-'.$periodo.'-'.'01');
		$date_gestion_periodo_fin = new \DateTime($gestion.'-'.$periodo.'-'.'31');
		$cuentas_cobrar_gestion_actual =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			->where('periodo','>',$periodo)
			->where('gestion','=',$gestion)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();
		//dd($cuentas_cobrar);
		
		$suma_adelantados_gestion_actual = 0;
		foreach ($cuentas_cobrar_gestion_actual as $cuentacobrar) {
				$suma_adelantados_gestion_actual = $suma_adelantados_gestion_actual + $cuentacobrar->importe;
		}
		
		$cuentas_cobrar_gestion_futura =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('accountsreceivables.company_id',$company->id)
			->where('cancelada',1)
			->where('anulada',0)
			->where('excluir_reportes',0)
			->whereYear('fecha_pago','=',$gestion)
			->whereMonth('fecha_pago','=',$periodo)
			->where('gestion','>',$gestion)
			->orderBy('fecha_pago', 'asc')
			->select('gestion','periodo','fecha_gestion_periodo as fecha_cobro','fecha_pago', 'importe_por_cobrar as importe')
			->get();
		//dd($cuentas_cobrar);
		$suma_adelantados_gestion_futura = 0;
		foreach ($cuentas_cobrar_gestion_futura as $cuentacobrar) {
				$suma_adelantados_gestion_futura = $suma_adelantados_gestion_futura + $cuentacobrar->importe;
		}
		
		return $suma_adelantados_gestion_actual+$suma_adelantados_gestion_futura;
	}
  
}
