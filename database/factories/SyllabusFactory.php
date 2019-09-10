<?php

use App\User;
use App\School;
use App\MyClass;
use App\Syllabus;
use Faker\Generator as Faker;

$factory->define(Syllabus::class, function (Faker $faker) {
    return [
        'file_path'   => $faker->url,
        'description' => $faker->sentences(3, true),
        'title'       => $faker->sentences(1, true),
        'active'      => $faker->randomElement([0, 1]),
        'school_id'   => function () use ($faker) {
            if (School::count())
                return $faker->randomElement(School::pluck('id')->toArray());
            else return factory(School::class)->create()->id;
        },
        'class_id' => function() use ($faker) {
            if (MyClass::count())
                return $faker->randomElement(MyClass::pluck('id')->toArray());
            else return factory(MyClass::class)->create()->id;
        },
        'user_id'  => function() use ($faker) {
            if (User::count())
                return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
        },
    ];
});
