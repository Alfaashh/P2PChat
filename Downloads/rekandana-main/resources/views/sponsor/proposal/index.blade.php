<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Cari Proposal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filter Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Cari & Filter Proposal</h3>
                    </div>
                    
                    <form action="{{ route('sponsor.proposals.search') }}" method="GET" id="filter-form">
                        <!-- Search Bar -->
                        <div class="mb-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="flex-1">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200" 
                                           placeholder="Cari berdasarkan judul, deskripsi, kategori, bidang, atau penyelenggara...">
                                </div>
                                <button type="submit" 
                                        class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>

                        <!-- Filter Section -->
                        <div class="border-t border-gray-200 pt-6">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-md font-semibold text-gray-700 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                    </svg>
                                    Filter & Urutkan
                                </h4>
                                <button type="button" id="toggle-filters" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors duration-200">
                                    <span id="filter-toggle-text">Tampilkan Filter</span>
                                    <svg id="filter-toggle-icon" class="w-4 h-4 ml-1 inline transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                            </div>

                            <div id="filter-section" class="hidden">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                    <!-- Sort Filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                                        <select name="sort" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                                            <option value="tanggal_acara_terdekat" {{ request('sort') == 'tanggal_acara_terdekat' ? 'selected' : '' }}>Acara Terdekat</option>
                                            <option value="tanggal_acara_terjauh" {{ request('sort') == 'tanggal_acara_terjauh' ? 'selected' : '' }}>Acara Terjauh</option>
                                            <option value="funding_tertinggi" {{ request('sort') == 'funding_tertinggi' ? 'selected' : '' }}>Dana Tertinggi</option>
                                            <option value="funding_terendah" {{ request('sort') == 'funding_terendah' ? 'selected' : '' }}>Dana Terendah</option>
                                            <option value="alfabetis" {{ request('sort') == 'alfabetis' ? 'selected' : '' }}>A-Z</option>
                                        </select>
                                    </div>

                                    <!-- Category Filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                                        <select name="kategori" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Semua Kategori</option>
                                            @if(isset($categories))
                                                @foreach($categories as $category)
                                                    <option value="{{ $category }}" {{ request('kategori') == $category ? 'selected' : '' }}>
                                                        {{ $category }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="Teknologi" {{ request('kategori') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                                <option value="Pendidikan" {{ request('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                                                <option value="Kesehatan" {{ request('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                                <option value="Lingkungan" {{ request('kategori') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                                <option value="Sosial" {{ request('kategori') == 'Sosial' ? 'selected' : '' }}>Sosial</option>
                                                <option value="Lainnya" {{ request('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Field Filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Bidang</label>
                                        <select name="bidang" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Semua Bidang</option>
                                            @if(isset($fields))
                                                @foreach($fields as $field)
                                                    <option value="{{ $field }}" {{ request('bidang') == $field ? 'selected' : '' }}>
                                                        {{ $field }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="AI & Machine Learning" {{ request('bidang') == 'AI & Machine Learning' ? 'selected' : '' }}>AI & Machine Learning</option>
                                                <option value="Web Development" {{ request('bidang') == 'Web Development' ? 'selected' : '' }}>Web Development</option>
                                                <option value="Mobile Development" {{ request('bidang') == 'Mobile Development' ? 'selected' : '' }}>Mobile Development</option>
                                                <option value="Data Science" {{ request('bidang') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                                <option value="Cybersecurity" {{ request('bidang') == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                                                <option value="IoT" {{ request('bidang') == 'IoT' ? 'selected' : '' }}>IoT</option>
                                            @endif
                                        </select>
                                    </div>

                                    <!-- Event Date Filter -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Waktu Acara</label>
                                        <select name="tanggal_acara" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Semua Waktu</option>
                                            <option value="minggu_ini" {{ request('tanggal_acara') == 'minggu_ini' ? 'selected' : '' }}>Minggu Ini</option>
                                            <option value="bulan_ini" {{ request('tanggal_acara') == 'bulan_ini' ? 'selected' : '' }}>Bulan Ini</option>
                                            <option value="bulan_depan" {{ request('tanggal_acara') == 'bulan_depan' ? 'selected' : '' }}>Bulan Depan</option>
                                            <option value="tahun_ini" {{ request('tanggal_acara') == 'tahun_ini' ? 'selected' : '' }}>Tahun Ini</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Funding Range Filter -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Dana Minimum (Rp)</label>
                                        <input type="number" 
                                               name="funding_min" 
                                               value="{{ request('funding_min') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                               placeholder="0"
                                               min="0">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Dana Maksimum (Rp)</label>
                                        <input type="number" 
                                               name="funding_max" 
                                               value="{{ request('funding_max') }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                               placeholder="100000000"
                                               min="0">
                                    </div>
                                </div>

                                <!-- Filter Actions -->
                                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                                    <button type="submit" class="flex-1 sm:flex-none px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z"></path>
                                        </svg>
                                        Terapkan Filter
                                    </button>
                                    <a href="{{ route('sponsor.proposals.index') }}" 
                                       class="flex-1 sm:flex-none px-6 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Reset Filter
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    <!-- Active Filters Display -->
                    @if(request()->hasAny(['search', 'kategori', 'bidang', 'tanggal_acara', 'funding_min', 'funding_max', 'sort']))
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="text-sm font-medium text-gray-700">Filter aktif:</span>
                                
                                @if(request('search'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Pencarian: "{{ request('search') }}"
                                        <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="ml-2 hover:text-blue-600">×</a>
                                    </span>
                                @endif
                                
                                @if(request('kategori'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Kategori: {{ request('kategori') }}
                                        <a href="{{ request()->fullUrlWithQuery(['kategori' => null]) }}" class="ml-2 hover:text-green-600">×</a>
                                    </span>
                                @endif
                                
                                @if(request('bidang'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        Bidang: {{ request('bidang') }}
                                        <a href="{{ request()->fullUrlWithQuery(['bidang' => null]) }}" class="ml-2 hover:text-purple-600">×</a>
                                    </span>
                                @endif
                                
                                @if(request('tanggal_acara'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        Waktu: {{ ucfirst(str_replace('_', ' ', request('tanggal_acara'))) }}
                                        <a href="{{ request()->fullUrlWithQuery(['tanggal_acara' => null]) }}" class="ml-2 hover:text-yellow-600">×</a>
                                    </span>
                                @endif
                                
                                @if(request('funding_min') || request('funding_max'))
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Dana: 
                                        @if(request('funding_min'))Rp {{ number_format(request('funding_min')) }}@endif
                                        @if(request('funding_min') && request('funding_max')) - @endif
                                        @if(request('funding_max'))Rp {{ number_format(request('funding_max')) }}@endif
                                        <a href="{{ request()->fullUrlWithQuery(['funding_min' => null, 'funding_max' => null]) }}" class="ml-2 hover:text-red-600">×</a>
                                    </span>
                                @endif
                                
                                @if(request('sort') && request('sort') != 'terbaru')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        Urutan: {{ ucfirst(str_replace('_', ' ', request('sort'))) }}
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="ml-2 hover:text-indigo-600">×</a>
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Results Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Results Header -->
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-800">
                                @if(request()->hasAny(['search', 'kategori', 'bidang', 'tanggal_acara', 'funding_min', 'funding_max']))
                                    Hasil Filter ({{ $proposals->total() }} proposal)
                                @else
                                    Semua Proposal Tersedia ({{ $proposals->total() }} proposal)
                                @endif
                            </h3>
                        </div>
                        
                        @if($proposals->count() > 0)
                            <div class="text-sm text-gray-500">
                                Menampilkan {{ $proposals->firstItem() }}-{{ $proposals->lastItem() }} dari {{ $proposals->total() }} proposal
                            </div>
                        @endif
                    </div>

                    <!-- Proposals Grid -->
                    @if($proposals->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($proposals as $proposal)
                                <x-proposal-card :proposal="$proposal" />
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $proposals->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            @if(request()->hasAny(['search', 'kategori', 'bidang', 'tanggal_acara', 'funding_min', 'funding_max']))
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada proposal ditemukan</h3>
                                <p class="text-gray-600 mb-4">
                                    Tidak ada proposal yang cocok dengan filter yang Anda pilih.
                                </p>
                                <div class="space-y-2">
                                    <p class="text-sm text-gray-500">Coba ubah filter atau:</p>
                                    <a href="{{ route('sponsor.proposals.index') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                        Lihat Semua Proposal
                                    </a>
                                </div>
                            @else
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">Belum ada proposal tersedia</h3>
                                <p class="text-gray-600">
                                    Saat ini belum ada proposal yang tersedia untuk dilihat.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleFiltersBtn = document.getElementById('toggle-filters');
            const filterSection = document.getElementById('filter-section');
            const filterToggleText = document.getElementById('filter-toggle-text');
            const filterToggleIcon = document.getElementById('filter-toggle-icon');
            const filterForm = document.getElementById('filter-form');

            // Toggle filter section
            toggleFiltersBtn.addEventListener('click', function() {
                const isHidden = filterSection.classList.contains('hidden');
                
                if (isHidden) {
                    filterSection.classList.remove('hidden');
                    filterToggleText.textContent = 'Sembunyikan Filter';
                    filterToggleIcon.style.transform = 'rotate(180deg)';
                } else {
                    filterSection.classList.add('hidden');
                    filterToggleText.textContent = 'Tampilkan Filter';
                    filterToggleIcon.style.transform = 'rotate(0deg)';
                }
            });

            // Show filters if any filter is active
            const hasActiveFilters = {{ request()->hasAny(['kategori', 'bidang', 'tanggal_acara', 'funding_min', 'funding_max', 'sort']) ? 'true' : 'false' }};
            if (hasActiveFilters) {
                filterSection.classList.remove('hidden');
                filterToggleText.textContent = 'Sembunyikan Filter';
                filterToggleIcon.style.transform = 'rotate(180deg)';
            }

            // Auto-submit form when filter changes
            const filterInputs = filterForm.querySelectorAll('select[name="sort"], select[name="kategori"], select[name="bidang"], select[name="tanggal_acara"]');
            filterInputs.forEach(input => {
                input.addEventListener('change', function() {
                    filterForm.submit();
                });
            });

            // Format number inputs
            const numberInputs = filterForm.querySelectorAll('input[type="number"]');
            numberInputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value) {
                        // Optional: Format number with thousands separator
                        const value = parseInt(this.value);
                        if (!isNaN(value)) {
                            this.setAttribute('data-value', value);
                        }
                    }
                });
            });
        });
    </script>
</x-app-layout>