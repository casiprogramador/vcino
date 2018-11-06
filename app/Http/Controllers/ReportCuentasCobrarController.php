<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Auth;
use App\Collection;
use App\Expenses;
use App\Accountsreceivable;
use App\Property;
use App\Contact;
use App\Gestion;
use App\TypeProperty;
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
		if($request->periodo == "actual"){
				$mes = date('m');
				$anio = date('Y');
		}else{
				$mes = (date('m') == 1) ? 12 : date('m')-1;
				$anio = (date('m') == 1) ? date('Y')-1 : date('Y');
		}
		
		
		if($request->tipo == "detallado"){
			
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
			$consolidado = array();
			$consolidado = $this->cuotasConsolidadoArray($anio,$mes,$consolidado);
			$cuotas = $consolidado['resultado'];
			$monto_total = $consolidado['monto'];

			return view('reports.cuentascobrar_consolidado')
					->with('mes',$mes)
					->with('anio',$anio)
					->with('cuotas',$cuotas)
					->with('monto_total',$monto_total);

		}elseif($request->tipo == "porpropiedad"){
			
			$porpropiedad = array();
			$porpropiedad = $this->cuotasPropiedadArray($anio,$mes,$porpropiedad,$request->propiedad);
			$cuotas = $porpropiedad['resultado'];
			$monto_total = $porpropiedad['monto'];
			$propiead = $porpropiedad['propiedad'];
			$propietario = $porpropiedad['propietario'];
			return view('reports.cuentascobrar_porpropiedad')
					->with('mes',$mes)
					->with('anio',$anio)
					->with('cuotas',$cuotas)
					->with('propiedad',$propiead)
					->with('id_propiedad',$request->propiedad)
					->with('propietario',$propietario)
					->with('monto_total',$monto_total);
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
 
            $excel->sheet('Reporte', function($sheet) use($resultado){
 
 
                $sheet->fromArray($resultado, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#1A7CC0');

				});
 
            });
        })->export('xls');
	}
	
	function categoriaperiodogestion_consolidado_excel($opcion){
		$opcion_array = explode('_', $opcion);
		$anio = $opcion_array[0];
		$mes = $opcion_array[1];
		$consolidado = array(array('PROPIEDAD','PROPIETARIO','TIPO PROPIEDAD','TOTAL'));
		$consolidado = $this->cuotasConsolidadoArray($anio,$mes,$consolidado);
		$resultado = $consolidado['resultado'];
		$monto_total = $consolidado['monto'];
		$montoTotalArray = array('TOTAL','','',$monto_total);
		array_push($resultado, $montoTotalArray);
		Excel::create('Reporte_Cuentas_Cobrar_detallado', function($excel) use($resultado){
 
            $excel->sheet('Reporte', function($sheet) use($resultado){
 
 
                $sheet->fromArray($resultado, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#1A7CC0');

				});
 
            });
        })->export('xls');
	}
	
	function categoriaperiodogestion_porpropiedad_excel($opcion){
		$opcion_array = explode('_', $opcion);
		$anio = $opcion_array[0];
		$mes = $opcion_array[1];
		$propiedad = $opcion_array[2];
		$porpropiedad = array(array('CUOTA','GESTION','PERIODO','IMPORTE'));
		$porpropiedad = $this->cuotasPropiedadArray($anio,$mes,$porpropiedad,$propiedad);
		$resultado = $porpropiedad['resultado'];

		Excel::create('Reporte_Cuentas_Cobrar_porpropiedad', function($excel) use($resultado){
 
            $excel->sheet('Reporte', function($sheet) use($resultado){
 
 
                $sheet->fromArray($resultado, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#1A7CC0');

				});
 
            });
        })->export('xls');
	}
	
	//Funciones extra
	
	function cuotasDetalladoArray ($anio,$mes,$array_inicial){
		$resultado = $array_inicial;
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->get();
		$total = 0;
		$date_gestion_periodo = new \DateTime($anio.'-'.$mes.'-'.'02');
		foreach ($properties as $property) {
			$importe_total = 0;
			$accountsreceivables = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('property_id',$property->id)
					->where('fecha_gestion_periodo','<=',$date_gestion_periodo)
					->orderBy('gestion','asc')->orderBy('periodo','asc')
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
	
	function cuotasConsolidadoArray ($anio,$mes,$array_inicial){
		$resultado = $array_inicial;
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->get();
		$total = 0;
		$date_gestion_periodo = new \DateTime($anio.'-'.$mes.'-'.'02');
		foreach ($properties as $property) {
			$importe_total = 0;
			$accountsreceivables = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('property_id',$property->id)
					->where('fecha_gestion_periodo','<=',$date_gestion_periodo)
					->get();
			//Obtenemos el importe total
			foreach ($accountsreceivables as $cuotapagar) {
				$importe_total = $importe_total + $cuotapagar->importe_por_cobrar;
			}
			$contacto = Contact::where('company_id',$company->id )->where('activa',1)->where('property_id',$property->id)->where('typecontact_id',1)->first();

			//Obtenermos el nombre del propietario
			$nombre_propietario = "";
			if(count($contacto)){
			$nombre_contacto = $contacto->nombre;
			$apellido_contacto = $contacto->apellido;
			$nombre_propietario = $nombre_contacto." ".$apellido_contacto;
			}

			$tipo_p = TypeProperty::where('company_id',$company->id )->where('activa',1)->where('id',$property->type_property_id)->first();
			$tipo = "";
			$tipo = $tipo_p->tipo_propiedad;

			//Armamos el array
			$propiedad = array($property->nro,$nombre_propietario,$tipo,$importe_total,$property->orden);
			$total = $total + $importe_total;
			array_push($resultado, $propiedad);

		}
		//dd($propiedad);
		return array("resultado"=>$resultado,"monto"=>$total);
	}
	
	function cuotasPropiedadArray ($anio,$mes,$array_inicial,$propiedad){
		$resultado = $array_inicial;
		$company = Auth::user()->company;

		$properties = Property::find($propiedad);
		$date_gestion_periodo = new \DateTime($anio.'-'.$mes.'-'.'02');
		$accountsreceivables = Accountsreceivable::where('company_id',$company->id )
					->where('cancelada',0)
					->where('property_id',$propiedad)
					->where('fecha_gestion_periodo','<=',$date_gestion_periodo)
					->orderBy('gestion', 'asc')->orderBy('periodo', 'asc')
					->get();
		$importe_total = 0;
		foreach ($accountsreceivables as $cuotapagar) {
			$cuota = array($cuotapagar->quota->cuota,$cuotapagar->gestion,$cuotapagar->periodo,$cuotapagar->importe_por_cobrar);
			array_push($resultado, $cuota);
			$importe_total = $importe_total + $cuotapagar->importe_por_cobrar;
		}


		$contacto = Contact::where('company_id',$company->id )->where('activa',1)->where('property_id',$propiedad)->where('typecontact_id',1)->first();

			//Obtenermos el nombre del propietario
			$nombre_propietario = "";
			if(count($contacto)){
			$nombre_contacto = $contacto->nombre;
			$apellido_contacto = $contacto->apellido;
			$nombre_propietario = $nombre_contacto." ".$apellido_contacto;
			}
			

		$montoTotalArray = array('Total','','',$importe_total);
		array_push($resultado, $montoTotalArray);

		return array("resultado"=>$resultado,"monto"=>$importe_total,"propiedad"=>$properties->nro,"propietario"=>$nombre_propietario);
	}
	
}
