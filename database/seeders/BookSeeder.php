<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'title' => 'pulang',
            'description' => 'petualangan seorangg pemuda yang kembali ke desa kelahirannya',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);
        Book::create([
            'title' => 'Sebuah Seni Untuk Bersikap Bodoamat',
            'description' => 'Buku yang membahas tentang Kehiduapan dan Filosofi Hidup Seseorang',
            'price' => 250000,
            'stock' => 5,
            'cover_photo' => 'sebuah_seni.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ]);
        Book::create([
            'title' => 'Naruto',
            'description' => 'Buku yang membahas jalan ninja seseorang',
            'price' => 30000,
            'stock' => 55,
            'cover_photo' => 'naruto.jpg',
            'genre_id' => 3,
            'author_id' => 3
        ]);
        Book::create([
            'title' => 'One Piece',
            'description' => 'Petualangan seorang bajak laut bernama Luffy untuk menemukan harta karun legendaris One Piece',
            'price' => 35000,
            'stock' => 40,
            'cover_photo' => 'one_piece.jpg',
            'genre_id' => 3,
            'author_id' => 4
        ]);
        
        Book::create([
            'title' => 'Attack on Titan',
            'description' => 'Perjuangan umat manusia melawan para Titan untuk bertahan hidup',
            'price' => 45000,
            'stock' => 25,
            'cover_photo' => 'attack_on_titan.jpg',
            'genre_id' => 3,
            'author_id' => 5
        ]);
    }
}
