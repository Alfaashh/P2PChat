<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ReferralCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.select-role');
    }

    /**
     * Display the registration view for Mahasiswa.
     */
    public function createMahasiswa(): View
    {
        return view('auth.register-mahasiswa'); // Buat view ini
    }

    /**
     * Display the registration view for Perusahaan (Sponsor).
     */
    public function createSponsor(): View
    {
        return view('auth.register-sponsor'); // Buat view ini
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi berdasarkan peran yang dikirim dari form
        $role = $request->input('role');

        if ($role === 'mahasiswa') {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'no_hp' => ['required', 'string', 'max:15'],
                'university' => ['required', 'string', 'max:255'],
                'nim' => ['required', 'string', 'max:255'],
                'ktm' => ['required', 'file', 'mimes:png,jpg,pdf', 'max:2048'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);
        } elseif ($role === 'sponsor') {
            $request->validate([
                'referral_code' => ['required', 'string', 'exists:referral_codes,code'],
                'name' => ['required', 'string', 'max:255'],
                'company_name' => ['required', 'string', 'max:255'],
                'company_address' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'no_hp' => ['required', 'string', 'max:15'],
                'industry' => ['required', 'string'],
                'website' => ['nullable', 'string', 'url'],
                'logo' => ['nullable', 'file', 'mimes:png,jpg,svg', 'max:2048'],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // Validasi kode referral
            $referralCode = ReferralCode::where('code', $request->referral_code)->first();

            if (!$referralCode || !$referralCode->isValid()) {
                return back()->withErrors([
                    'referral_code' => 'Kode referral tidak valid, sudah expired, atau sudah mencapai batas penggunaan.'
                ])->withInput();
            }
        } else {
            // Jika role tidak valid, kembalikan ke halaman pilihan
            return redirect()->route('register');
        }

        // Simpan file jika ada
        $ktmPath = null;
        if ($request->hasFile('ktm')) {
            $ktmPath = $request->file('ktm')->store('ktm_files', 'public');
        }
        
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
        }

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
            'referral_code_id' => $role === 'sponsor' ? $referralCode->id : null,
            'university' => $request->university,
            'nim' => $request->nim,
            'ktm_path' => $ktmPath,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'industry' => $request->industry,
            'website' => $request->website,
            'logo_path' => $logoPath,
        ]);

        // Increment usage count untuk referral code jika sponsor
        if ($role === 'sponsor' && isset($referralCode)) {
            $referralCode->incrementUsage();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
