<?php

use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'name' => "Whitireia - Auckland Campus",
            //'last_name' => "syc",
            //'name'     => "syc701",
            //'email'    => 'syc701@qq.com',
            //'password' => bcrypt('secret'),
            //'role'     => 'master',
            //'active'   => 1,
            //'verified' => 1,
            //'phone_number' => 0210123456,
            'theme'       => 'flatly',
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        //factory(App\School::class, 1)->create();
    }
}
