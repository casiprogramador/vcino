<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\ReceiptNumber;
use App\Http\Requests;

class ReceiptNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;

        $receiptnumbers = ReceiptNumber::where('company_id',$company->id );
        return view('receiptnumbers.index')->with('receiptnumbers',$receiptnumbers->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receiptnumbers.create');
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
            'gestion' => 'required',
            'ingreso' => 'required',
            'egreso' => 'required',
            'traspaso' => 'required'
        ]);

        $company = Auth::user()->company;

        $receiptnumber = new ReceiptNumber();
        $receiptnumber->gestion = $request->gestion;
        $receiptnumber->ingreso = $request->ingreso;
        $receiptnumber->egreso = $request->egreso;
        $receiptnumber->traspaso = $request->traspaso;
        $receiptnumber->company_id = $company->id;

        $receiptnumber->save();
        Session::flash('message', 'Nuevos números de comprobantes registrados correctamente.');
        return redirect()->route('config.receiptnumber.index');
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
        $receiptnumber = ReceiptNumber::find($id);
        return view('receiptnumbers.edit')
            ->with('receiptnumber',$receiptnumber);
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
            'gestion' => 'required',
            'ingreso' => 'required',
            'egreso' => 'required',
            'traspaso' => 'required'
        ]);

        $receiptnumber = ReceiptNumber::find($id);
        $receiptnumber->gestion = $request->gestion;
        $receiptnumber->ingreso = $request->ingreso;
        $receiptnumber->egreso = $request->egreso;
        $receiptnumber->traspaso = $request->traspaso;

        $receiptnumber->save();
        Session::flash('message', 'Números de comprobantes actualizados correctamente.');
        return redirect()->route('config.receiptnumber.index');
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
