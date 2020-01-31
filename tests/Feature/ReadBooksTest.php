<?php

namespace Tests\Feature;

use App\Book;
use App\Review;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadBooksTest extends TestCase
{
    use DatabaseMigrations;

    protected $book;

    public function setUp(): void
    {
        parent::setUp();

        $this->book = factory(Book::class)->create();
    }

    /** @test */
    public function a_user_can_view_all_books()
    {
        $this->get('/books')
            ->assertSee($this->book->title);
    }

    /** @test */
    function a_user_can_read_a_single_book()
    {
        $this->get($this->book->path())
            ->assertSee($this->book->title);
    }

    /** @test */
    function a_user_can_read_reviews_that_are_associated_with_a_book()
    {
        $review = factory(Review::class)->create([
            'book_id' => $this->book->id,
        ]);

        $this->get($this->book->path())
            ->assertSee($review->body);
    }

    /** @test */
    function a_user_can_create_new_reply()
    {
        $review = factory(Review::class)->create([
            'book_id' => $this->book->id,
        ]);

        $this->post($this->book->path(), $review->toArray());

        $this->get($this->book->path())
            ->assertSee($review->body);
    }

}
