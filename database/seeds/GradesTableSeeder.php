<?php

use Illuminate\Database\Seeder;

class GradesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // insert a master into the uses table
        DB::table('grades')->insert([
            ['grade' => 'A+', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'A', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'B+', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'B', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'C+', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'C', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'P', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'D', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
            ['grade' => 'F', 'created_at'  => date('Y-m-d H:i:s'), 'updated_at'  => date('Y-m-d H:i:s'),],
        ]);

        //factory(App\Grade::class, 50)->create();
    }
}
