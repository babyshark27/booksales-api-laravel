<?php

namespace Database\Seeders;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'George R.R Martin',
            'photo' => 'george r.r. martin.jpg',
            'bio' => 'American novelist and short story writer'
        ]);
        Author::create([
            'name' => 'Suzanne Collins',
            'photo' => 'suzanne collins.jpg',
            'bio' => 'Author of The Hunger Games trilogy'
        ]);
        Author::create([
            'name' => 'Rick Riordan',
            'photo' =>'rick riordan.jpg',
            'bio' => 'Known for Percy Jackson and the Olympians series'
        ]);
        Author::create([
            'name' => 'Isaac Asimov',
            'photo' =>'Isaac Asimov.jpg',
            'bio' => 'American author and professor of Biochemistry'
        ]);
        Author::create([
            'name' => 'Agatha Christie',
            'photo' => 'agatha_christie.jpg',
            'bio' => 'British writer known for her detective novels featuring Hercule Poirot and Miss Marple'
        ]);
    }
}
