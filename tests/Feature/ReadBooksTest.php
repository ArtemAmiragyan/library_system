<?php

namespace Tests\Feature;

use App\Book;
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

}
