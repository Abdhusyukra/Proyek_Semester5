<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800">Edit Produk</h1>
    <a href="/admin/produk" class="btn btn-secondary btn-sm shadow-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Produk</h6>
    </div>
    <div class="card-body">
        <!-- Perhatikan action mengarah ke function update dengan ID -->
        <form action="/admin/produk/update/<?= $produk['id'] ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <!-- Nama Produk -->
            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>" required>
            </div>

            <!-- Kategori (Dropdown dengan Logic Selected) -->
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach($kategori as $k): ?>
                        <?php 
                            // Cek apakah kategori ini sama dengan kategori produk saat ini?
                            $selected = ($k['nama_kategori'] == $produk['kategori']) ? 'selected' : ''; 
                        ?>
                        <option value="<?= $k['nama_kategori'] ?>" <?= $selected ?>>
                            <?= $k['nama_kategori'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Grid 3 Kolom: Harga, Stok, Expired -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stok Saat Ini</label>
                    <input type="number" name="stok" class="form-control" value="<?= $produk['stok'] ?>" required>
                    <div class="form-text text-muted small">Disarankan edit stok lewat menu "Stok Barang".</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tanggal Kadaluarsa</label>
                    <input type="date" name="expired_at" class="form-control" value="<?= $produk['expired_at'] ?>">
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi Produk</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?= $produk['deskripsi'] ?></textarea>
            </div>

            <!-- Gambar -->
            <div class="row mb-3">
                <div class="col-md-2">
                    <label class="form-label d-block">Gambar Saat Ini</label>
                    <img src="/uploads/<?= $produk['gambar'] ?>" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
                <div class="col-md-10">
                    <label class="form-label">Ganti Gambar (Opsional)</label>
                    <input type="file" name="gambar" class="form-control" accept="image/*">
                    <div class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Perbarui Data</button>
            </div>

        </form>
    </div>
</div>

<?= view('layout/footer') ?>