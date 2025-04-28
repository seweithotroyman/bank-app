<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Customer;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::with('customer')->latest()->paginate(10);
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('accounts.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'account_number' => 'required|string|unique:accounts,account_number',
            'account_type' => 'required|in:saving,deposit',
            'balance' => 'required|numeric|min:0',
        ]);

        Account::create($validated);
        return redirect()->route('accounts.index')->with('success', 'Account created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $customers = Customer::all();
        return view('accounts.edit', compact('account', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Account $account)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'account_number' => 'required|string|unique:accounts,account_number,' . $account->id,
            'account_type' => 'required|in:saving,deposit',
            'balance' => 'required|numeric|min:0',
        ]);
        $account->update($validated);

        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    
    }
}
