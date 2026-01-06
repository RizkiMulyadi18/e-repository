<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Dokumen;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Filament\Resources\Dokumens\DokumenResource;

class LatestDokumen extends BaseWidget
{
    protected static ?int $sort = 3; // Posisi di paling bawah
    protected int | string | array $columnSpan = 'full'; // Lebar penuh

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 dokumen terakhir
                Dokumen::query()->latest()->limit(5)
            )
            ->heading('Dokumen Terbaru Masuk') // Judul Tabel
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50),
                Tables\Columns\TextColumn::make('author')
                    ->label('Penulis'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        'draft' => 'warning',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->since() // Tampil sebagai "2 hours ago"
                    ->label('Waktu'),
            ])
            ->actions([
                // Tombol aksi cepat untuk edit/review
                Action::make('review')
                    ->url(fn (Dokumen $record) => DokumenResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square')
                    ->label('Review'),
            ]);
    }
}