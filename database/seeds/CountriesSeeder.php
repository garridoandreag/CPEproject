<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('country')->insert([
        [
          'code' => '320',
          'status' => 1,
          'name' => 'Guatemala',
          'description' => '',
          'alpha2' => 'GT',
          'alpha3' => 'GTM',
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s')
        ],
      ]);
    }
}
