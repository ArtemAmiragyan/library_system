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
    public function a_user_can_visit_books_page()
    {
        $this->get('/books')
            ->assertViewIs('books.index');
    }

    /** @test */
    function a_user_can_read_a_single_book()
    {
        $this->get("/books/{$this->book->id}")
            ->assertSee($this->book->title);
    }

    /** @test */
    function a_user_can_get_all_books_for_search()
    {
        $this->get('/getBooks')
            ->assertJson([]);
    }
}