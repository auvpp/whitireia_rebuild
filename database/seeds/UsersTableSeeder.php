<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert a master into the uses table
        DB::table('users')->insert([
            'first_name' => "syc",
            'last_name' => "syc",
            //'name'     => "syc701",
            'email'    => 'syc701@qq.com',
            'password' => bcrypt('secret'),
            'role'     => 'master',
            'active'   => 1,
            'verified' => 1,
            'gender'   => 'male',
            'phone_number' => '0210123456',
            'address'   => '450 Queen Street, Auckland 1010, New Zealand',
            'school_id' => 0,
            'code'    => '00000000',
            'programme_id' => 0,
            'major_id' =>0,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am the master',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert an admin named ying into the users table
        DB::table('users')->insert([
            'first_name' => "ying",
            'last_name' => "zhang",
            //'name'     => "syc701",
            'email'    => 'ying@qq.com',
            'password' => bcrypt('secret'),
            'role'     => 'admin',
            'active'   => 1,
            'verified' => 1,
            'gender'   => 'male',
            'phone_number' => '021111222333',
            'address'   => '222 Lucky Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11111111',
            'programme_id' => 1,
            'major_id' =>1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am an administrator',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        factory(User::class, 1)->states('admin')->create();
        //factory(User::class, 1)->states('accountant')->create();
        //factory(User::class, 1)->states('librarian')->create();

        // insert a tutor named charles into the users table
        DB::table('users')->insert([
            'first_name' => "charles",
            'last_name' => "li",
            'email'    => 'charles@qq.com',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'verified' => 1,
            'gender'   => 'male',
            'phone_number' => '021333444555',
            'address'   => '333 Happy Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '33333333',
            'programme_id' => 1,
            'major_id' =>1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a teacher',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        factory(User::class, 4)->states('teacher')->create();

        // insert a student named sam into the users table
        DB::table('users')->insert([
            'first_name' => "sam",
            'last_name' => "sheng",
            'email'    => 'sam@qq.com',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'verified' => 1,
            'gender'   => 'male',
            'phone_number' => '0212222333444',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '22222222',
            'programme_id' => 1,
            'major_id' =>1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        factory(User::class, 9)->states('student')->create();
    }
}
