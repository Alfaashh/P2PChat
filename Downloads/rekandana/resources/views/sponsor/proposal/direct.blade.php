<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Proposal Langsung untuk {{ auth()->user()->company_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg p-6 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Proposal Langsung</h3>
                        <p class="text-blue-100">Proposal yang dikirim khusus untuk perusahaan Anda</p>
                    </div>
                    <div class="text-right">
                        <div class="text-3xl font-bold">{{ $directProposals->count() }}</div>
                        <div class="text-blue-100 text-sm">Total Proposal</div>
                    </div>
                </div>
            </div>

            <!-- Filters and Search -->
            <div class="glass-card neon-border overflow-hidden sm:rounded-xl mb-6">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="search-proposals" 
                                       class="w-full px-4 py-3 pl-10 input-dark rounded-lg" 
                                       placeholder="Cari berdasarkan judul, nama mahasiswa, atau universitas...">
                                <svg class="w-5 h-5 text-gray-300 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Filters -->
                        <div class="flex gap-3">
                            <select id="status-filter" class="px-4 py-3 select-dark rounded-lg">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu Review</option>
                                <option value="reviewed">Sudah Direview</option>
                                <option value="interested">Tertarik</option>
                                <option value="not_interested">Tidak Tertarik</option>
                            </select>
                            
                            <select id="category-filter" class="px-4 py-3 select-dark rounded-lg">
                                <option value="">Semua Kategori</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            
                            <button id="clear-filters" class="px-4 py-3 btn-ghost rounded-lg transition-colors duration-200">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Proposals List -->
            <div class="space-y-4">
                @forelse($directProposals as $invitation)
                    @if($invitation->proposal && $invitation->proposal->user)
                        <div class="relative proposal-card"
                             x-data="{ expanded: false }"
                             data-proposal-id="{{ $invitation->proposal->id }}"
                             data-status="{{ $invitation->status ?? 'pending' }}"
                             data-category="{{ $invitation->proposal->kategori }}"
                             data-title="{{ strtolower($invitation->proposal->title) }}"
                             data-student="{{ strtolower($invitation->proposal->user->name) }}"
                             data-university="{{ strtolower($invitation->proposal->user->university ?? '') }}">

                            <!-- Main Card -->
                            <div class="glass-card overflow-hidden sm:rounded-xl neon-border hover:shadow-lg transition-all duration-200">
                                <!-- Card Content (Always Visible) -->
                                <div class="p-6">
                                    <div class="flex items-center justify-between">
                                        <!-- Left: Title & Submitter -->
                                        <div class="flex-1">
                                            <div class="flex items-center gap-3 mb-2">
                                                @php
                                                    $status = $invitation->status ?? 'pending';
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-900/30 text-yellow-300',
                                                        'reviewed' => 'bg-blue-900/30 text-blue-300',
                                                        'interested' => 'bg-emerald-900/30 text-emerald-300',
                                                        'not_interested' => 'bg-red-900/30 text-red-300'
                                                    ];
                                                    $statusLabels = [
                                                        'pending' => 'Menunggu Review',
                                                        'reviewed' => 'Sudah Direview',
                                                        'interested' => 'Tertarik',
                                                        'not_interested' => 'Tidak Tertarik'
                                                    ];
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $statusColors[$status] }}">
                                                    {{ $statusLabels[$status] }}
                                                </span>
                                                <span class="text-xs text-gray-400">
                                                    Dikirim {{ $invitation->created_at->diffForHumans() }}
                                                </span>
                                            </div>

                                            <h3 class="text-xl font-bold text-white mb-2">
                                                {{ $invitation->proposal->title }}
                                            </h3>

                                            <div class="flex items-center text-gray-300">
                                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-2">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <p class="font-medium text-white">{{ $invitation->proposal->user->name }}</p>
                                                    <p class="text-sm text-gray-400">{{ $invitation->proposal->user->university ?? 'Universitas tidak tersedia' }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Right: Action Buttons -->
                                        <div class="flex gap-2 ml-6">
                                            @if(($invitation->status ?? 'pending') === 'pending')
                                                <button class="mark-interested px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-lg hover:bg-green-700 transition-colors duration-200"
                                                        data-invitation-id="{{ $invitation->id }}"
                                                        data-proposal-id="{{ $invitation->proposal->id }}">
                                                    Simpan
                                                </button>
                                                <button class="mark-rejected px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded-lg hover:bg-red-700 transition-colors duration-200"
                                                        data-invitation-id="{{ $invitation->id }}">
                                                    Tolak
                                                </button>
                                            @elseif(($invitation->status ?? '') === 'interested')
                                                <a href="{{ route('sponsor.deals.initiate', $invitation->proposal->id) }}"
                                                   class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-sm font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Mulai Deal
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Bottom Strip with Arrow (Toggle Button) -->
                                <div class="relative -mt-2">
                                    <button @click="expanded = !expanded"
                                            class="w-full py-3 bg-gradient-to-b from-white/5 to-white/10 hover:from-white/10 hover:to-white/15 transition-all duration-200 flex items-center justify-center rounded-b-xl border-t border-white/10">
                                        <svg class="w-5 h-5 text-gray-300 transition-transform duration-300"
                                             :class="{ 'rotate-180': expanded }"
                                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <!-- Expandable Detail Section -->
                            <div x-show="expanded"
                                 x-collapse
                                 class="border-t border-white/10 bg-white/5">
                                <div class="p-6 space-y-6">
                                    <!-- Info Cards Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        @if($invitation->proposal->kategori)
                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-xs text-gray-400 mb-1">Kategori</p>
                                            <p class="text-sm font-semibold text-white">{{ $invitation->proposal->kategori }}</p>
                                        </div>
                                        @endif

                                        @if($invitation->proposal->bidang)
                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-xs text-gray-400 mb-1">Bidang</p>
                                            <p class="text-sm font-semibold text-white">{{ $invitation->proposal->bidang }}</p>
                                        </div>
                                        @endif

                                        @if($invitation->proposal->penyelenggara)
                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-xs text-gray-400 mb-1">Penyelenggara</p>
                                            <p class="text-sm font-semibold text-white">{{ $invitation->proposal->penyelenggara }}</p>
                                        </div>
                                        @endif

                                        @if($invitation->proposal->tanggal_acara)
                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-xs text-gray-400 mb-1">Tanggal Acara</p>
                                            <p class="text-sm font-semibold text-white">{{ \Carbon\Carbon::parse($invitation->proposal->tanggal_acara)->format('d F Y') }}</p>
                                        </div>
                                        @endif

                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-xs text-gray-400 mb-1">Status Proposal</p>
                                            <p class="text-sm font-semibold text-white capitalize">
                                                <span class="px-2 py-1 rounded-full text-xs
                                                    @if($invitation->proposal->status == 'approved') bg-green-500/20 text-green-300
                                                    @elseif($invitation->proposal->status == 'pending') bg-yellow-500/20 text-yellow-300
                                                    @elseif($invitation->proposal->status == 'rejected') bg-red-500/20 text-red-300
                                                    @else bg-gray-500/20 text-gray-300
                                                    @endif">
                                                    {{ $invitation->proposal->status }}
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div>
                                        <h4 class="text-lg font-bold text-white mb-3">Deskripsi Proposal</h4>
                                        <div class="bg-white/5 p-4 rounded-lg border border-white/10">
                                            <p class="text-gray-300 text-sm whitespace-pre-line">{{ $invitation->proposal->description }}</p>
                                        </div>
                                    </div>

                                    <!-- Funding Goal -->
                                    <div class="bg-gradient-to-r from-indigo-900/30 to-purple-900/30 p-6 rounded-lg border border-indigo-500/30">
                                        <p class="text-sm font-bold text-indigo-300 mb-2">Target Pendanaan</p>
                                        <p class="text-3xl font-extrabold text-white">Rp {{ number_format($invitation->proposal->funding_goal, 0, ',', '.') }}</p>
                                    </div>

                                    <!-- Download Button -->
                                    @if($invitation->proposal->file_path)
                                    <div>
                                        <a href="{{ asset('storage/' . $invitation->proposal->file_path) }}"
                                           target="_blank"
                                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            Unduh Dokumen Proposal Lengkap
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <!-- Empty State -->
                    <div class="glass-card overflow-hidden sm:rounded-xl">
                        <div class="p-12 text-center">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-white mb-2">Belum ada proposal langsung</h3>
                            <p class="text-gray-300 mb-6">
                                Belum ada mahasiswa yang mengirim proposal langsung ke perusahaan Anda.
                            </p>
                            <a href="{{ route('sponsor.proposals.index') }}" 
                               class="inline-flex items-center px-6 py-3 btn-gradient text-white font-semibold rounded-lg transition-colors duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Lihat Semua Proposal
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($directProposals->hasPages())
                <div class="mt-8">
                    {{ $directProposals->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-proposals');
            const statusFilter = document.getElementById('status-filter');
            const categoryFilter = document.getElementById('category-filter');
            const clearFiltersBtn = document.getElementById('clear-filters');
            const proposalCards = document.querySelectorAll('.proposal-card');

            // Filter functionality
            function filterProposals() {
                const searchTerm = searchInput.value.toLowerCase();
                const statusValue = statusFilter.value;
                const categoryValue = categoryFilter.value;

                proposalCards.forEach(card => {
                    const title = card.dataset.title;
                    const student = card.dataset.student;
                    const university = card.dataset.university;
                    const status = card.dataset.status;
                    const category = card.dataset.category;

                    const matchesSearch = !searchTerm ||
                        title.includes(searchTerm) ||
                        student.includes(searchTerm) ||
                        university.includes(searchTerm);

                    const matchesStatus = !statusValue || status === statusValue;
                    const matchesCategory = !categoryValue || category === categoryValue;

                    if (matchesSearch && matchesStatus && matchesCategory) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Event listeners for filters
            searchInput.addEventListener('input', filterProposals);
            statusFilter.addEventListener('change', filterProposals);
            categoryFilter.addEventListener('change', filterProposals);

            clearFiltersBtn.addEventListener('click', function() {
                searchInput.value = '';
                statusFilter.value = '';
                categoryFilter.value = '';
                filterProposals();
            });

            // Action buttons
            document.querySelectorAll('.mark-interested').forEach(btn => {
                btn.addEventListener('click', function() {
                    const invitationId = this.dataset.invitationId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');

                    if (!csrfToken) {
                        alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
                        return;
                    }

                    if (confirm('Apakah Anda yakin ingin menyimpan proposal ini?')) {
                        fetch(`/sponsor/proposals/direct/${invitationId}/save`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                const card = this.closest('.proposal-card');
                                const proposalId = this.dataset.proposalId;

                                // Update status badge
                                const statusBadge = card.querySelector('span[class*="bg-yellow-900/30"], span[class*="bg-blue-900/30"], span[class*="bg-emerald-900/30"], span[class*="bg-red-900/30"]');
                                if (statusBadge) {
                                    statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-900/30 text-emerald-300';
                                    statusBadge.textContent = 'Tertarik';
                                }

                                // Update data attribute
                                card.dataset.status = 'interested';

                                // Replace action buttons with "Mulai Deal" button
                                const actionButtonsContainer = this.closest('.action-buttons');
                                if (actionButtonsContainer) {
                                    const dealUrl = `/sponsor/deals/${proposalId}/initiate`;
                                    actionButtonsContainer.outerHTML = `
                                        <a href="${dealUrl}"
                                           class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white text-sm font-semibold rounded-lg hover:from-emerald-600 hover:to-teal-700 transition-all duration-200 text-center inline-block">
                                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Mulai Deal
                                        </a>
                                    `;
                                }

                                // Show toast notification
                                if (typeof showToast === 'function') {
                                    showToast(data.message || 'Proposal berhasil disimpan!', 'success');
                                }
                            } else {
                                if (typeof showToast === 'function') {
                                    showToast(data.message || 'Gagal menyimpan proposal.', 'error');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            if (typeof showToast === 'function') {
                                showToast('Terjadi kesalahan saat menyimpan proposal: ' + error.message, 'error');
                            }
                        });
                    }
                });
            });

            document.querySelectorAll('.mark-rejected').forEach(btn => {
                btn.addEventListener('click', function() {
                    const invitationId = this.dataset.invitationId;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]');

                    if (!csrfToken) {
                        alert('CSRF token tidak ditemukan. Silakan refresh halaman.');
                        return;
                    }

                    if (confirm('Apakah Anda yakin ingin menolak proposal ini? Proposal akan dihapus secara permanen dan mahasiswa akan menerima email notifikasi.')) {
                        fetch(`/sponsor/proposals/direct/${invitationId}/reject`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken.content,
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Show toast notification
                                if (typeof showToast === 'function') {
                                    showToast(data.message || 'Proposal berhasil ditolak!', 'info');
                                }
                                // Remove the card from view
                                const card = this.closest('.proposal-card');
                                card.style.transition = 'opacity 0.3s';
                                card.style.opacity = '0';
                                setTimeout(() => {
                                    card.remove();
                                    // Check if there are no more proposals
                                    if (document.querySelectorAll('.proposal-card').length === 0) {
                                        location.reload();
                                    }
                                }, 300);
                            } else {
                                if (typeof showToast === 'function') {
                                    showToast(data.message || 'Gagal menolak proposal.', 'error');
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            if (typeof showToast === 'function') {
                                showToast('Terjadi kesalahan saat menolak proposal: ' + error.message, 'error');
                            }
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>
