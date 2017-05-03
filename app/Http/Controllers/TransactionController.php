<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Collection;
use App\Accountsreceivable;
use App\Http\Requests;
use DB;
class TransactionController extends Controller
{
	public function __construct(){
        $this->middleware('auth');
    }
	
	public function index()
    {

		$transaction = Transaction::where('user_id',Auth::user()->id );
        return view('transfers.index')->with('transaction',$transaction);
    }
	
    public function anular(Request $request){
		
		$transaction = Transaction::find($request->id_transaction);
		$transaction->anulada = '1';
		$transaction->excluir_reportes = '1';
		$transaction->save();
		
		if(!empty($request->id_collection)){
			$collection= Collection::find($request->id_collection);
			$quotes = Accountsreceivable::whereIn('id',  explode(',', $collection->cuotas))->update(['cancelada' => '0']);
			return redirect()->route('transaction.collection.index');
		}
		if(!empty($request->id_expense)){
			return redirect()->route('transaction.expense.index');
		}
		if(!empty($request->id_transaction_destino)){
			$transaction = Transaction::find($request->id_transaction_destino);
			$transaction->anulada = '1';
			$transaction->excluir_reportes = '1';
			$transaction->save();
		}
		
		return redirect()->route('transaction.transfer.index');
	}
	
	public function search(Request $request){

		if($request->tipo == "todas"){

		}elseif($request->tipo == "Ingreso"){
			$transactions = DB::table('transactions')
            ->join('collections', 'transactions.id', '=', 'collections.transaction_id')
            ->get();
			dd($transactions);
		}elseif($request->tipo == "Egreso"){
			$transactions = DB::table('transactions')
            ->join('expenses', 'transactions.id', '=', 'expenses.transaction_id')
            ->get();
			dd($transactions);
		}elseif($request->tipo == "Traspaso"){
			$transactions = DB::table('transactions')
            ->join('transfers', 'transactions.id', '=', 'transfers.ori_transaction_id')
            ->get();
			dd($transactions);
		}else{
			
		}
		
		//$request->tipo
		//$request->categoria
		//$request->cuenta
		
	}
}
