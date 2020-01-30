<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'author_id',
    ];

    public function path(): string
    {
        return '/books/' . $this->id;
    }

    public function getShortDescriptionAttribute(): string
    {
        return mb_substr($this->description, 0, 60);
    }

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
