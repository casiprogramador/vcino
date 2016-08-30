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
    public function index()
    {
        return view('installations.index');
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
            'reglamento' => 'required',
            'fotografia_principal'	=>	'required | mimes:jpeg,jpg,png',
            'fotografia_1'	=>	'required | mimes:jpeg,jpg,png',
            'fotografia_2'	=>	'required | mimes:jpeg,jpg,png',
            'fotografia_3'	=>	'required | mimes:jpeg,jpg,png'
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
        $fileReglamento = $request->file('reglamento');
        $tmpFilePathReglamento = '/img/upload/';
        $tmpFileNameReglamento = time() .'-'. 'rg'.'-'.$id. '-' . $fileReglamento->getClientOriginalName();
        $fileReglamento->move(public_path() . $tmpFilePathReglamento, $tmpFileNameReglamento);
        $pathReglamento = $tmpFilePathReglamento . $tmpFileNameReglamento;
        //Foto Principal
        $fileFp = $request->file('fotografia_principal');
        $tmpFilePathFp = '/img/upload/';
        $tmpFileNameFp = time() .'-'. 'fp'.'-'.$id. '-' . $fileFp->getClientOriginalName();
        $fileFp->move(public_path() . $tmpFilePathFp, $tmpFileNameFp);
        $pathFp = $tmpFilePathFp . $tmpFileNameFp;
        //Foto 1
        $fileF1 = $request->file('fotografia_1');
        $tmpFilePathF1 = '/img/upload/';
        $tmpFileNameF1 = time() .'-'. 'f1'.'-'.$id. '-' . $fileF1->getClientOriginalName();
        $fileF1->move(public_path() . $tmpFilePathF1, $tmpFileNameF1);
        $pathF1 = $tmpFilePathF1 . $tmpFileNameF1;
        //Foto 2
        $fileF2 = $request->file('fotografia_2');
        $tmpFilePathF2 = '/img/upload/';
        $tmpFileNameF2 = time() .'-'. 'f2'.'-'.$id. '-' . $fileF1->getClientOriginalName();
        $fileF2->move(public_path() . $tmpFilePathF2, $tmpFileNameF2);
        $pathF2 = $tmpFilePathF2 . $tmpFileNameF2;
        //Foto 3
        $fileF3 = $request->file('fotografia_3');
        $tmpFilePathF3 = '/img/upload/';
        $tmpFileNameF3 = time() .'-'. 'f3'.'-'.$id. '-' . $fileF3->getClientOriginalName();
        $fileF3->move(public_path() . $tmpFilePathF3, $tmpFileNameF3);
        $pathF3 = $tmpFilePathF3 . $tmpFileNameF3;

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
        Session::flash('message', 'Nueva instalacion ingresada correctamente');
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
        //
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
        //
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
