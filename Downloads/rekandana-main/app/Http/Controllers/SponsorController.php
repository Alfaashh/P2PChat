<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProposalInvitation;

class SponsorController extends Controller
{
    public function direct() {
        // Mengambil semua invitation yang diterima sponsor ini
        $directProposals = auth()->user()
                           ->receivedInvitations()
                           ->whereHas('proposal', function($query) {
                               $query->where('status', 'approved');
                           })
                           ->with(['proposal.user'])
                           ->latest()
                           ->paginate(10);

        // Mengambil semua perusahaan/sponsor untuk dropdown (jika diperlukan)
        $companies = \App\Models\User::where('role', 'sponsor')
                                    ->where('id', '!=', auth()->id())
                                    ->get();

        // Mengambil proposal user yang login (jika user adalah mahasiswa)
        $userProposals = collect(); // Empty collection sebagai default

        return view('sponsor.proposal.direct', compact('directProposals', 'companies', 'userProposals'));
    }

    public function showDirect(ProposalInvitation $direct)
    {
        // Keamanan 1: Pastikan sponsor yang login adalah penerima undangan
        if ($direct->sponsor_id !== auth()->id()) {
            abort(403, 'Akses Ditolak');
        }

        // Keamanan 2: Pastikan proposalnya sudah disetujui admin
        if ($direct->proposal->status !== 'approved') {
            abort(404, 'Proposal tidak ditemukan atau belum disetujui.');
        }

        // Kirim data undangan ke view baru yang akan kita buat
        return view('sponsor.directs.show', compact('direct'));
    }
}
