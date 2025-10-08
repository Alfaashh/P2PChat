<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\Admin\ProposalController as AdminProposalController;
use App\Http\Controllers\Admin\ReferralCodeController;
use App\Http\Controllers\Auth\RoleSelectionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DealController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SponsorController;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', [RoleSelectionController::class, 'create'])->name('register');
Route::get('/register/mahasiswa', [RegisteredUserController::class, 'createMahasiswa'])->name('register.mahasiswa');
Route::get('/register/sponsor', [RegisteredUserController::class, 'createSponsor'])->name('register.sponsor');
Route::post('/register', [RegisteredUserController::class, 'store']);


//ROUTES UNTUK SEMUA USER YANG SUDAH LOGIN 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//ROUTES KHUSUS UNTUK MAHASISWA 
Route::middleware(['auth', 'verified', 'mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::get('/my-proposals', [ProposalController::class, 'myProposals'])->name('proposals.index');
    Route::get('/proposal/create', [ProposalController::class, 'create'])->name('proposals.create');
    Route::post('/proposal', [ProposalController::class, 'store'])->name('proposals.store');
});


//ROUTES KHUSUS UNTUK SPONSOR
Route::middleware(['auth', 'verified', 'sponsor'])->prefix('sponsor')->name('sponsor.')->group(function() {
    Route::get('/proposals', [ProposalController::class, 'index'])->name('proposals.index');
    Route::get('/proposals/search', [ProposalController::class, 'search'])->name('proposals.search');
    Route::get('/proposals/direct', [SponsorController::class, 'direct'])->name('proposals.direct' );
    Route::get('/proposals/direct/{direct}', [SponsorController::class, 'showDirect'])->name('proposals.direct.show');
    Route::get('/proposals/saved', [ProposalController::class, 'saved'])->name('proposals.saved');
    Route::get('/proposals/{proposal}', [ProposalController::class, 'show'])->name('proposals.show');
    Route::post('/proposals/{proposal}/save', [ProposalController::class, 'save'])->name('proposals.save');
    Route::delete('/proposals/{proposal}/unsave', [ProposalController::class, 'unsave'])->name('proposals.unsave');
    Route::post('/deals/{proposal}/initiate', [DealController::class, 'initiate'])->name('deals.initiate');
});


//ROUTES KHUSUS UNTUK ADMIN
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/proposals', [AdminProposalController::class, 'index'])->name('proposals.index');
    Route::put('/proposals/{proposal}/approve', [AdminProposalController::class, 'approve'])->name('proposals.approve');
    Route::put('/proposals/{proposal}/reject', [AdminProposalController::class, 'reject'])->name('proposals.reject');

    // Referral Codes Management
    Route::resource('referral-codes', ReferralCodeController::class);
    Route::patch('/referral-codes/{referralCode}/toggle', [ReferralCodeController::class, 'toggleStatus'])->name('referral-codes.toggle');
});

require __DIR__.'/auth.php';