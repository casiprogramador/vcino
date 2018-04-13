<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
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
			dd('administrador autorizado');
        }
		return redirect('administrator');
    }
}
