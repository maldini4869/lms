<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <?php foreach ($assignmentSessionItems as $item) : ?>
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between">
                <div>
                    <?= $item['code']; ?>
                </div>
                <div class="font-weight-normal">
                    <?= $item['created_at']; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-file-alt mr-2" style="font-size: 24px;"></i>
                    <span class="mb-0"><?= $item['file']; ?></span>
                </div>
                <div class="mt-3">
                    <p><?= $item['text']; ?></p>
                </div>

                <a href="/penilaian/<?= $item['id']; ?>" class="btn btn-outline-primary btn-block">Lihat Tugas</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>