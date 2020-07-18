<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Field;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {
    $start_time = $end_time ?? Carbon::createFromTime(rand(8,16), 0, 0)->format('H:i'); //mt_rand(8,16) . ":" . str_pad(mt_rand(0,59), 2, "0", STR_PAD_LEFT);
    $end_time = Carbon::createFromTimeString($start_time)->addMinutes(90)->format('H:i');
    return [
        //'employee_id' => rand(1,5), // App\Employee::pluck('id')->random(), // this given by eloquent
        'start_time' => $start_time,
        'end_time' => $end_time,
        'date' => $faker->dateTimeBetween('-3 months', '+3 months')->format('Y-m-d'),
        'therapy_id' => rand(1,9),
        'therapist_id' => rand(1,5), //it didnt work: App\Employee::pluck('id')->random(),
        'record_id' => rand(20, 100),
        'reserved' => $faker->boolean(),
        'note' => $faker->paragraphs(rand(1,3), true),
    ];
});
