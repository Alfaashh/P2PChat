@props(['proposal'])

<div class="overflow-hidden sm:rounded-xl glass-card neon-border">
    <div class="p-6">
        <h3 class="text-lg font-bold text-white">
            <a href="{{ route('sponsor.proposals.show', $proposal) }}" class="hover:text-indigo-300">
                {{ $proposal->title }}
            </a>
        </h3>

        <div class="mt-2 text-sm text-gray-300">
            <p>Diajukan oleh: <span class="font-semibold">{{ $proposal->user->name }}</span></p>
            <p>Universitas: <span class="font-semibold">{{ $proposal->user->university }}</span></p>
        </div>

        <p class="mt-4 text-gray-200/90 line-clamp-3">
            {{ $proposal->description }}
        </p>

        <div class="mt-4 flex justify-between items-center">
            <p class="text-sm font-bold text-indigo-300">
                Butuh Dana: Rp {{ number_format($proposal->funding_goal, 0, ',', '.') }}
            </p>
            <a href="{{ route('sponsor.proposals.show', $proposal) }}" class="text-sm font-semibold text-indigo-300 hover:text-indigo-200">
                Lihat Detail &rarr;
            </a>
        </div>
    </div>
</div>
