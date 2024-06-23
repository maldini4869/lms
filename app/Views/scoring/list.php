<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/penilaian" method="get">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="assignment_code">Cari Kode Tugas</label>
                            <input type="text" class="form-control" id="assignment_code" name="assignment_code" placeholder="Cari Kode Tugas">
                        </div>
                    </div>
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

    <?php foreach ($assignmentSessionItems as $item) : ?>
        <div class="card shadow mb-3">
            <div class="card-header font-weight-bold d-flex justify-content-between">
                <div>
                    <?= $item['code']; ?>
                </div>
                <div class="font-weight-normal">
                    <?= $item['created_at']; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-file-alt mr-2" style="font-size: 24px;"></i>
                    <span class="mb-0"><?= $item['file']; ?></span>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        Kelas
                    </div>
                    <div class="col-md-10">
                        : <?= $item['class_code']; ?>
                    </div>

                    <div class="col-md-2">
                        Mata Pelajaran
                    </div>
                    <div class="col-md-10">
                        : <?= $item['subject_name']; ?>
                    </div>

                    <div class="col-md-2">
                        Pertemuan
                    </div>
                    <div class="col-md-10">
                        : Minggu ke <?= $item['session_week']; ?>
                    </div>
                </div>

                <a href="/penilaian/<?= $item['id']; ?>" class="btn btn-outline-primary btn-block">Lihat Tugas</a>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>