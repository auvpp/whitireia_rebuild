<?php

use Illuminate\Database\Seeder;

class TermsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('terms')->insert([
            'term_name' => "T2",
            'start_date' => "2019-07-16",
            'end_date' => "2019-11-08",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('terms')->insert([
            'term_name' => "T3",
            'start_date' => "2019-11-12",
            'end_date' => "2020-02-28",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('terms')->insert([
            'term_name' => "T1",
            'start_date' => "2020-03-02",
            'end_date' => "2020-06-26",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('terms')->insert([
            'term_name' => "T2",
            'start_date' => "2020-07-13",
            'end_date' => "2020-11-06",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('terms')->insert([
            'term_name' => "T3",
            'start_date' => "2020-11-09",
            'end_date' => "2021-02-26",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
