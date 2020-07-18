<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Clinic;
use Faker\Generator as Faker;

$factory->define(Clinic::class, function (Faker $faker) {
    return [
        //'user_id' => App\User::pluck('id')->random(),
        'name' => $faker->company,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'website' => $faker->domainName,
        'note' => $faker->paragraphs(rand(1,3), true),
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
