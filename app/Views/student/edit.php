<?php $this->extend('layouts/default'); ?>

<?php $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Siswa</h1>

    <!-- Default Card Example -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="/siswa/ubah/<?= $student['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="old_profile_picture" value="<?= $student['profile_picture']; ?>">
                <input type="hidden" name="user_id" value="<?= $student['user_id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Nama</label>
                            <input type="text" class="form-control <?= validation_has_error('full_name') ? 'is-invalid' : ''; ?>" id="full_name" name="full_name" value="<?= $student['full_name']; ?>" placeholder="Nama...">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('full_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control <?= validation_has_error('nisn') ? 'is-invalid' : ''; ?>" id="nisn" name="nisn" value="<?= $student['nisn']; ?>" placeholder="199205142023052008">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('nisn'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= validation_has_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $student['email']; ?>" placeholder="name@example.com" readonly>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('email'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-2">
                        <img src="/img/profile/<?= $student['profile_picture']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-md-4">
                        <label for="profile_picture">Foto Profil</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= validation_has_error('profile_picture') ? 'is-invalid' : ''; ?>" id="profile_picture" name="profile_picture" onchange="previewImg()">
                            <label class="custom-file-label" for="profile_picture"><?= $student['profile_picture']; ?></label>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('profile_picture'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" class="form-control <?= validation_has_error('phone_number') ? 'is-invalid' : ''; ?>" id="phone_number" name="phone_number" value="<?= $student['phone_number']; ?>" placeholder="199205142023052008">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('phone_number'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 float-right">Ubah</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $this->endSection('content'); ?>