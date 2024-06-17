<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/siswa/tambah" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id">Siswa</label>

                            <select class="selectpicker form-control <?= validation_has_error('student_id[]') ? 'is-invalid' : ''; ?>" id="student_id[]" name="student_id[]" value="<?= old('student_id[]'); ?>" title="Pilih Siswa..." multiple data-live-search="true" data-size="10" data-style="border-info">
                                <?php foreach ($students as $student) : ?>
                                    <option value="<?= $student['id']; ?>" data-content="<h5><span class='badge badge-primary h-100'><?= $student['nisn']; ?> - <?= $student['user']['full_name']; ?></span></h5>">
                                    </option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('student_id[]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 float-right">Tambah</button>
            </form>
        </div>
    </div>

</div>

<?php $this->endSection('content'); ?>