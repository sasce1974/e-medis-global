<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 100),
        //'department_id' => App\Department::pluck('id')->random(), //this should be handled by eloquent
        'role' => $faker->shuffleArray(['Unassigned', 'Doctor', 'Secretary', 'Manager'])[0],
        'employed_at' => $faker->dateTimeBetween('-20 years', 'now')->format('Y-m-d'),
    ];
});
