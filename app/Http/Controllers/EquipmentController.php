<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use App\Equipment;
use Auth;
use Session;
use App\Http\Requests;

class EquipmentController extends Controller
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

        $equipments = Equipment::where('company_id',$company->id );
        return view('equipments.index')->with('equipments',$equipments->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Auth::user()->company;
        $suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('equipments.create')->with('suppliers',$suppliers);
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
            'equipo' => 'required',
            'tipo_equipo' => 'required|not_in:0',
            'proveedor' => 'required|not_in:0',
            'fecha_instalacion' => 'required',
            //'documento' => 'required',
            //'fotografia_1' => 'required',
            //'fotografia_2' => 'required',
            //'fotografia_3' => 'required',
        ]);

        $id = Auth::user()->id;
        $company = Auth::user()->company;

        //Activacion
        $activa = (empty($request->activa) ? '0' : $request->activa);

        //Documento
        if(!empty($request->documento)){
            $fileDoc = $request->file('documento');
            $tmpFilePathDoc = '/img/upload/';
            $tmpFileNameDoc = time() .'-'. 'doc-eq'.'-'.$id. '-name-' . $fileDoc->getClientOriginalName();
            $fileDoc->move(public_path() . $tmpFilePathDoc, $tmpFileNameDoc);
            $pathDoc = $tmpFilePathDoc . $tmpFileNameDoc;
        }elseif(!empty($request->adjunto_ori_documento)){
			$pathDoc = $request->adjunto_ori_documento;
		}else{
			$pathDoc = '';
		}
        //Foto 1
        if(!empty($request->fotografia_1)){
            $fileF1 = $request->file('fotografia_1');
            $tmpFilePathF1 = '/img/upload/';
            $tmpFileNameF1 = time() .'-'. 'f1-eq'.'-'.$id. '-name-' . $fileF1->getClientOriginalName();
            $fileF1->move(public_path() . $tmpFilePathF1, $tmpFileNameF1);
            $pathF1 = $tmpFilePathF1 . $tmpFileNameF1;
        }elseif(!empty($request->adjunto_ori_fotografia_1)){
			$pathF1 = $request->adjunto_ori_fotografia_1;
		}else{
			$pathF1 = '/img/system/equipo-generico.png';
		}

        //Foto 2
        if(!empty($request->fotografia_2)){
            $fileF2 = $request->file('fotografia_2');
            $tmpFilePathF2 = '/img/upload/';
            $tmpFileNameF2 = time() .'-'. 'f2-eq'.'-'.$id. '-name-' . $fileF2->getClientOriginalName();
            $fileF2->move(public_path() . $tmpFilePathF2, $tmpFileNameF2);
            $pathF2 = $tmpFilePathF2 . $tmpFileNameF2;
        }elseif(!empty($request->adjunto_ori_fotografia_2)){
			$pathF2 = $request->adjunto_ori_fotografia_2;
		}else{
			$pathF2 = '';
		}
        //Foto 3
        if(!empty($request->fotografia_3)){
            $fileF3 = $request->file('fotografia_3');
            $tmpFilePathF3 = '/img/upload/';
            $tmpFileNameF3 = time() .'-'. 'f3-eq'.'-'.$id. '-name-' . $fileF3->getClientOriginalName();
            $fileF3->move(public_path() . $tmpFilePathF3, $tmpFileNameF3);
            $pathF3 = $tmpFilePathF3 . $tmpFileNameF3;
        }elseif(!empty($request->adjunto_ori_fotografia_3)){
			$pathF3 = $request->adjunto_ori_fotografia_3;
		}else{
			$pathF3 = '';
		}

        $equipment = new Equipment();
        $equipment->equipo = $request->equipo;
        $equipment->tipo_equipo = $request->tipo_equipo;
        $equipment->supplier_id = $request->proveedor;
        $equipment->ubicacion = $request->ubicacion;
        $equipment->fecha_instalacion = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_instalacion)));
        $equipment->vida = $request->vida;
        $equipment->garantia = $request->garantia;
        $equipment->mantenimiento = $request->mantenimiento;

        $equipment->notas = $request->notas;
        $equipment->documento = $pathDoc;
        $equipment->fotografia_1 = $pathF1;
        $equipment->fotografia_2 = $pathF2;
        $equipment->fotografia_3 = $pathF3;

        $equipment->activa = $activa;
        $equipment->company_id = $company->id;
        $equipment->save();

        Session::flash('message', 'Nuevo equipo registrado correctamente.');
        return redirect()->route('equipment.machinery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Auth::user()->company;
        $equipment = Equipment::find($id);
        $suppliers = Supplier::where('company_id',$company->id )->lists('razon_social','id')->all();
        return view('equipments.show')
            ->with('equipment',$equipment)
            ->with('suppliers',$suppliers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Auth::user()->company;
        $equipment = Equipment::find($id);
        $suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('suppliers.razon_social', 'asc')->lists('razon_social','id')->all();
        return view('equipments.edit')
            ->with('equipment',$equipment)
            ->with('suppliers',$suppliers);
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
            'equipo' => 'required',
            'tipo_equipo' => 'required|not_in:0',
            'proveedor' => 'required|not_in:0',
            'ubicacion' => 'required',
            'fecha_instalacion' => 'required',
        ]);

        $id_user = Auth::user()->id;

        //Activacion
        $activa = (empty($request->activa) ? '0' : $request->activa);

        //Documento
        if(!empty($request->documento)){
            $fileDoc = $request->file('documento');
            $tmpFilePathDoc = '/img/upload/';
            $tmpFileNameDoc = time() .'-'. 'doc-eq'.'-'.$id. '-name-' . $fileDoc->getClientOriginalName();
            $fileDoc->move(public_path() . $tmpFilePathDoc, $tmpFileNameDoc);
            $pathDoc = $tmpFilePathDoc . $tmpFileNameDoc;
        }elseif(!empty($request->adjunto_ori_documento)){
			$pathDoc = $request->adjunto_ori_documento;
		}else{
			$pathDoc = '';
		}
        //Foto 1
        if(!empty($request->fotografia_1)){
            $fileF1 = $request->file('fotografia_1');
            $tmpFilePathF1 = '/img/upload/';
            $tmpFileNameF1 = time() .'-'. 'f1-eq'.'-'.$id. '-name-' . $fileF1->getClientOriginalName();
            $fileF1->move(public_path() . $tmpFilePathF1, $tmpFileNameF1);
            $pathF1 = $tmpFilePathF1 . $tmpFileNameF1;
        }elseif(!empty($request->adjunto_ori_fotografia_1)){
			$pathF1 = $request->adjunto_ori_fotografia_1;
		}else{
			$pathF1 = '/img/system/equipo-generico.png';
		}

        //Foto 2
        if(!empty($request->fotografia_2)){
            $fileF2 = $request->file('fotografia_2');
            $tmpFilePathF2 = '/img/upload/';
            $tmpFileNameF2 = time() .'-'. 'f2-eq'.'-'.$id. '-name-' . $fileF2->getClientOriginalName();
            $fileF2->move(public_path() . $tmpFilePathF2, $tmpFileNameF2);
            $pathF2 = $tmpFilePathF2 . $tmpFileNameF2;
        }elseif(!empty($request->adjunto_ori_fotografia_2)){
			$pathF2 = $request->adjunto_ori_fotografia_2;
		}else{
			$pathF2 = '';
		}
        //Foto 3
        if(!empty($request->fotografia_3)){
            $fileF3 = $request->file('fotografia_3');
            $tmpFilePathF3 = '/img/upload/';
            $tmpFileNameF3 = time() .'-'. 'f3-eq'.'-'.$id. '-name-' . $fileF3->getClientOriginalName();
            $fileF3->move(public_path() . $tmpFilePathF3, $tmpFileNameF3);
            $pathF3 = $tmpFilePathF3 . $tmpFileNameF3;
        }elseif(!empty($request->adjunto_ori_fotografia_3)){
			$pathF3 = $request->adjunto_ori_fotografia_3;
		}else{
			$pathF3 = '';
		}

        $equipment = Equipment::find($id);
        $equipment->equipo = $request->equipo;
        $equipment->tipo_equipo = $request->tipo_equipo;
        $equipment->supplier_id = $request->proveedor;
        $equipment->ubicacion = $request->ubicacion;
        $equipment->fecha_instalacion = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_instalacion)));
        $equipment->vida = $request->vida;
        $equipment->garantia = $request->garantia;
        $equipment->mantenimiento = $request->mantenimiento;


        $equipment->documento = $pathDoc;
        $equipment->fotografia_1 = $pathF1;
        $equipment->fotografia_2 = $pathF2;
        $equipment->fotografia_3 = $pathF3;
        


        $equipment->activa = $activa;
        $equipment->save();

        Session::flash('message', 'Equipo actualizado correctamente.');
        return redirect()->route('equipment.machinery.index');
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
