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
            <h1 class="h3 mb-2 text-gray-800">Siswa Kelas <?= $class['code']; ?> - Semester <?= $semester['semester']; ?></h1>
        </div>
        <div class="col-md-6">
            <button class="btn btn-primary float-right" role="button" data-toggle="modal" data-target="#studentClassModal">Tambah Siswa</button>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="pendataanTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($studentClasses as $index => $studentClass) : ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= $studentClass['student']['user']['full_name']; ?></td>
                                <td><?= $studentClass['student']['nisn']; ?></td>
                                <td><?= $studentClass['student']['user']['email']; ?></td>
                                <td>
                                    <form class="d-inline" action="/kelas/siswa/<?= $studentClass['id']; ?>" method="post">
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

<!-- Add Session Student Modal-->
<div class="modal fade" id="studentClassModal" tabindex="-1" role="dialog" aria-labelledby="studentClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentClassModalLabel">Tambah Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/kelas/siswa/tambah" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <select class="selectpicker form-control <?= validation_has_error('student_id[]') ? 'is-invalid' : ''; ?>" id="student_id[]" name="student_id[]" value="<?= old('student_id[]'); ?>" title="Pilih Siswa..." multiple data-live-search="true" data-size="10" data-style="border-info">
                            <?php foreach ($students as $student) : ?>
                                <option value="<?= $student['id']; ?>" data-content="<h5><span class='badge badge-primary h-100'><?= $student['nisn']; ?> - <?= $student['user']['full_name']; ?></span></h5>">
                                </option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback ml-2">
                            <?= validation_get_error('student_id[]'); ?>
                        </div>

                        <input type="hidden" name="semester_id" value="<?= $semester['id']; ?>">
                        <input type="hidden" name="class_id" value="<?= $class['id']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $this->endSection('content'); ?>