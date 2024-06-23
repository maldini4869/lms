<?php $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container">

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/dashboard/guru" method="get">
                <div class="row">
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