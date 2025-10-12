<x-guest-layout>
    <div class="text-left mb-6">
        <a href="{{ route('register') }}" class="text-sm text-gray-300 hover:text-white">
            &larr; Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="sponsor">

        <h2 class="text-2xl font-bold mb-1 text-white">Daftar sebagai Pemberi Sponsor</h2>
        <p class="text-gray-300 mb-6">Lengkapi data perusahaan dan Anda untuk membuat akun.</p>

        <div>
            <x-input-label for="referral_code" value="Kode Referral" />
            <x-text-input id="referral_code" class="block mt-1 w-full" type="text" name="referral_code" :value="old('referral_code')" required autofocus placeholder="Masukkan kode referral Anda" />
            <x-input-error :messages="$errors->get('referral_code')" class="mt-2" />
            <p class="text-xs text-gray-400 mt-1">Anda memerlukan kode referral untuk mendaftar sebagai sponsor</p>
        </div>

        <div class="mt-4">
            <x-input-label for="name" value="Nama Lengkap PIC" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="company_name" value="Nama Perusahaan" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="company_address" value="Alamat Kantor Perusahaan" />
            <textarea id="company_address" name="company_address" rows="3" class="block mt-1 w-full textarea-dark rounded-md shadow-sm">{{ old('company_address') }}</textarea>
            <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email Bisnis" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="no_hp" value="No. WhatsApp PIC" />
            <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('whatsapp_pic')" required />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="industry" value="Bidang Industri" />
            <select id="industry" name="industry" class="block mt-1 w-full select-dark rounded-md shadow-sm">
                <option>Pilih bidang industri</option>
                <option value="Teknologi" @selected(old('industry') == 'Teknologi')>Teknologi</option>
                <option value="Keuangan" @selected(old('industry') == 'Keuangan')>Keuangan</option>
                <option value="Pendidikan" @selected(old('industry') == 'Pendidikan')>Pendidikan</option>
                <option value="Kesehatan" @selected(old('industry') == 'Kesehatan')>Kesehatan</option>
                <option value="Manufaktur" @selected(old('industry') == 'Manufaktur')>Manufaktur</option>
                <option value="Retail" @selected(old('industry') == 'Retail')>Retail</option>
                <option value="Lainnya" @selected(old('industry') == 'Lainnya')>Lainnya</option>
            </select>
            <x-input-error :messages="$errors->get('industry')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="website" value="Website (Opsional)" />
            <x-text-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" />
            <x-input-error :messages="$errors->get('website')" class="mt-2" />
        </div>
        
        <div class="mt-4">
             <x-input-label for="logo" value="Logo Perusahaan" />
             <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-white/20 border-dashed rounded-md bg-slate-900/30">
                <div id="logo-upload-ui" class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-300">
                        <label for="logo" class="relative cursor-pointer rounded-md font-medium text-indigo-300 hover:text-indigo-200 focus-within:outline-none">
                            <span>Klik untuk upload</span>
                            <input id="logo" name="logo" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-400">PNG, JPG atau PDF (Maks. 2MB)</p>
                    <p id="logo-file-name" class="text-sm text-gray-200 font-semibold mt-2"></p>
                </div>
            </div>
            <x-input-error :messages="$errors->get('logo')" class="mt-2" />
        </div>  

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center mt-6 justify-center">
            <button class="btn-gradient w-full px-4 py-2 rounded-lg font-semibold text-white">Daftar &amp; Verifikasi Email</button>
        </div>
    </form>

    <script>
        const logoInput = document.getElementById('logo');
        const fileNameDisplay = document.getElementById('logo-file-name');

        logoInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                // Tampilkan nama file yang dipilih
                fileNameDisplay.textContent = 'File terpilih: ' + this.files[0].name;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    </script>
</x-guest-layout>
