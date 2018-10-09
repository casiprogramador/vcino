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
use App\Contact;
use App\Subject;
use App\Gestion;
use App\Task;
use Mail;

class AccountsReceivableController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $company = Auth::user()->company;

        $accountsreceivables = Accountsreceivable::where('company_id',$company->id )->where('cancelada',0);
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->orderBy('cuota', 'asc')->lists('cuota','id')->all();
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$gestiones = Gestion::orderBy('nombre', 'asc')->lists('nombre','nombre')->all();

        return view('accountsreceivables.index')
		->with('properties',$properties)
		->with('quotas',$quotas)
		->with('gestiones',$gestiones)
		->with('accountsreceivables',$accountsreceivables->get());
    }

    public function create()
    {
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->orderBy('cuota', 'asc');
		$gestiones = Gestion::orderBy('nombre', 'asc')->lists('nombre','nombre')->all();
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc');

        return view('accountsreceivables.create')
		->with('properties',$properties->get())
		->with('gestiones',$gestiones)
		->with('quotas',$quotas->get())
		->with('dias_mora',$company->dias_mora);
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
			'cuota' => 'required|not_in:0',
			'propiedad' => 'required',
        ]);
		$company = Auth::user()->company;
		$year=$request->gestion;
		$month=$request->periodo;
		$date = new \DateTime($year.'-'.$month.'-'.'01');
		$quota = Quota::find($request->cuota);

			//Validar propiedad, gestion, periodo, cuota
			$accountsreceivable_validate = Accountsreceivable::where('gestion',$request->gestion)
					->where('periodo',$request->periodo)
					->where('property_id',$request->propiedad)
					->where('quota_id',$request->cuota)->get();
			if(count($accountsreceivable_validate) && $quota->frecuencia_pago != 'Variable'){
				Session::flash('message', 'Ya existe una cuota por cobrar para el periodo seleccionado. No se registraron nuevas cuotas.');
				return redirect()->route('transaction.accountsreceivable.index');
			}else{
				$accountsreceivable = new Accountsreceivable();
				$accountsreceivable->gestion = $request->gestion;
				$accountsreceivable->periodo = $request->periodo;
				$accountsreceivable->fecha_gestion_periodo = $date->format('Y-m-d');
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

        Session::flash('message', 'Nueva cuota por cobrar registrada correctamente.');
        return redirect()->route('transaction.accountsreceivable.index');
		 
    }
	
	public function edit($id)
    {
		$id = \Crypt::decrypt($id);
		$company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->orderBy('cuota', 'asc');
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc');
		$gestiones = Gestion::orderBy('nombre', 'asc')->lists('nombre','nombre')->all();
        $accountsreceivable = Accountsreceivable::find($id);
        return view('accountsreceivables.edit')
            ->with('accountsreceivable',$accountsreceivable)
			->with('properties',$properties->get())
			->with('gestiones',$gestiones)
			->with('quotas',$quotas->get());
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
		$year=$request->gestion;
		$month=$request->periodo;
		$date = new \DateTime($year.'-'.$month.'-'.'01');
		 
		$accountsreceivable = Accountsreceivable::find($id);
		$accountsreceivable->gestion = $request->gestion;
		$accountsreceivable->periodo = $request->periodo;
		$accountsreceivable->fecha_gestion_periodo = $date->format('Y-m-d');
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
		$id = \Crypt::decrypt($id);
        $company = Auth::user()->company;
		$quotas = Quota::where('company_id',$company->id )->lists('cuota','id');
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id');
        $accountsreceivable = Accountsreceivable::find($id);
        return view('accountsreceivables.show')
            ->with('accountsreceivable',$accountsreceivable)
			->with('properties',$properties)
			->with('quotas',$quotas);
    }
	
	public function destroy($id)
    {
        $accountsreceivable = Accountsreceivable::find($id);
		$task_accountreceivables = $accountsreceivable->tasks()->get();

		foreach ($task_accountreceivables as $task_accountreceivable) {
			
			$accountsreceivable->tasks()->detach($task_accountreceivable->id);
			//$task = Task::find($task_accountreceivable->id);
			//$task->delete();
		}
		
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
		$company = Auth::user()->company;
		$gestiones = Gestion::orderBy('nombre', 'asc')->lists('nombre','nombre')->all();

   		if($company->pago == 'prepago' ){
			$mes_actual = date('m');
			$mes_cobro = 'Mes adelantado';
		}else{
			$mes_cobro = 'Mes vencido';
			$mes_actual = date('m');
			$mes_actual = ($mes_actual == 1) ? 12 : $mes_actual-1;
		}

        return view('accountsreceivables.generate')
        	->with('gestiones',$gestiones)
        	->with('mes_cobro',$mes_cobro)
	        ->with('mes_actual',$mes_actual);
    }
	
	public function storegenerate(Request $request){
		$this->validate($request, [
            'gestion' => 'required',
            'periodo' => 'required',
        ]);
		$company = Auth::user()->company;
		$year=$request->gestion;
		$month=$request->periodo;
		$date = new \DateTime($year.'-'.$month.'-'.'01');
		
		$quotas = Quota::where('company_id',$company->id )->where('frecuencia_pago','Mensual' )->where('activa',1 )->get();
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->get();
		$fecha_vencimiento = date('Y-m-d', strtotime($date->format('Y-m-d').'+ '.$company->dias_mora.' days'));
		foreach($properties as $property){	
			foreach($quotas as $quota){
				if($property->type_property_id == $quota->type_property_id){
				$accountsreceivable_validate = Accountsreceivable::where('gestion',$request->gestion)
					->where('periodo',$request->periodo)
					->where('property_id',$property->id)
					->where('quota_id',$quota->id)->get();
				
					$forma_cobro = $quota->forma_cobro;
					$importe = $quota->importe;
					$fit = $property->fit;
					$importe_cobrar = ($forma_cobro == 'FIT')? $fit*$importe : $importe;

					if(count($accountsreceivable_validate)){
						//Session::flash('message', 'Algunas cuotas ya fueron ingresadas.');
					}else{
						$accountsreceivable = new Accountsreceivable();
						$accountsreceivable->gestion = $request->gestion;
						$accountsreceivable->periodo = $request->periodo;
						$accountsreceivable->fecha_gestion_periodo = $date->format('Y-m-d');
						$accountsreceivable->fecha_vencimiento = $fecha_vencimiento;
						$accountsreceivable->cantidad = '0';
						$accountsreceivable->importe_por_cobrar = $importe_cobrar;
						$accountsreceivable->importe_abonado = '0';
						$accountsreceivable->cancelada = '0';
						$accountsreceivable->quota_id = $quota->id;
						$accountsreceivable->property_id = $property->id;
						$accountsreceivable->company_id = $company->id;
						$accountsreceivable->user_id = Auth::user()->id;
						$accountsreceivable->save();

					}
				}
			}
		}
		Session::flash('message', 'Nuevas cuotas por cobrar registradas correctamente.');
        return redirect()->route('transaction.accountsreceivable.index');
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

		$accountsreceivables = DB::table('accountsreceivables');
		
		
	}

	public function send()
    {
		$company = Auth::user()->company;
		$sendalertpayments = Sendalertpayment::where('company_id',$company->id )->where('enviado',0);
		return view('accountsreceivables.send')->with('sendalertpayments',$sendalertpayments->get());
    }
	
	public function generatenotification(){
		$company = Auth::user()->company;
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$subjects = Subject::where('company_id',$company->id )->lists('nombre','nombre')->all();
		$gestiones = Gestion::orderBy('nombre', 'asc')->lists('nombre','nombre')->all();

   		if($company->pago == 'prepago' ){
			$mes_actual = date('m');
			$mes_cobro = 'Mes adelantado';
		}else{
			$mes_cobro = 'Mes vencido';
			$mes_actual = date('m');
			$mes_actual = ($mes_actual == 1) ? 12 : $mes_actual-1;
		}

		return view('accountsreceivables.generatenotification')
				->with('properties',$properties)
				->with('subjects',$subjects)
				->with('gestiones',$gestiones)
				->with('mes_cobro',$mes_cobro)
				->with('mes_actual',$mes_actual);
	}

	public function sendnotification(Request $request){
		$this->validate($request, [
            'sendalertpayment' => 'required'
        ]);
		
		$company = Auth::user()->company;
		if($request->submit == "enviar"){
		
			
			$sendalertpayments = Sendalertpayment::whereIn('id',$request->sendalertpayment)->get();
			if(count($sendalertpayments)){
				foreach ($sendalertpayments as $sendalertpayment) {
					$correos = array();	
					$destinatarios = array();	
					$contacts = Contact::where('company_id',$company->id)->where('property_id',$sendalertpayment->property_id)->where('correspondencia','like','%Cobranzas%')->where('email','!=','')->where('activa',1)->get();

					if(count($contacts)){
						
						foreach ($contacts as $contact) {

							$data = [
								'nombre_remitente' => $company->nombre,
								'email_remitente' => Auth::user()->email,
								'cuerpo_remitente' => $request->remitente,	
								'email_contancto' => $contact->email,
								'nombre_contacto'=> $contact->nombre.' '.$contact->apellido,
								'comunicado_asunto' => $sendalertpayment->asunto,
								'sendalertpayment' => $sendalertpayment,
								'logotipo' => $company->logotipo,
								'formapago' => $company->forma_pago,
								'correoempresa' => Auth::user()->email
							  ];


							Mail::send('emails.alertpayment',$data, function ($m) use ($data) {
								$m->from($data['email_remitente'],$data['nombre_remitente']);
								$m->to($data['email_contancto'], $data['nombre_contacto'])->subject($data['comunicado_asunto']);
							});
							if (Mail::failures()) {
								$estado_envio = 0;
							}else{
								$correos[] = $data['email_contancto'];
								$destinatarios[] = $data['nombre_contacto'];

								$estado_envio = 1;
							}
						}//end foreach contacts
					}else{
						Session::flash('message', 'No se enviaron los <b>Avisos de cobranza</b> por falta de información de contacto.');
						return redirect()->route('transaction.notification.send');
					}
					$sendalertpaymentUp = Sendalertpayment::find($sendalertpayment->id);
					$sendalertpaymentUp->correos = implode(',', $correos);
					$sendalertpaymentUp->destinatarios = implode(',', $destinatarios);
					$sendalertpaymentUp->enviado = $estado_envio;	
					$sendalertpaymentUp->fecha_envio = date('Y-m-d H:i:s');
					$sendalertpaymentUp->save();
				}//end foreach sendpayment



			}
			return redirect()->route('transaction.notification.registernotification');
			
		}elseif($request->submit == "borrar"){
			foreach ($request->sendalertpayment as $sendalertpayment) {
				$sendalertpayment = Sendalertpayment::find($sendalertpayment);
				$sendalertpayment->delete();
			}
			
			return redirect()->route('transaction.notification.send');
		}else{
			//dd("imprimir");
			$company = Auth::user()->company;
			$sendalertpayments = Sendalertpayment::whereIn('id',$request->sendalertpayment)->get();
			return view('accountsreceivables.printall')
			->with('sendalertpayments',$sendalertpayments);

		}
	}
	
	public function registernotification(){
		$company = Auth::user()->company;
		$sendalertpayments = Sendalertpayment::where('company_id',$company->id )->where('enviado',1);
		return view('accountsreceivables.registersendnotification')->with('sendalertpayments',$sendalertpayments->get());
	}
	
	public function storealertpayment(Request $request){
		$this->validate($request, [
            'gestion_desde' => 'required',
            'periodo_desde' => 'required',
			'gestion_hasta' => 'required',
            'periodo_hasta' => 'required',
            'propiedad' => 'required',
			'asunto' => 'required'
        ]);
		//dd($request);
		$company = Auth::user()->company;
		//Vencimiento desde
		$year_desde=$request->gestion_desde;
		$month_desde=$request->periodo_desde;
		$date_gestion_periodo_desde = new \DateTime($year_desde.'-'.$month_desde.'-'.'02');
		//Vencimiento hasta
		$year_hasta=$request->gestion_hasta;
		$month_hasta=$request->periodo_hasta;
		$date_gestion_periodo_hasta = new \DateTime($year_hasta.'-'.$month_hasta.'-'.'02');
		
		
		if($request->propiedad == 'todas'){
		$properties = DB::table('properties')
				->join('accountsreceivables', 'properties.id', '=', 'accountsreceivables.property_id')
				->join('quotas', 'quotas.id', '=', 'accountsreceivables.quota_id')
				->join('categories', 'categories.id', '=', 'quotas.category_id')
				->where('fecha_gestion_periodo','>=',$date_gestion_periodo_desde)
				->where('fecha_gestion_periodo','<=',$date_gestion_periodo_hasta)
				->where('cancelada','0')
				->where('properties.company_id',$company->id)
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
				->join('categories', 'categories.id', '=', 'quotas.category_id')
				->where('fecha_gestion_periodo','>=',$date_gestion_periodo_desde)
				->where('fecha_gestion_periodo','<=',$date_gestion_periodo_hasta)
				->where('accountsreceivables.property_id',$request->propiedad)	
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
		}
		foreach ($properties as $propertypayment){
			$sendalertpayments_deletes = Sendalertpayment::where('property_id',$propertypayment->id)
					->where('enviado',0)->get();
			foreach ($sendalertpayments_deletes as $sendalertpayments_delete) {
				$sendalertpayment_group = Sendalertpayment::find($sendalertpayments_delete->id);
				$sendalertpayment_group->delete();
			}
			$sendalertpayment = new Sendalertpayment();
			$sendalertpayment->asunto = $request->asunto;
			$sendalertpayment->nota = $request->nota;
			$sendalertpayment->limite_periodo = $request->periodo_hasta;
			$sendalertpayment->limite_gestion = $request->gestion_hasta;
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
		return redirect()->route('transaction.notification.send');
	}


	public function printing($id)
    {
		$company = Auth::user()->company;
        $sendalertpayment = Sendalertpayment::find($id);
        return view('accountsreceivables.print')
		->with('sendalertpayment',$sendalertpayment);
    }
	
	public function search(Request $request){

		$company = Auth::user()->company;

        $accountsreceivables = Accountsreceivable::where('company_id',$company->id );
		if($request->estado != "todos"){
			$accountsreceivables = $accountsreceivables->where('cancelada',$request->estado);
		}
		if($request->gestion != "todos"){
			$accountsreceivables = $accountsreceivables->where('gestion',$request->gestion);
		}
		if($request->periodo != "todos"){
			$accountsreceivables = $accountsreceivables->where('periodo',$request->periodo);
		}
		if($request->propiedad != "todos"){
			$accountsreceivables = $accountsreceivables->where('property_id',$request->propiedad);
		}
		if($request->cuota != "todos"){
			$accountsreceivables = $accountsreceivables->where('quota_id',$request->cuota);
		}
		
		
		$quotas = Quota::where('company_id',$company->id )->where('activa',1 )->lists('cuota','id')->all();
		$properties = Property::where('company_id',$company->id )->orderBy('orden', 'asc')->lists('nro','id')->all();
		$gestiones = Gestion::lists('nombre','nombre')->all();

        return view('accountsreceivables.index')
		->with('properties',$properties)
		->with('quotas',$quotas)
		->with('gestiones',$gestiones)
		->with('accountsreceivables',$accountsreceivables->get());
	}
	
	//AJAX
	
	public function accountsreceivablebyproperty($property_id){
		$company = Auth::user()->company;
        $accountsreceivables = Accountsreceivable::where('company_id',$company->id )->where('cancelada',0)->where('property_id',$property_id)->orderBy('gestion','ASC')->orderBy('periodo','ASC')->with('quota')->get();

		//$accountsreceivables = json_encode($accountsreceivables);
		return response()->json(['success' => true, 'accountsreceivables' => $accountsreceivables]);
	}
}
