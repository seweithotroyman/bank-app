<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showDepositForm()
    {
        $accounts = Account::all();
        return view('transactions.deposit', compact('accounts'));
    }

    public function deposit(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $account = Account::findOrFail($validated['account_id']);
        $account->balance += $validated['amount'];
        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'deposit',
            'amount' => $validated['amount'],
        ]);

        return redirect()->back()->with('success', 'Deposit successful.');
    }

    public function showWithdrawForm()
    {
        $accounts = Account::all();
        return view('transactions.withdraw', compact('accounts'));
    }

    public function withdraw(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $account = Account::findOrFail($validated['account_id']);

        if ($account->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Saldo tidak mencukupi.']);
        }

        $account->balance -= $validated['amount'];
        $account->save();

        Transaction::create([
            'account_id' => $account->id,
            'type' => 'withdraw',
            'amount' => $validated['amount'],
        ]);

        return redirect()->back()->with('success', 'Withdrawal berhasil.');
    }

    public function showTransferForm()
    {
        $accounts = Account::all();
        return view('transactions.transfer', compact('accounts'));
    }

    public function transfer(Request $request)
    {
        $validated = $request->validate([
            'from_account_id' => 'required|exists:accounts,id|different:to_account_id',
            'to_account_id' => 'required|exists:accounts,id',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $from = Account::findOrFail($validated['from_account_id']);
        $to = Account::findOrFail($validated['to_account_id']);

        if ($from->balance < $validated['amount']) {
            return back()->withErrors(['amount' => 'Saldo tidak cukup untuk ditransfer.']);
        }

        $from->balance -= $validated['amount'];
        $to->balance += $validated['amount'];

        $from->save();
        $to->save();

        Transaction::create([
            'account_id' => $from->id,
            'type' => 'transfer',
            'amount' => $validated['amount'],
            'target_account_id' => $to->id,
        ]);

        return redirect()->back()->with('success', 'Transfer berhasil.');
    }

    public function report(Request $request)
    {
        $query = Transaction::with(['account.customer', 'targetAccount.customer'])->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->paginate(15);

        return view('transactions.report', compact('transactions'));
    }
}
