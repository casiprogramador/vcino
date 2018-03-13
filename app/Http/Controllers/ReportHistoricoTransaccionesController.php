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
			$resultado = $this->historicoCuentasArray($cuenta,$request->cuenta,$mes,$anio);
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
			$resultado = $this->historicoIngresosArray($mes,$anio);
			return view('reports.historico.ingresos')
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'egresos'){
			$resultado = $this->historicoEgresosArray($mes,$anio);
			return view('reports.historico.egresos')
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'traspasos'){
			$resultado = $this->historicoTraspasosArray($mes,$anio);
			return view('reports.historico.traspasos')
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto',$resultado['monto_total']);
		}elseif($request->tipo == 'todas'){
			$resultado = $this->historicoTransaccionesArray($mes,$anio);
			return view('reports.historico.transacciones')
			->with('mes',$mes)
			->with('anio',$anio)
			->with('datos',$resultado['resultado'])
			->with('monto_credito',$resultado['monto_total_credito'])
			->with('monto_debito',$resultado['monto_total_debito']);
		}

	}
	
	//Excel
	function historicotransacciones_cuentas_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];
		$cuenta = $opcion_mes_anio[2];
		$cuenta_datos = Account::find($cuenta);
		$array_titulo = array(array('FECHA','DOCUMENTO','CONCEPTO','FORMA DE PAGO','NRO FORMA PAGO','INGRESO','EGRESO')); 
		$resultado = $this->historicoCuentasArray($cuenta_datos,$cuenta,$mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','',$resultado['ingreso_total'],$resultado['egreso_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Historico_Cuentas', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Cuentas', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#D6D6D6');

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
					$row->setBackground('#D6D6D6');

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
					$row->setBackground('#D6D6D6');

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
					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_ingresos_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];

		$array_titulo = array(array('FECHA','DOCUMENTO','BENEFICIARIO','CONCEPTO','CUENTA','IMPORTE')); 
		$resultado = $this->historicoIngresosArray($mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Ingresos', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Ingresos', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_egresos_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];

		$array_titulo = array(array('FECHA','DOCUMENTO','PROVEEDOR','CATEGORIA','CONCEPTO','CUENTA','IMPORTE')); 
		$resultado = $this->historicoEgresosArray($mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Egresos', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Egresos', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_traspasos_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];

		$array_titulo = array(array('FECHA','DOCUMENTO','CONCEPTO','CUENTA ORIGEN','CUENTA DESTINO','FORMA PAGO','IMPORTE')); 
		$resultado = $this->historicoTraspasosArray($mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','','',$resultado['monto_total']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Traspasos', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Traspasos', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	
	function historicotransacciones_transacciones_excel($opcion){
		$opcion_mes_anio = explode('_', $opcion);
		$mes = $opcion_mes_anio[0];
		$anio = $opcion_mes_anio[1];

		$array_titulo = array(array('FECHA','DOCUMENTO','BENEFICIARIO','CATEGORIA','CONCEPTO','CUENTA','INGRESO','EGRESO')); 
		$resultado = $this->historicoTransaccionesArray($mes,$anio,$array_titulo);
		
		
		$resultado_datos = $resultado['resultado'];
		$array_total = array('Total','','','','','',$resultado['monto_total_credito'],$resultado['monto_total_debito']);
		array_push($resultado_datos,$array_total);
		Excel::create('Reporte_Histoirico_Transacciones', function($excel) use($resultado_datos){
 
            $excel->sheet('Historico Transacciones', function($sheet) use($resultado_datos){
 
 
                $sheet->fromArray($resultado_datos, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					// call cell manipulation methods
					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	//Array base
	function historicoCuentasArray($cuenta_datos,$id_cuenta,$mes,$anio,$array_inicio = array()){
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
				->where('excluir_reportes',0)
				->orderBy('fecha_pago', 'asc');
		 if($mes != 0) $transactions->whereMonth('fecha_pago', '=', $mes);
         if($anio != 0) $transactions->whereYear('fecha_pago', '=', $anio);
		 
		 $transactions = $transactions->get();
		 
		//dd($transactions);
		$array_resultado = $array_inicio;
		$total_ingreso = 0;
		$total_egreso = 0;
		//Aumento balance inicial
		$array_transaction_bal_ini = array(date_format(date_create($cuenta_datos->created_at),'d/m/Y'),'Balance Inicial','','','',$cuenta_datos->balance_inicial,0);
		array_push($array_resultado, $array_transaction_bal_ini);
		
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

		return array('resultado'=>$array_resultado,'ingreso_total'=>$total_ingreso+$cuenta_datos->balance_inicial,'egreso_total'=>$total_egreso);
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
			->where('excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');

			if($mes != 0) $ingresos->whereMonth('fecha_pago', '=', $mes);
			if($anio != 0) $ingresos->whereYear('fecha_pago', '=', $anio);
			$resultado = $ingresos->get();
			$array_categorias = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $ingreso) {
			   $fecha = date_format(date_create($ingreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($ingreso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $collection = Collection::find($ingreso->id_collection);
			   $array_ingreso = array($fecha, $nro_documento,'',$ingreso->concepto,$collection->account->nombre,$ingreso->forma_pago,$ingreso->importe_por_cobrar);
			   array_push($array_categorias, $array_ingreso);
			   $importe_total = $importe_total+$ingreso->importe_por_cobrar;
			}

		}else{
			$gastos =  DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
					->join('accounts', 'accounts.id', '=', 'expenses.account_id')
					->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
  					->where('category_id',$id_categoria)
					->where('expenses.company_id',$company->id)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
  					->orderBy('fecha_pago', 'asc');


			if($mes != 0) $gastos->whereMonth('fecha_pago', '=', $mes);
			if($anio != 0) $gastos->whereYear('fecha_pago', '=', $anio);

			$resultado = $gastos->get();

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
			->where('transactions.excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');

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
			->where('transactions.excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');

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
		//$collections = Collection::where('company_id',$company->id );
	}
	
	function historicoIngresosArray($mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		$ingresos =DB::table('collections')
			->select('transactions.fecha_pago as fecha_pago', 'transactions.nro_documento','properties.nro as propiedad','contacts.nombre','contacts.apellido','transactions.concepto','accounts.nombre as cuenta','transactions.importe_credito as importe')
			->join('properties', 'properties.id', '=', 'collections.property_id')
			->join('contacts', 'contacts.id', '=', 'collections.contact_id')
			->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
			->join('accounts', 'accounts.id', '=', 'collections.account_id')
			->where('transactions.anulada',0)
			->where('collections.company_id',$company->id)
			->where('transactions.excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');
			if($mes != 0) $ingresos->whereMonth('transactions.fecha_pago', '=', $mes);
			if($anio != 0) $ingresos->whereYear('transactions.fecha_pago', '=', $anio);
			$resultado = $ingresos->get();
			//dd($resultado);
			$array_ingresos = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $ingreso) {
			   $fecha = date_format(date_create($ingreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($ingreso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $beneficiario = ($ingreso->propiedad).' - '.($ingreso->nombre).' '.($ingreso->apellido);
			   $fecha_tsmp = strtotime($ingreso->fecha_pago);

			   $array_ingreso = array($fecha, $nro_documento,$beneficiario,$ingreso->concepto,$ingreso->cuenta,$ingreso->importe,$fecha_tsmp);
			   array_push($array_ingresos, $array_ingreso);
			   $importe_total = $importe_total+$ingreso->importe;
			}
			//dd($array_ingresos);
		
		return array('resultado'=>$array_ingresos,'monto_total'=>$importe_total);
		
	}
	
	function historicoEgresosArray($mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		$egresos = DB::table('expenses')
			->select('transactions.fecha_pago as fecha_pago', 'transactions.nro_documento','suppliers.razon_social as proveedor','categories.nombre as categoria','transactions.concepto','accounts.nombre as cuenta','transactions.importe_debito as importe')
			->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
			->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
			->join('accounts', 'accounts.id', '=', 'expenses.account_id')
			->join('categories', 'categories.id', '=', 'expenses.category_id')
			->where('transactions.anulada',0)
			->where('expenses.company_id',$company->id)
			->where('transactions.excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');

			if($mes != 0) $egresos->whereMonth('transactions.fecha_pago', '=', $mes);
			if($anio != 0) $egresos->whereYear('transactions.fecha_pago', '=', $anio);
			$resultado = $egresos->get();
			$array_egresos = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $egreso) {
			   $fecha = date_format(date_create($egreso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($egreso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $fecha_tsmp = strtotime($egreso->fecha_pago);

			   $array_egreso = array($fecha, $nro_documento,$egreso->proveedor,$egreso->categoria,$egreso->concepto,$egreso->cuenta,$egreso->importe, $fecha_tsmp);
			   array_push($array_egresos, $array_egreso);
			   $importe_total = $importe_total+$egreso->importe;
			}
		
		return array('resultado'=>$array_egresos,'monto_total'=>$importe_total);
		
	}
	
	function historicoTraspasosArray($mes,$anio,$array_inicio = array()){
		$company = Auth::user()->company;
		$traspaso = DB::table('transfers')
			->select('transactions.fecha_pago as fecha_pago', 'transactions.nro_documento','transactions.concepto','cuenta_ori.nombre as cuenta_origen','cuenta_des.nombre as cuenta_destino','transactions.forma_pago as forma_pago','transactions.importe_debito as importe')
			->join('transactions', 'transactions.id', '=', 'transfers.ori_transaction_id')
			->join('accounts as cuenta_ori', 'cuenta_ori.id', '=', 'transfers.ori_account_id')
			->join('accounts as cuenta_des', 'cuenta_des.id', '=', 'transfers.des_account_id')
			->where('transactions.anulada',0)
			->where('transfers.company_id',$company->id)
			->where('transactions.excluir_reportes',0)
			->orderBy('fecha_pago', 'asc');

			if($mes != 0) $traspaso->whereMonth('transactions.fecha_pago', '=', $mes);
			if($anio != 0) $traspaso->whereYear('transactions.fecha_pago', '=', $anio);
			$resultado = $traspaso->get();

			$array_traspasos = $array_inicio;
			$importe_total = 0;
			foreach ($resultado as $traspaso) {
			   $fecha = date_format(date_create($traspaso->fecha_pago),'d/m/Y');
			   $nro_documento = str_pad($traspaso->nro_documento, 6, "0", STR_PAD_LEFT);
			   $fecha_tsmp = strtotime($traspaso->fecha_pago);

			    $array_traspaso = array($fecha, $nro_documento, $traspaso->concepto,$traspaso->cuenta_origen,$traspaso->cuenta_destino ,$traspaso->forma_pago,$traspaso->importe,$fecha_tsmp);
			   array_push($array_traspasos, $array_traspaso);
			   $importe_total = $importe_total+$traspaso->importe;
			}

		return array('resultado'=>$array_traspasos,'monto_total'=>$importe_total);
		
	}
	
	function historicoTransaccionesArray($mes,$anio,$array_inicio = array()){
		$ingresos = $this->historicoIngresosArray($mes,$anio);
		$egresos = $this->historicoEgresosArray($mes,$anio);
		$traspasos = $this->historicoTraspasosArray($mes,$anio);

		$array_transacciones = $array_inicio;
		$importe_total_credito = 0;
		$importe_total_debito = 0;
		
		foreach ($ingresos['resultado'] as $ingreso) {

			$array_transaccion = array($ingreso[0], $ingreso[1], $ingreso[2],'',$ingreso[3],$ingreso[4],$ingreso[5],'', 'I', $ingreso[6]);
			   array_push($array_transacciones, $array_transaccion);
			   $importe_total_credito = $importe_total_credito+$ingreso[5];
		}
		
		foreach ($egresos['resultado'] as $egreso) {

			$array_transaccion = array($egreso[0], $egreso[1], $egreso[2],$egreso[3],$egreso[4],$egreso[5],'',$egreso[6], 'E', $egreso[7]);
			   array_push($array_transacciones, $array_transaccion);
			   $importe_total_debito = $importe_total_debito+$egreso[6];
		}
		
		foreach ($traspasos['resultado'] as $traspaso) {

			$array_transaccion = array($traspaso[0], $traspaso[1],'','', $traspaso[2],$traspaso[3].' - '.$traspaso[4],$traspaso[6],$traspaso[6], 'T', $traspaso[7]);
			   array_push($array_transacciones, $array_transaccion);
			   $importe_total_credito = $importe_total_credito+$traspaso[6];
			   $importe_total_debito = $importe_total_debito+$traspaso[6];
		}
		
		//dd($array_transacciones);

		return array('resultado'=>$array_transacciones,'monto_total_credito'=>$importe_total_credito,'monto_total_debito'=>$importe_total_debito);
		
	}
}
