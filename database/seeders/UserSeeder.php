<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            [   
                'name' => 'Rizki',
                'email' => 'rizki@gmail.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // EDITORS
        $editors = [
            [   
                'name' => 'Budi',
                'email' => 'budi@gmail.com',
                'password' => Hash::make('editor123'),
                'role' => 'editor',
            ],
        ];

        foreach ($editors as $editor) {
            User::updateOrCreate(
                ['email' => $editor['email']],
                $editor
            );
        }
    }
}
