<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\ModelsSupport\Typecontact;
use App\Property;
use App\UserMobile;
use App\Http\Requests;

class MovilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$company = Auth::user()->company;
        $users = UserMobile::where('company_id',$company->id );
        return view('movil.index')->with('users',$users->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id');
		$typecontacts = Typecontact::all()->lists('nombre','id');
        return view('movil.create')
		->with('properties',$properties)
		->with('typecontacts',$typecontacts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
			'nro_mobile'=> 'required|integer',
			'email'=> 'required',
			'sistema'=> 'required',
			'estado'=> 'required',
			'password'=> 'required|min:6|confirmed',
			'typecontact' => 'required|not_in:0',
			'property' => 'required|not_in:0',

        ]);
		
		$company = Auth::user()->company;
		$userMobile = new UserMobile();

		$userMobile->nombre = $request->nombre;
		$userMobile->apellido = $request->apellido;
		$userMobile->nro_movil = $request->nro_mobile;
		$userMobile->email = $request->email;
		$userMobile->password = bcrypt($request->password);
		$userMobile->sistema= $request->sistema;
		$userMobile->estado = $request->estado;
		$userMobile->company_id = $company->id;
		$userMobile->property_id = $request->property;
		$userMobile->typecontact_id = $request->typecontact;
		$userMobile->api_token = str_random(50);
		$userMobile->save();
		
		return redirect()->route('movil.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id');
		$typecontacts = Typecontact::all()->lists('nombre','id');
		$user = UserMobile::find($id);
        return view('movil.edit')
		->with('properties',$properties)
		->with('typecontacts',$typecontacts)
		->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
