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

        $this->assertCount(1, $book->favorites);
    }

    /** @test */
    function an_authenticated_user_may_only_favorite_a_book_once()
    {
        $this->signIn();

        $book = factory(Book::class)->create();

        $this->post("books/{$book->id}/favorites");

        try {
            $this->post("books/{$book->id}/favorites");
        } catch (\Exception $e) {
            $this->fail('Did not expect to insert the same record set twice.');
        }

        $this->assertCount(1, $book->favorites);
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
