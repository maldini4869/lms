<?php $this->extend('layouts/default'); ?>

<?php $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <?php if (session()->getFlashdata('failed')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('failed'); ?>
        </div>
    <?php endif; ?>

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Jadwal</h1>

    <!-- Default Card Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/jadwal-mapel/tambah" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="class_id">Kelas</label>

                            <select class="selectpicker form-control <?= validation_has_error('class_id') ? 'is-invalid' : ''; ?>" id="class_id" name="class_id" value="<?= old('class_id'); ?>" title="Pilih Kelas..." data-live-search="true" data-size="10" data-style="border-info">
                                <?php foreach ($classes as $class) : ?>
                                    <option value="<?= $class['id']; ?>"><?= $class['code']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('class_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="teacher_subject_id">Pilih Mapel - Guru</label>
                            <select class="selectpicker form-control <?= validation_has_error('teacher_subject_id') ? 'is-invalid' : ''; ?>" id="teacher_subject_id" name="teacher_subject_id" value="<?= old('teacher_subject_id'); ?>" title="Pilih Mapel - Guru..." data-live-search="true" data-size="10" data-style="border-info">
                                <?php foreach ($teacherSubjects as $teacherSubject) : ?>
                                    <option value="<?= $teacherSubject['id']; ?>"><?= $teacherSubject['subject_name'] . ' - ' . $teacherSubject['teacher_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('teacher_subject_id'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="semester_id">Semester</label>
                            <select class="selectpicker form-control <?= validation_has_error('semester_id') ? 'is-invalid' : ''; ?>" id="semester_id" name="semester_id" value="<?= old('semester_id'); ?>" title="Pilih Semester..." data-size="10" data-style="border-info">
                                <?php foreach ($semesters as $semester) : ?>
                                    <option value="<?= $semester['id']; ?>"> <?= $semester['semester']; ?> </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('semester_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="day">Hari</label>
                            <select class="selectpicker form-control <?= validation_has_error('day') ? 'is-invalid' : ''; ?>" id="day" name="day" value="<?= old('day'); ?>" title="Pilih Hari..." data-size="10" data-style="border-info">
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('day'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="start_period">Periode Mulai</label>
                            <select class="selectpicker form-control <?= validation_has_error('start_period') ? 'is-invalid' : ''; ?>" id="start_period" name="start_period" value="<?= old('start_period'); ?>" title="Pilih Periode Mulai..." data-size="10" data-style="border-info">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('start_period'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="end_period">Periode Selesai</label>
                            <select class="selectpicker form-control <?= validation_has_error('end_period') ? 'is-invalid' : ''; ?>" id="end_period" name="end_period" value="<?= old('end_period'); ?>" title="Pilih Periode Selesai..." data-size="10" data-style="border-info">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('end_period'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 float-right">Tambah</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $this->endSection('content'); ?>