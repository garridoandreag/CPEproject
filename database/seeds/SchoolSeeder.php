<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('school')->insert([
        [
            'id' => 1,
            'name' => 'Colegio Pequeñas Estrellas',
            'phone_number' => '22445574',
            'cellphone_number' => '22447744',
            'address' => 'Res. San Rafael Buena Vista, Zona 18',
            'logo' => '1599985789CPE_logo.jpg',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]
    ]);

    $this->command->info('La tabla school ha sido rellenada.');

    }
}
