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

    <!-- Header / Navbar (Responsive Desktop & Mobile) -->
    <header class="w-full border-b border-gray-100 py-3 px-4 sm:px-6 md:px-12 flex items-center justify-between bg-white/95 backdrop-blur-sm sticky top-0 z-50 shadow-sm transition-all">
        <!-- Logo Kiri -->
        <div class="flex items-center">
            <img src="{{ asset($webSetting->logo) }}" alt="Logo Web" class="h-9 sm:h-10 md:h-12 w-auto object-contain border-r border-gray-300 pr-3 mr-3 md:pr-4 md:mr-4">
            <div class="flex items-center space-x-3 md:space-x-4">
                <div class="hidden sm:flex flex-col">
                    <span class="text-xs md:text-sm font-bold text-gray-800 tracking-widest">{{ $webSetting->app_name }}</span>
                    <span class="text-[9px] md:text-[10px] text-gray-600">国際交流基金</span>
                </div>
                <div class="h-8 border-l border-gray-300 hidden sm:block"></div>
                <div class="flex flex-col">
                    <span class="text-[9px] sm:text-[10px] md:text-xs font-semibold text-gray-800 tracking-wide">日本語能力試験</span>
                    <div class="flex items-baseline space-x-1 md:space-x-2">
                        <span class="text-base sm:text-lg md:text-xl font-bold tracking-wider text-gray-900 leading-none">JLPT</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- MENU DESKTOP (Tampil di Laptop/PC) -->
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
               class="{{ request()->is('latihan*') || request()->is('hiragana*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
                Latihan
            </a>
            <a href="{{ url('/lokasi-ujian') }}"
               class="{{ request()->is('lokasi*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
                Lokasi Ujian
            </a>
            <a href="{{ url('/kontak') }}"
               class="{{ request()->is('kontak*') ? 'text-[#003366] font-bold border-b-2 border-[#003366] pb-1' : 'text-gray-600 hover:text-[#003366] transition' }}">
                Kontak
            </a>
            
            <div class="flex items-center space-x-3 border-l border-gray-300 pl-6">
                @auth
                    <span class="font-semibold text-[#0f3465]">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ url('/logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-red-200 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white px-4 py-1.5 rounded-full text-xs font-semibold transition cursor-pointer">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center space-x-2 border border-gray-300 px-5 py-2 rounded-full hover:bg-gray-50 transition text-[#0f3465] font-semibold text-sm shadow-sm">
                        <span>Masuk</span>
                    </a>
                @endauth
            </div>
        </nav>

        <!-- MENU MOBILE (Tampil di HP: Kotak Dropdown + Lingkaran Logout) -->
        <div class="flex md:hidden items-center space-x-2 relative">
            <!-- KOTAK: Tombol Pilihan Menu Dropdown -->
            <div class="relative">
                <button onclick="toggleMobileMenu()" id="mobile-menu-btn" class="flex items-center justify-between space-x-2 border border-gray-300 bg-gray-50 hover:bg-gray-100 text-[#0f3465] px-3 py-2 rounded-lg text-xs font-bold shadow-sm transition">
                    <span>Menu</span>
                    <svg id="mobile-menu-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Isi Dropdown Saat Kotak Dipencet -->
                <div id="mobile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                    @auth
                        <div class="px-4 py-2 bg-slate-50 border-b border-gray-100 text-[11px] font-bold text-[#0f3465] truncate">
                            Halo, {{ Auth::user()->name }}
                        </div>
                    @endauth
                    <a href="{{ url('/') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('/') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Beranda
                    </a>
                    <a href="{{ url('/materi') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('materi*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Materi
                    </a>
                    <a href="{{ url('/latihan') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('latihan*') || request()->is('hiragana*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Latihan
                    </a>
                    <a href="{{ url('/lokasi-ujian') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('lokasi*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Lokasi Ujian
                    </a>
                    <a href="{{ url('/kontak') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('kontak*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Kontak
                    </a>
                </div>
            </div>

            <!-- LINGKARAN: Tombol Logout / Login Bulat -->
            @auth
                <form action="{{ url('/logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" title="Keluar" class="w-9 h-9 rounded-full border border-red-200 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white flex items-center justify-center shadow-sm transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" title="Masuk" class="w-9 h-9 rounded-full border border-blue-200 bg-blue-50 text-[#0f3465] hover:bg-[#0f3465] hover:text-white flex items-center justify-center shadow-sm transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                </a>
            @endauth
        </div>
    </header>

    <!-- KONTEN UTAMA -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-12 py-6 md:py-10">
        <!-- Section 1: Hero & Pendaftaran Online JLPT 2026 -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 md:gap-8 items-center mb-14 md:mb-16 mt-2 md:mt-4">
            <div class="lg:col-span-6 flex justify-center items-center p-2">
                <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" alt="Anime JLPT Character" class="w-full max-w-xs sm:max-w-md lg:max-w-lg h-auto object-contain">
            </div>

            <div class="lg:col-span-6 w-full">
                <div class="mb-5 md:mb-6 text-center sm:text-left">
                    <h1 class="text-2xl sm:text-3xl md:text-[32px] font-extrabold text-gray-900 tracking-tight leading-snug mb-1">Pendaftaran Online JLPT Tahun 2026</h1>
                    <p class="text-xs sm:text-[15px] font-semibold text-[#c3a45c]">2026年日本語能力試験オンライン申込</p>
                </div>

                <div class="space-y-4">
                    <!-- Kartu Jadwal 1 (Responsive Mobile & Desktop) -->
                    <div class="border border-[#0f3465] rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white w-full shadow-sm">
                        <div class="flex items-center">
                            <div class="border border-[#0f3465] rounded-lg overflow-hidden flex flex-col min-w-[65px] sm:min-w-[70px] text-center flex-shrink-0">
                                <div class="bg-white text-[#0f3465] py-1 px-2 font-bold leading-tight">
                                    <span class="text-[10px] block uppercase">Minggu</span>
                                    <span class="text-lg sm:text-xl block">5</span>
                                    <span class="text-[10px] block uppercase">Juli</span>
                                </div>
                                <div class="bg-[#0f3465] text-white text-xs font-bold py-1">2026</div>
                            </div>
                            <div class="ml-3.5 sm:ml-4">
                                <h3 class="text-sm md:text-base font-bold text-[#0f3465] leading-snug">Pendaftaran Online JLPT Tahun 2026 ke-1</h3>
                                <p class="text-xs text-gray-600 mt-1">Periode pendaftaran <a href="#" class="text-blue-600 font-bold hover:underline">lihat di sini</a></p>
                            </div>
                        </div>
                        <div class="sm:ml-4 text-right border-t sm:border-t-0 border-gray-100 pt-2 sm:pt-0 flex-shrink-0">
                            <span class="text-xs md:text-sm font-bold text-[#c3a45c]">PENDAFTARAN TUTUP</span>
                        </div>
                    </div>

                    <!-- Kartu Jadwal 2 (Responsive Mobile & Desktop) -->
                    <div class="border border-[#0f3465] rounded-xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white w-full shadow-sm">
                        <div class="flex items-center">
                            <div class="border border-[#0f3465] rounded-lg overflow-hidden flex flex-col min-w-[65px] sm:min-w-[70px] text-center flex-shrink-0">
                                <div class="bg-white text-[#0f3465] py-1 px-2 font-bold leading-tight">
                                    <span class="text-[10px] block uppercase">Minggu</span>
                                    <span class="text-lg sm:text-xl block">6</span>
                                    <span class="text-[10px] block uppercase">Desember</span>
                                </div>
                                <div class="bg-[#0f3465] text-white text-xs font-bold py-1">2026</div>
                            </div>
                            <div class="ml-3.5 sm:ml-4">
                                <h3 class="text-sm md:text-base font-bold text-[#0f3465] leading-snug">Pendaftaran Online JLPT Tahun 2026 ke-2</h3>
                                <p class="text-xs text-gray-600 mt-1">Periode pendaftaran <a href="#" class="text-blue-600 font-bold hover:underline">lihat di sini</a></p>
                            </div>
                        </div>
                        <div class="sm:ml-4 text-right border-t sm:border-t-0 border-gray-100 pt-2 sm:pt-0 flex-shrink-0">
                            <span class="text-xs md:text-sm font-bold text-[#c3a45c]">PENDAFTARAN TUTUP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Kartu JLPT Sample Questions & Sample Workbook -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6 mb-14 md:mb-20">
            <!-- Kartu Biru: JLPT Sample Questions -->
            <div class="bg-pattern-blue rounded-2xl p-6 md:p-8 flex flex-col sm:flex-row items-center text-center sm:text-left gap-5 md:gap-6 shadow-sm">
                <div class="w-40 sm:w-36 md:w-44 h-28 md:h-32 bg-white rounded-xl p-2 flex items-center justify-center shadow-md flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('images/sample-laptop.png') }}" alt="JLPT Sample Questions" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="text-lg md:text-xl font-bold text-white leading-snug">JLPT Sample Questions</h3>
                    <p class="text-xs md:text-sm text-blue-100 mt-1 mb-4 md:mb-5">Pelajari contoh soal tes JLPT</p>
                    <a href="{{ url('/latihan') }}" class="inline-block bg-white text-[#1a428a] text-xs md:text-sm font-semibold px-7 py-2.5 rounded-full hover:bg-blue-50 transition shadow-sm">
                        Selengkapnya
                    </a>
                </div>
            </div>

            <!-- Kartu Emas: JLPT Sample Workbook -->
            <div class="bg-pattern-gold rounded-2xl p-6 md:p-8 flex flex-col sm:flex-row items-center text-center sm:text-left gap-5 md:gap-6 shadow-sm">
                <div class="w-40 sm:w-36 md:w-44 h-28 md:h-32 bg-white rounded-xl p-2 flex items-center justify-center shadow-md flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('images/sample-buku.png') }}" alt="JLPT Sample Workbook" class="w-full h-full object-contain">
                </div>
                <div>
                    <h3 class="text-lg md:text-xl font-bold text-white leading-snug">JLPT Sample Workbook</h3>
                    <p class="text-xs md:text-sm text-yellow-50 mt-1 mb-4 md:mb-5">Pelajari contoh soal tes JLPT</p>
                    <a href="{{ url('/materi') }}" class="inline-block bg-white text-[#9c8134] text-xs md:text-sm font-semibold px-7 py-2.5 rounded-full hover:bg-yellow-50 transition shadow-sm">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>

        <!-- Section 3: Tentang JLPT -->
        <div class="mb-8 md:mb-12">
            <div class="text-center mb-6 md:mb-8">
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">Tentang JLPT</h2>
                <p class="text-xs md:text-sm font-semibold text-[#c3a45c] mt-1">JLPTについて</p>
            </div>

            <div class="bg-[#f1f5f9] rounded-2xl p-5 sm:p-6 md:p-10 flex flex-col md:flex-row items-center gap-6 md:gap-8">
                <div class="w-full md:w-5/12">
                    <img src="{{ asset('images/tentang-jlpt.jpg') }}" alt="Tentang JLPT" class="w-full h-52 sm:h-60 md:h-64 object-cover rounded-xl shadow-sm">
                </div>
                <div class="w-full md:w-7/12 space-y-3.5 md:space-y-4 text-xs sm:text-sm text-gray-700 leading-relaxed">
                    <p>
                        <strong class="font-bold text-gray-900">Japanese-Language Proficiency Test (JLPT)</strong> dikembangkan di Jepang dan telah menjadi standar sertifikasi kompetensi bahasa Jepang di seluruh dunia sejak tahun 1984. Sertifikasi umumnya dibutuhkan untuk study maupun bekerja di negara Jepang maupun lembaga dan perusahaan Jepang pada umumnya.
                    </p>
                    <p>
                        Sebanyak 7,000 peserta dari seluruh dunia mengikuti test pertama JLPT yang dilaksanakan serentak di 15 negara di berbagai benua, dan pada tahun 2019 telah diikuti oleh lebih dari 1,268,511 peserta di 87 negara diseluruh dunia.
                    </p>
                    <p>
                        Kini JLPT merupakan ujian sertifikasi kompetensi bahasa Jepang terbesar di dunia.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Responsive -->
    <footer class="w-full bg-[#fafafa] border-t border-gray-200 pt-10 md:pt-12 pb-6 px-4 sm:px-6 md:px-12 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-wrap items-center gap-y-4 mb-8 md:mb-10">
                <img src="{{ asset($webSetting->logo) }}" alt="Logo" class="h-12 sm:h-16 md:h-20 w-auto object-contain border-r border-gray-300 pr-4 mr-4 md:pr-6 md:mr-6">
                <div class="flex flex-col border-r border-gray-300 pr-4 mr-4 md:pr-6 md:mr-6">
                    <span class="text-xs sm:text-sm md:text-base font-bold text-gray-800 tracking-widest">{{ $webSetting->app_name }}</span>
                    <span class="text-[9px] sm:text-[10px] md:text-xs text-gray-600">国際交流基金</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-xs sm:text-sm font-semibold text-gray-800 tracking-wide">日本語能力試験</span>
                    <div class="flex items-baseline space-x-2">
                        <span class="text-2xl sm:text-3xl font-bold tracking-wider text-gray-900">JLPT</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 text-sm text-gray-600 mb-8 md:mb-10">
                <div>
                    <h4 class="font-bold text-gray-900 mb-2 md:mb-3 text-base">{{ $webSetting->app_name }}</h4>
                    <p class="leading-relaxed text-xs sm:text-sm">{!! nl2br(e($webSetting->address)) !!}</p>
                    <a href="mailto:{{ $webSetting->email }}" class="block mt-2 text-blue-600 hover:underline font-medium text-xs sm:text-sm">{{ $webSetting->email }}</a>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2 md:mb-3 text-base">Panduan Peserta</h4>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        <li><a href="{{ url('/kontak') }}" class="hover:text-blue-600 transition">Kontak Panitia</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2 md:mb-3 text-base">Bantuan</h4>
                    <ul class="space-y-2 text-xs sm:text-sm">
                        <li><a href="{{ url('/kontak') }}" class="hover:text-blue-600 transition">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900 mb-2 md:mb-3 text-base">Social Media</h4>
                    <div class="flex space-x-4 items-center text-gray-400">
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

    <!-- Script Dropdown Mobile -->
    <script>
        function toggleMobileMenu() {
            const dropdown = document.getElementById('mobile-dropdown');
            const icon = document.getElementById('mobile-menu-icon');
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        }

        document.addEventListener('click', function(event) {
            const btn = document.getElementById('mobile-menu-btn');
            const dropdown = document.getElementById('mobile-dropdown');
            const icon = document.getElementById('mobile-menu-icon');
            if (btn && dropdown && !btn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    </script>
</body>
</html>