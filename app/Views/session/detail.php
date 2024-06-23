<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <!-- Breadcrumb -->
    <?= view_cell('BreadcrumbCell', ['breadcrumbs' => $breadcrumbs]) ?>

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
                <?php elseif (validation_get_error('assignment_file')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_get_error('assignment_file'); ?>
                    </div>
                <?php endif; ?>

                <!-- Post Form -->
                <?php if (session('user_role_id') == 2) : ?>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="/pertemuan/item" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div id="file-preview" class="mb-3"></div>
                                    <label id="label" for="text">Buat postingan di sini!</label>

                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="diskusi" value="1" checked>
                                            <label class="form-check-label" for="diskusi">Diskusi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="tugas" value="2">
                                            <label class="form-check-label" for="tugas">Tugas</label>
                                        </div>
                                    </div>

                                    <div class="d-flex">
                                        <input type="text" class="form-control mr-3" id="text" name="text" aria-describedby="emailHelp" placeholder="Tulis disini..">

                                        <div class="d-flex align-items-center mr-1 text-secondary">
                                            <input type="file" class="d-none" id="file" name="file" onchange="previewFile()">
                                            <label for="file" class="mb-0"><i class="fas fa-paperclip" style="font-size: 24px; cursor: pointer;"></i></label>
                                        </div>

                                        <input type="hidden" name="session_id" value="<?= $session['id']; ?>">

                                        <button type="submit" class="button-hover text-primary">
                                            <i class="fas fa-paper-plane" style="font-size: 24px;"></i>
                                        </button>
                                    </div>

                                    <div class="text-danger ml-2 mt-2 <?= (validation_get_error('text') || validation_get_error('file')) ? '' : 'd-none'; ?>">
                                        <?= validation_get_error('text'); ?>
                                        <br>
                                        <?= validation_get_error('file'); ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php else : ?>
                    <?php if (count($session['session_items']) == 0) : ?>
                        <div class="card shadow py-5 mb-4 d-flex justify-content-center align-items-center">
                            Belum Ada Postingan
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <?= $this->include('session/post_items'); ?>
            </div>

            <!-- View Siswa -->
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="d-flex justify-content-between align-items-center card-header">
                        Siswa (<?= count($studentClasses) ?>)
                    </div>
                    <div class="card-body" style="max-height: 320px; overflow-y: auto">
                        <?php if (count($studentClasses) > 0) :  ?>
                            <?php foreach ($studentClasses as $studentClass) : ?>
                                <div class="student-item  d-flex align-items-center mb-3">
                                    <img class="img-profile rounded-circle" width="40" src="/img/profile/<?= $studentClass['student']['user']['profile_picture']; ?>">
                                    <div class="ml-3">
                                        <h6 class="mb-0 font-weight-bold one-line-text"><?= $studentClass['student']['user']['full_name']; ?></h6>
                                        <small><?= $studentClass['student']['nisn']; ?></small>
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
</div>

<!-- /.container -->

<?= $this->endSection('content'); ?>