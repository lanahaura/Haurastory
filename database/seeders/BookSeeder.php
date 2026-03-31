<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $novel = Category::where('name', 'Novel')->first();
        $komik = Category::where('name', 'Komik')->first();
        $tech  = Category::where('name', 'Teknologi')->first();

        $books = [
            [
                'category_id' => $novel->id,
                'title' => 'Hujan di Bulan Februari',
                'author' => 'Ayu Lestari',
                'publisher' => 'Pustaka Ceria',
                'published_year' => 2021,
                'stock' => 3,
            ],
            [
                'category_id' => $komik->id,
                'title' => 'Petualangan Si Kuning',
                'author' => 'Bimo Saputra',
                'publisher' => 'Komik Nusantara',
                'published_year' => 2019,
                'stock' => 5,
            ],
            [
                'category_id' => $tech->id,
                'title' => 'Laravel Untuk Pemula',
                'author' => 'Dewi Putri',
                'publisher' => 'Coding Press',
                'published_year' => 2024,
                'stock' => 2,
            ],
        ];

        foreach ($books as $b) {
            Book::updateOrCreate(
                ['title' => $b['title']],
                $b
            );
        }
    }
}
