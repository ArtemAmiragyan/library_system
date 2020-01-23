<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use DatabaseMigrations;

    function setUp(): void
    {
        parent::setUp();

        $this->book = factory('App\Book')->create();
    }

    /** @test */
    function a_user_can_read_books_list()
    {
        $response = $this->get('/books')
            ->assertSee($this->book->title)
            ->assertSee($this->book->shortDescription);
    }

    /** @test */
    function a_user_can_read_book_page()
    {
        $response = $this->get('/books/' . $this->book->id)
            ->assertSee($this->book->title)
            ->assertSee($this->book->description);
    }

}
