<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Property;
use App\Contact;
use App\ModelsSupport\Typecontact;
use App\ModelsSupport\Relationcontact;
use App\ModelsSupport\Media;


class ContactController extends Controller
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

        $contacts = Contact::where('company_id',$company->id );
        return view('contacts.index')->with('contacts',$contacts->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$properties = Property::all()->lists('nro','id');
		$typecontacts = Typecontact::all()->lists('nombre','id');
		$relationcontacts = Relationcontact::all()->lists('nombre','id');
		$medias = Media::all()->lists('nombre','id');
		
        return view('contacts.create')
		->with('properties',$properties)
		->with('typecontacts',$typecontacts)
		->with('relationcontacts',$relationcontacts)
		->with('medias',$medias);
	
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
			'property' => 'required|not_in:0',
			'typecontact' => 'required|not_in:0',
			'relationcontact' => 'required|not_in:0',
			'media' => 'required|not_in:0',
			
            'nombre' => 'required',
            'apellido' => 'required',
			'email' => 'required',
            'fotografia' =>	'required',
			'correspondencia' => 'required',
			'notas' => 'required'
        ]);
		
		//Subir fotografia
        $id_user = Auth::user()->id;
        $file = $request->file('fotografia');
        $tmpFilePath = '/img/upload/fotografia_contacto/';
        $tmpFileName = time() . '-'.$id_user. '-' . $file->getClientOriginalName();
        $file->move(public_path() . $tmpFilePath, $tmpFileName);
        $path = $tmpFilePath . $tmpFileName;

        $company = Auth::user()->company;
        
		$activa = (empty($request->activa) ? '0' : $request->activa);
		$mostrar_datos = (empty($request->mostrar_datos) ? '0' : $request->mostrar_datos);
		$miembro_directorio = (empty($request->miembro_directorio) ? '0' : $request->miembro_directorio);
		

        $contact = new Contact();
        $contact->nombre = $request->nombre;
        $contact->apellido = $request->apellido;
		
        $contact->telefono_movil = $request->telefono_movil;
		$contact->telefono_domicilio = $request->telefono_domicilio;
		$contact->telefono_oficina = $request->telefono_oficina;
		
		$contact->email = $request->email;
		$contact->email_alterno = $request->email_alterno;
		
		$contact->direccion = $request->direccion;
		$contact->profesion = $request->profesion;
		$contact->nacionalidad = $request->nacionalidad;
		
        $contact->notas = $request->notas;
        $contact->fotografia = $path;
		
		$contact->correspondencia = implode(",", $request->correspondencia);
		
		$contact->notas = $request->notas;
		$contact->miembro_directorio = $miembro_directorio;
		$contact->mostrar_datos = $mostrar_datos;
        $contact->activa = $activa;
		
		$contact->property_id = $request->property;
		$contact->typecontact_id = $request->typecontact;
		$contact->relationcontact_id = $request->relationcontact;
		$contact->media_id = $request->media;
		
        $contact->company_id = $company->id;

        $contact->save();
        Session::flash('message', 'Nuevo contacto ingresado');
        return redirect()->route('properties.contact.index');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $properties = Property::all()->lists('nro','id');
		$typecontacts = Typecontact::all()->lists('nombre','id');
		$relationcontacts = Relationcontact::all()->lists('nombre','id');
		$medias = Media::all()->lists('nombre','id');
		$contact = Contact::find($id);
		
        return view('contacts.show')
		->with('contact',$contact)
		->with('properties',$properties)
		->with('typecontacts',$typecontacts)
		->with('relationcontacts',$relationcontacts)
		->with('medias',$medias);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $properties = Property::all()->lists('nro','id');
		$typecontacts = Typecontact::all()->lists('nombre','id');
		$relationcontacts = Relationcontact::all()->lists('nombre','id');
		$medias = Media::all()->lists('nombre','id');
		$contact = Contact::find($id);
		
        return view('contacts.edit')
		->with('contact',$contact)
		->with('properties',$properties)
		->with('typecontacts',$typecontacts)
		->with('relationcontacts',$relationcontacts)
		->with('medias',$medias);
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
			'property' => 'required|not_in:0',
			'typecontact' => 'required|not_in:0',
			'relationcontact' => 'required|not_in:0',
			'media' => 'required|not_in:0',
			
            'nombre' => 'required',
            'apellido' => 'required',
			'email' => 'required',
			'correspondencia' => 'required',
			'notas' => 'required'
        ]);
		
		//Subir fotografia
		if(!empty($request->fotografia)){
			$id_user = Auth::user()->id;
			$file = $request->file('fotografia');
			$tmpFilePath = '/img/upload/fotografia_contacto/';
			$tmpFileName = time() . '-'.$id_user. '-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
		}


        $company = Auth::user()->company;
        
		$activa = (empty($request->activa) ? '0' : $request->activa);
		$mostrar_datos = (empty($request->mostrar_datos) ? '0' : $request->mostrar_datos);
		$miembro_directorio = (empty($request->miembro_directorio) ? '0' : $request->miembro_directorio);
		

        $contact = Contact::find($id);
        $contact->nombre = $request->nombre;
        $contact->apellido = $request->apellido;
		
        $contact->telefono_movil = $request->telefono_movil;
		$contact->telefono_domicilio = $request->telefono_domicilio;
		$contact->telefono_oficina = $request->telefono_oficina;
		
		$contact->email = $request->email;
		$contact->email_alterno = $request->email_alterno;
		
		$contact->direccion = $request->direccion;
		$contact->profesion = $request->profesion;
		$contact->nacionalidad = $request->nacionalidad;
		
        $contact->notas = $request->notas;
		if(!empty($request->fotografia)){
			$contact->fotografia = $path;
		}

		$contact->correspondencia = implode(",", $request->correspondencia);
		
		$contact->notas = $request->notas;
		$contact->miembro_directorio = $miembro_directorio;
		$contact->mostrar_datos = $mostrar_datos;
        $contact->activa = $activa;
		
		$contact->property_id = $request->property;
		$contact->typecontact_id = $request->typecontact;
		$contact->relationcontact_id = $request->relationcontact;
		$contact->media_id = $request->media;
		
        $contact->company_id = $company->id;

        $contact->save();
        Session::flash('message', 'Contacto actualizado exitosamente');
        return redirect()->route('properties.contact.index');
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
