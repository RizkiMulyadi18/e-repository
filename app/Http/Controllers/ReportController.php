<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dokumen;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function cetakLaporan()
    {
        // 1. Ambil Data Statistik
        $totalDokumen = Dokumen::count();
        
        // Distribusi per Kategori
        $perKategori = Category::withCount('dokumens')->get();
        
        // Distribusi per Tahun (5 tahun terakhir)
        $perTahun = Dokumen::selectRaw('year, count(*) as total')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->limit(5)
            ->get();

        // 2. Load View PDF
        $pdf = Pdf::loadView('reports.dokumen-summary', compact('totalDokumen', 'perKategori', 'perTahun'));
        
        // 3. Download / Stream PDF
        return $pdf->stream('Laporan-Statistik-Repository.pdf');
    }
}