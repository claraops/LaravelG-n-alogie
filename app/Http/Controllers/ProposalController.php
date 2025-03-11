<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModificationProposal;


class ProposalController extends Controller
{
    public function validateProposal($proposalId)
    {
        // Récupérer la proposition
        $proposal = ModificationProposal::findOrFail($proposalId);

        // Compter les votes "accept"
        $acceptCount = $proposal->votes()->where('vote', 'accept')->count();

        // Compter les votes "reject"
        $rejectCount = $proposal->votes()->where('vote', 'reject')->count();

        if ($acceptCount >= 3) {
            // Appliquer la modification
            $person = $proposal->person;
            $person->{$proposal->field} = $proposal->new_value;
            $person->save();

            // Mettre à jour le statut de la proposition
            $proposal->status = 'approved';
            $proposal->save();

            return response()->json([
                'message' => 'La proposition a été approuvée et appliquée.',
                'proposal' => $proposal,
            ]);
        } elseif ($rejectCount >= 3) {
            // Rejeter la proposition
            $proposal->status = 'rejected';
            $proposal->save();

            return response()->json([
                'message' => 'La proposition a été rejetée.',
                'proposal' => $proposal,
            ]);
        } else {
            return response()->json([
                'message' => 'La proposition est toujours en attente de votes.',
                'proposal' => $proposal,
            ]);
        }
    }
}
