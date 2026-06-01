<?php $uri = service('uri'); ?>

<!-- Sidebar Kiri -->
<nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky d-flex flex-column h-100">

        <ul class="nav flex-column mt-2">
            <!-- Dasbor -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>" href="/admin/dashboard">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>

            <!-- Produk -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri->getSegment(2) == 'produk') ? 'active' : '' ?>" href="/admin/produk">
                    <i class="bi bi-box-seam"></i> Produk
                </a>
            </li>

            <!-- Kategori (Placeholder Link karena belum ada tabel kategori) -->
            <li class="nav-item w-100">
                <a href="/admin/kategori" class="nav-link <?= ($uri->getSegment(2) == 'kategori') ? 'active' : '' ?>">
                    <i class="bi bi-tags"></i> <span class="ms-1 d-none d-sm-inline">Kategori</span>
                </a>
            </li>

            <!-- Stok -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri->getSegment(2) == 'stok') ? 'active' : '' ?>" href="/admin/stok">
                    <i class="bi bi-box"></i> Stok
                </a>
            </li>

            <div class="sidebar-heading mt-3">Katalog Produk</div>

            <!-- Laporan -->
            <li class="nav-item">
                <a class="nav-link <?= ($uri->getSegment(2) == 'laporan') ? 'active' : '' ?>" href="/admin/laporan">
                    <i class="bi bi-file-text"></i> Laporan
                </a>
            </li>

            <!-- Keluar -->
            <li class="nav-item">
                <a class="nav-link" href="/auth/logout">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </li>
        </ul>

    </div>
</nav>

<!-- Main Content Wrapper -->
<main class="col-md-9 ms-sm-auto col-lg-10 main-content">