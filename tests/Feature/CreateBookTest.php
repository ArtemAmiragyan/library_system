<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateBookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_book_requires_a_title()
    {
        $this->publishBook(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_book_requires_a_description()
    {
        $this->publishBook(['description' => null])
            ->assertSessionHasErrors('description');
    }

    protected function publishBook($overrides = [])
    {;
        $book = factory(Book::class, $overrides)->make();

        return $this->post('/books', $book->toArray());
    }
}
