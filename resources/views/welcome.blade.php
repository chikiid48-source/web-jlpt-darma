<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar (Sticky saat di-scroll) -->
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


    <!-- Konten Utama -->
    <main class="flex-grow flex items-center justify-center px-6 md:px-12 py-10">
        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Kolom Kiri: Gambar Anime Besar -->
            <div class="lg:col-span-7 flex justify-center items-center p-2">
                <img src="{{ asset('images/Gemini_Generated_Image_m212dmm212dmm212.jpg') }}" alt="Anime JLPT Character" class="w-full max-w-xl h-auto object-contain">
            </div>

            <!-- Kolom Kanan: Form Login -->
            <div class="lg:col-span-5 max-w-md w-full mx-auto">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Masuk Akun</h1>
                    <p class="text-sm text-gray-500 mt-1">ログイン</p>
                </div>

                <!-- Form Login -->
               <!-- Form Login -->
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm font-medium">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                                placeholder="Masukkan email Anda" 
                                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-blue-900 text-sm">
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">
                            Password <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" required 
                                placeholder="Masukkan password" 
                                class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:border-blue-900 text-sm">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <button type="button" id="togglePassword" class="text-gray-400 hover:text-gray-600 focus:outline-none text-xs font-semibold">Lihat</button>
                            </div>
                        </div>
                    </div>

                    <!-- Ingat Saya & Lupa Password -->
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-900 focus:ring-blue-900 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-gray-700">Ingat saya</label>
                        </div>
                        <a href="#" class="text-blue-600 hover:underline font-medium">Lupa password</a>
                    </div>

                    <!-- reCAPTCHA Box -->
                    <div class="border border-gray-200 bg-gray-50 p-3 rounded-lg flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" required class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="text-sm text-gray-700">I'm not a robot</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">reCAPTCHA</span>
                        </div>
                    </div>

                    <!-- Tombol Masuk -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-sm font-semibold text-white bg-[#0f3465] hover:bg-[#0a2347] transition">
                            Masuk Akun
                        </button>
                    </div>

                    <div class="text-center text-sm text-gray-600 mt-4">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a>
                    </div>
                </form>
            </div>

        </div>
    </main>

    <!-- Footer -->
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

    <!-- Script Password Toggle -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? 'Lihat' : 'Sembunyikan';
        });
    </script>
</body>
</html>