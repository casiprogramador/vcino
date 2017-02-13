<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Category;
use App\Supplier;
use App\Account;
use App\Transaction;
use App\Expenses;
class ExpensesController extends Controller
{
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
		$categories = Category::where('company_id',$company->id )->lists('nombre','id')->all();
		$suppliers = Supplier::where('company_id',$company->id )->lists('razon_social','id')->all();
		$accounts = Account::where('company_id',$company->id )->lists('nombre','id')->all();
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
			$tmpFileName = time() . '-'.$id_user. '-gasto-' . $file->getClientOriginalName();
			$file->move(public_path() . $tmpFilePath, $tmpFileName);
			$path = $tmpFilePath . $tmpFileName;
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
		$transaction->numero_forma_pago = $request->nro_forma_pago;
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
		if(!empty($request->adjunto)){
			$expense->adjunto = $path;
		}
		$transaction->expense()->save($expense);
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
	
	//Ajax
	
	public function expensesbysupplier($supplier_id){
		$company = Auth::user()->company;
        $expenses = Expenses::where('company_id',$company->id )->where('supplier_id',$supplier_id)->with('supplier')->with('transaction')->take(2)->get();

		return response()->json(['success' => true, 'expenses' => $expenses]);
	}
}
