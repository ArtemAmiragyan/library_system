<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = [
      'first_name', 'last_name', 'biography',
    ];
    public function path()
    {
        return '/authors/' . $this->id;
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
    protected function publishAuthor($overrides = [])
    {;
        $book = factory(Author::class, $overrides)->make();

        return $this->post('/authors', $book->toArray());
    }
}
