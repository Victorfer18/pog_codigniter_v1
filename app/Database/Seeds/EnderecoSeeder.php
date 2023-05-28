<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $data = [
            'id_user' => 21,
            'estado' => $faker->state,
            'cidade' => $faker->city,
            'endereco' => $faker->address,
            'numero' => $faker->buildingNumber,
            'complemento' => $faker->optional()->secondaryAddress,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('enderecos')->insert($data);
    }
}
