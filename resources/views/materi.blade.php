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
                <h2 class="text-white font-bold text-lg">Pilih Level</h2>
                <p class="text-blue-100 text-xs mt-1">E-Learning Persiapan JLPT</p>
            </div>
            <nav class="flex flex-col py-2">
                @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                <button onclick="switchMateri('{{ $lvl }}')" id="btn-materi-{{ $lvl }}" class="sidebar-link {{ $lvl == 'n5' ? 'active' : '' }} text-left px-5 py-3 text-gray-700 w-full font-medium uppercase">
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
                        <h2 class="text-2xl font-bold text-[#0f3465] uppercase">MATERI {{ $lvl }}</h2>
                        <p class="text-gray-500 text-sm mt-1">Pelajari materi di bawah ini secara langsung.</p>
                    </div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">{{ $mData->count() }} Modul</span>
                </div>

                @if($mData->count() > 0)
                    <!-- PEMBUNGKUS MATERI (BERDERET KE BAWAH) -->
                    <div class="flex flex-col gap-10">
                        @foreach($mData as $index => $m)
                        <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                            <!-- Header Materi -->
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <div>
                                    <h3 class="font-black text-xl text-gray-900">{{ $m->title }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $m->description ?? 'Modul pembelajaran untuk dipelajari.' }}</p>
                                </div>
                                @if($m->type == 'pdf')
                                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded shadow-sm">PDF FILE</span>
                                @else
                                    <span class="bg-red-600 text-white text-xs font-bold px-3 py-1 rounded shadow-sm flex items-center gap-1"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M21.582 6.186a2.685 2.685 0 00-1.884-1.895C18.038 3.85 12 3.85 12 3.85s-6.038 0-7.698.441a2.684 2.684 0 00-1.884 1.895C2 7.854 2 12 2 12s0 4.146.418 5.814a2.685 2.685 0 001.884 1.895C6.038 20.15 12 20.15 12 20.15s6.038 0 7.698-.441a2.685 2.685 0 001.884-1.895c.418-1.668.418-5.814.418-5.814s0-4.146-.418-5.814z"/><path fill="white" d="M9.99 15.584V8.416L15.817 12l-5.827 3.584z"/></svg> VIDEO</span>
                                @endif
                            </div>
                            
                            <!-- Konten Embed Langsung Terbuka -->
                            <div class="w-full bg-gray-100">
                                @if($m->type == 'pdf')
                                    <iframe src="{{ asset($m->file_url) }}" class="w-full" style="height: 700px;" frameborder="0"></iframe>
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
                    <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-xl p-10 text-center flex flex-col items-center justify-center">
                        <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <h3 class="text-lg font-bold text-gray-700">Belum Ada Materi</h3>
                        <p class="text-sm text-gray-500 mt-1 max-w-md">Admin belum mengunggah materi untuk Level {{ strtoupper($lvl) }}.</p>
                    </div>
                @endif
            </div>
            @endforeach

        </section>
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
    <script>
        function switchMateri(level) {
            document.querySelectorAll('.sidebar-link').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.materi-content').forEach(content => content.classList.remove('active'));
            document.getElementById('btn-materi-' + level).classList.add('active');
            document.getElementById('content-materi-' + level).classList.add('active');
            window.scrollTo({ top: 0, behavior: 'smooth' }); // Scroll ke atas saat ganti level
        }
    </script>
</body>
</html>