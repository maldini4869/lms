<?php $this->extend('layouts/auth'); ?>


<?= $this->section('content'); ?>

<div class="container my-auto">

    <!-- Outer Row -->
    <div class="row justify-content-center align-items-center">

        <div class="col-md-6">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                </div>
                                <?php if (session()->getFlashdata('message')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= session()->getFlashdata('message'); ?>
                                    </div>
                                <?php endif; ?>
                                <form class="user" method="post" action="/auth/login">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user <?= validation_has_error('email') ? 'is-invalid' : ''; ?>" id="exampleInputEmail" name="email" value="<?= old('email'); ?>" aria-describedby="emailHelp" placeholder="Masukan Email...">
                                        <div class="invalid-feedback ml-2">
                                            <?= validation_get_error('email'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= validation_has_error('password') ? 'is-invalid' : ''; ?>" id="exampleInputPassword" name="password" placeholder="Password">
                                        <div class="invalid-feedback ml-2">
                                            <?= validation_get_error('password'); ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<?= $this->endSection('content'); ?>