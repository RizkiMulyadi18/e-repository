<?php

namespace App\Filament\Resources\Dokumens\Tables;

use App\Models\Dokumen;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Columns\Column; // <--- Tambahkan ini

class DokumensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->wrap() // <--- TAMBAHKAN INI (Agar teks panjang turun ke bawah)
                    ->grow(true) // (Opsional) Memberikan porsi lebar paling banyak ke kolom ini
                    ->sortable()
                    ->limit(40),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->wrap()
                    ->sortable(),

                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'draft' => 'Draft',
                        'published' => 'Published',
                        default => $state,
                    })
                    ->color(fn(string $state) => match ($state) {
                        'draft' => 'warning',
                        'published' => 'success',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('user.name')
                    ->label('Diunggah oleh')
                    ->searchable()
                    ->badge()
                    ->color(fn($record): string => match ($record->user->role) {
                        // Cek kolom 'role' milik User terkait
                        'admin'  => 'danger',  // Role Admin -> Merah
                        'editor' => 'info',    // Role Editor -> Biru
                        default  => 'gray',    // Role lain -> Abu-abu
                    })
                    ->sortable(),

                TextColumn::make('created_at')
                    ->since() // Tampil sebagai "2 hours ago"
                    ->label('Waktu'),
            ])
            // 2. Tambahkan Tombol Export di Header (Atas Tabel)
            ->headerActions([
                ExportAction::make()
                    ->label('Ekspor Excel')
                    ->color('success') // Warna hijau
                    ->exports([
                        ExcelExport::make()
                            ->withFilename(fn($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                            ->withColumns([
                                // Kita definisikan satu per satu agar pasti berhasil
                                Column::make('title')->heading('Judul Dokumen'),
                                Column::make('author')->heading('Penulis'),
                                Column::make('year')->heading('Tahun'),
                                Column::make('category.name')->heading('Kategori'), // Relasi ke tabel kategori
                                Column::make('status')->heading('Status'),
                                Column::make('downloads')->heading('Jumlah Unduhan'),
                            ]),
                    ]),

                // Tombol 2: PDF (BARU)
                Action::make('cetak_pdf')
                    ->label('Cetak Laporan PDF')
                    ->icon('heroicon-o-printer')
                    ->color('warning') // Warna Oranye/Kuning
                    ->url(route('laporan.cetak'))
                    ->openUrlInNewTab(), // Buka di tab baru agar tidak close admin
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ]),

                SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(
                        fn() => Dokumen::query()
                            ->select('year')
                            ->distinct()
                            ->orderByDesc('year')
                            ->pluck('year', 'year')
                            ->toArray()
                    ),

                SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),

                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                RestoreAction::make(),
                ForceDeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
