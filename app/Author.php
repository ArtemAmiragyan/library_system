<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function path()
    {
        return '/authors/' . $this->id;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
