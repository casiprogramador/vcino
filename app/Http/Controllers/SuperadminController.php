<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Company;
use App\Http\Requests;

class SuperadminController extends Controller
{
    function index(){
		 return view('auth/loginadmin');
	}
	
	public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password,'rol'=>'superadmin'])) {
            // Authentication passed...
            //return redirect()->intended('dashboard');
			$companies = Company::orderBy('id', 'asc')->lists('nombre','id')->all();

			return view('superadmin.index')->with('companies',$companies);
        }
		return redirect('administrator');
    }
	
	public function home(Request $request){
		
		$company = Company::find($request->company);
		Auth::loginUsingId($company->user_id);
		return redirect('admin');
	}
}
