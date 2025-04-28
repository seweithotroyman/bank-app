<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Edit Customer</h2>

        <form action="{{ route('customers.update', $customer) }}" method="POST" class="bg-white p-6 rounded shadow-md">
            @csrf
            @method('PUT')

            @include('customers.partials.form')

            <div class="mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>
