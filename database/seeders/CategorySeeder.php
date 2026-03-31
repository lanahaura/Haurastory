<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Novel', 'Komik', 'Teknologi', 'Pendidikan', 'Sejarah'];

        foreach ($names as $name) {
            Category::updateOrCreate(['name' => $name]);
        }
    }
}
