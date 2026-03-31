<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;
use Illuminate\Support\Facades\Hash;

class PetugasSeeder extends Seeder
{
    public function run(): void
    {
        Petugas::updateOrCreate(
            ['username' => 'petugas1'],
            [
                'name' => 'Petugas Satu',
                'password' => Hash::make('password123'),
            ]
        );
    }
}

