<?php

use Illuminate\Database\Seeder;

class MajorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\Major::class, 10)->create();

        // business - bachelor
        DB::table('majors')->insert([
            'name' => "Business Analysis and Knowledge Management",
            'qualification_id' => 1,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('majors')->insert([
            'name' => "Marketing and Sales",
            'qualification_id' => 1,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('majors')->insert([
            'name' => "Supply Chain and Logistics Management",
            'qualification_id' => 1,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - GD
        DB::table('majors')->insert([
            'name' => "Finance",
            'qualification_id' => 2,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - GD
        DB::table('majors')->insert([
            'name' => "Hospitality",
            'qualification_id' => 2,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - GD
        DB::table('majors')->insert([
            'name' => "Management",
            'qualification_id' => 2,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - GD
        DB::table('majors')->insert([
            'name' => "Marketing",
            'qualification_id' => 2,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - PGD
        DB::table('majors')->insert([
            'name' => "Finance",
            'qualification_id' => 3,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - PGD
        DB::table('majors')->insert([
            'name' => "Hospitality",
            'qualification_id' => 3,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - PGD
        DB::table('majors')->insert([
            'name' => "Information Systems",
            'qualification_id' => 3,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - PGD
        DB::table('majors')->insert([
            'name' => "Marketing",
            'qualification_id' => 3,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - master
        DB::table('majors')->insert([
            'name' => "Finance",
            'qualification_id' => 4,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - master
        DB::table('majors')->insert([
            'name' => "Hospitality",
            'qualification_id' => 4,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - master
        DB::table('majors')->insert([
            'name' => "Information Systems",
            'qualification_id' => 4,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - master
        DB::table('majors')->insert([
            'name' => "Marketing",
            'qualification_id' => 4,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - bachelor
        DB::table('majors')->insert([
            'name' => "General IT",
            'qualification_id' => 5,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - GD
        DB::table('majors')->insert([
            'name' => "General IT",
            'qualification_id' => 6,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - PGD
        DB::table('majors')->insert([
            'name' => "General IT",
            'qualification_id' => 7,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - master
        DB::table('majors')->insert([
            'name' => "General IT",
            'qualification_id' => 8,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
