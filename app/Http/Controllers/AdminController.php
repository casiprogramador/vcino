<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use Redis;
use App\Http\Requests;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;
        //Redis::set('user', 'Taylor');
        Session::set('company_name', $company->nombre);

        return view('admin');
    }
}
