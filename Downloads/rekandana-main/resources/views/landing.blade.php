<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekandana - Platform Sponsorship</title>
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="bg-gray-50">

    @include('layouts.navigation')
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="space-y-8">
                <!-- Badge -->
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800">
                    <i class="fas fa-check-circle mr-2"></i>
                    Platform #1 untuk Sponsorship di Indonesia
                </div>

                <!-- Main Heading -->
                <div class="space-y-4">
                    <h1 class="text-5xl font-bold text-gray-900 leading-tight">
                        Hubungkan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Proposal</span><br>
                        dengan <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600">Sponsor</span><br>
                        <span class="text-gray-900">Terbaik</span>
                    </h1>
                    
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Platform terpercaya yang menghubungkan mahasiswa dengan 
                        perusahaan untuk menciptakan kolaborasi yang saling 
                        menguntungkan. Sudah dipercaya oleh 500+ universitas dan 1000+ 
                        perusahaan.
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <button class="gradient-bg text-white px-8 py-4 rounded-lg font-semibold text-lg hover:opacity-90 transition-opacity flex items-center justify-center">
                        Mulai Sekarang
                        <i class="fas fa-arrow-right ml-2"></i>
                    </button>
                    <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg font-semibold text-lg hover:border-gray-400 transition-colors flex items-center justify-center">
                        <i class="fas fa-play mr-2"></i>
                        Lihat Demo
                    </button>
                </div>

                <!-- Stats -->
                <div class="flex items-center space-x-8 pt-8">
                    <div class="flex items-center space-x-2">
                        <div class="flex -space-x-2">
                            <div class="w-8 h-8 bg-blue-500 rounded-full border-2 border-white"></div>
                            <div class="w-8 h-8 bg-green-500 rounded-full border-2 border-white"></div>
                            <div class="w-8 h-8 bg-yellow-500 rounded-full border-2 border-white"></div>
                            <div class="w-8 h-8 bg-purple-500 rounded-full border-2 border-white"></div>
                        </div>
                        <span class="text-sm text-gray-600 font-medium">2000+ pengguna aktif</span>
                    </div>
                    
                    <div class="flex items-center space-x-1">
                        <div class="flex text-yellow-400">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span class="text-sm text-gray-600 font-medium ml-2">4.9/5 rating</span>
                    </div>
                </div>
            </div>

            <!-- Right Content - Image/Illustration -->
            <div class="relative">
                <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-3xl p-8 card-hover">
                    <!-- Placeholder for illustration -->
                    <div class="aspect-square bg-white rounded-2xl shadow-lg flex items-center justify-center">
                        <div class="text-center space-y-4">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full mx-auto flex items-center justify-center">
                                <i class="fas fa-handshake text-white text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800">Kolaborasi Terbaik</h3>
                            <p class="text-gray-600">Menghubungkan sponsor dengan proposal berkualitas</p>
                        </div>
                    </div>
                </div>
                
                <!-- Floating elements -->
                <div class="absolute -top-6 -right-6 w-20 h-20 bg-yellow-400 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-trophy text-white text-2xl"></i>
                </div>
                
                <div class="absolute -bottom-6 -left-6 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                    <i class="fas fa-chart-line text-white text-xl"></i>
                </div>
            </div>
        </div>
    </main>

    <!-- Statistics Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">500+</div>
                    <div class="text-gray-600 font-medium">Universitas</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">1000+</div>
                    <div class="text-gray-600 font-medium">Perusahaan</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">5000+</div>
                    <div class="text-gray-600 font-medium">Proposal Berhasil</div>
                </div>
                <div class="text-center">
                    <div class="text-4xl md:text-5xl font-bold text-blue-600 mb-2">50M+</div>
                    <div class="text-gray-600 font-medium">Dana Tersalurkan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20" id="fitur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Dilengkapi dengan fitur-fitur canggih untuk memaksimalkan peluang keberhasilan Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 my-10">
                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Template & Panduan Proposal</h3>
                    <p class="text-gray-600">Template siap pakai dan panduan langkah demi langkah untuk menyusun proposal yang menarik</p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Verifikasi Terpercaya</h3>
                    <p class="text-gray-600">Data dan transaksi Anda dilindungi dengan enkripsi tingkat tinggi</p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Proses Cepat</h3>
                    <p class="text-gray-600">Dapatkan respon dari sponsor dalam waktu kurang dari 24 jam</p>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Sistem Pengajuan Ganda</h3>
                    <p class="text-gray-600">Proposal dapat dilihat semua badan usaha dan mahasiswa bisa memilih perusahaan tertentu</p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Keamanan Terjamin</h3>
                    <p class="text-gray-600">Perlindungan berlapis, audit trail, dan kontrol akses menjaga kerahasiaan data</p>
                </div>

                <div class="text-center p-8 bg-white rounded-xl shadow-lg card-hover border border-gray-100">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Fitur Notifikasi</h3>
                    <p class="text-gray-600">Dapat pemberitahuan saat proposal dilihat, ditandai, atau diterima oleh sponsor</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- How It Works Section -->
    <section class="bg-gray-50 py-20" id="carakerja">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Cara Kerja Rekandana</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Proses yang sederhana dan efektif untuk menghubungkan proposal dengan sponsor yang tepat
                </p>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- For Students -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-blue-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Untuk Mahasiswa</h3>
                    </div>

                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Daftar & Verifikasi</h4>
                            <p class="text-gray-600">Buat akun dan verifikasi status mahasiswa dengan KTM</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Buat Proposal</h4>
                            <p class="text-gray-600">Gunakan template kami untuk membuat proposal yang menarik</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Submit & Promosi</h4>
                            <p class="text-gray-600">Kirim proposal dan dapatkan eksposur ke ribuan perusahaan</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Dapatkan Sponsor</h4>
                            <p class="text-gray-600">Terima tawaran sponsorship dan mulai kolaborasi</p>
                        </div>
                    </div>
                </div>

                <!-- For Companies -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-building text-purple-600 text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Untuk Perusahaan</h3>
                    </div>

                    <!-- Step 1 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Daftar Perusahaan</h4>
                            <p class="text-gray-600">Registrasi dengan email bisnis dan verifikasi perusahaan</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Jelajahi Proposal</h4>
                            <p class="text-gray-600">Cari proposal yang sesuai dengan target market Anda</p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Filter & Analisis</h4>
                            <p class="text-gray-600">Gunakan filter canggih untuk menemukan opportunity terbaik</p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex items-start space-x-4">
                        <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-sm">4</span>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Mulai Sponsorship</h4>
                            <p class="text-gray-600">Hubungi penyelenggara dan mulai kemitraan strategis</p>
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