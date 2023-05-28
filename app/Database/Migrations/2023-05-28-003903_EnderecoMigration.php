<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class EnderecoMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'estado' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'cidade' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'endereco' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'numero' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
            'complemento' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('enderecos');
    }

    public function down()
    {
        $this->forge->dropTable('enderecos');
    }
}
