<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('RoleSeeder');
        $this->call('CountriesSeeder');
        $this->call('SubdivisionSeeder');
        $this->call('gender_seed');
        $this->call('grade_seed');
    }
}
