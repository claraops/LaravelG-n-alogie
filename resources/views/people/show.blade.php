<x-guest-layout>
    <div class="w-full max-w-2xl bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">{{ $person->first_name }} {{ $person->last_name }}</h1>
        <div class="space-y-4">
            <p><span class="font-medium text-gray-700">Birth Name:</span> {{ $person->birth_name }}</p>
            <p><span class="font-medium text-gray-700">Middle Names:</span> {{ $person->middle_names }}</p>
            <p><span class="font-medium text-gray-700">Date of Birth:</span> {{ $person->date_of_birth }}</p>
        </div>

        <h2 class="text-xl font-bold mt-6 mb-4 text-gray-800">Children</h2>
        <ul class="space-y-2">
            @foreach ($person->children as $child)
                <li class="bg-gray-50 p-3 rounded-lg">{{ $child->child->first_name }} {{ $child->child->last_name }}</li>
            @endforeach
        </ul>

        <h2 class="text-xl font-bold mt-6 mb-4 text-gray-800">Parents</h2>
        <ul class="space-y-2">
            @foreach ($person->parents as $parent)
                <li class="bg-gray-50 p-3 rounded-lg">{{ $parent->parent->first_name }} {{ $parent->parent->last_name }}</li>
            @endforeach
        </ul>

        <div class="mt-6">
            <a href="{{ route('people.index') }}" class="text-blue-600 hover:text-blue-800">Retour</a>
        </div>
    </div>
</x-guest-layout>




