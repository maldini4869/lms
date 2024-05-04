<?php $this->extend('layouts/default'); ?>

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
                        <select class="selectpicker form-control" id="class_id" name="class_id" data-live-search="true" data-size="10" title="Pilih Kelas...">
                            <?php foreach ($classes as $class) : ?>
                                <option value="<?= $class['id']; ?>"><?= $class['code']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <select class="selectpicker form-control" id="semester" name="semester" data-size="10" title="Pilih Semester...">
                            <?php for ($i = 1; $i <= 100; $i++) :  ?>
                                <option value="<?= $i; ?>"><?= $i; ?></option>
                            <?php endfor ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-block">Cari</a>
                    </div>
            </form>
        </div>
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
                            <th scope="row" c><?= get_day_label($i); ?></th>
                            <?php for ($j = 1; $j <= 10; $j++) : ?>
                                <?php $key = array_search($j, array_column($scheduleMap, 'start_period')); ?>
                                <?php if ($key !== false) : ?>
                                    <?php
                                    $startPeriod = $scheduleMap[$key]['start_period'];
                                    $endPeriod = $scheduleMap[$key]['end_period'];
                                    $j = $scheduleMap[$key]['end_period'];
                                    $colspan = $endPeriod - $startPeriod + 1
                                    ?>
                                    <td colspan="<?= $colspan; ?>">
                                        <div class="bg-success p-2 rounded text-white text-center">
                                            <?= $scheduleMap[$key]['subject_name'] . ' - ' . $scheduleMap[$key]['teacher_name']; ?>
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