<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ReportCategoriaPeriodoGestionController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
    function categoriaperiodogestion(){
		return view('reports.categoriaperiodogestion');
	}
}
