<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Deposit</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('transactions.deposit') }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Account</label>
                <select name="account_id" class="w-full border-gray-300 rounded p-2">
                    @foreach ($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->account_number }} - {{ $account->customer->name }}</option>
                    @endforeach
                </select>
                @error('account_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 font-semibold">Amount</label>
                <input type="number" step="0.01" name="amount" class="w-full border-gray-300 rounded p-2">
                @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Deposit</button>
        </form>
    </div>
</x-app-layout>
