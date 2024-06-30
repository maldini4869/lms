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

        <?= $this->include('layouts/admin_sidebar'); ?>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?= $this->include('layouts/admin_topbar'); ?>

                <!-- Content Wrapper -->
                <?= $this->renderSection('content'); ?>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

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


    <!-- Custom image-preview scripts -->
    <script>
        function previewImg() {
            const profilePicture = document.querySelector('#profile_picture');
            const profilePictureLabel = document.querySelector('.custom-file-label');
            const profilePicturePreview = document.querySelector('.img-preview');

            profilePictureLabel.textContent = profilePicture.files[0].name;

            const profilePictureFile = new FileReader();
            profilePictureFile.readAsDataURL(profilePicture.files[0])

            profilePictureFile.onload = function(e) {
                profilePicturePreview.src = e.target.result;
            }
        }
    </script>

    <!-- Custom period-picker scripts -->
    <script src="/js/period-picker.js"></script>

    <!-- Custom tooltip scripts -->
    <script src="/js/tooltip.js"></script>
</body>

</html>