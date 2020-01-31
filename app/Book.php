<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get a string path for the book.
     *
     * @return string
     */
    public function path()
    {
        return '/books/' . $this->id;
    }

    /**
     * Get a short description for view.
     *
     * @return string
     */
    public function getShortDescriptionAttribute()
    {
        return mb_substr($this->description, 0, 60);
    }

    /**
     * A book may have many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * A book belongs to a author.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Add a review to the book.
     *
     * @param $review
     */
    public function addReview($review)
    {
        $this->reviews()->create($review);
    }
}
