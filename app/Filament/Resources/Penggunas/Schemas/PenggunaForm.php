<?php

namespace App\Filament\Resources\Penggunas\Schemas;

use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PenggunaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name'),

                TextInput::make('email')
                    ->email(),

                TextInput::make('password')
                    ->password()
                    ->autocomplete('new-password'),

                Select::make('role')
                    ->label('Pilih Role')
                    ->options([
                        'admin' => 'Admin',
                        'editor' => 'Editor',
                    ])
                    ->required()
                    ->searchable()
                    ->disabled(function (): bool {
                        /** @var User|null $user */
                         $user = Auth::user();
                        return ! ($user && $user->isAdmin());
                     })
            ]);
    }
}
