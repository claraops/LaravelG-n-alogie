<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationshipVote extends Model
{
    protected $fillable = ['proposal_id', 'user_id', 'vote'];

    public function proposal()
    {
        return $this->belongsTo(RelationshipProposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
