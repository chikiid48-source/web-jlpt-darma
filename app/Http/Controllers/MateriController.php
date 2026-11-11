<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MateriController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        // 1. Jika tipe PDF, proses upload filenya
        if ($request->type == 'pdf' && $request->hasFile('file_upload')) {
            $file = $request->file('file_upload');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            // Simpan ke folder public/uploads/materi
            $file->move(public_path('uploads/materi'), $filename);
            $data['file_url'] = 'uploads/materi/' . $filename;
        } 
        // 2. Jika tipe Video, ubah link YouTube mentah jadi link Embed
        elseif ($request->type == 'video' && isset($request->file_url)) {
            $data['file_url'] = $this->convertYouTubeUrl($request->file_url);
        }

        Materi::create($data);
        return back()->with('success', 'Materi berhasil ditambahkan!')->with('active_tab', 'materi')->with('active_materi_level', $request->level);
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);
        $data = $request->all();

        if ($request->type == 'pdf') {
            if ($request->hasFile('file_upload')) {
                // Hapus file lama jika ada
                if (File::exists(public_path($materi->file_url))) {
                    File::delete(public_path($materi->file_url));
                }
                // Upload file baru
                $file = $request->file('file_upload');
                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move(public_path('uploads/materi'), $filename);
                $data['file_url'] = 'uploads/materi/' . $filename;
            } else {
                // Jika tidak upload file baru, pertahankan yang lama
                $data['file_url'] = $materi->file_url;
            }
        } elseif ($request->type == 'video' && isset($request->file_url)) {
            $data['file_url'] = $this->convertYouTubeUrl($request->file_url);
        }

        $materi->update($data);
        return back()->with('success', 'Materi berhasil diperbarui!')->with('active_tab', 'materi')->with('active_materi_level', $materi->level);
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $level = $materi->level;
        
        // Hapus file fisik PDF jika ada
        if ($materi->type == 'pdf' && File::exists(public_path($materi->file_url))) {
            File::delete(public_path($materi->file_url));
        }

        $materi->delete();
        return back()->with('success', 'Materi berhasil dihapus!')->with('active_tab', 'materi')->with('active_materi_level', $level);
    }

    // Fungsi bantuan untuk convert link YouTube otomatis
    private function convertYouTubeUrl($url) {
        if (strpos($url, 'watch?v=') !== false) {
            $videoId = explode('&', explode('watch?v=', $url)[1])[0];
            return "https://www.youtube.com/embed/" . $videoId;
        } elseif (strpos($url, 'youtu.be/') !== false) {
            $videoId = explode('?', explode('youtu.be/', $url)[1])[0];
            return "https://www.youtube.com/embed/" . $videoId;
        }
        return $url;
    }
}