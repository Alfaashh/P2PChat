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

    public function saveDirectProposal(ProposalInvitation $invitation)
    {
        // Validasi bahwa sponsor yang login adalah penerima undangan
        if ($invitation->sponsor_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $proposal = $invitation->proposal;
        $proposalTitle = $proposal->title ?? 'Proposal';

        // Update status invitation menjadi 'interested'
        $invitation->update(['status' => 'interested']);

        // Simpan proposal ke saved_proposals jika belum ada
        $sponsor = auth()->user();
        if (!$sponsor->savedProposals()->where('proposal_id', $proposal->id)->exists()) {
            $sponsor->savedProposals()->attach($proposal->id);
        }

        return response()->json([
            'success' => true,
            'message' => "Proposal '{$proposalTitle}' berhasil disimpan ke daftar minat Anda! Anda dapat menghubungi mahasiswa untuk melanjutkan diskusi."
        ]);
    }

    public function rejectDirectProposal(ProposalInvitation $invitation)
    {
        // Validasi bahwa sponsor yang login adalah penerima undangan
        if ($invitation->sponsor_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        // Ambil data proposal dan mahasiswa sebelum dihapus
        $proposal = $invitation->proposal;
        $mahasiswa = $proposal->user;
        $proposalTitle = $proposal->title ?? 'Proposal';

        // Hapus invitation dari database
        $invitation->delete();

        // Kirim email notifikasi ke mahasiswa
        \Mail::to($mahasiswa->email)->send(new \App\Mail\ProposalRejected($proposal, $mahasiswa, auth()->user()));

        return response()->json([
            'success' => true,
            'message' => "Proposal '{$proposalTitle}' berhasil ditolak. Email notifikasi telah dikirim ke mahasiswa."
        ]);
    }
}
