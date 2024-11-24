<?php

namespace App\Controllers;

use App\Models\PendudukModel;
use App\Models\UserModel;
use App\Models\PengumumanModel;

class Home extends BaseController
{
    // Display the landing page
    public function index()
    {
        $pengumumanModel = new PengumumanModel();

        // Get the latest 4 pengumuman
        $data['pengumuman'] = $pengumumanModel->withAuthor()->limit(4)->findAllDescending();

        return view('landing-page', $data);
    }
    
    // Display the dashboard
    public function dashboard()
    {
        $pendudukModel = new PendudukModel();

        $pendudukCount = $pendudukModel->countAll();
        $pendudukCountByMonth = $pendudukModel->select('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->groupBy('month')
            ->findAll();

        // Get penduduk count by jenis_kelamin
        $genderCount = $pendudukModel->select('jenis_kelamin, COUNT(*) as count')
            ->groupBy('jenis_kelamin')
            ->findAll();

        // Get penduduk count by status_pernikahan
        $maritalStatusCount = $pendudukModel->select('status_pernikahan, COUNT(*) as count')
            ->groupBy('status_pernikahan')
            ->findAll();

        // Get penduduk age distribution
        $umurDistribution = $pendudukModel->select('FLOOR(umur / 5) * 5 as umur_range, COUNT(*) as count')
            ->groupBy('umur_range')
            ->findAll();

        $userModel = new UserModel();
        $pengumumanModel = new PengumumanModel();

        // Prepare data for the view
        $data = [
            'pendudukCount' => $pendudukCount,
            'userCount' => $userModel->countAll(),
            'pengumumanCount' => $pengumumanModel->countAll(),
            'pendudukCountByMonth' => $pendudukCountByMonth,
            'genderCount' => $genderCount,
            'maritalStatusCount' => $maritalStatusCount,
            'ageDistribution' => $umurDistribution,
        ];
        
        return view('dashboard', $data);
    }

    // Show all pengumuman
    public function pengumuman()
    {
        $pengumumanModel = new PengumumanModel();
        $data['pengumuman'] = $pengumumanModel->withAuthor()->findAllDescending();

        return view('semua-pengumuman', $data);
    }
}
