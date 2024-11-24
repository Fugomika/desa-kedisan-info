<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengumuman</h1>
    <p class="mb-4">
        Berikut adalah data pengumuman untuk penduduk yang terdaftar di sistem.
    </p>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="/pengumuman/create" class="btn btn-primary mb-3">Tambah Pengumuman Baru</a>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Pengumuman
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
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Image</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($pengumuman)) : ?>
                            <?php foreach ($pengumuman as $item): ?>
                                <tr>
                                    <td><?= esc($item['judul']) ?></td>
                                    <td><?= esc($item['isi']) ?></td>
                                    <td>
                                        <?php if ($item['image']): ?>
                                            <img src="<?= base_url('uploads/' . $item['image']) ?>" alt="Image" width="100">
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="/pengumuman/edit/<?= $item['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="/pengumuman/delete/<?= $item['id'] ?>" class="btn btn-danger btn-sm hapus-button">Hapus</a>
                                        <?php else : ?>
                                            <i>Tidak Memiliki Akses</i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data pengumuman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>