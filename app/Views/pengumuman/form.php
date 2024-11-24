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
            <?php if(isset($pengumuman)): ?>
                <form action="/pengumuman/update/<?= $pengumuman['id'] ?>" method="post" enctype="multipart/form-data"> 
            <?php else: ?>
                <form action="/pengumuman/store" method="post" enctype="multipart/form-data">
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
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control" value="<?= isset($pengumuman) ? esc($pengumuman['judul']) : '' ?>">
                </div>
                <div class="mb-3">
                    <label for="isi" class="form-label">Isi</label>
                    <textarea name="isi" class="form-control"><?= isset($pengumuman) ? $pengumuman ['isi'] : '' ?></textarea>
                    </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control-file">
                    <? if (isset($pengumuman)) : ?>
                        <a href="/uploads/<?= $pengumuman['image'] ?>" target="_blank">Lihat Gambar Saat ini</a>
                    <? endif ?>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/pengumuman" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection() ?>