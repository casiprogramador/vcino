<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Account;
use App\Transaction;
use App\Transfer;
use App\Category;
use App\Expenses;
use App\Collection;
use App\Logtransactions;
use Auth;

class TransferController extends Controller
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
		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('activa',1)->lists('nombre','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$transactions = Transaction::where('user_id',Auth::user()->id )->orderBy('fecha_pago', 'desc');
        return view('transfers.index')
				->with('transactions',$transactions->get())
				->with('categories',$categories)
				->with('accounts',$accounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$company = Auth::user()->company;
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
        return view('transfers.create')
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
        //dd($request);
		$this->validate($request, [
			'cuenta_origen' => 'required|not_in:0',
			'cuenta_destino' => 'required|not_in:0',
            'concepto' => 'required',
			'importe' => 'required',
			'modo_traspaso' => 'required',
            'fecha' => 'required',   
       ]);
		
		if(!empty($request->adjunto)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto;
			$tmpFilePath = '/img/upload/traspasos/';
			$tmpFileName = time() . '-'.$id_user. '-traspaso-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
		}elseif(isset ($request->adjunto_ori)){
			$path = $request->adjunto_ori;
		}else{
			$path="";
		}
		
		$numero_documento = Transaction::where('user_id',Auth::user()->id)->where('tipo_transaccion','Traspaso-Egreso')->max('nro_documento');
		//dd($numero_documento);
		
		$company = Auth::user()->company;
		
		$transaction = new Transaction();
		$transaction->nro_documento = $numero_documento+1;
		$transaction->tipo_transaccion = 'Traspaso-Egreso';
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->modo_traspaso;
		$transaction->numero_forma_pago = $request->nro_transanccion;
		$transaction->importe_credito = '0';
		$transaction->importe_debito = $request->importe;
		$transaction->notas = $request->nota;
		$transaction->user_id= Auth::user()->id;
		$transaction->save();
		$ori_transaction_id = $transaction->id;
		
		$transaction = new Transaction();
		$transaction->nro_documento = $numero_documento+1;
		$transaction->tipo_transaccion = 'Traspaso-Ingreso';
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->modo_traspaso;
		$transaction->numero_forma_pago = $request->nro_transanccion;
		$transaction->importe_debito = '0';
		$transaction->importe_credito = $request->importe;
		$transaction->notas = $request->nota;
		$transaction->user_id= Auth::user()->id;
		$transaction->save();
		$des_transaction_id = $transaction->id;
		
		//ori_transaction_id
		
		$transfer = new Transfer();
		$transfer->ori_account_id = $request->cuenta_origen;
		$transfer->des_account_id = $request->cuenta_destino;
		$transfer->ori_transaction_id = $ori_transaction_id;
		$transfer->des_transaction_id = $des_transaction_id;
		$transfer->company_id = $company->id;

		$transfer->adjunto = $path;

		$transfer->save();
		$id_transfer = \Crypt::encrypt($transfer->id);
		Session::flash('message', 'Transacción registrada correctamente.');
		return redirect()->route('transaction.transfer.show', [$id_transfer]);
		
		
		
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
		$transfer = Transfer::find($id);
        return view('transfers.show')->with('transfer',$transfer);
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
        $company = Auth::user()->company;
	    $accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
	    $transfer = Transfer::find($id);
        return view('transfers.edit')
		->with('accounts',$accounts)
		->with('transfer',$transfer);
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
        //dd($request);
		$this->validate($request, [
			'cuenta_origen' => 'required|not_in:0',
			'cuenta_destino' => 'required|not_in:0',
            'concepto' => 'required',
			'importe' => 'required',
			'modo_traspaso' => 'required',
            'fecha' => 'required',   
       ]);
		
		if(!empty($request->adjunto)){
			$id_user = Auth::user()->id;
			$file = $request->adjunto;
			$tmpFilePath = '/img/upload/gastos/';
			$tmpFileName = time() . '-'.$id_user. '-gasto-name-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
		}elseif(!empty($request->adjunto_ori)){
			$path = $request->adjunto_ori;
		}else{
			$path="";
		}
		
		
		$company = Auth::user()->company;
		
		$transaction_ori = Transaction::find($request->transaction_ori);
		$transaction_des = Transaction::find($request->transaction_des);
		$transfer = Transfer::find($id);
		
		$datos_antiguos_array = [$transaction_ori,$transaction_des,$transfer ];
		
		$transaction_ori->tipo_transaccion = 'Traspaso-Egreso';
		$transaction_ori->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction_ori->concepto = $request->concepto;
		$transaction_ori->forma_pago = $request->modo_traspaso;
		$transaction_ori->numero_forma_pago = $request->nro_transanccion;
		$transaction_ori->importe_credito = '0';
		$transaction_ori->importe_debito = $request->importe;
		$transaction_ori->notas = $request->nota;
		$transaction_ori->user_id= Auth::user()->id;
		$transaction_ori->save();
		
		
		$transaction_des->tipo_transaccion = 'Traspaso-Ingreso';
		$transaction_des->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction_des->concepto = $request->concepto;
		$transaction_des->forma_pago = $request->modo_traspaso;
		$transaction_des->numero_forma_pago = $request->nro_transanccion;
		$transaction_des->importe_debito = '0';
		$transaction_des->importe_credito = $request->importe;
		$transaction_des->notas = $request->nota;
		$transaction_des->user_id= Auth::user()->id;
		$transaction_des->save();
		
		//ori_transaction_id
		
		
		$transfer->ori_account_id = $request->cuenta_origen;
		$transfer->des_account_id = $request->cuenta_destino;
		$transfer->company_id = $company->id;

		$transfer->adjunto = $path;

		$transfer->save();
		$id_transfer = \Crypt::encrypt($id);
		
		$datos_nuevo_array = [Auth::user(),$transaction_ori,$transaction_des,$transfer ];
		$logtransaction = new Logtransactions();
		$logtransaction->tipo = 'transferencia';
		$logtransaction->dato_anterior = implode('|', $datos_antiguos_array);
		$logtransaction->dato_nuevo = implode('|', $datos_nuevo_array);
		$logtransaction->save();
		Session::flash('message', 'Transacción registrada correctamente.');
		return redirect()->route('transaction.transfer.show', [$id_transfer]);
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
	
	public function search(Request $request)
    {
        $transactions = Transaction::where('user_id',Auth::user()->id );
		$company = Auth::user()->company;
		//Busqueda por tipo		
		if($request->tipo == "cobranza"){
			$transactions = $transactions->where('tipo_transaccion','Ingreso');
		}elseif ($request->tipo == "gasto") {
			$transactions = $transactions->where('tipo_transaccion','Egreso');
	
		}elseif ($request->tipo == "traspaso") {
			$transactions = $transactions->where('tipo_transaccion','like','Traspaso%');
		}
		//Busqueda por categoria
		if($request->categoria != "todos"){
			$expenses = Expenses::where('company_id',$company->id )->where('category_id',$request->categoria)->get();
			$id_transactions = array();
			foreach($expenses as $expense){
				array_push($id_transactions, $expense->transaction_id);	
			}
			$transactions = $transactions->whereIn('id',$id_transactions);
		}
		
		//Busqueda por cuentas
		if($request->cuenta != "todos"){
			$id_transactions = array();
			$expenses = Expenses::where('company_id',$company->id )->where('account_id',$request->cuenta)->get();
			foreach($expenses as $expense){
				array_push($id_transactions, $expense->transaction_id);	
			}
			$collections = Collection::where('company_id',$company->id )->where('account_id',$request->cuenta)->get();
			foreach($collections as $collection){
				array_push($id_transactions, $collection->transaction_id);	
			}
			$transfers = Transfer::where('company_id',$company->id )->where('ori_account_id',$request->cuenta)->get();
			foreach($transfers as $transfer){
				array_push($id_transactions, $transfer->ori_transaction_id);	
			}
			$transfers = Transfer::where('company_id',$company->id )->where('des_account_id',$request->cuenta)->get();
			foreach($transfers as $transfer){
				array_push($id_transactions, $transfer->des_transaction_id);	
			}
			$transactions = $transactions->whereIn('id',$id_transactions);
		}
		
		
		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->where('activa',1)->lists('nombre','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
        return view('transfers.index')
				->with('transactions',$transactions->get())
				->with('categories',$categories)
				->with('accounts',$accounts);
		
    }
	
	public function pdf($id){
		$transfer = Transfer::find($id);
		$pdf = \PDF::loadView('pdf.transfer', compact('transfer'));
		$nombre_documento = "recibo_traspaso_nro_".str_pad($transfer->transactionOrigin->nro_documento, 6, "0", STR_PAD_LEFT);
		return $pdf->download($nombre_documento.".pdf");
	}
}
