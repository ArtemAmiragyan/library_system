<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use phpDocumentor\Reflection\DocBlock\Tags\Author;
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
        $book = factory(Book::class)->create();

        $this->put($book->path(), [
            'title' => 'Changed',
            'description' => 'This is a modified book description with more than thirty characters for validation'
        ]);

        $this->assertDatabaseHas('books', ['id' => $book->id, 'title' => 'Changed', 'description' => 'This is a modified book description with more than thirty characters for validation']);
    }
}
