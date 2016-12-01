<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Property;
use App\Quota;

class AccountsReceivableController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;

        return view('accountsreceivables.index');
    }

    public function create()
    {
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
        return view('accountsreceivables.create')
		->with('properties',$properties)
		->with('quotas',$quotas);
    }
	
	public function generate()
    {
        return view('accountsreceivables.generate');
    }
	
	public function send()
    {
        return view('accountsreceivables.send');
    }
}
