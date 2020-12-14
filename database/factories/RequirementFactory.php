<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Requirement;
use Faker\Generator as Faker;

$factory->define(Requirement::class, function (Faker $faker) {
    return [
        'course_id' => Course::all()->random()->id,
        'requirement' => $faker->sentence
    ];
});
