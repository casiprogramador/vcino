<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Property;
use App\Contact;
use App\Installation;
use App\Task;
use App\TaskTracking;
use App\Quota;
use App\Accountsreceivable;
use App\TaskRequest;
use Session;
use Illuminate\Support\Facades\DB;
use App\TaskReservation;

class TaskController extends Controller
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
		$tasks = Task::where('company_id',$company->id )->where('estado_solicitud','!=','completada')->orderBy('prioridad', 'asc');
         return view('tasks.index')
		->with('tasks',$tasks->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$installations = Installation::where('company_id',$company->id )->where('requiere_reserva','1' );
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->orderBy('cuota', 'asc');
        return view('tasks.create')
		->with('properties',$properties)
		->with('cuotas',$quotas->get())
		->with('installations',$installations->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

		if($request->tipo_tarea == 'mis_tareas'){
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			//'propiedad' => 'required|not_in:0',
			//'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'solicitudes_recibidas') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			//'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'reserva_instalaciones') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'reclamos') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'sugerencias') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'notificacion_mudanza') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'notificacion_trabajos') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',chelosaire
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}

		if(!empty($request->adjunto_1)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_1;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-1-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_1 = $tmpFilePath . $tmpFileName;
		}else{
			$path_1="";
		}
		
		if(!empty($request->adjunto_2)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_2;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-2-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_2 = $tmpFilePath . $tmpFileName;
		}else{
			$path_2="";
		}
		
		if(!empty($request->adjunto_3)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_3;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-3-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_3 = $tmpFilePath . $tmpFileName;
		}else{
			$path_3="";
		}
		$hoy = date("Y-m-d");
		//$hora_ini = $request->hora_inicio;
		//$hora_fin = $request->hora_final;
		//$fechaHoraIni = \DateTime::createFromFormat('Y-m-d H:i:s', $hoy.' '.$hora_ini.':00');
		//$fechaHoraFin = \DateTime::createFromFormat('Y-m-d H:i:s', $hoy.' '.$hora_fin.':00');
		$estado_tarea = $request->tarea_estado;
		$company = Auth::user()->company;
		if($request->tipo_tarea == 'reserva_instalaciones'){

			$instalacion = Installation::find($request->instalacion);
			//$dia_requerido_semana =  date('w', strtotime(str_replace('/','-',$request->fecha_requerida)));
			//dd($dia_requerido_semana);
			//$dias_semana = array(1,2,3,4,5);
			//if (in_array($dia_requerido_semana, $dias_semana)) {
			//	Session::flash('message', 'El día solicitado no es válido.');
			//	return redirect()->route('taskrequest.task.create')->withInput();
			//}

			$fechaRequerida = date('Y-m-d', strtotime(str_replace('/', '-', $request->fecha_requerida)));

			$instalaciones_reservadas =  DB::table('task_reservations')
					->join('tasks', 'task_reservations.task_id', '=', 'tasks.id')
					->where('task_reservations.installation_id',$request->instalacion)
					->where('tasks.fecha_requerida',$fechaRequerida)
					->get();
			
			$numero_instalaciones_reservadas = count($instalaciones_reservadas);

			//dd($numero_instalaciones_reservadas);

			if($numero_instalaciones_reservadas > 0){
				Session::flash('message', 'La instalación ya se encuentra reservada.');
				$estado_tarea = 'pendiente';
			}else{
				Session::flash('message', 'Reserva registrada exitosamente.');
				$estado_tarea = 'en proceso';
			}
			
		}
		
		
		$task = new Task();
		$task->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$task->titulo_tarea = $request->titulo_tarea;
		$task->tipo_tarea = $request->tipo_tarea;
		$task->estado_solicitud = $estado_tarea;

		$task->nota = $request->nota;
		$task->medio_solicitud = $request->medio_solicitud;
		$task->prioridad = $request->prioridad;
		$task->frecuencia= $request->frecuencia;
		$task->fecha_requerida = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_requerida)));
		if($request->tipo_tarea == 'reserva_instalaciones'){
		//$task->hora_inicio= $fechaHoraIni->format('Y-m-d H:i:s');
		//$task->hora_fin= $fechaHoraFin->format('Y-m-d H:i:s');
		}
		$task->costo= $request->costo;
		$task->documento_1= $path_1;
		$task->documento_2= $path_2;
		$task->documento_3= $path_3;
		$task->company_id = $company->id;
		$task->save();
		
		if($request->tipo_tarea == 'reserva_instalaciones'){
			$taskreservation = new TaskReservation();
			$taskreservation->property_id = $request->propiedad;
			$taskreservation->contact_id = $request->contacto;
			$taskreservation->installation_id = $request->instalacion;
			$taskreservation->company_id = $company->id;
			$task->taskreservation()->save($taskreservation);
			$id_last_task_insert = $task->id;
			
			if($request->costo > 0 && $request->cuota != 0){
				$fecha_reserva = explode('/', $request->fecha_requerida);

				$date = new \DateTime($fecha_reserva[2].'-'.$fecha_reserva[1].'-'.'01');
				$accountsreceivable = new Accountsreceivable();
				$accountsreceivable->gestion = $fecha_reserva[2];
				$accountsreceivable->periodo = $fecha_reserva[1];
				$accountsreceivable->fecha_gestion_periodo = $date->format('Y-m-d');
				$accountsreceivable->fecha_vencimiento = $date->format('Y-m-d');
				$accountsreceivable->cantidad = '0';
				$accountsreceivable->importe_por_cobrar = $request->costo;
				$accountsreceivable->importe_abonado = '0';
				$accountsreceivable->cancelada = '0';
				$accountsreceivable->quota_id = $request->cuota;
				$accountsreceivable->property_id = $request->propiedad;
				$accountsreceivable->company_id = $company->id;
				$accountsreceivable->user_id = Auth::user()->id;
				$accountsreceivable->save();
				
				$task->accountreceivables()->attach($accountsreceivable->id);
			}else{
				Session::flash('message', 'Debe seleccionar una cuenta.');
				return redirect()->route('taskrequest.task.create')->withInput();
			}
			
		}elseif($request->tipo_tarea == 'solicitudes_recibidas' ||
				$request->tipo_tarea == 'reclamos' ||
				$request->tipo_tarea == 'sugerencias' ||
				$request->tipo_tarea == 'notificacion_mudanza' ||
				$request->tipo_tarea == 'notificacion_trabajos'){
			
			$taskrequest = new TaskRequest();
			$taskrequest->property_id = $request->propiedad;
			$taskrequest->contact_id = $request->contacto;
			$taskrequest->company_id = $company->id;
			$task->taskrequest()->save($taskrequest);
				
		}		
		
		return redirect()->route('taskrequest.task.index');

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
		$task = Task::find($id);
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$installations = Installation::where('company_id',$company->id )->where('requiere_reserva','1')->lists('instalacion','id')->all();
		if($task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='sugerencias' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='notificacion_mudanza' ||
		$task->tipo_tarea =='notificacion_trabajos'){


			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskrequest->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}elseif ($task->tipo_tarea =='reserva_instalaciones') {
			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskreservation->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}else{
			$contacts = '';
		}
        return view('tasks.show')
		->with('task',$task)
		->with('properties',$properties)
		->with('installations',$installations)
		->with('contacts',$contacts);
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
		$task = Task::find($id);
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$installations = Installation::where('company_id',$company->id )->where('requiere_reserva','1')->lists('instalacion','id')->all();
		if($task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='sugerencias' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='notificacion_mudanza' ||
		$task->tipo_tarea =='notificacion_trabajos'){


			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskrequest->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}elseif ($task->tipo_tarea =='reserva_instalaciones') {
			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskreservation->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}else{
			$contacts = '';
		}
        return view('tasks.edit')
		->with('task',$task)
		->with('properties',$properties)
		->with('installations',$installations)
		->with('contacts',$contacts);
		

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
		
		//dd($request);
        if($request->tipo_tarea == 'mis_tareas'){
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			//'propiedad' => 'required|not_in:0',
			//'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'solicitudes_recibidas') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			//'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'reserva_instalaciones') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			//'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'reclamos') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'sugerencias') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			//'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'notificacion_mudanza') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}elseif ($request->tipo_tarea == 'notificacion_trabajos') {
			$this->validate($request, [
			'titulo_tarea' => 'required',
			'fecha' => 'required',
			//'nota' => 'required',
			//'prioridad' => 'required',chelosaire
			//'frecuencia' => 'required',
			'medio_solicitud' => 'required',
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
            //'instalacion' => 'required|not_in:0',
			'fecha_requerida' => 'required',
			//'hora_inicio' => 'required',
			//'hora_final' => 'required',
			//'costo' => 'required',
			]);
		}
		$id = \Crypt::decrypt($id);
		
		
		
		
		if(!empty($request->adjunto_1)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_1;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-1-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_1 = $tmpFilePath . $tmpFileName;
		}elseif(!empty($request->adjunto_ori_1)){
			$path_1 = $request->adjunto_ori_1;
		}else{
			$path_1="";
		}
		
		
		if(!empty($request->adjunto_2)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_2;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-2-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_2 = $tmpFilePath . $tmpFileName;
		}elseif(!empty($request->adjunto_ori_2)){
			$path_2 = $request->adjunto_ori_2;
		}else{
			$path_2="";
		}
		
		if(!empty($request->adjunto_3)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto_3;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-3-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path_3 = $tmpFilePath . $tmpFileName;
		}elseif(!empty($request->adjunto_ori_3)){
			$path_3 = $request->adjunto_ori_3;
		}else{
			$path_3="";
		}
		
		
		
		$hoy = date("Y-m-d");
		
		$company = Auth::user()->company;
		
		$task = Task::find($id);
		
		
		if($request->tipo_tarea == 'reserva_instalaciones'){

			$instalacion = Installation::find($task->taskreservation->installation->id);
			
		}

		$task->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$task->titulo_tarea = $request->titulo_tarea;

		$task->estado_solicitud = $request->tarea_estado;
		$task->nota = $request->nota;
		$task->medio_solicitud = $request->medio_solicitud;
		$task->prioridad = $request->prioridad;
		$task->frecuencia= $request->frecuencia;
		$task->fecha_requerida = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_requerida)));
		$task->costo= $request->costo;
		$task->documento_1= $path_1;
		$task->documento_2= $path_2;
		$task->documento_3= $path_3;

		$task->save();
		
		if($request->tipo_tarea == 'reserva_instalaciones'){

			$taskreservation = TaskReservation::find($request->tipo_tarea_id);
			$taskreservation->property_id = $request->propiedad;
			$taskreservation->contact_id = $request->contacto;

			$task->taskreservation()->save($taskreservation);
		}elseif($request->tipo_tarea == 'solicitudes_recibidas' ||
				$request->tipo_tarea == 'reclamos' ||
				$request->tipo_tarea == 'sugerencias' ||
				$request->tipo_tarea == 'notificacion_mudanza' ||
				$request->tipo_tarea == 'notificacion_trabajos'){
			
			$taskrequest = TaskRequest::find($request->tipo_tarea_id);
			$taskrequest->property_id = $request->propiedad;
			$taskrequest->contact_id = $request->contacto;

			$task->taskrequest()->save($taskrequest);
				
		}		
		
		return redirect()->route('taskrequest.task.index');
    }
	
	public function copy($id){
		$id = \Crypt::decrypt($id);
		$task = Task::find($id);
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$installations = Installation::where('company_id',$company->id )->lists('instalacion','id')->all();
		if($task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='solicitudes_recibidas' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='sugerencias' ||
		$task->tipo_tarea =='reclamos' ||
		$task->tipo_tarea =='notificacion_mudanza' ||
		$task->tipo_tarea =='notificacion_trabajos'){


			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskrequest->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}elseif ($task->tipo_tarea =='reserva_instalaciones') {
			$contacts = Contact::where('company_id',$company->id )->where('property_id', $task->taskreservation->property->id)->where('activa','1')->get();
			$contacts = $contacts->lists('FullName','id')->all();
			//dd($contacts);
		}else{
			$contacts = '';
		}
        return view('tasks.copy')
		->with('task',$task)
		->with('properties',$properties)
		->with('installations',$installations)
		->with('contacts',$contacts);
	}
	
	public function search(Request $request){
		
		//tipo_tarea estado prioridad
		$company = Auth::user()->company;
		$tasks = Task::where('company_id',$company->id );
		if($request->tipo_tarea != 'todos'){
			$tasks->where('tipo_tarea',$request->tipo_tarea);
		}
		if ($request->estado != 'todos') {
			$tasks->where('estado_solicitud',$request->estado);
		}
		if ($request->prioridad != 'todos') {
			$tasks->where('prioridad',$request->prioridad);
		}
		 return view('tasks.index')
		->with('tasks',$tasks->get());
	}

	public function reservation(){
		$company = Auth::user()->company;
		$tasks = Task::where('company_id',$company->id )->where('tipo_tarea','reserva_instalaciones');
         return view('tasks.index')
		->with('tasks',$tasks->get());
	}
	
	public function suggestion(){
		$company = Auth::user()->company;
		$tasks = Task::where('company_id',$company->id )->where('tipo_tarea','sugerencias')->orWhere('tipo_tarea','reclamos');
         return view('tasks.index')
		->with('tasks',$tasks->get());
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$task = Task::find($id);
		//$accountreceibable = Accountsreceivable::find(1492);
		//$accountreceibable->delete();

		if($task->tipo_tarea == 'reserva_instalaciones'){

			$task_accountreceivables = $task->accountreceivables()->get();
			foreach ($task_accountreceivables as $task_accountreceivable) {
				
				//dd($task_accountreceivable->id);
				
				if($task_accountreceivable->cancelada == 1){
					Session::flash('message', 'No se puede eliminar esta reserva porque se encuentra cancelada.');
					return redirect()->route('taskrequest.task.index');
				}
				$task->accountreceivables()->detach($task_accountreceivable->id);
				$accountreceibable = Accountsreceivable::find($task_accountreceivable->id);
				
				$accountreceibable->delete();
				//dd($accountreceibable);

			}
			$taskreservation = TaskReservation::where('task_id',$id)->delete();
			
			
		}elseif($task->tipo_tarea == 'solicitudes_recibidas' ||
				$task->tipo_tarea == 'reclamos' ||
				$task->tipo_tarea == 'sugerencias' ||
				$task->tipo_tarea == 'notificacion_mudanza' ||
				$task->tipo_tarea == 'notificacion_trabajos'){
			
			$taskrequest = TaskRequest::where('task_id',$id)->delete();
				
		}		
        $tasktracking = TaskTracking::where('task_id',$id)->delete();
		$task->delete();
		Session::flash('message', 'Tarea eliminada exitosamente.');
		return redirect()->route('taskrequest.task.index');
    }
	
}
