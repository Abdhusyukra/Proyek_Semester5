<?php
namespace App\Controllers;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    public function index()
    {
        $model = new KategoriModel();
        $data['kategori'] = $model->findAll();
        return view('kategori/index', $data);
    }

    public function store()
    {
        $model = new KategoriModel();
        $model->save([
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function hapus($id)
    {
        $model = new KategoriModel();
        $model->delete($id);
        return redirect()->to('/admin/kategori')->with('success', 'Kategori dihapus');
    }
}