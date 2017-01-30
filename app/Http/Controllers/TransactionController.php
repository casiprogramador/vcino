<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Http\Requests;

class TransactionController extends Controller
{
    public function anular(Request $request){
		$transaction = Transaction::find($request->id_transaction);
		$transaction->anulada = '1';
		$transaction->save();
		return redirect()->route('transaction.collection.index');
	}
}
