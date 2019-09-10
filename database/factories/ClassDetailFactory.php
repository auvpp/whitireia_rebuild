<?php

use App\MyClass;
use App\Course;
use App\Grade;
use Faker\Generator as Faker;

$factory->define(App\ClassDetail::class, function (Faker $faker) {
    return [
        'class_id'   => function () use ($faker) {
            if (MyClass::count())
              return $faker->randomElement(MyClass::pluck('id')->toArray());
            else return factory(MyClass::class)->create()->id;
        },
        'grade_id'   => function () use ($faker) {
            if (Grade::count())
              return $faker->randomElement(Grade::pluck('id')->toArray());
            else return factory(Grade::class)->create()->id;
        },
        'course_id'   => function () use ($faker) {
            if (Course::count())
              return $faker->randomElement(Course::pluck('id')->toArray());
            else return factory(Course::class)->create()->id;
        },
        'credit' => $faker->randomElement([15, 20, 30, 45]),        
    ];
});
