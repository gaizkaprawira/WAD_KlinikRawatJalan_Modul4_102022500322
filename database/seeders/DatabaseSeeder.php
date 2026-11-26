<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->firstOrNew(['username' => 'admin']);
        $admin->fill([
            'password' => Hash::make('password'),
        ]);
        $admin->role = User::ROLE_ADMIN;
        $admin->save();

        $user = User::query()->firstOrNew(['username' => 'user']);
        $user->fill([
            'password' => Hash::make('password'),
        ]);
        $user->role = User::ROLE_USER;
        $user->save();

        $this->call(ObatSeeder::class);
    }
}