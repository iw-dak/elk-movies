<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Type;
use App\Actor;
use App\Movie;
use App\Review;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(Type::class, function (Faker $faker) {
    $types = ['horror', 'drama', 'comedy', 'sci-fi', 'action'];
    shuffle($types);
    return [
        'label' => $types[array_rand($types)],
    ];
});
$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'releaser' => $faker->firstName,
        'release_date' => now(),
        'production_date' => now(),
        'poster' => $faker->imageUrl(),
        'summary' => $faker->text(150),
        'mark' =>   $faker->numberBetween(1,5),
        'duration' => $faker->time('H:i'),
        'country' => $faker->country,
        'type_id' => $faker->numberBetween(1,6),
    ];
});
$factory->define(Actor::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
    ];
});
$factory->define(Review::class, function (Faker $faker) {
    return [
        'movie_id' => $faker->numberBetween(1,49),
        'content' => $faker->text(80),
    ];
});
