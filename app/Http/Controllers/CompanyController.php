<?php

namespace App\Http\Controllers;
use Auth;
use App\Company;
use Illuminate\Http\Request;

use App\Http\Requests;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
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
            'direccion' => 'required',
            'telefono' => 'required',
            'dias_mora' => 'required',
        ]);
		
		if(!empty($request->icono)){
            $user_id = Auth::user()->id;
            $file = $request->file('logo');
            $tmpFilePath = '/img/upload/';
            $tmpFileName = time() . 'logo-empresa-'.$user_id. '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
        }

        $company = new Company();
        $company->nombre = $request->nombre;
        $company->direccion = $request->direccion;
        $company->telefono = $request->telefono;
		if(!empty($request->icono)){
        $company->logotipo = $path;
		}
        $company->dias_mora = $request->dias_mora;
        $company->user_id = Auth::user()->id;

        $company->save();

        return redirect('admin');
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
        //
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
        //
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
