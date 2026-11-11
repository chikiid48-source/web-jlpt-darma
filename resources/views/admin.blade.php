<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - JLPT 2026</title>
    <link rel="icon" href="{{ asset('images/logo-baru.jpg') }}" type="image/jpeg">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .tab-content, .level-content { display: none; }
        .tab-content.active, .level-content.active { display: block; }
        .menu-btn.active { background-color: #0f3465; color: white; }
        .level-tab { color: #6b7280; border-bottom: 2px solid transparent; transition: all 0.2s; }
        .level-tab:hover { color: #111827; }
        .level-tab.active { color: #0f3465; border-bottom-color: #0f3465; font-weight: bold; }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col justify-between">

    <!-- Header -->
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


    <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-8 flex flex-col">
        <!-- PROFIL -->
        <div class="flex items-center space-x-4 mb-6 bg-white p-4 rounded-xl border border-gray-200 shadow-sm w-full md:w-max pr-8">
            <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-[#0f3465] shadow-sm flex-shrink-0">
                <img src="{{ asset('images/admin-profile.jpg') }}" alt="Admin" class="w-full h-full object-cover">
            </div>
            <div>
                <h2 class="text-lg font-bold text-gray-900 leading-tight">Administrator</h2>
                <p class="text-xs text-green-500 font-semibold flex items-center gap-1 mt-0.5"><span class="w-2 h-2 bg-green-500 rounded-full inline-block"></span> Online</p>
            </div>
        </div>

        <!-- NAV TAB ADMIN -->
        <nav class="flex flex-nowrap overflow-x-auto space-x-2 md:space-x-4 border-b border-gray-200 pb-4 mb-6">
            <button onclick="switchAdminTab('pengaturan')" id="btn-pengaturan" class="menu-btn px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100">Pengaturan Web</button>
            <button onclick="switchAdminTab('pesan')" id="btn-pesan" class="menu-btn px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100 flex items-center space-x-2"><span>Pesan Masuk</span><span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">3 Baru</span></button>
            <button onclick="switchAdminTab('materi')" id="btn-materi" class="menu-btn active px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100">Kelola Materi</button>
            <button onclick="switchAdminTab('latihan')" id="btn-latihan" class="menu-btn px-5 py-2.5 rounded-lg text-sm font-semibold text-gray-600 hover:bg-gray-100">Kelola Latihan</button>
        </nav>

        <section class="w-full bg-white border border-gray-200 rounded-xl p-6 shadow-sm min-h-[500px]">
            
<!-- 1. PENGATURAN WEB (Form Edit) -->
            <div id="tab-pengaturan" class="tab-content">
                <h3 class="text-xl font-bold text-gray-900 border-b pb-3 mb-6">Pengaturan Tampilan Website</h3>
                <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-4xl">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Logo Website Saat Ini</label>
                            <img src="{{ asset($webSetting->logo ?? 'images/logo-baru.jpg') }}" alt="Logo" class="h-16 mb-4 object-contain">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti Logo (Opsional)</label>
                            <input type="file" name="logo" accept="image/*" class="w-full text-sm bg-white border border-gray-300 rounded-lg p-1.5">
                        </div>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Teks Nama Organisasi (Samping Logo)</label>
                                <input type="text" name="app_name" value="{{ $webSetting->app_name ?? 'JAPANFOUNDATION' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0f3465] outline-none" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Kontak (Footer)</label>
                                <input type="email" name="email" value="{{ $webSetting->email ?? 'jlpt.indonesia@jpf.go.jp' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0f3465] outline-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Kantor (Footer)</label>
                            <textarea name="address" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0f3465] outline-none" required>{{ $webSetting->address ?? "Summitmas II, 1-2 Floor\nJl. Jend. Sudirman Kav. 61 - 62\nJakarta Selatan, 12190" }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Link Facebook (Footer)</label>
                            <input type="url" name="facebook" value="{{ $webSetting->facebook ?? '#' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#0f3465] outline-none" placeholder="https://facebook.com/...">
                        </div>
                    </div>
                    <button type="submit" class="bg-[#0f3465] text-white px-8 py-3 rounded-lg font-bold hover:bg-[#0a2347] transition shadow-md">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- 2. PESAN MASUK -->
            <div id="tab-pesan" class="tab-content">
                <div class="flex justify-between items-center mb-6 border-b pb-3">
                    <h3 class="text-xl font-bold text-gray-900">Daftar Pesan dari Pengunjung</h3>
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">{{ $messages->count() }} Total Pesan</span>
                </div>
                
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-left text-sm text-gray-600">
                        <thead class="bg-gray-100 text-gray-700 text-xs uppercase font-bold">
                            <tr>
                                <th class="px-4 py-3">Pengirim</th>
                                <th class="px-4 py-3">Lokasi</th>
                                <th class="px-4 py-3">Pesan</th>
                                <th class="px-4 py-3 text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($messages as $msg)
                            <tr class="hover:bg-blue-50">
                                <td class="px-4 py-4">
                                    <span class="font-bold text-gray-900 block">{{ $msg->name }}</span>
                                    <span class="text-xs text-gray-500">{{ $msg->email }}</span>
                                </td>
                                <td class="px-4 py-4"><span class="bg-gray-200 px-2 py-1 rounded text-xs font-semibold">{{ $msg->location ?? '-' }}</span></td>
                                <td class="px-4 py-4"><p class="text-xs max-w-sm">{{ $msg->message }}</p></td>
                                <td class="px-4 py-4 text-center">
                                    <form action="{{ route('pesan.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1.5 rounded text-xs font-bold hover:bg-red-600 transition">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400 font-bold">Belum ada pesan masuk.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 3. KELOLA MATERI (CRUD BARU) -->
            <div id="tab-materi" class="tab-content active">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 md:mb-0">Kelola Materi Pembelajaran</h3>
                </div>
                
                <div class="flex space-x-6 border-b border-gray-200 mb-6 overflow-x-auto whitespace-nowrap pb-2">
                    @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                    @php $isActive = session('active_materi_level') ? (session('active_materi_level') == $lvl) : ($lvl == 'n5'); @endphp
                    <button onclick="switchLevelTab('materi', '{{ $lvl }}')" id="materi-tab-{{ $lvl }}" class="level-tab {{ $isActive ? 'active' : '' }} pb-2 text-sm font-medium">Materi {{ strtoupper($lvl) }}</button>
                    @endforeach
                </div>

                @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                @php 
                    $mData = ${'materis' . strtoupper($lvl)};
                    $mIsActive = session('active_materi_level') ? (session('active_materi_level') == $lvl) : ($lvl == 'n5');
                @endphp
                <div id="materi-content-{{ $lvl }}" class="level-content {{ $mIsActive ? 'active' : '' }}">
                    <div class="flex justify-between items-center mb-4">
                        <div class="bg-blue-50 text-[#0f3465] p-3 rounded-lg text-sm font-bold border border-blue-100 flex items-center gap-2">
                            <span>Materi Pembelajaran {{ strtoupper($lvl) }}</span>
                            <span class="bg-[#0f3465] text-white px-2 py-0.5 rounded-full text-xs">{{ $mData->count() }} Modul</span>
                        </div>
                        <button onclick="openAddMateriModal('{{ $lvl }}')" class="bg-[#58cc02] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#46a302] transition shadow-sm text-sm">
                            + Tambah Materi {{ strtoupper($lvl) }}
                        </button>
                    </div>

                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto rounded-lg border border-gray-200">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-100 text-gray-700 text-xs uppercase font-bold sticky top-0 shadow-sm z-10">
                                <tr>
                                    <th class="px-4 py-3">Bab / Judul Materi</th>
                                    <th class="px-4 py-3">Deskripsi Singkat</th>
                                    <th class="px-4 py-3">Tipe File</th>
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($mData as $m)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 font-bold text-gray-900">{{ $m->title }}</td>
                                    <td class="px-4 py-4 text-xs max-w-[250px] truncate">{{ $m->description }}</td>
                                    <td class="px-4 py-4">
                                        @if($m->type == 'pdf')
                                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-bold">PDF Document</span>
                                        @else
                                            <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded text-xs font-bold">Video Embed</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 flex justify-center gap-3">
                                        <button onclick="openEditMateriModal({{ $m->id }}, `{{ addslashes($m->title) }}`, `{{ addslashes($m->description) }}`, '{{ $m->type }}', '{{ $m->file_url }}', '{{ $lvl }}')" class="text-blue-500 font-bold text-xs hover:underline">Edit</button>
                                        <form action="{{ route('materi.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 font-bold text-xs hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400 font-bold">Belum ada materi untuk {{ strtoupper($lvl) }}.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- 4. KELOLA LATIHAN -->
            <div id="tab-latihan" class="tab-content">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4 md:mb-0">Kelola Soal Latihan</h3>
                </div>
                
                <div class="flex space-x-6 border-b border-gray-200 mb-6 overflow-x-auto whitespace-nowrap pb-2">
                    @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                    @php $isActive = session('active_level') ? (session('active_level') == $lvl) : ($lvl == 'n5'); @endphp
                    <button onclick="switchLevelTab('latihan', '{{ $lvl }}')" id="latihan-tab-{{ $lvl }}" class="level-tab {{ $isActive ? 'active' : '' }} pb-2 text-sm font-medium">Latihan {{ strtoupper($lvl) }}</button>
                    @endforeach
                </div>

                @foreach(['n5', 'n4', 'n3', 'n2', 'n1'] as $lvl)
                @php 
                    $data = ${'questions' . strtoupper($lvl)};
                    $isActive = session('active_level') ? (session('active_level') == $lvl) : ($lvl == 'n5');
                @endphp
                <div id="latihan-content-{{ $lvl }}" class="level-content {{ $isActive ? 'active' : '' }}">
                    <div class="flex justify-between items-center mb-4">
                        <div class="bg-blue-50 text-[#0f3465] p-3 rounded-lg text-sm font-bold border border-blue-100 flex items-center gap-2">
                            <span>Latihan: Kanji & Kosakata {{ strtoupper($lvl) }}</span>
                            <span class="bg-[#0f3465] text-white px-2 py-0.5 rounded-full text-xs">{{ $data->count() }} Soal</span>
                        </div>
                        <button onclick="openAddModal('{{ $lvl }}')" class="bg-[#0fb398] text-white px-4 py-2 rounded-lg font-bold hover:bg-teal-600 transition shadow-sm text-sm">
                            + Tambah Soal {{ strtoupper($lvl) }}
                        </button>
                    </div>

                    <div class="overflow-x-auto max-h-[500px] overflow-y-auto rounded-lg border border-gray-200">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-100 text-gray-700 text-xs uppercase font-bold sticky top-0 shadow-sm z-10">
                                <tr>
                                    <th class="px-4 py-3 w-10">No</th>
                                    <th class="px-4 py-3">Pertanyaan</th>
                                    <th class="px-4 py-3 w-48">Jawaban Benar</th>
                                    <th class="px-4 py-3 text-center w-32">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($data as $index => $q)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-bold">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3">{!! $q->question_text !!}</td>
                                    <td class="px-4 py-3 font-semibold text-green-600">Opsi {{ $q->correct_answer }}: {{ $q->{'option_'.$q->correct_answer} }}</td>
                                    <td class="px-4 py-3 flex justify-center gap-3">
                                        <!-- Perbaikan bug: menggunakan $lvl bukan $level -->
                                        <button onclick="openEditModal({{ $q->id }}, `{{ addslashes($q->question_text) }}`, '{{ $q->option_1 }}', '{{ $q->option_2 }}', '{{ $q->option_3 }}', '{{ $q->option_4 }}', {{ $q->correct_answer }}, '{{ $lvl }}')" class="text-blue-500 font-bold text-xs hover:underline">Edit</button>
                                        <form action="{{ route('soal.destroy', $q->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus soal {{ strtoupper($lvl) }} ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 font-bold text-xs hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="px-4 py-10 text-center text-gray-400 font-bold">Belum ada soal untuk {{ strtoupper($lvl) }}.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </main>

    <!-- KUMPULAN MODAL (MATERI & SOAL LATIHAN) -->

    <!-- Modal Tambah Materi -->
  <!-- Modal Tambah Materi -->
    <div id="modal-tambah-materi" class="fixed inset-0 z-[100] bg-black/50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-[#58cc02] px-6 py-4 flex justify-between items-center">
                <h3 class="text-white font-bold text-lg" id="tambah-materi-title">Tambah Materi Baru</h3>
                <button onclick="closeModal('modal-tambah-materi')" class="text-white hover:text-gray-200 text-xl font-bold">&times;</button>
            </div>
            <!-- TAMBAHKAN enctype UNTUK UPLOAD FILE -->
            <form action="{{ route('materi.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                <input type="hidden" name="level" id="tambah_materi_level" value="n5">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul / Bab Materi</label>
                    <input type="text" name="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#58cc02] outline-none" required placeholder="Contoh: Bab 1: Pengenalan Hiragana">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                    <textarea name="description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#58cc02] outline-none" placeholder="Tuliskan ringkasan materi..."></textarea>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Konten</label>
                        <!-- EVENT ONCHANGE UNTUK MENGUBAH INPUT -->
                        <select name="type" id="type_add" onchange="toggleMateriInput('add')" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            <option value="pdf">Upload File PDF</option>
                            <option value="video">Video YouTube</option>
                        </select>
                    </div>
                    
                    <!-- INPUT PDF -->
                    <div id="input_pdf_add">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Pilih File PDF</label>
                        <input type="file" name="file_upload" accept=".pdf" class="w-full px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#58cc02] outline-none text-sm">
                    </div>
                    
                    <!-- INPUT VIDEO (Sembunyi by default) -->
                    <div id="input_video_add" style="display: none;">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Link YouTube</label>
                        <input type="url" name="file_url" id="url_video_add" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#58cc02] outline-none" placeholder="https://youtube.com/...">
                    </div>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modal-tambah-materi')" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold text-sm">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-[#58cc02] text-white rounded-lg hover:bg-[#46a302] font-semibold text-sm">Simpan Materi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Materi -->
    <div id="modal-edit-materi" class="fixed inset-0 z-[100] bg-black/50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity">
        <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg" id="edit-materi-title">Edit Materi</h3>
            <button onclick="closeModal('modal-edit-materi')" class="text-white hover:text-gray-200 text-xl font-bold">&times;</button>
        </div>
        <form id="form-edit-materi" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul / Bab Materi</label>
                <input type="text" name="title" id="edit_m_title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" id="edit_m_desc" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Konten</label>
                    <select name="type" id="edit_m_type" onchange="toggleMateriInput('edit')" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        <option value="pdf">Upload File PDF</option>
                        <option value="video">Video YouTube</option>
                    </select>
                </div>
                <div id="input_pdf_edit">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ganti PDF Baru (Opsional)</label>
                    <input type="file" name="file_upload" accept=".pdf" class="w-full px-2 py-1.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                </div>
                <div id="input_video_edit" style="display: none;">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Link YouTube</label>
                    <input type="url" name="file_url" id="edit_m_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-materi')" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold text-sm">Batal</button>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-sm">Update Materi</button>
            </div>
        </form>
    </div>

    <!-- Modal Edit Materi -->
    <div id="modal-edit-materi" class="fixed inset-0 z-[100] bg-black/50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity">
        <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-white font-bold text-lg" id="edit-materi-title">Edit Materi</h3>
            <button onclick="closeModal('modal-edit-materi')" class="text-white hover:text-gray-200 text-xl font-bold">&times;</button>
        </div>
        <form id="form-edit-materi" method="POST" class="p-6">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Judul / Bab Materi</label>
                <input type="text" name="title" id="edit_m_title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi Singkat</label>
                <textarea name="description" id="edit_m_desc" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tipe Konten</label>
                    <select name="type" id="edit_m_type" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                        <option value="pdf">PDF Document (Drive)</option>
                        <option value="video">Video Embed (YouTube)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Link URL (PDF/Video)</label>
                    <input type="url" name="file_url" id="edit_m_url" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" required>
                </div>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modal-edit-materi')" class="px-5 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 font-semibold text-sm">Batal</button>
                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold text-sm">Update Materi</button>
            </div>
        </form>
    </div>

    <!-- Modal Tambah Soal -->
    <div id="modal-tambah" class="fixed inset-0 z-[100] bg-black/50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-[#0fb398] px-6 py-4 flex justify-between items-center"><h3 class="text-white font-bold text-lg" id="tambah-title">Tambah Soal</h3><button onclick="closeModal('modal-tambah')" class="text-white text-xl font-bold">&times;</button></div>
            <form action="{{ route('soal.store') }}" method="POST" class="p-6">@csrf<input type="hidden" name="level" id="tambah_level" value="n5"><div class="mb-4"><label class="block text-sm font-semibold text-gray-700 mb-1">Teks Pertanyaan</label><textarea name="question_text" rows="2" class="w-full px-4 py-2 border rounded-lg focus:ring-[#0fb398] outline-none" required></textarea></div><div class="grid grid-cols-2 gap-4 mb-4"><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 1</label><input type="text" name="option_1" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 2</label><input type="text" name="option_2" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 3</label><input type="text" name="option_3" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 4</label><input type="text" name="option_4" class="w-full px-3 py-2 border rounded-lg" required></div></div><div class="mb-6"><label class="block text-sm font-semibold text-gray-700 mb-1">Jawaban Benar</label><select name="correct_answer" class="w-full px-4 py-2 border rounded-lg" required><option value="1">Opsi 1</option><option value="2">Opsi 2</option><option value="3">Opsi 3</option><option value="4">Opsi 4</option></select></div><div class="flex justify-end gap-3"><button type="button" onclick="closeModal('modal-tambah')" class="px-5 py-2 border text-gray-700 rounded-lg text-sm">Batal</button><button type="submit" class="px-5 py-2 bg-[#0fb398] text-white rounded-lg text-sm">Simpan Soal</button></div></form>
        </div>
    </div>

    <!-- Modal Edit Soal -->
    <div id="modal-edit" class="fixed inset-0 z-[100] bg-black/50 hidden flex items-center justify-center backdrop-blur-sm transition-opacity">
        <div class="bg-blue-600 px-6 py-4 flex justify-between items-center"><h3 class="text-white font-bold text-lg" id="edit-title">Edit Soal</h3><button onclick="closeModal('modal-edit')" class="text-white text-xl font-bold">&times;</button></div>
        <form id="form-edit" method="POST" class="p-6">@csrf @method('PUT')<div class="mb-4"><label class="block text-sm font-semibold text-gray-700 mb-1">Teks Pertanyaan</label><textarea name="question_text" id="edit_q_text" rows="2" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 outline-none" required></textarea></div><div class="grid grid-cols-2 gap-4 mb-4"><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 1</label><input type="text" name="option_1" id="edit_opt_1" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 2</label><input type="text" name="option_2" id="edit_opt_2" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 3</label><input type="text" name="option_3" id="edit_opt_3" class="w-full px-3 py-2 border rounded-lg" required></div><div><label class="block text-xs font-semibold text-gray-700 mb-1">Opsi 4</label><input type="text" name="option_4" id="edit_opt_4" class="w-full px-3 py-2 border rounded-lg" required></div></div><div class="mb-6"><label class="block text-sm font-semibold text-gray-700 mb-1">Jawaban Benar</label><select name="correct_answer" id="edit_correct" class="w-full px-4 py-2 border rounded-lg" required><option value="1">Opsi 1</option><option value="2">Opsi 2</option><option value="3">Opsi 3</option><option value="4">Opsi 4</option></select></div><div class="flex justify-end gap-3"><button type="button" onclick="closeModal('modal-edit')" class="px-5 py-2 border text-gray-700 rounded-lg text-sm">Batal</button><button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm">Update Soal</button></div></form>
    </div>

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

    <!-- Script Utama Admin -->
    <script>
        function switchAdminTab(tabName) {
            document.querySelectorAll('.menu-btn').forEach(btn => {
                btn.classList.remove('active', 'bg-[#0f3465]', 'text-white');
                btn.classList.add('text-gray-600', 'hover:bg-gray-100');
            });
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            const selectedBtn = document.getElementById('btn-' + tabName);
            selectedBtn.classList.add('active', 'bg-[#0f3465]', 'text-white');
            selectedBtn.classList.remove('text-gray-600', 'hover:bg-gray-100');
            document.getElementById('tab-' + tabName).classList.add('active');
        }

        function switchLevelTab(tipeMenu, level) {
            document.querySelectorAll(`#tab-${tipeMenu} .level-tab`).forEach(tab => tab.classList.remove('active'));
            document.querySelectorAll(`#tab-${tipeMenu} .level-content`).forEach(content => content.classList.remove('active'));
            document.getElementById(`${tipeMenu}-tab-${level}`).classList.add('active');
            document.getElementById(`${tipeMenu}-content-${level}`).classList.add('active');
        }

        function openModal(id) { document.getElementById(id).classList.remove('hidden'); }
        function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
        
        /* Logika Modal Soal */
        function openAddModal(level) {
            document.getElementById('tambah_level').value = level;
            document.getElementById('tambah-title').innerText = `Tambah Soal ${level.toUpperCase()} Baru`;
            openModal('modal-tambah');
        }
        function openEditModal(id, text, opt1, opt2, opt3, opt4, correct, level) {
            document.getElementById('form-edit').action = `/admin/soal/${id}`;
            document.getElementById('edit_q_text').value = text; document.getElementById('edit_opt_1').value = opt1;
            document.getElementById('edit_opt_2').value = opt2; document.getElementById('edit_opt_3').value = opt3;
            document.getElementById('edit_opt_4').value = opt4; document.getElementById('edit_correct').value = correct;
            document.getElementById('edit-title').innerText = `Edit Soal ${level.toUpperCase()}`;
            openModal('modal-edit');
        }

        /* Logika Modal Materi */
        function openAddMateriModal(level) {
            document.getElementById('tambah_materi_level').value = level;
            document.getElementById('tambah-materi-title').innerText = `Tambah Materi ${level.toUpperCase()} Baru`;
            openModal('modal-tambah-materi');
        }
        function openEditMateriModal(id, title, desc, type, url, level) {
            document.getElementById('form-edit-materi').action = `/admin/materi/${id}`;
            document.getElementById('edit_m_title').value = title;
            document.getElementById('edit_m_desc').value = desc;
            document.getElementById('edit_m_type').value = type;
            document.getElementById('edit_m_url').value = url;
            document.getElementById('edit-materi-title').innerText = `Edit Materi ${level.toUpperCase()}`;
            openModal('modal-edit-materi');
        }

        /* Handler Notifikasi & Keep Tab Active */
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                const activeTab = "{{ session('active_tab') ?: 'latihan' }}";
                switchAdminTab(activeTab);
                
                if (activeTab === 'latihan') {
                    const level = "{{ session('active_level') }}";
                    if(level) switchLevelTab('latihan', level);
                } else if (activeTab === 'materi') {
                    const level = "{{ session('active_materi_level') }}";
                    if(level) switchLevelTab('materi', level);
                }
                
                setTimeout(() => alert("{{ session('success') }}"), 100);
            });
        @endif

        function toggleMateriInput(mode) {
            const type = document.getElementById(mode === 'add' ? 'type_add' : 'edit_m_type').value;
            const pdfInput = document.getElementById(mode === 'add' ? 'input_pdf_add' : 'input_pdf_edit');
            const videoInput = document.getElementById(mode === 'add' ? 'input_video_add' : 'input_video_edit');
            
            if (type === 'pdf') {
                pdfInput.style.display = 'block';
                videoInput.style.display = 'none';
                if(mode === 'add') document.getElementById('url_video_add').removeAttribute('required');
            } else {
                pdfInput.style.display = 'none';
                videoInput.style.display = 'block';
                if(mode === 'add') document.getElementById('url_video_add').setAttribute('required', 'true');
            }
        }
    </script>
</body>
</html>