<?php

namespaceTests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateBookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_create_new_books()
    {
        $book = make('App\Book');

        $response = $this->post('/books', $book->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($book->title)
            ->assertSee($book->body);
    }

    /** @test */
    function a_book_requires_a_title()
    {
        $this->publishBook(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function a_thread_requires_a_body()
    {
        $this->publishBook(['description' => null])
            ->assertSessionHasErrors('description');
    }

    protected function publishBook($overrides = [])
    {;
        $book = make('App\Book', $overrides);

        return $this->post('/books', $book->toArray());
    }
}
