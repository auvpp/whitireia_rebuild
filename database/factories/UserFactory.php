<?php

use App\User;
use App\School;
use App\Programme;
use App\Major;
use App\Term;
use App\Section;
use App\Department;
use App\Qualification;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name'     => $faker->name,
        'last_name'      => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'active'         => 1,
        'role'           => $faker->randomElement(['student', 'teacher', 'admin', 'accountant', 'librarian']),
        'school_id' => function () use ($faker) {
          if (School::count())
            return $faker->randomElement(School::pluck('id')->toArray());
          else return factory(School::class)->create()->id;
        },
        // 'code' => function () use ($faker) {
        //   if (School::count())
        //     return $faker->randomElement(School::pluck('code')->toArray());
        //   else return factory(School::class)->create()->code;
        // },
        'code'   => $faker->unique()->randomNumber(8, false),
        'address'        => $faker->address,
        'pic_path'       => $faker->imageUrl(640, 480),
        'phone_number'   => $faker->unique()->phoneNumber,
        'verified'       => 1,
        'programme_id' => function () use ($faker) {
          if (Programme::count())
            return $faker->randomElement(Programme::pluck('id')->toArray());
          else return factory(Programme::class)->create()->id;
        },
        'major_id' => function () use ($faker) {
          if (Major::count())
            return $faker->randomElement(Major::pluck('id')->toArray());
          else return factory(Major::class)->create()->id;
        },
        'qualification_id' => function () use ($faker) {
          if (Qualification::count())
            return $faker->randomElement(Qualification::pluck('id')->toArray());
          else return factory(Qualification::class)->create()->id;
        },
        // 'term_id' => function () use ($faker) {
        //   if (Term::count())
        //     return $faker->randomElement(Term::pluck('id')->toArray());
        //   else return factory(Term::class)->create()->id;
        // },
        'enrolled_date' => date('Y-m-d'),
        // 'section_id' => function () use ($faker) {
        //   if (Section::count())
        //     return $faker->randomElement(Section::pluck('id')->toArray());
        //   else return factory(Section::class)->create()->id;
        // },
        // 'department_id' => function () use ($faker) {
        //   if (Department::count())
        //     return $faker->randomElement(Department::pluck('id')->toArray());
        //   else return factory(Department::class)->create()->id;
        // },
        //'blood_group'    => $faker->randomElement(['a+', 'b+', 'ab', 'o+']),
        //'nationality'    => 'New Zealand',
        'gender'         => $faker->randomElement(['male', 'female']),
        'about'          => $faker->sentences(1, true),
    ];
});

$factory->state(User::class, 'master', [
    'role' => 'master'
]);

$factory->state(User::class, 'accountant', [
    'role' => 'accountant'
]);

$factory->state(User::class, 'admin', [
    'role' => 'admin'
]);

$factory->state(User::class, 'librarian', [
    'role' => 'librarian'
]);

$factory->state(User::class, 'teacher', [
    'role' => 'teacher'
]);

$factory->state(User::class, 'student', [
    'role' => 'student'
]);
