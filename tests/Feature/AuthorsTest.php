<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_view_authors_list()
    {
        $author = factory('App\Author')->create();

        $response = $this->get('/authors');
        $response->assertSee($author->first_name);
        $response->assertSee($author->last_name);

    }
}
