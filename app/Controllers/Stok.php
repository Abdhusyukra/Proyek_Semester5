<?php
namespace App\Controllers;
use App\Models\StokModel;
use App\Models\ProdukModel;

class Stok extends BaseController
{
    public function index()
    {
        $stokModel = new StokModel();
        $produkModel = new ProdukModel();
        
        $data = [
            'riwayat' => $stokModel->getStokWithProduct(),
            // Ambil semua produk untuk dropdown
            'produk_list' => $produkModel->orderBy('nama', 'ASC')->findAll()
        ];
        return view('stok/index', $data);
    }

    public function masuk()
    {
        if($this->_updateStok('masuk')) {
            return redirect()->to('/admin/stok')->with('success', 'Stok Masuk berhasil dicatat.');
        } else {
            return redirect()->to('/admin/stok')->with('error', 'Gagal mencatat stok.');
        }
    }

    public function keluar()
    {
        // Validasi stok cukup sebelum mengurangi
        $produkModel = new ProdukModel();
        $produkId = $this->request->getPost('produk_id');
        $jumlah = (int)$this->request->getPost('jumlah');

        $produk = $produkModel->find($produkId);
        if ($produk['stok'] < $jumlah) {
            return redirect()->back()->with('error', 'Gagal! Stok produk tidak mencukupi.');
        }

        if($this->_updateStok('keluar')) {
            return redirect()->to('/admin/stok')->with('success', 'Stok Keluar berhasil dicatat.');
        } else {
            return redirect()->to('/admin/stok')->with('error', 'Gagal mencatat stok.');
        }
    }

    // Cari function _updateStok di paling bawah Controller Stok
    private function _updateStok($tipe)
    {
        $stokModel = new StokModel();
        $produkModel = new ProdukModel();
        
        $produkId = $this->request->getPost('produk_id');
        $jumlah = (int)$this->request->getPost('jumlah');
        $keterangan = $this->request->getPost('keterangan');
        $tanggal = $this->request->getPost('tanggal');

        // Cek Jumlah
        if ($jumlah <= 0) {
            dd("Error: Jumlah tidak boleh 0 atau kosong"); // Tampilkan error di layar
        }

        $db = \Config\Database::connect();
        
        try {
            $db->transException(true)->transStart(); // Aktifkan Exception agar error terlihat

            // 1. Simpan History
            $stokModel->insert([
                'produk_id'  => $produkId,
                'tipe'       => $tipe,
                'jumlah'     => $jumlah,
                'keterangan' => $keterangan,
                'tanggal'    => $tanggal,
                'created_at' => date('Y-m-d H:i:s') // Paksa isi manual
            ]);

            // 2. Update Produk
            $produk = $produkModel->find($produkId);
            if(!$produk) throw new \Exception("Produk tidak ditemukan");

            $stokBaru = ($tipe == 'masuk') ? ($produk['stok'] + $jumlah) : ($produk['stok'] - $jumlah);
            $produkModel->update($produkId, ['stok' => $stokBaru]);

            $db->transComplete();

        } catch (\Exception $e) {
            // JIKA ERROR, TAMPILKAN PESAN ERRORNYA DISINI
            dd($e->getMessage()); 
        }

        return $db->transStatus();
    }
}