<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <i class="fas fa-info-circle"></i>
        </div>
        <div class="sidebar-brand-text mx-3 text-left">desakedisan <sup>info.</sup></div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item <?= (service('uri')->getSegment(1) == 'dashboard' ? 'active' : '') ?>">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-home"></i>
            <span>Landing Page</span></a>
    </li>
    <li class="nav-item  <?= (service('uri')->getSegment(1) == 'pengumuman' ? 'active' : '') ?>">
        <a class="nav-link" href="/pengumuman">
            <i class="fas fa-fw fa-info"></i>
            <span>Pengumuman</span></a>
    </li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Master Data
    </div>

    <li class="nav-item <?= (service('uri')->getSegment(1) == 'penduduk' ? 'active' : '') ?>">
        <a class="nav-link" href="/penduduk">
            <i class="fas fa-fw fa-users"></i>
            <span>Penduduk</span></a>
    </li>
    <li class="nav-item  <?= (service('uri')->getSegment(1) == 'users' ? 'active' : '') ?>">
        <a class="nav-link" href="/users">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>