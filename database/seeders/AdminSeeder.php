<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Cegah duplikasi admin jika sudah ada
        if (!User::where('email', 'admin@bandarlampung.go.id')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@bandarlampung.go.id',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
