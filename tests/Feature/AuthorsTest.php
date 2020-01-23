<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorsTest extends TestCase
{
    use DatabaseMigrations;

    function setUp(): void
    {
        parent::setUp();

        $this->author = factory('App\Author')->create();
    }

    /** @test */
    function a_user_can_read_authors_list()
    {
        $response = $this->get('/authors')
            ->assertSee($this->author->first_name)
            ->assertSee($this->author->last_name);

    }

    /** @test */
    function a_user_can_read_author_page()
    {
        $response = $this->get('/authors/' . $this->author->id)
            ->assertSee($this->author->first_name)
            ->assertSee($this->author->last_name);
    }
}
