<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModificationVote extends Model
{
    protected $fillable = ['proposal_id', 'user_id', 'vote'];

    public function proposal()
    {
        return $this->belongsTo(ModificationProposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
