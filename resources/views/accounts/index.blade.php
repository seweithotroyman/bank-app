<x-app-layout>
    <div class="p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">Accounts</h2>
            <a href="{{ route('accounts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Account</a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2">Account Number</th>
                        <th class="px-4 py-2">Customer</th>
                        <th class="px-4 py-2">Type</th>
                        <th class="px-4 py-2">Balance</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $account->account_number }}</td>
                            <td class="px-4 py-2">{{ $account->customer->name }}</td>
                            <td class="px-4 py-2 capitalize">{{ $account->account_type }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($account->balance, 2, ',', '.') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('accounts.edit', $account) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
