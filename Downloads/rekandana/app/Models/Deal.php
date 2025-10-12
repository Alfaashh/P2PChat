<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'proposal_id',
        'sponsor_id',
        'status'
    ];
}
