<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amora Food Dashboard</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Chart JS (Untuk Grafik) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Custom CSS -->
    <link href="<?= base_url('css/style.css') ?>" rel="stylesheet">
</head>
<body>

    <!-- 1. Header / Navbar Cokelat -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container-fluid">
            <!-- Logo Kiri -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <div style="background: rgba(255,255,255,0.2); padding: 5px 10px; border-radius: 4px; margin-right: 10px; font-size: 0.8rem;"></div>
                 Amora Food
            </a> 

            <!-- Menu Kanan -->
            <div class="d-flex align-items-center ms-auto">
                <a href="#" class="btn-profile text-decoration-none">
                    <i class="bi bi-upload me-2"></i> Profil
                </a>
                <div class="user-avatar"></div>
            </div>
        </div>
    </nav>

    <!-- Spacer agar konten tidak tertutup navbar fixed -->
    <div style="height: 64px;"></div>

    <div class="container-fluid">
        <div class="row">