<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;
use App\Collection;
use App\Expenses;
use App\Accountsreceivable;
use App\Property;
use App\Gestion;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportCuentasCobrarController extends Controller
{
   	public function __construct(){
        $this->middleware('auth');
    }
	
	function cuentascobrar(){
		$company = Auth::user()->company;
		
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		return view('reports.cuentascobrar')->with('properties',$properties);
	}
	
	function cuentascobrar_show(Request $request){
		//dd($request);
		if($request->tipo == "detallado"){
			if($request->periodo == "actual"){
				$mes = date('m');
				$anio = date('Y');
			}else{
				$mes = (date('m') == 1) ? 12 : date('m')-1;
				$anio = (date('m') == 1) ? date('Y')-1 : date('Y');
			}
			$detallado = array();
			$detallado = $this->cuotasDetalladoArray($anio,$mes,$detallado);
			$cuotas = $detallado['resultado'];
			$monto_total = $detallado['monto'];
			
			//dd($detallado);
			return view('reports.cuentascobrar_detallado')
					->with('mes',$mes)
					->with('anio',$anio)
					->with('cuotas',$cuotas)
					->with('monto_total',$monto_total);
			
		}elseif($request->tipo == "consolidado"){
			return view('reports.cuentascobrar_consolidado');
		}elseif($request->tipo == "porpropiedad"){
			return view('reports.cuentascobrar_porpropiedad');
		}else{
			return view('reports.cuentascobrar_detallado');
		}
	}
	//Funciones excel
	function categoriaperiodogestion_detallado_excel($opcion){
		$opcion_array = explode('_', $opcion);
		$anio = $opcion_array[0];
		$mes = $opcion_array[1];
		$detallado = array(array('PROPIEDAD','CUOTA','GESTION','PERIODO','IMPORTE','TOTAL'));
		$detallado = $this->cuotasDetalladoArray($anio,$mes,$detallado);
		$resultado = $detallado['resultado'];
		$monto_total = $detallado['monto'];
		$montoTotalArray = array('Total','','','',$monto_total);
		array_push($resultado, $montoTotalArray);
		Excel::create('Reporte_Cuentas_Cobrar', function($excel) use($resultado){
 
            $excel->sheet('Productos', function($sheet) use($resultado){
 
 
                $sheet->fromArray($resultado, null, 'A1', false, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#feff01');

				});
 
            });
        })->export('xls');
	}
	
	//Funciones extra
	
	function cuotasDetalladoArray ($anio,$mes,$array_inicial){
		$resultado = $array_inicial;
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->get();
		$total = 0;
		foreach ($properties as $property) {
			$importe_total = 0;
			$accountsreceivables = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('property_id',$property->id)
					->where('periodo', '<=', $mes)
					->where('gestion', '<=', $anio)
					->get();
			foreach ($accountsreceivables as $cuotapagar) {
				$cuota = array($property->nro,$cuotapagar->quota->cuota,$cuotapagar->gestion,$cuotapagar->periodo,$cuotapagar->importe_por_cobrar);
				array_push($resultado, $cuota);
				$importe_total = $importe_total + $cuotapagar->importe_por_cobrar;
			}
			if(count($accountsreceivables)){
			$montoTotalArray = array('Total','','','',$importe_total);
			$total = $total + $importe_total;
			array_push($resultado, $montoTotalArray);
			}
		}
		//dd($total);
		return array("resultado"=>$resultado,"monto"=>$total);
	}
	
}
