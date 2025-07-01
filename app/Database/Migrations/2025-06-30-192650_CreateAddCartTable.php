<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAddCartTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'CartId' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'user_id' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'session_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'Prodid' => [
                'type' => 'INT',
                'null' => false
            ],
            'ProdName' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true
            ],
            'ProdImage' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00
            ],
            'quantity' => [
                'type'       => 'INT',
                'default'    => 1
            ],
            'discount_percent' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00
            ],
            'shipping_cost' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'default'    => 0.00
            ],
            'tax_percent' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'default'    => 0.00
            ],
            'is_saved_later' => [
                'type'       => 'BOOLEAN',
                'default'    => false
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true,
            ]
        ]);

        $this->forge->addKey('CartId', true);
        $this->forge->createTable('cart');

        // 🟡 Manually add generated column using raw SQL
        $this->db->query('ALTER TABLE `cart` ADD COLUMN `totalAmount` DECIMAL(10,2) GENERATED ALWAYS AS (price * quantity) STORED');
    }

    public function down()
    {
        $this->forge->dropTable('cart');
    }
}
