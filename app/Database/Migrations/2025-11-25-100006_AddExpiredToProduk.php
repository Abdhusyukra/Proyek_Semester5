<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExpiredToProduk extends Migration
{
    public function up()
    {
        $fields = [
            'expired_at' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'stok' // Menambahkan kolom setelah kolom stok
            ],
        ];
        $this->forge->addColumn('produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('produk', 'expired_at');
    }
}