<?php
namespace App\Models;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id';
    // Tambahkan 'expired_at' di sini
    protected $allowedFields = ['nama', 'kategori', 'harga', 'stok', 'expired_at', 'deskripsi', 'gambar'];
    protected $useTimestamps = true;
}