<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            [   
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'admin123',
                'role' => 'editor',
            ]
        );

        // EDITORS
        $editors = [
            [
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
                'password' => 'editor123',
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
