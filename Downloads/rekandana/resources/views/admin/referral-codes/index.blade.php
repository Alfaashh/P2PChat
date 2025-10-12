<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                Kelola Kode Referral
            </h2>
            <a href="{{ route('admin.referral-codes.create') }}" class="px-4 py-2 btn-gradient text-white rounded-lg transition">
                + Buat Kode Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden sm:rounded-xl">
                <div class="p-6 text-gray-100">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-emerald-900/30 text-emerald-300 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-white/10">
                            <thead class="bg-slate-800/60">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Penggunaan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Batas Maks</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kadaluarsa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse ($referralCodes as $code)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono font-bold text-lg text-white">{{ $code->code }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($code->is_active && $code->isValid())
                                                <span class="px-2 py-1 text-xs font-semibold text-emerald-300 bg-emerald-900/30 rounded-full">Aktif</span>
                                            @elseif(!$code->is_active)
                                                <span class="px-2 py-1 text-xs font-semibold text-gray-300 bg-white/10 rounded-full">Nonaktif</span>
                                            @elseif($code->expires_at && $code->expires_at->isPast())
                                                <span class="px-2 py-1 text-xs font-semibold text-orange-300 bg-orange-900/30 rounded-full">Expired</span>
                                            @elseif($code->max_uses && $code->used_count >= $code->max_uses)
                                                <span class="px-2 py-1 text-xs font-semibold text-red-300 bg-red-900/30 rounded-full">Penuh</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                            {{ $code->used_count }} pengguna
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                            {{ $code->max_uses ?? 'Unlimited' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                            {{ $code->expires_at ? $code->expires_at->format('d M Y') : 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.referral-codes.edit', $code) }}" class="text-indigo-300 hover:text-indigo-200">Edit</a>

                                                <form action="{{ route('admin.referral-codes.toggle', $code) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-300 hover:text-yellow-200">
                                                        {{ $code->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.referral-codes.destroy', $code) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-300 hover:text-red-200">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                                            Belum ada kode referral. <a href="{{ route('admin.referral-codes.create') }}" class="text-indigo-300 hover:underline">Buat kode baru</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $referralCodes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
