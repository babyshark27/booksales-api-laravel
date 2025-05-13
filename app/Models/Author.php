<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'name' => 'George R.R Martin',
            'photo' => 'george r.r. martin.jpg',
            'bio' => 'American novelist and short story writer',
        ],
        [
            'name' => 'Suzanne Collins',
            'photo' => 'suzanne collins.jpg',
            'bio' => 'Author of The Hunger Games trilogy',
        ],
        [
            'name' => 'Rick Riordan',
            'photo' =>'rick riordan.jpg',
            'bio' => 'Known for Percy Jackson and the Olympians series',
        ],
        [
            'name' => 'Isaac Asimov',
            'photo' =>'Isaac Asimov.jpg',
            'bio' => 'American author and professor of Biochemistry',
        ],
        [
            'name' => 'Isaac Asimov',
            'photo' =>'Isaac Asimov.jpg',
            'bio' => 'American author and professor of Biochemistry',
        ],
    ];
        

    public function getAuthors(){
        return $this->authors;
    }
}
