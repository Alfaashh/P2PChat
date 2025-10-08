<x-guest-layout>
    <div class="mb-6">
        <a href="/" class="text-sm text-gray-600 hover:text-gray-900">
            &larr; Kembali ke Beranda
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-2">Daftar Akun</h2>
        <p class="text-center text-gray-600 mb-6">Pilih jenis akun yang ingin Anda buat.</p>

        <a href="{{ route('register.mahasiswa') }}" class="block w-full text-left p-4 border rounded-lg hover:bg-gray-50 mb-4">
            <h3 class="font-semibold text-lg text-center">Penyelenggara Kegiatan</h3>
            <p class="text-sm text-gray-500 text-center">(User)</p>
        </a>

        <a href="{{ route('register.sponsor') }}" class="block w-full text-left p-4 border rounded-lg hover:bg-gray-50">
            <h3 class="font-semibold text-lg text-center">Pemberi Sponsor</h3>
            <p class="text-sm text-gray-500 text-center">(Perusahaan)</p>
        </a>
    </div>
</x-guest-layout>