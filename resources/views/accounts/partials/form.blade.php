<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="block mb-1 font-semibold">Customer</label>
        <select name="customer_id" class="w-full border-gray-300 rounded p-2">
            @foreach ($customers as $customer)
                <option value="{{ $customer->id }}" {{ old('customer_id', $account->customer_id ?? '') == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
        @error('customer_id') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Account Number</label>
        <input type="text" name="account_number" value="{{ old('account_number', $account->account_number ?? '') }}" class="w-full border-gray-300 rounded p-2">
        @error('account_number') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Account Type</label>
        <select name="account_type" class="w-full border-gray-300 rounded p-2">
            <option value="saving" {{ old('account_type', $account->account_type ?? '') == 'saving' ? 'selected' : '' }}>Saving</option>
            <option value="deposit" {{ old('account_type', $account->account_type ?? '') == 'deposit' ? 'selected' : '' }}>Deposit</option>
        </select>
        @error('account_type') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Balance</label>
        <input type="number" step="0.01" name="balance" value="{{ old('balance', $account->balance ?? 0) }}" class="w-full border-gray-300 rounded p-2">
        @error('balance') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
</div>
