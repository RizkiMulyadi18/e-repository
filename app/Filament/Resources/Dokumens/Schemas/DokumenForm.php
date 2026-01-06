<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Set;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->compact()
                    ->description('')
                    ->schema([
                        Textarea::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->autosize()
                            ->columnSpan('full')
                            ->live(onBlur: true)
                            // 1. Saat form dibuka, ubah tampilan jadi rapi
                            ->formatStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            // 2. PENTING: Saat tombol Simpan ditekan, ubah data jadi rapi sebelum masuk database
                            ->dehydrateStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            ->afterStateUpdated(function (?string $state, Set $set) {
                                $set('slug', Str::slug($state ?? ''));
                            }),

                        Textarea::make('author')
                            ->label('Penulis')
                            ->required()
                            ->rows(2)
                            ->autosize() 
                            ->columnSpan('full')   
                            // 1. Saat form dibuka, ubah tampilan jadi rapi
                            ->formatStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            // 2. PENTING: Saat tombol Simpan ditekan, ubah data jadi rapi sebelum masuk database
                            ->dehydrateStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            ->maxLength(150),
                        
                        Textarea::make('institution')
                            ->label('Institusi')
                            ->required()
                            ->rows(2)
                            ->autosize() 
                            ->columnSpan('full')
                            // 1. Saat form dibuka, ubah tampilan jadi rapi
                            ->formatStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            // 2. PENTING: Saat tombol Simpan ditekan, ubah data jadi rapi sebelum masuk database
                            ->dehydrateStateUsing(fn(?string $state) => ucwords(strtolower($state)))
                            ->maxLength(200),

                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('year')
                            ->label('Tahun Terbit')
                            ->required()
                            ->minValue(1900)
                            ->maxValue((int) now()->format('Y') + 1)
                            ->numeric(),

                        Select::make('status')
                            ->label('Status')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                            ])
                            ->default('draft'),

                        FileUpload::make('file_path')
                            ->label('File PDF')
                            ->required()
                            ->disk('public')
                            ->directory('dokumen')
                            ->preserveFilenames()
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(30720) // 30 MB (dalam KB)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Metadata')
                    ->description('Informasi tambahan tentang dokumen.')
                    ->schema([
                        TextInput::make('slug')
                            ->label('Kata Kunci')
                            ->required()
                            ->maxLength(280)
                            ->unique(
                                ignoreRecord: true,
                                modifyRuleUsing: fn(Unique $rule) => $rule->whereNull('deleted_at')
                            )
                            ->columnSpanFull(),

                        RichEditor::make('abstract')
                            ->label('Abstrak')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
