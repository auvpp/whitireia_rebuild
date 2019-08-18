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
        DB::table('users')->insert([
            'name'     => "syc701",
            'email'    => 'syc701@qq.com',
            'password' => bcrypt('secret'),
            'role'     => 'master',
            'active'   => 1,
            'verified' => 1,
            'phone_number' => 123456789,
            'school_id' => 0,
            
        ]);

        factory(User::class, 2)->states('admin')->create();
        factory(User::class, 1)->states('accountant')->create();
        factory(User::class, 1)->states('librarian')->create();
        factory(User::class, 5)->states('teacher')->create();
        factory(User::class, 10)->states('student')->create();
    }
}
