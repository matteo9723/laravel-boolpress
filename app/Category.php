<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // se faccio una query così $category = Category::find($id)
    // voglio sapere quali sono i post con quella categoria in un array
    // li leggerò così: $category->posts (questa proprietà è in realtà un metodo)

    public function posts(){

        return $this->hasMany('App\Post');

    }
}
