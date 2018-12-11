<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateTransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\User;

class TransactionController extends Controller
{
    /**
     * Show the history of user transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $transactions = auth()->user()->transactions;
        return view('history', compact('transactions'));
    }

    /**
     * Show the form for creating a new transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->user()->id)->orderBy('name')->get();
        $sentTransactions = auth()->user()->sentTransactions;
        return view('transaction_form', compact('users', 'sentTransactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        dd($request);
        DB::transaction(function () {

        });

    }
}
