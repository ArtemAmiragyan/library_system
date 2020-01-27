<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Author::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'biography' => $faker->paragraph,
    ];
});

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'author_id' => function(){
            return factory(Author::class)->create()->id;
//            return App\Author::inRandomOrder()->first()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph(100),
    ];
});

$factory->define( App\Review::class, function (Faker $faker){
    return [
        'book_id' => function(){
            return factory('App\Book')->create()->id;
        },
        'user_id' => function (){
            return factory('App\User')->create()->id;
        },
        'body' => $faker->paragraph,
    ];
});
