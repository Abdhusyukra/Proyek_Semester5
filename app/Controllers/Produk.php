<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel; // <--- 1. TAMBAHKAN INI (Supaya bisa baca tabel kategori)

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data['produk'] = $this->produkModel->findAll();
        return view('produk/index', $data);
    }

    // --- BAGIAN INI DIUBAH ---
    public function create()
    {
        $kategoriModel = new KategoriModel(); // <--- 2. Siapkan Model Kategori
        $data['kategori'] = $kategoriModel->findAll(); // <--- Ambil semua data kategori

        return view('produk/tambah', $data); // <--- Kirim $data ke view
    }
    // -------------------------

    public function store()
    {
        $validationRule = [
            'gambar' => [
                'rules' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]',
            ]
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $fileGambar->getRandomName();
        $fileGambar->move('uploads', $namaGambar);

        $this->produkModel->save([
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok'),
            'expired_at' => $this->request->getPost('expired_at'), // <--- Tambahkan ini
            'deskripsi' => $this->request->getPost('deskripsi'),
            'gambar' => $namaGambar
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    // --- BAGIAN INI DIUBAH ---
    // Menampilkan Form Edit
    public function edit($id)
    {
        $kategoriModel = new \App\Models\KategoriModel(); // Panggil Model Kategori

        $data['produk'] = $this->produkModel->find($id);
        $data['kategori'] = $kategoriModel->findAll(); // Kirim data kategori untuk dropdown

        if (empty($data['produk'])) {
            return redirect()->to('/admin/produk')->with('error', 'Produk tidak ditemukan');
        }

        return view('produk/edit', $data);
    }

    // Memproses Update Data
    public function update($id)
    {
        // 1. Ambil data lama
        $produkLama = $this->produkModel->find($id);

        // 2. Siapkan variabel gambar
        $fileGambar = $this->request->getFile('gambar');
        $namaGambar = $produkLama['gambar']; // Default pakai gambar lama

        // 3. Cek apakah user upload gambar baru?
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            // Generate nama baru
            $namaGambar = $fileGambar->getRandomName();
            // Pindahkan file
            $fileGambar->move('uploads', $namaGambar);

            // Hapus gambar lama (jika ada file-nya)
            if (!empty($produkLama['gambar']) && file_exists('uploads/' . $produkLama['gambar'])) {
                unlink('uploads/' . $produkLama['gambar']);
            }
        }

        // 4. Update Database
        $this->produkModel->update($id, [
            'nama'       => $this->request->getPost('nama'),
            'kategori'   => $this->request->getPost('kategori'),
            'harga'      => $this->request->getPost('harga'),
            // Stok biasanya tidak diedit manual disini jika pakai sistem stok masuk/keluar, 
            // tapi kita biarkan saja untuk koreksi (stock opname).
            'stok'       => $this->request->getPost('stok'),
            'expired_at' => $this->request->getPost('expired_at'), // Update Expired
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'gambar'     => $namaGambar
        ]);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function delete($id)
    {
        $produk = $this->produkModel->find($id);
        if (file_exists('uploads/' . $produk['gambar'])) {
            unlink('uploads/' . $produk['gambar']);
        }
        $this->produkModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'Produk dihapus');
    }
}
