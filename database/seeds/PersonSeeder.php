<?php

use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('person')->insert(array(
            'id' => 1,
            'names' => 'CPE',
            'first_surname' => 'Admin',
            'second_surname' => 'Admin',
            'gender_id' => 2,
            'employee' => '1',
            'country_code' => '320',
            'subdivision_code' => '01',
                )
        );

        DB::table('users')->insert(array(
            'name' => 'CPE',
            'email' => 'CPE'.'@gmail.com',
            'password' => Hash::make('12345678'),
            'person_id' => 1,
            'role_id' => 1,
        ));

        $this->command->info('Se ha creado a CPE en PERSON');

    }
}
