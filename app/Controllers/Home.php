<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();

        // Filter: Tampilkan produk yang BELUM expired ATAU yang expired-nya NULL (tidak ada tgl basi)
        $data['produk'] = $model->groupStart()
            ->where('expired_at >=', date('Y-m-d'))
            ->orWhere('expired_at', null)
            ->groupEnd()
            ->findAll();

        return view('katalog', $data);
    }
}
