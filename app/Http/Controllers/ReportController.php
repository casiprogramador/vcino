<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;
use App\Collection;
use App\Expenses;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
    function disponibilidad(){
		return view('reports.disponibilidad');
	}
	
	function disponibilidad_show(Request $request){
		//dd($request->fecha);
		$company = Auth::user()->company;
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->get();
		$fecha_limite = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$disponibilidad = array();
		$suma_total = 0;
		foreach($accounts as $account){
			//Suma de importe en cobranza
			$collection = DB::table('collections')
					->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
					->where('account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_credito');
			$sum_account_cobranza = (is_null($collection)) ? 0 : $collection;
			$suma_total = $suma_total+$sum_account_cobranza;
			//Suma de importe en gastos
			$expense = DB::table('expenses')
					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
					->where('account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_debito');
			$sum_account_gastos = (is_null($expense)) ? 0 : $expense;
			$suma_total= $suma_total-$sum_account_gastos;
			
			$datos_cuenta = array('cuenta'=>$account->nombre,'ingreso'=>$sum_account_cobranza,'egreso'=>$sum_account_gastos);
			array_push($disponibilidad, $datos_cuenta);
			
		}
		//dd($disponibilidad);
		return view('reports.disponibilidad_show')
			->with('cuentas',$disponibilidad)
			->with('fecha',$request->fecha)
			->with('suma_total',$suma_total);
	}
}
