<?php

namespace App\Http\Controllers;

use App\Quota;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Category;
use App\TypeProperty;

class QuotaController extends Controller
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

        $quotes = Quota::where('company_id',$company->id );
        return view('quotes.index')->with('quotes',$quotes->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Auth::user()->company;
        $categories = Category::where('company_id',$company->id )->where('tipo_categoria', 'Ingreso')->lists('nombre','id');
        $typeProperty = TypeProperty::where('company_id',$company->id )->lists('tipo_propiedad','id')->all();
        return view('quotes.create')->with('categories',$categories)->with('typeProperties',$typeProperty);
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
            'cuota' => 'required',
            'frecuencia_pago' => 'required|not_in:0',
            'tipo_importe' => 'required|not_in:0',
            'importe' => 'required',
            'category' => 'required|not_in:0',
            'type_property' => 'required|not_in:0'
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);
		if($request->type_property == 'todos'){
			$typeProperties = TypeProperty::where('company_id',$company->id )->get();
			foreach ($typeProperties as $typeProperty){

				$quota = new Quota();
				$quota->cuota = $request->cuota;
				$quota->frecuencia_pago = $request->frecuencia_pago;
				$quota->tipo_importe = $request->tipo_importe;
				$quota->importe = $request->importe;
				$quota->notas = $request->notas;
				$quota->category_id = $request->category;
				$quota->type_property_id = $typeProperty->id;
				$quota->activa = $activa;
				$quota->company_id = $company->id;
				$quota->save();
			}
			
		}else{
			$quota = new Quota();
			$quota->cuota = $request->cuota;
			$quota->frecuencia_pago = $request->frecuencia_pago;
			$quota->tipo_importe = $request->tipo_importe;
			$quota->importe = $request->importe;
			$quota->notas = $request->notas;
			$quota->category_id = $request->category;
			$quota->type_property_id = $request->type_property;
			$quota->activa = $activa;
			$quota->company_id = $company->id;

			$quota->save();
		}
        Session::flash('message', 'Nueva cuota registrada correctamente.');
        return redirect()->route('config.quota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quota = Quota::find($id);
        $company = Auth::user()->company;
        $categories = Category::where('company_id',$company->id )->where('tipo_categoria', 'Ingreso')->lists('nombre','id');
        $typeProperty = TypeProperty::where('company_id',$company->id )->lists('tipo_propiedad','id');
        return view('quotes.show')
            ->with('categories',$categories)
            ->with('typeProperties',$typeProperty)
            ->with('quota',$quota);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quota = Quota::find($id);
        $company = Auth::user()->company;
        $categories = Category::where('company_id',$company->id )->where('tipo_categoria', 'Ingreso')->lists('nombre','id');
        $typeProperty = TypeProperty::where('company_id',$company->id )->lists('tipo_propiedad','id');
        return view('quotes.edit')
            ->with('categories',$categories)
            ->with('typeProperties',$typeProperty)
            ->with('quota',$quota);
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
            'cuota' => 'required',
            'frecuencia_pago' => 'required|not_in:0',
            'tipo_importe' => 'required|not_in:0',
            'importe' => 'required',
            'category' => 'required|not_in:0',
            'type_property' => 'required|not_in:0'
        ]);

        $activa = (empty($request->activa) ? '0' : $request->activa);

        $quota = Quota::find($id);
        $quota->cuota = $request->cuota;
        $quota->frecuencia_pago = $request->frecuencia_pago;
        $quota->tipo_importe = $request->tipo_importe;
        $quota->importe = $request->importe;
        $quota->notas = $request->notas;
        $quota->category_id = $request->category;
        $quota->type_property_id = $request->type_property;
        $quota->activa = $activa;

        $quota->save();
        Session::flash('message', 'Cuota actualizada correctamente.');
        return redirect()->route('config.quota.index');
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
