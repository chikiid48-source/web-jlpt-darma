<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Karakter - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .japanese-char { font-family: 'Hiragino Kaku Gothic Pro', 'Meiryo', sans-serif; }
        .char-card {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 0.65rem 0.4rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            background-color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        @media (min-width: 640px) {
            .char-card { padding: 1rem; }
        }
        .char-card:hover {
            border-color: #1cb0f6;
            background-color: #f0f9ff;
        }
        .char-line {
            width: 100%;
            height: 4px;
            border-radius: 9999px;
            margin-top: 0.5rem;
        }
        .line-gold { background-color: #ffc800; }
        .line-gray { background-color: #e5e7eb; }
        
        .tab-btn {
            padding: 0.75rem 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            color: #9ca3af;
            transition: color 0.2s;
            margin-bottom: -2px;
            border-bottom: 3px solid transparent;
        }
        @media (min-width: 640px) {
            .tab-btn { padding: 0.75rem 2rem; font-size: 0.875rem; }
        }
        .tab-btn:hover { color: #4b5563; }
        .tab-btn.active {
            color: #0f3465;
            border-bottom-color: #c8a556;
        }
        .tab-content { display: none; }
        .tab-content.active { display: block; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar Responsive -->
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
                    <a href="{{ url('/lokasi-ujian') }}" class="block px-4 py-2.5 text-xs font-semibold {{ request()->is('lokasi*') ? 'bg-blue-50 text-[#0f3465] border-l-4 border-[#0f3465]' : 'text-gray-700 hover:bg-gray-50' }}">
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

    <!-- KONTEN UTAMA: LATIHAN HURUF -->
    <main class="flex-grow w-full max-w-4xl mx-auto px-4 sm:px-6 py-6 md:py-8">
        
        <!-- Tabs Navigasi -->
        <div class="flex justify-center border-b-2 border-gray-200 mb-8">
            <button onclick="switchTab('hiragana')" id="tab-hiragana" class="tab-btn active">HIRAGANA</button>
            <button onclick="switchTab('katakana')" id="tab-katakana" class="tab-btn">KATAKANA</button>
            <button class="tab-btn">KANJI</button>
        </div>

        <!-- ==================== TAB HIRAGANA ==================== -->
        <div id="content-hiragana" class="tab-content active">
            <div class="text-center mb-8 md:mb-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 md:mb-3">Mari Belajar Hiragana!</h1>
                <p class="text-xs sm:text-sm md:text-base text-gray-500 font-medium mb-6 md:mb-8">Kenali sistem penulisan utama dalam bahasa Jepang</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <button class="w-full sm:w-auto px-10 py-3 rounded-full border-2 border-[#e5e7eb] text-gray-500 font-bold hover:bg-gray-50 transition shadow-sm uppercase text-xs sm:text-sm">
                        TIPS
                    </button>
                    <a href="{{ route('latihan.kuis') }}" class="w-full sm:w-auto px-10 py-3 rounded-full bg-[#1cb0f6] border-b-4 border-[#1899d6] text-white font-bold hover:bg-[#1899d6] transition uppercase text-xs sm:text-sm inline-block text-center">
                        PELAJARI KARAKTER
                    </a>
                </div>
            </div>

            <!-- Grid Karakter Hiragana -->
            <div class="grid grid-cols-5 gap-2 sm:gap-3 md:gap-4 max-w-2xl mx-auto mb-12 md:mb-16">
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">あ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">a</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">い</span><span class="text-xs sm:text-sm font-semibold text-gray-400">i</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">う</span><span class="text-xs sm:text-sm font-semibold text-gray-400">u</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">え</span><span class="text-xs sm:text-sm font-semibold text-gray-400">e</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">お</span><span class="text-xs sm:text-sm font-semibold text-gray-400">o</span><div class="char-line line-gold"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">か</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ka</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">き</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ki</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">く</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ku</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">け</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ke</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">こ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ko</span><div class="char-line line-gold"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">さ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">sa</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">し</span><span class="text-xs sm:text-sm font-semibold text-gray-400">shi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">す</span><span class="text-xs sm:text-sm font-semibold text-gray-400">su</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">せ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">se</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">そ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">so</span><div class="char-line line-gray"></div></div>
                
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">た</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ta</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ち</span><span class="text-xs sm:text-sm font-semibold text-gray-400">chi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">つ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">tsu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">て</span><span class="text-xs sm:text-sm font-semibold text-gray-400">te</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">と</span><span class="text-xs sm:text-sm font-semibold text-gray-400">to</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">な</span><span class="text-xs sm:text-sm font-semibold text-gray-400">na</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ni</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ni</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ぬ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">nu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ね</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ne</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">の</span><span class="text-xs sm:text-sm font-semibold text-gray-400">no</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">は</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ha</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ひ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">hi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ふ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">fu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">へ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">he</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ほ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ho</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ま</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ma</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">み</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">む</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">め</span><span class="text-xs sm:text-sm font-semibold text-gray-400">me</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">も</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">や</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ya</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ゆ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">yu</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">よ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">yo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ら</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ra</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">り</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ri</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">る</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ru</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">れ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">re</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ろ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ro</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">わ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">wa</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">を</span><span class="text-xs sm:text-sm font-semibold text-gray-400">wo</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ん</span><span class="text-xs sm:text-sm font-semibold text-gray-400">n</span><div class="char-line line-gray"></div></div>
            </div>
        </div>

        <!-- ==================== TAB KATAKANA ==================== -->
        <div id="content-katakana" class="tab-content">
            <div class="text-center mb-8 md:mb-10">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-900 mb-2 md:mb-3">Mari Belajar Katakana!</h1>
                <p class="text-xs sm:text-sm md:text-base text-gray-500 font-medium mb-6 md:mb-8">Kenali sistem penulisan untuk kata serapan asing</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <button class="w-full sm:w-auto px-10 py-3 rounded-full border-2 border-[#e5e7eb] text-gray-500 font-bold hover:bg-gray-50 transition shadow-sm uppercase text-xs sm:text-sm">
                        TIPS
                    </button>
                    <a href="{{ route('latihan.kuis') }}" class="w-full sm:w-auto px-10 py-3 rounded-full bg-[#1cb0f6] border-b-4 border-[#1899d6] text-white font-bold hover:bg-[#1899d6] transition uppercase text-xs sm:text-sm inline-block text-center">
                        PELAJARI KARAKTER
                    </a>
                </div>
            </div>

            <!-- Grid Karakter Katakana -->
            <div class="grid grid-cols-5 gap-2 sm:gap-3 md:gap-4 max-w-2xl mx-auto mb-12 md:mb-16">
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ア</span><span class="text-xs sm:text-sm font-semibold text-gray-400">a</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">イ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">i</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ウ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">u</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">エ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">e</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">オ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">o</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">カ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ka</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">キ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ki</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ク</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ku</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ケ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ke</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">コ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ko</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">サ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">sa</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">シ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">shi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ス</span><span class="text-xs sm:text-sm font-semibold text-gray-400">su</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">セ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">se</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ソ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">so</span><div class="char-line line-gray"></div></div>
                
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">タ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ta</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">チ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">chi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ツ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">tsu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">テ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">te</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ト</span><span class="text-xs sm:text-sm font-semibold text-gray-400">to</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ナ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">na</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ニ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ni</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヌ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">nu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ネ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ne</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ノ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">no</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ハ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ha</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヒ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">hi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">フ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">fu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヘ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">he</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ホ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ho</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">マ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ma</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ミ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ム</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">メ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">me</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">モ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">mo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヤ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ya</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ユ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">yu</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヨ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">yo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ラ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ra</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">リ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ri</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ル</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ru</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">レ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">re</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ロ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">ro</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ワ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">wa</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ヲ</span><span class="text-xs sm:text-sm font-semibold text-gray-400">wo</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-2xl sm:text-3xl font-bold mb-1 japanese-char">ン</span><span class="text-xs sm:text-sm font-semibold text-gray-400">n</span><div class="char-line line-gray"></div></div>
            </div>
        </div>

    </main>

    <!-- Footer -->
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
        function switchTab(tabName) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            
            document.getElementById('tab-' + tabName).classList.add('active');
            document.getElementById('content-' + tabName).classList.add('active');
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