<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'biography',
    ];

    public function path(): string
    {
        return '/authors/' . $this->id;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
