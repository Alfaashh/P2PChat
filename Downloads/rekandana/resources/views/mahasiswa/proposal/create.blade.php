<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Ajukan Proposal Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden sm:rounded-xl">
                <div class="p-6 md:p-8 text-gray-100">
                    <form action="{{ route('mahasiswa.proposals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul Proposal/Acara" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" />
                            <select name="kategori" id="kategori" class="mt-1 block w-full select-dark rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Seminar" {{ old('kategori') == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option value="Workshop" {{ old('kategori') == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                                <option value="Lomba" {{ old('kategori') == 'Lomba' ? 'selected' : '' }}>Lomba</option>
                                <option value="Pengabdian Masyarakat" {{ old('kategori') == 'Pengabdian Masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
                                <option value="Penelitian" {{ old('kategori') == 'Penelitian' ? 'selected' : '' }}>Penelitian</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('kategori')" />
                        </div>

                        <div>
                            <x-input-label for="bidang" value="Bidang" />
                            <select name="bidang" id="bidang" class="mt-1 block w-full select-dark rounded-md shadow-sm" required>
                                <option value="">-- Pilih Bidang --</option>
                                <option value="Teknologi" {{ old('bidang') == 'Teknologi' ? 'selected' : '' }}>Teknologi</option>
                                <option value="Lingkungan" {{ old('bidang') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Hiburan" {{ old('bidang') == 'Hiburan' ? 'selected' : '' }}>Hiburan</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('bidang')" />
                        </div>

                        <div>
                            <x-input-label for="tanggal_acara" value="Tanggal Acara" />
                            <x-text-input id="tanggal_acara" name="tanggal_acara" type="date" class="mt-1 block w-full" :value="old('tanggal_acara')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_acara')" />
                        </div>

                        <div>
                            <x-input-label for="penyelenggara" value="Penyelenggara" />
                            <x-text-input id="penyelenggara" name="penyelenggara" type="text" class="mt-1 block w-full" :value="old('penyelenggara')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('tanggal_acara')" />
                        </div>

                        <div>
                            <x-input-label for="description" value="Deskripsi Singkat" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full textarea-dark rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="funding_goal" value="Target Dana yang Dibutuhkan (Rp)" />
                            <x-text-input id="funding_goal" name="funding_goal" type="number" class="mt-1 block w-full" :value="old('funding_goal')" placeholder="Contoh: 5000000" />
                             <x-input-error class="mt-2" :messages="$errors->get('funding_goal')" />
                        </div>
                        
                        <div>
                            <x-input-label for="proposal_file" value="Upload Dokumen Proposal (PDF - Max 5MB)" />
                            <input id="proposal_file" name="proposal_file" type="file" accept=".pdf,application/pdf" class="mt-1 block w-full text-sm text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-slate-800 file:text-gray-200 hover:file:bg-slate-700" required>
                            <p class="mt-1 text-sm text-gray-400">Hanya file PDF yang diterima. Pastikan ukuran file maksimal 5MB.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('proposal_file')" />
                        </div>

                        <div>
                            <x-input-label for="link_sosmed" value="Link Sosial Media" />
                            <x-text-input id="link_sosmed" name="link_sosmed" type="text" class="mt-1 block w-full" :value="old('link_sosmed')" />
                            <x-input-error class="mt-2" :messages="$errors->get('link_sosmed')" />
                        </div>
                    <!-- Taruh di dalam <form> -->
                        <div>
                            <x-input-label for="target_sponsor_id" value="Kirim Langsung ke Perusahaan (Opsional)" />

                            @if(auth()->user()->direct_proposal_quota > 0)
                                <div class="mb-2 p-3 bg-blue-900/20 border border-blue-500/30 rounded-lg">
                                    <p class="text-sm text-blue-300">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Kuota Direct Proposal: <strong>{{ auth()->user()->direct_proposal_quota }}</strong> tersisa
                                    </p>
                                </div>
                                <select id="target_sponsor_id" name="target_sponsor_id" class="mt-1 block w-full select-dark rounded-md shadow-sm">
                                    <option value="">Tidak, kirim ke semua sponsor (Umum)</option>
                                    @foreach($sponsors as $sponsor)
                                        <option value="{{ $sponsor->id }}">{{ $sponsor->company_name ?? $sponsor->name }}</option>
                                    @endforeach
                                </select>
                                <p class="mt-1 text-sm text-gray-400">Jika tidak dipilih, proposal akan masuk ke daftar umum.</p>
                            @else
                                <div class="p-4 bg-red-900/20 border border-red-500/30 rounded-lg">
                                    <p class="text-sm text-red-300 mb-2">
                                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        <strong>Kuota Direct Proposal Habis</strong>
                                    </p>
                                    <p class="text-sm text-gray-300">
                                        Anda sudah menggunakan kuota direct proposal. Proposal akan otomatis dikirim ke daftar umum untuk semua sponsor.
                                    </p>
                                    <p class="mt-2 text-xs text-gray-400">
                                        💡 <em>Fitur premium untuk direct proposal unlimited akan segera hadir!</em>
                                    </p>
                                </div>
                                <input type="hidden" name="target_sponsor_id" value="">
                            @endif
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <x-primary-button>Ajukan Proposal</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
