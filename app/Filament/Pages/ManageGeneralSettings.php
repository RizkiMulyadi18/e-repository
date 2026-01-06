<?php

namespace App\Filament\Pages;

use BackedEnum;
use App\Models\Setting;
use Filament\Schemas\Schema;

use Filament\Pages\SettingsPage;
use App\Settings\GeneralSettings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs\Tab;

class ManageGeneralSettings extends SettingsPage
{
    protected static string $settings = GeneralSettings::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Sistem';
    protected static ?string $title = 'Konfigurasi Aplikasi';
    protected static ?string $slug = 'settings';
    protected static ?int $navigationSort = 99;

    public static function canAccess(): bool
    {
        return Gate::allows('viewAny', Setting::class);
    }

    public function getFormActions(): array 
    {
        // Pastikan Model Setting sudah di-import di atas (use App\Models\Setting;)
        if (Gate::denies('update', Setting::class)) {
            return [];
        }

        return parent::getFormActions();
    }

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Tabs::make('Settings')
                ->tabs([
                    // =================================================
                    // TAB 1: IDENTITAS & TAMPILAN (UMUM)
                    // =================================================
                    Tab::make('Umum & Tampilan')
                        ->icon('heroicon-o-computer-desktop') // Ikon Komputer
                        ->schema([
                            Grid::make(3) // Kita bagi area jadi 3 kolom
                                ->schema([

                                    // KOLOM KIRI (Lebar 2 bagian): Untuk Input Teks
                                    Group::make()
                                        ->schema([
                                            Section::make('Identitas')
                                                ->schema([
                                                    TextInput::make('site_name')
                                                        ->label('Nama Aplikasi')
                                                        ->required()
                                                        ->columnSpanFull(),
                                                ]),

                                            Section::make('Sistem')
                                                ->schema([
                                                    Select::make('theme_color')
                                                        ->label('Warna Tema')
                                                        ->options([
                                                            'primary' => 'Biru (Default)',
                                                            'danger'  => 'Merah',
                                                            'success' => 'Hijau',
                                                            'warning' => 'Kuning',
                                                        ]),

                                                    Toggle::make('site_active')
                                                        ->label('Status Website Aktif')
                                                        ->onColor('success')
                                                        ->offColor('danger')
                                                        ->helperText('Matikan untuk Mode Maintenance.'),
                                                ])->columns(2),
                                        ])
                                        ->columnSpan(2), // Memakan 2 kolom grid

                                    // KOLOM KANAN (Lebar 1 bagian): Khusus Logo
                                    Section::make('Logo')
                                        ->schema([
                                            FileUpload::make('site_logo')
                                                ->hiddenLabel() // Sembunyikan label agar bersih
                                                ->image()
                                                ->disk('public')
                                                ->directory('logos')
                                                ->visibility('public')
                                                ->imageEditor()
                                                ->columnSpanFull(),
                                        ])
                                        ->columnSpan(1), // Memakan 1 kolom grid
                                ]),
                        ]),

                    // =================================================
                    // TAB 2: FOOTER & KONTAK (KONTEN)
                    // =================================================
                    Tab::make('Footer & Kontak')
                        ->icon('heroicon-o-chat-bubble-bottom-center-text') // Ikon Chat/Teks
                        ->schema([

                            Grid::make(2) // Grid 2 Kolom Sebelahan
                                ->schema([
                                    // SISI KIRI: PENGATURAN FOOTER
                                    Section::make('Teks Footer')
                                        ->schema([
                                            Textarea::make('footer_text')
                                                ->label('Deskripsi Singkat (Kiri)')
                                                ->rows(4) // Sedikit lebih tinggi
                                                ->placeholder('Tulis deskripsi aplikasi di sini...'),

                                            Textarea::make('site_footer')
                                                ->label('Copyright (Bawah)')
                                                ->rows(2)
                                                ->placeholder('Contoh: © 2026 Universitas Konoha'),
                                        ])->columnSpan(1),

                                    // SISI KANAN: KONTAK
                                    Section::make('Informasi Kontak')
                                        ->schema([
                                            Textarea::make('site_address')
                                                ->label('Alamat Kantor')
                                                ->rows(2),

                                            TextInput::make('site_email')
                                                ->label('Email Resmi')
                                                ->email()
                                                ->prefixIcon('heroicon-m-envelope'),

                                            TextInput::make('site_phone')
                                                ->label('Nomor Telepon/WA')
                                                ->tel()
                                                ->prefixIcon('heroicon-m-phone'),
                                        ])->columnSpan(1),
                                ]),
                        ]),
                ])
                ->columnSpanFull(), // Agar Tabs memenuhi lebar layar
        ]);
    }
}
