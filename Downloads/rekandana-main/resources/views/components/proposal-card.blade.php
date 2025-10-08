@props(['proposal'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
    <div class="p-6">
        <h3 class="text-lg font-bold text-gray-900">
            <a href="{{ route('sponsor.proposals.show', $proposal) }}" class="hover:text-indigo-600">
                {{ $proposal->title }}
            </a>
        </h3>

        <div class="mt-2 text-sm text-gray-600">
            <p>Diajukan oleh: <span class="font-semibold">{{ $proposal->user->name }}</span></p>
            <p>Universitas: <span class="font-semibold">{{ $proposal->user->university }}</span></p>
        </div>

        <p class="mt-4 text-gray-700 line-clamp-3">
            {{ $proposal->description }}
        </p>

        <div class="mt-4 flex justify-between items-center">
            <p class="text-sm font-bold text-indigo-600">
                Butuh Dana: Rp {{ number_format($proposal->funding_goal, 0, ',', '.') }}
            </p>
            <a href="{{ route('sponsor.proposals.show', $proposal) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-800">
                Lihat Detail &rarr;
            </a>
        </div>
    </div>
</div>