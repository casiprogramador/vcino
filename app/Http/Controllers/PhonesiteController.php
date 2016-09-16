<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Phonesite;
use App\Http\Requests;

class PhonesiteController extends Controller
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
        $company = Auth::user()->company;

        $phonesites = Phonesite::where('company_id',$company->id );
        return view('phonesites.index')->with('phonesites',$phonesites->get());
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('phonesites.create');
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
            'razon_social' => 'required',
            'categoria' => 'required|not_in:0',
            'telefono' => 'required',
            'email' => 'email',
            'sitio_web' => 'url',
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $phonesite = new Phonesite();
        $phonesite->razon_social = $request->razon_social;
        $phonesite->categoria = $request->categoria;
        $phonesite->telefono = $request->telefono;
        $phonesite->telefono_emergencia = $request->telefono_emergencia;
        $phonesite->email = $request->email;
        $phonesite->sitio_web = $request->sitio_web;
        $phonesite->direccion = $request->direccion;
        $phonesite->notas = $request->notas;
        $phonesite->activa = $activa;
        $phonesite->company_id = $company->id;

        $phonesite->save();
        Session::flash('message', 'Nuevo telefono o sitio ingresado correctamente');
        return redirect()->route('config.phonesite.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $phonesite = Phonesite::find($id);
        return view('phonesites.show')
            ->with('phonesite',$phonesite);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $phonesite = Phonesite::find($id);
        return view('phonesites.edit')
            ->with('phonesite',$phonesite);
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
        $this->validate($request, [
            'razon_social' => 'required',
            'categoria' => 'required|not_in:0',
            'telefono' => 'required',
            'email' => 'email',
            'sitio_web' => 'url',
        ]);

        $activa = (empty($request->activa) ? '0' : $request->activa);

        $phonesite = Phonesite::find($id);
        $phonesite->razon_social = $request->razon_social;
        $phonesite->categoria = $request->categoria;
        $phonesite->telefono = $request->telefono;
        $phonesite->telefono_emergencia = $request->telefono_emergencia;
        $phonesite->email = $request->email;
        $phonesite->sitio_web = $request->sitio_web;
        $phonesite->direccion = $request->direccion;
        $phonesite->notas = $request->notas;
        $phonesite->activa = $activa;

        $phonesite->save();
        Session::flash('message', 'Telefono o sitio actualizado correctamente');
        return redirect()->route('config.phonesite.index');
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
