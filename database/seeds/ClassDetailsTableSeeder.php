<?php

use Illuminate\Database\Seeder;

class ClassDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ClassDetail::class, 20)->create();
    }
}