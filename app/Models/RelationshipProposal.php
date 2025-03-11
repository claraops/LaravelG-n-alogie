<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelationshipProposal extends Model
{
    protected $fillable = [
        'parent_id', 'child_id', 'proposed_by', 'status',
    ];

    public function parent()
    {
        return $this->belongsTo(Person::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Person::class, 'child_id');
    }

    public function proposer()
    {
        return $this->belongsTo(User::class, 'proposed_by');
    }

    public function votes()
    {
        return $this->hasMany(RelationshipVote::class);
    }
}
