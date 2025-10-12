<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Proposal Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Quota Info Card -->
            <div class="mb-6 glass-card neon-border overflow-hidden sm:rounded-xl">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-white mb-2">Kuota Direct Proposal</h3>
                            <p class="text-sm text-gray-300">
                                Sisa kuota untuk mengirim proposal langsung ke perusahaan tertentu
                            </p>
                        </div>
                        <div class="text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full {{ auth()->user()->direct_proposal_quota > 0 ? 'bg-blue-900/30 border-2 border-blue-500' : 'bg-red-900/30 border-2 border-red-500' }}">
                                <span class="text-3xl font-bold {{ auth()->user()->direct_proposal_quota > 0 ? 'text-blue-300' : 'text-red-300' }}">
                                    {{ auth()->user()->direct_proposal_quota }}
                                </span>
                            </div>
                            @if(auth()->user()->direct_proposal_quota <= 0)
                                <p class="mt-2 text-xs text-gray-400">
                                    💡 Premium coming soon!
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card neon-border overflow-hidden sm:rounded-xl">
                <div class="p-6 text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Daftar Proposal yang Telah Diajukan</h3>

                     <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-slate-800/50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Judul Proposal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal Diajukan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/10">
                                @forelse (auth()->user()->proposals()->latest()->get() as $proposal)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-100">{{ $proposal->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $proposal->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($proposal->status == 'approved')
                                                @if($proposal->deals->isnotEmpty())
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-900/30 text-cyan-300">
                                                        Ada Tawaran
                                                    </span>
                                                @else
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-900/30 text-emerald-300">
                                                        Disetujui oleh Admin
                                                    </span>
                                                @endif
                                            @elseif($proposal->status == 'rejected')
                                                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900/30 text-red-300">
                                                    Ditolak oleh Admin
                                                </span>
                                            @else
                                                 <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-900/30 text-yellow-300">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-400">Kamu belum mengajukan proposal apapun.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
