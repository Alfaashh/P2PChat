<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <!-- Search -->
                        <div class="flex-1">
                            <div class="relative">
                                <input type="text" id="search-proposals" 
                                       class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                       placeholder="Cari berdasarkan judul, nama mahasiswa, atau universitas...">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Filters -->
                        <div class="flex gap-3">
                            <select id="status-filter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Status</option>
                                <option value="pending">Menunggu Review</option>
                                <option value="reviewed">Sudah Direview</option>
                                <option value="interested">Tertarik</option>
                                <option value="not_interested">Tidak Tertarik</option>
                            </select>
                            
                            <select id="category-filter" class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Semua Kategori</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Pendidikan">Pendidikan</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            
                            <button id="clear-filters" class="px-4 py-3 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
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
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition-shadow duration-200 proposal-card" 
                             data-proposal-id="{{ $invitation->proposal->id }}"
                             data-status="{{ $invitation->status ?? 'pending' }}"
                             data-category="{{ $invitation->proposal->kategori }}"
                             data-title="{{ strtolower($invitation->proposal->title) }}"
                             data-student="{{ strtolower($invitation->proposal->user->name) }}"
                             data-university="{{ strtolower($invitation->proposal->user->university ?? '') }}">
                            
                            <div class="p-6">
                                <div class="flex items-start justify-between">
                                    <!-- Left Content -->
                                    <div class="flex-1">
                                        <div class="flex items-start space-x-4">
                                            <!-- Status Badge -->
                                            <div class="flex-shrink-0">
                                                @php
                                                    $status = $invitation->status ?? 'pending';
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'reviewed' => 'bg-blue-100 text-blue-800',
                                                        'interested' => 'bg-green-100 text-green-800',
                                                        'not_interested' => 'bg-red-100 text-red-800'
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
                                            </div>
                                            
                                            <!-- Proposal Info -->
                                            <div class="flex-1">
                                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                    <a href="#" class="hover:text-blue-600 transition-colors duration-200 view-proposal-detail" 
                                                       data-proposal-id="{{ $invitation->proposal->id }}">
                                                        {{ $invitation->proposal->title }}
                                                    </a>
                                                </h3>
                                                
                                                <!-- Student Info -->
                                                <div class="flex items-center mb-3">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mr-3">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-800">{{ $invitation->proposal->user->name }}</p>
                                                        <p class="text-sm text-gray-600">{{ $invitation->proposal->user->university ?? 'Universitas tidak tersedia' }}</p>
                                                    </div>
                                                </div>
                                                
                                                <!-- Tags -->
                                                <div class="flex flex-wrap gap-2 mb-3">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                        {{ $invitation->proposal->kategori }}
                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        {{ $invitation->proposal->bidang }}
                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                        {{ $invitation->proposal->tanggal_acara }}
                                                    </span>
                                                </div>
                                                
                                                <!-- Description -->
                                                <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                                                    {{ $invitation->proposal->description }}
                                                </p>
                                                
                                                <!-- Funding Goal -->
                                                <div class="flex items-center text-sm">
                                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                    </svg>
                                                    <span class="font-semibold text-green-600">
                                                        Rp {{ number_format($invitation->proposal->funding_goal, 0, ',', '.') }}
                                                    </span>
                                                    <span class="text-gray-500 ml-2">•</span>
                                                    <span class="text-gray-500 ml-2">
                                                        Dikirim {{ $invitation->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Right Actions -->
                                    <div class="flex flex-col space-y-2 ml-6">
                                        <button class="view-proposal-detail px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200"
                                                data-proposal-id="{{ $invitation->proposal->id }}">
                                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail
                                        </button>
                                        
                                        @if(($invitation->status ?? 'pending') === 'pending')
                                            <div class="flex space-x-2">
                                                <button class="mark-interested px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded hover:bg-green-700 transition-colors duration-200"
                                                        data-invitation-id="{{ $invitation->id }}">
                                                    Tertarik
                                                </button>
                                                <button class="mark-not-interested px-3 py-1 bg-red-600 text-white text-xs font-semibold rounded hover:bg-red-700 transition-colors duration-200"
                                                        data-invitation-id="{{ $invitation->id }}">
                                                    Tidak
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <!-- Empty State -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-12 text-center">
                            <svg class="w-24 h-24 text-gray-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada proposal langsung</h3>
                            <p class="text-gray-600 mb-6">
                                Belum ada mahasiswa yang mengirim proposal langsung ke perusahaan Anda.
                            </p>
                            <a href="{{ route('sponsor.proposals.index') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
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

    <!-- Proposal Detail Modal -->
    <div id="proposal-modal" class="fixed inset-0 z-50 hidden">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-white" id="modal-title">Detail Proposal</h2>
                        <button id="close-modal" class="text-white hover:text-gray-200 transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Modal Body -->
                <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]" id="modal-content">
                    <!-- Content will be populated by JavaScript -->
                </div>

                <!-- Modal Footer -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <div class="text-sm text-gray-600">
                            <span id="modal-status"></span>
                        </div>
                        <div class="flex space-x-3">
                            <button id="modal-close-btn" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                Tutup
                            </button>
                            <button id="modal-interested-btn" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200" style="display: none;">
                                Tandai Tertarik
                            </button>
                            <button id="modal-not-interested-btn" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200" style="display: none;">
                                Tandai Tidak Tertarik
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-proposals');
            const statusFilter = document.getElementById('status-filter');
            const categoryFilter = document.getElementById('category-filter');
            const clearFiltersBtn = document.getElementById('clear-filters');
            const proposalCards = document.querySelectorAll('.proposal-card');
            const proposalModal = document.getElementById('proposal-modal');
            const modalContent = document.getElementById('modal-content');
            const modalTitle = document.getElementById('modal-title');
            const modalStatus = document.getElementById('modal-status');
            const closeModalBtn = document.getElementById('close-modal');
            const modalCloseBtn = document.getElementById('modal-close-btn');

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

            // Modal functionality
            function openModal(proposalId) {
                modalTitle.textContent = 'Detail Proposal';
                modalContent.innerHTML = `
                    <div class="text-center py-8">
                        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                        <p class="text-gray-600">Memuat detail proposal...</p>
                    </div>
                `;
                proposalModal.classList.remove('hidden');
                
                // Simulate loading and show content
                setTimeout(() => {
                    modalContent.innerHTML = `
                        <div class="space-y-6">
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Mahasiswa</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm text-gray-600">Nama</p>
                                        <p class="font-medium">Proposal ID: ${proposalId}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600">Universitas</p>
                                        <p class="font-medium">Data akan dimuat dari database</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">Detail Proposal</h3>
                                <p class="text-gray-700">Detail lengkap proposal akan ditampilkan di sini.</p>
                            </div>
                        </div>
                    `;
                }, 1000);
            }

            // Event listeners for modal
            document.querySelectorAll('.view-proposal-detail').forEach(btn => {
                btn.addEventListener('click', function() {
                    const proposalId = this.dataset.proposalId;
                    openModal(proposalId);
                });
            });

            closeModalBtn.addEventListener('click', function() {
                proposalModal.classList.add('hidden');
            });

            modalCloseBtn.addEventListener('click', function() {
                proposalModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            proposalModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    proposalModal.classList.add('hidden');
                }
            });

            // Action buttons
            document.querySelectorAll('.mark-interested').forEach(btn => {
                btn.addEventListener('click', function() {
                    const invitationId = this.dataset.invitationId;
                    alert('Proposal ditandai sebagai tertarik!');
                    const statusBadge = this.closest('.proposal-card').querySelector('.bg-yellow-100, .bg-blue-100, .bg-green-100, .bg-red-100');
                    if (statusBadge) {
                        statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800';
                        statusBadge.textContent = 'Tertarik';
                    }
                    this.parentElement.style.display = 'none';
                });
            });

            document.querySelectorAll('.mark-not-interested').forEach(btn => {
                btn.addEventListener('click', function() {
                    const invitationId = this.dataset.invitationId;
                    // Here you would send a request to mark as not interested
                    alert('Proposal ditandai sebagai tidak tertarik.');
                    // Update UI
                    const statusBadge = this.closest('.proposal-card').querySelector('.bg-yellow-100, .bg-blue-100, .bg-green-100, .bg-red-100');
                    if (statusBadge) {
                        statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800';
                        statusBadge.textContent = 'Tidak Tertarik';
                    }
                    this.parentElement.style.display = 'none';
                });
            });
        });
    </script>
</x-app-layout>