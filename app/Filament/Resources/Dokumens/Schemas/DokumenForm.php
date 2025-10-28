<?php

namespace App\Filament\Resources\Dokumens\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class DokumenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('title')
                    ->label('Judul Dokumen')
                    ->required()
                    ->maxLength(255),

                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Skripsi' => 'Skripsi',
                        'Tesis' => 'Tesis',
                        'Jurnal' => 'Jurnal',
                        'Laporan Penelitian' => 'Laporan Penelitian',
                    ])
                    ->required()
                    ->searchable(),

                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(intval(date('Y')) + 1)
                    ->required(),

                TextInput::make('authors')
                    ->label('Penulis')
                    ->required(),
                    

                TextInput::make('institution')
                    ->label('Institusi')
                    ->maxLength(255),

                TextInput::make('keywords')
                    ->label('Kata Kunci (pisahkan dengan koma)'),
                    

                FileUpload::make('file_path')
                    ->maxParallelUploads(1)
                    ->label('File Dokumen')
                    ->disk('public') 
                    ->directory('documents')
                    ->visibility('public')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    ])
                    ->maxSize(10240)
                    ->required()
                    
            ]);
    }
}
