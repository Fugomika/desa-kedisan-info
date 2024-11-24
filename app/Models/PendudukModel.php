<?php

namespace App\Models;

use CodeIgniter\Model;

class PendudukModel extends Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'alamat', 'umur', 'jenis_kelamin', 'status_pernikahan', 'created_at', 'updated_at', 'created_by'];
    protected $useTimestamps = true;
}
