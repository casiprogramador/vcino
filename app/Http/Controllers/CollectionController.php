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
use Illuminate\Support\Facades\DB;
use Mail;
use Session;
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
		$company = Auth::user()->company;

		$collections = Collection::where('company_id',$company->id );
        return view('collections.index')->with('collections',$collections->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->lists('nombre','id')->all();
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
		$company = Auth::user()->company;
		$numero_documento = Transaction::where('user_id',Auth::user()->id)->where('tipo_transaccion','Ingreso')->max('nro_documento');

		$cobranzas_verificar = DB::table('collections')
					->select('collections.id')
  					->join('transactions', 'transactions.id', '=', 'collections.transaction_id')
  					->where('transactions.anulada',0)
  					->where('collections.cuotas',implode(',', $request->cuotas))
					->where('company_id',$company->id )
					->get();
		

		if(count($cobranzas_verificar) === 0){
			
		
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
			$collection->contact_id = $request->contacto;
			$collection->account_id = $request->cuenta;
			$collection->company_id = $company->id;
			//$collection->transaction_id = $request->concepto;
			$transaction->collection()->save($collection);

			$cuotas = $request->cuotas;
			foreach ($cuotas as $cuota_id){
				$cuota = Accountsreceivable::find($cuota_id);
				$cuota->cancelada = 1;
				$cuota->id_collection = $collection->id;
				$cuota->save();
			}

			//$collection->id;
			Session::flash('message', 'Transacción registrada correctamente.');
			return redirect()->route('transaction.collection.show', [\Crypt::encrypt($collection->id)]);
		}else{
			$last_collection = Collection::where('company_id',$company->id )->orderBy('created_at','desc')->first();
			return redirect()->route('transaction.collection.show', [\Crypt::encrypt($last_collection->id)]);
		}
		
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$id = \Crypt::decrypt($id);
		$company = Auth::user()->company;
		$collection = Collection::find($id);
		$contacts = Contact::where('company_id',$company->id )->where('activa',1)->where('email','<>','')->where('property_id',$collection->property_id)->get();
		$contacts = $contacts->lists('FullName','id')->all();
		
		$cuotas = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->get();
		return view('collections.show')
				->with('collection',$collection)
				->with('cuotas',$cuotas)
				->with('contacts',$contacts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$id = \Crypt::decrypt($id);
		$collection= Collection::find($id);
        $company = Auth::user()->company;

		$properties = Property::where('company_id',$company->id )->lists('nro','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->lists('nombre','id')->all();
		
		$contacts = Contact::where('company_id',$company->id )->where('property_id', $collection->property_id)->where('activa','1')->get();
		$contacts = $contacts->lists('FullName','id')->all();
		$cuotas_cobradas = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->get();
		$cuotas =  Accountsreceivable::where('company_id',$company->id )->where('cancelada',0)->where('property_id',$collection->property_id)->get();
        return view('collections.edit')
		->with('properties',$properties)
		->with('contacts',$contacts)
		->with('accounts',$accounts)
		->with('cuotas',$cuotas)
		->with('cuotas_cobradas',$cuotas_cobradas)
		->with('collection',$collection);
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
			'propiedad' => 'required|not_in:0',
			'contacto' => 'required|not_in:0',
			'cuotas' => 'required',
			'fecha' => 'required',
			'concepto' => 'required',
            'cuenta' => 'required|not_in:0',
			'forma_pago' => 'required',
        ]);
		$company = Auth::user()->company;
		if($request->cuotas_originales == implode(',', $request->cuotas)){
			$cuotas_guardar = $request->cuotas_originales;
			
		}else{
			$quotes = Accountsreceivable::whereIn('id',  explode(',', $request->cuotas_originales))->update(['cancelada' => '0']);
			$quotes = Accountsreceivable::whereIn('id',  explode(',', $request->cuotas_originales))->update(['id_collection' => '0']);
			$quotes = Accountsreceivable::whereIn('id',  $request->cuotas)->update(['cancelada' => '1']);
			$quotes = Accountsreceivable::whereIn('id',  $request->cuotas)->update(['id_collection' => $id]);
			$cuotas_guardar = implode(',', $request->cuotas);
			
		}
		
		$collection = Collection::find($id);
		$collection->cuotas = $cuotas_guardar;
		$collection->property_id = $request->propiedad;
		$collection->contact_id = $request->contacto;
		$collection->account_id = $request->cuenta;
		$collection->save();

		$transaction = Transaction::find($collection->transaction_id);
		$transaction->tipo_transaccion = 'Ingreso';
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->forma_pago;
		$transaction->numero_forma_pago = $request->nro_forma_pago;
		$transaction->importe_credito = $request->importe_total;
		$transaction->importe_debito= '0';
		$transaction->notas = $request->notas;
		$transaction->save();
		
		return redirect()->route('transaction.collection.show', [\Crypt::encrypt($collection->id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function sendemail(Request $request){
		$this->validate($request, [
			'contacto' => 'required|not_in:0',
        ]);
		
		$company = Auth::user()->company;
		
		$collection = Collection::find($request->id_collection);
		$cuotas = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->get();
		$contact = Contact::find($request->contacto);
		
		$data = [
				'nombre_remitente' => $company->nombre,
				'email_remitente' => Auth::user()->email,
				'email_contancto' => $contact->email,
				'nombre_contacto'=> $contact->nombre.' '.$contact->apellido,
				'comunicado_asunto' => 'Comprobante de pago',
				'collection' => $collection,
				'cuotas' => $cuotas
			  ];
		
						
			Mail::send('emails.collection',$data, function ($m) use ($data) {
				$m->from($data['email_remitente'],$data['nombre_remitente']);
				$m->to($data['email_contancto'], $data['nombre_contacto'])->subject($data['comunicado_asunto']);
			});
			if (Mail::failures()) {
				Session::flash('message', 'error');
			}else{
				Session::flash('message', 'exito');
			}
			return redirect()->route('transaction.collection.index');
		
	}
    public function destroy($id)
    {
        //
    }
	
	public function pdf($id){
		$collection = Collection::find($id);
		$cuotas = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->get();
		$pdf = \PDF::loadView('pdf.collection', compact('collection','cuotas'));
		$nombre_documento = "recibo_ingreso_nro_".str_pad($collection->transaction->nro_documento, 6, "0", STR_PAD_LEFT);
		return $pdf->download($nombre_documento.".pdf");
	}
}
