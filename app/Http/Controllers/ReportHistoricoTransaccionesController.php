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

class ReportHistoricoTransaccionesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
	
	function historicotransacciones(){
		return view('reports.historicotransacciones');
	}
}
