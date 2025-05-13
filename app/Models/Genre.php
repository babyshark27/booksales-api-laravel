<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
             'name'=> 'Fantasy',
             'description'=> 'A litraly genre that uses magic and other supernatural forms as a pimary element of plot,theme, or setting'
        ],
        [
            'name'=>'Mystery',
            'description'=> 'A genre of Fiction that deals with the solution of a crime or the unraveling f mystery'
        ],
        [
            'name'=> 'Romance',
            'description'=>'A Literally genre that focuses on the romantic relationship between characters'
        ],
        [
             'name'=> 'Non-Fiction',
             'description'=>'A literally work based on the imagination and not necessarilly on fact'
        ],
        [
            'name'=> 'Historical Fiction',
            'description'=>'A genre that reconstructs past events and figures, while often weaving in fictional elements'
        ],

    ];
    public function getGenres(){
        return $this->genres;
    }

    
}
