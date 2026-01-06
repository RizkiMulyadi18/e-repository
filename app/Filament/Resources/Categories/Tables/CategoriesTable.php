<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                // 3. Jumlah Dokumen (FITUR KEREN: Menghitung relasi otomatis)
                TextColumn::make('dokumens_count') 
                    ->counts('dokumens') // Menghitung jumlah dokumen di kategori ini
                    ->label('Jumlah Dokumen')
                    ->badge()
                    ->color('primary'),

                // TextColumn::make('slug')
                    //->label('Slug')
                    //->searchable()
                    //->sortable(),

                TextColumn::make('user.name')
                    ->label('Dibuat oleh')
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
                    ->label('Dibuat')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
                ForceDeleteAction::make(),
                RestoreAction::make(),
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
