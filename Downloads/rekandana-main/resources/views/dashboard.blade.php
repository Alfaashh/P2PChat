<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(auth()->user()->role === 'mahasiswa')
                        <h3 class="text-lg font-medium">Selamat Datang, Pengaju Proposal!</h3>
                        <p class="mt-2">Siap untuk mewujudkan idemu? Ajukan proposalmu sekarang dan temukan sponsor yang tepat!</p>
                        <a href="{{ route('mahasiswa.proposals.create') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">
                            Ajukan Proposal Baru
                        </a>

                    @elseif(auth()->user()->role === 'sponsor')
                        <h3 class="text-lg font-medium">Selamat Datang, Sponsor!</h3>
                        <p class="mt-2">Temukan proposal inovatif dari mahasiswa berbakat di seluruh Indonesia.</p>
                         <a href="{{ route('sponsor.proposals.index') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700">
                            Mulai Cari Proposal
                        </a>

                    @elseif(auth()->user()->role === 'admin')
                        <h3 class="text-lg font-medium">Selamat Datang, Admin!</h3>
                        <p class="mt-2">Ini adalah area administrasi. Kamu bisa mengelola proposal yang masuk dari sini.</p>
                         <a href="{{ route('admin.proposals.index') }}" class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900">
                            Lihat Proposal Masuk
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>