<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Auth;
use Session;
use App\Property;
use App\Quota;
use App\Accountsreceivable;
use App\Sendalertpayment;

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
		$quotas = Quota::where('company_id',$company->id );
		$properties = Property::where('company_id',$company->id )->lists('nro','id')->all();
        return view('accountsreceivables.create')
		->with('properties',$properties)
		->with('quotas',$quotas->get());
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
		if($request->propiedad == 'todas'){
			$properties = Property::where('company_id',$company->id )->get();
			
			foreach($properties as $property){
				$accountsreceivable = new Accountsreceivable();
				$accountsreceivable->gestion = $request->gestion;
				$accountsreceivable->periodo = $request->periodo;
				$accountsreceivable->fecha_vencimiento = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha_vencimiento)));
				$accountsreceivable->cantidad = '0';
				$accountsreceivable->importe_por_cobrar = $request->importe_por_cobrar;
				$accountsreceivable->importe_abonado = $request->importe_abonado;
				$accountsreceivable->cancelada = $request->cancelada;
				$accountsreceivable->quota_id = $request->cuota;
				$accountsreceivable->property_id = $property->id;
				$accountsreceivable->company_id = $company->id;
				$accountsreceivable->user_id = Auth::user()->id;
				$accountsreceivable->save();
			}
			
		}else{

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
		}
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
		return redirect()->route('transaction.accountsreceivable.index');
    }
	
	public function copy($id)
    {
        $company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->lists('nro','id');
        $accountsreceivable = Accountsreceivable::find($id);
        return view('accountsreceivables.copy')
            ->with('accountsreceivable',$accountsreceivable)
			->with('properties',$properties)
			->with('quotas',$quotas);
    }
	
	
	
	public function generate()
    {
        return view('accountsreceivables.generate');
    }
	
	public function searchgenerate(Request $request){
		$this->validate($request, [
            'gestion' => 'required',
            'periodo' => 'required',
        ]);
		
		$fecha_vencimiento = date("m-d-y");
		$gestion = $request->gestion;
		$periodo = $request->periodo;
		
		$quotas = DB::table('quotas')
				->where('frecuencia_pago','Mensual')
				->where('activa','1')
				->select(DB::raw(
						'"'.$fecha_vencimiento.'" as fecha_vencimiento,'.
						'"'.$gestion.'" as gestion,'.
						'"'.$periodo.'" as periodo,'.
						'importe as importe_por_cobrar,0 as importe_abonado,0 as cantidad,0 as cancelada, importe,tipo_importe'))
				->get();
		dd($quotas);
		//$accountsreceivables = DB::table('accountsreceivables');
		
		
	}

	public function send()
    {
		$company = Auth::user()->company;
		$sendalertpayments = Sendalertpayment::where('company_id',$company->id );
		return view('accountsreceivables.send')->with('sendalertpayments',$sendalertpayments->get());
    }
	
	public function generatenotification(){
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->lists('nro','id')->all();

		return view('accountsreceivables.generatenotification')->with('properties',$properties);
	}
	
	public function sendnotification(Request $request){
		dd($request);
	}
	
	public function registernotification(){
		//Historial de Notificaciones de pago enviadas
	}
	
	public function storealertpayment(Request $request){
		$this->validate($request, [
            'gestion' => 'required',
            'periodo' => 'required',
            'propiedad' => 'required',
			'asunto' => 'required',
			'nota' => 'required'
        ]);
		
		
		
		$company = Auth::user()->company;

		if($request->propiedad == 'todas'){
		$properties = DB::table('properties')
				->join('accountsreceivables', 'properties.id', '=', 'accountsreceivables.property_id')
				->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
				->join('categories', 'categories.id', '=', 'quotas.category_id')	
				->where('gestion','<=',$request->gestion)
				->where('periodo','<=',$request->periodo)
				->where('cancelada','0')
				->select(
						array('properties.id as id','accountsreceivables.id as accountsreceivable_id', 'nro as propiedad', 'gestion','periodo','fecha_vencimiento','importe_por_cobrar','accountsreceivables.property_id','quota_id','user_id','cuota','frecuencia_pago','tipo_importe',
							DB::raw("GROUP_CONCAT(accountsreceivables.id SEPARATOR ',') as id_cuenta_pagar,
								     GROUP_CONCAT(cuota SEPARATOR ',') as cuotas,
									 GROUP_CONCAT(importe_por_cobrar SEPARATOR ',') as importes,
									 GROUP_CONCAT(frecuencia_pago SEPARATOR ',') as frecuencias,
									 GROUP_CONCAT(fecha_vencimiento SEPARATOR ',') as fechas_vencimientos,
									 GROUP_CONCAT(periodo SEPARATOR ',') as periodos,
									 GROUP_CONCAT(gestion SEPARATOR ',') as gestiones,
									 GROUP_CONCAT(categories.nombre SEPARATOR ',') as categorias,
									 sum(importe_por_cobrar) as importe_total")
							)
						)
				->groupBy('nro')
				->groupBy('properties.id')
				->get();
		}else{
			$properties = DB::table('properties')
				->join('accountsreceivables', 'properties.id', '=', 'accountsreceivables.property_id')
				->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
				->leftJoin('contacts', 'contacts.property_id', '=', 'accountsreceivables.property_id')	
				->where('gestion','<=',$request->gestion)
				->where('periodo','<=',$request->periodo)
				->where('property_id',$request->propiedad)	
				->where('correspondencia','like','%Cobranzas%')	
				->where('cancelada','0')	
				->select(
						array('properties.id as id','accountsreceivables.id as accountsreceivable_id', 'nro as propiedad', 'gestion','periodo','fecha_vencimiento','importe_por_cobrar','accountsreceivables.property_id','quota_id','user_id','cuota','frecuencia_pago','tipo_importe',
							DB::raw("GROUP_CONCAT(accountsreceivables.id SEPARATOR ',') as id_cuenta_pagar,
								     GROUP_CONCAT(cuota SEPARATOR ',') as cuotas,
									 GROUP_CONCAT(importe_por_cobrar SEPARATOR ',') as importes,
									 GROUP_CONCAT(frecuencia_pago SEPARATOR ',') as frecuencias,
									 GROUP_CONCAT(fecha_vencimiento SEPARATOR ',') as fechas_vencimientos,
									 GROUP_CONCAT(periodo SEPARATOR ',') as periodos,
									 GROUP_CONCAT(gestion SEPARATOR ',') as gestiones,
									 GROUP_CONCAT(categories.nombre SEPARATOR ',') as categorias,
									 sum(importe_por_cobrar) as importe_total")
							)
						)
				->groupBy('nro')				
				->get();
		}
		
		foreach ($properties as $propertypayment){
		 
			$sendalertpayment = new Sendalertpayment();
			$sendalertpayment->asunto = $request->asunto;
			$sendalertpayment->nota = $request->nota;
			$sendalertpayment->limite_periodo = $request->periodo;
			$sendalertpayment->limite_gestion = $request->gestion;
			$sendalertpayment->property_id = $propertypayment->id;
			$sendalertpayment->importe_total = $propertypayment->importe_total;
			$sendalertpayment->id_cuentas_pagar = $propertypayment->id_cuenta_pagar;
			$sendalertpayment->nombre_cuotas = $propertypayment->cuotas;
			$sendalertpayment->categoria_cuotas = $propertypayment->categorias;
			$sendalertpayment->importes = $propertypayment->importes;	
			$sendalertpayment->frecuencias = $propertypayment->frecuencias;
			$sendalertpayment->fecha_vencimientos = $propertypayment->fechas_vencimientos;
			$sendalertpayment->periodos = $propertypayment->periodos;
			$sendalertpayment->gestiones = $propertypayment->gestiones;
			$sendalertpayment->correos = '';
			$sendalertpayment->fecha_envio = '0';
			$sendalertpayment->enviado = '0';
			
			$sendalertpayment->company_id = $company->id;
			$sendalertpayment->save();
		}
		dd($properties);
	}


	public function printing($id)
    {
		$company = Auth::user()->company;
        $sendalertpayment = Sendalertpayment::find($id);
		$logotipo = $company->logotipo;
		$formapago = $company->forma_pago;
		$correoempresa = Auth::user()->email;
        return view('accountsreceivables.print')
		->with('sendalertpayment',$sendalertpayment)
		->with('logotipo',$logotipo)
		->with('formapago',$formapago)
		->with('correoempresa',$correoempresa);
    }
}
