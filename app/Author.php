<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'biography',
    ];

    /**
     * Get a string path for the Author.
     *
     * @return string
     */
    public function path(): string
    {
        return '/authors/' . $this->id;
    }

    /**
     * A author may have many books.
     *
     * @return HasMany
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

}
