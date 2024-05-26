<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <!-- Hero -->
    <div style=" background-image: url('/img/default-session-banner.jpg'); width: 100%; height: 360px; background-position: center; background-size: cover; box-shadow: 0px -120px 70px -70px rgba(0,0,0,0.75) inset;-webkit-box-shadow: 0px -120px 70px -70px rgba(0,0,0,0.75) inset; -moz-box-shadow: 0px -120px 70px -70px rgba(0,0,0,0.75) inset; " class=" d-flex p-3 rounded align-items-end">
        <h1 class="text-white">Pertemuan <?= $session['week']; ?></h1>
    </div>

    <div class="mt-4 mb-4">
        <div class="row">
            <div class="col-md-2">
                <div class="card shadow">
                    <div class="card-header">
                        Detail
                    </div>
                    <div class="card-body">
                        <?= $session['schedule']['class']['code']; ?>
                        <hr>
                        <?= $session['schedule']['teachers_subject']['subject']['name']; ?>
                        <hr>
                        <?= 'Pertemuan ke ' . $session['week']; ?>
                    </div>
                </div>
            </div>

            <!-- Posts -->
            <div class="col-md-7">

                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php elseif (session()->getFlashdata('failed')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session()->getFlashdata('failed'); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Form -->
                <div class="card shadow"">
                    <div class=" card-body">

                    <form action="/pertemuan/item" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <div id="file-preview" class="mb-3"></div>
                            <label id="label" for="text">Buat postingan di sini!</label>
                            <div class="d-flex">

                                <input type="text" class="form-control mr-3" id="text" name="text" aria-describedby="emailHelp" placeholder="Tulis disini..">

                                <div class="d-flex align-items-center mr-1">
                                    <input type="file" class="d-none" id="file" name="file" onchange="previewFile()">
                                    <label for="file" class="mb-0"><i class="fas fa-paperclip" style="font-size: 24px; cursor: pointer;"></i></label>
                                </div>

                                <input type="hidden" name="session_id" value="<?= $session['id']; ?>">
                                <input type="hidden" name="type" value="1">

                                <button type="submit" class="button-hover text-primary">
                                    <i class="fas fa-paper-plane" style="font-size: 24px;"></i>
                                </button>
                            </div>

                            <div class="text-danger ml-2">
                                <?= validation_get_error('text'); ?>
                                <br>
                                <?= validation_get_error('file'); ?>
                            </div>
                        </div>
                    </form>



                </div>
            </div>

            <?= $this->include('session/post_items'); ?>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="d-flex justify-content-between align-items-center card-header">
                    Siswa (<?= count($session['students']) ?>)
                    <button type="button" class="button-hover text-primary d-flex align-items-center" data-toggle="modal" data-target="#sessionStudentModal">
                        <i class="fas fa-plus-circle" style="font-size: 24px;"></i>
                    </button>
                </div>
                <div class="card-body" style="max-height: 320px; <?= count($session['students']) > 0 ? 'overflow-y: scroll;' : ''; ?>">
                    <?php if (count($session['students']) > 0) :  ?>
                        <?php foreach ($session['students'] as $student) : ?>
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-profile rounded-circle" width="40" src="/img/profile/undraw_profile.svg">
                                <div class="ml-3">
                                    <h6 class="mb-0 font-weight-bold one-line-text"><?= $student['user']['full_name']; ?></h6>
                                    <small><?= $student['nisn']; ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        Belum ada siswa
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Session Student Modal-->
<div class="modal fade" id="sessionStudentModal" tabindex="-1" role="dialog" aria-labelledby="sessionStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionStudentModalLabel">Tambah Siswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/pertemuan/siswa/tambah" method="post">
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

                        <input type="hidden" name="session_id" value="<?= $session['id']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container -->

<?= $this->endSection('content'); ?>