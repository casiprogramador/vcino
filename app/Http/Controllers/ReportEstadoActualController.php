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
            ->with('categorias_ingreso',$estadoresultados_mesactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_mesactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_mesactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_mesactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_mesactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_mesactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_mesactual["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"]);
        }else{
          $mes = (date('m') == 1) ? 12 : date('m');
      		$anio = (date('m') == 1) ? date('Y')-1 : date('Y');
          $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_double_show')
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
            ->with('anterior_importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesactual["importe_total_egreso_extraordinario"]);
        }


  		}elseif($request->periodo == "anterior"){

        $mes = (date('m') == 1) ? 12 : date('m')-1;
        $anio = (date('m') == 1) ? date('Y')-1 : date('Y');

        $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
        return view('reports.estadoresultados_show')
          ->with('categorias_ingreso',$estadoresultados_mesanterior["categorias_ingreso"])
          ->with('importe_total_ingreso',$estadoresultados_mesanterior["importe_total_ingreso"])
          ->with('categorias_egreso_ordinario',$estadoresultados_mesanterior["categorias_egreso_ordinario"])
          ->with('importe_total_egreso_ordinario',$estadoresultados_mesanterior["importe_total_egreso_ordinario"])
          ->with('categorias_egreso_extraordinario',$estadoresultados_mesanterior["categorias_egreso_extraordinario"])
          ->with('importe_total_egreso_extraordinario',$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
          ->with('importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesanterior["importe_total_egreso_extraordinario"]);
      }elseif($request->periodo == "gestionactual"){
        $mes = 0;
    		$anio = date('Y');
  			$estadoresultados_gestionactual = $this->estadoresultados_mes($mes,$anio);
        if(empty($request->checkgestionanterior)){
          return view('reports.estadoresultados_show')
            ->with('categorias_ingreso',$estadoresultados_gestionactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionactual["importe_total_egreso_ordinario"]+$estadoresultados_gestionactual["importe_total_egreso_extraordinario"]);
        }else{
          $mes = 0;
      		$anio = date('Y')-1;
          $estadoresultados_gestionanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_double_show')
            ->with('categorias_ingreso',$estadoresultados_gestionactual["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionactual["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionactual["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionactual["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionactual["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionactual["importe_total_egreso_ordinario"]+$estadoresultados_gestionactual["importe_total_egreso_extraordinario"])
            //Perior anterior
            ->with('anterior_categorias_ingreso',$estadoresultados_gestionanterior["categorias_ingreso"])
            ->with('anterior_importe_total_ingreso',$estadoresultados_gestionanterior["importe_total_ingreso"])
            ->with('anterior_categorias_egreso_ordinario',$estadoresultados_gestionanterior["categorias_egreso_ordinario"])
            ->with('anterior_importe_total_egreso_ordinario',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"])
            ->with('anterior_categorias_egreso_extraordinario',$estadoresultados_gestionanterior["categorias_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso_extraordinario',$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
            ->with('anterior_importe_total_egreso',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"]+$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"]);
        }

      	}elseif($request->periodo == "gestionanterior"){
          $mes = 0;
          $anio = date('Y')-1;
          $estadoresultados_gestionanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
            ->with('categorias_ingreso',$estadoresultados_gestionanterior["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestionanterior["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestionanterior["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestionanterior["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestionanterior["importe_total_egreso_ordinario"]+$estadoresultados_gestionanterior["importe_total_egreso_extraordinario"]);

        }elseif($request->periodo == "mesygestion"){
          $mes = $request->mes;
          $anio = $request->anio;
          $estadoresultados_mesanterior = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
            ->with('categorias_ingreso',$estadoresultados_mesanterior["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_mesanterior["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_mesanterior["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_mesanterior["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_mesanterior["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_mesanterior["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_mesanterior["importe_total_egreso_ordinario"]+$estadoresultados_mesanterior["importe_total_egreso_extraordinario"]);

        }elseif($request->periodo == "porgestion"){
          $mes = 0;
          $anio = $request->anio;
          $estadoresultados_gestion = $this->estadoresultados_mes($mes,$anio);
          return view('reports.estadoresultados_show')
            ->with('categorias_ingreso',$estadoresultados_gestion["categorias_ingreso"])
            ->with('importe_total_ingreso',$estadoresultados_gestion["importe_total_ingreso"])
            ->with('categorias_egreso_ordinario',$estadoresultados_gestion["categorias_egreso_ordinario"])
            ->with('importe_total_egreso_ordinario',$estadoresultados_gestion["importe_total_egreso_ordinario"])
            ->with('categorias_egreso_extraordinario',$estadoresultados_gestion["categorias_egreso_extraordinario"])
            ->with('importe_total_egreso_extraordinario',$estadoresultados_gestion["importe_total_egreso_extraordinario"])
            ->with('importe_total_egreso',$estadoresultados_gestion["importe_total_egreso_ordinario"]+$estadoresultados_gestion["importe_total_egreso_extraordinario"]);

        }
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
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Ingreso')->get();
  		$categorias_ingreso = array();
  		$importe_total_ingresos = 0;
  		foreach($categories as $category){


  			$categoria =DB::table('accountsreceivables')
  						->join('collections', 'collections.id', '=', 'accountsreceivables.id_collection')
  						->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
  						->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
  						->join('categories', 'categories.id', '=', 'quotas.category_id')
  						->where('category_id', '=', $category->id)
  						->where('cancelada',1)
  						->where('anulada',0)
  						->where('excluir_reportes',0);

         if($mes != 0) $categoria->whereMonth('fecha_pago', '=', $mes);
         if($anio != 0) $categoria->whereYear('fecha_pago', '=', $anio);
         $resultado = $categoria->sum('importe_por_cobrar');

  			$importe_categoria = (is_null($resultado)) ? 0 : $resultado;

  			$datos_categoria = array('nombre'=>$category->nombre,'monto'=>$importe_categoria);
  			$importe_total_ingresos = $importe_total_ingresos+$importe_categoria;
  			array_push($categorias_ingreso, $datos_categoria);
  		}
  		//Egresos Ordinarios/Fijos
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('clase','Ordinaria')->get();
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
  		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('clase','Extraordinaria')->get();
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

}
