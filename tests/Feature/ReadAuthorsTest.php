<?php

namespace Tests\Feature;

use App\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadAuthorsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp():void
    {
        parent::setUp();

        $this->author = factory(Author::class)->create();
    }

    /** @test */
    public function a_user_can_view_authors_list()
    {
        $this->get('/authors')
            ->assertSee($this->author->first_name)
            ->assertSee($this->author->last_name);
    }

    public function a_user_can_view_author()
    {
        $this->get('/authors')
            ->assertSee($this->author->first_name)
            ->assertSee($this->author->last_name)
            ->assertSee($this->author->biography);
    }

}
