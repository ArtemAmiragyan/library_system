<?php

namespace Tests\Feature;

use App\Book;
use App\Review;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use DatabaseMigrations;

    protected $book;

    public function setUp(): void
    {
        parent::setUp();

        $this->book = factory(Book::class)->create();
    }

    /** @test */
    function a_user_can_read_reviews_that_are_associated_with_a_book()
    {
        $review = factory(Review::class)->create([
            'book_id' => $this->book->id,
        ]);

        $this->get("/books/{$this->book->id}")
            ->assertSee($review->body);
    }

    /** @test */
    function a_user_can_create_new_review()
    {
        $this->signIn();

        $review = factory(Review::class)->make();

        $this->post("/reviews/{$this->book->id}/", $review->toArray());

        $this->assertDatabaseHas('reviews', ['book_id' => $this->book->id]);

    }

    /** @test */
    function unauthorized_users_cannot_delete_reviews()
    {
        $this->withExceptionHandling();

        $review = factory(Review::class)->create();

        $this->delete("/reviews/{$review->id}")
            ->assertRedirect('login');

        $this->signIn()
            ->delete("reviews/{$review->id}")
            ->assertStatus(403);
    }

    /** @test */
    function authorized_users_can_delete_reviews()
    {
        $this->signIn();
        $review = factory(Review::class)->create(['user_id' => auth()->id()]);

        $this->delete("/reviews/{$review->id}");
        $this->seeIsSoftDeletedInDatabase('reviews', ['id' => $review->id]);
    }

    /** @test */
    function authorized_users_can_update_replies()
    {
        $this->signIn();

        $review = factory(Review::class)->create([
            'book_id' => $this->book->id,
            'user_id' => auth()->id(),
        ]);

        $this->patch("reviews/{$review->id}", [
            'body' => 'Changed body for review',
            'assessment' => '1',
        ])
        ->assertStatus(200);

        $this->assertDatabaseHas('reviews', [
            'id' => $review->id,
            'body' => 'Changed body for review',
            'assessment' => '1',
        ]);
    }
}
