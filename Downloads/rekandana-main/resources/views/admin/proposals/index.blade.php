<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Moderasi Proposal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Proposal Menunggu Persetujuan</h3>

                    <!-- Menampilkan pesan sukses -->
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="space-y-4">
                        @forelse ($pendingProposals as $proposal)
                            <div x-data="{ modalOpen : false }" class="border p-4 rounded-lg flex flex-col sm:flex-row justify-between sm:items-center">
                                <!-- Info Proposal -->
                                <div class="mb-4 sm:mb-0">
                                    <p class="font-bold text-lg">{{ $proposal->title }}</p>
                                    <p class="text-sm text-gray-600">Oleh: {{ $proposal->user->name }} ({{ $proposal->user->university }})</p>
                                    <button @click="modalOpen = true" class="rounded-sm block text-sm mt-2 hover:underline text-blue-500">
                                        Lihat Detail
                                    </button>
                                </div>
                                
                                <!-- Tombol Aksi -->
                                <div class="flex gap-2 flex-shrink-0">
                                    <form action="{{ route('admin.proposals.approve', $proposal) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-3 py-2 bg-green-500 text-white text-sm font-semibold rounded hover:bg-green-600 w-full sm:w-auto">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.proposals.reject', $proposal) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="px-3 py-2 bg-red-500 text-white text-sm font-semibold rounded hover:bg-red-600 w-full sm:w-auto">Reject</button>
                                    </form>
                                </div>

                                <div x-show="modalOpen" 
                                     style="display:none;" 
                                     x-on:keydown.escape.window="modalOpen = false"
                                     class="fixed inset-0 z-50 flex items-center justify-center p-4">

                                     <!-- Background Gelap (Overlay) -->
                                     <div x-show="modalOpen" x.transition.opacity @click="modalOpen = false" class="fixed inset-0 bg-black bg-opacity-50"></div>
                                     
                                     <!-- Konten Popup -->
                                     <div x-show="modalOpen" x-transition
                                          @click.outside="modalOpen = false"
                                          class="relative bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden">

                                          <!-- Modal Header -->
                                          <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                                              <div class="flex items-center justify-between">
                                                  <h2 class="text-xl font-bold text-white text-center w-full">{{ $proposal->title }}</h2>
                                                  <button @click="modalOpen = false" 
                                                          class="text-white hover:text-gray-200 transition-colors duration-200">
                                                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                      </svg>
                                                  </button>
                                              </div>
                                          </div>

                                          <!-- Modal Body -->
                                          <div class="p-6 overflow-y-auto max-h-[calc(90vh-120px)]">
                                              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                                  
                                                  <!-- Left Column - Basic Info -->
                                                  <div class="space-y-4">
                                                      <div class="bg-gray-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                              </svg>
                                                              Informasi Pengaju
                                                          </h3>
                                                          <div class="space-y-2">
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Nama:</span>
                                                                  <span class="font-medium">{{ $proposal->user->name }}</span>
                                                              </div>
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Universitas:</span>
                                                                  <span class="font-medium">{{ $proposal->user->university }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="bg-gray-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                              </svg>
                                                              Kategori & Bidang
                                                          </h3>
                                                          <div class="space-y-2">
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Kategori:</span>
                                                                  <span class="font-medium">{{ $proposal->kategori }}</span>
                                                              </div>
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Bidang:</span>
                                                                  <span class="font-medium">{{ $proposal->bidang }}</span>
                                                              </div>
                                                          </div>
                                                      </div>

                                                      <div class="bg-gray-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                              </svg>
                                                              Detail Acara
                                                          </h3>
                                                          <div class="space-y-2">
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Tanggal:</span>
                                                                  <span class="font-medium">{{ $proposal->tanggal_acara }}</span>
                                                              </div>
                                                              <div class="flex justify-between">
                                                                  <span class="text-gray-600">Penyelenggara:</span>
                                                                  <span class="font-medium">{{ $proposal->penyelenggara }}</span>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>

                                                  <!-- Right Column - Description & Funding -->
                                                  <div class="space-y-4">
                                                      <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                              </svg>
                                                              Deskripsi Proposal
                                                          </h3>
                                                          <p class="text-gray-700 leading-relaxed">{{ $proposal->description }}</p>
                                                      </div>

                                                      <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                                              </svg>
                                                              Target Pendanaan
                                                          </h3>
                                                          <div class="text-center">
                                                              <span class="text-2xl font-bold text-green-600">Rp {{ number_format($proposal->funding_goal) }}</span>
                                                          </div>
                                                      </div>

                                                      <div class="bg-gray-50 rounded-lg p-4">
                                                          <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                              <svg class="w-5 h-5 mr-2 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                                              </svg>
                                                              Link Sosial Media
                                                          </h3>
                                                          @php
                                                              $socialLink = $proposal->link_sosmed;
                                                              // Pastikan URL memiliki protocol
                                                              if (!empty($socialLink) && !str_starts_with($socialLink, 'http://') && !str_starts_with($socialLink, 'https://')) {
                                                                  $socialLink = 'https://' . $socialLink;
                                                              }
                                                          @endphp
                                                          @if(!empty($socialLink))
                                                              <a href="{{ $socialLink }}" 
                                                                 target="_blank" 
                                                                 rel="noopener noreferrer"
                                                                 class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors duration-200">
                                                                  <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                                  </svg>
                                                                  {{ $proposal->link_sosmed }}
                                                              </a>
                                                          @else
                                                              <span class="text-gray-500 italic">Tidak ada link sosial media</span>
                                                          @endif
                                                      </div>
                                                  </div>
                                              </div>

                                              <!-- Document Section -->
                                              <div class="mt-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg p-4">
                                                  <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                                      <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                      </svg>
                                                      Dokumen Proposal
                                                  </h3>
                                                  <a href="{{ asset('storage/' . $proposal->file_path) }}" 
                                                     target="_blank" 
                                                     class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors duration-200">
                                                      <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                      </svg>
                                                      Lihat Dokumen Proposal
                                                  </a>
                                              </div>
                                          </div>
                                     </div>
                                </div>

                            </div>
                        @empty
                            <p class="text-gray-500">Tidak ada proposal yang menunggu persetujuan saat ini.</p>
                        @endforelse
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>