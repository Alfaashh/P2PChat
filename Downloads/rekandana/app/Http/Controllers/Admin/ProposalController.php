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

    public function show(Proposal $proposal) {
        return view('admin.proposals.show', compact('proposal'));
    }

    public function approve(Proposal $proposal) {
        $proposal->update(['status' => 'approved']);

        $proposal->user->notify(new ProposalStatusUpdated('disetujui', $proposal->title));

        return back()->with('success', "Proposal '{$proposal->title}' berhasil disetujui! Notifikasi email telah dikirim ke {$proposal->user->name}.");
    }

    public function reject(Proposal $proposal) {
        $proposal->update(['status' => 'rejected']);

        $proposal->user->notify(new ProposalStatusUpdated('ditolak', $proposal->title));

        return back()->with('warning', "Proposal '{$proposal->title}' ditolak. Notifikasi email telah dikirim ke {$proposal->user->name}.");
    }

    public function history(Request $request) {
        $query = Proposal::where('status', 'approved')->with('user');

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%$search%")
                                ->orWhere('university', 'like', "%$search%");
                  });
            });
        }

        // Category filter
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        // Field filter
        if ($request->filled('bidang')) {
            $query->where('bidang', $request->input('bidang'));
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('updated_at', '>=', $request->input('date_from'));
        }

        if ($request->filled('date_to')) {
            $query->whereDate('updated_at', '<=', $request->input('date_to'));
        }

        // Sorting
        $sort = $request->input('sort', 'terbaru');
        switch ($sort) {
            case 'terbaru':
                $query->latest('updated_at');
                break;
            case 'terlama':
                $query->oldest('updated_at');
                break;
            case 'alfabetis':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest('updated_at');
                break;
        }

        $approvedProposals = $query->paginate(15)->withQueryString();

        // Get statistics
        $totalApproved = Proposal::where('status', 'approved')->count();
        $categories = Proposal::where('status', 'approved')->distinct()->pluck('kategori')->filter()->sort()->values();
        $fields = Proposal::where('status', 'approved')->distinct()->pluck('bidang')->filter()->sort()->values();

        // Category counts for stats
        $categoryStats = Proposal::where('status', 'approved')
                                 ->select('kategori', \DB::raw('count(*) as total'))
                                 ->groupBy('kategori')
                                 ->get();

        return view('admin.proposals.history', compact('approvedProposals', 'totalApproved', 'categories', 'fields', 'categoryStats'));
    }
}
