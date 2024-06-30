<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/tugas" method="get">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="assignment_code">Cari Kode Tugas</label>
                            <input type="text" class="form-control" id="assignment_code" name="assignment_code" placeholder="Cari Kode Tugas">
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

    <?php foreach ($studentSessionItems as $item) : ?>
        <div class="card shadow mb-3">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <div>
                    <?= $item['code']; ?>
                    <?php if (!$item['assignment']) : ?>
                        <span class="badge badge-warning">Belum Mengumpulkan</span>
                    <?php elseif ($item['assignment'] && $item['assignment']['grade'] == null) : ?>
                        <span class="badge badge-info">Belum Dinilai</span>
                    <?php elseif ($item['assignment'] && $item['assignment']['grade'] != null) : ?>
                        <span class="badge badge-primary">Sudah Dinilai</span>
                    <?php endif; ?>
                </div>
                <div class="font-weight-normal">
                    <?= $item['created_at']; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-3">
                                Kelas
                            </div>
                            <div class="col-md-9">
                                : <?= $item['class_code']; ?>
                            </div>

                            <div class="col-md-3">
                                Mapel
                            </div>
                            <div class="col-md-9">
                                : <?= $item['subject_name']; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-2">
                                Guru
                            </div>
                            <div class="col-md-10">
                                : <?= $item['teacher_name']; ?>
                            </div>

                            <div class="col-md-2">
                                Pertemuan
                            </div>
                            <div class="col-md-10">
                                : Minggu ke <?= $item['session_week']; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="/pertemuan/detail/<?= $item['session_id']; ?>#<?= $item['code']; ?>" class="btn btn-block btn-info">Detail Pertemuan</a>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-block btn-outline-secondary h-100" type="button" data-toggle="modal" data-target="#detailAssignmentModal<?= $item['id']; ?>" <?= $item['assignment'] ? '' : 'disabled'; ?>>Detail</button>
                    </div>
                </div>

                <!-- Modal Detail Tugas -->
                <div class="modal fade" id="detailAssignmentModal<?= $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailAssignmentModal<?= $item['id']; ?>Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailAssignmentModal<?= $item['id']; ?>Label">
                                    Detail Tugas
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="font-size: 20px;">
                                <?php if ($item['assignment']) : ?>
                                    <div class="row">
                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                            <div>File</div>
                                            <div>:</div>
                                        </div>
                                        <div class="col-md-8 pl-0 one-line-text">
                                            <?= $item['assignment']['file']; ?>
                                        </div>
                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                            <div>Nilai</div>
                                            <div>:</div>
                                        </div>
                                        <div class="col-md-8 pl-0 font-weight-bold">
                                            <?= $item['assignment']['grade']; ?>
                                        </div>
                                        <div class="col-md-4 pr-2 d-flex justify-content-between">
                                            <div>Feedback</div>
                                            <div>:</div>
                                        </div>
                                        <div class="col-md-8 pl-0">
                                            <?php if ($item['assignment']['feedback']) : ?>
                                                <?= $item['assignment']['feedback']; ?>
                                            <?php else : ?>
                                                -
                                            <?php endif ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>