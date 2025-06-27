<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImageTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'file_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'file_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'product'
            ],
            'ref_id' => [
                'type'     => 'INT',
                'null'     => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('ImageModel');
    }

    public function down()
    {
        $this->forge->dropTable('ImageModel');
    }
}
