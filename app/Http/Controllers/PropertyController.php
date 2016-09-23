<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Property;
use App\TypeProperty;
use App\ModelsSupport\Electricservice;
use App\ModelsSupport\Internetservice;
use App\ModelsSupport\PhoneService;
use App\ModelsSupport\SituacionHabitacional;
use App\ModelsSupport\Tvservice;
use App\ModelsSupport\Waterservice;

class PropertyController extends Controller
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

        $properties = Property::where('company_id',$company->id );
        return view('properties.index')->with('properties',$properties->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$typeproperties = TypeProperty::all()->lists('tipo_propiedad','id');
		$electrics = Electricservice::all()->lists('nombre','id');
		$internets = Internetservice::all()->lists('nombre','id');
		$phones = PhoneService::all()->lists('nombre','id');
		$sithabs = SituacionHabitacional::all()->lists('nombre','id');
		$tvs = Tvservice::all()->lists('nombre','id');
		$waters = Waterservice::all()->lists('nombre','id');
		
        return view('properties.create')
		->with('typeproperties',$typeproperties)
		->with('electrics',$electrics)
		->with('internets',$internets)
		->with('phones',$phones)
		->with('sithabs',$sithabs)
		->with('tvs',$tvs)
		->with('waters',$waters);
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
            'nro' => 'required',
			'nro_intecomunicador' => 'required',
            'type_property' => 'required|not_in:0',
			'situacion_habitacionals' => 'required|not_in:0',
			'etiquetas' => 'required',
			'campo_1' => 'required',
			'campo_2' => 'required',
			'notas' => 'required',
			'codigo_electricidad' => 'required',
			'codigo_agua' => 'required',
			'codigo_gas' => 'required',
			'tvservices' => 'required|not_in:0',
			'internetservices' => 'required|not_in:0',
			'phone_services' => 'required|not_in:0',
			'waterservices' => 'required|not_in:0',
			'electricservices' => 'required|not_in:0',
			'superficie' => 'required',
			'scc' => 'required',
			'fit' => 'required',
			'nro_dormitorios' => 'required',
			'nro_banos' => 'required',
			'plano' => 'required',
			'caracteristicas' => 'required',
        ]);

        $company = Auth::user()->company;

        $property = new Property();
        $property->nro = $request->nro;
        $property->nro_intecomunicador = $request->nro_intecomunicador;
        $property->type_property_id = $request->type_property;
        $property->situacion_habitacionals_id = $request->situacion_habitacionals;
        $property->etiquetas = $request->etiquetas;
        $property->campo_1 = $request->campo_1;
        $property->campo_2 = $request->campo_2;
        $property->notas = $request->notas;
        $property->codigo_electricidad = $request->codigo_electricidad;		
        $property->codigo_agua = $request->codigo_agua;
        $property->codigo_gas = $request->codigo_gas;
        $property->tvservices_id = $request->tvservices;
		$property->internetservices_id = $request->internetservices;
		$property->phone_services_id = $request->phone_services;
		$property->waterservices_id = $request->waterservices;
		$property->electricservices_id = $request->electricservices;
		$property->superficie = $request->superficie;
		$property->scc = $request->scc;
		$property->fit = $request->fit;
		$property->nro_dormitorios = $request->nro_dormitorios;
		$property->nro_banos = $request->nro_banos;
		$property->plano = $request->plano;
		$property->caracteristicas = $request->caracteristicas;
        $property->company_id = $company->id;

        $property->save();
        Session::flash('message', 'Nueva propiedad ingresada correctamente');
        return redirect()->route('properties.property.index');
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
