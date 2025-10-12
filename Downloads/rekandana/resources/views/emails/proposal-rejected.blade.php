<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Penolakan Proposal</title>
</head>
<body class="bg-gray-100 font-sans leading-relaxed">
    <div class="max-w-2xl mx-auto my-8 bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-8 px-6 text-center">
            <h1 class="text-2xl font-bold m-0">Pemberitahuan Penolakan Proposal</h1>
        </div>

        <!-- Content -->
        <div class="p-8 text-gray-800">
            <p class="mb-4">Yth. <strong class="font-semibold">{{ $mahasiswa->name }}</strong>,</p>

            <p class="mb-4">Terima kasih atas minat Anda dalam mengirimkan proposal kepada perusahaan kami. Setelah melakukan review, dengan berat hati kami informasikan bahwa proposal Anda tidak dapat kami lanjutkan pada saat ini.</p>

            <!-- Proposal Info -->
            <div class="bg-gray-50 border-l-4 border-indigo-500 rounded p-4 my-6">
                <h3 class="text-lg font-semibold text-indigo-600 mt-0 mb-3">Detail Proposal</h3>
                <p class="my-1"><strong class="font-semibold">Judul:</strong> {{ $proposal->title }}</p>
                <p class="my-1"><strong class="font-semibold">Kategori:</strong> {{ $proposal->kategori }}</p>
                <p class="my-1"><strong class="font-semibold">Bidang:</strong> {{ $proposal->bidang }}</p>
                <p class="my-1"><strong class="font-semibold">Target Pendanaan:</strong> Rp {{ number_format($proposal->funding_goal, 0, ',', '.') }}</p>
            </div>

            <!-- Message Box -->
            <div class="bg-yellow-50 border-l-4 border-yellow-400 rounded p-4 my-6">
                <p class="font-semibold mb-2">Catatan:</p>
                <p class="m-0">Keputusan ini dibuat oleh <strong class="font-semibold">{{ $sponsor->company_name }}</strong> setelah mempertimbangkan berbagai faktor, termasuk kesesuaian dengan fokus bisnis dan prioritas pendanaan kami saat ini.</p>
            </div>

            <p class="mb-4">Kami sangat menghargai usaha dan dedikasi Anda dalam menyusun proposal ini. Penolakan ini tidak mengurangi nilai dari ide dan rencana Anda. Kami mendorong Anda untuk terus mencari peluang lain yang mungkin lebih sesuai dengan kebutuhan proyek Anda.</p>

            <p class="mb-4">Jangan ragu untuk mengirimkan proposal lain di masa mendatang atau mencoba sponsor lain yang mungkin lebih tertarik dengan proyek Anda.</p>

            <!-- CTA Button -->
            <div class="text-center my-6">
                <a href="{{ url('/dashboard') }}" class="inline-block px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg no-underline hover:opacity-90 transition-opacity">
                    Lihat Proposal Lainnya
                </a>
            </div>

            <p class="mt-8 mb-4">Semoga sukses dengan proyek Anda!</p>

            <p class="mb-0">
                Salam hangat,<br>
                <strong class="font-semibold">{{ $sponsor->company_name }}</strong><br>
                <span class="text-gray-600">Tim Rekandana</span>
            </p>
        </div>

        <!-- Footer -->
        <div class="bg-gray-50 border-t border-gray-200 py-5 px-6 text-center text-xs text-gray-500">
            <p class="mb-1">Email ini dikirim secara otomatis dari sistem Rekandana.</p>
            <p class="m-0">&copy; {{ date('Y') }} Rekandana. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
