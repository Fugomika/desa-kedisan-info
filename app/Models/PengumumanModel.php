<?php

namespace App\Models;

use CodeIgniter\Model;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'isi', 'image', 'created_by'];
    protected $useTimestamps = true;
    
    // Join with users table
    public function withAuthor()
    {
        return $this->join('users', 'users.id = pengumuman.created_by');
    }

    // Find all pengumuman descending
    public function findAllDescending()
    {
        return $this->orderBy('created_at', 'DESC')->findAll();
    }
}