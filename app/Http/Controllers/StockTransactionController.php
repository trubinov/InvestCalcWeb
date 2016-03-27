<?php

namespace App\Http\Controllers;

use App\StockCode;
use App\StockTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StockTransactionController extends Controller
{
    //

    /**
     * List all Transactions
     * @return mixed
     */
    public function index() {
        $transactions = StockTransaction::all();
        return view('transactions.list', ['transactions' => $transactions]);
    }

    /**
     * Add new Transaction
     * @return mixed
     */
    public function create() {
        return view('transactions.transaction');
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        // validate input
        $this->validate($request, [
            'stock_code' => 'required',
            's_count' => 'required',
            'price' => 'required',
        ]);
        // Request is valid
        // Store into db
        $stock_code = StockCode::firstOrCreate(['rbk_code' => $request->get('stock_code')]);
        $transaction = new StockTransaction(array(
            'stock_id' => $stock_code->id,
            's_count' => $request->get('s_count'),
            'price' => $request->get('price'),
            'trans_date' => $request->get('trans_date', Carbon::now()),
        ));
        $transaction->save();
        Redirect::to('StockTransactionController@index');
    }
}
