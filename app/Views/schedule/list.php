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
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="class_id">Kelas</label>
                            <select class="selectpicker form-control" data-style="border-info" id="class_id" name="class_id" data-live-search="true" data-size="10" title="Pilih Kelas...">
                                <?php foreach ($classes as $class) : ?>
                                    <option value="<?= $class['id']; ?>" <?= ($class['id'] == $selectedClassId) ? 'selected' : ''; ?>> <?= $class['code']; ?> </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5">
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

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (!empty($schedules)) : ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" width="10%">#</th>
                            <th scope="col" width="5%">1</th>
                            <th scope="col" width="5%">2</th>
                            <th scope="col" width="5%">3</th>
                            <th scope="col" width="5%">4</th>
                            <th scope="col" width="5%">5</th>
                            <th scope="col" width="5%">6</th>
                            <th scope="col" width="5%">7</th>
                            <th scope="col" width="5%">8</th>
                            <th scope="col" width="5%">9</th>
                            <th scope="col" width="5%">10</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($schedulesMap as $i => $scheduleMap) : ?>
                            <tr>
                                <th scope="row"><?= get_day_label($i); ?></th>
                                <?php for ($j = 1; $j <= 10; $j++) : ?>
                                    <?php $key = array_search($j, array_column($scheduleMap, 'start_period')); ?>
                                    <?php if ($key !== false) : ?>
                                        <?php
                                        $startPeriod = $scheduleMap[$key]['start_period'];
                                        $endPeriod = $scheduleMap[$key]['end_period'];
                                        $j = $scheduleMap[$key]['end_period'];
                                        $colspan = $endPeriod - $startPeriod + 1
                                        ?>
                                        <td colspan="<?= $colspan; ?>" style="width: 108px; max-width: 108px">
                                            <div class="bg-success px-3 py-2 rounded text-white text-center one-line-text d-flex align-items-center justify-content-between" data-toggle="tooltip" data-placement="top" title="<?= $scheduleMap[$key]['subject_name'] . ' - ' . $scheduleMap[$key]['teacher_name']; ?>">
                                                <?= $scheduleMap[$key]['subject_name'] . ' - ' . $scheduleMap[$key]['teacher_name']; ?>

                                                <form class="d-inline" action="/jadwal-mapel/<?= $scheduleMap[$key]['id'] ?>" method="post">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" style="background: initial; border: initial; color: initial;" onclick="return confirm('Menghapus jadwal akan menghapus pertemuan. Apakah anda yakin?')">
                                                        <i class="far fa-trash-alt" style="color: #c70000;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    <?php else : ?>
                                        <td></td>
                                    <?php endif ?>
                                <?php endfor ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="mx-auto p-3">
                    <h3 class="text-center">Belum ada data, silahkan pilih kelas dan semester...</h3>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php $this->endSection('content'); ?>