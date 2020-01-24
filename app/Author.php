<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
      'first_name', 'last_name'
    ];
    public function path()
    {
        return '/authors/' . $this->id;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
