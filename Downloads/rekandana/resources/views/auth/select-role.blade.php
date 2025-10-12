<x-guest-layout>
    <div class="mb-6">
        <a href="/" class="text-sm text-gray-300 hover:text-white">
            &larr; Kembali ke Beranda
        </a>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4">
        <h2 class="text-center text-2xl font-bold text-white mb-2">Daftar Akun</h2>
        <p class="text-center text-gray-300 mb-6">Pilih jenis akun yang ingin Anda buat.</p>

        <a href="{{ route('register.mahasiswa') }}" class="block w-full text-left p-4 glass-card neon-border rounded-lg hover:scale-[1.01] mb-4 transition-transform">
            <h3 class="font-semibold text-lg text-center text-white">Penyelenggara Kegiatan</h3>
            <p class="text-sm text-gray-300 text-center">(User)</p>
        </a>

        <a href="{{ route('register.sponsor') }}" class="block w-full text-left p-4 glass-card neon-border rounded-lg hover:scale-[1.01] transition-transform">
            <h3 class="font-semibold text-lg text-center text-white">Pemberi Sponsor</h3>
            <p class="text-sm text-gray-300 text-center">(Perusahaan)</p>
        </a>
    </div>
</x-guest-layout>
