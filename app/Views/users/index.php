<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Pengguna</h1>
    <p class="mb-4">
        Berikut adalah data pengguna yang terdaftar di sistem.
    </p>

    <?php if (session()->get('role') == 'admin') : ?>
        <a href="/users/create" class="btn btn-primary mb-3">Tambah Pengguna</a>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Data Pengguna
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= esc($user['id']) ?></td>
                                    <td><?= esc($user['name']) ?></td>
                                    <td><?= esc($user['username']) ?></td>
                                    <td><?= esc($user['role']) ?></td>
                                    <td class="text-center">
                                        <?php if (session()->get('role') == 'admin') : ?>
                                            <a href="/users/edit/<?= esc($user['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <?php if ($user['role'] != 'admin') : ?>
                                                <a href="/users/delete/<?= esc($user['id']) ?>" class="btn btn-danger btn-sm hapus-button">Hapus</a>
                                            <?php endif; ?>
                                        <? else : ?>
                                            <i>Tidak Memiliki Akses</i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data pengguna.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php $this->endSection() ?>