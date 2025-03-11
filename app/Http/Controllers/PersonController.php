<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Person;

class PersonController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store']);
    }

    public function index()
    {
        $people = Person::with('creator')->get();
        return view('people.index', compact('people'));
    }

    public function show($id)
    {
        $person = Person::with(['children', 'parents'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    public function create()
    {
        return view('people.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'birth_name' => 'nullable|string|max:255',
        'middle_names' => 'nullable|string|max:255',
        'date_of_birth' => 'nullable|date',
    ]);

    // Vérifiez que l'utilisateur est authentifié
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Vous devez être connecté pour créer une personne.');
    }

    $validatedData['created_by'] = auth()->id();

    // Formatting data
    $validatedData['first_name'] = ucfirst(strtolower($validatedData['first_name']));
    $validatedData['last_name'] = strtoupper($validatedData['last_name']);
    $validatedData['birth_name'] = $validatedData['birth_name'] ? strtoupper($validatedData['birth_name']) : $validatedData['last_name'];
    $validatedData['middle_names'] = $validatedData['middle_names'] ? implode(', ', array_map('ucfirst', explode(',', strtolower($validatedData['middle_names'])))) : null;

    Person::create($validatedData);

    return redirect()->route('people.index')->with('success', 'La personne a été créée avec succès.');
}
   
}
