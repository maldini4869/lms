<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php elseif (session()->getFlashdata('failed')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">List Siswa</h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-primary float-right" href="/siswa/tambah" role="button">Tambah</a>
        </div>
    </div>

    <!-- DataTables Student -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pendataanTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $i => $student) : ?>
                            <tr>
                                <td><?= $i + 1; ?></td>
                                <td><?= $student['full_name']; ?></td>
                                <td><?= $student['nisn']; ?></td>
                                <td><?= $student['email']; ?></td>
                                <td>
                                    <a href="/siswa/ubah/<?= $student['id']; ?>" style="text-decoration: none; color: inherit;">
                                        <i class="fas fa-edit mr-2" style="color: #FFD43B;"></i>
                                    </a>

                                    <form class="d-inline" action="/siswa/<?= $student['id']; ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" style="background: initial; border: initial; color: initial;" onclick="return confirm('Apakah anda yakin?')">
                                            <i class="far fa-trash-alt" style="color: #c70000;"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->endSection('content'); ?>