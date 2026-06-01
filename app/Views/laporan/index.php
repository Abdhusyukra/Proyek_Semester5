<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>
<h3>Laporan Stok</h3>
<form action="/admin/laporan/filter" method="post" class="row g-3 mb-4">
    <?= csrf_field() ?>
    <div class="col-auto"><input type="date" name="tgl_mulai" class="form-control" required></div>
    <div class="col-auto"><input type="date" name="tgl_selesai" class="form-control" required></div>
    <div class="col-auto"><button type="submit" class="btn btn-primary">Filter</button></div>
    <div class="col-auto"><button type="button" onclick="window.print()" class="btn btn-secondary">Cetak</button></div>
</form>

<?php if(isset($laporan)): ?>
    <div class="alert alert-info">Periode: <?= $periode ?></div>
    <table class="table table-bordered">
        <thead><tr><th>Tanggal</th><th>Produk</th><th>Tipe</th><th>Jumlah</th><th>Sisa Stok Saat Ini</th></tr></thead>
        <tbody>
            <?php foreach($laporan as $l): ?>
            <tr>
                <td><?= $l['tanggal'] ?></td>
                <td><?= $l['nama_produk'] ?></td>
                <td><?= strtoupper($l['tipe']) ?></td>
                <td><?= $l['jumlah'] ?></td>
                <td><?= $l['stok_saat_ini'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?= view('layout/footer') ?>