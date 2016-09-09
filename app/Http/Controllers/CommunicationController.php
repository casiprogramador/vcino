<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Phonesite;

class CommunicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function phonesite()
    {
        $company = Auth::user()->company;

        $phonesites = Phonesite::where('company_id',$company->id );
        return view('communications.phonesites')->with('phonesites',$phonesites->get());
    }

}
