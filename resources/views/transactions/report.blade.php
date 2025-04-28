<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Transaction Report</h2>

        <form method="GET" action="{{ route('transactions.report') }}" class="bg-white p-4 rounded shadow mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block mb-1 font-semibold">Type</label>
                <select name="type" class="w-full border-gray-300 rounded p-2">
                    <option value="">All</option>
                    <option value="deposit" {{ request('type') == 'deposit' ? 'selected' : '' }}>Deposit</option>
                    <option value="withdraw" {{ request('type') == 'withdraw' ? 'selected' : '' }}>Withdraw</option>
                    <option value="transfer" {{ request('type') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Start Date</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="w-full border-gray-300 rounded p-2">
            </div>

            <div>
                <label class="block mb-1 font-semibold">End Date</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="w-full border-gray-300 rounded p-2">
            </div>

            <div class="flex items-end">
                <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Filter</button>
            </div>
        </form>

        <div class="bg-white shadow-md rounded overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Account</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Amount</th>
                        <th class="px-4 py-2">To Account (if Transfer)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $transaction->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">
                                {{ $transaction->account->account_number }}<br>
                                <small>{{ $transaction->account->customer->name }}</small>
                            </td>
                            <td class="px-4 py-2 capitalize">{{ $transaction->type }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($transaction->amount, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                @if ($transaction->type == 'transfer' && $transaction->targetAccount)
                                    {{ $transaction->targetAccount->account_number }}<br>
                                    <small>{{ $transaction->targetAccount->customer->name }}</small>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
