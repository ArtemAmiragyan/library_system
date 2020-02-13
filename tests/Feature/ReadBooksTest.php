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
        $this->get("/books/{$this->book->id}")
            ->assertSee($this->book->title);
    }

    /** @test */
    function a_user_can_search_books()
    {
        $notRequiredBook = factory(Book::class)->create(['title' => 'not required']);
        $requiredBook = factory(Book::class)->create(['title' => 'foobar']);

        $this->get('/books?book=foobar')
            ->assertSee($requiredBook->title)
            ->assertDontSee($notRequiredBook->title);

        $this->get('/books?book=foo')
            ->assertSee($requiredBook->title)
            ->assertDontSee($notRequiredBook->title);
    }
}