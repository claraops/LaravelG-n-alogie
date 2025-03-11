<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
    ];
    //

    

    public function children()
    {
        return $this->hasMany(Relationship::class, 'parent_id');
    }

    public function parents()
    {
        return $this->hasMany(Relationship::class, 'child_id');
    }

   /* public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }*/

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault([
            'name' => 'Unknown',
        ]);
    }

    

    public function getDegreeWith($target_person_id)
{
    // Si la personne cible est la même que la personne actuelle, le degré est 0
    if ($this->id == $target_person_id) {
        return 0;
    }

    // Initialisation des variables
    $visited = []; // Pour garder une trace des personnes déjà visitées
    $queue = new \SplQueue(); // File d'attente pour le BFS
    $queue->enqueue([$this->id, 0]); // Ajouter la personne actuelle avec un degré de 0

    // Tant que la file d'attente n'est pas vide
    while (!$queue->isEmpty()) {
        // Récupérer la personne en tête de la file
        [$currentId, $degree] = $queue->dequeue();

        // Si la personne cible est trouvée, retourner le degré
        if ($currentId == $target_person_id) {
            return $degree;
        }

        // Si le degré dépasse 25, arrêter la recherche
        if ($degree >= 25) {
            return false;
        }

        // Marquer la personne comme visitée
        $visited[$currentId] = true;

        // Récupérer la personne actuelle
        $person = Person::find($currentId);

        // Vérifier si la personne existe
        if (!$person) {
            continue; // Passer à la prochaine itération si la personne n'existe pas
        }

        // Parcourir les parents et les enfants de la personne actuelle
        foreach ($person->parents as $parent) {
            if (!isset($visited[$parent->id])) {
                $queue->enqueue([$parent->id, $degree + 1]);
            }
        }
        foreach ($person->children as $child) {
            if (!isset($visited[$child->id])) {
                $queue->enqueue([$child->id, $degree + 1]);
            }
        }
    }

    // Si la personne cible n'est pas trouvée, retourner false
    return false;
}

}
