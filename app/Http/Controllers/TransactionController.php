<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransactionRequest;
use Illuminate\Support\Facades\DB;
use App\Transaction;
use App\User;

class TransactionController extends Controller
{
    /**
     * Show the list of all transactions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::withTrashed()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

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
        return view('transaction_form', compact('users'));
    }

    /**
     * Show the form for creating a new transaction with predefined values.
     *
     * @param Transaction $oldTransaction
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Transaction $transaction)
    {
        $users = User::where('id', '!=', auth()->user()->id)->orderBy('name')->get();
        return view('transaction_form', compact('users', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        DB::transaction(function () use ($request) {
            $sender = auth()->user();
            $sender->balance = $sender->balance - $request->amount;
            $sender->save();

            $receiver = User::find($request->receiver_id);
            $receiver->balance = $receiver->balance + $request->amount;
            $receiver->save();

            $transaction['sender_id'] = $sender->id;
            $transaction['receiver_id'] = $receiver->id;
            $transaction['amount'] = $request->amount;
            $transaction['sender_balance'] = $sender->balance;
            $transaction['receiver_balance'] = $receiver->balance;

            Transaction::create($transaction);
        });

        \Session::flash('message', 'The transaction has been made successfully!');
        return redirect('/history');
    }

    /**
     * Cancel the transaction.
     *
     * @param  Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $transaction->delete();

            $sender = User::find($transaction->sender_id);
            $sender->balance = $sender->balance + $transaction->amount;
            $sender->save();

            $receiver = User::find($transaction->receiver_id);
            $receiver->balance = $receiver->balance - $transaction->amount;
            $receiver->save();
        });
        \Session::flash('message', 'The transaction has been successfully canceled!');
        return redirect('/admin/transactions');
    }
}
