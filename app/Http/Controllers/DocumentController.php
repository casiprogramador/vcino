<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Document;
use App\Http\Requests;

class DocumentController extends Controller
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

        $documents = Document::where('company_id',$company->id );
        return view('document.index')->with('documents',$documents->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.create');
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
            'nombre' => 'required',
            'fecha' => 'required',
            'archivo' => 'required'
        ]);

		$id = Auth::user()->id;
        $company = Auth::user()->company;
        if(!empty($request->archivo)){
            $file = $request->file('archivo');
            $tmpFilePathDoc = '/img/upload/documentos/';
            $tmpFileNameDoc = time() .'-'. 'document'.'-'.$id. '-name-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePathDoc, $tmpFileNameDoc);
			//dd($file->getClientSize());
            $path = $tmpFilePathDoc . $tmpFileNameDoc;
			//$array_name = explode('.', $file->getClientOriginalName());
			$info = pathinfo($path);
			$extension = $info['extension'];
			$size = $file->getClientSize();
        }else{
			$path='';
			$extension='';
			$size='';
		}
		
		$document = new Document();
        $document->nombre = $request->nombre;
		$document->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$document->archivo = $path;
		$document->size = $size;
		$document->type = $extension;
		$document->company_id = $company->id;
		$document->save();
        Session::flash('message', 'Nuevo documento guardado correctamente.');
        return redirect()->route('communication.document.index');
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
		
		$document = Document::find($id);
        return view('document.edit')->with('document',$document);
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
            'nombre' => 'required',
            'fecha' => 'required'
        ]);
		$id_user = Auth::user()->id;
        $company = Auth::user()->company;
		if(!empty($request->archivo)){
            $file = $request->file('archivo');
            $tmpFilePathDoc = '/img/upload/documentos/';
            $tmpFileNameDoc = time() .'-'. 'document'.'-'.$id_user. '-name-' . $file->getClientOriginalName();
            $file->move(public_path() . $tmpFilePathDoc, $tmpFileNameDoc);
			//dd($file->getClientSize());
            $path = $tmpFilePathDoc . $tmpFileNameDoc;
			$info = pathinfo($path);
			$extension = $info['extension'];
			$size = $file->getClientSize();
		}elseif(!empty($request->archivo_ori)){
			$path = $request->archivo_ori;
			$extension = $request->type;
			$size = $request->size;
		}else{
			$pathReglamento="";
		}
		
		$document = Document::find($id);
        $document->nombre = $request->nombre;
		$document->fecha = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$document->archivo = $path;
		$document->size = $size;
		$document->type = $extension;
		$document->save();
        Session::flash('message', 'Documento actualizado exitosamente.');
        return redirect()->route('communication.document.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $document = Document::find($id);
		$document->delete();
		return redirect()->route('communication.document.index');
    }
}
