<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\StokModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $stokModel = new StokModel();
        $today = date('Y-m-d');

        // 1. Data Card Statistik (Tetap sama)
        $data = [
            'total_produk' => $produkModel->countAll(),
            'total_stok' => $produkModel->selectSum('stok')->first()['stok'] ?? 0,
            'masuk_hari_ini' => $stokModel->where('tipe', 'masuk')->where('tanggal', $today)->selectSum('jumlah')->first()['jumlah'] ?? 0,
            'keluar_hari_ini' => $stokModel->where('tipe', 'keluar')->where('tanggal', $today)->selectSum('jumlah')->first()['jumlah'] ?? 0,
            'aktivitas_terbaru' => $stokModel->getStokWithProduct()
        ];
        $data['aktivitas_terbaru'] = array_slice($data['aktivitas_terbaru'], 0, 5);

        // 2. LOGIKA BARU UNTUK GRAFIK (7 Hari Terakhir)
        $chartLabel = [];
        $chartMasuk = [];
        $chartKeluar = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-" . $i . " days"));

            // Masukkan Tanggal ke Label (Contoh: 25 Nov)
            $chartLabel[] = date('d M', strtotime($date));

            // Hitung Masuk pada tanggal tersebut
            $masuk = $stokModel->where('tipe', 'masuk')
                ->where('tanggal', $date)
                ->selectSum('jumlah')
                ->first()['jumlah'] ?? 0;
            $chartMasuk[] = $masuk;

            // Hitung Keluar pada tanggal tersebut
            $keluar = $stokModel->where('tipe', 'keluar')
                ->where('tanggal', $date)
                ->selectSum('jumlah')
                ->first()['jumlah'] ?? 0;
            $chartKeluar[] = $keluar;
        }

        // Kirim data grafik ke view
        $data['grafik'] = [
            'label' => json_encode($chartLabel),
            'masuk' => json_encode($chartMasuk),
            'keluar' => json_encode($chartKeluar),
        ];

        return view('dashboard/index', $data);
    }
}
