<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Manajemen Stok Barang</h1>
</div>

<!-- Notifikasi -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="row mb-4">
    <!-- ==========================
         FORM STOK MASUK (HIJAU)
    =========================== -->
    <div class="col-md-6 mb-4">
        <div class="card border-start border-success border-4 shadow h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="text-success fw-bold"><i class="bi bi-box-arrow-in-down me-2"></i> Catat Barang Masuk</h5>
            </div>
            <div class="card-body">
                <form action="/admin/stok/masuk" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted">Pilih Produk</label>
                        <select name="produk_id" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach($produk_list as $p): ?>
                                <option value="<?= $p['id'] ?>">
                                    <?= $p['nama'] ?> (Stok saat ini: <?= $p['stok'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Jumlah Masuk</label>
                            <input type="number" name="jumlah" class="form-control" min="1" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Kulakan dari Pasar"></textarea>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-success"><i class="bi bi-save"></i> Simpan Stok Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ==========================
         FORM STOK KELUAR (MERAH)
    =========================== -->
    <div class="col-md-6 mb-4">
        <div class="card border-start border-danger border-4 shadow h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0">
                <h5 class="text-danger fw-bold"><i class="bi bi-box-arrow-up me-2"></i> Catat Barang Keluar</h5>
            </div>
            <div class="card-body">
                <form action="/admin/stok/keluar" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label small text-muted">Pilih Produk</label>
                        <select name="produk_id" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach($produk_list as $p): ?>
                                <?php 
                                    // Logika Cek Expired
                                    $isExpired = ($p['expired_at'] != null && $p['expired_at'] < date('Y-m-d'));
                                    
                                    // Jika Expired, matikan opsi (disabled) dan beri warna merah
                                    $disabled = $isExpired ? 'disabled style="background-color:#ffecec; color:#dc3545;"' : '';
                                    $info = $isExpired ? '(EXPIRED - TIDAK BISA DIJUAL)' : '(Sisa: ' . $p['stok'] . ')';
                                ?>
                                <option value="<?= $p['id'] ?>" <?= $disabled ?>>
                                    <?= $p['nama'] ?> <?= $info ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-text text-muted small">*Barang expired tidak bisa dipilih.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Jumlah Keluar</label>
                            <input type="number" name="jumlah" class="form-control" min="1" placeholder="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small text-muted">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small text-muted">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control" rows="2" placeholder="Contoh: Terjual ke Pelanggan A"></textarea>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-danger"><i class="bi bi-save"></i> Simpan Stok Keluar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ==========================
     TABEL RIWAYAT TRANSAKSI
=========================== -->
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white border-bottom">
        <h6 class="m-0 font-weight-bold text-primary"><i class="bi bi-clock-history"></i> Riwayat Perubahan Stok</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Produk</th>
                        <th>Tipe Transaksi</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($riwayat)): ?>
                        <?php foreach($riwayat as $r): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($r['tanggal'])) ?></td>
                            <td class="fw-bold"><?= $r['nama_produk'] ?></td>
                            <td>
                                <?php if($r['tipe'] == 'masuk'): ?>
                                    <span class="badge bg-success rounded-pill px-3"><i class="bi bi-arrow-down"></i> Masuk</span>
                                <?php else: ?>
                                    <span class="badge bg-danger rounded-pill px-3"><i class="bi bi-arrow-up"></i> Keluar</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold fs-5"><?= $r['jumlah'] ?></td>
                            <td class="text-muted small"><?= $r['keterangan'] ?? '-' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
                                <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                Belum ada data riwayat stok.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>