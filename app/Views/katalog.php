<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu - Amora Food</title>
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-maroon: #922B21; /* Merah Rendang */
            --accent-gold: #D4AC0D;    /* Emas Minyak/Kunyit */
            --bg-warm: #FDF5E6;        /* Putih Tulang (Nasi) */
            --text-dark: #2c3e50;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-warm);
            color: var(--text-dark);
        }

        /* Navbar */
        .navbar {
            background-color: var(--primary-maroon);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            color: var(--accent-gold) !important;
        }
        .btn-login {
            border: 1px solid var(--accent-gold);
            color: var(--accent-gold);
            border-radius: 20px;
            padding: 5px 20px;
            transition: 0.3s;
        }
        .btn-login:hover {
            background-color: var(--accent-gold);
            color: var(--primary-maroon);
        }

        /* Hero Section (Banner) */
        .hero-section {
            background: linear-gradient(rgba(62, 20, 20, 0.8), rgba(146, 43, 33, 0.8)), url('https://source.unsplash.com/1600x900/?food,restaurant');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
            margin-bottom: 50px;
            border-radius: 0 0 50px 50px; /* Lengkungan bawah */
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        /* Product Card */
        .product-card {
            border: none;
            border-radius: 15px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
            height: 100%;
            position: relative;
        }
        .product-card:hover {
            transform: translateY(-10px); /* Efek naik saat hover */
            box-shadow: 0 15px 30px rgba(146, 43, 33, 0.2);
        }
        
        /* Gambar Produk */
        .img-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }
        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
        .product-card:hover .product-img {
            transform: scale(1.1); /* Zoom effect */
        }
        
        /* Badge Kategori */
        .category-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary-maroon);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        /* Harga & Teks */
        .card-body { padding: 20px; }
        .product-title {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 5px;
            color: var(--primary-maroon);
        }
        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-gold);
            display: block;
            margin-bottom: 15px;
        }
        .product-desc {
            color: #666;
            font-size: 0.9rem;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Batasi teks 2 baris */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Tombol Pesan */
        .btn-order {
            background-color: var(--primary-maroon);
            color: white;
            border-radius: 0 0 15px 15px;
            width: 100%;
            padding: 12px;
            font-weight: 600;
            border: none;
        }
        .btn-order:hover {
            background-color: #721c1c;
            color: white;
        }

        /* Footer */
        footer {
            background-color: var(--primary-maroon);
            color: white;
            padding: 40px 0;
            margin-top: 80px;
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="bi bi-fire text-warning"></i> Amora Food</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-white me-3" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a href="/login" class="btn btn-login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title">Cita Rasa Otentik & Istimewa</h1>
            <p class="lead mb-4">Temukan berbagai menu spesial pilihan kami yang diolah dengan bahan berkualitas.</p>
            <a href="#menu-area" class="btn btn-warning btn-lg px-5 rounded-pill fw-bold">Lihat Menu</a>
        </div>
    </header>

    <!-- Menu Area -->
    <div class="container" id="menu-area">
        <div class="text-center mb-5">
            <h6 class="text-warning fw-bold text-uppercase tracking-wide">Menu Pilihan</h6>
            <h2 class="fw-bold" style="color: var(--primary-maroon);">Katalog Produk Kami</h2>
            <div style="width: 60px; height: 3px; background: var(--accent-gold); margin: 10px auto;"></div>
        </div>

        <div class="row">
            <?php if(empty($produk)): ?>
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/2037/2037348.png" width="100" class="mb-3 opacity-50">
                    <h4 class="text-muted">Belum ada produk tersedia.</h4>
                </div>
            <?php else: ?>
                <?php foreach($produk as $p): ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="product-card h-100 d-flex flex-column">
                        <!-- Gambar -->
                        <div class="img-wrapper">
                            <span class="category-badge"><?= $p['kategori'] ?></span>
                            <?php 
                                // Cek gambar, jika tidak ada pakai placeholder
                                $img = $p['gambar'] ? '/uploads/'.$p['gambar'] : 'https://placehold.co/400x400?text=No+Image'; 
                            ?>
                            <img src="<?= $img ?>" class="product-img" alt="<?= $p['nama'] ?>">
                        </div>
                        
                        <!-- Konten -->
                        <div class="card-body flex-grow-1">
                            <h5 class="product-title"><?= $p['nama'] ?></h5>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="product-price">Rp <?= number_format($p['harga'], 0, ',', '.') ?></span>
                                <small class="text-muted"><i class="bi bi-box-seam"></i> Stok: <?= $p['stok'] ?></small>
                            </div>
                            <p class="product-desc"><?= $p['deskripsi'] ?? 'Tidak ada deskripsi.' ?></p>
                        </div>

                        <!-- Tombol WA -->
                        <?php 
                            $pesan = "Halo Amora Food, saya mau pesan *" . $p['nama'] . "*. Apakah stok masih ada?";
                            $linkWA = "https://wa.me/6281367995046?text=" . urlencode($pesan); // Ganti No HP Disini
                        ?>
                        <a href="<?= $linkWA ?>" target="_blank" class="btn btn-order">
                            <i class="bi bi-whatsapp me-2"></i> Pesan Sekarang
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <h4 class="font-weight-bold mb-3">Amora Food</h4>
            <p class="small opacity-75">Menyajikan kelezatan di setiap gigitan.</p>
            <div class="mt-4">
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram fs-4"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook fs-4"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-whatsapp fs-4"></i></a>
            </div>
            <hr class="border-white opacity-25 my-4">
            <p class="small mb-0">&copy; <?= date('Y') ?> Amora Food Inventory System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>