<?php

namespace App\Filament\Resources\Dokumens\Tables;

use App\Models\Post;
use App\Models\Dokumen;
use Filament\Tables\Actions;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DokumensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()                                   // zebra rows
            ->paginated([10, 25, 50])                     // opsi page size
            ->defaultSort('created_at', 'desc')
            ->columns([
                //
                TextColumn::make('title')
                    ->label('Judul Dokumen')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('authors')
                    ->label('Penulis')
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('institution')
                    ->label('Institusi')
                    ->limit(30)
                    ->searchable(),
                    
                TextColumn::make('user.name')
                    ->label('Diunggah Oleh')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make()
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn (Dokumen $record) => !$record->trashed()),
                DeleteAction::make()
                    ->visible(fn (Dokumen $record) => ! $record->trashed()),
                ViewAction::make(),
                RestoreAction::make()
                    ->visible(fn (Dokumen $record) => $record->trashed()),
                ForceDeleteAction::make()
                    ->requiresConfirmation()
                    ->visible(fn (Dokumen $record) => $record->trashed()),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make()->requiresConfirmation(),
                ]),

            ])
            ->modifyQueryUsing(
                fn (Builder $query) => $query->withoutGlobalScopes([SoftDeletingScope::class])
            );
            
    }
}
