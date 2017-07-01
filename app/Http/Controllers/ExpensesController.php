<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Category;
use App\Supplier;
use App\Account;
use App\Transaction;
use App\Expenses;
class ExpensesController extends Controller
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

		$expenses = Expenses::where('company_id',$company->id );
        return view('expenses.index')->with('expenses',$expenses->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
		$company = Auth::user()->company;
		$categories = Category::where('company_id',$company->id )->where('tipo_categoria','Egreso')->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('razon_social', 'asc')->lists('razon_social','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
        return view('expenses.create')
		->with('categories',$categories)
		->with('suppliers',$suppliers)
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
			'proveedor' => 'required|not_in:0',
			'categoria' => 'required|not_in:0',
            'concepto' => 'required',
			'importe' => 'required',
			'forma_pago' => 'required',
            'cuenta' => 'required|not_in:0',
            
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
		
		$numero_documento = Transaction::where('user_id',Auth::user()->id)->where('tipo_transaccion','Egreso')->max('nro_documento');
		//dd($numero_documento);
		
		$company = Auth::user()->company;
		
		$transaction = new Transaction();
		$transaction->nro_documento = $numero_documento+1;
		$transaction->tipo_transaccion = 'Egreso';
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->forma_pago;
		if($transaction->forma_pago == 'efectivo'){
		$transaction->numero_forma_pago = '';	
		}else{	
		$transaction->numero_forma_pago = $request->nro_forma_pago;
		}
		$transaction->importe_credito = '0';
		$transaction->importe_debito = $request->importe;
		$transaction->notas = $request->notas;
		$transaction->user_id= Auth::user()->id;
		$transaction->save();
		
		$expense = new Expenses();
		$expense->category_id = $request->categoria;
		$expense->supplier_id = $request->proveedor;
		$expense->account_id = $request->cuenta;
		$expense->company_id = $company->id;

		$expense->adjunto = $path;

		$transaction->expense()->save($expense);
		Session::flash('message', 'Transacción registrada correctamente.');
		return redirect()->route('transaction.expense.show', [$expense->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$expense = Expenses::find($id);

        return view('expenses.show')->with('expense',$expense);
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
		$categories = Category::where('company_id',$company->id )->where('activa',1)->where('tipo_categoria','Egreso')->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->where('activa',1)->orderBy('razon_social', 'asc')->lists('razon_social','id')->all();
		$accounts = Account::where('company_id',$company->id )->where('activa',1)->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$expense = Expenses::find($id);
        return view('expenses.edit')
		->with('categories',$categories)
		->with('suppliers',$suppliers)
		->with('accounts',$accounts)
		->with('expense',$expense);
		
		
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
			'proveedor' => 'required|not_in:0',
			'categoria' => 'required|not_in:0',
            'concepto' => 'required',
			'importe' => 'required',
			'forma_pago' => 'required',
            'cuenta' => 'required|not_in:0',
            
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
		
		$numero_documento = Transaction::where('user_id',Auth::user()->id)->where('tipo_transaccion','Egreso')->max('nro_documento');

		
		$company = Auth::user()->company;
		
		$transaction = Transaction::find($request->transaction_id);
		$transaction->fecha_pago = date('Y-m-d', strtotime(str_replace('/','-',$request->fecha)));
		$transaction->concepto = $request->concepto;
		$transaction->forma_pago = $request->forma_pago;
		if($transaction->forma_pago == 'efectivo'){
		$transaction->numero_forma_pago = '';	
		}else{	
		$transaction->numero_forma_pago = $request->nro_forma_pago;
		}
		$transaction->importe_debito = $request->importe;
		$transaction->notas = $request->notas;
		$transaction->save();
		
		$expense = Expenses::find($id);
		$expense->category_id = $request->categoria;
		$expense->supplier_id = $request->proveedor;
		$expense->account_id = $request->cuenta;

		$expense->adjunto = $path;
		$transaction->expense()->save($expense);
		Session::flash('message', 'Transacción actualizada correctamente.');
		return redirect()->route('transaction.expense.show', [$expense->id]);
		
    }
	
	public function copy($id)
    {
         $company = Auth::user()->company;
		$categories = Category::where('company_id',$company->id )->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->orderBy('razon_social', 'asc')->lists('razon_social','id')->all();
		$accounts = Account::where('company_id',$company->id )->orderBy('nombre', 'asc')->lists('nombre','id')->all();
		$expense = Expenses::find($id);
        return view('expenses.copy')
		->with('categories',$categories)
		->with('suppliers',$suppliers)
		->with('accounts',$accounts)
		->with('expense',$expense);
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
	
	public function pdf($id){
		$expense = Expenses::find($id);
		$pdf = \PDF::loadView('pdf.expense', compact('expense'));
		$nombre_documento = "recibo_egreso_nro_".str_pad($expense->transaction->nro_documento, 6, "0", STR_PAD_LEFT);
		return $pdf->download($nombre_documento.".pdf");
	}
	
	//Ajax
	//Se cambio a busqueda por categoria en lugar de proveedor
	
	public function expensesbycategory($category_id){
		$company = Auth::user()->company;
        //$expenses = Expenses::where('company_id',$company->id )->where('category_id',$category_id)->with('supplier')->with('transaction')->orderBy('transactions.fecha_pago', 'desc')->take(3)->get();
		$expenses = DB::table('expenses')
            ->join('transactions', 'transactions.id', '=', 'expenses.transaction_id')
            ->join('suppliers', 'suppliers.id', '=', 'expenses.supplier_id')
			->where('expenses.category_id',$category_id)
			->where('transactions.anulada','0')
            ->select('transactions.fecha_pago', 'suppliers.razon_social', 'transactions.concepto','transactions.forma_pago','transactions.importe_debito')
			->orderBy('fecha_pago', 'desc')
			->take(3)
            ->get();
		//dd($expenses);
		return response()->json(['success' => true, 'expenses' => $expenses]);
	}
}
