<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferralCode;
use Illuminate\Http\Request;

class ReferralCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $referralCodes = ReferralCode::withCount('users')->latest()->paginate(10);
        return view('admin.referral-codes.index', compact('referralCodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.referral-codes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:referral_codes,code'],
            'is_active' => ['boolean'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date', 'after:now'],
        ]);

        ReferralCode::create([
            'code' => strtoupper($request->code),
            'is_active' => $request->has('is_active'),
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.referral-codes.index')
            ->with('success', 'Kode referral berhasil dibuat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReferralCode $referralCode)
    {
        return view('admin.referral-codes.edit', compact('referralCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReferralCode $referralCode)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:255', 'unique:referral_codes,code,' . $referralCode->id],
            'is_active' => ['boolean'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable', 'date'],
        ]);

        $referralCode->update([
            'code' => strtoupper($request->code),
            'is_active' => $request->has('is_active'),
            'max_uses' => $request->max_uses,
            'expires_at' => $request->expires_at,
        ]);

        return redirect()->route('admin.referral-codes.index')
            ->with('success', 'Kode referral berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReferralCode $referralCode)
    {
        $referralCode->delete();

        return redirect()->route('admin.referral-codes.index')
            ->with('success', 'Kode referral berhasil dihapus!');
    }

    /**
     * Toggle active status
     */
    public function toggleStatus(ReferralCode $referralCode)
    {
        $referralCode->update([
            'is_active' => !$referralCode->is_active
        ]);

        return back()->with('success', 'Status kode referral berhasil diubah!');
    }
}
