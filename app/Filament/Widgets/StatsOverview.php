<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Dokumen;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    // Mengatur agar widget ini refresh otomatis tiap 15 detik (Realtime feel)
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        return [
            // 1. Total Dokumen (Ada chart sparkline hijau biar keren)
            Stat::make('Total Dokumen', Dokumen::count())
                ->description('Semua karya ilmiah')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17]) // Dummy chart visual
                ->color('primary'),

            // 2. PERLU REVIEW (Paling Penting untuk Admin)
            Stat::make('Perlu Review', Dokumen::where('status', 'draft')->count())
                ->description('Dokumen menunggu dipublikasi')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning') // Kuning biar eye-catching
                ->chart([2, 5, 1, 0, 5, 2]),

            // 3. Total Kategori
            Stat::make('Total Kategori', Category::count())
                ->description('Bidang keilmuan')
                ->color('info')
                ->icon('heroicon-o-tag'),

            // --- [BARU] 3. TOTAL UNDUHAN ---
            // Catatan: Pastikan ada kolom 'downloads' di database. 
            // Jika nama kolomnya 'views' atau 'hits', ganti kata 'downloads' di bawah.
            Stat::make('Total Unduhan', Dokumen::sum('downloads') ?? 0) 
                ->description('Total file diakses')
                ->descriptionIcon('heroicon-m-arrow-down-tray')
                ->color('success') // Warna Hijau
                ->columnSpan(2)
                ->chart([10, 50, 30, 80, 40, 100]), // Hiasan grafik kecil (dummy)
            // -------------------------------

            // 4. User Aktif
            Stat::make('User Terdaftar', User::count())
                ->description('Admin & Editor')
                ->color('success')
                ->icon('heroicon-o-users'),
        ];
    }
}