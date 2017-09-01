<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Equipment;
use Auth;
use Session;
use App\Supplier;
use App\Http\Requests;

class MaintenanceRecordController extends Controller
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
        return view('maintenancerecord.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;

        $equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('maintenancerecord.create')
		->with('equipmets',$equipments)
		->with('suppliers',$suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
