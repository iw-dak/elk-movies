<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Movie;
use App\Type;
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
        'label' => $types[0],
    ];
});
$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'release_date' => now(),
        'production_date' => now(),
        'poster' => $faker->imageUrl(),
        'country' => $faker->country,
        'type_id' => $faker->numberBetween(1,6),
    ];
});
