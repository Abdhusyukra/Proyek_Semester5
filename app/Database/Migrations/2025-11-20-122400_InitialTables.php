<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InitialTables extends Migration
{
    public function up()
    {
        // 1. Tabel Users
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // 2. Tabel Produk
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'kategori'    => ['type' => 'VARCHAR', 'constraint' => 100],
            'harga'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'stok'        => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'deskripsi'   => ['type' => 'TEXT', 'null' => true],
            'gambar'      => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('produk');

        // 3. Tabel Stok History
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'produk_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'tipe'       => ['type' => 'ENUM', 'constraint' => ['masuk', 'keluar']],
            'jumlah'     => ['type' => 'INT', 'constraint' => 11],
            'keterangan' => ['type' => 'TEXT', 'null' => true],
            'tanggal'    => ['type' => 'DATE'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('produk_id', 'produk', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('stok_history');
    }

    public function down()
    {
        // Pastikan urutan drop dibalik agar tidak error foreign key
        $this->forge->dropTable('stok_history');
        $this->forge->dropTable('produk');
        $this->forge->dropTable('users');
    }
}