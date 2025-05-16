<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name'=> 'Fantasy',
            'description'=> 'A litraly genre that uses magic and other supernatural forms as a pimary element of plot,theme, or setting.'
        ]);

        Genre::create([
            'name'=>'Mystery',
            'description'=> 'A genre of Fiction that deals with the solution of a crime or the unraveling f mystery.'
        ]);

        Genre::create([
            'name'=> 'Romance',
            'description'=>'A Literally genre that focuses on the romantic relationship between characters.'
        ]);

        Genre::create([
           'name'=> 'Non-Fiction',
           'description'=>'A literally work based on the imagination and not necessarilly on fact.'
        ]);

        Genre::create([
           'name'=> 'Historical Fiction',
           'description'=>'A genre that reconstructs past events and figures, while often weaving in fictional elements.'
        ]);
    }
}
