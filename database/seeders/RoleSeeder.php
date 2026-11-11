<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->updateOrCreate(
            ['slug' => Role::MODERATOR],
            ['name' => 'Модератор']
        );

        Role::query()->updateOrCreate(
            ['slug' => Role::READER],
            ['name' => 'Читатель']
        );
    }
}
