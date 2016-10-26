<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Phonesite;
use App\Communication;
use Session;

class CommunicationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function phonesite()
    {
        $company = Auth::user()->company;

        $phonesites = Phonesite::where('company_id',$company->id );
        return view('communications.phonesites')->with('phonesites',$phonesites->get());
    }

    public function index()
    {
		$company = Auth::user()->company;

        $communications = Communication::where('company_id',$company->id );
        return view('communications.index')->with('communications',$communications->get());
    }

    public function create()
    {
        return view('communications.create');
    }
	
	public function store(Request $request)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'asunto' => 'required',
            'cuerpo' => 'required'
        ]);
		//dd(array_filter($request->adjunto));

		if(array_filter($request->adjunto)){
			$array_path = array();
			foreach ($request->adjunto as $posicion => $adjunto){
				if(!empty($adjunto)){
					$id_user = Auth::user()->id;
					$file = $adjunto;
					$tmpFilePath = '/img/upload/comunicados/';
					$tmpFileName = time() . '-' .$posicion.'-'.$id_user. '-' . $file->getClientOriginalName();
					$file->move(public_path() . $tmpFilePath, $tmpFileName);
					$path = $tmpFilePath . $tmpFileName;
					array_push($array_path, $path);
				}

			}
		}

        $company = Auth::user()->company;

        $communication = new Communication();
        $communication->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
        $communication->asunto = $request->asunto;
        $communication->cuerpo = $request->cuerpo;
		$communication->company_id = $company->id;
		if(array_filter($request->adjunto)){
			$communication->adjuntos = implode(",", $array_path);
		}
        $communication->save();
        Session::flash('message', 'Nuevo comunicado ingresado correctamente');
        return redirect()->route('communication.communication.index');

    }

    public function send()
    {
        return view('communications.send');
    }
	
	public function registersend()
    {
        return view('communications.registersend');
    }
	
	public function edit($id)
    {
        $communication = Communication::find($id);
        return view('communications.edit')
            ->with('communication',$communication);
    }
	
	public function update(Request $request, $id)
    {
		$this->validate($request, [
            'fecha' => 'required',
            'asunto' => 'required',
            'cuerpo' => 'required'
        ]);


		if(array_filter($request->adjunto)){
			$array_path = array();
			foreach ($request->adjunto as $posicion => $adjunto){
				if(!empty($adjunto)){
					$id_user = Auth::user()->id;
					$file = $adjunto;
					$tmpFilePath = '/img/upload/comunicados/';
					$tmpFileName = time() . '-' .$posicion.'-'.$id_user. '-' . $file->getClientOriginalName();
					$file->move(public_path() . $tmpFilePath, $tmpFileName);
					$path = $tmpFilePath . $tmpFileName;
					array_push($array_path, $path);
				}

			}
		}

        $company = Auth::user()->company;
		
		$communication = Communication::find($id);
        $communication->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
        $communication->asunto = $request->asunto;
        $communication->cuerpo = $request->cuerpo;
		$communication->company_id = $company->id;
		if(array_filter($request->adjunto)){
			$communication->adjuntos = implode(",", $array_path);
		}
        $communication->save();
        Session::flash('message', 'Comunicado actualizado correctamente');
        return redirect()->route('communication.communication.index');
	}
	

    public function show()
    {
        $communication = Communication::find($id);
        return view('communications.show')
            ->with('communication',$communication);
    }

}
