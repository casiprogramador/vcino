<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gestion;
use App\Category;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ReportCategoriaPeriodoGestionController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
    function categoriaperiodogestion(){
		$gestiones = Gestion::lists('nombre','nombre')->all();
		return view('reports.categoriaperiodogestion')->with('gestiones',$gestiones);
	}
	
	function categoriaperiodogestion_show(Request $request){
		//dd($request);
		$anio = $request->anio;
		$categorias_resultado = array();
		$categorias_resultado = $this->categoriaperiodogestion_array($anio,$categorias_resultado);
		

		return view('reports.categoriaperiodogestion_show')
				->with('categorias',$categorias_resultado)
				->with('gestion',$anio);
	}
	
	function categoriaperiodogestion_excel($gestion){
		//dd($request);
		$anio = $gestion;
		
		//dd($categorias_resultado);
		$resultado_array = array(array("Categoria","ENE","FEB","MAR","ABR","MAY","JUN","JUL","AGO","SEP","OCT","NOV","DIC","TOTAL"));
		$categorias_resultado = $this->categoriaperiodogestion_array($anio,$resultado_array);
		
		Excel::create('Reporte_Categoira_por_PeriodoGestion', function($excel) use($categorias_resultado){
 
            $excel->sheet('Reporte', function($sheet) use($categorias_resultado){
 
 
                $sheet->fromArray($categorias_resultado, null, 'A1', true, false);
				$sheet->row(1, function($row) {

					$row->setBackground('#D6D6D6');

				});
 
            });
        })->export('xls');

	}
	
	//FUNCIONES AUXILIARES
	function categoriaperiodogestion_array($anio,$resultado_ini){
		$company = Auth::user()->company;
		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->orderBy('nombre', 'asc')->get();
		
		
		$resultado = $resultado_ini;
		foreach($categories as $category){
			$ene = $this->montoPorCategoriaMesyGestion($category->id,1,$anio);
			$feb = $this->montoPorCategoriaMesyGestion($category->id,2,$anio);
			$mar = $this->montoPorCategoriaMesyGestion($category->id,3,$anio);
			$abr = $this->montoPorCategoriaMesyGestion($category->id,4,$anio);
			$may = $this->montoPorCategoriaMesyGestion($category->id,5,$anio);
			$jun = $this->montoPorCategoriaMesyGestion($category->id,6,$anio);
			$jul = $this->montoPorCategoriaMesyGestion($category->id,7,$anio);
			$ago = $this->montoPorCategoriaMesyGestion($category->id,8,$anio);
			$sep = $this->montoPorCategoriaMesyGestion($category->id,9,$anio);
			$oct = $this->montoPorCategoriaMesyGestion($category->id,10,$anio);
			$nov = $this->montoPorCategoriaMesyGestion($category->id,11,$anio);
			$dic = $this->montoPorCategoriaMesyGestion($category->id,12,$anio);
			$total = $ene+$feb+$mar+$abr+$may+$jun+$jul+$ago+$sep+$oct+$nov+$dic;
			$categoria = array($category->nombre,$ene,$feb,$mar,$abr,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic,$total);
			array_push($resultado, $categoria);
			
		}
		$ene_tot = $this->montoTotalCategoriaMesyGestion(1,$anio);
		$feb_tot = $this->montoTotalCategoriaMesyGestion(2,$anio);
		$mar_tot = $this->montoTotalCategoriaMesyGestion(3,$anio);
		$abr_tot = $this->montoTotalCategoriaMesyGestion(4,$anio);
		$may_tot = $this->montoTotalCategoriaMesyGestion(5,$anio);
		$jun_tot = $this->montoTotalCategoriaMesyGestion(6,$anio);
		$jul_tot = $this->montoTotalCategoriaMesyGestion(7,$anio);
		$ago_tot = $this->montoTotalCategoriaMesyGestion(8,$anio);
		$sep_tot = $this->montoTotalCategoriaMesyGestion(9,$anio);
		$oct_tot = $this->montoTotalCategoriaMesyGestion(10,$anio);
		$nov_tot = $this->montoTotalCategoriaMesyGestion(11,$anio);
		$dic_tot = $this->montoTotalCategoriaMesyGestion(12,$anio);
		
		$total_total =$ene_tot+$feb_tot+$mar_tot+$abr_tot+$may_tot+$jun_tot+$jul_tot+$ago_tot+$sep_tot+$oct_tot+$nov_tot+$dic_tot;
		$categoria_total = array('Total',$ene_tot,$feb_tot,$mar_tot,$abr_tot,$may_tot,$jun_tot,$jul_tot,$ago_tot,$sep_tot,$oct_tot,$nov_tot,$dic_tot,$total_total);
		array_push($resultado, $categoria_total);
			
		return $resultado;
	}
	
	function montoPorCategoriaMesyGestion($id_categoria,$mes,$anio){

        $gasto = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->where('category_id',$id_categoria)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
					->whereMonth('fecha_pago', '=', $mes)
					->whereYear('fecha_pago', '=', $anio)
					->sum('importe_debito');

  		$monto_categoria = (is_null($gasto)) ? 0 : $gasto;
  		
		return $monto_categoria;

	}
	
	function montoTotalCategoriaMesyGestion($mes,$anio){
		$company = Auth::user()->company;
        $gasto = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
					->where('company_id',$company->id)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
					->whereMonth('fecha_pago', '=', $mes)
					->whereYear('fecha_pago', '=', $anio)
					->sum('importe_debito');

  		$monto_total = (is_null($gasto)) ? 0 : $gasto;
  		
		return $monto_total;

	}
	
	function montoTotalCategoria($id_categoria){

        $gasto = DB::table('expenses')
  					->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
  					->where('category_id',$id_categoria)
  					->where('anulada',0)
  					->where('excluir_reportes',0)
					->sum('importe_debito');

  		$monto_categoria = (is_null($gasto)) ? 0 : $gasto;
  		
		return $monto_categoria;

	}
}
