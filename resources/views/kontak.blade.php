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

    <!-- HEADER DINAMIS -->
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

    <!-- KONTEN UTAMA KONTAK -->
    <main class="flex-grow w-full max-w-4xl mx-auto px-6 py-12">
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-black text-[#0f3465] tracking-tight mb-4">Hubungi Kami</h1>
            <p class="text-gray-600 max-w-xl mx-auto">Punya pertanyaan seputar JLPT? Silakan kirimkan pesan Anda melalui formulir di bawah ini.</p>
        </div>

        <!-- Notifikasi Sukses Kirim Pesan -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6 font-semibold text-center shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <!-- Form Action diarahkan ke route kontak.submit -->
            <form action="{{ route('kontak.submit') }}" method="POST" class="p-8 md:p-10 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="Tulis nama Anda">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="email@contoh.com">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi Ujian (Opsional)</label>
                    <input type="text" name="location" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" placeholder="Misal: Universitas Darmajaya, Lampung">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pesan / Pertanyaan</label>
                    <textarea name="message" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-[#0fb398] outline-none transition bg-gray-50 focus:bg-white" required placeholder="Tuliskan pertanyaan Anda secara detail di sini..."></textarea>
                </div>
                
                <button type="submit" class="w-full bg-[#0f3465] text-white py-4 rounded-xl font-bold text-lg hover:bg-teal-600 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </main>

    <!-- FOOTER DINAMIS -->
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