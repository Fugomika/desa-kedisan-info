<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PendudukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Andi',
                'alamat' => 'Jl. Raya No. 1',
                'umur' => 30,
                'jenis_kelamin' => 'L',
                'status_pernikahan' => 'Kawin',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'created_by' => 1,
            ],
            [
                'nama' => 'Budi',
                'alamat' => 'Jl. Merdeka No. 10',
                'umur' => 25,
                'jenis_kelamin' => 'L',
                'status_pernikahan' => 'Belum Kawin',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'created_by' => 1,
            ],
            [
                'nama' => 'Citra',
                'alamat' => 'Jl. Desa No. 3',
                'umur' => 27,
                'jenis_kelamin' => 'P',
                'status_pernikahan' => 'Kawin',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 year')),
                'created_by' => 1,
            ],
            [
                'nama' => 'Dewi',
                'alamat' => 'Jl. Kebon No. 5',
                'umur' => 22,
                'jenis_kelamin' => 'P',
                'status_pernikahan' => 'Belum Kawin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'nama' => 'Eka',
                'alamat' => 'Jl. Pahlawan No. 7',
                'umur' => 35,
                'jenis_kelamin' => 'L',
                'status_pernikahan' => 'Kawin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'nama' => 'Fani',
                'alamat' => 'Jl. Karya No. 9',
                'umur' => 20,
                'jenis_kelamin' => 'P',
                'status_pernikahan' => 'Belum Kawin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
            ],
            [
                'nama' => 'Tufah',
                'alamat' => 'Jl. Indonesia No. 19',
                'umur' => 19,
                'jenis_kelamin' => 'P',
                'status_pernikahan' => 'Kawin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_by' => 1,
            ],

        ];

        // Using Query Builder
        $this->db->table('penduduk')->insertBatch($data);
    }
}
