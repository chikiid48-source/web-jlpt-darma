<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Models\Question;

// Halaman Utama (Beranda) - Langsung terbuka tanpa perlu login
Route::get('/', function () {
    return view('beranda');
})->name('beranda');

// Halaman Login & Register (Hanya untuk yang belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('welcome'); // file login kita sebelumnya menggunakan welcome.blade.php
    })->name('login');

    Route::get('/register', function () {
        return view('register');
    })->name('register');
});

// Proses Autentikasi
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Menu Lainnya (Bisa diakses publik)
Route::get('/lokasi', function () { return view('lokasi'); })->name('lokasi');
Route::get('/kontak', function () { return view('kontak'); })->name('kontak');
Route::get('/latihan/hiragana', function () { return view('hiragana'); })->name('latihan.hiragana');
Route::get('/latihan/kuis', function () { return view('kuis-karakter'); })->name('latihan.kuis');

// Rute Admin & Pengelolaan Soal
Route::get('/admin', [QuestionController::class, 'indexAdmin'])->name('admin');
Route::post('/admin/soal', [QuestionController::class, 'store'])->name('soal.store');
Route::put('/admin/soal/{id}', [QuestionController::class, 'update'])->name('soal.update');
Route::delete('/admin/soal/{id}', [QuestionController::class, 'destroy'])->name('soal.destroy');

Route::get('/admin/balas', function () {
    return view('balas-pesan');
})->name('admin.balas');

// Halaman Materi User
Route::get('/materi', function () {
    $materisN5 = App\Models\Materi::where('level', 'n5')->get();
    $materisN4 = App\Models\Materi::where('level', 'n4')->get();
    $materisN3 = App\Models\Materi::where('level', 'n3')->get();
    $materisN2 = App\Models\Materi::where('level', 'n2')->get();
    $materisN1 = App\Models\Materi::where('level', 'n1')->get();

    return view('materi', compact(
        'materisN5', 'materisN4', 'materisN3', 'materisN2', 'materisN1'
    ));
})->name('materi');

Route::get('/latihan', function () {
    return view('latihan');
})->name('latihan');

use App\Http\Controllers\MateriController;

// Rute Admin & Pengelolaan Soal
Route::get('/admin', [QuestionController::class, 'indexAdmin'])->name('admin');
Route::post('/admin/soal', [QuestionController::class, 'store'])->name('soal.store');
Route::put('/admin/soal/{id}', [QuestionController::class, 'update'])->name('soal.update');
Route::delete('/admin/soal/{id}', [QuestionController::class, 'destroy'])->name('soal.destroy');

// Rute Admin & Pengelolaan Materi (BARU)
Route::post('/admin/materi', [MateriController::class, 'store'])->name('materi.store');
Route::put('/admin/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
Route::delete('/admin/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');

// Rute Halaman Hasil Kuis (Bisa dipakai untuk N1-N5)
Route::get('/hasil-latihan', function () {
    return view('hasil-latihan');
})->name('hasil-latihan');

// Rute Kuis Dinamis (Menangani N5, N4, N3, N2, N1)
Route::get('/kuis/{level}', function ($level) {
    // Validasi agar hanya n5 sampai n1 yang bisa diakses
    if (!in_array(strtolower($level), ['n5', 'n4', 'n3', 'n2', 'n1'])) {
        abort(404);
    }
    
    // Ambil data soal sesuai level dari database
    $questionsData = Question::where('level', $level)->get();
    
    // Olah data di backend agar aman dan tidak memicu error JSON Parse di Blade
    $questions = $questionsData->map(function($q) {
        return [
            'text' => $q->question_text,
            'options' => [$q->option_1, $q->option_2, $q->option_3, $q->option_4],
            'answer' => (int)$q->correct_answer - 1
        ];
    });

    return view('kuis', compact('questions', 'level'));
})->name('kuis');

// Route Submit Form Kontak ke Admin
Route::post('/kontak/submit', function(Illuminate\Http\Request $request) {
    App\Models\ContactMessage::create($request->all());
    return back()->with('success', 'Pesan Anda berhasil dikirim ke Admin!');
})->name('kontak.submit');

// Route Update Pengaturan & Hapus Pesan (Admin)
Route::post('/admin/setting', [App\Http\Controllers\QuestionController::class, 'updateSetting'])->name('setting.update');
Route::delete('/admin/pesan/{id}', [App\Http\Controllers\QuestionController::class, 'destroyMessage'])->name('pesan.destroy');

Route::get('/setup-db-rahasia', function() {
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
    return 'Database berhasil di-migrate! Website sudah ONLINE!';
});