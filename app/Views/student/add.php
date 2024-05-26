<?php $this->extend('layouts/admin'); ?>

<?php $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Siswa</h1>

    <!-- Default Card Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="/siswa/tambah" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="full_name">Nama</label>
                            <input type="text" class="form-control <?= validation_has_error('full_name') ? 'is-invalid' : ''; ?>" id="full_name" name="full_name" value="<?= old('full_name'); ?>" placeholder="Nama...">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('full_name'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control <?= validation_has_error('nisn') ? 'is-invalid' : ''; ?>" id="nisn" name="nisn" value="<?= old('nisn'); ?>" placeholder="199205142023052008">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('nisn'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= validation_has_error('email') ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="name@example.com">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('email'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= validation_has_error('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password...">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('password'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-2">
                        <img src="/img/profile/undraw_profile.svg" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-md-4">
                        <label for="profile_picture">Foto Profil</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= validation_has_error('profile_picture') ? 'is-invalid' : ''; ?>" id="profile_picture" name="profile_picture" onchange="previewImg()">
                            <label class="custom-file-label" for="profile_picture">Pilih Gambar</label>
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('profile_picture'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="phone_number">Nomor HP</label>
                            <input type="text" class="form-control <?= validation_has_error('phone_number') ? 'is-invalid' : ''; ?>" id="phone_number" name="phone_number" value="<?= old('phone_number'); ?>" placeholder="199205142023052008">
                            <div class="invalid-feedback ml-2">
                                <?= validation_get_error('phone_number'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3 float-right">Tambah</button>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php $this->endSection('content'); ?>