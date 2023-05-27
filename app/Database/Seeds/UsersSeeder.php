<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $data = [];
        $rows = 20;
        for ($i = 0; $i < $rows; $i++) {
            $data[] = [
                'user_name'  => $faker->name,
                'user_email' => $faker->email,
                'user_password' => password_hash($faker->password, PASSWORD_DEFAULT),
                'created_at' => new RawSql('CURRENT_TIMESTAMP()'),
                'updated_at' => new RawSql('CURRENT_TIMESTAMP()'),
            ];
        }

        $this->db->table('users')->insertBatch($data);
    }
}
