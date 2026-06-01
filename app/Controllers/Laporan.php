<?php
namespace App\Controllers;
use App\Models\StokModel;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan/index');
    }

    public function filter()
    {
        $tglMulai = $this->request->getPost('tgl_mulai');
        $tglSelesai = $this->request->getPost('tgl_selesai');
        
        $stokModel = new StokModel();
        // Query Laporan
        $data['laporan'] = $stokModel->select('stok_history.*, produk.nama as nama_produk, produk.stok as stok_saat_ini')
            ->join('produk', 'produk.id = stok_history.produk_id')
            ->where('tanggal >=', $tglMulai)
            ->where('tanggal <=', $tglSelesai)
            ->findAll();

        $data['periode'] = "$tglMulai s/d $tglSelesai";
        
        // Kita load view yang sama tapi bawa data
        return view('laporan/index', $data);
    }
}