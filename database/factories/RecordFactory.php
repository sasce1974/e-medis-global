<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Record;
use Faker\Generator as Faker;

$factory->define(Record::class, function (Faker $faker) {

        $arr = array();
        for($i=0; $i< rand(3,7); $i++){
            $arr[] = [$faker->word() => $faker->sentence()];
        }

    return [
        'user_id' => App\User::pluck('id')->random(),
        //'content' => json_encode($faker->paragraphs(rand(1,3), false)), //if possible to fill in json column
        'content' => json_encode($arr), //json_encode($faker->words(2, false)),
        //'filled_by' => rand(1,5) //App\Employee::pluck('id')->random(), //this needs to be the employee that created field
    ];
});
