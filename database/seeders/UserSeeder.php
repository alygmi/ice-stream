<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
       {
           // Buat Akun Admin Test
           User::create([
               'name' => 'Administrator Ice Stream',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('admin123'), // Silakan ganti sesuai keinginan
               'role' => 'admin',
           ]);

           // Buat Akun User Biasa Test
           User::create([
               'name' => 'John Doe User',
               'email' => 'user@gmail.com',
               'password' => Hash::make('user123'),
               'role' => 'user',
           ]);
       }
}
