<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // 1. Mulai Query Dokumen
        // 'with' digunakan agar aplikasi tidak berat (Eager Loading kategori)
        $query = Dokumen::with('category')
            ->where('status', 'published'); // PENTING: Hanya tampilkan yang sudah publish

        // 2. Logika Pencarian (Search)
        if ($request->has('search') && $request->search != null) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($cq) use ($search) {
                        $cq->where('name', 'like', "%{$search}%")
                            ->orWhere('slug', 'like', "%{$search}%");
                    });
            });
        }

        // 3. Logika Filter Kategori (Dari Link di Hero Section)
        if ($request->has('category') && $request->category != null) {
            $categoryName = $request->category;
            // Cari dokumen yang punya kategori dengan nama tertentu
            $query->whereHas('category', function ($q) use ($categoryName) {
                $q->where('name', $categoryName);
            });
        }

        // 4. Ambil data, urutkan terbaru, paginasi 9 per halaman
        $dokumens = $query->latest()->paginate(9)->withQueryString();

        // TAMBAHAN BARU: Ambil semua kategori untuk dropdown
        $categories = Category::all();

        // Kirim variabel 'categories' ke view
        return view('frontend.home', compact('dokumens', 'categories'));
    }

    public function show($slug) // Parameter ditangkap sebagai $slug
    {
        $dokumen = Dokumen::with('category')
            ->where('status', 'published')
            ->where('slug', $slug) // Cari di kolom slug
            ->firstOrFail(); // Ambil yang pertama ketemu atau error 404

        return view('frontend.detail', compact('dokumen'));
    }

    public function download($slug)
    {
        // 1. Cari Dokumen
        $dokumen = Dokumen::where('slug', $slug)->firstOrFail();

        // 2. HITUNG STATISTIK (Penting agar widget admin jalan)
        $dokumen->increment('downloads');

        // 3. Proses Download File
        // Pastikan file path ada dan filenya eksis di storage
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            // Download file dengan nama asli dokumen
            return Storage::disk('public')->download($dokumen->file_path, $dokumen->title . '.pdf');
        }

        // Jika file fisik tidak ditemukan (misal terhapus manual)
        return back()->with('error', 'Maaf, file fisik dokumen ini tidak ditemukan di server.');
    }
}
