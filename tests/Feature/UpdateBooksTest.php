<?php

namespace Tests\Feature;

use App\Book;
use App\Author;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UpdateBooksTest extends TestCase
{
    use DatabaseMigrations;

    protected $book;

    public function setUp(): void
    {
        parent::setUp();

        $this->book = factory(Book::class)->create();
    }

    /** @test */
    function a_book_can_be_updated()
    {
        $author = factory(Author::class)->create();
        $changedAuthor = factory(Author::class)->create();
        $book = factory(Book::class)->create([
            'author_id' => $author->id,
        ]);

        $this->put($book->path(), [
            'title' => 'Changed',
            'author_id' => $changedAuthor->id,
            'description' => 'This is a modified book description with more than thirty characters for validation',
        ]);

        $this->assertDatabaseHas('books', [
            'author_id' => $changedAuthor->id,
            'id' => $book->id, 'title' => 'Changed',
            'description' => 'This is a modified book description with more than thirty characters for validation',
        ]);
    }
}
