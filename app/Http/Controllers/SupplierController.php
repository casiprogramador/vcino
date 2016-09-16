<?php

namespace App\Http\Controllers;

use App\Supplier;
use Auth;
use Session;
use Illuminate\Http\Request;

class SupplierController extends Controller
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

        $suppliers = Supplier::where('company_id',$company->id );
        return view('suppliers.index')->with('suppliers',$suppliers->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
            'razon_social' => 'required'
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $supplier = new Supplier();
        $supplier->razon_social = $request->razon_social;
        $supplier->contacto_nombre = $request->contacto_nombre;
        $supplier->contacto_apellido = $request->contacto_apellido;
        $supplier->telefono_oficina = $request->telefono_oficina;
        $supplier->telefono_movil = $request->telefono_movil;
        $supplier->telefono_emergencia = $request->telefono_emergencia;
        $supplier->nombre_cheque = $request->nombre_cheque;
        $supplier->email = $request->email;
        $supplier->sitio_web = $request->sitio_web;
        $supplier->direccion = $request->direccion;
        $supplier->notas = $request->notas;
        $supplier->activa = $activa;
        $supplier->company_id = $company->id;

        $supplier->save();
        Session::flash('message', 'Nuevo proveedor ingresado correctamente');
        return redirect()->route('config.supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.show')
            ->with('supplier',$supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit')
            ->with('supplier',$supplier);
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
            'razon_social' => 'required'
        ]);

        $activa = (empty($request->activa) ? '0' : $request->activa);

        $supplier = Supplier::find($id);
        $supplier->razon_social = $request->razon_social;
        $supplier->contacto_nombre = $request->contacto_nombre;
        $supplier->contacto_apellido = $request->contacto_apellido;
        $supplier->telefono_oficina = $request->telefono_oficina;
        $supplier->telefono_movil = $request->telefono_movil;
        $supplier->telefono_emergencia = $request->telefono_emergencia;
        $supplier->nombre_cheque = $request->nombre_cheque;
        $supplier->email = $request->email;
        $supplier->sitio_web = $request->sitio_web;
        $supplier->direccion = $request->direccion;
        $supplier->notas = $request->notas;
        $supplier->activa = $activa;

        $supplier->save();

        Session::flash('message', 'Proveedor actualizado correctamente');
        return redirect()->route('config.supplier.index');
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
