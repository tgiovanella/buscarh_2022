<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'subject' => $faker->title(),
        'email' => $faker->email,
        'message' => $faker->text
    ];
});
