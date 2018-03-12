<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Account;
use App\Bank;
use Auth;
use Session;
use App\Http\Requests;

class AccountController extends Controller
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

        $accounts = Account::where('company_id',$company->id );
        return view('accounts.index')->with('accounts',$accounts->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all()->lists('nombre','id');
        return view('accounts.create')->with('banks',$banks);
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
            'tipo_cuenta' => 'required|not_in:0',
            'banco' => 'required',
            //'nota' => 'required',
        ]);

        $company = Auth::user()->company;
        $activa = (empty($request->activa) ? '0' : $request->activa);

        $account = new Account();
        $account->nombre = $request->nombre;
        $account->nro_cuenta = $request->nro_cuenta;
        $account->tipo_cuenta = $request->tipo_cuenta;
        $account->bank_id = $request->banco;
        $account->nombre_cuentahabiente = $request->nombre_cuentahabiente;
        $account->nota = $request->nota;
        $account->activa = $activa;
		$account->balance_inicial = $request->balance_inicial;
        $account->company_id = $company->id;

        $account->save();
        Session::flash('message', 'Nueva cuenta registrada correctamente.');
        return redirect()->route('config.account.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);
        $banks = Bank::all()->lists('nombre','id');
        return view('accounts.show')
            ->with('account',$account)
            ->with('banks',$banks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = Account::find($id);
        $banks = Bank::all()->lists('nombre','id');
        return view('accounts.edit')
            ->with('account',$account)
            ->with('banks',$banks);
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
            'tipo_cuenta' => 'required|not_in:0',
            'banco' => 'required',
            //'nota' => 'required',
        ]);

        $activa = (empty($request->activa) ? '0' : $request->activa);

        $account = Account::find($id);
        $account->nombre = $request->nombre;
        $account->nro_cuenta = $request->nro_cuenta;
        $account->tipo_cuenta = $request->tipo_cuenta;
        $account->bank_id = $request->banco;
        $account->nombre_cuentahabiente = $request->nombre_cuentahabiente;
        $account->nota = $request->nota;
        $account->activa = $activa;
		$account->balance_inicial = $request->balance_inicial;
        $account->save();
        Session::flash('message', 'Cuenta actualizada correctamente.');
        return redirect()->route('config.account.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = Account::find($id);
		$account->delete();
		return redirect()->route('config.account.index');
    }
}
