<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateBookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_create_new_book()
    {
        $book = factory(Book::class)->create();

        $this->post('/books', $book->toArray());

        $this->get($book->path())
            ->assertSee($book->title);
    }

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

    /** @test */
    function a_book_can_be_deleted()
    {
        $book = factory('App\Book')->create();

        $response = $this->json('DELETE', $book->path());

        $response->assertStatus(302);

        $this->assertDatabaseMissing('books', [$book->id]);
    }

    protected function publishBook($overrides = [])
    {
        $book = factory(Book::class, $overrides)->make();

        return $this->post('/books', $book->toArray() + ['g-recaptcha-response' => 'token']);
    }
}
