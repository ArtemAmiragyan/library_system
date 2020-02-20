<?php

namespace Tests\Feature;

use App\Book;
use App\Favorites;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function guests_can_not_favorite_anything()
    {
        $this->withExceptionHandling()
            ->post('books/1/favorites')
            ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_book()
    {
        $this->signIn();

        $book = factory(Book::class)->create();

        $this->post("books/{$book->id}/favorites");
        $this->assertDatabaseHas('favorites', ['favorited_id' => $book->id]);

    }

    /** @test */
    function authorized_users_can_delete_reviews()
    {
        $this->signIn();
        $book = factory(Book::class)->create();
        $favorite = factory(Favorites::class)->create(['user_id' => auth()->id(), 'favorited_id' => $book->id]);

        $this->delete("/books/{$book->id}/favorites/delete");
        $this->assertDatabaseMissing('favorites', ['id' => $favorite->id]);
    }
}
