<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        // 1. Logika Pencarian
        $query = Dokumen::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('authors', 'like', "%{$search}%");
        }
        
        // Filter Kategori (Jika ada)
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // 2. Ambil data (Pagination 9 item per halaman)
        $dokumens = $query->latest()->paginate(9);

        // --- TAMBAHKAN BAGIAN INI ---
    if ($request->ajax()) {
        // Jika request via AJAX, render view partial saja
        return view('frontend.partials.list-dokumen', compact('dokumens'))->render();
    }

        // Kirim data dokumen saja ke view
        return view('frontend.home', compact('dokumens'));
    }

    public function show($id)
    {
        // Detail Dokumen
        $dokumen = Dokumen::findOrFail($id);

        return view('frontend.detail', compact('dokumen'));
    }
}