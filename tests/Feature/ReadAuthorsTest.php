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

    public function setUp():void
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
        $this->get($this->author->path())
            ->assertSee($this->author->first_name);
    }

    /** @test */
    public function a_user_can_filter_authors_list()
    {
        $author = factory(Author::class)->create();

        $authorWithThreeBooks = factory(Author::class, ['first_name' => 'hfdhfgh'])->create()->first();
        factory(Book::class, ['author_id' => $authorWithThreeBooks->id], 3)->create();
        $authorWithThreeBooks->first_name = 'fhfhf';
        $authorWithThreeBooks->save();

        $this->get('/authors?lessThree=on')
            ->assertSee($this->author->first_name)
            ->assertDontSeeText($authorWithThreeBooks->first_name);
    }

}
