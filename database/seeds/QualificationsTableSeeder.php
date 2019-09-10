<?php

use Illuminate\Database\Seeder;

class QualificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // business - bachelor
        DB::table('qualifications')->insert([
            'name' => "Bachelor of Applied Business Management",
            'level'    => 'Level 7',
            'programme_id' => 1,
            'credit'    => 360,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - GD
        DB::table('qualifications')->insert([
            'name' => "Graduate Diploma in Applied Business Studies",
            'level'    => 'Level 7',
            'programme_id' => 1,
            'credit'    => 120,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - PGD
        DB::table('qualifications')->insert([
            'name' => "Postgraduate Diploma in Management",
            'level'    => 'Level 8',
            'programme_id' => 1,
            'credit'    => 120,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business - master
        DB::table('qualifications')->insert([
            'name' => "Master of Management",
            'level'    => 'Level 9',
            'programme_id' => 1,
            'credit'    => 180,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - bachelor
        DB::table('qualifications')->insert([
            'name' => "Bachelor of Information Technology",
            'level'    => 'Level 7',
            'programme_id' => 2,
            'credit'    => 360,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - GD
        DB::table('qualifications')->insert([
            'name' => "Graduate Diploma in Information Technology",
            'level'    => 'Level 7',
            'programme_id' => 2,
            'credit'    => 120,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - PGD
        DB::table('qualifications')->insert([
            'name' => "Postgraduate Diploma in Information Technology",
            'level'    => 'Level 8',
            'programme_id' => 2,
            'credit'    => 120,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // information technology - master
        DB::table('qualifications')->insert([
            'name' => "Master of Information Technology",
            'level'    => 'Level 9',
            'programme_id' => 2,
            'credit'    => 180,
            'active' => 1,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
