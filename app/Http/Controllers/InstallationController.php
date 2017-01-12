<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Installation;
use App\Http\Requests;

class InstallationController extends Controller
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

        $installations = Installation::where('company_id',$company->id );
        return view('installations.index')->with('installations',$installations->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('installations.create');
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
            'instalacion' => 'required',
            'descripcion' => 'required',
            'costo' => 'required',
            'dias_permitidos' => 'required',
            'hora_dia_semana_hasta' => 'required',
            'hora_fin_de_semana_hasta' => 'required',
            'normas' => 'required',

        ]);


        $id = Auth::user()->id;
        $company = Auth::user()->company;

        //Requiere reserva
        $requiere_reserva = (empty($request->requiere_reserva) ? '0' : $request->requiere_reserva);

        //Reserva deuda
        $reserva_deuda = (empty($request->reserva_deuda) ? '0' : $request->reserva_deuda);

        //Activacion
        $activa = (empty($request->activa) ? '0' : $request->activa);

        //Dias permitidos
        $dias_permitidos = implode(",", $request->dias_permitidos);

        //Reglamento
		if(!empty($request->reglamento)){
        $fileReglamento = $request->file('reglamento');
        $tmpFilePathReglamento = '/img/upload/';
        $tmpFileNameReglamento = time() .'-'. 'rg-in'.'-'.$id. '-' . $fileReglamento->getClientOriginalName();
        $fileReglamento->move(public_path() . $tmpFilePathReglamento, $tmpFileNameReglamento);
        $pathReglamento = $tmpFilePathReglamento . $tmpFileNameReglamento;
		}else{
			$pathReglamento= '/img/system/imagedefault.png';
		}
        //Foto Principal
		if(!empty($request->fotografia_principal)){
        $fileFp = $request->file('fotografia_principal');
        $tmpFilePathFp = '/img/upload/';
        $tmpFileNameFp = time() .'-'. 'fp-in'.'-'.$id. '-' . $fileFp->getClientOriginalName();
        $fileFp->move(public_path() . $tmpFilePathFp, $tmpFileNameFp);
        $pathFp = $tmpFilePathFp . $tmpFileNameFp;
		}else{
			$pathFp = '/img/system/imagedefault.png';
		}
        //Foto 1
		if(!empty($request->fotografia_1)){
        $fileF1 = $request->file('fotografia_1');
        $tmpFilePathF1 = '/img/upload/';
        $tmpFileNameF1 = time() .'-'. 'f1-in'.'-'.$id. '-' . $fileF1->getClientOriginalName();
        $fileF1->move(public_path() . $tmpFilePathF1, $tmpFileNameF1);
        $pathF1 = $tmpFilePathF1 . $tmpFileNameF1;
		}else{
			$pathF1 = '/img/system/imagedefault.png';
		}
        //Foto 2
		if(!empty($request->fotografia_2)){
        $fileF2 = $request->file('fotografia_2');
        $tmpFilePathF2 = '/img/upload/';
        $tmpFileNameF2 = time() .'-'. 'f2-in'.'-'.$id. '-' . $fileF1->getClientOriginalName();
        $fileF2->move(public_path() . $tmpFilePathF2, $tmpFileNameF2);
        $pathF2 = $tmpFilePathF2 . $tmpFileNameF2;
		}else{
			$pathF2 = '/img/system/imagedefault.png';
		}
        //Foto 3
		if(!empty($request->fotografia_3)){
        $fileF3 = $request->file('fotografia_3');
        $tmpFilePathF3 = '/img/upload/';
        $tmpFileNameF3 = time() .'-'. 'f3-in'.'-'.$id. '-' . $fileF3->getClientOriginalName();
        $fileF3->move(public_path() . $tmpFilePathF3, $tmpFileNameF3);
        $pathF3 = $tmpFilePathF3 . $tmpFileNameF3;
		}else{
			$pathF3 = '/img/system/imagedefault.png';
		}

        $installation = new Installation();
        $installation->instalacion = $request->instalacion;
        $installation->descripcion = $request->descripcion;
        $installation->costo = $request->costo;
        $installation->requiere_reserva = $requiere_reserva;
        $installation->reserva_deuda = $reserva_deuda;
        $installation->dias_permitidos = $dias_permitidos;
        $installation->hora_dia_semana_hasta = $request->hora_dia_semana_hasta;
        $installation->hora_fin_de_semana_hasta = $request->hora_fin_de_semana_hasta;
        $installation->normas = $request->normas;
		
        $installation->reglamento = $pathReglamento;
        $installation->fotografia_principal = $pathFp;
        $installation->fotografia_1 = $pathF1;
        $installation->fotografia_2 = $pathF2;
        $installation->fotografia_3 = $pathF3;

        $installation->activa = $activa;
        $installation->company_id = $company->id;
        $installation->save();
        Session::flash('message', 'Nueva Instalación común registrada correctamente.');
        return redirect()->route('config.installation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $installation = Installation::find($id);
        return view('installations.show')
            ->with('installation',$installation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $installation = Installation::find($id);
        return view('installations.edit')
            ->with('installation',$installation);
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
            'instalacion' => 'required',
            'descripcion' => 'required',
            'costo' => 'required',
            'dias_permitidos' => 'required',
            'hora_dia_semana_hasta' => 'required',
            'hora_fin_de_semana_hasta' => 'required',
            'normas' => 'required'
        ]);


        $id_user = Auth::user()->id;

        //Requiere reserva
        $requiere_reserva = (empty($request->requiere_reserva) ? '0' : $request->requiere_reserva);

        //Reserva deuda
        $reserva_deuda = (empty($request->reserva_deuda) ? '0' : $request->reserva_deuda);

        //Activacion
        $activa = (empty($request->activa) ? '0' : $request->activa);

        //Dias permitidos
        $dias_permitidos = implode(",", $request->dias_permitidos);

        //Reglamento
        if(!empty($request->reglamento)){
            $fileReglamento = $request->file('reglamento');
            $tmpFilePathReglamento = '/img/upload/';
            $tmpFileNameReglamento = time() .'-'. 'rg'.'-'.$id_user. '-' . $fileReglamento->getClientOriginalName();
            $fileReglamento->move(public_path() . $tmpFilePathReglamento, $tmpFileNameReglamento);
            $pathReglamento = $tmpFilePathReglamento . $tmpFileNameReglamento;
        }
        //Foto Principal
        if(!empty($request->fotografia_principal)){
            $fileFp = $request->file('fotografia_principal');
            $tmpFilePathFp = '/img/upload/';
            $tmpFileNameFp = time() .'-'. 'fp'.'-'.$id_user. '-' . $fileFp->getClientOriginalName();
            $fileFp->move(public_path() . $tmpFilePathFp, $tmpFileNameFp);
            $pathFp = $tmpFilePathFp . $tmpFileNameFp;
        }
        //Foto 1
        if(!empty($request->fotografia_1)){
            $fileF1 = $request->file('fotografia_1');
            $tmpFilePathF1 = '/img/upload/';
            $tmpFileNameF1 = time() .'-'. 'f1'.'-'.$id_user. '-' . $fileF1->getClientOriginalName();
            $fileF1->move(public_path() . $tmpFilePathF1, $tmpFileNameF1);
            $pathF1 = $tmpFilePathF1 . $tmpFileNameF1;
        }
        //Foto 2
        if(!empty($request->fotografia_2)){
            $fileF2 = $request->file('fotografia_2');
            $tmpFilePathF2 = '/img/upload/';
            $tmpFileNameF2 = time() .'-'. 'f2'.'-'.$id_user. '-' . $fileF1->getClientOriginalName();
            $fileF2->move(public_path() . $tmpFilePathF2, $tmpFileNameF2);
            $pathF2 = $tmpFilePathF2 . $tmpFileNameF2;
        }
        //Foto 3
        if(!empty($request->fotografia_3)){
            $fileF3 = $request->file('fotografia_3');
            $tmpFilePathF3 = '/img/upload/';
            $tmpFileNameF3 = time() .'-'. 'f3'.'-'.$id_user. '-' . $fileF3->getClientOriginalName();
            $fileF3->move(public_path() . $tmpFilePathF3, $tmpFileNameF3);
            $pathF3 = $tmpFilePathF3 . $tmpFileNameF3;
        }

        $installation = Installation::find($id);
        $installation->instalacion = $request->instalacion;
        $installation->descripcion = $request->descripcion;
        $installation->costo = $request->costo;
        $installation->requiere_reserva = $requiere_reserva;
        $installation->reserva_deuda = $reserva_deuda;
        $installation->dias_permitidos = $dias_permitidos;
        $installation->hora_dia_semana_hasta = $request->hora_dia_semana_hasta;
        $installation->hora_fin_de_semana_hasta = $request->hora_fin_de_semana_hasta;
        $installation->normas = $request->normas;
        if(!empty($request->reglamento)){
            $installation->reglamento = $pathReglamento;
        }
        if(!empty($request->fotografia_principal)){
            $installation->fotografia_principal = $pathFp;

        }
        if(!empty($request->fotografia_1)){
            $installation->fotografia_1 = $pathF1;

        }
        if(!empty($request->fotografia_2)){
            $installation->fotografia_2 = $pathF2;

        }
        if(!empty($request->fotografia_3)){
            $installation->fotografia_3 = $pathF3;

        }

        $installation->activa = $activa;
        $installation->save();
        Session::flash('message', 'Instalación común actualizada correctamente.');
        return redirect()->route('config.installation.index');
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
