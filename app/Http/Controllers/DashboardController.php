<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers = Customer::count();
        $totalAccounts = Account::count();
        $totalBalance = Account::sum('balance');
        $totalTransactions = Transaction::count();

        $recentTransactions = Transaction::with(['account.customer', 'targetAccount.customer'])
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalCustomers',
            'totalAccounts',
            'totalBalance',
            'totalTransactions',
            'recentTransactions'
        ));
    }

}
