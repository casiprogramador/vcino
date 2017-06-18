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
		$categories = Category::where('company_id',$company->id )->lists('nombre','id')->all();
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
		}elseif($request->tipo == 'categorias'){
			$resultado = $this->historicoCategoriasArray($request->categoria,$mes,$anio);
			//dd($resultado['resultado']);
			$categoria = Category::find($request->categoria);
			return view('reports.historico.categoria')
			->with('categoria',$categoria)
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'proveedores'){
			$resultado = $this->historicoProveedoresArray($request->proveedor,$mes,$anio);
			//dd($resultado['resultado']);
			$proveedor = Supplier::find($request->proveedor);
			return view('reports.historico.proveedor')
			->with('proveedor',$proveedor)
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'pagos'){
			$resultado = $this->historicoPropiedadesArray($request->propiedad,$mes,$anio);
			$propiedad = Property::find($request->propiedad);
			return view('reports.historico.pagospropiedad')
			->with('propiedad',$propiedad)
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'ingresos'){
			//$resultado = $this->historicoPropiedadesArray($request->propiedad,$mes,$anio);
			//$propiedad = Property::find($request->propiedad);
			return view('reports.historico.ingresos');
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
		Excel::create('Reporte_Historico_Cuentas', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Cuentas', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_categorias_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];
		$categoria = $opcion_mes_anio[2];

		$array_titulo = array(array('FECHA','DOCUMENTO','PROVEEDOR','CONCEPTO','FORMA PAGO','IMPORTE')); 
		$resultado = $this->historicoCategoriasArray($categoria,$mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Categorias', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Categorias', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_proveedores_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];
		$proveedor = $opcion_mes_anio[2];

		$array_titulo = array(array('FECHA','DOCUMENTO','CATEGORIA','CONCEPTO','CUENTA','FORMA PAGO','IMPORTE')); 
		$resultado = $this->historicoProveedoresArray($proveedor,$mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Proveedores', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Proveedores', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');

	}
	function historicotransacciones_propiedades_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];
		$proveedor = $opcion_mes_anio[2];

		$array_titulo = array(array('FECHA','CUOTA','CONCEPTO','IMPORTE')); 
		$resultado = $this->historicoPropiedadesArray($proveedor,$mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Pagos_por_propiedad', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Pagos por Propiedad', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');

	}
	//Array base
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
				$total_egreso = $total_egreso + $transaction->importe_debito;
			}else if($transaction->tipo_transaccion == "Traspaso-Ingreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,$transaction->importe_credito,0);
				$total_ingreso = $total_ingreso + $transaction->importe_credito;
			}else if($transaction->tipo_transaccion == "Traspaso-Egreso"){
				$array_transaction = array($fecha_pago,$nro_documento,$transaction->concepto,$transaction->forma_pago,$transaction->numero_forma_pago,0,$transaction->importe_debito);
				$total_egreso = $total_egreso + $transaction->importe_debito;
			}
			array_push($array_resultado, $array_transaction);
		}

		return array('resultado'=>$array_resultado,'ingreso_total'=>$total_ingreso,'egreso_total'=>$total_egreso);
	}
	
	function historicoCategoriasArray($id_categoria,$mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		$categoria = Category::find($id_categoria);

		if($categoria->tipo_categoria == 'Ingreso'){
			$ingresos =DB::table('accountsreceivables')
			->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
			->join('categories', 'categories.id', '=', 'quotas.category_id')
			->where('category_id', '=', $id_categoria)
			->where('cancelada',1)
			->where('anulada',0)
			->where('accountsreceivables.company_id',$company->id)
			->where('excluir_reportes',0);

			if($mes != 0) $ingresos->whereMonth('fecha_pago', '=', $mes);
			if($anio != 0) $ingresos->whereYear('fecha_pago', '=', $anio);
			$resultado = $ingresos->get();
			$array_categorias = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $ingreso) {
			   $fecha = date_format(date_create($ingreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($ingreso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $collection = Collection::find($ingreso->id_collection);
			   $array_ingreso = array($fecha, $nro_documento,'',$ingreso->concepto,$collection->account->nombre,$ingreso->forma_pago,$ingreso->importe_credito);
			   array_push($array_categorias, $array_ingreso);
			   $importe_total = $importe_total+$ingreso->importe_credito;
			}

		}else{
			$gastos =  DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
					->join('accounts', 'accounts.id', '=', 'expenses.account_id')
					->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
  					->where('category_id',$id_categoria)
					->where('expenses.company_id',$company->id)
  					->where('anulada',0)
  					->where('excluir_reportes',0);


			if($mes != 0) $gastos->whereMonth('fecha_pago', '=', $mes);
			if($anio != 0) $gastos->whereYear('fecha_pago', '=', $anio);

			$resultado = $gastos->get();
			dd($resultado);
			$array_categorias = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $egreso) {
			   $fecha = date_format(date_create($egreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($egreso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $array_egreso = array($fecha,$nro_documento,$egreso->razon_social,$egreso->concepto,$egreso->nombre,$egreso->forma_pago,$egreso->importe_debito);
			   array_push($array_categorias, $array_egreso);
			   $importe_total=$importe_total+$egreso->importe_debito;
			}
		}

		
		return array('resultado'=>$array_categorias,'monto_total'=>$importe_total);

	}
	
	function historicoProveedoresArray($id_proveedor,$mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		//$categoria = Category::find($id_categoria);

		$proveedores =DB::table('expenses')
			->select('transactions.fecha_pago as fecha_pago', 'transactions.nro_documento','categories.nombre as categoria','transactions.concepto','accounts.nombre as cuenta','transactions.forma_pago as forma_pago','transactions.importe_debito as importe')
			->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
			->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
			->join('accounts', 'accounts.id', '=', 'expenses.account_id')
			->join('categories', 'categories.id', '=', 'expenses.category_id')
			->where('expenses.supplier_id', '=', $id_proveedor)
			->where('transactions.anulada',0)
			->where('expenses.company_id',$company->id)
			->where('transactions.excluir_reportes',0);

			if($mes != 0) $proveedores->whereMonth('transactions.fecha_pago', '=', $mes);
			if($anio != 0) $proveedores->whereYear('transactions.fecha_pago', '=', $anio);
			$resultado = $proveedores->get();
			//dd($resultado);
			$array_proveedores = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $egreso) {
			   $fecha = date_format(date_create($egreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($egreso->nro_documento, 6, "0", STR_PAD_LEFT);

			   $array_egreso = array($fecha, $nro_documento,$egreso->categoria,$egreso->concepto,$egreso->cuenta,$egreso->forma_pago,$egreso->importe);
			   array_push($array_proveedores, $array_egreso);
			   $importe_total = $importe_total+$egreso->importe;
			}
			//dd($array_proveedores);

		
		return array('resultado'=>$array_proveedores,'monto_total'=>$importe_total);

	}
	
	function historicoPropiedadesArray($id_propiedad,$mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		//$categoria = Category::find($id_categoria);

		$propiedades =DB::table('collections')
			->select('transactions.fecha_pago as fecha_pago','transactions.concepto','collections.id')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->where('collections.property_id', '=', $id_propiedad)
			->where('transactions.anulada',0)
			->where('collections.company_id',$company->id)
			->where('transactions.excluir_reportes',0);

			if($mes != 0) $propiedades->whereMonth('transactions.fecha_pago', '=', $mes);
			if($anio != 0) $propiedades->whereYear('transactions.fecha_pago', '=', $anio);
			$resultado = $propiedades->get();
			//dd($resultado);
			$array_propiedades = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $pago) {
			   $fecha = date_format(date_create($pago->fecha_pago),'d/m/Y');
			   
			   $cuota_pagadas = Accountsreceivable::where('id_collection',$pago->id)->get();
			  
			   foreach ($cuota_pagadas as $cuota_pagada) {
				    $concepto = ($pago->concepto).' - Periodo '.(nombremes($cuota_pagada->periodo)).' / '.($cuota_pagada->gestion);
				   $array_pago = array($fecha, $cuota_pagada->quota->cuota,$concepto,$cuota_pagada->importe_por_cobrar);
				   array_push($array_propiedades, $array_pago);
				   $importe_total = $importe_total+$cuota_pagada->importe_por_cobrar;
			   }
			   
			}

		
		return array('resultado'=>$array_propiedades,'monto_total'=>$importe_total);

	}
}
