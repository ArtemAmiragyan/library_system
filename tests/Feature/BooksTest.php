<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_all_books()
    {
        $book = factory('App\Book')->create();

        $response = $this->get('/books');
        $response->assertSee($book->title);
        $response->assertSee($book->shortDescription);

    }

    /** @test */
    public function a_user_can_view_book()
    {
        $book = factory('App\Book')->create();

        $response = $this->get('/books/' . $book->id);
        $response->assertSee($book->title);
        $response->assertSee($book->description);
    }
}
