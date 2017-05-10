<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;
use App\Collection;
use App\Expenses;
use App\Accountsreceivable;
use App\Category;
use App\Gestion;
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
			//Suma de traspaso ingreso
			$transfers_des = DB::table('transfers')
					->join('transactions', 'transactions.id', '=', 'transfers.des_transaction_id')
					->where('des_account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_credito');
			$sum_account_ingreso_transf = (is_null($transfers_des)) ? 0 : $transfers_des;
			$suma_total= $suma_total+$sum_account_ingreso_transf;
			//Suma de traspaso egreso
			$transfers_ori = DB::table('transfers')
					->join('transactions', 'transactions.id', '=', 'transfers.ori_transaction_id')
					->where('ori_account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_debito');
			$sum_account_egresos_transf = (is_null($transfers_ori)) ? 0 : $transfers_ori;
			$suma_total= $suma_total-$sum_account_egresos_transf;
			//Envio de datos
			$datos_cuenta = array('cuenta'=>$account->nombre,'ingreso'=>$sum_account_cobranza,'egreso'=>$sum_account_gastos,'ingreso_trans'=>$sum_account_ingreso_transf,'egreso_trans'=>$sum_account_egresos_transf);
			array_push($disponibilidad, $datos_cuenta);
			
		}
		//dd($disponibilidad);
		return view('reports.disponibilidad_show')
			->with('cuentas',$disponibilidad)
			->with('fecha',$request->fecha)
			->with('suma_total',$suma_total);
	}
	
	public function disponibilidadPdf($fecha){
		//dd($fecha);
		$company = Auth::user()->company;
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->get();
		//Ya le paso fecha con formato
		$fecha_limite = $fecha;
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
			//Suma de traspaso ingreso
			$transfers_des = DB::table('transfers')
					->join('transactions', 'transactions.id', '=', 'transfers.des_transaction_id')
					->where('des_account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_credito');
			$sum_account_ingreso_transf = (is_null($transfers_des)) ? 0 : $transfers_des;
			$suma_total= $suma_total+$sum_account_ingreso_transf;
			//Suma de traspaso egreso
			$transfers_ori = DB::table('transfers')
					->join('transactions', 'transactions.id', '=', 'transfers.ori_transaction_id')
					->where('ori_account_id',$account->id)
					->where('transactions.fecha_pago', '<=', $fecha_limite)
					->where('anulada',0)
					->where('excluir_reportes',0)
					->sum('importe_debito');
			$sum_account_egresos_transf = (is_null($transfers_ori)) ? 0 : $transfers_ori;
			$suma_total= $suma_total-$sum_account_egresos_transf;
			//Envio de datos
			$datos_cuenta = array('cuenta'=>$account->nombre,'ingreso'=>$sum_account_cobranza,'egreso'=>$sum_account_gastos,'ingreso_trans'=>$sum_account_ingreso_transf,'egreso_trans'=>$sum_account_egresos_transf);
			array_push($disponibilidad, $datos_cuenta);
			
		}
		//dd($disponibilidad);
		
		$cuentas=$disponibilidad;
		$fecha = date_format(date_create($fecha),'d/m/Y');
		$pdf = \PDF::loadView('pdf.disponibilidad', compact('cuentas','fecha','suma_total'));
		
		return $pdf->download('Reporte_Disponibilidad_'.  str_replace('/', '_', $fecha).".pdf");
	}
	
	//Reporte de Estado de Resultados
	function estadoresultados(){
		
		$gestiones = Gestion::lists('nombre','nombre')->all();
		return view('reports.estadoresultados')->with('gestiones',$gestiones);
	}
	
	function estadoresultados_show(Request $request){
		$mes = date('m');
		$anio = date('Y');
		$company = Auth::user()->company;

        $categories = Category::where('company_id',$company->id )->where('tipo_categoria','Ingreso')->get();
		$categorias_ingreso = array();
		$importe_total_ingresos = 0;
		foreach($categories as $category){
			
		
			$categoria =DB::table('accountsreceivables')
						->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
						->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
						->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
						->join('categories', 'categories.id', '=', 'quotas.category_id')
						//->where('transactions.fecha_pago', '<=', $fecha_limite)
						->whereMonth('fecha_pago', '=', $mes)
						->whereYear('fecha_pago', '=', $anio)
						->where('category_id', '=', $category->id)
						->where('cancelada',1)
						->where('anulada',0)
						->where('excluir_reportes',0)

						->sum('importe_credito');
						//->get();
			$importe_categoria = (is_null($categoria)) ? 0 : $categoria;
			$datos_categoria = array('nombre'=>$category->nombre,'monto'=>$importe_categoria);
			$importe_total_ingresos = $importe_total_ingresos+$importe_categoria;
			array_push($categorias_ingreso, $datos_categoria);
		}
		//dd($categorias);
		return view('reports.estadoresultados_show')
			->with('categorias_ingreso',$categorias_ingreso)
			->with('importe_total_ingreso',$importe_total_ingresos);
	}
}
