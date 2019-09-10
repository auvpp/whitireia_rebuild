<?php

use App\School;
use App\MyClass;
use App\User;
use App\Term;
use Faker\Generator as Faker;

$factory->define(MyClass::class, function (Faker $faker) {
    // static $class_number = 0;

    // return [
    //     'class_number' => $class_number++, //$faker->randomDigitNotNull,
    //     'school_id'    => function() use ($faker) {
    //         if (School::count())
    //             return $faker->randomElement(School::pluck('id')->toArray());
    //         else return factory(School::class)->create()->id;
    //     },
    //     'group'        => function() use ($class_number, $faker) {
    //         $element = $faker->randomElement(['science', 'commerce', 'arts']);
    //         return ($class_number > 8) ? $element : "";
    //     }
    // ];

    return [
        'user_id' => function () use ($faker) {
            if (User::count())
              return $faker->randomElement(User::pluck('id')->toArray());
            else return factory(User::class)->create()->id;
          },
        'term_id'  => function () use ($faker) {
          if (Term::count())
            return $faker->randomElement(Term::pluck('id')->toArray());
          else return factory(Term::class)->create()->id;
        },
        'year'  => date('Y'),
    ];
});
