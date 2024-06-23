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
            <h1 class="h3 mb-2 text-gray-800">Jadwal Mata Pelajaran <?= $subTitle; ?></h1>
        </div>
        <div class="col-md-6">
            <a class="btn btn-primary float-right" href="/jadwal-mapel/tambah" role="button">Tambah</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/jadwal-mapel" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="semester_id">Semester</label>
                            <select class="selectpicker form-control" data-style="border-info" id="semester_id" name="semester_id" data-size="10" title="Pilih Semester...">
                                <?php foreach ($semesters as $semester) : ?>
                                    <option value="<?= $semester['id']; ?>" <?= ($semester['id'] == $selectedSemesterId) ? 'selected' : ''; ?>> <?= $semester['semester']; ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 ml-auto">
                        <div class="form-group">
                            <label for="" style="color: white">.</label>
                            <button type="submit" class="btn btn-primary btn-block">Cari</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <?php foreach ($schedulesMap as $key => $scheduleMap) : ?>
                <?php $strippedKey = preg_replace('/\s+/', '', $key); ?>
                <div id="<?= $strippedKey; ?>" class="card shadow mb-4">
                    <div class="card-header" id="heading<?= $strippedKey; ?>">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $strippedKey; ?>" aria-expanded="true" aria-controls="collapse<?= $strippedKey; ?>">
                                <?= $key; ?>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?= $strippedKey; ?>" class="collapse <?= !empty($scheduleMap) ? 'show' : ''; ?>" aria-labelledby="heading<?= $strippedKey; ?>">
                        <div class="card-body">
                            <?= view_cell('ScheduleTableCell', ['scheduleMap' => $scheduleMap]) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-2">
            <div class="card shadow mb-4">
                <div class="card-header">
                    Daftar Kelas
                </div>
                <div class="card-body">
                    <?php foreach ($schedulesMap as $key => $scheduleMap) : ?>
                        <?php $strippedKey = preg_replace('/\s+/', '', $key); ?>
                        <div class="mb-1">
                            <a href="#<?= $strippedKey; ?>"><?= $key; ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->endSection('content'); ?>