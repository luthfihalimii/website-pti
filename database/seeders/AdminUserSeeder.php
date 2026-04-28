<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@piramidasoft.com'],
            [
                'name' => 'Piramida Admin',
                'password' => 'piramida123',
                'is_admin' => true,
            ]
        );
    }
}
