<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Latihan - JLPT 2026</title>
    
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .bubble-card {
            background: linear-gradient(135deg, #ffffff 0%, #f0fdfa 100%);
        }
        /* Animasi Pop-up ringan */
        .animate-pop {
            animation: pop 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
        @keyframes pop {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="text-gray-800 min-h-screen flex flex-col justify-between">

    <!-- HEADER -->
 <header class="w-full border-b border-gray-100 py-3 px-6 md:px-12 flex items-center justify-between bg-white/95 backdrop-blur-sm sticky top-0 z-50 shadow-sm transition-all">
        <div class="flex items-center">
            <!-- Panggil Logo dari Database -->
            <img src="{{ asset($webSetting->logo) }}" alt="Logo Web" class="h-10 md:h-12 w-auto object-contain border-r border-gray-300 pr-4 mr-4">
            <div class="flex items-center space-x-4">
                <div class="flex flex-col hidden sm:flex">
                    <!-- Panggil Nama App dari Database -->
                    <span class="text-xs md:text-sm font-bold text-gray-800 tracking-widest">{{ $webSetting->app_name }}</span>
                    <span class="text-[9px] md:text-[10px] text-gray-600">国際交流基金</span>
                </div>
                <div class="h-8 border-l border-gray-300 hidden sm:block"></div>
                <div class="flex flex-col">
                    <span class="text-[10px] md:text-xs font-semibold text-gray-800 tracking-wide">日本語能力試験</span>
                    <div class="flex items-baseline space-x-1 md:space-x-2">
                        <span class="text-lg md:text-xl font-bold tracking-wider text-gray-900">JLPT</span>
                    </div>
                </div>
            </div>
        </div>

        <nav class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-700">
            <a href="{{ route('beranda') }}" class="hover:text-blue-600 transition">Beranda</a>
            <a href="{{ route('materi') }}" class="hover:text-blue-600 transition">Materi</a>
            <a href="{{ route('latihan') }}" class="hover:text-blue-600 transition">Latihan</a>
            <a href="{{ route('lokasi') }}" class="hover:text-blue-600 transition">Lokasi Ujian</a>
            <a href="#" class="text-[#0f3465] font-bold border-b-2 border-[#0f3465] pb-1">Kontak</a>
            
            <div class="flex items-center space-x-4 border-l border-gray-300 pl-6">
                @auth
                    <span class="font-semibold text-[#0f3465]">Halo, {{ Auth::user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 border border-gray-300 px-5 py-2 rounded-full hover:bg-gray-50 transition text-[#0f3465] font-semibold text-sm shadow-sm">
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>
        </nav>
    </header>


    <!-- KONTEN UTAMA: HASIL KUIS -->
    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="max-w-4xl w-full flex flex-col md:flex-row items-center justify-center gap-10 md:gap-16 animate-pop">
            
            <!-- Karakter (Kiri) -->
            <div class="w-48 h-64 md:w-64 md:h-80 bg-pink-200 rounded-[100px] overflow-hidden shadow-xl border-4 border-white flex-shrink-0 flex items-center justify-center">
                <!-- Ganti gambar karakter anime Anda di sini -->
                <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" alt="Karakter" class="w-full h-full object-cover">
            </div>

            <!-- Teks Selamat & Skor (Kanan) -->
            <div class="flex flex-col items-center md:items-start w-full max-w-md">
                
                <div class="bubble-card border-2 border-teal-100 rounded-3xl p-8 md:p-10 shadow-lg w-full text-center md:text-left relative">
                    <h1 class="text-3xl md:text-4xl font-black text-[#0fb398] mb-2">おめでとう！</h1>
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Selamat! Latihan <span id="level-display" class="text-[#0f3465]">N5</span> Selesai.</h2>
                    
                    <div class="bg-white rounded-2xl p-6 shadow-inner border border-gray-100 text-center">
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider mb-2">Skor Kamu</p>
                        <div class="flex items-baseline justify-center md:justify-start gap-2">
                            <span id="score-display" class="text-5xl md:text-6xl font-black text-[#f59e0b]">0</span>
                            <span id="total-display" class="text-xl font-bold text-gray-400">/ 0</span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <a href="{{ route('latihan') }}" class="mt-8 bg-[#0f3465] text-white px-10 py-4 rounded-2xl font-bold text-lg hover:bg-blue-900 transition shadow-md flex items-center gap-2 transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Menu Latihan
                </a>

            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="w-full bg-[#fafafa] border-t border-gray-200 pt-12 pb-6 px-6 md:px-12 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center mb-10">
                <!-- Panggil Logo Footer -->
                <img src="{{ asset($webSetting->logo) }}" alt="Logo" class="h-16 md:h-20 w-auto object-contain border-r border-gray-300 pr-6 mr-6">
                <div class="flex flex-col border-r border-gray-300 pr-6 mr-6">
                    <!-- Panggil Nama App Footer -->
                    <span class="text-sm md:text-base font-bold text-gray-800 tracking-widest">{{ $webSetting->app_name }}</span>
                    <span class="text-[10px] md:text-xs text-gray-600">国際交流基金</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-sm font-semibold text-gray-800 tracking-wide">日本語能力試験</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-3xl font-bold tracking-wider text-gray-900">JLPT</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-sm text-gray-600 mb-10">
                <div>
                    <!-- Panggil Nama App, Alamat, dan Email -->
                    <h4 class="font-bold text-gray-900 mb-3 text-base">{{ $webSetting->app_name }}</h4>
                    <p class="leading-relaxed">{!! nl2br(e($webSetting->address)) !!}</p>
                    <a href="mailto:{{ $webSetting->email }}" class="block mt-2 text-blue-600 hover:underline font-medium">{{ $webSetting->email }}</a>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-3 text-base">Panduan Peserta</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-600 transition">Kontak Panitia</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-3 text-base">Bantuan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-blue-600 transition">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-3 text-base">Social Media</h4>
                    <div class="flex space-x-4 items-center text-gray-400">
                        <!-- Panggil Link Facebook -->
                        <a href="{{ $webSetting->facebook }}" target="_blank" class="hover:text-[#1877F2] transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto border-t border-gray-200 pt-6 mt-4 text-center text-xs text-gray-500 font-medium">
            &copy; 2026 JLPT Indonesia | Powered by PT. Timedoor Indonesia
        </div>
    </footer>
    <!-- Script Ambil Nilai dari URL -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const score = urlParams.get('score') || 0;
            const total = urlParams.get('total') || 0;
            const level = urlParams.get('level') || 'N5';

            // Animasi angka skor bergulir
            let currentScore = 0;
            const scoreElement = document.getElementById('score-display');
            const interval = setInterval(() => {
                if(currentScore >= score) {
                    clearInterval(interval);
                    scoreElement.innerText = score;
                } else {
                    currentScore++;
                    scoreElement.innerText = currentScore;
                }
            }, 30); // Kecepatan putaran angka

            document.getElementById('total-display').innerText = `/ ${total}`;
            document.getElementById('level-display').innerText = level.toUpperCase();
        });
    </script>
</body>
</html>