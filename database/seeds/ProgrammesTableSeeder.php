<?php

use Illuminate\Database\Seeder;

class ProgrammesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert a master into the uses table
        DB::table('programmes')->insert([
            ['name' => 'Business', 'active' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
            ['name' => 'IT', 'active' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),],
        ]);
        //factory(App\Programme::class, 10)->create();
    }
}
