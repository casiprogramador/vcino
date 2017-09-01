<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Quota;
use App\Http\Requests;
use App\Gestion;
use App\Property;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportEstadoCobranzasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
	}
  
	function estadocobranzas(){
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->orderBy('cuota', 'asc')->lists('cuota','id')->all();
		$gestiones = Gestion::lists('nombre','nombre')->all();
		return view('reports.estadocobranzas')->with('gestiones',$gestiones)->with('cuotas',$quotas);
	}

	function estadocobranzas_show(Request $request){
		$this->validate($request, [
            'anio' => 'required',
            'cuotas' => 'required'
        ]);
		
		
		$cuotas = $request->cuotas;
		if(count($cuotas) == 1){
			if($cuotas[0] == 'todas'){
				$tipo_cuotas = 'todas';
				$opcion_cuotas = 'todas';
				
			}else{
				$tipo_cuotas = $cuotas;
			}
			
		}else{
			if (($key = array_search('todas', $cuotas)) !== false) {
				unset($cuotas[$key]);
			}
			$tipo_cuotas = $cuotas;
		}
		
		if($tipo_cuotas == 'todas'){
			$nombre_cuotas = 'Todas';
			$opcion_cuota = 'todas';
		}else{
			$opcion_cuota = implode('-', $tipo_cuotas);
			$nombre_cuotas = array();
			foreach ($tipo_cuotas as $cuota) {
				$quota = Quota::find($cuota);
				$nombre_cuota = $quota->cuota;
				array_push($nombre_cuotas, $nombre_cuota);
				
			}
			$nombre_cuotas = implode(',', $nombre_cuotas);
		}

		
		$anio_opcion =  $request->anio;
		$opcion = $anio_opcion.'-cat-'.$opcion_cuota;
		//$monto = $this->montoTotalPropiedadGestion(4,2017,29,1,$tipo_cuotas);
		//dd($monto);
		$cuotas_resultado = $this->estadocobranzas_array(array(),$request->anio,$tipo_cuotas);
		//dd($cuotas_resultado['total']);
		return view('reports.estadocobranzas_show')
				->with('propiedades',$cuotas_resultado['resultado'])
				->with('total',$cuotas_resultado['total'])
				->with('gestion',$request->anio)
				->with('cuotas',$nombre_cuotas)
				->with('opcion',$opcion);
	}
	
	function estadocobranzasExcel($opcion){
		$opcion_array = explode('-cat-', $opcion);

		$anio = $opcion_array[0];
		$cuotas = $opcion_array[1];
		$cuotas_array = explode('-', $cuotas);

		if($cuotas === 'todas'){
			$resultado_cuotas = $this->estadocobranzas_array_excel($anio,$cuotas);
		}else{
			$resultado_cuotas = $this->estadocobranzas_array_excel($anio,$cuotas_array);
		}
		
		Excel::create('Reporte_Estado_Cobranzas', function($excel) use($resultado_cuotas){
 
            $excel->sheet('Reporte', function($sheet) use($resultado_cuotas){
 
 
                $sheet->fromArray($resultado_cuotas, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');
		
	}
			
	function estadocobranzas_array($resultado_ini,$anio,$cuotas){
		$company = Auth::user()->company;
		$properties = Property::orderBy('orden','asc')->where('company_id',$company->id )->get();
		$resultado = $resultado_ini;
		
		$ene_sum = 0;
		$feb_sum  = 0;
		$mar_sum  = 0;
		$abr_sum  = 0;
		$may_sum  = 0;
		$jun_sum  = 0;
		$jul_sum  = 0;
		$ago_sum  = 0;
		$sep_sum  = 0;
		$oct_sum  = 0;
		$nov_sum  = 0;
		$dic_sum  = 0;
		foreach($properties as $property){
			
			$ene = $this->montoTotalPropiedadGestion(1,$anio,$property->id,1,$cuotas);
			$feb = $this->montoTotalPropiedadGestion(2,$anio,$property->id,1,$cuotas);
			$mar = $this->montoTotalPropiedadGestion(3,$anio,$property->id,1,$cuotas);
			$abr = $this->montoTotalPropiedadGestion(4,$anio,$property->id,1,$cuotas);
			$may = $this->montoTotalPropiedadGestion(5,$anio,$property->id,1,$cuotas);
			$jun = $this->montoTotalPropiedadGestion(6,$anio,$property->id,1,$cuotas);
			$jul = $this->montoTotalPropiedadGestion(7,$anio,$property->id,1,$cuotas);
			$ago = $this->montoTotalPropiedadGestion(8,$anio,$property->id,1,$cuotas);
			$sep = $this->montoTotalPropiedadGestion(9,$anio,$property->id,1,$cuotas);
			$oct = $this->montoTotalPropiedadGestion(10,$anio,$property->id,1,$cuotas);
			$nov = $this->montoTotalPropiedadGestion(11,$anio,$property->id,1,$cuotas);
			$dic = $this->montoTotalPropiedadGestion(12,$anio,$property->id,1,$cuotas);
			
			
			
			$ene_total = $this->montoTotalPropiedadGestion(1,$anio,$property->id,'todas',$cuotas);
			$feb_total = $this->montoTotalPropiedadGestion(2,$anio,$property->id,'todas',$cuotas);
			$mar_total = $this->montoTotalPropiedadGestion(3,$anio,$property->id,'todas',$cuotas);
			$abr_total = $this->montoTotalPropiedadGestion(4,$anio,$property->id,'todas',$cuotas);
			$may_total = $this->montoTotalPropiedadGestion(5,$anio,$property->id,'todas',$cuotas);
			$jun_total = $this->montoTotalPropiedadGestion(6,$anio,$property->id,'todas',$cuotas);
			$jul_total = $this->montoTotalPropiedadGestion(7,$anio,$property->id,'todas',$cuotas);
			$ago_total = $this->montoTotalPropiedadGestion(8,$anio,$property->id,'todas',$cuotas);
			$sep_total = $this->montoTotalPropiedadGestion(9,$anio,$property->id,'todas',$cuotas);
			$oct_total = $this->montoTotalPropiedadGestion(10,$anio,$property->id,'todas',$cuotas);
			$nov_total = $this->montoTotalPropiedadGestion(11,$anio,$property->id,'todas',$cuotas);
			$dic_total = $this->montoTotalPropiedadGestion(12,$anio,$property->id,'todas',$cuotas);
			
			$ene_sum = $ene_sum +$ene;
			$feb_sum = $feb_sum +$feb;
			$mar_sum = $mar_sum+$mar;
			$abr_sum = $abr_sum+$abr;
			$may_sum = $may_sum+$may;
			$jun_sum = $jun_sum+$jun;
			$jul_sum = $jul_sum+$jul;
			$ago_sum = $ago_sum+$ago;
			$sep_sum = $sep_sum+$sep;
			$oct_sum = $oct_sum+$oct;
			$nov_sum = $nov_sum+$nov;
			$dic_sum = $dic_sum+$dic;
			
			$ene_final = ($ene == $ene_total)?$ene:$ene.'*';
			$feb_final = ($feb == $feb_total)?$feb:$feb.'*';
			$mar_final = ($mar == $mar_total)?$mar:$mar.'*';
			$abr_final = ($abr == $abr_total)?$abr:$abr.'*';
			$may_final = ($may == $may_total)?$may:$may.'*';
			$jun_final = ($jun == $jun_total)?$jun:$jun.'*';
			$jul_final = ($jul == $jul_total)?$jul:$jul.'*';
			$ago_final = ($ago == $ago_total)?$ago:$ago.'*';
			$sep_final = ($sep == $sep_total)?$sep:$sep.'*';
			$oct_final = ($oct == $oct_total)?$oct:$oct.'*';
			$nov_final = ($nov == $nov_total)?$nov:$nov.'*';
			$dic_final = ($dic == $dic_total)?$dic:$dic.'*';
			
			$propiedad = array($property->nro,$ene_final,$feb_final,$mar_final,$abr_final,$may_final,$jun_final,$jul_final,$ago_final,$sep_final,$oct_final,$nov_final,$dic_final);
			//dd($propiedad);
			array_push($resultado, $propiedad);
			
		}
		
		$mes_total = array('Total',$ene_sum,$feb_sum,$mar_sum,$abr_sum,$may_sum,$jun_sum,$jul_sum,$ago_sum,$sep_sum,$oct_sum,$nov_sum,$dic_sum);
		
		return array('resultado'=>$resultado, 'total'=>$mes_total);
	}
	
	function montoTotalPropiedadGestion($mes,$anio,$propiedad,$cancelada,$cuotas){
		$company = Auth::user()->company;
		
		$monto = DB::table('accountsreceivables')
					->where('company_id',$company->id)
					->where('property_id',$propiedad);
		
  		if($cancelada !== 'todas') $monto = $monto->where('cancelada',$cancelada); 	
		if($cuotas !== 'todas') $monto->whereIn('quota_id', $cuotas);
		$monto = $monto->where('periodo',$mes)
					->where('gestion',$anio)
					->sum('importe_por_cobrar');

  		$monto_total = (is_null($monto)) ? 0 : $monto;
  		
		return $monto_total;
	}
	
	function estadocobranzas_array_excel($anio,$cuotas){
		$init_array = array(array('PROPIEDAD',"ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC"));
		$cuotas_resultado = $this->estadocobranzas_array($init_array,$anio,$cuotas);
		$propiedades = $cuotas_resultado['resultado'];
		$total = $cuotas_resultado['total'];
		array_push($propiedades, $total);
		return $propiedades;
	}
	
}
