<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Materi;
use App\Models\Setting;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class QuestionController extends Controller
{
    // ==========================================
    // MENAMPILKAN HALAMAN ADMIN (SEMUA DATA)
    // ==========================================
    public function indexAdmin()
    {
        // Tarik data pesan kontak (diurutkan dari yang terbaru)
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();

        // Tarik data soal
        $questionsN5 = Question::where('level', 'n5')->get();
        $questionsN4 = Question::where('level', 'n4')->get();
        $questionsN3 = Question::where('level', 'n3')->get();
        $questionsN2 = Question::where('level', 'n2')->get();
        $questionsN1 = Question::where('level', 'n1')->get();

        // Tarik data materi
        $materisN5 = Materi::where('level', 'n5')->get();
        $materisN4 = Materi::where('level', 'n4')->get();
        $materisN3 = Materi::where('level', 'n3')->get();
        $materisN2 = Materi::where('level', 'n2')->get();
        $materisN1 = Materi::where('level', 'n1')->get();

        return view('admin', compact(
            'messages', // <-- Data pesan ditambahkan di sini
            'questionsN5', 'questionsN4', 'questionsN3', 'questionsN2', 'questionsN1',
            'materisN5', 'materisN4', 'materisN3', 'materisN2', 'materisN1'
        ));
    }

    // ==========================================
    // BAGIAN PENGELOLAAN SOAL (CRUD SOAL)
    // ==========================================

    // Menyimpan soal baru (N5-N1)
    public function store(Request $request)
    {
        Question::create($request->all());
        
        // Kembalikan dengan status level & tab agar tab langsung terbuka di tempat yang benar
        return back()->with('success', 'Soal berhasil ditambahkan!')->with('active_tab', 'latihan')->with('active_level', $request->level);
    }

    // Mengupdate soal yang diedit
    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $question->update($request->all());
        
        return back()->with('success', 'Soal berhasil diperbarui!')->with('active_tab', 'latihan')->with('active_level', $question->level);
    }

    // Menghapus soal
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $level = $question->level;
        $question->delete();
        
        return back()->with('success', 'Soal berhasil dihapus!')->with('active_tab', 'latihan')->with('active_level', $level);
    }

    // ==========================================
    // BAGIAN PENGATURAN WEB & PESAN MASUK
    // ==========================================

    // Update Pengaturan Web (Logo, Teks, Email, dll)
    public function updateSetting(Request $request)
    {
        // Ambil data pengaturan pertama (karena kita cuma butuh 1 baris pengaturan)
        $setting = Setting::first();
        $data = $request->all();

        // Proses upload logo jika ada file yang diunggah
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            // Penamaan file yang rapi (logo_web_164839... .jpg)
            $filename = 'logo_web_' . time() . '.' . $file->getClientOriginalExtension();
            // Pindahkan file ke folder public/images
            $file->move(public_path('images'), $filename);
            $data['logo'] = 'images/' . $filename;
        }

        $setting->update($data);
        return back()->with('success', 'Pengaturan Web berhasil disimpan!')->with('active_tab', 'pengaturan');
    }

    // Menghapus Pesan Masuk dari Kontak
    public function destroyMessage($id)
    {
        ContactMessage::findOrFail($id)->delete();
        return back()->with('success', 'Pesan berhasil dihapus!')->with('active_tab', 'pesan');
    }
}