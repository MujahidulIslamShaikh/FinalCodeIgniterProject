<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SignupModelSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'    => 'testuser1',
                'email'       => 'test1@example.com',
                'password'    => password_hash('password123', PASSWORD_DEFAULT),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'username'    => 'testuser2',
                'email'       => 'test2@example.com',
                'password'    => password_hash('secret456', PASSWORD_DEFAULT),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]
        ];

        // Insert multiple rows
        $this->db->table('signups')->insertBatch($data);
    }
}
