<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <!-- Show jumlah penduduk --> 
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Penduduk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pendudukCount ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-penduduk fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengumuman Dibuat</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengumumanCount ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-penduduk fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengguna</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $userCount ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-penduduk fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Penduduk by Marital Status Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penduduk by Marital Status</h6>
                </div>
                <div class="card-body">
                    <canvas id="pendudukMaritalStatusChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Penduduk Age Distribution Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penduduk Age Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="pendudukAgeDistributionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Penduduk Created Over Time Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penduduk Created Over Time</h6>
                </div>
                <div class="card-body">
                    <canvas id="pendudukCreatedChart"></canvas>
                </div>
            </div>
        </div>
        <!-- Penduduk by Gender Pie Chart -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Penduduk by Gender</h6>
                </div>
                <div class="card-body">
                    <canvas id="pendudukGenderChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script>
    const pendudukCreatedData = <?= json_encode(array_column($pendudukCountByMonth, 'count')) ?>;
    const pendudukCreatedLabels = <?= json_encode(array_column($pendudukCountByMonth, 'month')) ?>;

    const pendudukGenderData = <?= json_encode(array_column($genderCount, 'count')) ?>;
    const pendudukGenderLabels = <?= json_encode(array_column($genderCount, 'jenis_kelamin')) ?>;

    const pendudukMaritalStatusData = <?= json_encode(array_column($maritalStatusCount, 'count')) ?>;
    const pendudukMaritalStatusLabels = <?= json_encode(array_column($maritalStatusCount, 'status_pernikahan')) ?>;

    const pendudukUmurDistributionData = <?= json_encode(array_column($ageDistribution, 'count')) ?>;
    const pendudukUmurDistributionLabels = <?= json_encode(array_map(function ($range) {
        return $range['umur_range'] . '-' . ($range['umur_range'] + 4);
    }, $ageDistribution)) ?>;

    // Penduduk Created Over Time Chart
    const ctx1 = document.getElementById('pendudukCreatedChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: pendudukCreatedLabels,
            datasets: [{
                label: 'Penduduk Created',
                data: pendudukCreatedData,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Penduduk by Gender Pie Chart
    const ctx2 = document.getElementById('pendudukGenderChart').getContext('2d');
    new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: pendudukGenderLabels,
            datasets: [{
                label: 'Penduduk by Gender',
                data: pendudukGenderData,
                backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)'],
                borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                borderWidth: 1
            }]
        }
    });

    // Penduduk by Marital Status Chart
    const ctx3 = document.getElementById('pendudukMaritalStatusChart').getContext('2d');
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: pendudukMaritalStatusLabels,
            datasets: [{
                label: 'Penduduk by Marital Status',
                data: pendudukMaritalStatusData,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Penduduk Age Distribution Chart
    const ctx4 = document.getElementById('pendudukAgeDistributionChart').getContext('2d');
    new Chart(ctx4, {
        type: 'bar',
        data: {
            labels: pendudukUmurDistributionLabels,
            datasets: [{
                label: 'Penduduk by Age Distribution',
                data: pendudukUmurDistributionData,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>