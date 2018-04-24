<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Equipment;
use Auth;
use Session;
use App\Http\Requests;
use App\MaintenancePlan;

class MaintenancePlanController extends Controller
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

		$maintenance_plans = MaintenancePlan::doesnthave("maintenancerecords")->where('company_id',$company->id );

        return view('maintenanceplan.index')
				->with('maintenanceplans',$maintenance_plans->get());
		
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

        return view('maintenanceplan.create')
		->with('equipmets',$equipments);
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
            'fecha' => 'required',
            'equipo' => 'required|not_in:0',
            'costo' => 'required|numeric',
            'referencia' => 'required',

        ]);
		
		$company = Auth::user()->company;
		
        $maintenance_plan= new MaintenancePlan();
        $maintenance_plan->fecha_estimada = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$maintenance_plan->referencia = $request->referencia;
		$maintenance_plan->notas = $request->notas;
		$maintenance_plan->costo_estimado = $request->costo;
		$maintenance_plan->equipment_id = $request->equipo;
		$maintenance_plan->company_id = $company->id;
        $maintenance_plan->save();
		
		Session::flash('message', 'Nuevo plan de mantenimiento registrado.');
        return redirect()->route('equipment.maintenanceplan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = \Crypt::decrypt($id);
		$company = Auth::user()->company;
        $maintenance_plan= MaintenancePlan::find($id);
		 $equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		return view('maintenanceplan.show')
		->with('maintenanceplan',$maintenance_plan)
		->with('equipmets',$equipments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$id = \Crypt::decrypt($id);
		$company = Auth::user()->company;
        $maintenance_plan= MaintenancePlan::find($id);
		 $equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		return view('maintenanceplan.edit')
		->with('maintenanceplan',$maintenance_plan)
		->with('equipmets',$equipments);
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
            'fecha' => 'required',
            'equipo' => 'required|not_in:0',
            'costo' => 'required|numeric',
            'referencia' => 'required',

        ]);
		
		$company = Auth::user()->company;
		
        $maintenance_plan= MaintenancePlan::find($id);
        $maintenance_plan->fecha_estimada = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$maintenance_plan->referencia = $request->referencia;
		$maintenance_plan->notas = $request->notas;
		$maintenance_plan->costo_estimado = $request->costo;
		$maintenance_plan->equipment_id = $request->equipo;
        $maintenance_plan->save();
		
		Session::flash('message', 'Plan de mantenimiento editado.');
        return redirect()->route('equipment.maintenanceplan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$maintenance_records = MaintenancePlan::find($id)->maintenancerecords()->get();
		$maintenanceplan = MaintenancePlan::find($id);
		if(count($maintenance_records) > 0){
			
			foreach ($maintenance_records as $maintenance_record) {
				$maintenanceplan->maintenancerecords()->detach($maintenance_record->id);
				$maintenance_record->delete();		
			}
		}

		$maintenanceplan->delete();
		Session::flash('message', 'Plan de mantenimiento elimando.');
        return redirect()->route('equipment.maintenanceplan.index');
    }
}
