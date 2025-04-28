<div class="grid grid-cols-1 gap-4">
    <div>
        <label class="block mb-1 font-semibold">Name</label>
        <input type="text" name="name" value="{{ old('name', $customer->name ?? '') }}" class="w-full border-gray-300 rounded p-2">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">ID Number</label>
        <input type="text" name="id_number" value="{{ old('id_number', $customer->id_number ?? '') }}" class="w-full border-gray-300 rounded p-2">
        @error('id_number') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">CIF Number</label>
        <input type="text" name="cif_number" value="{{ old('cif_number', $customer->cif_number ?? '') }}" class="w-full border-gray-300 rounded p-2">
        @error('cif_number') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Address</label>
        <textarea name="address" class="w-full border-gray-300 rounded p-2">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Email</label>
        <input type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" class="w-full border-gray-300 rounded p-2">
        @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block mb-1 font-semibold">Date of Birth</label>
        <input type="date" name="date_of_birth" value="{{ old('date_of_birth', isset($customer->date_of_birth) ? $customer->date_of_birth->format('Y-m-d') : '') }}" class="w-full border-gray-300 rounded p-2">
        @error('date_of_birth') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
</div>
