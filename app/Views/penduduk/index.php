<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Penduduk</h1>
    <p class="mb-4">
        Berikut adalah data penduduk yang terdaftar di sistem.
    </p>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="/penduduk/create" class="btn btn-primary mb-3">Tambah Penduduk</a>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Penduduk
            </h6>
        </div>
        <div class="card-body">
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-info"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>JK</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($penduduk)) : ?>
                            <?php foreach ($penduduk as $item) : ?>
                                <tr>
                                    <td><?= esc($item['id']) ?></td>
                                    <td><?= esc($item['nama']) ?></td>
                                    <td><?= esc($item['alamat']) ?></td>
                                    <td><?= esc($item['umur']) ?></td>
                                    <td><?= esc($item['jenis_kelamin']) ?></td>
                                    <td><?= esc($item['status_pernikahan']) ?></td>
                                    <td class="text-center">
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="/penduduk/edit/<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/penduduk/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm hapus-button">Hapus</a>
                                        <?php else : ?>
                                            <i>Tidak Memiliki Akses</i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data penduduk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection() ?>