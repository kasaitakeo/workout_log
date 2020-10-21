<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

// ここのModelは変えて上げる必要がある。
use App\Models\ContactForm;
use Faker\Generator as Faker;

// ここのModelは変えて上げる必要がある。
$factory->define(ContactForm::class, function (Faker $faker) {
    return [
        //
        'your_name' => $faker->name,
        'title' => $faker->realText(50),
        'email' => $faker->unique()->email,
        'url' => $faker->url,
        'gender' => $faker->randomElement(['0', '1']),
        'age' => $faker->numberBetween($min = 1, $max = 6),
        'contact' => $faker->realText(200),
    ];
});
