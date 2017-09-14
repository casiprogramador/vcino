<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Equipment;
use Auth;
use Session;
use App\Supplier;
use App\Http\Requests;
use App\MaintenanceRecord;
use App\MaintenancePlan;

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
		$company = Auth::user()->company;
		$maintenance_records = MaintenanceRecord::where('company_id',$company->id );
        return view('maintenancerecord.index')
				->with('maintenancerecords',$maintenance_records->get());
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
	
	public function createbymaintenanceplan($id_maintenanceplan){
		$id_maintenanceplan = \Crypt::decrypt($id_maintenanceplan);
		$company = Auth::user()->company;
		$equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('maintenancerecord.create')
		->with('equipmets',$equipments)
		->with('suppliers',$suppliers)
		->with('id_maintenanceplan',$id_maintenanceplan);
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
			'proveedor' => 'required|not_in:0',
            'costo' => 'required|numeric',
			'tipo' => 'required',
        ]);
		$id = Auth::user()->id;
		$company = Auth::user()->company;
		
		if(!empty($request->adjunto_1)){
        $fileA1 = $request->file('adjunto_1');
        $tmpFilePathA1 = '/img/upload/registro_mantenimiento/';
        $tmpFileNameA1 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA1->getClientOriginalName();
        $fileA1->move(public_path() . $tmpFilePathA1, $tmpFileNameA1);
        $path_1 = $tmpFilePathA1 . $tmpFileNameA1;
		}else{
			$path_1 = '';
		}
		
		if(!empty($request->adjunto_2)){
        $fileA2 = $request->file('adjunto_2');
        $tmpFilePathA2 = '/img/upload/registro_mantenimiento/';
        $tmpFileNameA2 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA2->getClientOriginalName();
        $fileA2->move(public_path() . $tmpFilePathA2, $tmpFileNameA2);
        $path_2 = $tmpFilePathA2 . $tmpFileNameA2;
		}else{
			$path_2 = '';
		}
		
		if(!empty($request->adjunto_3)){
        $fileA3 = $request->file('adjunto_3');
        $tmpFilePathA3 = '/img/upload/registro_mantenimiento/';
        $tmpFileNameA3 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA3->getClientOriginalName();
        $fileA3->move(public_path() . $tmpFilePathA3, $tmpFileNameA3);
        $path_3 = $tmpFilePathA3 . $tmpFileNameA3;
		}else{
			$path_3 = '';
		}
		
        $maintenance_record= new MaintenanceRecord();
        $maintenance_record->fecha_realizacion = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$maintenance_record->tipo = $request->tipo;
		$maintenance_record->notas = $request->notas;
		$maintenance_record->costo = $request->costo;
		$maintenance_record->equipment_id = $request->equipo;
		$maintenance_record->supplier_id = $request->proveedor;
		$maintenance_record->company_id = $company->id;
		$maintenance_record->adjunto_1 = $path_1;
		$maintenance_record->adjunto_2 = $path_2;
		$maintenance_record->adjunto_3 = $path_3;
        $maintenance_record->save();
		
		if($request->id_maintenanceplan != 0){
			$maintenanceplan = MaintenancePlan::find($request->id_maintenanceplan);
			$maintenanceplan->maintenancerecords()->attach($maintenance_record->id);
		}
		
		Session::flash('message', 'Nuevo registro de mantenimiento registrado.');
        return redirect()->route('equipment.maintenancerecord.index');
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
		$maintenance_record= MaintenanceRecord::find($id);
        $equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('maintenancerecord.show')
		->with('equipmets',$equipments)
		->with('suppliers',$suppliers)
		->with('maintenancerecord',$maintenance_record);
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
		$maintenance_record= MaintenanceRecord::find($id);
        $equipments = Equipment::where('company_id',$company->id )->where('activa',1)->orderBy('fecha_instalacion', 'asc')->lists('equipo','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('maintenancerecord.edit')
		->with('equipmets',$equipments)
		->with('suppliers',$suppliers)
		->with('maintenancerecord',$maintenance_record);
		
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
			'proveedor' => 'required|not_in:0',
            'costo' => 'required|numeric',
			'tipo' => 'required',
        ]);
		$id = Auth::user()->id;
		$company = Auth::user()->company;
		
		if(!empty($request->adjunto_1)){
			$fileA1 = $request->file('adjunto_1');
			$tmpFilePathA1 = '/img/upload/registro_mantenimiento/';
			$tmpFileNameA1 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA1->getClientOriginalName();
			$fileA1->move(public_path() . $tmpFilePathA1, $tmpFileNameA1);
			$path_1 = $tmpFilePathA1 . $tmpFileNameA1;
		}elseif(!empty($request->adjunto_ori_1)){
			$path_1 = $request->adjunto_ori_1;
		}else{
			$path_1 = '';
		}
		
		
		if(!empty($request->adjunto_2)){
			$fileA2 = $request->file('adjunto_2');
			$tmpFilePathA2 = '/img/upload/registro_mantenimiento/';
			$tmpFileNameA2 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA2->getClientOriginalName();
			$fileA2->move(public_path() . $tmpFilePathA2, $tmpFileNameA2);
			$path_2 = $tmpFilePathA2 . $tmpFileNameA2;
		}elseif(!empty($request->adjunto_ori_2)){
			$path_2 = $request->adjunto_ori_2;
		}else{
			$path_2 = '';
		}

		
		if(!empty($request->adjunto_3)){
			$fileA3 = $request->file('adjunto_3');
			$tmpFilePathA3 = '/img/upload/registro_mantenimiento/';
			$tmpFileNameA3 = time() .'-'. 'regman'.'-'.$id. '-name-' . $fileA3->getClientOriginalName();
			$fileA3->move(public_path() . $tmpFilePathA3, $tmpFileNameA3);
			$path_3 = $tmpFilePathA3 . $tmpFileNameA3;
		}elseif(!empty($request->adjunto_ori_3)){
			$path_3 = $request->adjunto_ori_3;
		}else{
			$path_3 = '';
		}
		
        $maintenance_record= MaintenanceRecord::find($id);
        $maintenance_record->fecha_realizacion = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$maintenance_record->tipo = $request->tipo;
		$maintenance_record->notas = $request->notas;
		$maintenance_record->costo = $request->costo;
		$maintenance_record->equipment_id = $request->equipo;
		$maintenance_record->supplier_id = $request->proveedor;

		$maintenance_record->adjunto_1 = $path_1;
		$maintenance_record->adjunto_2 = $path_2;
		$maintenance_record->adjunto_3 = $path_3;
        $maintenance_record->save();
		
		Session::flash('message', 'Registro de mantenimiento editado.');
        return redirect()->route('equipment.maintenancerecord.index');
		
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

		$maintenance_plans = MaintenanceRecord::find($id)->maintenanceplans()->get();

		if(count($maintenance_plans) > 0){
			foreach ($maintenance_plans as $maintenance_plan) {
				$maintenance_plan->maintenancerecords()->detach($id);
				
			}
		}
		$maintenance_record = MaintenanceRecord::find($id);
		$maintenance_record->delete();
		
		Session::flash('message', 'Registro de mantenimiento eliminado.');
        return redirect()->route('equipment.maintenancerecord.index');
    }
}
