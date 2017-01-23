<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Property;
use App\Contact;
use App\Account;
use App\Transaction;
use App\Collection;
use App\Accountsreceivable;
use App\Http\Requests;

class CollectionController extends Controller
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
        return view('collections.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->lists('nro','id')->all();
		$accounts = Account::where('company_id',$company->id )->lists('nombre','id')->all();
        return view('collections.create')
		->with('properties',$properties)
		->with('accounts',$accounts);
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
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
			'cuotas' => 'required',
			'fecha' => 'required',
			'concepto' => 'required',
            'cuenta' => 'required|not_in:0',
			'forma_pago' => 'required',
        ]);
		$numero_documento = Transaction::where('user_id',Auth::user()->id)->max('nro_documento');
		//dd($numero_documento);
		
		$company = Auth::user()->company;
		
		$transaction = new Transaction();
		$transaction->nro_documento = $numero_documento+1;
		$transaction->tipo_transaccion = 'Ingreso';
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->forma_pago;
		$transaction->numero_forma_pago = $request->nro_forma_pago;
		$transaction->importe_credito = $request->importe_total;
		$transaction->importe_debito= '0';
		$transaction->notas = $request->notas;
		$transaction->user_id= Auth::user()->id;
		$transaction->save();
		
		$collection = new Collection();
		$collection->cuotas = implode(',', $request->cuotas);
		$collection->property_id = $request->propiedad;
		$collection->company_id = $request->concepto;
		$collection->contact_id = $request->contacto;
		$collection->account_id = $request->cuenta;
		$collection->company_id = $company->id;
		//$collection->transaction_id = $request->concepto;
		$transaction->collection()->save($collection);
		
		
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$collection = Collection::find($id);
		$cuotas = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->get();
		return view('collections.show')->with('collection',$collection)->with('cuotas',$cuotas);
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
