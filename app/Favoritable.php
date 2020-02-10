<?php


namespace App;


use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favoritable
{

    /**
     * Get the number of favorites for the reply.
     *
     * @return integer
     */
    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
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

    public function isFavorited()
    {
        return $this->favorites->where('user_id', auth()->id())->count();
    }

    public function addToFavorites($userId)
    {
        $attrubutes = [
            'favorited_id' => $this->id,
            'user_id' => auth()->id(),
        ];

        if (!$this->favorites->where(['favorited_id' => $this->id, 'user_id' => $userId])->count()) {
            $this->favorites()->create($attrubutes);
        }
    }
}
