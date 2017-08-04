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

class ReportEstadoActualController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
  }

	//Reporte de Estado de Resultados
	function estadoresultados(){
		$gestiones = Gestion::lists('nombre','nombre')->all();
		return view('reports.estadoresultados')->with('gestiones',$gestiones);
	}

	function estadoresultados_show(Request $request){
  		if($request->periodo == "actual"){
        $mes = date('m');
    		$anio = date('Y');
  			$estadoresultados_mesactual = $this->estadoresultados_mes($mes,$anio);
        if(empty($request->checkmesanterior)){
          return view('reports.estadoresultados_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_mesactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_mesactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_mesactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_mesactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_mesactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_mesactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"])
			->with('opcion','mes_actual');
        }else{
          $mes = (date('m') == 1) ? 12 : date('m')-1;
      	  $anio = (date('m') == 1) ? date('Y')-1 : date('Y');
          $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
		  //dd($estadoresultados_mesanterior["importe_total_egreso_extraordinario"]);
          return view('reports.estadoresultados_double_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_mesactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_mesactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_mesactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_mesactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_mesactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_mesactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"])
            //Perior anterior
            ->with('anterior_categorias_ingreso',$estadoresultados_mesanterior["categorias_ingreso"])
            ->with('anterior_importe_total_ingreso',$estadoresultados_mesanterior["importe_total_ingreso"])
            ->with('anterior_categorias_egreso_ordinario',$estadoresultados_mesanterior["categorias_egreso_ordinario"])
            ->with('anterior_importe_total_egreso_ordinario',$estadoresultados_mesanterior["importe_total_egreso_ordinario"])
            ->with('anterior_categorias_egreso_extraordinario',$estadoresultados_mesanterior["categorias_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso_extraordinario',$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
			->with('opcion','mes_actual_anterior');
        }


  		}elseif($request->periodo == "anterior"){

        $mes = (date('m') == 1) ? 12 : date('m')-1;
        $anio = (date('m') == 1) ? date('Y')-1 : date('Y');

        $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
        return view('reports.estadoresultados_show')
					->with('mes',$mes)
					->with('anio',$anio)
          ->with('categorias_ingreso',$estadoresultados_mesanterior["categorias_ingreso"])
          ->with('importe_total_ingreso',$estadoresultados_mesanterior["importe_total_ingreso"])
          ->with('categorias_egreso_ordinario',$estadoresultados_mesanterior["categorias_egreso_ordinario"])
          ->with('importe_total_egreso_ordinario',$estadoresultados_mesanterior["importe_total_egreso_ordinario"])
          ->with('categorias_egreso_extraordinario',$estadoresultados_mesanterior["categorias_egreso_extraordinario"])
          ->with('importe_total_egreso_extraordinario',$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
          ->with('importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
				->with('opcion','mes_anterior');
      }elseif($request->periodo == "gestionactual"){
        $mes = 0;
    		$anio = date('Y');
  			$estadoresultados_gestionactual = $this->estadoresultados_mes($mes,$anio);
        if(empty($request->checkgestionanterior)){
          return view('reports.estadoresultados_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_gestionactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionactual["importe_total_egreso_ordinario"]+$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
				  ->with('opcion','anio_actual');
        }else{
          $mes = 0;
      		$anio = date('Y')-1;
          $estadoresultados_gestionanterior = $this->estadoresultados_mes($mes,$anio);
		  //dd();
          return view('reports.estadoresultados_double_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_gestionactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionactual["importe_total_egreso_ordinario"]+$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            //Gestion anterior
            ->with('anterior_categorias_ingreso',$estadoresultados_gestionanterior["categorias_ingreso"])
            ->with('anterior_importe_total_ingreso',$estadoresultados_gestionanterior["importe_total_ingreso"])
            ->with('anterior_categorias_egreso_ordinario',$estadoresultados_gestionanterior["categorias_egreso_ordinario"])
            ->with('anterior_importe_total_egreso_ordinario',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"])
            ->with('anterior_categorias_egreso_extraordinario',$estadoresultados_gestionanterior["categorias_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso_extraordinario',$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"]+$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
				  ->with('opcion','anio_actual_anterior');
        }

      	}elseif($request->periodo == "gestionanterior"){
          $mes = 0;
          $anio = date('Y')-1;
          $estadoresultados_gestionanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_gestionanterior["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionanterior["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionanterior["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionanterior["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"]+$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
				  ->with('opcion','anio_anterior');

        }elseif($request->periodo == "mesygestion"){
          $mes = $request->mes;
          $anio = $request->anio;
          $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_mesanterior["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_mesanterior["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_mesanterior["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_mesanterior["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_mesanterior["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
				  ->with('opcion','mes_anio_opt_'.$mes.'_'.$anio);

        }elseif($request->periodo == "porgestion"){
          $mes = 0;
          $anio = $request->anio;
          $estadoresultados_gestion = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
						->with('mes',$mes)
						->with('anio',$anio)
            ->with('categorias_ingreso',$estadoresultados_gestion["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestion["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestion["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestion["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestion["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestion["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestion["importe_total_egreso_ordinario"]+$estadoresultados_gestion["importe_total_egreso_extraordinario"])
				  ->with('opcion','anio_opt_'.$anio);

        }
    }
	
	function estadoresultadosExcel($opcion){
		
		
		$opcion_mes_anio = explode('_opt_', $opcion);
		//dd($opcion_mes_anio[0]);
		if($opcion == 'mes_actual'){
			$mes = date('m');
			$anio = date('Y');
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}elseif($opcion == 'mes_actual_anterior'){
			$mes = date('m');
			$anio = date('Y');
			$mes_anterior = (date('m') == 1) ? 12 : date('m')-1;
      	    $anio_anterior = (date('m') == 1) ? date('Y')-1 : date('Y');
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,$mes_anterior,$anio_anterior);
		}elseif($opcion == 'mes_anterior'){
			$mes = (date('m') == 1) ? 12 : date('m')-1;
			$anio = (date('m') == 1) ? date('Y')-1 : date('Y');
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}elseif($opcion == 'anio_actual'){
			$mes = 0;
    		$anio = date('Y');
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}elseif($opcion == 'anio_actual_anterior'){
			$mes = 0;
    		$anio = date('Y');
			$mes_anterior = 0;
      		$anio_anterior = date('Y')-1;
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,$mes_anterior,$anio_anterior);
		}elseif($opcion == 'anio_anterior'){
			$mes = 0;
			$anio = date('Y')-1;
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}elseif($opcion_mes_anio[0] == 'mes_anio'){
			$mes_anio = explode('_', $opcion_mes_anio[1]);

			$mes = $mes_anio[0];
    		$anio = $mes_anio[1];
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}elseif($opcion_mes_anio[0] == 'anio'){

			$mes = 0;
    		$anio = $opcion_mes_anio[1];
			
			$resultado =  $this->reporteExcelEstadosActuales($mes,$anio,0,0);
		}

		Excel::create('Reporte_Estado_Actual', function($excel) use($resultado){
 
            $excel->sheet('Estado Resultados', function($sheet) use($resultado){
 
                //$cuentas = $this->cuentasporfechaExcel($fecha);
 
                $sheet->fromArray($resultado, null, 'A1', true, false);
 
            });
        })->export('xls');

	}
	
	function reporteExcelEstadosActuales($mes,$anio,$mes_anterior,$anio_anterior){
		
		if($mes_anterior == 0 && $anio_anterior==0){
		$estadoresultados_mesactual = $this->estadoresultados_mes($mes,$anio);
		$estadoResultado = array(array('Ingreso','','','','Porcentaje','Importe'));
		$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_ingreso"],$estadoresultados_mesactual["importe_total_ingreso"],$estadoResultado,null,null);
		$porcentajeTotal = ($estadoresultados_mesactual["importe_total_ingreso"] == 0)?0:100;
		$monto_total_ingreso =($estadoresultados_mesactual["importe_total_ingreso"]==0)?0:$estadoresultados_mesactual["importe_total_ingreso"];
		array_push($estadoResultado,array('Total','','','',$porcentajeTotal.'%',$monto_total_ingreso));
		array_push($estadoResultado,array('Gasto','','','','Porcentaje','Importe'));
		array_push($estadoResultado,array('Fijos','','','','',''));
		$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_egreso_ordinario"],$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"],$estadoResultado,null,null);
		array_push($estadoResultado,array('Variables','','','','',''));
		$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_egreso_extraordinario"],$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"],$estadoResultado,null,null);
		$porcentajeTotal = (($estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"]) == 0)?0:100;
		$monto_total_egreso = $estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
		$monto_total_egreso = ($monto_total_egreso == 0)?0:$monto_total_egreso;
		array_push($estadoResultado,array('Total','','','',$porcentajeTotal.'%',$monto_total_egreso));
		array_push($estadoResultado,array('Resultado','','','','','Importe'));
		$monto_total_ingreso = ($estadoresultados_mesactual["importe_total_ingreso"] == 0)?0:$estadoresultados_mesactual["importe_total_ingreso"];
		array_push($estadoResultado,array('Ingresos','','','','',$monto_total_ingreso));
		$monto_total_gastofijo = ($estadoresultados_mesactual["importe_total_egreso_ordinario"] == 0)?0:$estadoresultados_mesactual["importe_total_egreso_ordinario"];
		array_push($estadoResultado,array('Gastos fijos','','','','',$monto_total_gastofijo));
		$monto_total_gastovariable= ($estadoresultados_mesactual["importe_total_egreso_extraordinario"] == 0)?0:$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
		array_push($estadoResultado,array('Gastos variables','','','','',$monto_total_gastovariable));
		$diferencia_total = $estadoresultados_mesactual["importe_total_ingreso"]-$estadoresultados_mesactual["importe_total_egreso_ordinario"]-$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
		$diferencia_total = ($diferencia_total==0)?0:$diferencia_total;
		array_push($estadoResultado,array('Diferencia de periodo','','','','',$diferencia_total));
		}else{
			$estadoresultados_mesactual = $this->estadoresultados_mes($mes,$anio);
			$estadoresultados_anterior = $this->estadoresultados_mes($mes_anterior,$anio_anterior);
			$estadoResultado = array(array('Ingreso','','Porcentaje','Importe','Porcentaje','Importe'));
			$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_ingreso"],$estadoresultados_mesactual["importe_total_ingreso"],$estadoResultado,$estadoresultados_anterior["categorias_ingreso"],$estadoresultados_anterior["importe_total_ingreso"]);
			//dd($estadoResultado);
			$porcentajeTotal = ($estadoresultados_mesactual["importe_total_ingreso"] == 0)?0:100;
			$monto_total_ingreso =($estadoresultados_mesactual["importe_total_ingreso"]==0)?0:$estadoresultados_mesactual["importe_total_ingreso"];
			$porcentajeTotal_anterior = ($estadoresultados_anterior["importe_total_ingreso"] == 0)?0:100;
			$monto_total_ingreso_anterior =($estadoresultados_anterior["importe_total_ingreso"]==0)?0:$estadoresultados_anterior["importe_total_ingreso"];

			array_push($estadoResultado,array('Total','',$porcentajeTotal_anterior.'%',$monto_total_ingreso_anterior ,$porcentajeTotal.'%',$monto_total_ingreso));
			//EGRESOS
			array_push($estadoResultado,array('Gasto','','Porcentaje','Importe','Porcentaje','Importe'));
			array_push($estadoResultado,array('Fijos','','','','',''));
			
			$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_egreso_ordinario"],$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"],$estadoResultado,$estadoresultados_anterior["categorias_egreso_ordinario"],$estadoresultados_anterior["importe_total_egreso_ordinario"]+$estadoresultados_anterior["importe_total_egreso_extraordinario"]);
			array_push($estadoResultado,array('Variables','','','','',''));
			
			$estadoResultado = $this->llenadoArrayEstadoActual($estadoresultados_mesactual["categorias_egreso_extraordinario"],$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"],$estadoResultado,$estadoresultados_anterior["categorias_egreso_extraordinario"],$estadoresultados_anterior["importe_total_egreso_ordinario"]+$estadoresultados_anterior["importe_total_egreso_extraordinario"]);
			
			$porcentajeTotal = (($estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"]) == 0)?0:100;
			$monto_total_egreso = $estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
			$monto_total_egreso = ($monto_total_egreso==0)?0:$monto_total_egreso;
			
			$porcentajeTotal_anterior = (($estadoresultados_anterior["importe_total_egreso_ordinario"]+$estadoresultados_anterior["importe_total_egreso_extraordinario"]) == 0)?0:100;
			$monto_total_egreso_anterior = $estadoresultados_anterior["importe_total_egreso_ordinario"]+$estadoresultados_anterior["importe_total_egreso_extraordinario"];
			$monto_total_egreso_anterior = ($monto_total_egreso_anterior==0)?0:$monto_total_egreso_anterior;
			
			array_push($estadoResultado,array('Total','',$porcentajeTotal_anterior.'%',$monto_total_egreso_anterior,$porcentajeTotal.'%',$monto_total_egreso));
			array_push($estadoResultado,array('Resultado','','','Importe','','Importe'));
			$monto_total_ingreso = ($estadoresultados_mesactual["importe_total_ingreso"] == 0)?0:$estadoresultados_mesactual["importe_total_ingreso"];
			$monto_total_ingreso_anterior = ($estadoresultados_anterior["importe_total_ingreso"] == 0)?0:$estadoresultados_anterior["importe_total_ingreso"];
			array_push($estadoResultado,array('Ingresos','','',$monto_total_ingreso_anterior,'',$monto_total_ingreso));
			$monto_total_gastofijo = ($estadoresultados_mesactual["importe_total_egreso_ordinario"] == 0)?0:$estadoresultados_mesactual["importe_total_egreso_ordinario"];
			$monto_total_gastofijo_anterior = ($estadoresultados_anterior["importe_total_egreso_ordinario"] == 0)?0:$estadoresultados_anterior["importe_total_egreso_ordinario"];
			array_push($estadoResultado,array('Gastos fijos','','',$monto_total_gastofijo_anterior,'',$monto_total_gastofijo));
			$monto_total_gastovariable= ($estadoresultados_mesactual["importe_total_egreso_extraordinario"] == 0)?0:$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
			$monto_total_gastovariable_anterior= ($estadoresultados_anterior["importe_total_egreso_extraordinario"] == 0)?0:$estadoresultados_anterior["importe_total_egreso_extraordinario"];
			array_push($estadoResultado,array('Gastos variables','','',$monto_total_gastovariable_anterior,'',$monto_total_gastovariable));
			$diferencia_total = $estadoresultados_mesactual["importe_total_ingreso"]-$estadoresultados_mesactual["importe_total_egreso_ordinario"]-$estadoresultados_mesactual["importe_total_egreso_extraordinario"];
			$diferencia_total = ($diferencia_total==0)?0:$diferencia_total;
			
			$diferencia_total_anterior = $estadoresultados_anterior["importe_total_ingreso"]-$estadoresultados_anterior["importe_total_egreso_ordinario"]-$estadoresultados_anterior["importe_total_egreso_extraordinario"];
			$diferencia_total_anterior = ($diferencia_total_anterior==0)?0:$diferencia_total_anterior;
		
		
			array_push($estadoResultado,array('Diferencia de periodo','','',$diferencia_total_anterior,'',$diferencia_total));
		}
		return $estadoResultado;
	}
	//Funciones para reportes
  /*
  * Si se envia mes igual a 0 y anio igual a 0 entonces no tomara la condicion
  */
	function estadoresultados_mes($mes,$anio){
  		//Ingresos
  		//$mes = date('m');
  		//$anio = date('Y');
  		$company = Auth::user()->company;
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Ingreso')->orderBy('nombre', 'asc')->get();
  		$categorias_ingreso = array();
  		$importe_total_ingresos = 0;
  		foreach($categories as $category){

				
			
  			$categoria =DB::table('accountsreceivables')
  						->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
  						->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
  						->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
  						->join('categories', 'categories.id', '=', 'quotas.category_id')
  						->where('category_id', '=', $category->id)
						->where('accountsreceivables.company_id',$company->id)
  						->where('cancelada',1)
  						->where('anulada',0)
  						->where('excluir_reportes',0)
						->orderBy('fecha_pago', 'asc');

			

         if($mes != 0) $categoria->whereMonth('fecha_pago', '=', $mes);
         if($anio != 0) $categoria->whereYear('fecha_pago', '=', $anio);
         $resultado = $categoria->sum('importe_por_cobrar');

  			$importe_categoria = (is_null($resultado)) ? 0 : $resultado;

  			$datos_categoria = array('nombre'=>$category->nombre,'monto'=>$importe_categoria);
  			$importe_total_ingresos = $importe_total_ingresos+$importe_categoria;
  			array_push($categorias_ingreso, $datos_categoria);
  		}
  		//Egresos Ordinarios/Fijos
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('clase','Ordinaria')->orderBy('nombre', 'asc')->get();
  		$categorias_egreso_ordinario = array();
  		$importe_total_egreso_ordinario = 0;
  		foreach($categories as $category){
  			$expense = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->where('category_id',$category->id)
  					->where('anulada',0)
  					->where('excluir_reportes',0);

        if($mes != 0) $expense->whereMonth('fecha_pago', '=', $mes);
        if($anio != 0) $expense->whereYear('fecha_pago', '=', $anio);

  			$resultado = $expense->sum('importe_debito');
  			$importe_categoria = (is_null($resultado)) ? 0 : $resultado;
  			$datos_categoria = array('nombre'=>$category->nombre,'monto'=>$importe_categoria);
  			$importe_total_egreso_ordinario = $importe_total_egreso_ordinario+$importe_categoria;
  			array_push($categorias_egreso_ordinario, $datos_categoria);
  		}
  		//Egresos Ordinarios/Fijos
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('clase','Extraordinaria')->orderBy('nombre', 'asc')->get();
  		$categorias_egreso_extraordinario = array();
  		$importe_total_egreso_extraordinario = 0;
  		foreach($categories as $category){
        $expense = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->where('category_id',$category->id)
  					->where('anulada',0)
  					->where('excluir_reportes',0);

        if($mes != 0) $expense->whereMonth('fecha_pago', '=', $mes);
        if($anio != 0) $expense->whereYear('fecha_pago', '=', $anio);

  			$resultado = $expense->sum('importe_debito');

  			$importe_categoria = (is_null($resultado)) ? 0 : $resultado;
  			$datos_categoria = array('nombre'=>$category->nombre,'monto'=>$importe_categoria);
  			$importe_total_egreso_extraordinario = $importe_total_egreso_extraordinario+$importe_categoria;
  			array_push($categorias_egreso_extraordinario, $datos_categoria);
  		}

  		$estadoderesumen = array(
  			"categorias_ingreso"=>$categorias_ingreso,
  			"importe_total_ingreso"=>$importe_total_ingresos,
  			"categorias_egreso_ordinario"=>$categorias_egreso_ordinario,
  			"importe_total_egreso_ordinario"=>$importe_total_egreso_ordinario,
  			"categorias_egreso_extraordinario"=>$categorias_egreso_extraordinario,
  			"importe_total_egreso_extraordinario"=>$importe_total_egreso_extraordinario,
  	  );

  		return $estadoderesumen;
  	}

	
	function llenadoArrayEstadoActual($datosArray,$total,$baseArray,$datosArrayAn,$totalAn){
		$estadoResultado=$baseArray;
  		
		$estadoactual_ingreso = $datosArray;
		$estadoactual_ingreso_monto_total = $total;
		$estadoactual_ingreso_anterior = $datosArrayAn;
		$estadoactual_ingreso_monto_total_anterior = $totalAn;
		//dd($estadoactual_ingreso[0]['nombre']);
		if(is_null($estadoactual_ingreso_anterior)){
			for ($i = 0; $i < count($estadoactual_ingreso); $i++) {
				//number_format($categorias_ingreso[$i]['monto']/$importe_total_ingreso*100,2)
				if($estadoactual_ingreso_monto_total != 0){
					$porcentaje = number_format($estadoactual_ingreso[$i]['monto']/$estadoactual_ingreso_monto_total*100,2);
					$porcentajeTotal = 100;
				}else{
					$porcentaje = 0;
					$porcentajeTotal = 0;
				}
				$monto_actual = ($estadoactual_ingreso[$i]['monto'] == 0) ? 0 : $estadoactual_ingreso[$i]['monto'];
				array_push($estadoResultado, array($estadoactual_ingreso[$i]['nombre'],'','','',$porcentaje.'%',$monto_actual));
			}
		}else{
			for ($i = 0; $i < count($estadoactual_ingreso); $i++) {
				//number_format($categorias_ingreso[$i]['monto']/$importe_total_ingreso*100,2)
				if($estadoactual_ingreso_monto_total != 0){
					$porcentaje = number_format($estadoactual_ingreso[$i]['monto']/$estadoactual_ingreso_monto_total*100,2);

				}else{
					$porcentaje = 0;

				}
				
				if($estadoactual_ingreso_monto_total_anterior != 0){
					$porcentaje_anterior = number_format($estadoactual_ingreso_anterior[$i]['monto']/$estadoactual_ingreso_monto_total_anterior*100,2);

				}else{
					$porcentaje_anterior=0;

				}
				$monto_actual = ($estadoactual_ingreso[$i]['monto'] == 0) ? 0 : $estadoactual_ingreso[$i]['monto'];
				$monto_anterior = ($estadoactual_ingreso_anterior[$i]['monto'] == 0) ? 0 : $estadoactual_ingreso_anterior[$i]['monto'];
				array_push($estadoResultado, array($estadoactual_ingreso[$i]['nombre'],'',$porcentaje_anterior.'%',$monto_anterior,$porcentaje.'%',$monto_actual));
			}
		}
		return $estadoResultado;
	}
}
