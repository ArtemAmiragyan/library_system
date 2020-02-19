<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use SoftDeletes;
    use Favoritable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'author_id',
        'description'
    ];

    protected $with = [
        'favorites',
    ];

    protected $appends = ['favoritesCount', 'isFavorited'];

    /**
     * Get a string path for the book.
     *
     * @return string
     */
    public function path(): string
    {
        return '/books/' . $this->id;
    }

    /**
     * A book may have many reviews.
     *
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class)->latest();
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
