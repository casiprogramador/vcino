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
use Maatwebsite\Excel\Facades\Excel;

class ReportDisponibilidadController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }

    function disponibilidad(){
		return view('reports.disponibilidad');
	}

	function disponibilidad_show(Request $request){
		//dd($request->fecha);
		$cuentas = $this->cuentasporfecha($request->fecha);
		//dd($disponibilidad);
		return view('reports.disponibilidad_show')
			->with('cuentas',$cuentas['disponibilidad'])
			->with('fecha',$request->fecha)
			->with('suma_total',$cuentas['suma_total']);
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
	
	function disponibilidadExcel($fecha){
		//$cuentas = $this->cuentasporfechaExcel($fecha);
		//dd($cuentas['disponibilidad']);
		Excel::create('Reporte_Disponibilidad', function($excel) use($fecha){
 
            $excel->sheet('Productos', function($sheet) use($fecha){
 
                $cuentas = $this->cuentasporfechaExcel($fecha);
 
                $sheet->fromArray($cuentas['disponibilidad'], null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');
	}
	
	function cuentasporfecha($fecha){
		$company = Auth::user()->company;
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->get();
		$fecha_limite = date('Y-m-d', strtotime(str_replace('/','-',$fecha)));
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
		
		$respuesta = array(
			"disponibilidad"=>$disponibilidad,
			"suma_total"=>$suma_total
		);
		
		return $respuesta;
	}
	
		function cuentasporfechaExcel($fecha){
		$company = Auth::user()->company;
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->get();
		$fecha_limite = date('Y-m-d', strtotime(str_replace('/','-',$fecha)));
		$disponibilidad = array(array('CUENTA','','','IMPORTE'));
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
			$datos_cuenta = array($account->nombre,'','',$sum_account_cobranza-$sum_account_gastos+$sum_account_ingreso_transf-$sum_account_egresos_transf);
			array_push($disponibilidad, $datos_cuenta);

		}
		array_push($disponibilidad, array('Total','','',$suma_total));
		$respuesta = array(
			"disponibilidad"=>$disponibilidad,
			"suma_total"=>$suma_total
		);
		
		return $respuesta;
	}

	
}
