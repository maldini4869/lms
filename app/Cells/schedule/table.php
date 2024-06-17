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
        <?php foreach ($scheduleMap as $i => $schedule) : ?>
            <tr>
                <th scope="row"><?= get_day_label($i); ?></th>
                <?php for ($j = 1; $j <= 10; $j++) : ?>
                    <?php $key = array_search($j, array_column($schedule, 'start_period')); ?>
                    <?php if ($key !== false) : ?>
                        <?php
                        $startPeriod = $schedule[$key]['start_period'];
                        $endPeriod = $schedule[$key]['end_period'];
                        $j = $schedule[$key]['end_period'];
                        $colspan = $endPeriod - $startPeriod + 1
                        ?>
                        <td colspan="<?= $colspan; ?>" style="width: 108px; max-width: 108px">
                            <div class="bg-success px-3 py-2 rounded text-white text-center one-line-text d-flex align-items-center justify-content-between" data-toggle="tooltip" data-placement="top" title="<?= $schedule[$key]['subject_name'] . ' - ' . $schedule[$key]['teacher_name']; ?>">
                                <div class="one-line-text">
                                    <?= $schedule[$key]['subject_name'] . ' - ' . $schedule[$key]['teacher_name']; ?>
                                </div>

                                <form class="d-inline" action="/jadwal-mapel/<?= $schedule[$key]['id'] ?>" method="post">
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