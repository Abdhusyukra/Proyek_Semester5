<?php
namespace App\Models;
use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table = 'stok_history';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'produk_id', 
        'tipe', 
        'jumlah', 
        'keterangan', 
        'tanggal',
        'created_at' // Pastikan ini ada
    ];
    
    // Konfigurasi Timestamp
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // <--- KOSONGKAN INI (PENTING!)
                                   // Agar CI4 tidak mencari kolom updated_at

    public function getStokWithProduct()
    {
        return $this->select('stok_history.*, produk.nama as nama_produk')
                    ->join('produk', 'produk.id = stok_history.produk_id')
                    ->orderBy('stok_history.tanggal', 'DESC')
                    ->orderBy('stok_history.id', 'DESC')
                    ->findAll();
    }
}