<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekandana - Platform Sponsorship</title>
    @vite('resources/css/app.css')
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-app text-gray-100">

    @include('layouts.navigation')
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Decorative orbs -->
        <div class="orb orb--violet w-64 h-64 -z-10 absolute" style="top:-40px; right:-80px;"></div>
        <div class="orb orb--cyan w-72 h-72 -z-10 absolute" style="bottom:-60px; left:-80px;"></div>
        <div class="orb orb--pink w-56 h-56 -z-10 absolute" style="top:30%; left:35%;"></div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Badge -->
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm badge-soft">
                    <i class="fas fa-check-circle mr-2 opacity-90"></i>
                    Platform #1 untuk Sponsorship di Indonesia
                </div>

                <!-- Main Heading -->
                <div class="space-y-4">
                    <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight tracking-tight">
                        Hubungkan <span class="text-gradient">Proposal</span><br>
                        dengan <span class="text-gradient">Sponsor</span><br>
                        <span class="text-gray-100">Terbaik</span>
                    </h1>
                    
                    <p class="text-xl text-gray-300 leading-relaxed">
                        Platform terpercaya yang menghubungkan mahasiswa dengan 
                        perusahaan untuk menciptakan kolaborasi yang saling 
                        menguntungkan. Sudah dipercaya oleh 500+ universitas dan 1000+ 
                        perusahaan.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="btn-gradient px-8 py-4 rounded-xl font-semibold text-lg hover:opacity-90 transition flex items-center justify-center shadow-xl">
                        Mulai Sekarang
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    <button class="btn-ghost px-8 py-4 rounded-xl font-semibold text-lg flex items-center justify-center">
                        <i class="fas fa-play mr-2"></i>
                        Lihat Demo
                    </button>
                </div>

                <!-- Stats -->
                <div class="flex items-center gap-6 pt-8 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 rounded-full border-2 border-white" style="background:linear-gradient(135deg,#6366f1,#8b5cf6)"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white" style="background:linear-gradient(135deg,#22d3ee,#06b6d4)"></div>
                            <div class="w-8 h-8 rounded-full border-2 border-white" style="background:linear-gradient(135deg,#f59e0b,#f97316)"></div>
                        </div>
                        <span class="text-sm text-gray-300 font-medium">2000+ Pengguna aktif</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/5 border border-white/10 px-3 py-2 rounded-full">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-300 font-medium">4.9/5 Rating</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Image/Illustration -->
            <div class="relative">
                <div class="glass-card inner-outline rounded-3xl p-8 card-hover">
                    <!-- Placeholder for illustration -->
                    <div class="aspect-square bg-slate-900/40 rounded-2xl shadow-lg flex items-center justify-center">
                        <div class="text-center space-y-4">
                            <div class="w-24 h-24 bg-gradient-to-br from-violet-600 to-cyan-500 rounded-full mx-auto flex items-center justify-center shadow-lg">
                                <i class="fas fa-handshake text-white text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-white">Kolaborasi Terbaik</h3>
                            <p class="text-gray-300">Menghubungkan sponsor dengan proposal berkualitas</p>
                        </div>
                    </div>
                </div>
                
                <!-- Floating tiles with glow -->
                <div class="absolute -top-6 -right-6 w-16 h-16 rounded-xl flex items-center justify-center shadow-xl rotate-12" style="background:linear-gradient(135deg,#f59e0b,#fb923c)">
                    <i class="fas fa-trophy text-white text-xl"></i>
                </div>
                <div class="absolute -bottom-6 -left-6 w-14 h-14 rounded-xl flex items-center justify-center shadow-xl -rotate-6" style="background:linear-gradient(135deg,#22c55e,#10b981)">
                    <i class="fas fa-check text-white"></i>
                </div>
            </div>
        </div>
    </main>

    <!-- Statistics Section -->
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">500+</div>
                    <div class="text-gray-300 font-medium">Universitas</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">1000+</div>
                    <div class="text-gray-300 font-medium">Perusahaan</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">5000+</div>
                    <div class="text-gray-300 font-medium">Proposal Berhasil</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">50M+</div>
                    <div class="text-gray-300 font-medium">Dana Tersalurkan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20" id="fitur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Dilengkapi dengan fitur-fitur canggih untuk memaksimalkan peluang keberhasilan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 my-10">
                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-cyan-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Smart Matching</h3>
                    <p class="text-gray-300">Temukan sponsor yang tepat dengan sistem pencarian berbasis AI</p>
                </div>

                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-emerald-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Verifikasi Terpercaya</h3>
                    <p class="text-gray-300">Data dan transaksi Anda dilindungi dengan enkripsi tingkat tinggi</p>
                </div>

                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-violet-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Proses Cepat</h3>
                    <p class="text-gray-300">Dapatkan respon dari sponsor dalam waktu kurang dari 24 jam</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-cyan-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Pencarian Cerdas</h3>
                    <p class="text-gray-300">Temukan sponsor yang tepat dengan sistem pencarian berbasis AI</p>
                </div>

                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-emerald-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Keamanan Terjamin</h3>
                    <p class="text-gray-300">Data dan transaksi Anda dilindungi dengan enkripsi tingkat tinggi</p>
                </div>

                <div class="text-center p-8 glass-card rounded-xl card-hover border border-white/10">
                    <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-violet-400 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-4">Proses Cepat</h3>
                    <p class="text-gray-300">Dapatkan respon dari sponsor dalam waktu kurang dari 24 jam</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works Section -->
    <section class="py-20" id="carakerja">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-4">Cara Kerja Rekandana</h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto">
                    Proses yang sederhana dan efektif untuk menghubungkan proposal dengan sponsor yang tepat
                </p>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- For Students -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-cyan-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Untuk Mahasiswa</h3>
                    </div>

                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Daftar & Verifikasi</h4>
                            <p class="text-gray-300">Buat akun dan verifikasi status mahasiswa dengan KTM</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Buat Proposal</h4>
                            <p class="text-gray-300">Gunakan template kami untuk membuat proposal yang menarik</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Submit & Promosi</h4>
                            <p class="text-gray-300">Kirim proposal dan dapatkan eksposur ke ribuan perusahaan</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Dapatkan Sponsor</h4>
                            <p class="text-gray-300">Terima tawaran sponsorship dan mulai kolaborasi</p>
                        </div>
                    </div>
                </div>

                <!-- For Companies -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-violet-400 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Untuk Perusahaan</h3>
                    </div>

                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Daftar Perusahaan</h4>
                            <p class="text-gray-300">Registrasi dengan email bisnis dan verifikasi perusahaan</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Jelajahi Proposal</h4>
                            <p class="text-gray-300">Cari proposal yang sesuai dengan target market Anda</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Filter & Analisis</h4>
                            <p class="text-gray-300">Gunakan filter canggih untuk menemukan opportunity terbaik</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-white mb-2">Mulai Sponsorship</h4>
                            <p class="text-gray-300">Hubungi penyelenggara dan mulai kemitraan strategis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">R</span>
                        </div>
                        <span class="ml-2 text-lg font-semibold">Rekandana</span>
                    </div>
                    <p class="text-gray-400">Platform terpercaya untuk menghubungkan proposal dengan sponsor terbaik di Indonesia.</p>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Produk</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Fitur</a></li>
                        <li><a href="#" class="hover:text-white">Harga</a></li>
                        <li><a href="#" class="hover:text-white">API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Karir</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="font-semibold mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Bantuan</a></li>
                        <li><a href="#" class="hover:text-white">Dokumentasi</a></li>
                        <li><a href="#" class="hover:text-white">Kontak</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Rekandana. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        document.querySelectorAll('.card-hover').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
    @vite('resources/js/app.js')
</body>
</html>
