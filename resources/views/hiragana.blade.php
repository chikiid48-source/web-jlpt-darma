<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Karakter - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .japanese-char {
            font-family: 'Hiragino Kaku Gothic Pro', 'Meiryo', sans-serif;
        }
        .char-card {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            background-color: white;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }
        .char-card:hover {
            border-color: #1cb0f6;
            background-color: #f0f9ff;
        }
        .char-line {
            width: 100%;
            height: 4px;
            border-radius: 9999px;
            margin-top: 0.75rem;
        }
        .line-gold { background-color: #ffc800; }
        .line-gray { background-color: #e5e7eb; }
        
        .tab-btn {
            padding: 0.75rem 2rem;
            font-size: 0.875rem;
            font-weight: 700;
            color: #9ca3af;
            transition: color 0.2s;
            margin-bottom: -2px;
            border-bottom: 3px solid transparent;
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

    <!-- Header / Navbar -->
    <header class="w-full border-b border-gray-100 py-3 px-6 md:px-12 flex items-center justify-between bg-white/95 backdrop-blur-sm sticky top-0 z-50 shadow-sm transition-all">
        <div class="flex items-center">
            <img src="{{ asset($webSetting->logo) }}" alt="Logo Web" class="h-10 md:h-12 w-auto object-contain border-r border-gray-300 pr-4 mr-4">
            <div class="flex items-center space-x-4">
                <div class="flex flex-col hidden sm:flex">
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
    </header>

    <!-- KONTEN UTAMA: LATIHAN HURUF -->
    <main class="flex-grow w-full max-w-4xl mx-auto px-6 py-8">
        
        <!-- Tabs Navigasi -->
        <div class="flex justify-center border-b-2 border-gray-200 mb-8">
            <button onclick="switchTab('hiragana')" id="tab-hiragana" class="tab-btn active">HIRAGANA</button>
            <button onclick="switchTab('katakana')" id="tab-katakana" class="tab-btn">KATAKANA</button>
            <button class="tab-btn">KANJI</button>
        </div>

        <!-- ==================== TAB HIRAGANA ==================== -->
        <div id="content-hiragana" class="tab-content active">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">Mari Belajar Hiragana!</h1>
                <p class="text-gray-500 font-medium mb-8">Kenali sistem penulisan utama dalam bahasa Jepang</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <button class="w-full sm:w-auto px-10 py-3 rounded-full border-2 border-[#e5e7eb] text-gray-500 font-bold hover:bg-gray-50 transition shadow-sm uppercase text-sm">
                        TIPS
                    </button>
                    <a href="{{ route('latihan.kuis') }}" class="w-full sm:w-auto px-10 py-3 rounded-full bg-[#1cb0f6] border-b-4 border-[#1899d6] text-white font-bold hover:bg-[#1899d6] transition uppercase text-sm inline-block text-center">
                        PELAJARI KARAKTER
                    </a>
                </div>
            </div>

            <!-- Grid Karakter Hiragana -->
            <div class="grid grid-cols-5 gap-3 md:gap-4 max-w-2xl mx-auto mb-16">
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">あ</span><span class="text-sm font-semibold text-gray-400">a</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">い</span><span class="text-sm font-semibold text-gray-400">i</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">う</span><span class="text-sm font-semibold text-gray-400">u</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">え</span><span class="text-sm font-semibold text-gray-400">e</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">お</span><span class="text-sm font-semibold text-gray-400">o</span><div class="char-line line-gold"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">か</span><span class="text-sm font-semibold text-gray-400">ka</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">き</span><span class="text-sm font-semibold text-gray-400">ki</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">く</span><span class="text-sm font-semibold text-gray-400">ku</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">け</span><span class="text-sm font-semibold text-gray-400">ke</span><div class="char-line line-gold"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">こ</span><span class="text-sm font-semibold text-gray-400">ko</span><div class="char-line line-gold"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">さ</span><span class="text-sm font-semibold text-gray-400">sa</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">し</span><span class="text-sm font-semibold text-gray-400">shi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">す</span><span class="text-sm font-semibold text-gray-400">su</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">せ</span><span class="text-sm font-semibold text-gray-400">se</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">そ</span><span class="text-sm font-semibold text-gray-400">so</span><div class="char-line line-gray"></div></div>
                
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">た</span><span class="text-sm font-semibold text-gray-400">ta</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ち</span><span class="text-sm font-semibold text-gray-400">chi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">つ</span><span class="text-sm font-semibold text-gray-400">tsu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">て</span><span class="text-sm font-semibold text-gray-400">te</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">と</span><span class="text-sm font-semibold text-gray-400">to</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">な</span><span class="text-sm font-semibold text-gray-400">na</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">に</span><span class="text-sm font-semibold text-gray-400">ni</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ぬ</span><span class="text-sm font-semibold text-gray-400">nu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ね</span><span class="text-sm font-semibold text-gray-400">ne</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">の</span><span class="text-sm font-semibold text-gray-400">no</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">は</span><span class="text-sm font-semibold text-gray-400">ha</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ひ</span><span class="text-sm font-semibold text-gray-400">hi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ふ</span><span class="text-sm font-semibold text-gray-400">fu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">へ</span><span class="text-sm font-semibold text-gray-400">he</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ほ</span><span class="text-sm font-semibold text-gray-400">ho</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ま</span><span class="text-sm font-semibold text-gray-400">ma</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">み</span><span class="text-sm font-semibold text-gray-400">mi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">む</span><span class="text-sm font-semibold text-gray-400">mu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">め</span><span class="text-sm font-semibold text-gray-400">me</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">も</span><span class="text-sm font-semibold text-gray-400">mo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">や</span><span class="text-sm font-semibold text-gray-400">ya</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ゆ</span><span class="text-sm font-semibold text-gray-400">yu</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">よ</span><span class="text-sm font-semibold text-gray-400">yo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ら</span><span class="text-sm font-semibold text-gray-400">ra</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">り</span><span class="text-sm font-semibold text-gray-400">ri</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">る</span><span class="text-sm font-semibold text-gray-400">ru</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">れ</span><span class="text-sm font-semibold text-gray-400">re</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ろ</span><span class="text-sm font-semibold text-gray-400">ro</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">わ</span><span class="text-sm font-semibold text-gray-400">wa</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">を</span><span class="text-sm font-semibold text-gray-400">wo</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ん</span><span class="text-sm font-semibold text-gray-400">n</span><div class="char-line line-gray"></div></div>
            </div>
        </div>

        <!-- ==================== TAB KATAKANA ==================== -->
        <div id="content-katakana" class="tab-content">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-3">Mari Belajar Katakana!</h1>
                <p class="text-gray-500 font-medium mb-8">Kenali sistem penulisan untuk kata serapan asing</p>
                
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-3 sm:space-y-0 sm:space-x-4">
                    <button class="w-full sm:w-auto px-10 py-3 rounded-full border-2 border-[#e5e7eb] text-gray-500 font-bold hover:bg-gray-50 transition shadow-sm uppercase text-sm">
                        TIPS
                    </button>
                    <a href="{{ route('latihan.kuis') }}" class="w-full sm:w-auto px-10 py-3 rounded-full bg-[#1cb0f6] border-b-4 border-[#1899d6] text-white font-bold hover:bg-[#1899d6] transition uppercase text-sm inline-block text-center">
                        PELAJARI KARAKTER
                    </a>
                </div>
            </div>

            <!-- Grid Karakter Katakana -->
            <div class="grid grid-cols-5 gap-3 md:gap-4 max-w-2xl mx-auto mb-16">
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ア</span><span class="text-sm font-semibold text-gray-400">a</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">イ</span><span class="text-sm font-semibold text-gray-400">i</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ウ</span><span class="text-sm font-semibold text-gray-400">u</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">エ</span><span class="text-sm font-semibold text-gray-400">e</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">オ</span><span class="text-sm font-semibold text-gray-400">o</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">カ</span><span class="text-sm font-semibold text-gray-400">ka</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">キ</span><span class="text-sm font-semibold text-gray-400">ki</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ク</span><span class="text-sm font-semibold text-gray-400">ku</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ケ</span><span class="text-sm font-semibold text-gray-400">ke</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">コ</span><span class="text-sm font-semibold text-gray-400">ko</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">サ</span><span class="text-sm font-semibold text-gray-400">sa</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">シ</span><span class="text-sm font-semibold text-gray-400">shi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ス</span><span class="text-sm font-semibold text-gray-400">su</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">セ</span><span class="text-sm font-semibold text-gray-400">se</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ソ</span><span class="text-sm font-semibold text-gray-400">so</span><div class="char-line line-gray"></div></div>
                
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">タ</span><span class="text-sm font-semibold text-gray-400">ta</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">チ</span><span class="text-sm font-semibold text-gray-400">chi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ツ</span><span class="text-sm font-semibold text-gray-400">tsu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">テ</span><span class="text-sm font-semibold text-gray-400">te</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ト</span><span class="text-sm font-semibold text-gray-400">to</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ナ</span><span class="text-sm font-semibold text-gray-400">na</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ニ</span><span class="text-sm font-semibold text-gray-400">ni</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヌ</span><span class="text-sm font-semibold text-gray-400">nu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ネ</span><span class="text-sm font-semibold text-gray-400">ne</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ノ</span><span class="text-sm font-semibold text-gray-400">no</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ハ</span><span class="text-sm font-semibold text-gray-400">ha</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヒ</span><span class="text-sm font-semibold text-gray-400">hi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">フ</span><span class="text-sm font-semibold text-gray-400">fu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヘ</span><span class="text-sm font-semibold text-gray-400">he</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ホ</span><span class="text-sm font-semibold text-gray-400">ho</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">マ</span><span class="text-sm font-semibold text-gray-400">ma</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ミ</span><span class="text-sm font-semibold text-gray-400">mi</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ム</span><span class="text-sm font-semibold text-gray-400">mu</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">メ</span><span class="text-sm font-semibold text-gray-400">me</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">モ</span><span class="text-sm font-semibold text-gray-400">mo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヤ</span><span class="text-sm font-semibold text-gray-400">ya</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ユ</span><span class="text-sm font-semibold text-gray-400">yu</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヨ</span><span class="text-sm font-semibold text-gray-400">yo</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ラ</span><span class="text-sm font-semibold text-gray-400">ra</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">リ</span><span class="text-sm font-semibold text-gray-400">ri</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ル</span><span class="text-sm font-semibold text-gray-400">ru</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">レ</span><span class="text-sm font-semibold text-gray-400">re</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ロ</span><span class="text-sm font-semibold text-gray-400">ro</span><div class="char-line line-gray"></div></div>

                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ワ</span><span class="text-sm font-semibold text-gray-400">wa</span><div class="char-line line-gray"></div></div>
                <div></div>
                <div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ヲ</span><span class="text-sm font-semibold text-gray-400">wo</span><div class="char-line line-gray"></div></div>
                <div class="char-card"><span class="text-3xl font-bold mb-1 japanese-char">ン</span><span class="text-sm font-semibold text-gray-400">n</span><div class="char-line line-gray"></div></div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="w-full bg-[#fafafa] border-t border-gray-200 pt-12 pb-6 px-6 md:px-12 mt-auto">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center mb-10">
                <img src="{{ asset($webSetting->logo) }}" alt="Logo" class="h-16 md:h-20 w-auto object-contain border-r border-gray-300 pr-6 mr-6">
                <div class="flex flex-col border-r border-gray-300 pr-6 mr-6">
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
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            document.getElementById('tab-' + tabName).classList.add('active');
            document.getElementById('content-' + tabName).classList.add('active');
        }
    </script>
</body>
</html>