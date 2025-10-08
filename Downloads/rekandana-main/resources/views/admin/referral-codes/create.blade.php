<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Buat Kode Referral Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.referral-codes.store') }}">
                        @csrf

                        <div>
                            <x-input-label for="code" value="Kode Referral" />
                            <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="old('code')" required autofocus placeholder="Contoh: SPONSOR2024" />
                            <p class="text-xs text-gray-500 mt-1">Kode akan otomatis diubah ke huruf kapital</p>
                            <x-input-error :messages="$errors->get('code')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Aktifkan kode ini</span>
                            </label>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="max_uses" value="Batas Maksimal Penggunaan (Opsional)" />
                            <x-text-input id="max_uses" class="block mt-1 w-full" type="number" name="max_uses" :value="old('max_uses')" min="1" placeholder="Kosongkan untuk unlimited" />
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ada batas penggunaan</p>
                            <x-input-error :messages="$errors->get('max_uses')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="expires_at" value="Tanggal Kadaluarsa (Opsional)" />
                            <x-text-input id="expires_at" class="block mt-1 w-full" type="datetime-local" name="expires_at" :value="old('expires_at')" />
                            <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika kode tidak memiliki masa kadaluarsa</p>
                            <x-input-error :messages="$errors->get('expires_at')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('admin.referral-codes.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Buat Kode Referral
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
