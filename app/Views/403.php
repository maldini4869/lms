<?php $this->extend('layouts/admin'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="404">403</div>
        <p class="lead text-gray-800 mb-5">Akses Ditolak!</p>
        <p class="text-gray-500 mb-0">Akses ke halaman ditolak...</p>
        <a href="/dashboard">&larr; Kembali ke dashboard</a>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>