<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="/css/font-awesome.all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for datatables -->
    <link href="/css/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Custom styles for bootstrap-select -->
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="/css/style.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" style="height: 100vh">

                <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
                    <div class="container">
                        <a class="navbar-brand" href="#">LMS <?= session('user_role_id') == 2 ? 'Guru' : 'Siswa'; ?></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="/dashboard/<?= session('user_role_id') == 2 ? 'guru' : 'siswa'; ?>">Home</a>
                                </li>
                                <?php if (session('user_role_id') == 2) : ?>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="/penilaian">Penilaian</a>
                                    </li>
                                <?php endif ?>
                                <?php if (session('user_role_id') == 3) : ?>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="/tugas">Tugas</a>
                                    </li>
                                <?php endif ?>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <div style="cursor: pointer;" id="dorpdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small" style="width: fit-content;"><?= session('user_full_name'); ?></span>
                                <img class="img-profile rounded-circle" width="36" src="/img/profile/<?= session('user_profile_picture'); ?>">
                            </div>
                            <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="dorpdownMenuProfile">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>

                <div style="margin-top: 80px; padding-bottom: 20px;">
                    <!-- Content Wrapper -->
                    <?= $this->renderSection('content'); ?>
                    <!-- End of Content Wrapper -->
                </div>

            </div>
            <!-- End of Main Content -->

        </div>

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="/auth/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Datatables scripts -->
    <script src="/js/datatables/jquery.dataTables.min.js"></script>
    <script src="/js/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Datatables custom scripts -->
    <script src="/js/datatables.js"></script>

    <!-- Bootstrap-select custom scripts -->
    <script src="/js/bootstrap-select.min.js"></script>

    <!-- Custom period-picker scripts -->
    <script src="/js/period-picker.js"></script>

    <!-- Custom tooltip scripts -->
    <script src="/js/tooltip.js"></script>

    <script>
        function previewFile() {
            const postAttachment = document.querySelector('#file');
            const filePreviewContainer = document.querySelector('#file-preview');
            const postLabel = document.querySelector('#label');

            postLabel.style['display'] = 'none'

            if (postAttachment.files[0]) {
                filePreviewContainer.innerHTML = `
                    <div class="d-flex align-items-center bg-light p-3 rounded">
                        <i class="fas fa-file-alt mr-2" style="font-size: 32px"></i>
                        <h6 class="mb-0 one-line-text">${postAttachment.files[0].name}</h6>
                    </div>
                `;
            }
        }
    </script>
    <script>
        function previewAssignmentFile(postAttachmentId) {
            const postAttachment = document.querySelector(`#assignment_file${postAttachmentId}`);
            const filePreviewContainer = document.querySelector('#assignment-file-preview');

            if (postAttachment.files[0]) {
                filePreviewContainer.innerHTML = `
                    <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 one-line-text text-center">${postAttachment.files[0].name}</h5>
                    </div>
                `;
            }
        }
    </script>
</body>

</html>