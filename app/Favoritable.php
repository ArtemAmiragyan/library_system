<?php


namespace App;


use http\Env\Response;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Favoritable
{

    /**
     * Get the number of favorites for the reply.
     *
     * @return int
     */
    public function getFavoritesCountAttribute() : int
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

    /**
     * A book is favorite
     *
     * @return Response
     */
    public function isFavorited()
    {
        return $this->favorites->where('user_id', auth()->id())->count();
    }

    /**
     * Adding to favorite
     * @param $userId
     */
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
