<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModificationProposal extends Model
{
    protected $fillable = [
        'person_id', 'field', 'new_value', 'proposed_by', 'status',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function proposer()
    {
        return $this->belongsTo(User::class, 'proposed_by');
    }

    public function votes()
    {
        return $this->hasMany(ModificationVote::class);
    }
}
