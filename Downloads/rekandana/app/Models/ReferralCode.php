<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    protected $fillable = [
        'code',
        'is_active',
        'max_uses',
        'used_count',
        'expires_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function isValid()
    {
        // Cek apakah kode aktif
        if (!$this->is_active) {
            return false;
        }

        // Cek apakah sudah expired
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        // Cek apakah sudah mencapai batas penggunaan
        if ($this->max_uses && $this->used_count >= $this->max_uses) {
            return false;
        }

        return true;
    }

    public function incrementUsage()
    {
        $this->increment('used_count');
    }
}
