<?php

namespace App\Http\Controllers;
use App\Models\Deal;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Notifications\NewDealInitiated;

class DealController extends Controller
{
    public function initiate(Proposal $proposal)
    {
        // Cek jika deal sudah ada
        $existingDeal = Deal::where('proposal_id', $proposal->id)
                            ->where('sponsor_id', auth()->id())->exists();

        if ($existingDeal) {
            return back()->with('error', 'Anda sudah pernah memulai deal untuk proposal ini.');
        }

        Deal::create([
            'proposal_id' => $proposal->id,
            'sponsor_id' => auth()->id(),
        ]);

        // Kirim notifikasi ke pengaju proposal
        $proposal->user->notify(new NewDealInitiated($proposal, auth()->user()));

        return back()->with('success', 'Deal berhasil dimulai! Pengaju proposal akan segera dihubungi.');
    }
}
