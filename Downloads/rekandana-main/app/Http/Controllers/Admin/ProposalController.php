<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proposal;
use Illuminate\Http\Request;
use App\Notifications\ProposalNotification;
use App\Notifications\ProposalStatusUpdated;

class ProposalController extends Controller
{
    public function index() {
        $pendingProposals = Proposal::where('status', 'pending')->with('user')->latest()->get();
        return view('admin.proposals.index', compact('pendingProposals'));
    }

    public function approve(Proposal $proposal) {
        $proposal->update(['status' => 'approved']);

        $proposal->user->notify(new ProposalStatusUpdated('disetujui', $proposal->title));

        return back()->with('success','Proposal disetujui dan notifikasi telah dikirim ke email user.');
    }

    public function reject(Proposal $proposal) {
        $proposal->update(['status' => 'rejected']);

        $proposal->user->notify(new ProposalStatusUpdated('ditolak', $proposal->title));

        return back()->with('success','Proposal ditolak dan notifikasi telah dikirim ke email user.');
    }
}
