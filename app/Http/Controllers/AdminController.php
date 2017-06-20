<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Transaction;
use App\Collection;
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
		//dd(json_encode($cobranzas['cobranza_mes_anterior']));
		$mes_actual = date('m');
		$mes_anterior = (date('m') == 1) ? 12 : date('m')-1;
        return view('admin')
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
}
