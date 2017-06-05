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
use App\Supplier;
use App\Property;
use App\Transfer;
use App\Transaction;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportHistoricoTransaccionesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	
	function historicotransacciones(){
		
		$company = Auth::user()->company;
		$gestiones = Gestion::lists('nombre','nombre')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->lists('nombre','id')->all();
		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->lists('nombre','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->lists('razon_social','id')->all();
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		return view('reports.historico.historico')
				->with('gestiones',$gestiones)
				->with('cuentas',$accounts)
				->with('categorias',$categories)
				->with('proveedores',$suppliers)
				->with('propiedades',$properties);
	}
	
	function historicotransacciones_show(Request $request){
		//dd($request);
		
		$cuenta = Account::find($request->cuenta);
		if($request->periodo == "actual"){
			$mes = date('m');
    		$anio = date('Y');
		}elseif($request->periodo == "anterior"){
			$mes = (date('m') == 1) ? 12 : date('m')-1;
			$anio = (date('m') == 1) ? date('Y')-1 : date('Y');
		}elseif($request->periodo == "gestionactual"){
			$mes = 0;
    		$anio = date('Y');
		}elseif($request->periodo == "gestionanterior"){
			$mes = 0;
			$anio = date('Y')-1;
		}elseif($request->periodo == "mesgestion"){
			$mes = $request->mes;
            $anio = $request->anio;

		}elseif($request->periodo == "porgestion"){
			$mes = 0;
			$anio = $request->anio;
		}else{
			$mes = date('m');
    		$anio = date('Y');
		}

		if($request->tipo == 'cuentas'){
			$resultado = $this->historicoCuentasArray($request->cuenta,$mes,$anio);
			//dd($resultado['resultado']);
			return view('reports.historico.cuentas')
					->with('cuenta',$cuenta)
					->with('mes',$mes)
					->with('anio',$anio)
					->with('transactions',$resultado['resultado'])
					->with('ingreso_total',$resultado['ingreso_total'])
					->with('egreso_total',$resultado['egreso_total']);
		}else{
			return view('reports.historico.categoria');
		}
		
	}
	
	//Excel
	function historicotransacciones_cuentas_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];
		$cuenta = $opcion_mes_anio[2];

		$array_titulo = array(array('FECHA','DOCUMENTO','CONCEPTO','FORMA DE PAGO','NRO FORMA PAGO','INGRESO','EGRESO')); 
		$resultado = $this->historicoCuentasArray($cuenta,$mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','',$resultado['ingreso_total'],$resultado['egreso_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Estado_Actual', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Cuentas', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');

	}
	
	function historicoCuentasArray($id_cuenta,$mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		$id_transactions = array();
		$expenses = Expenses::where('company_id',$company->id )->where('account_id',$id_cuenta)->get();
		foreach($expenses as $expense){
			array_push($id_transactions, $expense->transaction_id);	
		}
		$collections = Collection::where('company_id',$company->id )->where('account_id',$id_cuenta)->get();
		foreach($collections as $collection){
			array_push($id_transactions, $collection->transaction_id);	
		}
		$transfers = Transfer::where('company_id',$company->id )->where('ori_account_id',$id_cuenta)->get();
		foreach($transfers as $transfer){
			array_push($id_transactions, $transfer->ori_transaction_id);	
		}
		$transfers = Transfer::where('company_id',$company->id )->where('des_account_id',$id_cuenta)->get();
		foreach($transfers as $transfer){
			array_push($id_transactions, $transfer->des_transaction_id);	
		}
		$transactions = Transaction::query();
		$transactions = $transactions->where('user_id',Auth::user()->id )
				->whereIn('id',$id_transactions)
				->where('anulada',0)
				->where('excluir_reportes',0);
		 if($mes != 0) $transactions->whereMonth('fecha_pago', '=', $mes);
         if($anio != 0) $transactions->whereYear('fecha_pago', '=', $anio);
		 
		 $transactions = $transactions->get();
		 
		//dd($transactions);
		$array_resultado = $array_inicio;
		$total_ingreso = 0;
		$total_egreso = 0;
		foreach ($transactions as $transaction) {
			//dd($transaction->expense);
			$fecha_pago = date_format(date_create($transaction->fecha_pago),'d/m/Y');
			$nro_documento = str_pad($transaction->nro_documento, 6, "0", STR_PAD_LEFT);
			
			if($transaction->tipo_transaccion == "Ingreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,$transaction->importe_credito,0);
				$total_ingreso = $total_ingreso + $transaction->importe_credito;
			}else if($transaction->tipo_transaccion == "Egreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,0,$transaction->importe_debito);
				$total_egreso = $total_ingreso + $transaction->importe_debito;
			}else if($transaction->tipo_transaccion == "Traspaso-Ingreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,$transaction->importe_credito,0);
				$total_ingreso = $total_ingreso + $transaction->importe_credito;
			}else if($transaction->tipo_transaccion == "Traspaso-Egreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,0,$transaction->importe_debito);
				$total_egreso = $total_ingreso + $transaction->importe_debito;
			}
			array_push($array_resultado, $array_transaction);
		}
		//$array_total = array('','','','','',$total_ingreso,$total_egreso);
		
		//array_push($array_resultado, $array_total);
		//dd($array_resultado);
		return array('resultado'=>$array_resultado,'ingreso_total'=>$total_ingreso,'egreso_total'=>$total_egreso);
	}
}
