<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Proposal Disimpan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse (auth()->user()->savedProposals as $proposal)
                    <x-proposal-card :proposal="$proposal" />
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-300">Anda belum menyimpan proposal apapun.</p>
                        <a href="{{ route('sponsor.proposals.index') }}" class="mt-2 text-indigo-300 font-semibold hover:underline">
                            Mulai cari proposal sekarang!
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
