<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengumumanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'judul' => 'Selamat Datang!',
                'isi' => 'Selamat datang di website desa kami.',
                'image' => null, // Optional
                'created_at' => '2024-11-23 17:00:00',
                'created_by' => 1,
            ],
            [
                'judul' => 'Pengumuman Penting',
                'isi' => 'Hari ini akan dilaksanakan rapat desa.',
                'image' => null, // Optional
                'created_at' => '2024-11-23 17:00:00',
                'created_by' => 1,
            ],
        ];

        // Using Query Builder
        $this->db->table('pengumuman')->insertBatch($data);
    }
}