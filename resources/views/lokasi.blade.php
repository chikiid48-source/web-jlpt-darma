<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Ujian - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Custom scrollbar untuk daftar lokasi */
        .location-list::-webkit-scrollbar {
            width: 6px;
        }
        .location-list::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 10px;
        }
        .location-list::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 10px;
        }
        .location-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header / Navbar (Sama dengan Beranda) -->
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


    <!-- KONTEN UTAMA: LOKASI UJIAN -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-6 md:px-12 py-10 flex flex-col lg:flex-row gap-8 lg:gap-12 items-start">
        
        <!-- KOLOM KIRI: Daftar Lokasi -->
        <div class="w-full lg:w-5/12 flex flex-col">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-1">Lokasi Ujian</h1>
            <p class="text-[15px] font-semibold text-[#c3a45c] mb-6">実施地連絡先</p>

            <!-- Search Bar -->
            <div class="relative mb-6">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" id="searchInput" onkeyup="filterLocations()" placeholder="Search location" class="w-full border border-gray-300 rounded-lg py-3 pl-10 pr-4 focus:ring-2 focus:ring-[#0f3465] focus:border-[#0f3465] text-sm outline-none transition-all">
            </div>

            <!-- List Card Lokasi -->
            <div id="locationList" class="flex flex-col space-y-3 location-list overflow-y-auto pr-2 max-h-[500px]">
                <!-- Item di-generate via JavaScript -->
            </div>
        </div>

        <!-- KOLOM KANAN: Detail Lokasi -->
        <div class="w-full lg:w-7/12 bg-gray-50 rounded-2xl p-6 md:p-8 flex flex-col border border-gray-100 shadow-sm sticky top-28">
            
            <!-- Gambar Gedung (Bisa pakai asset Anda jika ada, sementara pakai placeholder gedung) -->
            <div class="w-full h-48 md:h-64 bg-gray-200 rounded-xl mb-6 overflow-hidden relative">
                <img id="detail-image" src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80" alt="Kampus" class="w-full h-full object-cover">
            </div>

            <!-- Info Detail -->
            <h3 id="detail-title" class="text-xl font-bold text-gray-900 mb-4">JLPT Administration Committee in Surabaya</h3>
            
            <div class="space-y-4 text-sm text-gray-700">
                <div class="flex items-start">
                    <span class="font-bold w-6 text-gray-900">A :</span>
                    <span id="detail-address">Kampus Lidah Wetan, Surabaya 60213</span>
                </div>
                <div class="flex items-start">
                    <span class="font-bold w-6 text-gray-900">T :</span>
                    <span id="detail-phone">0823-3496-2832</span>
                </div>
                <div class="flex items-start">
                    <span class="font-bold w-6 text-gray-900">E :</span>
                    <span id="detail-email" class="text-blue-600 hover:underline cursor-pointer">bahasajepang@unesa.ac.id</span>
                </div>
                <div class="flex items-start">
                    <span class="font-bold w-auto mr-2 text-gray-900">Waktu pelayanan :</span>
                    <span id="detail-time">(09:00 s/d 16:00)</span>
                </div>
            </div>

            <!-- Tombol Buka Maps -->
            <a href="#" target="_blank" id="detail-map" class="mt-8 w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-full shadow-sm text-sm font-semibold text-white bg-[#0f3465] hover:bg-[#0a2347] transition">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                Buka Google Maps
            </a>
        </div>

    </main>

    <!-- Footer (Sama dengan Beranda) -->
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

    <!-- LOGIKA JAVASCRIPT UNTUK INTERAKSI LOKASI -->
    <script>
        // Data 6 Lokasi Ujian (Termasuk Lampung)
        const locations = [
            {
                id: 'jakarta',
                city: 'Jakarta',
                title: 'JLPT Administration Committee in Jakarta',
                address: 'Universitas Persada Indonesia Y.A.I',
                phone: '021-1234567',
                email: 'info@jakarta.jlpt',
                time: '(09:00 s/d 15:00)',
                mapLink: 'https://maps.google.com/?q=Universitas+Persada+Indonesia+YAI'
            },
            {
                id: 'bandung',
                city: 'Bandung',
                title: 'JLPT Administration Committee in Bandung',
                address: 'Universitas Padjadjaran, Jatinangor',
                phone: '022-7654321',
                email: 'info@bandung.jlpt',
                time: '(09:00 s/d 16:00)',
                mapLink: 'https://maps.google.com/?q=Universitas+Padjadjaran+Jatinangor'
            },
            {
                id: 'surabaya',
                city: 'Surabaya',
                title: 'JLPT Administration Committee in Surabaya',
                address: 'Kampus Lidah Wetan, Surabaya 60213',
                phone: '0823-3496-2832',
                email: 'bahasajepang@unesa.ac.id',
                time: '(09:00 s/d 16:00)',
                mapLink: 'https://maps.google.com/?q=Kampus+Lidah+Wetan+Surabaya'
            },
            {
                id: 'medan',
                city: 'Medan',
                title: 'JLPT Administration Committee in Medan',
                address: 'Fakultas Ilmu Budaya, Universitas Sumatera Utara',
                phone: '061-1122334',
                email: 'info@medan.jlpt',
                time: '(08:30 s/d 15:30)',
                mapLink: 'https://maps.google.com/?q=FIB+USU+Medan'
            },
            {
                id: 'yogyakarta',
                city: 'Yogyakarta',
                title: 'JLPT Administration Committee in Yogyakarta',
                address: 'Fakultas Ilmu Budaya, Universitas Gadjah Mada',
                phone: '0274-556677',
                email: 'info@jogja.jlpt',
                time: '(08:00 s/d 16:00)',
                mapLink: 'https://maps.google.com/?q=FIB+UGM+Yogyakarta'
            },
            {
                id: 'lampung',
                city: 'Lampung',
                title: 'JLPT Administration Committee in Lampung',
                address: 'Institut Informatika dan Bisnis Darmajaya, Bandar Lampung',
                phone: '0721-889900',
                email: 'info@lampung.jlpt',
                time: '(09:00 s/d 15:00)',
                mapLink: 'https://maps.google.com/?q=IIB+Darmajaya+Lampung'
            }
        ];

        let activeLocationId = 'surabaya'; // Default aktif seperti di gambar

        const listContainer = document.getElementById('locationList');
        
        // Fungsi Render Daftar Lokasi Kiri
        function renderLocations(filterText = '') {
            listContainer.innerHTML = '';
            
            const filtered = locations.filter(loc => loc.city.toLowerCase().includes(filterText.toLowerCase()));
            
            filtered.forEach(loc => {
                const isActive = loc.id === activeLocationId;
                
                // Style dinamis berdasarkan state aktif / tidak
                const cardClass = isActive 
                    ? 'bg-[#0f3465] text-white border-[#0f3465]' 
                    : 'bg-white text-gray-900 border-gray-200 hover:bg-gray-50';
                
                const textMutedClass = isActive ? 'text-blue-200' : 'text-gray-500';
                const iconColor = isActive ? 'text-white' : 'text-[#c8a556]';
                
                const cardHTML = `
                    <div onclick="selectLocation('${loc.id}')" class="border rounded-xl p-4 cursor-pointer transition-all flex items-center justify-between ${cardClass}">
                        <div>
                            <div class="flex items-center space-x-2 mb-2">
                                <svg class="w-5 h-5 ${iconColor}" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                                <h3 class="font-bold text-lg leading-none">${loc.city}</h3>
                            </div>
                            <div class="pl-7 text-[11px] ${textMutedClass} space-y-0.5">
                                <p>Pendaftaran Juli 2026 - Selesai</p>
                                <p>Pendaftaran Desember 2026 - Selesai</p>
                            </div>
                        </div>
                        <div>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                `;
                listContainer.insertAdjacentHTML('beforeend', cardHTML);
            });
        }

        // Fungsi Pilih Lokasi (Update Konten Kanan)
        function selectLocation(id) {
            activeLocationId = id;
            
            // Re-render list untuk merubah warna aktif
            const filterText = document.getElementById('searchInput').value;
            renderLocations(filterText);

            // Update konten di sebelah kanan
            const selectedLoc = locations.find(loc => loc.id === id);
            if (selectedLoc) {
                document.getElementById('detail-title').innerText = selectedLoc.title;
                document.getElementById('detail-address').innerText = selectedLoc.address;
                document.getElementById('detail-phone').innerText = selectedLoc.phone;
                document.getElementById('detail-email').innerText = selectedLoc.email;
                document.getElementById('detail-time').innerText = selectedLoc.time;
                document.getElementById('detail-map').href = selectedLoc.mapLink;
                
                // Animasi fade in ringan saat data berganti
                const detailPane = document.querySelector('.lg\\:w-7\\/12');
                detailPane.style.opacity = 0;
                setTimeout(() => { detailPane.style.opacity = 1; detailPane.style.transition = "opacity 0.3s"; }, 50);
            }
        }

        // Fungsi Pencarian
        function filterLocations() {
            const val = document.getElementById('searchInput').value;
            renderLocations(val);
        }

        // Render pertama kali saat load
        renderLocations();
        selectLocation(activeLocationId);
    </script>
</body>
</html>