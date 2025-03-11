<x-guest-layout>
    <div class="w-full max-w-2xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Create New Person</h1>
        <form action="{{ route('people.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                <input type="text" name="first_name" id="first_name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                <input type="text" name="last_name" id="last_name" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="birth_name" class="block text-sm font-medium text-gray-700">Birth Name</label>
                <input type="text" name="birth_name" id="birth_name"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="middle_names" class="block text-sm font-medium text-gray-700">Middle Names</label>
                <input type="text" name="middle_names" id="middle_names"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div>
                <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                <input type="date" name="date_of_birth" id="date_of_birth"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('people.index') }}" class="text-blue-600 hover:text-blue-800">Retour</a>
                <button type="submit" class="bg-blue-600 text-red px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>












