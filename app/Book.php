<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function path()
    {
        return '/books/' . $this->id;
    }

    public function getShortDescriptionAttribute()
    {
        return mb_substr($this->description, 0, 200);
    }
}
