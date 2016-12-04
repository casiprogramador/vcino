<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Session;
use App\Property;
use App\Quota;
use App\Accountsreceivable;

class AccountsReceivableController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;

        $accountsreceivables = Accountsreceivable::where('company_id',$company->id );

        return view('accountsreceivables.index')->with('accountsreceivables',$accountsreceivables->get());
    }

    public function create()
    {
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
        return view('accountsreceivables.create')
		->with('properties',$properties)
		->with('quotas',$quotas);
    }
	
	public function store(Request $request)
    {
        $this->validate($request, [
            'gestion' => 'required',
            'periodo' => 'required',
            'fecha_vencimiento' => 'required',
            //'cantidad' => 'required',
			'importe_por_cobrar' => 'required',
			'importe_abonado' => 'required',
			'cancelada' => 'required',
			'cuota' => 'required',
			'propiedad' => 'required',
        ]);
		
		$company = Auth::user()->company;
		 
		$accountsreceivable = new Accountsreceivable();
		$accountsreceivable->gestion = $request->gestion;
		$accountsreceivable->periodo = $request->periodo;
		$accountsreceivable->fecha_vencimiento = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_vencimiento)));
		$accountsreceivable->cantidad = '0';
		$accountsreceivable->importe_por_cobrar = $request->importe_por_cobrar;
		$accountsreceivable->importe_abonado = $request->importe_abonado;
		$accountsreceivable->cancelada = $request->cancelada;
		$accountsreceivable->quota_id = $request->cuota;
		$accountsreceivable->property_id = $request->propiedad;
		$accountsreceivable->company_id = $company->id;
		$accountsreceivable->user_id = Auth::user()->id;
		$accountsreceivable->save();
        Session::flash('message', 'Nueva cuota por cobrar correctamente.');
        return redirect()->route('transaction.accountsreceivable.index');
		 
    }
	
	public function edit($id)
    {
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
        $accountsreceivable = Accountsreceivable::find($id);
        return view('accountsreceivables.edit')
            ->with('accountsreceivable',$accountsreceivable)
			->with('properties',$properties)
			->with('quotas',$quotas);
    }
	
	public function update(Request $request, $id)
    {
		$this->validate($request, [
            'gestion' => 'required',
            'periodo' => 'required',
            'fecha_vencimiento' => 'required',
            //'cantidad' => 'required',
			'importe_por_cobrar' => 'required',
			'importe_abonado' => 'required',
			'cancelada' => 'required',
			'cuota' => 'required',
			'propiedad' => 'required',
        ]);

		
		$company = Auth::user()->company;
		 
		$accountsreceivable = Accountsreceivable::find($id);
		$accountsreceivable->gestion = $request->gestion;
		$accountsreceivable->periodo = $request->periodo;
		$accountsreceivable->fecha_vencimiento = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_vencimiento)));
		$accountsreceivable->cantidad = '0';
		$accountsreceivable->importe_por_cobrar = $request->importe_por_cobrar;
		$accountsreceivable->importe_abonado = $request->importe_abonado;
		$accountsreceivable->cancelada = $request->cancelada;
		$accountsreceivable->quota_id = $request->cuota;
		$accountsreceivable->property_id = $request->propiedad;
		$accountsreceivable->company_id = $company->id;
		$accountsreceivable->user_id = Auth::user()->id;
		$accountsreceivable->save();
        Session::flash('message', 'Cuota por cobrar editada correctamente.');
        return redirect()->route('transaction.accountsreceivable.index');
	}
	

    public function show($id)
    {
        $company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
        $accountsreceivable = Accountsreceivable::find($id);
        return view('accountsreceivables.show')
            ->with('accountsreceivable',$accountsreceivable)
			->with('properties',$properties)
			->with('quotas',$quotas);
    }
	
	public function destroy($id)
    {
        $accountsreceivable = Accountsreceivable::find($id);
		$accountsreceivable->delete();
		return redirect()->route('communication.communication.index');
    }
	
	
	public function generate()
    {
        return view('accountsreceivables.generate');
    }
	
	public function send()
    {
        return view('accountsreceivables.send');
    }
}
