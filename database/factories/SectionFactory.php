<?php

use App\Section;
use App\MyClass;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'section_number' => $faker->randomElement(['A', 'B','C','D','E','F','G','H','I','J','K','L','M']),
        'room_number'    => $faker->randomDigitNotNull,
        'class_id'       => function() use ($faker) {
            if (MyClass::count())
                return $faker->randomElement(MyClass::pluck('id')->toArray());
            else return factory(MyClass::class)->create()->id;
        },
    ];
});
