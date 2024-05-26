<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Pertemuan <?= $subTitle; ?></h1>

    <?php foreach ($sessions as $session) : ?>
        <div class="card mb-4 border-left-info">
            <a href="/pertemuan/detail/<?= $session['id']; ?>" class="no-style-link">
                <div class="card-body">
                    <small class="float-right"><?= $session['date'] ? $session['date'] : 'Tangal pertemuan belum di set'; ?></small>
                    <h6><?= $session['code']; ?></h6>
                    <h5 class="text-primary">
                        <?= $session['schedule']['class']['code']; ?> - <?= $session['schedule']['teachers_subject']['subject']['name']; ?>
                    </h5>
                    <h5>Pertemuan ke <strong><?= $session['week']; ?></strong></h5>
                </div>
            </a>
        </div>
    <?php endforeach ?>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>