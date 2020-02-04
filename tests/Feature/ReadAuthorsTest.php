<?php

namespace Tests\Feature;

use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadAuthorsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @var \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    protected $author;

    public function setUp(): void
    {
        parent::setUp();

        $this->author = factory(Author::class)->create();
    }

    /** @test */
    public function a_user_can_view_authors_list()
    {
        $this->get('/authors')
            ->assertSee($this->author->first_name);
    }

    /** @test */
    public function a_user_can_view_author()
    {
        $this->get("/authors/{$this->author->id}")
            ->assertSee($this->author->first_name);
    }

    /** @test */
    public function a_user_can_filter_authors_list()
    {
        $authorWithThreeBooks = factory(Author::class)->create();
        factory(Book::class, 3)->create([
            'author_id' => $authorWithThreeBooks->id,
        ]);

        $this->get('/authors?lessThree=on')
            ->assertSee($this->author->first_name)
            ->assertDontSee($authorWithThreeBooks->first_name);
    }

}
