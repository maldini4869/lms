<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Semester Berjalan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $semester['semester']; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Jumlah Mata Pelajaran</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tugas belum dikirim
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Tanya Jawab</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
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
                                            <a href="/pertemuan/<?= $scheduleMap[$key]['id']; ?>" class="text-decoration-none">
                                                <div class="bg-success p-2 rounded text-white text-center one-line-text" data-toggle="tooltip" data-placement="top" title="<?= $scheduleMap[$key]['subject_name'] . ' - ' . $scheduleMap[$key]['class_code']; ?>">
                                                    <?= $scheduleMap[$key]['subject_name'] . ' - ' . $scheduleMap[$key]['class_code']; ?>
                                                </div>
                                            </a>
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


<?= $this->endSection('content'); ?>