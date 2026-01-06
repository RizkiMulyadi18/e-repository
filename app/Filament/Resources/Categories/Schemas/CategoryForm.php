<?php

namespace App\Filament\Resources\Categories\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Tambah Kategori Baru')
                    ->columnSpanFull()
                    ->description('')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            // 1. Saat form dibuka, ubah tampilan jadi rapi
                            ->formatStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            // 2. PENTING: Saat tombol Simpan ditekan, ubah data jadi rapi sebelum masuk database
                            ->dehydrateStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                $set('slug', Str::slug($state ?? ''));
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(170)
                            ->unique(
                                ignoreRecord: true,
                                modifyRuleUsing: fn(Unique $rule) => $rule->whereNull('deleted_at')
                            ),

                    ])
                    ->columns(2),
            ]);
    }
}
