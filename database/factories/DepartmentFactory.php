<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        //'clinic_id' => App\Clinic::pluck('id')->random(),
        'department_name_id' => rand(1,6),
        'note' => $faker->paragraphs(rand(1,3), true),
    ];
});
