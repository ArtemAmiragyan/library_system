<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

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
     * Get a short description for view.
     *
     * @return string
     */
    public function getShortDescriptionAttribute(): string
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
     * A book can be favorite
     *
     * @return MorphMany
     */
    public function favorites()
    {
        return $this->morphMany(Favorites::class, 'favorited');
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

    public function addToFavorites($userId)
    {
        $attrubutes = [
            'favorited_id' => $this->id,
            'user_id' => auth()->id(),
        ];

        if (!$this->favorites()->where(['favorited_id' => $this->id, 'user_id' => $userId])->exists()) {
            $this->favorites()->create($attrubutes);
        }
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }

    /**
     * Get the number of favorites for the reply.
     *
     * @return integer
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}
