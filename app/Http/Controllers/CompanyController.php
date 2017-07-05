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
			'pago' => 'required',
			'forma_pago'=> 'required',
        ]);
		
		if(!empty($request->logotipo)){
            $user_id = Auth::user()->id;
            $file = $request->file('logotipo');
            $tmpFilePath = '/img/upload/';
            $tmpFileName = time() . 'logo-empresa-'.$user_id. '-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
        }else{
			$path = 'img/system/logo_empresa.jpg';
		}

        $company = new Company();
        $company->nombre = $request->nombre;
        $company->direccion = $request->direccion;
        $company->telefono = $request->telefono;

        $company->logotipo = $path;

        $company->dias_mora = $request->dias_mora;
		$company->email_prueba = $request->email_prueba;
		$company->forma_pago = $request->forma_pago;
		$company->pago = $request->pago;
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
