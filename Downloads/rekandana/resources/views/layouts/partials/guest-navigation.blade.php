    <!-- Header/Navigation -->
    <nav class="bg-slate-900/40 backdrop-blur border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('storage/logo-rekandana.png') }}" alt="" class="w-16 drop-shadow">
                        <span class="ml-2 text-xl font-semibold text-gray-100">Rekandana</span>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#fitur" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Fitur</a>
                        <a href="#carakerja" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Cara Kerja</a>
                        <a href="#testimoni" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Testimoni</a>
                        <a href="#harga" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">Harga</a>
                    </div>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium">
                        Masuk
                    </a>
                    <a href="/register" class="btn-gradient px-4 py-2 rounded-lg text-sm font-medium transition-transform hover:scale-[1.02]">
                        Daftar Gratis
                    </a>
                </div>
            </div>
        </div>
    </nav>
