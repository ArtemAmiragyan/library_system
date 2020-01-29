<?php

namespace Tests\Feature;

use App\Author;
use App\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateAuthorTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_can_create_new_author()
    {
        $author = factory(Author::class)->create();

        $this->post('/authors', $author->toArray());

        $this->get($author->path())
            ->assertSee($author->first_name);
    }

    /** @test */
    function a_author_requires_a_first_name()
    {
        $this->publishAuthor(['first_name' => null])
            ->assertSessionHasErrors('first_name');
    }

    /** @test */
    function a_author_requires_a_last_name()
    {
        $this->publishAuthor(['last_name' => null])
            ->assertSessionHasErrors('last_name');
    }

    protected function publishAuthor($overrides = [])
    {;
        $book = factory(Author::class, $overrides)->make();

        return $this->post('/authors', $book->toArray());
    }
}
