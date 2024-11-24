<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>

<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Pengguna</h1>
    <p class="mb-4">Silahkan mengisi form dibawah untuk menambah data pengguna baru.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form</h6>
        </div>
        <div class="card-body">
            <?php if(isset($user)): ?>
                <form action="/users/update/<?= $user['id'] ?>" method="post">
            <?php else: ?>
                <form action="/users/store" method="post">
            <?php endif; ?>
                <?= csrf_field() ?>
                <?php if (session()->getFlashdata('errors')) : ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= isset($user) ? esc($user['name']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= isset($user) ? esc($user['username']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <small class="form-text text-muted">*Leave blank to keep the current password.</small>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="">Pilih Role</option>
                        <option value="admin" <?= (isset($user) && $user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= (isset($user) && $user['role'] == 'user') ? 'selected' : '' ?>>User </option>
                        <?php if(isset($user) && $user['id'] != '1'): ?>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/users" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>