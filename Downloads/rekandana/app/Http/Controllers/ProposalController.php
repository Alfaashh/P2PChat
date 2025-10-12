<?php

namespace App\Http\Controllers;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\User;
use App\Models\ProposalInvitation;
class ProposalController extends Controller
{
    use AuthorizesRequests;
    public function index() {
        if(auth()->user()->role !== 'sponsor') {
            abort(403);
        }

        $proposals = Proposal::where('status', 'approved')->latest()->paginate(12);
        
        // Get unique categories and fields for filter dropdowns
        $categories = Proposal::where('status', 'approved')->distinct()->pluck('kategori')->filter()->sort()->values();
        $fields = Proposal::where('status', 'approved')->distinct()->pluck('bidang')->filter()->sort()->values();
        
        return view('sponsor.proposal.index', compact('proposals', 'categories', 'fields'));
    }
    public function create()
    {
        $this->authorize('create', Proposal::class);

        // ambil semua user dengan role 'sponsor'
        $sponsors = User::where('role', 'sponsor')->get();

        // hanya mahasiswa yg bisa akses halaman ini
        if (auth()->user()->role !== 'mahasiswa') {
            abort(403);
        }
        return view('mahasiswa.proposal.create', compact('sponsors'));
    }

    public function store(Request $request) {

        $this->authorize('create', Proposal::class);

        // Validasi kuota direct proposal jika user mencoba mengirim ke sponsor tertentu
        if($request->filled('target_sponsor_id')) {
            $user = auth()->user();
            if($user->direct_proposal_quota <= 0) {
                return back()->withErrors([
                    'target_sponsor_id' => 'Kuota direct proposal Anda sudah habis. Proposal akan dikirim ke daftar umum.'
                ])->withInput();
            }
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'funding_goal' => 'nullable|numeric',
            'proposal_file' => 'required|file|mimes:pdf|max:5120', // Hanya PDF, Maks 5MB
            'kategori' => 'required|string',
            'bidang' => 'required|string',
            'tanggal_acara' => 'required|date',
            'penyelenggara' => 'required|string',
            'link_sosmed' => 'nullable|string',
            'target_sponsor_id' => 'nullable|exists:users,id'
        ]);

        $filePath = $request->file('proposal_file')->store('proposals', 'public');

        $proposal = Proposal::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'funding_goal' => $request->funding_goal,
            'file_path' => $filePath,
            'status' => 'pending',
            'kategori' => $request->kategori,
            'bidang' => $request->bidang,
            'tanggal_acara' => $request->tanggal_acara,
            'penyelenggara' => $request->penyelenggara,
            'link_sosmed' => $request->link_sosmed
        ]);

        if($request->filled('target_sponsor_id')) {
            ProposalInvitation::create([
                'proposal_id' => $proposal->id,
                'sponsor_id' => $request->target_sponsor_id,
            ]);

            // Kurangi kuota direct proposal (tidak akan kembali meskipun ditolak)
            $user = auth()->user();
            $remainingQuota = max(0, $user->direct_proposal_quota - 1);
            $user->decrement('direct_proposal_quota');

            // Get sponsor name
            $sponsor = User::find($request->target_sponsor_id);
            $sponsorName = $sponsor ? $sponsor->company_name : 'sponsor';

            return redirect()->route('dashboard')->with('success', "Proposal '{$request->title}' berhasil diajukan! Proposal Anda telah dikirim langsung ke {$sponsorName} dan juga akan muncul di daftar proposal umum setelah disetujui admin. Sisa kuota direct proposal: {$remainingQuota}");
        }

        return redirect()->route('dashboard')->with('success', "Proposal '{$request->title}' berhasil diajukan! Proposal Anda akan direview oleh tim admin dan kemudian akan muncul di daftar proposal untuk semua sponsor.");
    }

    //Untuk menambahkan proposal ke daftar minat (Sponsor)
    public function save(Proposal $proposal) {
        auth()->user()->savedProposals()->attach($proposal->id);
        return back()->with('success', "Proposal '{$proposal->title}' berhasil disimpan ke daftar minat Anda!");
    }

    public function unsave(Proposal $proposal)
    {
        auth()->user()->savedProposals()->detach($proposal->id);
        return back()->with('info', "Proposal '{$proposal->title}' berhasil dihapus dari daftar minat.");
    }
    public function myProposals()
    {
        // Mengambil semua proposal yang user_id-nya sama dengan ID user yang login
        $proposals = auth()->user()->proposals()->latest()->get();
        
        // Mengarahkan ke view yang benar untuk mahasiswa
        return view('mahasiswa.proposal.index', compact('proposals'));
    }

    public function show(Proposal $proposal)
    {
        // Pastikan hanya sponsor yang bisa melihat detail proposal yang sudah di-approve
        if ($proposal->status !== 'approved') {
            abort(404); 
        }
        
        return view('sponsor.proposal.show', compact('proposal'));
    }

    //Menampilkan daftar proposal yang disimpan oleh sponsor
    public function saved()
    {
        $proposals = auth()->user()->savedProposals()->latest()->paginate(10);

        return view('sponsor.proposal.saved', compact('proposals'));
    }

    //Search Proposal (Sponsor)
    public function search(Request $request)
    {
        $query = Proposal::where('status', 'approved');
        
        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('kategori', 'like', "%$search%")
                  ->orWhere('bidang', 'like', "%$search%")
                  ->orWhere('penyelenggara', 'like', "%$search%");
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
        
        // Event date filter
        if ($request->filled('tanggal_acara')) {
            $tanggal_filter = $request->input('tanggal_acara');
            switch ($tanggal_filter) {
                case 'minggu_ini':
                    $query->whereBetween('tanggal_acara', [
                        now()->startOfWeek(),
                        now()->endOfWeek()
                    ]);
                    break;
                case 'bulan_ini':
                    $query->whereMonth('tanggal_acara', now()->month)
                          ->whereYear('tanggal_acara', now()->year);
                    break;
                case 'bulan_depan':
                    $query->whereMonth('tanggal_acara', now()->addMonth()->month)
                          ->whereYear('tanggal_acara', now()->addMonth()->year);
                    break;
                case 'tahun_ini':
                    $query->whereYear('tanggal_acara', now()->year);
                    break;
            }
        }
        
        // Funding range filter
        if ($request->filled('funding_min')) {
            $query->where('funding_goal', '>=', $request->input('funding_min'));
        }
        
        if ($request->filled('funding_max')) {
            $query->where('funding_goal', '<=', $request->input('funding_max'));
        }
        
        // Sorting
        $sort = $request->input('sort', 'terbaru');
        switch ($sort) {
            case 'terbaru':
                $query->latest();
                break;
            case 'terlama':
                $query->oldest();
                break;
            case 'tanggal_acara_terdekat':
                $query->orderBy('tanggal_acara', 'asc');
                break;
            case 'tanggal_acara_terjauh':
                $query->orderBy('tanggal_acara', 'desc');
                break;
            case 'funding_tertinggi':
                $query->orderBy('funding_goal', 'desc');
                break;
            case 'funding_terendah':
                $query->orderBy('funding_goal', 'asc');
                break;
            case 'alfabetis':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        
        $proposals = $query->paginate(12)->withQueryString();
        
        // Get unique categories and fields for filter dropdowns
        $categories = Proposal::where('status', 'approved')->distinct()->pluck('kategori')->filter()->sort()->values();
        $fields = Proposal::where('status', 'approved')->distinct()->pluck('bidang')->filter()->sort()->values();
        
        return view('sponsor.proposal.index', compact('proposals', 'categories', 'fields'));
    }
} 