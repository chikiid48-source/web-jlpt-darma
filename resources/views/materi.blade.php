<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materi Pembelajaran - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .materi-content { display: none; opacity: 0; transition: opacity 0.3s ease-in-out; }
        .materi-content.active { display: block; opacity: 1; }
        .sidebar-link { border-left: 4px solid transparent; transition: all 0.2s; }
        .sidebar-link.active { border-left-color: #0f3465; background-color: #f0fdfa; color: #0f3465; font-weight: 700; }
        .sidebar-link:hover:not(.active) { background-color: #f9fafb; border-left-color: #d1d5db; }
        
        /* CSS Untuk Video YouTube agar Responsive */
        .video-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 0.75rem; }
        .video-container iframe { position: absolute; top:0; left: 0; width: 100%; height: 100%; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- HEADER RESPONSIVE -->
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

    <!-- KONTEN UTAMA -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 md:px-12 py-6 md:py-10 flex flex-col md:flex-row gap-6 md:gap-8">
        
        <!-- SIDEBAR -->
        <aside class="w-full md:w-1/4 bg-white rounded-xl shadow-sm border border-gray-200 h-fit md:sticky md:top-24 overflow-hidden">
            <div class="bg-[#0f3465] px-5 py-4">
                <h2 class="text-white font-bold text-base md:text-lg">Pilih Level</h2>
                <p class="text-blue-100 text-xs mt-1">E-Learning Persiapan JLPT</p>
            </div>
            <nav class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-col py-2">
                @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                <button onclick="switchMateri('{{ $lvl }}')" id="btn-materi-{{ $lvl }}" class="sidebar-link {{ $lvl == 'n5' ? 'active' : '' }} text-left px-4 md:px-5 py-3 text-xs sm:text-sm md:text-base text-gray-700 w-full font-medium uppercase">
                    Materi {{ $lvl }}
                </button>
                @endforeach
            </nav>
        </aside>

        <!-- KONTEN KANAN (TAMPILAN MATERI TERBUKA) -->
        <section class="w-full md:w-3/4">
            
            @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
            @php $mData = ${'materis' . strtoupper($lvl)}; @endphp
            
            <div id="content-materi-{{ $lvl }}" class="materi-content {{ $lvl == 'n5' ? 'active' : '' }}">
                <div class="mb-6 border-b border-gray-200 pb-3 flex justify-between items-end">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-bold text-[#0f3465] uppercase">MATERI {{ $lvl }}</h2>
                        <p class="text-gray-500 text-xs sm:text-sm mt-1">Pelajari materi di bawah ini secara langsung.</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full flex-shrink-0">{{ $mData->count() }} Modul</span>
                </div>

                @if($mData->count() > 0)
                    <div class="flex flex-col gap-6 md:gap-10">
                        @foreach($mData as $index => $m)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                            <!-- Header Materi -->
                            <div class="bg-gray-50 px-4 sm:px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">
                                <div>
                                    <h3 class="font-black text-base sm:text-xl text-gray-900">{{ $m->title }}</h3>
                                    <p class="text-xs sm:text-sm text-gray-600 mt-1">{{ $m->description ?? 'Modul pembelajaran untuk dipelajari.' }}</p>
                                </div>
                                <div class="self-start sm:self-auto flex-shrink-0">
                                    @if($m->type == 'pdf')
                                        <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded shadow-sm inline-block">PDF FILE</span>
                                    @else
                                        <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded shadow-sm flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M21.582 6.186a2.685 2.685 0 00-1.884-1.895C18.038 3.85 12 3.85 12 3.85s-6.038 0-7.698.441a2.684 2.684 0 00-1.884 1.895C2 7.854 2 12 2 12s0 4.146.418 5.814a2.685 2.685 0 001.884 1.895C6.038 20.15 12 20.15 12 20.15s6.038 0 7.698-.441a2.685 2.685 0 001.884-1.895c.418-1.668.418-5.814.418-5.814s0-4.146-.418-5.814z"/><path fill="white" d="M9.99 15.584V8.416L15.817 12l-5.827 3.584z"/></svg> VIDEO</span>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Konten Embed Langsung Terbuka -->
                            <div class="w-full bg-gray-100">
                                @if($m->type == 'pdf')
                                    <iframe src="{{ asset($m->file_url) }}" class="w-full h-[450px] sm:h-[600px] md:h-[700px]" frameborder="0"></iframe>
                                @else
                                    <div class="video-container">
                                        <iframe src="{{ $m->file_url }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-8 sm:p-10 text-center flex flex-col items-center justify-center">
                        <svg class="w-12 h-12 sm:w-16 sm:h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <h3 class="text-base sm:text-lg font-bold text-gray-700">Belum Ada Materi</h3>
                        <p class="text-xs sm:text-sm text-gray-500 mt-1 max-w-md">Admin belum mengunggah materi untuk Level {{ strtoupper($lvl) }}.</p>
                    </div>
                @endif
            </div>
            @endforeach

        </section>
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
        function switchMateri(level) {
            document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.materi-content').forEach(content => content.classList.remove('active'));
            document.getElementById('btn-materi-' + level).classList.add('active');
            document.getElementById('content-materi-' + level).classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

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