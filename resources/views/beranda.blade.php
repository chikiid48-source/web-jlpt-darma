<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - JLPT 2026</title>
    
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-pattern-blue { background-color: #1a428a; background-image: radial-gradient(circle at center, #2352a1 2px, transparent 2px); background-size: 16px 16px; }
        .bg-pattern-gold { background-color: #c9ab57; background-image: radial-gradient(circle at center, #d8bc68 2px, transparent 2px); background-size: 16px 16px; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar -->
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
       <a href="{{ url('/') }}"
       class="{{ request()->is('/') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
        Beranda
    </a>
    <a href="{{ url('/materi') }}"
       class="{{ request()->is('materi*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
        Materi
    </a>
    <a href="{{ url('/latihan') }}"
       class="{{ request()->is('latihan*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
        Latihan
    </a>
    <a href="{{ url('/lokasi-ujian') }}"
       class="{{ request()->is('lokasi-ujian*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
        Lokasi Ujian
    </a>
    <a href="{{ url('/kontak') }}"
       class="{{ request()->is('kontak*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
        Kontak
    </a>
            
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


    <!-- KONTEN UTAMA -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-6 md:px-12 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-24 mt-4">
            <div class="lg:col-span-6 flex justify-center items-center p-2">
                <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" alt="Anime JLPT Character" class="w-full max-w-lg h-auto object-contain">
            </div>

            <div class="lg:col-span-6 w-full">
                <div class="mb-6">
                    <h1 class="text-3xl md:text-[32px] font-extrabold text-gray-900 tracking-tight mb-1">Pendaftaran Online JLPT Tahun 2026</h1>
                    <p class="text-[15px] font-semibold text-[#c3a45c]">2026年日本語能力試験オンライン申込</p>
                </div>

                <div class="space-y-4">
                    <div class="border border-[#0f3465] rounded-xl p-4 flex items-center bg-white w-full">
                        <div class="border border-[#0f3465] rounded-lg overflow-hidden flex flex-col min-w-[70px] text-center flex-shrink-0">
                            <div class="bg-white text-[#0f3465] py-1 px-2 font-bold leading-tight">
                                <span class="text-[10px] block uppercase">Minggu</span>
                                <span class="text-xl block">5</span>
                                <span class="text-[10px] block uppercase">Juli</span>
                            </div>
                            <div class="bg-[#0f3465] text-white text-xs font-bold py-1">2026</div>
                        </div>
                        <div class="ml-4 flex-grow">
                            <h3 class="text-sm md:text-base font-semibold text-[#0f3465]">Pendaftaran Online JLPT Tahun 2026 ke-1</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Periode pendaftaran <a href="#" class="text-blue-600 font-bold hover:underline">lihat di sini</a></p>
                        </div>
                        <div class="ml-4 text-right flex-shrink-0">
                            <span class="text-xs md:text-sm font-bold text-[#c3a45c]">PENDAFTARAN TUTUP</span>
                        </div>
                    </div>

                    <div class="border border-[#0f3465] rounded-xl p-4 flex items-center bg-white w-full">
                        <div class="border border-[#0f3465] rounded-lg overflow-hidden flex flex-col min-w-[70px] text-center flex-shrink-0">
                            <div class="bg-white text-[#0f3465] py-1 px-2 font-bold leading-tight">
                                <span class="text-[10px] block uppercase">Minggu</span>
                                <span class="text-xl block">6</span>
                                <span class="text-[10px] block uppercase">Desember</span>
                            </div>
                            <div class="bg-[#0f3465] text-white text-xs font-bold py-1">2026</div>
                        </div>
                        <div class="ml-4 flex-grow">
                            <h3 class="text-sm md:text-base font-semibold text-[#0f3465]">Pendaftaran Online JLPT Tahun 2026 ke-2</h3>
                            <p class="text-xs text-gray-600 mt-0.5">Periode pendaftaran <a href="#" class="text-blue-600 font-bold hover:underline">lihat di sini</a></p>
                        </div>
                        <div class="ml-4 text-right flex-shrink-0">
                            <span class="text-xs md:text-sm font-bold text-[#c3a45c]">PENDAFTARAN TUTUP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Normal Dikembalikan -->
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
</body>
</html>