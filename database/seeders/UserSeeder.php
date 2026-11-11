<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $moderatorRole = Role::query()->where('slug', Role::MODERATOR)->first();
        $readerRole = Role::query()->where('slug', Role::READER)->first();

        User::query()->updateOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name' => 'Модератор',
                'password' => Hash::make('password'),
                'role_id' => $moderatorRole?->id,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'reader@example.com'],
            [
                'name' => 'Читатель',
                'password' => Hash::make('password'),
                'role_id' => $readerRole?->id,
            ]
        );
    }
}
