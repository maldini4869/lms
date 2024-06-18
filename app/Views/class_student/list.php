<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-3">
        <div class="col-md-6">
            <h1 class="h3 mb-2 text-gray-800">Kelas</h1>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/kelas" method="get">
                <div class="row justify-content-between">
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

                    <div class="col-md-2">
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

        <?php foreach ($classes as $class) : ?>
            <div class="col-md-3 mb-4">
                <a href="kelas/<?= $class['id']; ?>/semester/<?= $selectedSemesterId; ?>" class="no-style-link">
                    <div class="card <?= count($class['class_students']) > 0 ? 'border-left-success' : 'border-left-info'; ?> shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold <?= count($class['class_students']) > 0 ? 'text-success' : 'text-info'; ?> text-uppercase mb-1">
                                        kelas <?= $class['grade']; ?>
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold <?= count($class['class_students']) > 0 ? 'text-success' : 'text-info'; ?>"><?= $class['code']; ?></div>
                                </div>
                                <div class="col-auto">
                                    <?php if (count($class['class_students']) > 0) : ?>
                                        <i class="fas fa-check-circle text-success"></i>
                                    <?php else : ?>
                                        <i class="fas fa-exclamation-circle"></i>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php $this->endSection('content'); ?>