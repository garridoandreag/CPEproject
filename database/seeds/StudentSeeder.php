<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('person')->insert([
            [
                'id' => 10,
                'names' => 'MELISSA',
                'first_surname'=> 'GUEVARA',
                'second_surname'=> 'LUX',
                'favorite_name'=> 'MELI',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 1,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'names' => 'ERICK',
                'first_surname'=> 'GUZMAN',
                'second_surname'=> 'LUX',
                'favorite_name'=> 'ERICK',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 2,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'names' => 'ELIAS',
                'first_surname'=> 'TORRES',
                'second_surname'=> 'DIAZ',
                'favorite_name'=> 'ELIAS',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 2,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'names' => 'TOMAS',
                'first_surname'=> 'LOPEZ',
                'second_surname'=> 'GARRIDO',
                'favorite_name'=> 'TOMY',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 2,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'names' => 'ELISSA',
                'first_surname'=> 'GUERRA',
                'second_surname'=> 'LAINEZ',
                'favorite_name'=> 'ELI',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 1,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'names' => 'RAQUEL',
                'first_surname'=> 'PEREZ',
                'second_surname'=> 'DIAZ',
                'favorite_name'=> 'RAQUEL',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 1,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'names' => 'LUCAS',
                'first_surname'=> 'GUEVARA',
                'second_surname'=> 'LUX',
                'favorite_name'=> 'LUCAS',
                'phone_number' => '24847114',
                'home_address' => 'Z 18',
                'gender_id' => 2,
                'student' => 1,
                'status' => 'ACTIVO',
                'country_code' => '320',
                'subdivision_code' => '02',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);


        DB::table('student')->insert([
            [
                'id' => 10,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 11,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 12,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 13,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 14,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 15,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 16,
                'student_code' => '2415',
                'birthday'=> date('1999-03-24'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ]);
    }
}
