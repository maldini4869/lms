<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            LMS
            <?php if (session('user_role_id') == 1) : ?>
                Admin
            <?php elseif (session('user_role_id') == 2) : ?>
                Guru
            <?php elseif (session('user_role_id') == 3) : ?>
                Siswa
            <?php endif; ?>
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= current_url(true)->getSegment(1) === 'dashboard' ? 'active' : ''; ?>">
        <?php
        $dashboardUrl = '';
        if (session('user_role_id') == 1) {
            $dashboardUrl = '/dashboard/admin';
        } elseif (session('user_role_id') == 2) {
            $dashboardUrl = '/dashboard/guru';
        } elseif (session('user_role_id') == 3) {
            $dashboardUrl = '/dashboard/siswa';
        }
        ?>
        <a class="nav-link" href="<?= $dashboardUrl; ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pendataan
    </div>

    <!-- Nav Item - Guru -->
    <li class="nav-item <?= current_url(true)->getSegment(1) === 'guru' ? 'active' : ''; ?>">
        <a class="nav-link" href="/guru">
            <i class="fas fa-fw fa-chalkboard-teacher"></i>
            <span>Guru</span></a>
    </li>

    <!-- Nav Item - Siswa -->
    <li class="nav-item <?= current_url(true)->getSegment(1) === 'siswa' ? 'active' : ''; ?>">
        <a class="nav-link" href="/siswa">
            <i class="fas fa-fw fa-user-graduate"></i>
            <span>Siswa</span></a>
    </li>

    <!-- Nav Item - Kelas -->
    <li class="nav-item <?= current_url(true)->getSegment(1) === 'kelas' ? 'active' : ''; ?>">
        <a class="nav-link" href="/kelas">
            <i class="fas fa-chalkboard"></i>
            <span>Kelas</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Pembelajaran
    </div>

    <!-- Nav Item - Jadwal Mata Pelajaran -->
    <li class="nav-item <?= current_url(true)->getSegment(1) === 'jadwal-mapel' ? 'active' : ''; ?>">
        <a class="nav-link" href="/jadwal-mapel">
            <i class="fas fa-fw fa-table"></i>
            <span>Jadwal Mata Pelajaran</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->