<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'administrator',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'name' => 'Admin Desa',
                'role' => 'admin',
            ],
            [
                'username' => 'pak_budi',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'name' => 'Pak Budi',
                'role' => 'user',
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);
    }
}
