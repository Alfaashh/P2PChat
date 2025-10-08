<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Kode Referral
            </h2>
            <a href="{{ route('admin.referral-codes.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Buat Kode Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penggunaan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batas Maks</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kadaluarsa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($referralCodes as $code)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-mono font-bold text-lg">{{ $code->code }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($code->is_active && $code->isValid())
                                                <span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Aktif</span>
                                            @elseif(!$code->is_active)
                                                <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">Nonaktif</span>
                                            @elseif($code->expires_at && $code->expires_at->isPast())
                                                <span class="px-2 py-1 text-xs font-semibold text-orange-800 bg-orange-100 rounded-full">Expired</span>
                                            @elseif($code->max_uses && $code->used_count >= $code->max_uses)
                                                <span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Penuh</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $code->used_count }} pengguna
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $code->max_uses ?? 'Unlimited' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $code->expires_at ? $code->expires_at->format('d M Y') : 'Tidak ada' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.referral-codes.edit', $code) }}" class="text-blue-600 hover:text-blue-900">Edit</a>

                                                <form action="{{ route('admin.referral-codes.toggle', $code) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-yellow-600 hover:text-yellow-900">
                                                        {{ $code->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.referral-codes.destroy', $code) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kode ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada kode referral. <a href="{{ route('admin.referral-codes.create') }}" class="text-blue-600 hover:underline">Buat kode baru</a>
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
