<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Ajukan Proposal Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900">
                    <form action="{{ route('mahasiswa.proposals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="title" value="Judul Proposal/Acara" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div>
                            <x-input-label for="kategori" value="Kategori" />
                            <select name="kategori" id="kategori" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
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
                            <select name="bidang" id="bidang" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
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
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="funding_goal" value="Target Dana yang Dibutuhkan (Rp)" />
                            <x-text-input id="funding_goal" name="funding_goal" type="number" class="mt-1 block w-full" :value="old('funding_goal')" placeholder="Contoh: 5000000" />
                             <x-input-error class="mt-2" :messages="$errors->get('funding_goal')" />
                        </div>
                        
                        <div>
                            <x-input-label for="proposal_file" value="Upload Dokumen Proposal (PDF, DOC, DOCX - Max 5MB)" />
                            <input id="proposal_file" name="proposal_file" type="file" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
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
                            <select id="target_sponsor_id" name="target_sponsor_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Tidak, kirim ke semua sponsor (Umum)</option>
                                @foreach($sponsors as $sponsor)
                                    <option value="{{ $sponsor->id }}">{{ $sponsor->company_name ?? $sponsor->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Jika tidak dipilih, proposal akan masuk ke daftar umum.</p>
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