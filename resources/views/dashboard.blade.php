<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500">Customers</h3>
                <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500">Accounts</h3>
                <p class="text-2xl font-bold">{{ $totalAccounts }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500">Total Balance</h3>
                <p class="text-2xl font-bold">Rp {{ number_format($totalBalance, 2, ',', '.') }}</p>
            </div>
            <div class="bg-white p-6 rounded shadow text-center">
                <h3 class="text-gray-500">Transactions</h3>
                <p class="text-2xl font-bold">{{ $totalTransactions }}</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded shadow text-center">➕ Add Customer</a>
            <a href="{{ route('accounts.create') }}" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded shadow text-center">➕ Add Account</a>
            <a href="{{ route('transactions.deposit.form') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white p-4 rounded shadow text-center">➕ Deposit</a>
            <a href="{{ route('transactions.withdraw.form') }}" class="bg-red-500 hover:bg-red-600 text-white p-4 rounded shadow text-center">➖ Withdraw</a>
            <a href="{{ route('transactions.transfer.form') }}" class="bg-purple-500 hover:bg-purple-600 text-white p-4 rounded shadow text-center">🔀 Transfer</a>
            <a href="{{ route('transactions.report') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white p-4 rounded shadow text-center">📄 Transaction Report</a>
        </div>
        <!-- Recent Transactions -->
        <div class="bg-white p-6 rounded shadow overflow-x-auto">
            <h2 class="text-xl font-bold mb-4">Recent Transactions</h2>
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Account</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">To Account (if Transfer)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentTransactions as $trx)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $trx->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2 capitalize">{{ $trx->type }}</td>
                            <td class="px-4 py-2">
                                {{ $trx->account->account_number }}
                                <br>
                                <small>{{ $trx->account->customer->name }}</small>
                            </td>
                            <td class="px-4 py-2">Rp {{ number_format($trx->amount, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if ($trx->type == 'transfer' && $trx->targetAccount)
                                    {{ $trx->targetAccount->account_number }}
                                    <br>
                                    <small>{{ $trx->targetAccount->customer->name }}</small>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
