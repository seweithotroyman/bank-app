<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountController; 
use App\Http\Controllers\TransactionController; 

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
    Route::resource('customers', CustomerController::class);
    Route::resource('accounts', AccountController::class);
    
    Route::get('transactions/deposit', [TransactionController::class, 'showDepositForm'])->name('transactions.deposit.form');
    Route::post('transactions/deposit', [TransactionController::class, 'deposit'])->name('transactions.deposit');

    Route::get('transactions/withdraw', [TransactionController::class, 'showWithdrawForm'])->name('transactions.withdraw.form');
    Route::post('transactions/withdraw', [TransactionController::class, 'withdraw'])->name('transactions.withdraw');

    Route::get('transactions/transfer', [TransactionController::class, 'showTransferForm'])->name('transactions.transfer.form');
    Route::post('transactions/transfer', [TransactionController::class, 'transfer'])->name('transactions.transfer');
    Route::get('transactions/report', [TransactionController::class, 'report'])->name('transactions.report');
});
