<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - JLPT 2026</title>
    <!-- Favicon Dinamis -->
    <link rel="icon" href="{{ asset($webSetting->logo) }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- HEADER DINAMIS (Responsive Desktop & Mobile) -->
    <header class="w-full border-b border-gray-100 py-3 px-4 sm:px-6 md:px-12 flex items-center justify-between bg-white/95 backdrop-blur-sm sticky top-0 z-50 shadow-sm transition-all">
        <div class="flex items-center">
            <!-- Panggil Logo dari Database -->
            <img src="{{ asset($webSetting->logo) }}" alt="Logo Web" class="h-9 sm:h-10 md:h-12 w-auto object-contain border-r border-gray-300 pr-3 mr-3 md:pr-4 md:mr-4">
            <div class="flex items-center space-x-3 md:space-x-4">
                <div class="hidden sm:flex flex-col">
                    <!-- Panggil Nama App dari Database -->
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
            <a href="{{ url('/lokasi') }}"
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

        <!-- MENU MOBILE (Kotak Dropdown + Lingkaran Logout) -->
        <div class="flex md:hidden items-center space-x-2 relative">
            <div class="relative">
                <button onclick="toggleMobileMenu()" id="mobile-menu-btn" class="flex items-center justify-between space-x-2 border border-gray-300 bg-gray-50 hover:bg-gray-100 text-[#0f3465] px-3 py-2 rounded-lg text-xs font-bold shadow-sm transition">
                    <span>Menu</span>
                    <svg id="mobile-menu-icon" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

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
                    <a href="{{ url('/lokasi') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('lokasi*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Lokasi Ujian
                    </a>
                    <a href="{{ url('/kontak') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('kontak*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
                        Kontak
                    </a>
                </div>
            </div>

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

    <!-- KONTEN UTAMA KONTAK -->
    <main class="flex-grow w-full max-w-4xl mx-auto px-4 sm:px-6 py-8 md:py-12">
        <div class="text-center mb-8 md:mb-10">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-black text-[#0f3465] tracking-tight mb-3 md:mb-4">Hubungi Kami</h1>
            <p class="text-xs sm:text-sm md:text-base text-gray-600 max-w-xl mx-auto">Punya pertanyaan seputar JLPT? Silakan kirimkan pesan Anda melalui formulir di bawah ini.</p>
        </div>

        <!-- Notifikasi Sukses Kirim Pesan -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 text-xs sm:text-sm font-semibold text-center shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Action diarahkan ke route kontak.submit -->
            <form action="{{ route('kontak.submit') }}" method="POST" class="p-5 sm:p-8 md:p-10 space-y-5 md:space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                    <div>
                        <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="Tulis nama Anda">
                    </div>
                    <div>
                        <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="email@contoh.com">
                    </div>
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Lokasi Ujian (Opsional)</label>
                    <input type="text" name="location" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" placeholder="Misal: Universitas Darmajaya, Lampung">
                </div>
                <div>
                    <label class="block text-xs sm:text-sm font-bold text-gray-700 mb-2">Pesan / Pertanyaan</label>
                    <textarea name="message" rows="5" class="w-full px-4 py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="Tuliskan pertanyaan Anda secara detail di sini..."></textarea>
                </div>
                
                <button type="submit" class="w-full bg-[#0f3465] text-white py-3.5 md:py-4 rounded-xl font-bold text-base md:text-lg hover:bg-teal-600 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </main>

    <!-- FOOTER DINAMIS RESPONSIVE -->
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