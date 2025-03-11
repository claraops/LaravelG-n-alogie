<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col items-center p-6">
       
        <div class="w-full max-w-7xl">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">People List</h1>
                <a href="{{ route('people.create') }}" class="bg-green-600 text-green px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                    Create New Person
                </a>
                <div style="background color: red;">
               
                </div>

            </div>

            <!-- Tableau des personnes -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="min-w-full">


                    <!-- En-tête du tableau -->
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <!-- Corps du tableau -->
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($people as $person)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <!-- Nom complet -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                
                                    <a href="{{ route('people.show', $person->id) }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $person->first_name }} {{ $person->last_name }}
                                    </a>
                                </td>
                                <!-- Créé par -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $person->creator ? $person->creator->name : 'Unknown' }}
                                </td>
                                <!-- Actions -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <a href="{{ route('people.edit', $person->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <span class="mx-2 text-gray-300">|</span>
                                    <form action="{{ route('people.destroy', $person->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
