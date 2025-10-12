<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProposalInvitation extends Model
{
    protected $fillable = ['proposal_id', 'sponsor_id', 'status'];

    public function proposal() {
        return $this->belongsTo(Proposal::class);
    }

    public function sponsor() {
        return $this->belongsTo(User::class, 'sponsor_id');
    }
}
