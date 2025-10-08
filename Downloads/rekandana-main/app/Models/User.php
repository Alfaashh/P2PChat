<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_code_id',
        'university',
        'nim',
        'ktm_path',
        'company_name',
        'company_address',
        'industry',
        'website',
        'logo_path',
        'no_hp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function proposals() {
        return $this->hasMany(Proposal::class);
    }

    public function savedProposals() {
        return $this->belongsToMany(Proposal::class,'saved_proposals');
    }
    
    public function receivedInvitations() {
        return $this->hasMany(ProposalInvitation::class, 'sponsor_id');
    }

    public function referralCode() {
        return $this->belongsTo(ReferralCode::class);
    }
}
