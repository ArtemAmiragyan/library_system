<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
      'title',
      'description',
      'author_id',
    ];

    public function path()
    {
        return '/books/' . $this->id;
    }

    public function getShortDescriptionAttribute()
    {
        return mb_substr($this->description, 0, 60);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
