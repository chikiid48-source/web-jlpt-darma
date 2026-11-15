<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - JLPT 2026</title>
    
    <link rel="icon" href="{{ asset($webSetting->logo ?? 'images/logo-baru.jpg') }}" type="image/jpeg">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- HEADER RESPONSIVE (Desktop & Mobile) -->
    <header class="w-full border-b border-gray-100 py-3 px-4 sm:px-6 md:px-12 flex items-center justify-between bg-white/95 backdrop-blur-sm sticky top-0 z-50 shadow-sm transition-all">
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

        <!-- MENU DESKTOP -->
        <nav class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-700">
            <a href="{{ url('/') }}" class="text-gray-600 hover:text-[#003366] transition">Beranda</a>
            <a href="{{ url('/materi') }}" class="text-gray-600 hover:text-[#003366] transition">Materi</a>
            <a href="{{ url('/latihan') }}" class="text-gray-600 hover:text-[#003366] transition">Latihan</a>
            <a href="{{ url('/lokasi') }}" class="text-gray-600 hover:text-[#003366] transition">Lokasi Ujian</a>
            <a href="{{ url('/kontak') }}" class="text-gray-600 hover:text-[#003366] transition">Kontak</a>
            
            <div class="flex items-center space-x-3 border-l border-gray-300 pl-6">
                <a href="{{ url('/register') }}" class="flex items-center space-x-2 border border-gray-300 px-5 py-2 rounded-full hover:bg-gray-50 transition text-[#0f3465] font-semibold text-sm shadow-sm">
                    <span>Daftar</span>
                </a>
            </div>
        </nav>

        <!-- MENU MOBILE (Kotak Dropdown + Tombol Bulat Daftar) -->
        <div class="flex md:hidden items-center space-x-2 relative">
            <div class="relative">
                <button onclick="toggleMobileMenu()" id="mobile-menu-btn" class="flex items-center justify-between space-x-2 border border-gray-300 bg-gray-50 hover:bg-gray-100 text-[#0f3465] px-3 py-2 rounded-lg text-xs font-bold shadow-sm transition">
                    <span>Menu</span>
                    <svg id="mobile-menu-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="mobile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden">
                    <a href="{{ url('/') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Beranda</a>
                    <a href="{{ url('/materi') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Materi</a>
                    <a href="{{ url('/latihan') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Latihan</a>
                    <a href="{{ url('/lokasi') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Lokasi Ujian</a>
                    <a href="{{ url('/kontak') }}" class="block px-4 py-2.5 text-xs font-semibold text-gray-700 hover:bg-gray-50">Kontak</a>
                </div>
            </div>

            <!-- Tombol Bulat Daftar Akun di Mobile -->
            <a href="{{ url('/register') }}" title="Daftar Akun" class="w-9 h-9 rounded-full border border-blue-200 bg-blue-50 text-[#0f3465] hover:bg-[#0f3465] hover:text-white flex items-center justify-center shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </a>
        </div>
    </header>

    <!-- KONTEN UTAMA: KARAKTER KIRI & FORM LOGIN KANAN -->
    <main class="flex-grow flex items-center justify-center w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-12 py-8 md:py-14">
        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            
            <!-- SISI KIRI: Karakter Pink Biasa -->
            <div class="lg:col-span-6 flex justify-center items-center">
                <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" 
                     alt="Karakter JLPT" 
                     class="w-56 sm:w-72 md:w-80 lg:w-full lg:max-w-md h-auto object-contain">
            </div>

            <!-- SISI KANAN: Kotak Form Masuk Akun -->
            <div class="lg:col-span-6 flex justify-center lg:justify-end w-full">
                <div class="w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    
                    <!-- Header Card Login -->
                    <div class="bg-[#0f3465] px-6 py-7 sm:py-8 text-center">
                        <h1 class="text-xl sm:text-2xl font-extrabold text-white tracking-wide">Masuk Akun</h1>
                        <p class="text-xs sm:text-sm text-[#c3a45c] font-semibold mt-1">日本語能力試験 - JLPT 2026</p>
                    </div>

                    <div class="p-6 sm:p-8">
                        <!-- Pesan Error Validasi Login -->
                        @if ($errors->any())
                            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-xs sm:text-sm font-semibold text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="{{ url('/login') }}" method="POST" class="space-y-5">
                            @csrf
                            <div>
                                <label for="email" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="Masukkan email Anda"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0f3465] focus:border-[#0f3465] outline-none transition bg-gray-50 focus:bg-white">
                            </div>

                            <div>
                                <label for="password" class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Password</label>
                                <input type="password" id="password" name="password" required
                                    placeholder="Masukkan password Anda"
                                    class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0f3465] focus:border-[#0f3465] outline-none transition bg-gray-50 focus:bg-white">
                            </div>

                            <button type="submit"
                                class="w-full bg-[#0f3465] hover:bg-[#0a2347] text-white font-bold py-3.5 rounded-xl text-sm sm:text-base shadow-md hover:shadow-lg transition transform hover:-translate-y-0.5 cursor-pointer">
                                Masuk Sekarang
                            </button>
                        </form>

                        <!-- Link ke Halaman Register -->
                        <div class="mt-6 pt-6 border-t border-gray-100 text-center text-xs sm:text-sm text-gray-600">
                            Belum punya akun peserta?
                            <a href="{{ url('/register') }}" class="font-bold text-[#0f3465] hover:underline ml-1">
                                Daftar di sini
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER RESPONSIVE -->
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