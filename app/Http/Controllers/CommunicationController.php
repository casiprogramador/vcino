<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Phonesite;
use App\Communication;
use App\Property;
use App\Contact;
use App\Sendcommunication;
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
					$tmpFileName = time() . '-' .$posicion.'-'.$id_user. '-name-' . $file->getClientOriginalName();
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
					$tmpFileName = time() . '-' .$posicion.'-'.$id_user. '-name-' . $file->getClientOriginalName();
					$file->move(public_path() . $tmpFilePath, $tmpFileName);
					$path = $tmpFilePath . $tmpFileName;
					array_push($array_path, $path);
				}

			}
		}
		
		$communication = Communication::find($id);
        $communication->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
        $communication->asunto = $request->asunto;
        $communication->cuerpo = $request->cuerpo;
		if(array_filter($request->adjunto)){
			$communication->adjuntos = implode(",", $array_path);
		}
        $communication->save();
        Session::flash('message', 'Comunicado actualizado correctamente');
        return redirect()->route('communication.communication.index');
	}
	

    public function show($id)
    {
        $communication = Communication::find($id);
        return view('communications.show')
            ->with('communication',$communication);
    }
	
	public function destroy($id)
    {
        $communication = Communication::find($id);
		$communication->delete();
		return redirect()->route('communication.communication.index');
    }
	
	public function copy($id)
    {
        $communication = Communication::find($id);
        return view('communications.duplicate')
            ->with('communication',$communication);
    }
	
	public function savecopy(Request $request)
    {
        $this->validate($request, [
            'fecha' => 'required',
            'asunto' => 'required',
            'cuerpo' => 'required'
        ]);
		$adjunto = $request->adjunto;
		$adjunto_ori = $request->adjunto_ori;
		$array_path = array();
		$id_user = Auth::user()->id;
		for ($i = 0; $i <= 2; $i++) {
			if(isset($adjunto[$i])){
				$file = $adjunto[$i];
				$tmpFilePath = '/img/upload/comunicados/';
				$tmpFileName = time() . '-' .$i.'-'.$id_user. '-name-' . $file->getClientOriginalName();
				$file->move(public_path() . $tmpFilePath, $tmpFileName);
				$path = $tmpFilePath . $tmpFileName;
				array_push($array_path, $path);
			}elseif (isset($adjunto_ori[$i])) {
				array_push($array_path, $adjunto_ori[$i]);
			}
		}

        $company = Auth::user()->company;

        $communication = new Communication();
        $communication->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
        $communication->asunto = $request->asunto;
        $communication->cuerpo = $request->cuerpo;
		$communication->company_id = $company->id;
		if(array_filter($request->adjunto) || array_filter($request->adjunto_ori)){
			$communication->adjuntos = implode(",",array_filter ( $array_path) );
		}
        $communication->save();
        Session::flash('message', 'Nuevo comunicado ingresado correctamente');
        return redirect()->route('communication.communication.index');

    }
	
	public function send($id)
    {
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
		$communications = Communication::where('company_id',$company->id )->get();
        $communications = $communications->lists('FechaAsunto','id');
		$contacts = Contact::where('company_id',$company->id )->get();
		$contacts = $contacts->lists('FullName','id');
        return view('communications.send')
			->with('properties',$properties)
		    ->with('communications',$communications)
			->with('contacts',$contacts)
			->with('id_comunication',$id);
    }
	
	public function sendcommunication(Request $request){
		$this->validate($request, [
            'comunicado' => 'required',
            'remitente' => 'required',
            'dirigido' => 'required'
        ]);
		$communication = Communication::find($request->comunicado);
		$dirigido = $request->dirigido;
		
		$company = Auth::user()->company;
		//correspondencia
		if($dirigido == 'todos'){
			$contacts = Contact::where('company_id',$company->id)->where('correspondencia','like','%Comunicados%')->get();
		}elseif ($dirigido == 'copropietarios') {
			$contacts = Contact::where('company_id',$company->id)->where('correspondencia','like','%Comunicados%')->where('typecontact_id',1)->get();
		}elseif ($dirigido == 'inquilinos') {
			$contacts = Contact::where('company_id',$company->id)->where('correspondencia','like','%Comunicados%')->where('typecontact_id',2)->get();

		}elseif ($dirigido == 'directorio') {
			$contacts = Contact::where('company_id',$company->id)->where('correspondencia','like','%Directorio%')->get();

		}elseif ($dirigido == 'propiedad') {
			$contacts = Contact::where('company_id',$company->id)->where('property_id',$request->propiedad)->get();
		}elseif ($dirigido == 'contacto') {
			$contacts = Contact::whereIn('id',$request->destinatario)->get();
		}elseif ($dirigido == 'correo') {
			$contacts = explode(",", trim($request->correo));
		}elseif ($dirigido == 'prueba') {
			$contacts = explode(",", trim($request->correo));
		}
		
		foreach ($contacts as $contact) {

			$data = [
				'nombre_remitente' => $request->remitente,
				'email_remitente' => Auth::user()->email,
				'email_contancto' => $contact->email,
				'nombre_contacto'=> $contact->nombre.' '.$contact->apellido,
				'comunicado_cuerpo' => $communication->cuerpo,
				'comunicado_asunto' => $communication->asunto,
				'comunicado_adjuntos' => $communication->adjuntos,
			 ];

			Mail::send('emails.communication',$data, function ($m) use ($data) {
				$m->from($data['email_remitente'],$data['nombre_remitente']);
				$m->to($data['email_contancto'], $data['nombre_contacto'])->subject($data['comunicado_asunto']);
				$adjuntos = explode(',',$data['comunicado_adjuntos'] );
				foreach ($adjuntos as $adjunto) {
					$m->attach(public_path().$adjunto);
				}
				
			});
			if (Mail::failures()) {
				echo 'mail No enviado';
			}else{
				echo 'mail enviado';
			}

		}

	}
	
	public function printcom($id)
    {
        return view('communications.print');
    }

}
