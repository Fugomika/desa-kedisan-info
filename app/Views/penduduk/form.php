<?php $this->extend('layouts/app') ?>

<?php $this->section('content') ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tambah Penduduk</h1>
    <p class="mb-4">Silahkan mengisi form dibawah untuk menambah data penduduk baru.</p>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form</h6>
        </div>
        <div class="card-body">
            <?php if(isset($penduduk)): ?>
                <form action="/penduduk/update/<?= $penduduk['id'] ?>" method="post">
            <?php else: ?>
                <form action="/penduduk/store" method="post">
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
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="<?= isset($penduduk) ? esc($penduduk['nama']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= isset($penduduk) ? esc($penduduk['alamat']) : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="umur" class="form-label">Umur</label>
                    <input type="number" name="umur" id="umur" class="form-control" value="<?= isset($penduduk) ? esc($penduduk['umur']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L" <?= (isset($penduduk) && $penduduk['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>
                            Laki-laki
                        </option>
                        <option value="P" <?= (isset($penduduk) && $penduduk['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>
                            Perempuan
                        </option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="status_pernikahan" class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" id="status_pernikahan" class="form-control">
                        <option value="">Pilih Status Pernikahan</option>
                        <option value="Kawin" <?= (isset($penduduk) && $penduduk['status_pernikahan'] == 'Kawin') ? 'selected' : '' ?>>
                            Kawin
                        </option>
                        <option value="Belum Kawin" <?= (isset($penduduk) && $penduduk['status_pernikahan'] == 'Belum Kawin') ? 'selected' : '' ?>>
                            Belum Kawin
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/penduduk" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>