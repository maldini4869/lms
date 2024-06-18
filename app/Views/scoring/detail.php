<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white font-weight-bold">
                    Pertemuan ke <?= $sessionItem['session']['week']; ?>
                </div>
                <div class="card-body">
                    <div>
                        <label for="" class="border-bottom-primary">Kode</label>
                        <p class="font-weight-bold"><?= $sessionItem['session']['code']; ?></p>
                    </div>
                    <div>
                        <label for="" class="border-bottom-primary">Guru</label>
                        <p class="font-weight-bold"><?= $sessionItem['session']['schedule']['teacher']['user']['full_name']; ?></p>
                    </div>
                    <div class="mt-2">
                        <label for="" class="border-bottom-primary">Kelas</label>
                        <p class="font-weight-bold"><?= $sessionItem['session']['schedule']['class']['code']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-header bg-primary text-white font-weight-bold">
                    Tugas <?= $sessionItem['code']; ?>
                </div>
                <div class="card-body">
                    <div>
                        <label for="" class="font-weight-bold">Judul</label>
                        <p>-</p>
                    </div>
                    <div>
                        <label for="" class="font-weight-bold">Deskripsi</label>
                        <p><?= $sessionItem['text']; ?></p>
                    </div>
                    <div>
                        <label for="" class="font-weight-bold">Berkas</label>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-file-alt mr-2" style="font-size: 16px;"></i>
                            <p class="mb-0"><?= $sessionItem['file']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <?php foreach ($classStudents as $classStudent) : ?>
                        <div class="student-item-scoring d-flex justify-content-between align-items-center py-2">
                            <h6 class="font-weight-bold mb-0"><?= $classStudent['student']['user']['full_name']; ?> - <?= $classStudent['student']['nisn']; ?></h6>

                            <?php
                            $assignments = array_filter($studentAssignments, fn ($item) => $item['student_id'] == $classStudent['student']['id']);

                            $assignments = array_values($assignments);
                            ?>

                            <?php if (count($assignments) == 0) : ?>
                                <div>
                                    <span>Belum Mengumpulkan</span>
                                    <button class="btn btn-primary ml-1" disabled>Beri Nilai</button>
                                </div>
                            <?php elseif (count($assignments) > 0 && $assignments[0]['grade'] == null) : ?>
                                <div>
                                    <span>Belum Dinilai</span>
                                    <button class="btn btn-primary ml-1" data-toggle="modal" data-target="#detailNilai<?= $classStudent['id']; ?>">Beri Nilai</button>
                                </div>
                            <?php elseif (count($assignments) > 0 && $assignments[0]['grade'] != null) : ?>
                                <div>
                                    <span>Sudah Dinilai</span>
                                    <button class="btn btn-primary ml-1">Lihat Nilai</button>
                                </div>
                            <?php endif; ?>

                            <!-- Model Beri Nilai -->
                            <div class="modal fade" id="detailNilai<?= $classStudent['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailNilai<?= $classStudent['id']; ?>Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title font-weight-bold" id="detailNilai<?= $classStudent['id']; ?>Label">
                                                Detail Tugas
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="font-size: 20px;">
                                            <?php foreach ($assignments as $assignment) : ?>
                                                <div class="row">
                                                    <div class="col-md-3 pr-2 d-flex justify-content-between">
                                                        File
                                                    </div>
                                                    <div class="col-md-9 one-line-text">
                                                        : <?= $assignment['file']; ?>
                                                    </div>
                                                    <div class="col-md-12 mt-3">
                                                        <form action="/penilaian" method="post">
                                                            <input type="hidden" name="session_item_id" value="<?= $sessionItem['id']; ?>">
                                                            <input type="hidden" name="student_id" value="<?= $classStudent['student']['id']; ?>">
                                                            <input type="hidden" name="id" value="<?= $assignment['id']; ?>">

                                                            <div class="form-group row">
                                                                <label for="grade" class="col-md-3 col-form-label">Nilai</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control" id="grade" name="grade" placeholder="Nilai">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="feedback" class="col-md-3 col-form-label">Feedback</label>
                                                                <div class="col-md-9">
                                                                    <textarea rows="5" class="form-control" id="feedback" name="feedback" placeholder="Feedback"></textarea>
                                                                </div>
                                                            </div>

                                                            <button class="btn btn-primary float-right">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?= $this->endSection('content'); ?>