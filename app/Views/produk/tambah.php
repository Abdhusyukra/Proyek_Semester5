<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Tambah Produk Baru</h1>
    <a href="/admin/produk" class="btn btn-secondary btn-sm shadow-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Produk</h6>
    </div>
    <div class="card-body">
        <form action="/admin/produk/simpan" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Nama Produk -->
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Rendang" required>
            </div>

            <!-- Kategori (BAGIAN YANG DIUBAH DARI INPUT TEXT JADI SELECT) -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php if(!empty($kategori)): ?>
                        <?php foreach($kategori as $k): ?>
                            <option value="<?= $k['nama_kategori'] ?>"><?= $k['nama_kategori'] ?></option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Belum ada data kategori</option>
                    <?php endif; ?>
                </select>
                <small class="text-muted">
                    Kategori tidak ada? <a href="/admin/kategori" target="_blank">Tambah Kategori Baru</a>
                </small>
            </div>

            <!-- Harga, Stok, & Expired (Grid 3 Kolom) -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok Awal</label>
                    <input type="number" name="stok" class="form-control" value="0" min="0" required>
                </div>
                <!-- BAGIAN BARU: EXPIRED DATE -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" name="expired_at" class="form-control">
                    <div class="form-text text-muted small">Kosongkan jika barang tidak bisa basi.</div>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="3" placeholder="Jelaskan detail produk..."></textarea>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-3">
                <label class="form-label">Gambar Produk</label>
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
                <div class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
            </div>

            <!-- Tombol Aksi -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="reset" class="btn btn-light me-md-2">Reset</button>
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Produk</button>
            </div>

        </form>
    </div>
</div>

<?= view('layout/footer') ?>