<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProposalController;
use App\Models\ModificationProposal;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('people', PersonController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/test-degree', function () {
    DB::enableQueryLog();
    $timestart = microtime(true);

    $person = Person::findOrFail(84);
    $degree = $person->getDegreeWith(1265);

    $time = microtime(true) - $timestart;
    $nbQueries = count(DB::getQueryLog()); // Ajouter cette ligne pour compter les requêtes

    return response()->json([
        "degree" => $degree,
        "time" => $time,
        "nb_queries" => $nbQueries, 
    ]);
});



Route::post('/proposals/{proposalId}/validate', [ProposalController::class, 'validateProposal'])
    ->name('proposals.validate');

    Route::get('/test-create-proposal', function () {
       
        $person = Person::find(1);
    
        
        $user = Auth::user();
    
     
        if ($person === null || $user === null) {
            return response()->json([
                'message' => 'Personne ou utilisateur non trouvé.',
            ], 404);
        }
    
        // Créer une proposition de modification
        $proposal = ModificationProposal::create([
            'person_id' => $person->id,
            'field' => 'first_name',
            'new_value' => 'NouveauPrénom',
            'proposed_by' => $user->id,
            'status' => 'pending',
        ]);
    
        // Retourner une réponse JSON
        return response()->json([
            'message' => 'Proposition créée avec succès.',
            'proposal' => $proposal,
        ]);
    });


    Route::get('/test-vote-proposal/{proposalId}', function ($proposalId) {
        // Récupérer la proposition
        $proposal = ModificationProposal::findOrFail($proposalId);
    
        // Récupérer l'utilisateur actuellement connecté
        $user = Auth::user();
    
        // Vérifier si l'utilisateur existe
        if ($user === null) {
            return response()->json([
                'message' => 'Utilisateur non authentifié.',
            ], 401);
        }
    
        // Simuler un vote "accept" ou "reject"
        $vote = ModificationVote::create([
            'proposal_id' => $proposal->id,
            'user_id' => $user->id,
            'vote' => 'accept',
        ]);
    
        
        return response()->json([
            'message' => 'Vote enregistré avec succès.',
            'vote' => $vote,
        ]);
    });


require __DIR__.'/auth.php';
