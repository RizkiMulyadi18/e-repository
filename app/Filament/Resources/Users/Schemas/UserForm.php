<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // BAGIAN 1: DATA DIRI (Dikelompokkan dalam Section)
                Section::make('Informasi Pengguna')
                    ->description('Identitas dasar pengguna.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user'), // Tambah Ikon User

                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-at-symbol'), // Tambah Ikon Email

                        Select::make('role')
                            ->label('Role Pengguna')
                            ->options([
                                'admin' => 'Admin',
                                'editor' => 'Editor',
                            ])
                            ->required()
                            ->native(false)
                            ->prefixIcon('heroicon-m-shield-check'), // Tambah Ikon Shield
                    ])->columns(2), // Tampil 2 kolom

                // BAGIAN 2: KEAMANAN (Password dipisah biar rapi)
                Section::make('Keamanan Akun')
                    ->description('Atur kata sandi untuk login.')
                    ->schema([
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable() // <--- INI FITUR LIHAT PASSWORDNYA
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->helperText(
                                fn(string $operation): ?string => $operation === 'edit'
                                    ? 'Kosongkan jika tidak ingin mengubah password.'
                                    : null
                            )
                            ->confirmed() // Wajib sama dengan field di bawah
                            ->prefixIcon('heroicon-m-key'),

                        TextInput::make('password_confirmation')
                            ->label('Ulangi Password')
                            ->password()
                            ->revealable() // <--- INI JUGA BIAR BISA DIINTIP
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->visible(fn(string $operation): bool => $operation === 'create' || $operation === 'edit')
                            ->prefixIcon('heroicon-m-check-circle'),
                    ])->columns(2),
            ]);
    }
}
