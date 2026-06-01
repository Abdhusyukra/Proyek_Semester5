<?= view('layout/header') ?>
<?= view('layout/sidebar') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Overview</h1>
</div>

<!-- 4 Card Statistik (Sama seperti sebelumnya) -->
<div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Produk</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_produk ?> Item</div>
                    </div>
                    <div class="col-auto"><i class="bi bi-box-seam widget-icon text-primary"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Stok Fisik</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_stok ?> Unit</div>
                    </div>
                    <div class="col-auto"><i class="bi bi-archive widget-icon text-success"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Masuk Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">+<?= $masuk_hari_ini ?></div>
                    </div>
                    <div class="col-auto"><i class="bi bi-download widget-icon text-info"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Keluar Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">-<?= $keluar_hari_ini ?></div>
                    </div>
                    <div class="col-auto"><i class="bi bi-upload widget-icon text-warning"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BAGIAN BARU: GRAFIK STATISTIK -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pergerakan Stok (7 Hari Terakhir)</h6>
            </div>
            <div class="card-body">
                <canvas id="stokChart" style="height: 300px; width: 100%;"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- END BAGIAN BARU -->

<!-- Tabel Aktivitas Terbaru (Sama seperti sebelumnya) -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Stok Terbaru</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead>
                    <tr><th>Tanggal</th><th>Produk</th><th>Tipe</th><th>Jumlah</th><th>Keterangan</th></tr>
                </thead>
                <tbody>
                    <?php foreach($aktivitas_terbaru as $a): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($a['tanggal'])) ?></td>
                        <td><span class="fw-bold"><?= $a['nama_produk'] ?></span></td>
                        <td>
                            <?php if($a['tipe'] == 'masuk'): ?>
                                <span class="badge bg-success rounded-pill"><i class="bi bi-arrow-down"></i> Masuk</span>
                            <?php else: ?>
                                <span class="badge bg-danger rounded-pill"><i class="bi bi-arrow-up"></i> Keluar</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $a['jumlah'] ?></td>
                        <td class="text-muted small"><?= $a['keterangan'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Load CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data dari Controller PHP
    const labels = <?= $grafik['label'] ?>;
    const dataMasuk = <?= $grafik['masuk'] ?>;
    const dataKeluar = <?= $grafik['keluar'] ?>;

    const ctx = document.getElementById('stokChart').getContext('2d');
    const stokChart = new Chart(ctx, {
        type: 'bar', // Tipe grafik batang
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Stok Masuk',
                    data: dataMasuk,
                    backgroundColor: 'rgba(28, 200, 138, 0.7)', // Warna Hijau
                    borderColor: 'rgba(28, 200, 138, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Stok Keluar (Penjualan)',
                    data: dataKeluar,
                    backgroundColor: 'rgba(231, 74, 59, 0.7)', // Warna Merah
                    borderColor: 'rgba(231, 74, 59, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 } // Agar angka di kiri bulat (tidak desimal)
                }
            },
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>

<?= view('layout/footer') ?>