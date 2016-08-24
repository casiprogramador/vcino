<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TypeProperty;
use Auth;
use Session;
use App\Http\Requests;

class TypePropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Auth::user()->company;

        $typeproperties = TypeProperty::where('company_id',$company->id );
        return view('typeproperties.index')->with('typeproperties',$typeproperties->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('typeproperties.create');
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
            'tipo_propiedad' => 'required'
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $typeproperties = new TypeProperty();
        $typeproperties->tipo_propiedad = $request->tipo_propiedad;
        $typeproperties->activa = $activa;
        $typeproperties->company_id = $company->id;

        $typeproperties->save();
        Session::flash('message', 'Nuevo tipo de propiedad ingresado correctamente');
        return redirect()->route('config.typeproperty.index');
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
        $typeproperty = TypeProperty::find($id);
        return view('typeproperties.edit')
            ->with('typeproperty',$typeproperty);
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
            'tipo_propiedad' => 'required'
        ]);

        $activa = (empty($request->activa) ? '0' : $request->activa);

        $typeproperties = TypeProperty::find($id);
        $typeproperties->tipo_propiedad = $request->tipo_propiedad;
        $typeproperties->activa = $activa;

        $typeproperties->save();
        Session::flash('message', 'Tipo de propiedad actualizada correctamente');
        return redirect()->route('config.typeproperty.index');
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
