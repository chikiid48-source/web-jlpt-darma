<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan JLPT - JLPT 2026</title>
    
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .latihan-content { display: none; opacity: 0; transition: opacity 0.3s ease-in-out; }
        .latihan-content.active { display: block; opacity: 1; }
        
        .sidebar-link { border-left: 4px solid transparent; transition: all 0.2s; }
        .sidebar-link.active { border-left-color: #0f3465; background-color: #f0fdfa; color: #0f3465; font-weight: 700; }
        .sidebar-link:hover:not(.active) { background-color: #f9fafb; border-left-color: #d1d5db; }

        .speech-bubble::before {
            content: ''; position: absolute; top: 20px; left: -10px;
            border-width: 10px 10px 10px 0; border-style: solid;
            border-color: transparent #f3f4f6 transparent transparent; display: block; width: 0;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col justify-between">

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


    <!-- KONTEN UTAMA -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-6 md:px-12 py-10 flex flex-col md:flex-row gap-8">
        
        <!-- SIDEBAR -->
        <aside class="w-full md:w-1/4 bg-white rounded-xl shadow-sm border border-gray-200 h-fit sticky top-24 overflow-hidden">
            <div class="bg-[#0f3465] px-5 py-4">
                <h2 class="text-white font-bold text-lg">Pilih Latihan</h2>
                <p class="text-blue-100 text-xs mt-1">Uji kemampuan bahasa Jepangmu</p>
            </div>
            <nav class="flex flex-col py-2">
                @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                <button onclick="switchLatihan('{{ $lvl }}')" id="btn-latihan-{{ $lvl }}" class="sidebar-link {{ $lvl == 'n5' ? 'active' : '' }} text-left px-5 py-3 text-gray-700 w-full font-medium uppercase">
                    Latihan {{ $lvl }}
                </button>
                @endforeach
            </nav>
        </aside>

        <!-- KONTEN KANAN -->
        <section class="w-full md:w-3/4">
            
            @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
            <!-- Konten Latihan Level -->
            <div id="content-latihan-{{ $lvl }}" class="latihan-content {{ $lvl == 'n5' ? 'active' : '' }}">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden relative">
                    <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-blue-50 to-transparent opacity-70"></div>
                    
                    <div class="p-8 md:p-12 relative z-10 flex flex-col md:flex-row items-center gap-8 md:gap-12">
                        
                        <div class="w-48 md:w-64 flex-shrink-0 flex justify-center">
                            <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" alt="Karakter JLPT" class="w-full h-auto object-contain drop-shadow-md rounded-lg">
                        </div>

                        <div class="flex-grow w-full">
                            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 text-sm text-gray-700 mb-8 relative speech-bubble shadow-sm">
                                <p class="mb-3 font-bold text-[#0f3465] text-lg uppercase border-b border-gray-200 pb-2">
                                    LATIHAN {{ $lvl }}
                                </p>
                                <p class="mb-3 font-medium text-gray-900 leading-relaxed text-base">
                                    ＿＿＿の ことばは ひらがなで どう かきますか。１・２・３・４から いちばん いい ものを ひとつ えらんで ください。
                                </p>
                                <p class="text-gray-500 italic">
                                    Question: From marked answers 1・2・3・4, choose the best answer.
                                </p>
                            </div>

                            <div class="flex flex-wrap items-center gap-6 mb-8 bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0fb398]"></div>
                                    <span class="ml-3 text-sm font-bold text-gray-700">Auto-next</span>
                                </label>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#0fb398]"></div>
                                    <span class="ml-3 text-sm font-bold text-gray-700">Test mode</span>
                                </label>
                            </div>

                            <div class="text-center md:text-left">
                                <!-- Tombol Start mengarah ke route dinamis kuis -->
                                <a href="{{ route('kuis', ['level' => $lvl]) }}" class="bg-[#0f3465] text-white px-10 py-3.5 rounded-full font-black text-lg tracking-wide hover:bg-blue-800 transition shadow-lg transform hover:-translate-y-1 inline-block">
                                    START NOW
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </section>
    </main>

    <!-- FOOTER STANDAR -->
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

    <script>
        function switchLatihan(level) {
            document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.latihan-content').forEach(content => content.classList.remove('active'));
            
            document.getElementById('btn-latihan-' + level).classList.add('active');
            document.getElementById('content-latihan-' + level).classList.add('active');
        }
    </script>
</body>
</html>