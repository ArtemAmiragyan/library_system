<?php

namespace Tests\Feature;

use App\Review;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProfilesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_user_has_a_profile()
    {
        $user = factory(User::class)->create();

        $this->get("/profiles/{$user->id}")
            ->assertSee($user->name);
    }

    /** @test */
    function profiles_display_all_reviews_created_by_the_associated_user()
    {
        $user = factory(User::class)->create();

        $review = factory(Review::class)->create(['user_id' => $user->id]);

        $this->get("/profiles/{$user->id}")
            ->assertSee($review->body);
    }
}
