<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Edit Kode Referral
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="glass-card overflow-hidden sm:rounded-xl">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('admin.referral-codes.update', $referralCode) }}">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="code" value="Kode Referral" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code', $referralCode->code)" required autofocus />
                            <p class="text-xs text-gray-400 mt-1">Kode akan otomatis diubah ke huruf kapital</p>
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" class="rounded border-white/10 bg-slate-900/50 text-indigo-600 shadow-sm focus:ring-indigo-500" {{ old('is_active', $referralCode->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-300">Aktifkan kode ini</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="max_uses" value="Batas Maksimal Penggunaan (Opsional)" />
                            <x-text-input id="max_uses" class="block mt-1 w-full" type="number" name="max_uses" :value="old('max_uses', $referralCode->max_uses)" min="1" placeholder="Kosongkan untuk unlimited" />
                            <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ada batas penggunaan</p>
                            <x-input-error :messages="$errors->get('max_uses')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="expires_at" value="Tanggal Kadaluarsa (Opsional)" />
                            <x-text-input id="expires_at" class="block mt-1 w-full" type="datetime-local" name="expires_at" :value="old('expires_at', $referralCode->expires_at ? $referralCode->expires_at->format('Y-m-d\TH:i') : '')" />
                            <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika kode tidak memiliki masa kadaluarsa</p>
                            <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                        </div>

                        <div class="mt-4 p-4 bg-slate-800 rounded-lg">
                            <p class="text-sm text-gray-300"><strong>Statistik:</strong></p>
                            <p class="text-sm text-gray-300 mt-1">Sudah digunakan oleh: <strong>{{ $referralCode->users_count ?? 0 }}</strong> sponsor</p>
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.referral-codes.index') }}" class="px-4 py-2 bg-slate-800 text-gray-200 rounded-lg hover:bg-slate-700 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 btn-gradient text-white rounded-lg transition">
                                Update Kode Referral
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
