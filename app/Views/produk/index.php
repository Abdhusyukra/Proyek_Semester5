<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Manajemen Produk</h1>
    <a href="/admin/produk/tambah" class="btn btn-primary shadow-sm"><i class="bi bi-plus-lg"></i> Tambah Produk</a>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Gambar</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produk as $i => $p): ?>
                        <?php
                        // Logika Cek Expired
                        $isExpired = ($p['expired_at'] != null && $p['expired_at'] < date('Y-m-d'));
                        $bgClass = $isExpired ? 'table-danger' : ''; // Baris jadi merah jika expired
                        ?>
                        <tr class="<?= $bgClass ?>">
                            <td><?= $i + 1 ?></td>
                            <td><img src="/uploads/<?= $p['gambar'] ?>" class="img-thumbnail" style="width:60px;"></td>
                            <td>
                                <div class="fw-bold"><?= $p['nama'] ?></div>
                                <?php if ($isExpired): ?>
                                    <span class="badge bg-danger">EXPIRED!</span>
                                <?php elseif ($p['expired_at']): ?>
                                    <small class="text-muted">Exp: <?= date('d M Y', strtotime($p['expired_at'])) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= $p['kategori'] ?></td>
                            <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                            <td><?= $p['stok'] ?></td>
                            <td>
                                <a href="/admin/produk/edit/<?= $p['id'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="/admin/produk/hapus/<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>