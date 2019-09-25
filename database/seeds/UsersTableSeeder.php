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
            'term_name' => "T1",
            'last_name' => "Whitireia",
            'email'    => 'master@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'master',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0210123456',
            'address'   => '450 Queen Street, Auckland 1010, New Zealand',
            'school_id' => 0,
            'code'    => '00000001',
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am the master',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert an admin into the users table
        DB::table('users')->insert([
            'first_name' => "Admin",
            'last_name' => "Whitireia",
            'email'    => 'admin@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'admin',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0219876543',
            'address'   => '222 Lucky Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '00000002',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am an administrator',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Fatina",
            'last_name' => "Aweidah",
            'email'    => 'fatina.aweidah@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'admin',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0210575642',
            'address'   => '222 Lucky Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '00000003',
            'programme_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am an administrator',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
        
        // insert a student into the users table (bachelor in IT)
        DB::table('users')->insert([
            'first_name' => "Charles",
            'last_name' => "Li",
            'email'    => 'charles.li@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0256523565',
            'address'   => '333 Happy Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21700134',
            'programme_id' => 2,
            'qualification_id' => 5,
            'major_id' => 16,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (GD in IT)
        DB::table('users')->insert([
            'first_name' => "Ricky",
            'last_name' => "Zhao",
            'email'    => 'ricky.zhao@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0255478354',
            'address'   => '333 Happy Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21604341',
            'programme_id' => 2,
            'qualification_id' => 6,
            'major_id' => 17,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (PGD in IT)
        DB::table('users')->insert([
            'first_name' => "Sam",
            'last_name' => "Sheng",
            'email'    => 'sam.sheng@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0201253452',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21802559',
            'programme_id' => 2,
            'qualification_id' =>7,
            'major_id' =>18,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (MASTER in IT)
        DB::table('users')->insert([
            'first_name' => "Ying",
            'last_name' => "Zhang",
            'email'    => 'ying.zhang@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0210142757',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21802161',
            'programme_id' => 2,
            'qualification_id' =>8,
            'major_id' =>19,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (business analysis - bachelor in business)
        DB::table('users')->insert([
            'first_name' => "Snow",
            'last_name' => "Gu",
            'email'    => 'snow.gu@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0212156779',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21802494',
            'programme_id' => 1,
            'qualification_id' => 1,
            'major_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (marketing - bachelor in business)
        DB::table('users')->insert([
            'first_name' => "James",
            'last_name' => "Bond",
            'email'    => 'james.bond@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02122483245',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21701111',
            'programme_id' => 1,
            'qualification_id' => 1,
            'major_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (supply chain - bachelor in business)
        DB::table('users')->insert([
            'first_name' => "Angel",
            'last_name' => "Amelie",
            'email'    => 'angel.amelie@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0219321142',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21702222',
            'programme_id' => 1,
            'qualification_id' => 1,
            'major_id' => 3,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (finance - GD in business)
        DB::table('users')->insert([
            'first_name' => "Harry",
            'last_name' => "Potter",
            'email'    => 'harry.potter@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0234525823',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21600223',
            'programme_id' => 1,
            'qualification_id' => 2,
            'major_id' => 4,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (hospitality - GD in business)
        DB::table('users')->insert([
            'first_name' => "Elaine",
            'last_name' => "Robinson",
            'email'    => 'elaine.robinson@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0202325343',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21232443',
            'programme_id' => 1,
            'qualification_id' => 2,
            'major_id' => 5,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (management - GD in business)
        DB::table('users')->insert([
            'first_name' => "Jack",
            'last_name' => "Sparrow",
            'email'    => 'jack.sparrow@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '020922556',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21025656',
            'programme_id' => 1,
            'qualification_id' => 2,
            'major_id' => 6,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (marketing - GD in business)
        DB::table('users')->insert([
            'first_name' => "Forrest",
            'last_name' => "Gump",
            'email'    => 'forrest.gump@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0200433623',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21008392',
            'programme_id' => 1,
            'qualification_id' => 2,
            'major_id' => 7,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (finance - PGD in business)
        DB::table('users')->insert([
            'first_name' => "Jerry",
            'last_name' => "Mouse",
            'email'    => 'jerry.mouse@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0205402903',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21240384',
            'programme_id' => 1,
            'qualification_id' => 3,
            'major_id' => 8,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (hospitality - PGD in business)
        DB::table('users')->insert([
            'first_name' => "Tom",
            'last_name' => "Cat",
            'email'    => 'tom.cat@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02034046523',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21254324',
            'programme_id' => 1,
            'qualification_id' => 3,
            'major_id' => 9,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (information systems - PGD in business)
        DB::table('users')->insert([
            'first_name' => "Michael",
            'last_name' => "Corleone",
            'email'    => 'michael.corleone@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02056320234',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21433244',
            'programme_id' => 1,
            'qualification_id' => 3,
            'major_id' => 10,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (marketing - PGD in business)
        DB::table('users')->insert([
            'first_name' => "Ethan",
            'last_name' => "Hunt",
            'email'    => 'ethan.hunt@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02234012234',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21038452',
            'programme_id' => 1,
            'qualification_id' => 3,
            'major_id' => 11,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (finance - master in business)
        DB::table('users')->insert([
            'first_name' => "Lu",
            'last_name' => "Yu",
            'email'    => 'lu.yu@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0203462341',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21029421',
            'programme_id' => 1,
            'qualification_id' => 4,
            'major_id' => 12,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (hospitality - master in business)
        DB::table('users')->insert([
            'first_name' => "Jocelyn",
            'last_name' => "Yang",
            'email'    => 'jocelyn.yang@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0209394245',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21090562',
            'programme_id' => 1,
            'qualification_id' => 4,
            'major_id' => 13,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (information systems - master in business)
        DB::table('users')->insert([
            'first_name' => "Linda",
            'last_name' => "Li",
            'email'    => 'linda.li@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0202349215',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21049472',
            'programme_id' => 1,
            'qualification_id' => 4,
            'major_id' => 14,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // insert a student into the users table (marketing - master in business)
        DB::table('users')->insert([
            'first_name' => "Benjamin",
            'last_name' => "Braddock",
            'email'    => 'benjamin.braddock@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'student',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0205092384',
            'address'   => '222 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '21804633',
            'programme_id' => 1,
            'qualification_id' => 4,
            'major_id' => 15,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a student',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        //***************************************************************************
        // insert a tutor into the users table
        DB::table('users')->insert([
            'first_name' => "Arkar",
            'last_name' => "Kyaw",
            'email'    => 'arkar.kyaw@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02165456786',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '12000001',
            'programme_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Premalatha",
            'last_name' => "Sampath",
            'email'    => 'premalatha.sampath@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '020046551',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '12000002',
            'programme_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('users')->insert([
            'first_name' => "Shafiq",
            'last_name' => "Alam",
            'email'    => 'shafiq.alam@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02023789234',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '12000003',
            'programme_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Noor",
            'last_name' => "Al-Ani",
            'email'    => 'Noor.Al-Ani@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '022466418',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '12000004',
            'programme_id' => 2,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        // business tutors
        DB::table('users')->insert([
            'first_name' => "Keith",
            'last_name' => "Macky",
            'email'    => 'keith.macky@wandw.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0023355253',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000005',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Markus",
            'last_name' => "Klose",
            'email'    => 'markus.klose@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0220547893',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000006',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Paul",
            'last_name' => "Gilmour",
            'email'    => 'paul.gilmour@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '020221324',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000007',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
        
        DB::table('users')->insert([
            'first_name' => "Andrew",
            'last_name' => "Zaliwski",
            'email'    => 'andrew.zaliwski@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02232395',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000008',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Ann",
            'last_name' => "Cameron",
            'email'    => 'ann.cameron@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '02204334352',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000009',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Daymon",
            'last_name' => "Heyzer",
            'email'    => 'daymon.heyzer@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '022002332',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000010',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Jagath",
            'last_name' => "Pushpakuma",
            'email'    => 'jagath.pushpakumar@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0222332164',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000011',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Jonathan",
            'last_name' => "Latimer",
            'email'    => 'jonathan.latimer@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0222563215',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000012',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Matthew",
            'last_name' => "Abraham",
            'email'    => 'matthew.abraham@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '02063244154',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000013',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Rohit",
            'last_name' => "Pande",
            'email'    => 'rohit.pande@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '020389423',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000014',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Suzan",
            'last_name' => "Sariefe",
            'email'    => 'suzan.sariefe@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0264123677',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000015',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Jill",
            'last_name' => "Dawson",
            'email'    => 'Jill.Dawson@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '02654312543',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000016',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Yalim",
            'last_name' => "Ozdinc",
            'email'    => 'Yalim.Ozdinc@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'male',
            'phone_number' => '0265122332',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000017',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'first_name' => "Sharan",
            'last_name' => "GaribSingh",
            'email'    => 'Sharan.GaribSingh@whitireia.ac.nz',
            'password' => bcrypt('secret'),
            'role'     => 'teacher',
            'active'   => 1,
            'course_token'  => 1,
            'gender'   => 'female',
            'phone_number' => '0200936754',
            'address'   => '666 Health Road, Auckland 1010, New Zealand',
            'school_id' => 1,
            'code'    =>  '11000018',
            'programme_id' => 1,
            'enrolled_date' => date('Y-m-d'),
            'about'  => 'I am a tutor',
            'remember_token' => str_random(10),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        //factory(User::class, 1)->states('admin')->create();
        //factory(User::class, 1)->states('accountant')->create();
        //factory(User::class, 1)->states('librarian')->create();
        //factory(User::class, 4)->states('teacher')->create();
        // factory(User::class, 9)->states('student')->create();
    }
}
