<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="row">
    <!-- Form Tambah -->
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Tambah Kategori</h6></div>
            <div class="card-body">
                <form action="/admin/kategori/simpan" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6></div>
            <div class="card-body">
                <?php if(session()->getFlashdata('success')): ?><div class="alert alert-success"><?= session()->getFlashdata('success') ?></div><?php endif; ?>
                <table class="table table-bordered">
                    <thead><tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr></thead>
                    <tbody>
                        <?php foreach($kategori as $i => $k): ?>
                        <tr>
                            <td><?= $i+1 ?></td>
                            <td><?= $k['nama_kategori'] ?></td>
                            <td><a href="/admin/kategori/hapus/<?= $k['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus?')">Hapus</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>