<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'funding_goal',
        'file_path',
        'status',
        'kategori',
        'bidang',
        'penyelenggara',
        'tanggal_acara',
        'link_sosmed'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function savedBySponsors() {
        return $this->belongsToMany(User::class, 'saved_proposals');
    }

    public function deals() {
        return $this->hasMany(Deal::class);
    }

    public function invitations() {
        return $this->hasMany(ProposalInvitation::class);
    }
}
