<x-guest-layout>
    <div class="text-left mb-6">
        <a href="{{ route('register') }}" class="text-sm text-gray-600 hover:text-gray-900">
            &larr; Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="role" value="mahasiswa">

        <h2 class="text-2xl font-bold mb-1">Daftar sebagai Penyelenggara Acara</h2>
        <p class="text-gray-600 mb-6">Lengkapi data diri Anda untuk membuat akun.</p>

        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Email Aktif" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="no_hp" value="No. WhatsApp Aktif" />
            <x-text-input id="no_hp" class="block mt-1 w-full" type="text" name="no_hp" :value="old('no_hp')" required />
            <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="university" value="Asal Universitas" />
            <x-text-input id="university" class="block mt-1 w-full" type="text" name="university" :value="old('university')" required />
            <x-input-error :messages="$errors->get('university')" class="mt-2" />
        </div>
        
        <div class="mt-4">
            <x-input-label for="nim" value="NIM" />
            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')" required />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <div class="mt-4">
             <x-input-label for="ktm" value="Scan KTM" />
             <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div id="ktm-upload-ui" class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="ktm" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                            <span>Klik untuk upload</span>
                            <input id="ktm" name="ktm" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">atau drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG atau PDF (Maks. 2MB)</p>
                    <p id="ktm-file-name" class="text-sm text-gray-800 font-semibold mt-2"></p>
                </div>
            </div>
            <x-input-error :messages="$errors->get('ktm')" class="mt-2" />
        </div>  

        <div class="mt-4">
            <x-input-label for="password" value="Password" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4 bg-black rounded-md">
            <button class="text-white inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg]:size-4 [&amp;_svg]:shrink-0 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2 w-full">Daftar &amp; Verifikasi Email</button>
        </div>
    </form>

    <script>
        const ktmInput = document.getElementById('ktm');
        const fileNameDisplay = document.getElementById('ktm-file-name');

        ktmInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
                // Tampilkan nama file yang dipilih
                fileNameDisplay.textContent = 'File terpilih: ' + this.files[0].name;
            } else {
                fileNameDisplay.textContent = '';
            }
        });
    </script>
</x-guest-layout>