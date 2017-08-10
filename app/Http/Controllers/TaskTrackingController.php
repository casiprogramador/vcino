<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Task;
use App\TaskTracking;
class TaskTrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$company = Auth::user()->company;
		$tasktrackings = TaskTracking::where('company_id',$company->id );
        return view('tasktrackings.index')
		->with('tasktrackings',$tasktrackings->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_task)
    {
		$company = Auth::user()->company;
		$id_task = \Crypt::decrypt($id_task);
		$task = Task::find($id_task);
		$tasktrackings = TaskTracking::where('company_id',$company->id )->where('task_id',$id_task)->orderBy('fecha', 'desc');
        return view('tasktrackings.create')
			->with('task',$task)
			->with('tasktrackings',$tasktrackings->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
		$this->validate($request, [
			'fecha' => 'required'
		]);
		
		$company = Auth::user()->company;
		$notificar = (empty($request->notificar) ? '0' : $request->notificar);
		if(!empty($request->adjunto)){
			$id_user = Auth::user()->id;
			$id_tares = $request->task_id;
			$file = $request->adjunto;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-seg-'.$id_tares.'-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
		}else{
			$path="";
		}
		
		$tasktracking = new TaskTracking();
		$tasktracking->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$tasktracking->descripcion = $request->descripcion;
		$tasktracking->adjunto = $path;
		$tasktracking->notificar = $notificar;
		
		$tasktracking->task_id = $request->task_id;
		$tasktracking->company_id = $company->id;
		$tasktracking->save();
		return redirect()->route('taskrequest.tasktracking.index');
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
    public function edit($id_task,$id_tasktracking)
    {
		

		$company = Auth::user()->company;
		$id_task = \Crypt::decrypt($id_task);
		$id_tasktracking = \Crypt::decrypt($id_tasktracking);
		$task = Task::find($id_task);
		$tasktrackings = TaskTracking::where('company_id',$company->id )->where('task_id',$id_task)->orderBy('fecha', 'desc');
		$tasktracking = TaskTracking::find($id_tasktracking);
		
        return view('tasktrackings.edit')
			->with('task',$task)
			->with('tasktrackings',$tasktrackings->get())
			->with('tasktracking',$tasktracking);
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
			'fecha' => 'required'
		]);
		$id = \Crypt::decrypt($id);
		$company = Auth::user()->company;
		$notificar = (empty($request->notificar) ? '0' : $request->notificar);
		if(!empty($request->adjunto)){
			$id_user = Auth::user()->id;
			$id_tares = $request->task_id;
			$file = $request->adjunto;
			$tmpFilePath = '/img/upload/tareas/';
			$tmpFileName = time() . '-'.$id_user. '-tarea-seg-'.$id_tares.'-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
		}elseif(!empty($request->adjunto_ori)){
			$path = $request->adjunto_ori;
		}else{
			$path="";
		}
		
		$tasktracking = TaskTracking::find($id);
		$tasktracking->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$tasktracking->descripcion = $request->descripcion;
		$tasktracking->adjunto = $path;
		$tasktracking->notificar = $notificar;
		
		$tasktracking->task_id = $request->task_id;
		$tasktracking->company_id = $company->id;
		$tasktracking->save();
		return redirect()->route('taskrequest.tasktracking.index');
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
